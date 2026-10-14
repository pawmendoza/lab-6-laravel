<?php

namespace App\Http\Controllers;

use App\Models\InventoryTransaction;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InventoryTransactionController extends Controller
{
    public function index(Request $request)
    {
        $query = InventoryTransaction::with(['product', 'user'])->latest();
        
        if ($request->filled('product_id')) {
            $query->where('product_id', $request->product_id);
        }
        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        $transactions = $query->paginate(20);
        $products = Product::all();

        return view('transactions.index', compact('transactions', 'products'));
    }

    public function create()
    {
        $products = Product::all();
        return view('transactions.create', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'type' => 'required',
            'quantity' => 'required|integer|min:1',
            'reference_number' => 'nullable|string|max:255',
            'notes' => 'nullable|string|max:500',
        ]);

        $product = Product::findOrFail($request->product_id);
        
        // I-normalize ang type para tanggapin kahit anong format galing sa form
        $type = strtolower(str_replace(' ', '_', $request->type));

        // Validation kung stock out at kulang ang stock
        if ($type === 'stock_out' && $product->quantity < $request->quantity) {
            return back()->withErrors(['quantity' => 'Insufficient stock for this transaction.'])->withInput();
        }

        // I-update ang quantity ng produkto
        if ($type === 'stock_in') {
            $product->quantity += $request->quantity;
        } elseif ($type === 'stock_out') {
            $product->quantity -= $request->quantity;
        } elseif ($type === 'adjustment') {
            $product->quantity = $request->quantity;
        }
        $product->save();

        // I-save ang transaksyon sa database
        InventoryTransaction::create([
            'product_id' => $request->product_id,
            'user_id' => Auth::id() ?? 1,
            'type' => $type,
            'quantity' => $request->quantity,
            'reference_number' => $request->reference_number,
            'notes' => $request->notes,
        ]);

        return redirect()->route('transactions.index')->with('success', 'Transaction recorded successfully.');
    }

    public function show(InventoryTransaction $transaction)
    {
        return view('transactions.show', compact('transaction'));
    }

    public function destroy(InventoryTransaction $transaction)
    {
        $transaction->delete();
        return redirect()->route('transactions.index')->with('success', 'Transaction deleted successfully.');
    }
}
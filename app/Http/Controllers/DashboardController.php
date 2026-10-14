<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\InventoryTransaction;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProducts = Product::count();
        $lowStockCount = Product::whereColumn('quantity', '<=', 'reorder_level')
                                ->where('quantity', '>', 0)
                                ->count();
        $outOfStockCount = Product::where('quantity', '<=', 0)->count();
        
        // Gamit ang 'price' column batay sa database mo
        $totalValue = Product::selectRaw('SUM(quantity * price) as total')->value('total') ?? 0;
        
        // Recent products para sa dashboard table
        $recentProducts = Product::latest()->take(5)->get();

        return view('dashboard', compact(
            'totalProducts',
            'lowStockCount',
            'outOfStockCount',
            'totalValue',
            'recentProducts'
        ));
    }
}
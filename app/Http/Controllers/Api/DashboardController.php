<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\InventoryTransaction;

class DashboardController extends Controller
{
    public function stats()
    {
        return response()->json([
            'total_products' => Product::count(),
            'low_stock_count' => Product::lowStock()->count(),
            'out_of_stock_count' => Product::outOfStock()->count(),
            'total_transactions' => InventoryTransaction::count(),
        ]);
    }

    public function lowStockProducts()
    {
        $products = Product::lowStock()->get();
        return response()->json($products);
    }

    public function recentTransactions()
    {
        $transactions = InventoryTransaction::with(['product', 'user'])
            ->latest()
            ->take(5)
            ->get();
        return response()->json($transactions);
    }
}
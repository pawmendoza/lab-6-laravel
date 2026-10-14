<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Iba pang methods mo rito (index, create, store, etc.)

    public function show(Product $product)
    {
        // Kunin ang mga transaksyon ng produktong ito mula pinakaluma hanggang pinakabago para sa running balance
        $transactions = $product->transactions()->with(['user', 'product'])->oldest()->get();

        return view('products.show', compact('product', 'transactions'));
    }
}
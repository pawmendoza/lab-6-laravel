@extends('layouts.app')

@section('content')
<div class="py-2">
    
    <!-- Statistic Cards (Lab 5 & 6 Style) -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        
        <!-- Total Products -->
        <div class="bg-white p-6 rounded-lg shadow-sm border-l-4 border-emerald-600">
            <div class="text-sm font-medium text-gray-500">Total Products</div>
            <div class="text-3xl font-bold text-gray-900 mt-2">{{ $totalProducts }}</div>
        </div>

        <!-- Low Stock Items -->
        <div class="bg-white p-6 rounded-lg shadow-sm border-l-4 border-amber-500">
            <div class="text-sm font-medium text-gray-500">Low Stock Items</div>
            <div class="text-3xl font-bold text-amber-600 mt-2">{{ $lowStockCount }}</div>
        </div>

        <!-- Out of Stock -->
        <div class="bg-white p-6 rounded-lg shadow-sm border-l-4 border-red-500">
            <div class="text-sm font-medium text-gray-500">Out of Stock</div>
            <div class="text-3xl font-bold text-red-600 mt-2">{{ $outOfStockCount }}</div>
        </div>

        <!-- Total Inventory Value -->
        <div class="bg-white p-6 rounded-lg shadow-sm border-l-4 border-blue-600">
            <div class="text-sm font-medium text-gray-500">Total Inventory Value</div>
            <div class="text-2xl font-bold text-blue-700 mt-2">₱{{ number_format($totalValue, 2) }}</div>
        </div>

    </div>

    <!-- Recently Added Items Section -->
    <div class="bg-white rounded-lg shadow-sm overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center bg-white">
            <h3 class="text-lg font-bold text-gray-800">Recently Added Items</h3>
            <a href="{{ route('products.index') }}" class="inline-flex items-center px-4 py-2 bg-emerald-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-emerald-700 transition">
                View Full Inventory →
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead>
                    <tr class="bg-emerald-800 text-white text-left text-xs font-semibold uppercase tracking-wider">
                        <th class="px-6 py-3">SKU</th>
                        <th class="px-6 py-3">Product Name</th>
                        <th class="px-6 py-3">Category</th>
                        <th class="px-6 py-3">Quantity</th>
                        <th class="px-6 py-3">Unit Price</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200 text-sm">
                    @forelse($recentProducts as $product)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4 whitespace-nowrap text-gray-700 font-medium">{{ $product->sku }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-900 font-semibold">{{ $product->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-600">{{ $product->category }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($product->quantity <= 0)
                                <span class="px-2.5 py-1 text-xs font-bold leading-5 text-red-700 bg-red-100 rounded-full">0 Out of Stock</span>
                            @elseif($product->quantity <= $product->reorder_level)
                                <span class="px-2.5 py-1 text-xs font-bold leading-5 text-amber-800 bg-amber-100 rounded-full">{{ $product->quantity }} Low Stock</span>
                            @else
                                <span class="text-gray-900 font-medium">{{ $product->quantity }}</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-900 font-medium">₱{{ number_format($product->price, 2) }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-4 text-center text-gray-500">No inventory products found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
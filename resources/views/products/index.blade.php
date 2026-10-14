@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
    <!-- Header Section -->
    <div class="flex justify-between items-center mb-6 bg-white p-6 rounded-lg shadow-sm">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Inventory Products</h1>
            <p class="text-sm text-gray-500">List of all available medicines and health center supplies.</p>
        </div>
        <a href="{{ route('products.create') }}" class="bg-emerald-700 hover:bg-emerald-800 text-white font-semibold py-2 px-4 rounded-md shadow transition">
            + Add New Product
        </a>
    </div>

    <!-- Products Table -->
    <div class="bg-white overflow-hidden shadow-sm rounded-lg border border-gray-200">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-emerald-800 text-white text-sm leading-normal">
                    <th class="py-3 px-6 font-semibold">SKU</th>
                    <th class="py-3 px-6 font-semibold">Product Name</th>
                    <th class="py-3 px-6 font-semibold">Category</th>
                    <th class="py-3 px-6 font-semibold text-center">Quantity</th>
                    <th class="py-3 px-6 font-semibold text-center">Reorder Level</th>
                    <th class="py-3 px-6 font-semibold text-center">Status</th>
                    <th class="py-3 px-6 font-semibold text-right">Price</th>
                </tr>
            </thead>
            <tbody class="text-gray-700 text-sm divide-y divide-gray-200">
                @forelse($products as $product)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="py-4 px-6 font-mono text-xs text-gray-600">{{ $product->sku }}</td>
                        <td class="py-4 px-6 font-semibold text-gray-900">{{ $product->name }}</td>
                        <td class="py-4 px-6">
                            <span class="bg-gray-100 text-gray-700 text-xs px-2.5 py-1 rounded-full border border-gray-300">
                                {{ $product->category ?? 'General' }}
                            </span>
                        </td>
                        <td class="py-4 px-6 text-center font-bold text-base">{{ $product->quantity }}</td>
                        <td class="py-4 px-6 text-center text-gray-500">{{ $product->reorder_level }}</td>
                        <td class="py-4 px-6 text-center">
                            @if($product->quantity <= 0)
                                <span class="bg-red-100 text-red-800 text-xs px-3 py-1 rounded-full font-semibold">Out of Stock</span>
                            @elseif($product->quantity <= $product->reorder_level)
                                <span class="bg-amber-100 text-amber-800 text-xs px-3 py-1 rounded-full font-semibold">Low Stock</span>
                            @else
                                <span class="bg-emerald-100 text-emerald-800 text-xs px-3 py-1 rounded-full font-semibold">In Stock</span>
                            @endif
                        </td>
                        <td class="py-4 px-6 text-right font-medium text-gray-900">₱{{ number_format($product->price, 2) }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="py-8 px-6 text-center text-gray-500">
                            No products found in the inventory.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
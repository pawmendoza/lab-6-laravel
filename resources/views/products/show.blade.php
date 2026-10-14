@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
    
    <!-- Header & Back Button -->
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Product Details: {{ $product->name }}</h1>
            <p class="text-sm text-gray-600">SKU: <span class="font-mono font-semibold">{{ $product->sku }}</span></p>
        </div>
        <a href="{{ route('products.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-700 text-sm font-semibold py-2 px-4 rounded-md transition">
            ← Back to Inventory
        </a>
    </div>

    <!-- Product Info Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
            <p class="text-sm font-medium text-gray-500 uppercase">Category</p>
            <p class="text-lg font-bold text-gray-800 mt-1">{{ $product->category ?? 'General' }}</p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
            <p class="text-sm font-medium text-gray-500 uppercase">Current Quantity</p>
            <p class="text-2xl font-bold text-emerald-700 mt-1">{{ $product->quantity }}</p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
            <p class="text-sm font-medium text-gray-500 uppercase">Unit Price</p>
            <p class="text-2xl font-bold text-gray-800 mt-1">₱{{ number_format($product->price, 2) }}</p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
            <p class="text-sm font-medium text-gray-500 uppercase">Reorder Level</p>
            <p class="text-2xl font-bold text-amber-600 mt-1">{{ $product->reorder_level }}</p>
        </div>
    </div>

    <!-- Transaction History Section with Running Balance -->
    <div class="bg-white shadow-sm rounded-lg border border-gray-200 overflow-hidden">
        <div class="px-6 py-4 bg-emerald-800 text-white flex justify-between items-center">
            <h3 class="font-bold text-lg">Transaction History & Running Balance</h3>
        </div>

        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-100 text-gray-700 text-xs uppercase tracking-wider border-b border-gray-200">
                    <th class="py-3 px-6 font-semibold">Date / Time</th>
                    <th class="py-3 px-6 font-semibold">Type</th>
                    <th class="py-3 px-6 font-semibold">Movement Qty</th>
                    <th class="py-3 px-6 font-semibold">Running Balance</th>
                    <th class="py-3 px-6 font-semibold">Reference #</th>
                    <th class="py-3 px-6 font-semibold">User</th>
                    <th class="py-3 px-6 font-semibold">Notes</th>
                </tr>
            </thead>
            <tbody class="text-gray-700 text-sm divide-y divide-gray-200">
                @php 
                    $runningBalance = 0; 
                @endphp

                @forelse($transactions as $tx)
                    @php
                        // Kalkulahin ang running balance batay sa uri ng transaksyon
                        if ($tx->type === 'Stock_in') {
                            $runningBalance += $tx->quantity;
                        } elseif ($tx->type === 'Stock_out') {
                            $runningBalance -= $tx->quantity;
                        } elseif ($tx->type === 'Adjustment') {
                            $runningBalance = $tx->quantity;
                        }
                    @endphp
                    <tr class="hover:bg-gray-50 transition">
                        <td class="py-4 px-6 text-xs text-gray-500">{{ $tx->created_at->format('Y-m-d H:i:s') }}</td>
                        <td class="py-4 px-6">
                            @if($tx->type === 'Stock_in')
                                <span class="bg-emerald-100 text-emerald-800 text-xs px-2.5 py-0.5 rounded font-semibold">Stock In</span>
                            @elseif($tx->type === 'Stock_out')
                                <span class="bg-red-100 text-red-800 text-xs px-2.5 py-0.5 rounded font-semibold">Stock Out</span>
                            @else
                                <span class="bg-blue-100 text-blue-800 text-xs px-2.5 py-0.5 rounded font-semibold">Adjustment</span>
                            @endif
                        </td>
                        <td class="py-4 px-6 font-bold {{ $tx->type === 'Stock_in' ? 'text-emerald-600' : ($tx->type === 'Stock_out' ? 'text-red-600' : 'text-blue-600') }}">
                            {{ $tx->type === 'Stock_out' ? '-' . $tx->quantity : '+' . $tx->quantity }}
                        </td>
                        <td class="py-4 px-6 font-bold text-gray-800 bg-gray-50">
                            {{ $runningBalance }}
                        </td>
                        <td class="py-4 px-6 font-mono text-xs text-gray-600">{{ $tx->reference_number ?? 'N/A' }}</td>
                        <td class="py-4 px-6 text-xs text-gray-600">{{ $tx->user->name ?? 'System' }}</td>
                        <td class="py-4 px-6 text-xs text-gray-500">{{ $tx->notes ?? 'None' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="py-6 px-6 text-center text-gray-500">No transactions recorded for this product yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
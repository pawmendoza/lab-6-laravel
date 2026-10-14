@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Record New Transaction</h1>
        <p class="text-sm text-gray-600">Record stock movements, stock-ins, stock-outs, or physical inventory adjustments.</p>
    </div>

    <div class="bg-white shadow-sm rounded-lg border border-gray-200 p-6 max-w-2xl">
        <form action="{{ route('transactions.store') }}" method="POST">
            @csrf

            <!-- Product Selection -->
            <div class="mb-4">
                <label for="product_id" class="block text-sm font-medium text-gray-700">Select Product</label>
                <select name="product_id" id="product_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 sm:text-sm" required>
                    <option value="">-- Choose Product --</option>
                    @foreach(\App\Models\Product::all() as $product)
                        <option value="{{ $product->id }}" data-stock="{{ $product->quantity }}">
                            {{ $product->name }} (SKU: {{ $product->sku }}) - Current Stock: {{ $product->quantity }}
                        </option>
                    @endforeach
                </select>
                <!-- Current stock display element for JS -->
                <p id="current-stock-display" class="mt-1 text-xs font-semibold text-emerald-700"></p>
            </div>

            <!-- Transaction Type -->
            <div class="mb-4">
                <label for="type" class="block text-sm font-medium text-gray-700">Transaction Type</label>
                <select name="type" id="type" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 sm:text-sm" required>
                    <option value="Stock_in">Stock In</option>
                    <option value="Stock_out">Stock Out</option>
                    <option value="Adjustment">Adjustment (Physical Count)</option>
                </select>
            </div>

            <!-- Quantity -->
            <div class="mb-4">
                <label for="quantity" class="block text-sm font-medium text-gray-700">Quantity / Physical Count</label>
                <input type="number" name="quantity" id="quantity" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 sm:text-sm" placeholder="Enter quantity or physical count" required>
            </div>

            <!-- Reference Number -->
            <div class="mb-4">
                <label for="reference_number" class="block text-sm font-medium text-gray-700">Reference Number (Optional)</label>
                <input type="text" name="reference_number" id="reference_number" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 sm:text-sm" placeholder="e.g., PO-12345 or Adjust-01">
            </div>

            <!-- Notes -->
            <div class="mb-6">
                <label for="notes" class="block text-sm font-medium text-gray-700">Notes / Reason (Optional)</label>
                <textarea name="notes" id="notes" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 sm:text-sm" placeholder="Add context like damaged goods, physical count discrepancy, etc."></textarea>
            </div>

            <!-- Buttons -->
            <div class="flex justify-end space-x-3">
                <a href="{{ route('transactions.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-700 text-sm font-semibold py-2 px-4 rounded-md transition">
                    Cancel
                </a>
                <button type="submit" class="bg-emerald-800 hover:bg-emerald-900 text-white text-sm font-semibold py-2 px-4 rounded-md transition">
                    Save Transaction
                </button>
            </div>
        </form>
    </div>
</div>

<!-- JavaScript Enhancement for Stock Display -->
<script>
    document.getElementById('product_id')?.addEventListener('change', function() {
        let selectedOption = this.options[this.selectedIndex];
        let currentStock = selectedOption.getAttribute('data-stock');
        let stockDisplay = document.getElementById('current-stock-display');
        if (stockDisplay) {
            stockDisplay.innerText = "Current System Quantity: " + (currentStock || 0);
        }
    });
</script>
@endsection
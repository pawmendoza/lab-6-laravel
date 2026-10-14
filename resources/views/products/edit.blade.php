@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto py-4">
    <div class="bg-white rounded-lg shadow-md p-6">
        <div class="flex justify-between items-center mb-6 border-b pb-4">
            <div>
                <h2 class="text-2xl font-bold text-gray-800">Edit Product: {{ $product->name }}</h2>
                <p class="text-sm text-gray-500">Update the details of this medical supply or medicine.</p>
            </div>
            <a href="{{ route('products.index') }}" class="px-4 py-2 bg-gray-200 text-gray-700 text-sm font-semibold rounded hover:bg-gray-300 transition">
                ← Back to List
            </a>
        </div>

        @if ($errors->any())
            <div class="mb-4 p-4 bg-red-100 border-l-4 border-red-500 text-red-700 rounded">
                <ul class="list-disc pl-5 text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('products.update', $product->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- SKU -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">SKU / Item Code</label>
                    <input type="text" name="sku" value="{{ old('sku', $product->sku) }}" required
                        class="w-full rounded-md border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-800">
                </div>

                <!-- Product Name -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Product Name</label>
                    <input type="text" name="name" value="{{ old('name', $product->name) }}" required
                        class="w-full rounded-md border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-800">
                </div>

                <!-- Category -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Category</label>
                    <input type="text" name="category" value="{{ old('category', $product->category) }}" required
                        class="w-full rounded-md border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-800">
                </div>

                <!-- Unit Price -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Unit Price (₱)</label>
                    <input type="number" step="0.01" name="price" value="{{ old('price', $product->price) }}" required
                        class="w-full rounded-md border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-800">
                </div>

                <!-- Quantity -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Quantity</label>
                    <input type="number" name="quantity" value="{{ old('quantity', $product->quantity) }}" min="0" required
                        class="w-full rounded-md border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-800">
                </div>

                <!-- Reorder Level -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Reorder Level (Low Stock Alert)</label>
                    <input type="number" name="reorder_level" value="{{ old('reorder_level', $product->reorder_level) }}" min="0" required
                        class="w-full rounded-md border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-800">
                </div>
            </div>

            <!-- Description -->
            <div class="mt-6">
                <label class="block text-sm font-medium text-gray-700 mb-1">Description (Optional)</label>
                <textarea name="description" rows="3"
                    class="w-full rounded-md border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-800">{{ old('description', $product->description) }}</textarea>
            </div>

            <!-- Submit Button -->
            <div class="mt-6 flex justify-end space-x-3">
                <a href="{{ route('products.index') }}" class="px-5 py-2.5 bg-gray-200 text-gray-700 rounded-md text-sm font-medium hover:bg-gray-300 transition">
                    Cancel
                </a>
                <button type="submit" class="px-5 py-2.5 bg-emerald-800 text-white rounded-md text-sm font-medium hover:bg-emerald-700 shadow transition">
                    Update Product
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
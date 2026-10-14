@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Transaction Details #{{ $transaction->id }}</h2>

    <div class="card mb-3">
        <div class="card-body">
            <p><strong>Product:</strong> {{ $transaction->product->name ?? 'N/A' }}</p>
            <p><strong>Type:</strong> {{ ucfirst($transaction->type) }}</p>
            <p><strong>Quantity:</strong> {{ $transaction->quantity }}</p>
            <p><strong>Reference Number:</strong> {{ $transaction->reference_number ?? 'None' }}</p>
            <p><strong>Notes:</strong> {{ $transaction->notes ?? 'None' }}</p>
            <p><strong>Performed By:</strong> {{ $transaction->user->name ?? 'N/A' }}</p>
            <p><strong>Date/Time:</strong> {{ $transaction->created_at }}</p>
        </div>
    </div>

    <a href="{{ route('transactions.index') }}" class="btn btn-secondary">Back to List</a>
</div>
@endsection
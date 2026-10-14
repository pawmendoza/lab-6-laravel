@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Inventory Transactions</h2>
    
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('transactions.create') }}" class="btn btn-primary mb-3">Record New Transaction</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Date/Time</th>
                <th>Product Name</th>
                <th>Type</th>
                <th>Quantity</th>
                <th>Reference #</th>
                <th>User</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transactions as $tx)
            <tr>
                <td>{{ $tx->created_at }}</td>
                <td>{{ $tx->product->name ?? 'N/A' }}</td>
                <td>
                    <span class="badge bg-{{ $tx->type == 'stock_in' ? 'success' : ($tx->type == 'stock_out' ? 'danger' : 'info') }}">
                        {{ ucfirst($tx->type) }}
                    </span>
                </td>
                <td>{{ $tx->quantity }}</td>
                <td>{{ $tx->reference_number }}</td>
                <td>{{ $tx->user->name ?? 'N/A' }}</td>
                <td>
                    <a href="{{ route('transactions.show', $tx->id) }}" class="btn btn-sm btn-info">View</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $transactions->links() }}
</div>
@endsection
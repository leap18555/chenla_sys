@extends('layouts.master')

@section('content')
<div class="bg-slate-100 min-h-screen p-6">
    <div class="max-w-3xl mx-auto bg-white p-6 rounded-2xl shadow-sm">

        <h1 class="text-2xl font-bold mb-6">Edit Loan</h1>

        <form action="{{ route('loans.update', $loan->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block text-slate-700 font-semibold mb-1">Customer Name</label>
                <input type="text" name="customer_name" value="{{ old('customer_name', $loan->customer_name) }}"
                       class="w-full border border-slate-300 p-2 rounded-lg" required>
            </div>

            <div class="mb-4">
                <label class="block text-slate-700 font-semibold mb-1">Loan Type</label>
                <input type="text" name="type" value="{{ old('type', $loan->type) }}"
                       class="w-full border border-slate-300 p-2 rounded-lg" required>
            </div>

            <div class="mb-4">
                <label class="block text-slate-700 font-semibold mb-1">Amount</label>
                <input type="number" step="0.01" name="amount" value="{{ old('amount', $loan->amount) }}"
                       class="w-full border border-slate-300 p-2 rounded-lg" required>
            </div>

            <div class="mb-4">
                <label class="block text-slate-700 font-semibold mb-1">Interest Rate (%)</label>
                <input type="number" step="0.01" name="interest_rate" value="{{ old('interest_rate', $loan->interest_rate) }}"
                       class="w-full border border-slate-300 p-2 rounded-lg" required>
            </div>

            <div class="mb-4">
                <label class="block text-slate-700 font-semibold mb-1">Duration (Months)</label>
                <input type="number" name="duration" value="{{ old('duration', $loan->duration) }}"
                       class="w-full border border-slate-300 p-2 rounded-lg" required>
            </div>

            <div class="mb-4">
                <label class="block text-slate-700 font-semibold mb-1">Status</label>
                <select name="status" class="w-full border border-slate-300 p-2 rounded-lg" required>
                    <option value="active" {{ $loan->status === 'active' ? 'selected' : '' }}>Active</option>
                    <option value="pending" {{ $loan->status === 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="paid" {{ $loan->status === 'paid' ? 'selected' : '' }}>Paid</option>
                </select>
            </div>

            <button type="submit" class="bg-blue-700 text-white px-5 py-2.5 rounded-lg font-semibold hover:bg-blue-800 transition">
                Update Loan
            </button>
        </form>
    </div>
</div>
@endsection

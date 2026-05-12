@extends('layouts.master')

@section('content')
<div class="min-h-screen bg-[radial-gradient(ellipse_at_top_right,_var(--tw-gradient-stops))] from-indigo-100 via-slate-50 to-white py-16 px-4">
    <div class="max-w-3xl mx-auto">

        {{-- Back Button --}}
        <a href="{{ route('loans.index') }}" class="inline-flex items-center text-sm font-medium text-indigo-600 hover:text-indigo-700 mb-6 transition-colors group">
            <svg class="w-4 h-4 mr-2 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
            Back to Loan Dashboard
        </a>

        {{-- Header --}}
        <div class="mb-10">
            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800 mb-2">
                Loan Details
            </span>
            <h1 class="text-4xl font-extrabold text-slate-900">Loan Information</h1>
        </div>

        {{-- Card --}}
        <div class="bg-white/80 backdrop-blur-xl border border-white shadow-2xl shadow-slate-200/50 rounded-3xl overflow-hidden">
            <div class="p-8 md:p-12 space-y-6">

                {{-- Customer --}}
                <div>
                    <label class="text-xs text-slate-400 uppercase font-bold">Customer Name</label>
                    <p class="text-lg font-semibold text-slate-800 mt-1">{{ $loan->customer_name }}</p>
                </div>

                {{-- Loan Type --}}
                <div>
                    <label class="text-xs text-slate-400 uppercase font-bold">Loan Type</label>
                    <p class="text-lg font-semibold text-indigo-600 mt-1">{{ $loan->type }}</p>
                </div>

                {{-- Amount --}}
                <div>
                    <label class="text-xs text-slate-400 uppercase font-bold">Amount</label>
                    <p class="text-lg font-semibold text-slate-800 mt-1">
                        {{ $loan->currency === 'KHR' ? '៛' : '$' }}
                        {{ number_format($loan->amount, 2) }}
                    </p>
                </div>

                {{-- Interest --}}
                <div>
                    <label class="text-xs text-slate-400 uppercase font-bold">Interest Rate</label>
                    <p class="text-lg font-semibold text-slate-800 mt-1">
                        {{ $loan->interest_rate }} %
                    </p>
                </div>

                {{-- Duration --}}
                <div>
                    <label class="text-xs text-slate-400 uppercase font-bold">Duration</label>
                    <p class="text-lg font-semibold text-slate-800 mt-1">
                        {{ $loan->duration }} Months
                    </p>
                </div>

                {{-- Created --}}
                <div>
                    <label class="text-xs text-slate-400 uppercase font-bold">Created At</label>
                    <p class="text-lg text-slate-600 mt-1">
                        {{ $loan->created_at->format('d M Y') }}
                    </p>
                </div>

                {{-- Actions --}}
                <div class="pt-8 flex flex-wrap gap-4">

                    <a href="{{ route('loans.edit', $loan->id) }}"
                       class="inline-flex items-center justify-center px-6 py-3 rounded-xl bg-indigo-600 text-white font-semibold hover:bg-indigo-700 transition">
                        Edit Loan
                    </a>

                    <form action="{{ route('loans.destroy', $loan->id) }}" method="POST"
                          onsubmit="return confirm('Are you sure?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="inline-flex items-center justify-center px-6 py-3 rounded-xl bg-red-500 text-white font-semibold hover:bg-red-600 transition">
                            Delete
                        </button>
                    </form>

                </div>

            </div>
        </div>

    </div>
</div>
@endsection
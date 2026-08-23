@extends('layouts.master')

@section('content')
<div class="max-w-7xl mx-auto p-10 bg-[#F9FBFF] min-h-screen font-sans">
    
    <div class="flex justify-between items-center mb-12">
        <div class="flex items-center gap-2">
            <div class="bg-indigo-600 p-2 rounded-lg">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <span class="text-xl font-bold text-slate-800">Chhenla<span class="text-indigo-600">Deposits</span></span>
        </div>

        <a href="{{ route('deposits.create') }}" class="inline-flex items-center gap-2 bg-[#5551FF] hover:bg-indigo-700 text-white px-6 py-2.5 rounded-xl font-bold text-sm transition-all shadow-lg shadow-indigo-200">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
            </svg>
            Add Deposit
        </a>
    </div>

    <div class="mb-8">
        <a href="{{ route('user.Home') }}" class="group flex items-center gap-4 w-fit">
            <div class="w-10 h-10 flex items-center justify-center bg-white border border-gray-200 rounded-xl shadow-sm group-hover:bg-gray-50 transition-all">
                <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
            </div>
            <div>
                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest leading-none mb-1">Back To</p>
                <p class="text-sm font-bold text-slate-700">Dashboard</p>
            </div>
        </a>
    </div>

    <div class="flex flex-col md:flex-row md:items-end justify-between mb-8">
        <div>
            <h1 class="text-4xl font-bold text-slate-900 tracking-tight">Deposits Directory</h1>
            <p class="text-gray-500 mt-2 text-lg">Manage financial records, amounts, and transaction status.</p>
        </div>
        <div class="relative mt-6 md:mt-0">
            <span class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </span>
            <input type="text" placeholder="Search by name or amount..." 
                class="block w-full md:w-80 pl-11 pr-4 py-3 bg-white border border-gray-100 rounded-2xl shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-transparent outline-none text-sm transition-all">
        </div>
    </div>

    <div class="bg-white border border-gray-100 shadow-[0_8px_30px_rgb(0,0,0,0.04)] rounded-[2.5rem] overflow-hidden">
        <table class="min-w-full">
            <thead>
                <tr class="border-b border-gray-50">
                    <th class="px-8 py-6 text-left text-[11px] font-bold text-slate-400 uppercase tracking-[0.1em]">Customer</th>
                    <th class="px-8 py-6 text-left text-[11px] font-bold text-slate-400 uppercase tracking-[0.1em]">Amount</th>
                    <th class="px-8 py-6 text-left text-[11px] font-bold text-slate-400 uppercase tracking-[0.1em]">Date</th>
                    <th class="px-8 py-6 text-left text-[11px] font-bold text-slate-400 uppercase tracking-[0.1em]">Status</th>
                    <th class="px-8 py-6 text-right text-[11px] font-bold text-slate-400 uppercase tracking-[0.1em]">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @forelse($deposits as $deposit)
                <tr class="hover:bg-slate-50/30 transition-colors">
                    <td class="px-8 py-6">
                        <div class="flex items-center gap-4">
                            <div class="w-10 h-10 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center font-bold text-xs">
                                {{ strtoupper(substr($deposit->customer->name, 0, 2)) }}
                            </div>
                            <span class="text-sm font-bold text-slate-800">{{ $deposit->customer->name }}</span>
                        </div>
                    </td>
                    <td class="px-8 py-6 text-sm text-slate-600 font-bold">
                        ${{ number_format($deposit->amount, 2) }}
                    </td>
                    <td class="px-8 py-6">
                        <span class="px-3 py-1 bg-gray-50 text-gray-500 rounded-lg text-[10px] font-bold uppercase tracking-wider border border-gray-100">
                            {{ $deposit->created_at->format('d M Y') }}
                        </span>
                    </td>
                    <td class="px-8 py-6">
                        <div class="flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full {{ $deposit->status == 'completed' ? 'bg-emerald-500' : 'bg-amber-500' }}"></span>
                            <span class="text-sm font-bold {{ $deposit->status == 'completed' ? 'text-emerald-600' : 'text-amber-600' }}">
                                ● {{ ucfirst($deposit->status) }}
                            </span>
                        </div>
                    </td>
                    <td class="px-8 py-6 text-right">
                        <button class="text-slate-300 hover:text-indigo-600 transition-colors">
                            <svg class="w-6 h-6 ml-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0z" /></svg>
                        </button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-8 py-20 text-center text-gray-400 font-medium">
                        No transaction records available.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
@extends('layouts.master')

@section('content')
<div class="bg-slate-50/50 min-h-screen pb-12">
   <div class="bg-white px-6 sm:px-10 py-10 rounded-[2.5rem] border border-slate-100 shadow-[0_20px_60px_rgba(0,0,0,0.03)] mb-10 transition-all">
    
    <div class="max-w-7xl mx-auto">
        <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center gap-8">
            
            <div class="space-y-4">
                <nav class="flex items-center gap-3">
                    <a href="#" class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 hover:text-indigo-600 transition-colors">Dashboard</a>
                    <div class="h-1 w-1 rounded-full bg-slate-300"></div>
                    <span class="text-[10px] font-black uppercase tracking-[0.2em] text-indigo-600">Loan Center</span>
                </nav>

                <div class="space-y-2">
                    <h1 class="text-4xl md:text-5xl font-light text-slate-900 tracking-tight leading-none">
                        Loan <span class="font-black">Management</span>
                    </h1>
                    <p class="text-slate-500 text-sm md:text-base font-medium flex items-center gap-2">
                        <span class="flex h-2 w-2 rounded-full bg-emerald-500 animate-pulse"></span>
                        You have 3 active loans requiring review today.
                    </p>
                </div>
            </div>

            <div class="flex items-center gap-6">
                <div class="hidden sm:block text-right">
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Available Credit</p>
                    <p class="text-xl font-black text-slate-900 leading-tight">$250,000.00</p>
                </div>

                <a href="{{ route('loans.create') }}" 
                   class="group relative inline-flex items-center gap-4 bg-slate-900 px-8 py-5 rounded-2xl font-bold text-white transition-all duration-300 hover:-translate-y-1 hover:shadow-[0_20px_40px_rgba(79,70,229,0.3)] hover:bg-indigo-600 active:scale-95">
                    <div class="flex h-6 w-6 items-center justify-center rounded-lg bg-white/10 transition-transform group-hover:rotate-90">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4.5v15m7.5-7.5h-15" />
                        </svg>
                    </div>
                    <span class="tracking-tight uppercase text-sm">Apply for New Loan</span>
                </a>
            </div>
        </div>

        <div class="mt-12 pt-8 border-t border-slate-50 flex flex-col md:flex-row gap-4 justify-between items-center">
            <div class="flex bg-slate-50 p-1.5 rounded-xl">
                <button class="px-5 py-2 text-sm font-bold rounded-lg bg-white text-slate-900 shadow-sm transition-all">All Loans</button>
                <button class="px-5 py-2 text-sm font-bold text-slate-500 hover:text-slate-700 transition-all">Active</button>
                <button class="px-5 py-2 text-sm font-bold text-slate-500 hover:text-slate-700 transition-all">Pending</button>
                <button class="px-5 py-2 text-sm font-bold text-slate-500 hover:text-slate-700 transition-all">Completed</button>
            </div>

            <div class="relative w-full md:w-72">
                <i class="bi bi-search absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 text-sm"></i>
                <input type="text" 
                       placeholder="Search loans..." 
                       class="w-full pl-11 pr-4 py-3 bg-slate-50 border-none rounded-xl text-sm focus:ring-2 focus:ring-indigo-100 transition-all placeholder:text-slate-400 font-medium">
            </div>
        </div>
    </div>
</div>

    <div class="max-w-7xl mx-auto px-6">
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white p-1 rounded-2xl shadow-sm border border-slate-100 relative overflow-hidden group">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 bg-emerald-50 text-emerald-600 rounded-xl flex items-center justify-center text-xl">
                            <i class="bi bi-check2-circle"></i>
                        </div>
                        <span class="text-xs font-bold text-emerald-600 bg-emerald-50 px-2 py-1 rounded">ACTIVE</span>
                    </div>
                    <p class="text-sm font-medium text-slate-500">Active Balance</p>
                    <h3 class="text-3xl font-bold text-slate-900 mt-1">${{ number_format($activeTotal ?? 0, 2) }}</h3>
                </div>
                <div class="absolute bottom-0 left-0 h-1 bg-emerald-500 w-full transform origin-left scale-x-0 group-hover:scale-x-100 transition-transform duration-500"></div>
            </div>

            <div class="bg-white p-1 rounded-2xl shadow-sm border border-slate-100 relative overflow-hidden group">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 bg-amber-50 text-amber-600 rounded-xl flex items-center justify-center text-xl">
                            <i class="bi bi-clock-history"></i>
                        </div>
                        <span class="text-xs font-bold text-amber-600 bg-amber-50 px-2 py-1 rounded">PENDING</span>
                    </div>
                    <p class="text-sm font-medium text-slate-500">Awaiting Approval</p>
                    <h3 class="text-3xl font-bold text-slate-900 mt-1">${{ number_format($pendingTotal ?? 0, 2) }}</h3>
                </div>
                <div class="absolute bottom-0 left-0 h-1 bg-amber-500 w-full transform origin-left scale-x-0 group-hover:scale-x-100 transition-transform duration-500"></div>
            </div>

            <div class="bg-white p-1 rounded-2xl shadow-sm border border-slate-100 relative overflow-hidden group">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 bg-slate-100 text-slate-600 rounded-xl flex items-center justify-center text-xl">
                            <i class="bi bi-shield-check"></i>
                        </div>
                        <span class="text-xs font-bold text-slate-500 bg-slate-100 px-2 py-1 rounded">SETTLED</span>
                    </div>
                    <p class="text-sm font-medium text-slate-500">Total Paid Off</p>
                    <h3 class="text-3xl font-bold text-slate-900 mt-1">${{ number_format($paidTotal ?? 0, 2) }}</h3>
                </div>
                <div class="absolute bottom-0 left-0 h-1 bg-slate-400 w-full transform origin-left scale-x-0 group-hover:scale-x-100 transition-transform duration-500"></div>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
            <div class="p-6 border-b border-slate-100 flex justify-between items-center bg-slate-50/30">
                <h2 class="text-lg font-bold text-slate-800">Recent Applications</h2>
                <div class="flex gap-2">
                    <button class="p-2 text-slate-400 hover:text-slate-600 transition"><i class="bi bi-filter"></i></button>
                    <button class="p-2 text-slate-400 hover:text-slate-600 transition"><i class="bi bi-search"></i></button>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="text-slate-400 text-xs uppercase tracking-wider">
                            <th class="px-6 py-4 font-semibold">Customer</th>
                            <th class="px-6 py-4 font-semibold">Details</th>
                            <th class="px-6 py-4 font-semibold">Principal</th>
                            <th class="px-6 py-4 font-semibold">Status</th>
                            <th class="px-6 py-4 font-semibold text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($loans as $loan)
                        <tr class="group hover:bg-indigo-50/30 transition-colors">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-full bg-indigo-100 text-indigo-700 flex items-center justify-center font-bold text-xs">
                                        {{ strtoupper(substr($loan->customer_name, 0, 2)) }}
                                    </div>
                                    <span class="font-semibold text-slate-700">{{ $loan->customer_name }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-slate-600">{{ $loan->type ?? 'Personal' }}</div>
                                <div class="text-xs text-slate-400">{{ $loan->duration }} Months @ {{ $loan->interest_rate }}%</div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="font-bold text-slate-800">${{ number_format($loan->amount, 2) }}</span>
                            </td>
                            <td class="px-6 py-4">
                                @if($loan->status === 'active')
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md text-xs font-bold bg-emerald-100 text-emerald-700">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Active
                                    </span>
                                @elseif($loan->status === 'pending')
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md text-xs font-bold bg-amber-100 text-amber-700">
                                        <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span> Pending
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md text-xs font-bold bg-slate-100 text-slate-600">
                                        <span class="w-1.5 h-1.5 rounded-full bg-slate-400"></span> Paid
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex justify-end gap-3 opacity-0 group-hover:opacity-100 transition-opacity">
                                    <a href="{{ route('loans.show', $loan->id) }}" class="p-2 bg-white border border-slate-200 rounded-lg text-slate-600 hover:text-indigo-600 hover:border-indigo-600 shadow-sm transition">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ route('loans.edit', $loan->id) }}" class="p-2 bg-white border border-slate-200 rounded-lg text-slate-600 hover:text-amber-600 hover:border-amber-600 shadow-sm transition">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-slate-400">
                                <i class="bi bi-inbox text-4xl block mb-2 opacity-20"></i>
                                No loan records available.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($loans->hasPages())
            <div class="px-6 py-4 bg-slate-50 border-t border-slate-100">
                {{ $loans->links() }}
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
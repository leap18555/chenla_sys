@extends('layouts.master')

@section('title', 'Pawn Loans | PawnDesk')

@section('content')
<div class="min-h-screen bg-[#fafafa] p-6 lg:p-8">

    <!-- Page Header & Title -->
    <div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <span class="text-[10px] font-bold text-orange-600 bg-orange-50 border border-orange-200/60 px-2.5 py-1 rounded-md uppercase tracking-wider">
                PORTFOLIO MANAGEMENT // គ្រប់គ្រងកិច្ចសន្យា
            </span>
            <h1 class="text-xl font-bold text-slate-800 mt-2">កិច្ចសន្យាបញ្ចាំ (Pawn Loans)</h1>
            <p class="text-xs text-slate-400 font-medium mt-0.5">ព្រហស្បតិ៍ ៤ មិថុនា (Thursday, 4 June)</p>
        </div>

        <a href="{{ route('loans.create') }}" class="inline-flex items-center justify-center gap-2 bg-orange-600 hover:bg-orange-700 text-white font-bold text-xs px-4 py-2.5 rounded-lg shadow-xs transition-all duration-150 active:scale-[0.98] uppercase tracking-wide">
            <i class="bi bi-plus-lg"></i> បង្កើតកិច្ចសន្យាថ្មី (Create Loan)
        </a>
    </div>

    <!-- Main Table Card -->
    <div class="bg-white rounded-xl border border-slate-200/80 shadow-xs overflow-hidden">
        
        <!-- Header Toolbar -->
        <div class="px-6 py-4 border-b border-slate-100 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div class="flex items-center gap-3">
                <h2 class="font-bold text-slate-800 text-sm">
                    ផលប័ត្រប្រាក់កម្ចី (Loan Portfolio)
                </h2>
                <span class="text-xs font-bold text-orange-600 bg-orange-50 border border-orange-100 px-2.5 py-0.5 rounded-md">
                    {{ count($loans) }} បានបង្ហាញ (Shown)
                </span>
            </div>

            <!-- Optional Quick Filters / Search Bar -->
            <div class="flex items-center gap-2">
                <div class="relative">
                    <i class="bi bi-search absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>
                    <input type="text" placeholder="ស្វែងរកកិច្ចសន្យា..." class="w-56 pl-8 pr-3 py-1.5 rounded-lg bg-slate-50 border border-slate-200 focus:outline-none focus:border-orange-500 text-xs text-slate-900 placeholder:text-slate-400 transition-all">
                </div>
            </div>
        </div>

        <!-- Table Container -->
        <div class="overflow-x-auto">
            <table class="w-full min-w-[700px] text-left border-collapse text-xs">
                <thead>
                    <tr class="bg-slate-50/70 border-b border-slate-100 text-slate-400 font-bold uppercase text-[10px] tracking-wider">
                        <th class="px-6 py-3.5 text-left">ប្រាក់កម្ចី (Loan Code)</th>
                        <th class="px-6 py-3.5 text-left">ប្រាក់ដើម (Principal)</th>
                        <th class="px-6 py-3.5 text-left">សមតុល្យនៅសល់ (Balance)</th>
                        <th class="px-6 py-3.5 text-left">លក្ខខណ្ឌ (Terms)</th>
                        <th class="px-6 py-3.5 text-left">ស្ថានភាព (Status)</th>
                        <th class="px-6 py-3.5 text-right">សកម្មភាព (Actions)</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($loans as $loan)
                    <tr class="hover:bg-slate-50/70 transition-colors">
                        
                        <!-- Loan Details & Customer -->
                        <td class="px-6 py-3.5">
                            <div class="space-y-0.5">
                                <p class="font-mono text-xs font-bold text-slate-900">LN-2026-00{{ $loan->id }}</p>
                                <p class="text-[11px] text-slate-500 font-medium">
                                    {{ $loan->customer_name }} <span class="text-slate-300">/</span> <span class="italic text-slate-400">{{ $loan->type ?? 'Equipment' }}</span>
                                </p>
                            </div>
                        </td>

                        <!-- Principal Amount -->
                        <td class="px-6 py-3.5">
                            <span class="text-xs font-bold text-slate-900">${{ number_format($loan->amount, 2) }}</span>
                        </td>

                        <!-- Remaining Balance -->
                        <td class="px-6 py-3.5">
                            <span class="text-xs font-bold text-orange-600">${{ number_format($loan->remaining_balance ?? $loan->amount, 2) }}</span>
                        </td>

                        <!-- Terms & Interest -->
                        <td class="px-6 py-3.5">
                            <div class="space-y-0.5">
                                <p class="text-xs font-bold text-slate-700">
                                    {{ $loan->duration }} 
                                    {{ $loan->frequency === 'weekly' ? 'ប្រចាំសប្តាហ៍' : 'ប្រចាំខែ' }}
                                </p>
                                <p class="text-[10px] text-slate-400 font-medium">{{ number_format($loan->interest_rate, 2) }}% / សមតុល្យថយចុះ</p>
                            </div>
                        </td>

                        <!-- Status Badge -->
                        <td class="px-6 py-3.5">
                            @if($loan->status === 'active')
                                <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-md bg-emerald-50 border border-emerald-200/60 text-emerald-700 text-[10px] font-bold">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> សកម្ម
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-md bg-amber-50 border border-amber-200/60 text-amber-700 text-[10px] font-bold">
                                    <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span> រង់ចាំ
                                </span>
                            @endif
                        </td>

                        <!-- Actions -->
                        <td class="px-6 py-3.5 text-right">
                            <div class="flex items-center justify-end gap-1">
                                <a href="{{ route('loans.show', $loan->id) }}" class="p-1.5 text-slate-400 hover:text-orange-600 rounded-lg hover:bg-orange-50 transition-all" title="View Detail">
                                    <i class="bi bi-file-earmark-text text-sm"></i>
                                </a>
                                <a href="#" class="p-1.5 text-slate-400 hover:text-orange-600 rounded-lg hover:bg-orange-50 transition-all" title="Schedules">
                                    <i class="bi bi-calendar3 text-xs"></i>
                                </a>
                                <a href="{{ route('loans.edit', $loan->id) }}" class="p-1.5 text-slate-400 hover:text-amber-600 rounded-lg hover:bg-amber-50 transition-all" title="Edit">
                                    <i class="bi bi-pencil text-xs"></i>
                                </a>
                                <button class="p-1.5 text-slate-400 hover:text-rose-600 rounded-lg hover:bg-rose-50 transition-all" title="Delete">
                                    <i class="bi bi-trash text-xs"></i>
                                </button>
                            </div>
                        </td>

                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="py-16 text-center">
                            <div class="flex flex-col items-center">
                                <div class="w-12 h-12 rounded-xl bg-orange-50 border border-orange-100 flex items-center justify-center text-orange-400 mb-3">
                                    <i class="bi bi-inbox text-2xl"></i>
                                </div>
                                <p class="text-xs font-bold text-slate-500">គ្មានកំណត់ត្រាប្រាក់កម្ចីទេ</p>
                                <p class="text-[11px] text-slate-400 mt-0.5">No Loan Records Found</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($loans->hasPages())
        <div class="px-6 py-3.5 border-t border-slate-100 bg-slate-50/50">
            {{ $loans->links() }}
        </div>
        @endif

    </div>
</div>
@endsection
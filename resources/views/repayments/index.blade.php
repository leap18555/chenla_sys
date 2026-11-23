@extends('layouts.master')

@section('title', 'គ្រប់គ្រងការសងប្រាក់ | ធនាគារ ចេនឡា')
@section('header_title', 'REPAYMENT MANAGEMENT // ការសងប្រាក់')

@section('content')
@php
    $totalCollected = (float) $repayments->sum('amount_paid');
    $totalPenalty = (float) $repayments->sum('penalty_amount');
    $totalTransactions = $repayments->count();
    $todayCollected = (float) $repayments->filter(function($r) {
        $pDate = is_string($r->payment_date) ? \Carbon\Carbon::parse($r->payment_date) : $r->payment_date;
        return $pDate && $pDate->isToday();
    })->sum('amount_paid');
@endphp

<div x-data="{ 
        search: '', 
        methodFilter: 'all',
        matchesFilter(rowMethod, rowText) {
            const matchesSearch = this.search === '' || rowText.toLowerCase().includes(this.search.toLowerCase());
            const matchesMethod = this.methodFilter === 'all' || rowMethod === this.methodFilter;
            return matchesSearch && matchesMethod;
        }
     }" 
     class="relative min-h-screen bg-[#f4f7f9] font-khmer p-4 sm:p-6 lg:p-8 overflow-hidden antialiased text-slate-800">

    <!-- Subtle Khmer Diamond Pattern Background -->
    <div class="pointer-events-none fixed inset-0 opacity-[0.45] no-print"
         style="background-image: url(&quot;data:image/svg+xml,%3Csvg width='64' height='64' viewBox='0 0 64 64' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' stroke='%23cbd5e1' stroke-width='0.75'%3E%3Cpath d='M32 4 L60 32 L32 60 L4 32 Z'/%3E%3Cpath d='M32 16 L48 32 L32 48 L16 32 Z'/%3E%3Ccircle cx='32' cy='32' r='2.5'/%3E%3C/g%3E%3C/svg%3E&quot;);">
    </div>

    <div class="relative z-10 max-w-7xl mx-auto space-y-6">

        {{-- FLASH MESSAGES & VALIDATION ALERTS --}}
        @if(session('success'))
            <div class="rounded-2xl bg-emerald-50 border border-emerald-200/80 p-4 text-emerald-800 flex items-center justify-between shadow-xs">
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-xl bg-emerald-100 text-emerald-700 flex items-center justify-center shrink-0">
                        <i class="bi bi-check-circle-fill text-lg"></i>
                    </div>
                    <div>
                        <h4 class="font-bold text-xs sm:text-sm">ជោគជ័យ!</h4>
                        <p class="text-xs text-emerald-700 mt-0.5">{{ session('success') }}</p>
                    </div>
                </div>
                <button type="button" onclick="this.parentElement.remove()" class="text-emerald-500 hover:text-emerald-800 p-1">
                    <i class="bi bi-x-lg text-xs"></i>
                </button>
            </div>
        @endif

        {{-- TOP HEADER BAR --}}
        <div class="rounded-2xl bg-white border border-slate-200/80 shadow-[0_4px_20px_rgb(15,41,66,0.03)] overflow-hidden">
            <div class="h-1.5 w-full bg-gradient-to-r from-[#142d42] via-[#1e5158] to-[#4caf7c]"></div>

            <div class="p-5 sm:p-6 flex flex-col md:flex-row md:items-center justify-between gap-4">
                <div class="flex items-start sm:items-center gap-4">
                    <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-[#142d42] to-[#1e5158] text-white flex items-center justify-center font-black text-base shrink-0 shadow-sm">
                        <i class="bi bi-wallet2 text-xl"></i>
                    </div>
                    <div>
                        <div class="flex items-center gap-2 flex-wrap">
                            <h1 class="text-xl sm:text-2xl font-bold text-[#142d42] tracking-tight">
                                គ្រប់គ្រងការសងប្រាក់
                            </h1>
                            <span class="text-xs font-semibold text-slate-400 border-l border-slate-200 pl-2">
                                Repayments & Collections
                            </span>
                        </div>
                        <p class="text-xs sm:text-sm text-slate-500 mt-0.5">
                            ពិនិត្យប្រវត្តិប្រតិបត្តិការសងប្រាក់ តាមដានចំណូលប្រមូលបាន និងគ្រប់គ្រងវិក្កយបត្រទទួលប្រាក់
                        </p>
                    </div>
                </div>

                <div class="flex items-center gap-2.5 flex-wrap">
                    <a href="{{ route('loans.index') }}" 
                       class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl text-xs sm:text-sm font-semibold text-slate-700 bg-white hover:bg-slate-50 border border-slate-300 shadow-xs transition-all active:scale-[0.98]">
                        <i class="bi bi-folder2-open text-slate-500"></i>
                        <span>បញ្ជីកិច្ចសន្យាខ្ចី</span>
                    </a>

                    <a href="{{ route('repayments.create') }}" 
                       class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl text-xs sm:text-sm font-semibold text-white bg-[#059669] hover:bg-[#047857] shadow-sm transition-all active:scale-[0.98]">
                        <i class="bi bi-plus-lg"></i>
                        <span>+ កត់ត្រាការសងប្រាក់ថ្មី</span>
                    </a>
                </div>
            </div>
        </div>

        {{-- 4 STATS METRIC CARDS --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            
            {{-- Card 1: Total Collected --}}
            <div class="rounded-2xl bg-white border border-slate-200/80 p-5 shadow-[0_4px_20px_rgb(15,41,66,0.03)] flex flex-col justify-between">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-semibold text-slate-500">ប្រាក់ប្រមូលបានសរុប</span>
                    <div class="w-9 h-9 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center shadow-xs">
                        <i class="bi bi-cash-stack text-base"></i>
                    </div>
                </div>
                <div class="my-3 flex items-baseline justify-between">
                    <div class="text-2xl font-black text-[#142d42] tracking-tight">
                        ${{ number_format($totalCollected, 2) }}
                    </div>
                    <span class="px-2 py-0.5 text-[11px] font-bold bg-emerald-50 text-emerald-700 rounded-md border border-emerald-100">
                        ជោគជ័យ
                    </span>
                </div>
                <div class="text-[11px] text-slate-400">
                    ទឹកប្រាក់ដើម និងការប្រាក់សរុបដែលបានទទួល
                </div>
            </div>

            {{-- Card 2: Today's Collection --}}
            <div class="rounded-2xl bg-white border border-slate-200/80 p-5 shadow-[0_4px_20px_rgb(15,41,66,0.03)] flex flex-col justify-between">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-semibold text-slate-500">ប្រមូលបានថ្ងៃនេះ</span>
                    <div class="w-9 h-9 rounded-xl bg-teal-50 text-teal-600 flex items-center justify-center shadow-xs">
                        <i class="bi bi-calendar-check text-base"></i>
                    </div>
                </div>
                <div class="my-3 flex items-baseline justify-between">
                    <div class="text-2xl font-black text-teal-700 tracking-tight">
                        ${{ number_format($todayCollected, 2) }}
                    </div>
                    <span class="px-2 py-0.5 text-[11px] font-bold bg-teal-50 text-teal-700 rounded-md border border-teal-100">
                        ថ្ងៃនេះ
                    </span>
                </div>
                <div class="text-[11px] text-slate-400">
                    ប្រតិបត្តិការបង់ប្រាក់ថ្ងៃទី {{ now()->format('d M Y') }}
                </div>
            </div>

            {{-- Card 3: Total Penalty --}}
            <div class="rounded-2xl bg-white border border-slate-200/80 p-5 shadow-[0_4px_20px_rgb(15,41,66,0.03)] flex flex-col justify-between">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-semibold text-slate-500">ប្រាក់ពិន័យសរុប</span>
                    <div class="w-9 h-9 rounded-xl bg-rose-50 text-rose-600 flex items-center justify-center shadow-xs">
                        <i class="bi bi-exclamation-diamond text-base"></i>
                    </div>
                </div>
                <div class="my-3 flex items-baseline justify-between">
                    <div class="text-2xl font-black text-rose-600 tracking-tight">
                        ${{ number_format($totalPenalty, 2) }}
                    </div>
                    <span class="px-2 py-0.5 text-[11px] font-bold bg-rose-50 text-rose-700 rounded-md border border-rose-100">
                        យឺតយ៉ាវ
                    </span>
                </div>
                <div class="text-[11px] text-slate-400">
                    ប្រាក់ពិន័យទូទាត់ហួសកាលកំណត់
                </div>
            </div>

            {{-- Card 4: Total Transactions --}}
            <div class="rounded-2xl bg-white border border-slate-200/80 p-5 shadow-[0_4px_20px_rgb(15,41,66,0.03)] flex flex-col justify-between">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-semibold text-slate-500">ចំនួនប្រតិបត្តិការសរុប</span>
                    <div class="w-9 h-9 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center shadow-xs">
                        <i class="bi bi-receipt text-base"></i>
                    </div>
                </div>
                <div class="my-3 flex items-baseline justify-between">
                    <div class="text-2xl font-black text-[#142d42] tracking-tight">
                        {{ $totalTransactions }} <span class="text-xs font-normal text-slate-500">លើក</span>
                    </div>
                    <span class="px-2 py-0.5 text-[11px] font-bold bg-blue-50 text-blue-700 rounded-md border border-blue-100">
                        វិក្កយបត្រ
                    </span>
                </div>
                <div class="text-[11px] text-slate-400">
                    កត់ត្រាក្នុងប្រព័ន្ធទទួលប្រាក់សង
                </div>
            </div>

        </div>

        {{-- FILTER BADGE IF FILTERED BY LOAN --}}
        @if(request('loan_id'))
            <div class="p-3.5 rounded-xl bg-teal-50 border border-teal-200 flex items-center justify-between text-xs text-teal-800">
                <div class="flex items-center gap-2">
                    <i class="bi bi-funnel-fill text-teal-600"></i>
                    <span>កំពុងបង្ហាញប្រវត្តិសងប្រាក់សម្រាប់កិច្ចសន្យា ID: <b>#{{ request('loan_id') }}</b></span>
                </div>
                <a href="{{ route('repayments.index') }}" class="font-bold text-teal-700 hover:text-teal-900 underline flex items-center gap-1">
                    <i class="bi bi-x-circle"></i> បង្ហាញទាំងអស់
                </a>
            </div>
        @endif

        {{-- REPAYMENTS LEDGER TABLE CARD (FULL WIDTH) --}}
        <div class="bg-white border border-slate-200/80 rounded-2xl shadow-[0_4px_20px_rgb(15,41,66,0.03)] overflow-hidden">
            
            {{-- Table Card Header with Search & Filter Controls --}}
            <div class="p-5 border-b border-slate-100 flex flex-col sm:flex-row sm:items-center justify-between gap-4 bg-gradient-to-r from-slate-50/50 to-white">
                <div>
                    <div class="flex items-center gap-2.5">
                        <h2 class="font-bold text-[#0B2B40] text-base sm:text-lg">បញ្ជីប្រវត្តិសងប្រាក់ (Repayment Logs)</h2>
                        <span class="text-xs font-bold text-teal-700 bg-teal-50 border border-teal-100 px-2.5 py-0.5 rounded-full">
                            {{ $repayments->count() }} ប្រតិបត្តិការ
                        </span>
                    </div>
                    <p class="text-xs text-slate-400 mt-0.5">កំណត់ត្រាការទូទាត់ជាក់ស្តែងទាំងអស់ក្នុងប្រព័ន្ធ</p>
                </div>

                {{-- Search & Controls --}}
                <div class="flex items-center gap-3 w-full sm:w-auto flex-wrap">
                    {{-- Search Input --}}
                    <div class="relative w-full sm:w-64">
                        <i class="bi bi-search absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>
                        <input type="text" 
                               x-model="search"
                               placeholder="ស្វែងរកអតិថិជន, កូដ, វិក្កយបត្រ..." 
                               class="w-full bg-slate-50/80 border border-slate-200 rounded-xl pl-8 pr-3 py-2 text-xs focus:outline-none focus:bg-white focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 text-slate-700 transition">
                    </div>

                    {{-- Method Filter Dropdown --}}
                    <select x-model="methodFilter" 
                            class="bg-slate-50/80 border border-slate-200 rounded-xl px-3 py-2 text-xs focus:outline-none focus:bg-white focus:border-emerald-500 text-slate-700 cursor-pointer font-medium">
                        <option value="all">វិធីសាស្ត្រទាំងអស់</option>
                        <option value="សាច់ប្រាក់">💵 សាច់ប្រាក់</option>
                        <option value="ផ្ទេរតាមធនាគារ">🏦 ផ្ទេរធនាគារ</option>
                        <option value="ប្រាក់ចល័ត">📱 ប្រាក់ចល័ត</option>
                    </select>

                    <a href="{{ route('repayments.create') }}" 
                       class="inline-flex items-center gap-1.5 px-3.5 py-2 rounded-xl text-xs font-bold text-white bg-emerald-600 hover:bg-emerald-700 transition shadow-xs active:scale-95">
                        <i class="bi bi-plus-lg"></i>
                        <span>កត់ត្រាថ្មី</span>
                    </a>
                </div>
            </div>

            {{-- Table Content --}}
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse text-xs sm:text-sm">
                    <thead>
                        <tr class="border-b border-slate-200 bg-slate-50/70 text-[11px] font-bold uppercase tracking-wider text-slate-500">
                            <th class="pl-6 pr-3 py-3.5 text-left">កាលបរិច្ឆេទ</th>
                            <th class="px-4 py-3.5 text-left">កិច្ចសន្យា & អតិថិជន</th>
                            <th class="px-4 py-3.5 text-right font-bold text-emerald-800">ចំនួនទឹកប្រាក់</th>
                            <th class="px-4 py-3.5 text-right text-rose-600">ប្រាក់ពិន័យ</th>
                            <th class="px-4 py-3.5 text-left pl-6">វិធីសាស្ត្រ</th>
                            <th class="px-4 py-3.5 text-left">លេខកូដវិក្កយបត្រ</th>
                            <th class="pl-2 pr-6 py-3.5 text-center w-16 no-print">សកម្មភាព</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-slate-100 text-slate-700 font-medium">
                        @forelse($repayments as $item)
                            @php
                                $loanRef = $item->loan;
                                $cName = $loanRef?->customer?->name ?? $loanRef?->customer_name ?? 'អតិថិជន';
                                $loanCode = $loanRef?->loan_number ?? ('LN-' . str_pad($item->loan_id, 4, '0', STR_PAD_LEFT));
                                $pDate = is_string($item->payment_date) ? \Carbon\Carbon::parse($item->payment_date) : $item->payment_date;
                                $searchString = strtolower($cName . ' ' . $loanCode . ' ' . $item->receipt_code . ' ' . $item->payment_method . ' ' . $item->notes);
                            @endphp

                            <tr x-show="matchesFilter('{{ $item->payment_method }}', '{{ addslashes($searchString) }}')"
                                class="hover:bg-slate-50/80 transition-colors">
                                
                                {{-- Date --}}
                                <td class="pl-6 pr-3 py-4 whitespace-nowrap">
                                    <div class="flex items-center gap-1.5">
                                        <i class="bi bi-calendar-event text-slate-400 text-xs"></i>
                                        <span class="font-semibold text-slate-800">
                                            {{ $pDate ? $pDate->format('d M Y') : '-' }}
                                        </span>
                                    </div>
                                    <div class="text-[11px] text-slate-400 font-mono mt-0.5">
                                        {{ $item->created_at ? $item->created_at->format('h:i A') : '' }}
                                    </div>
                                </td>

                                {{-- Loan & Customer --}}
                                <td class="px-4 py-4">
                                    <div class="flex items-center gap-2.5">
                                        <div class="w-8 h-8 rounded-xl bg-teal-50 text-teal-700 font-bold text-xs flex items-center justify-center shrink-0">
                                            {{ mb_substr($cName, 0, 1, 'UTF-8') }}
                                        </div>
                                        <div>
                                            <div class="font-bold text-slate-900 leading-tight">
                                                {{ $cName }}
                                            </div>
                                            <div class="text-[11px] text-slate-400 font-medium flex items-center gap-1.5 mt-0.5">
                                                <span class="font-mono text-teal-700 font-semibold">{{ $loanCode }}</span>
                                                @if($item->notes)
                                                    <span>•</span>
                                                    <span class="truncate max-w-[140px] text-slate-400 italic" title="{{ $item->notes }}">{{ $item->notes }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </td>

                                {{-- Amount Paid --}}
                                <td class="px-4 py-4 text-right font-black text-emerald-700 whitespace-nowrap text-sm">
                                    +${{ number_format($item->amount_paid, 2) }}
                                </td>

                                {{-- Penalty --}}
                                <td class="px-4 py-4 text-right whitespace-nowrap">
                                    @if($item->penalty_amount > 0)
                                        <span class="font-bold text-rose-600 bg-rose-50 px-2 py-0.5 rounded text-xs border border-rose-100">
                                            ${{ number_format($item->penalty_amount, 2) }}
                                        </span>
                                    @else
                                        <span class="text-slate-400 text-xs">$0.00</span>
                                    @endif
                                </td>

                                {{-- Method --}}
                                <td class="px-4 py-4 pl-6 whitespace-nowrap">
                                    @if(str_contains($item->payment_method, 'សាច់ប្រាក់') || str_contains($item->payment_method, 'Cash'))
                                        <span class="inline-flex items-center gap-1 px-2.5 py-1 text-[11px] font-semibold bg-emerald-50 text-emerald-700 rounded-md border border-emerald-100">
                                            <i class="bi bi-cash"></i> សាច់ប្រាក់
                                        </span>
                                    @elseif(str_contains($item->payment_method, 'ធនាគារ') || str_contains($item->payment_method, 'Bank'))
                                        <span class="inline-flex items-center gap-1 px-2.5 py-1 text-[11px] font-semibold bg-blue-50 text-blue-700 rounded-md border border-blue-100">
                                            <i class="bi bi-bank"></i> ធនាគារ
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1 px-2.5 py-1 text-[11px] font-semibold bg-purple-50 text-purple-700 rounded-md border border-purple-100">
                                            <i class="bi bi-qr-code-scan"></i> ចល័ត
                                        </span>
                                    @endif
                                </td>

                                {{-- Receipt Code --}}
                                <td class="px-4 py-4 whitespace-nowrap">
                                    <span class="font-mono text-xs font-semibold text-slate-600 bg-slate-100 px-2.5 py-1 rounded-md">
                                        {{ $item->receipt_code }}
                                    </span>
                                </td>

                                {{-- Actions (View Loan Schedule) --}}
                                <td class="pl-2 pr-6 py-4 text-center no-print whitespace-nowrap">
                                    <a href="{{ route('loans.show', $item->loan_id) }}" 
                                       class="w-8 h-8 rounded-xl inline-flex items-center justify-center bg-slate-100 hover:bg-[#0B2B40] text-slate-600 hover:text-white transition-all shadow-xs" 
                                       title="មើលកាលវិភាគ & ព័ត៌មានលម្អិតកម្ចី">
                                        <i class="bi bi-arrow-up-right text-xs"></i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-12 text-slate-400">
                                    <div class="w-12 h-12 rounded-2xl bg-slate-100 text-slate-400 flex items-center justify-center mx-auto mb-2 text-xl">
                                        <i class="bi bi-inbox"></i>
                                    </div>
                                    <p class="font-bold text-slate-700 text-sm">មិនទាន់មានទិន្នន័យបញ្ជីសងប្រាក់នៅឡើយទេ</p>
                                    <p class="text-xs text-slate-400 mt-1">សូមចុចប៊ូតុងខាងក្រោមដើម្បីកត់ត្រាការសងប្រាក់ដំបូង។</p>
                                    <div class="mt-4">
                                        <a href="{{ route('repayments.create') }}" 
                                           class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl text-xs font-bold text-white bg-emerald-600 hover:bg-emerald-700 transition shadow-xs">
                                            <i class="bi bi-plus-lg"></i>
                                            <span>កត់ត្រាការសងប្រាក់ឥឡូវនេះ</span>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Table Summary Footer --}}
            <div class="p-4 bg-slate-50/70 border-t border-slate-100 flex flex-col sm:flex-row sm:items-center justify-between text-xs text-slate-500 gap-2">
                <div class="flex items-center gap-2">
                    <i class="bi bi-info-circle text-teal-600"></i>
                    <span>ទឹកប្រាក់ដែលទទួលបានត្រូវបានកាត់កងដោយស្វ័យប្រវត្តិពីសមតុល្យកិច្ចសន្យាកម្ចី។</span>
                </div>
                <div class="font-bold text-slate-700">
                    សរុបបានបង្ហាញ: {{ $repayments->count() }} ប្រតិបត្តិការ
                </div>
            </div>

        </div>

    </div>
</div>
@endsection

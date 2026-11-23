@extends('layouts.master')

@section('title', 'ព័ត៌មានលម្អិតកិច្ចសន្យាខ្ចី | ធនាគារ ចេនឡា')

@section('content')
@php
    $customer = $loan->customer;
    $customerName = $customer->name ?? $loan->customer_name ?? 'អតិថិជន';
    $loanCode = $loan->loan_number ?? ('LN-' . date('Y') . '-' . str_pad($loan->id, 4, '0', STR_PAD_LEFT));
    
    $principal = (float) ($loan->amount ?? 0);
    $annualRate = (float) ($loan->interest_rate ?? 0);
    $monthlyRate = ($annualRate / 100) / 12;
    $months = max(1, (int) floor($loan->duration ?? 1));

    if ($monthlyRate > 0) {
        $monthlyPayment = $principal * ($monthlyRate * pow(1 + $monthlyRate, $months)) / (pow(1 + $monthlyRate, $months) - 1);
    } else {
        $monthlyPayment = $principal / max($months, 1);
    }

    $currencySymbol = ($loan->currency === 'KHR' || $loan->currency === '៛') ? '៛' : '$';
    $totalPayment = $monthlyPayment * $months;
    $totalInterest = max(0, $totalPayment - $principal);
    
    // Calculate paid amount from Repayment transactions safely
    $paidAmount = 0;
    try {
        $paidAmount = (float) \App\Models\Repayment::where('loan_id', $loan->id)->sum('amount_paid');
    } catch (\Exception $e) {
        $paidAmount = 0;
    }
    $remainingBalance = max(0, $principal - $paidAmount);
    $paidPercent = $principal > 0 ? min(100, round(($paidAmount / $principal) * 100, 1)) : 0;

    $startDate = $loan->start_date ? \Carbon\Carbon::parse($loan->start_date) : ($loan->created_at ?? now());
    $maturityDate = $startDate->copy()->addMonths($months);

    // Determine the next unpaid installment
    $nextDueInstallment = 1;
    for ($checkIdx = 1; $checkIdx <= $months; $checkIdx++) {
        if ($paidAmount < ($monthlyPayment * $checkIdx - 0.05)) {
            $nextDueInstallment = $checkIdx;
            break;
        }
    }
    $nextDueDate = $startDate->copy()->addMonths($nextDueInstallment)->format('Y-m-d');
@endphp

<div x-data="{
        showPayModal: false,
        modalMonth: {{ $nextDueInstallment }},
        modalAmount: '{{ number_format($monthlyPayment, 2, '.', '') }}',
        modalDate: '{{ $nextDueDate }}',
        modalNotes: 'បង់ប្រាក់រំលស់ប្រចាំខែ លើកទី {{ $nextDueInstallment }}',
        openPayModal(monthNum, amount, date) {
            this.modalMonth = monthNum;
            this.modalAmount = amount;
            this.modalDate = date;
            this.modalNotes = 'បង់ប្រាក់រំលស់ប្រចាំខែ លើកទី ' + monthNum;
            this.showPayModal = true;
        }
     }">

    <div class="max-w-7xl mx-auto space-y-6">

    <!-- PRINT ONLY HEADER -->
    <div class="hidden print-only mb-6 border-b-2 border-slate-800 pb-4">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-bold text-slate-900">ធនាគារ ចេនឡា (CHHENLA BANK)</h1>
                <p class="text-xs text-slate-600">កាលវិភាគសងប្រាក់កម្ចីផ្លូវការ | Official Amortization Schedule</p>
            </div>
            <div class="text-right text-xs text-slate-500">
                <p>កាលបរិច្ឆេទបោះពុម្ព: <span class="font-semibold text-slate-800">{{ now()->format('d M Y, h:i A') }}</span></p>
                <p>លេខកូដកិច្ចសន្យា: <span class="font-bold text-slate-800">{{ $loanCode }}</span></p>
            </div>
        </div>
    </div>

        {{-- FLASH SUCCESS MESSAGE --}}
        @if(session('success'))
            <div class="no-print rounded-2xl bg-emerald-50 border border-emerald-200/80 p-4 text-emerald-800 flex items-center justify-between shadow-xs">
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

        {{-- TOP ACTION BAR / BREADCRUMB NAVIGATION --}}
        <div class="no-print bg-white rounded-2xl border border-slate-200/80 shadow-[0_4px_20px_rgb(15,41,66,0.03)] p-4 sm:p-5 flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div class="flex items-center gap-3">
                <a href="{{ route('loans.index') }}" 
                   class="w-10 h-10 rounded-xl bg-slate-50 hover:bg-slate-100 border border-slate-200/80 flex items-center justify-center text-slate-600 hover:text-slate-900 transition-all active:scale-95 shadow-xs"
                   title="ត្រឡប់ទៅកាន់បញ្ជីកិច្ចសន្យា">
                    <i class="bi bi-arrow-left text-base"></i>
                </a>
                <div>
                    <div class="flex items-center gap-2 flex-wrap">
                        <span class="text-xs font-semibold text-slate-400">កិច្ចសន្យាខ្ចី</span>
                        <i class="bi bi-chevron-right text-[10px] text-slate-300"></i>
                        <span class="text-xs font-bold text-teal-700 bg-teal-50 px-2 py-0.5 rounded-md border border-teal-100">
                            {{ $loanCode }}
                        </span>
                        <i class="bi bi-chevron-right text-[10px] text-slate-300"></i>
                        <span class="text-xs font-medium text-slate-600">ព័ត៌មានលម្អិត & កាលវិភាគ</span>
                    </div>
                    <h1 class="text-lg sm:text-xl font-bold text-[#0B2B40] mt-0.5 flex items-center gap-2">
                        <span>តារាងសងប្រាក់ និងព័ត៌មានលម្អិតកម្ចី</span>
                    </h1>
                </div>
            </div>

            {{-- Action Buttons --}}
            <div class="flex items-center gap-2.5 flex-wrap">
                {{-- Quick Add Monthly Repayment Button --}}
                <button type="button"
                        @click="openPayModal({{ $nextDueInstallment }}, '{{ number_format($monthlyPayment, 2, '.', '') }}', '{{ $nextDueDate }}')" 
                        class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl text-xs sm:text-sm font-bold text-white bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-emerald-700 hover:to-teal-700 shadow-md shadow-emerald-700/10 transition-all active:scale-95">
                    <i class="bi bi-cash-stack text-sm"></i>
                    <span>បង់ប្រាក់ប្រចាំខែ ({{ $currencySymbol }}{{ number_format($monthlyPayment, 2) }})</span>
                </button>

                <button onclick="window.print()" 
                        class="inline-flex items-center gap-2 px-3.5 py-2.5 rounded-xl text-xs sm:text-sm font-semibold text-slate-700 bg-white hover:bg-slate-50 border border-slate-200 shadow-xs transition-all active:scale-95">
                    <i class="bi bi-printer text-slate-600"></i>
                    <span>បោះពុម្ព</span>
                </button>

                <a href="{{ route('repayments.index', ['loan_id' => $loan->id, 'amount' => number_format($monthlyPayment, 2, '.', '')]) }}" 
                   class="inline-flex items-center gap-2 px-3.5 py-2.5 rounded-xl text-xs sm:text-sm font-semibold text-slate-700 bg-slate-50 hover:bg-slate-100 border border-slate-200 transition-all active:scale-95"
                   title="ទៅកាន់ទំព័រ Repayments">
                    <i class="bi bi-wallet2 text-[#0F4C5C]"></i>
                    <span>ប្រវត្តិសង</span>
                </a>

                <a href="{{ route('loans.edit', $loan->id) }}" 
                   class="inline-flex items-center gap-2 px-3.5 py-2.5 rounded-xl text-xs sm:text-sm font-semibold text-slate-700 bg-white hover:bg-slate-50 border border-slate-200 transition-all active:scale-95">
                    <i class="bi bi-pencil text-amber-600"></i>
                    <span>កែប្រែ</span>
                </a>

                <form action="{{ route('loans.destroy', $loan->id) }}" method="POST" onsubmit="return confirm('តើអ្នកពិតជាចង់លុបកិច្ចសន្យាខ្ចីនេះមែនទេ?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" 
                            class="inline-flex items-center gap-1.5 px-3 py-2.5 rounded-xl text-xs sm:text-sm font-semibold text-rose-600 hover:text-white bg-rose-50 hover:bg-rose-600 border border-rose-200/60 transition-all active:scale-95"
                            title="លុបកិច្ចសន្យានេះ">
                        <i class="bi bi-trash3"></i>
                    </button>
                </form>
            </div>
        </div>

        {{-- CUSTOMER PROFILE & LOAN OVERVIEW HERO CARD --}}
        <div class="rounded-2xl bg-white border border-slate-200/80 shadow-[0_4px_20px_rgb(15,41,66,0.03)] overflow-hidden">
            {{-- Top Accent Brand Gradient --}}
            <div class="h-1.5 w-full bg-gradient-to-r from-[#142d42] via-[#1e5158] to-[#4caf7c]"></div>

            <div class="p-6">
                <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-6">
                    
                    {{-- Customer Identity Section --}}
                    <div class="flex items-start sm:items-center gap-4">
                        <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-[#142d42] to-[#1e5158] text-white flex items-center justify-center font-bold text-xl shadow-md shrink-0 ring-4 ring-slate-100">
                            {{ mb_substr($customerName, 0, 2, 'UTF-8') }}
                        </div>
                        <div class="space-y-1">
                            <div class="flex items-center gap-2.5 flex-wrap">
                                <h2 class="text-xl sm:text-2xl font-bold text-[#142d42] tracking-tight">
                                    {{ $customerName }}
                                </h2>

                                {{-- Loan Status Pill --}}
                                @if(strtolower($loan->status ?? 'active') === 'active')
                                    <span class="inline-flex items-center gap-1.5 px-3 py-0.5 rounded-full text-xs font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                        <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                                        សកម្ម (Active)
                                    </span>
                                @elseif(strtolower($loan->status ?? '') === 'paid' || strtolower($loan->status ?? '') === 'closed')
                                    <span class="inline-flex items-center gap-1.5 px-3 py-0.5 rounded-full text-xs font-bold bg-blue-50 text-blue-700 border border-blue-200">
                                        <i class="bi bi-check-circle-fill text-xs text-blue-500"></i>
                                        បានទូទាត់រួច (Paid)
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 px-3 py-0.5 rounded-full text-xs font-bold bg-amber-50 text-amber-700 border border-amber-200">
                                        <span class="w-2 h-2 rounded-full bg-amber-500"></span>
                                        រង់ចាំ (Pending)
                                    </span>
                                @endif

                                <span class="text-xs font-medium bg-slate-100 text-slate-600 px-2.5 py-0.5 rounded-md border border-slate-200">
                                    {{ $loan->currency ?? 'USD' }}
                                </span>
                            </div>

                            <div class="flex items-center gap-4 text-xs text-slate-500 flex-wrap">
                                <span class="flex items-center gap-1.5">
                                    <i class="bi bi-upc-scan text-slate-400"></i>
                                    កូដកម្ចី: <span class="font-semibold text-slate-700">{{ $loanCode }}</span>
                                </span>
                                @if($customer && $customer->phone)
                                    <span class="flex items-center gap-1.5">
                                        <i class="bi bi-telephone text-slate-400"></i>
                                        <span>{{ $customer->phone }}</span>
                                    </span>
                                @endif
                                @if($customer && $customer->id_number)
                                    <span class="flex items-center gap-1.5">
                                        <i class="bi bi-person-vcard text-slate-400"></i>
                                        អត្តសញ្ញាណប័ណ្ណ: <span class="font-medium text-slate-700">{{ $customer->id_number }}</span>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    {{-- Loan Meta Badges Group --}}
                    <div class="grid grid-cols-2 sm:grid-cols-3 gap-3 border-t lg:border-t-0 lg:border-l border-slate-100 pt-4 lg:pt-0 lg:pl-6">
                        <div class="p-2.5 rounded-xl bg-slate-50/80 border border-slate-100">
                            <span class="block text-[11px] text-slate-400 font-medium">ប្រភេទកម្ចី</span>
                            <span class="text-xs font-bold text-slate-800">{{ $loan->type ?? 'កម្ចីបុគ្គល' }}</span>
                        </div>
                        <div class="p-2.5 rounded-xl bg-slate-50/80 border border-slate-100">
                            <span class="block text-[11px] text-slate-400 font-medium">គោលបំណងកម្ចី</span>
                            <span class="text-xs font-bold text-slate-800 truncate block">{{ $loan->purpose ?? 'ពង្រីកអាជីវកម្ម' }}</span>
                        </div>
                        <div class="p-2.5 rounded-xl bg-slate-50/80 border border-slate-100">
                            <span class="block text-[11px] text-slate-400 font-medium">កាលបរិច្ឆេទចាប់ផ្តើម</span>
                            <span class="text-xs font-bold text-slate-800">{{ $startDate->format('d M Y') }}</span>
                        </div>
                        <div class="p-2.5 rounded-xl bg-slate-50/80 border border-slate-100">
                            <span class="block text-[11px] text-slate-400 font-medium">កាលកំណត់បញ្ចប់</span>
                            <span class="text-xs font-bold text-slate-800">{{ $maturityDate->format('d M Y') }}</span>
                        </div>
                        <div class="p-2.5 rounded-xl bg-slate-50/80 border border-slate-100">
                            <span class="block text-[11px] text-slate-400 font-medium">វិធីសាស្ត្រគណនា</span>
                            <span class="text-xs font-bold text-emerald-700">សមតុល្យថយចុះ</span>
                        </div>
                        <div class="p-2.5 rounded-xl bg-slate-50/80 border border-slate-100">
                            <span class="block text-[11px] text-slate-400 font-medium">ប្រេកង់នៃការបង់</span>
                            <span class="text-xs font-bold text-slate-800">{{ $loan->frequency ?? 'ប្រចាំខែ' }}</span>
                        </div>
                    </div>
                </div>

                {{-- Visual Repayment Progress Bar --}}
                <div class="mt-6 pt-5 border-t border-slate-100">
                    <div class="flex items-center justify-between text-xs mb-2">
                        <span class="font-medium text-slate-500 flex items-center gap-1.5">
                            <i class="bi bi-pie-chart text-emerald-600"></i>
                            វឌ្ឍនភាពនៃការសងប្រាក់ដើម
                        </span>
                        <div class="flex items-center gap-2">
                            <span class="font-bold text-emerald-700">{{ $paidPercent }}% បានសងរួច</span>
                            <span class="text-slate-300">|</span>
                            <span class="text-slate-500 font-medium">នៅសល់ {{ 100 - $paidPercent }}%</span>
                        </div>
                    </div>
                    <div class="w-full bg-slate-100 rounded-full h-2.5 overflow-hidden p-0.5">
                        <div class="bg-gradient-to-r from-emerald-500 to-teal-500 h-1.5 rounded-full transition-all duration-500" 
                             style="width: {{ max(4, $paidPercent) }}%"></div>
                    </div>
                </div>
            </div>
        </div>

        {{-- 8 KEY FINANCIAL METRIC CARDS --}}
        <div>
            <div class="flex items-center justify-between mb-3 px-1">
                <h3 class="text-sm font-bold text-slate-700 flex items-center gap-2">
                    <i class="bi bi-grid-fill text-teal-600"></i>
                    <span>សូចនាករហិរញ្ញវត្ថុសង្ខេប</span>
                </h3>
                <span class="text-xs text-slate-400">អត្រាគិតជា {{ $currencySymbol }} ({{ $loan->currency ?? 'USD' }})</span>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                
                {{-- 1. Principal Amount --}}
                <div class="rounded-2xl bg-white border border-slate-200/80 p-5 shadow-[0_4px_20px_rgb(15,41,66,0.03)] hover:border-slate-300 transition-all flex flex-col justify-between">
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-semibold text-slate-500">ប្រាក់ដើមកម្ចី (Principal)</span>
                        <div class="w-9 h-9 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center shadow-xs">
                            <i class="bi bi-cash-coin text-base"></i>
                        </div>
                    </div>
                    <div class="my-3">
                        <div class="text-2xl font-black text-[#142d42] tracking-tight">
                            {{ $currencySymbol }}{{ number_format($principal, 2) }}
                        </div>
                    </div>
                    <div class="text-[11px] text-slate-400 flex items-center gap-1">
                        <i class="bi bi-check-circle text-emerald-500"></i>
                        <span>ដើមទុនកម្ចីដែលបានអនុម័ត</span>
                    </div>
                </div>

                {{-- 2. Interest Rate --}}
                <div class="rounded-2xl bg-white border border-slate-200/80 p-5 shadow-[0_4px_20px_rgb(15,41,66,0.03)] hover:border-slate-300 transition-all flex flex-col justify-between">
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-semibold text-slate-500">អត្រាការប្រាក់ (Rate)</span>
                        <div class="w-9 h-9 rounded-xl bg-teal-50 text-teal-600 flex items-center justify-center shadow-xs">
                            <i class="bi bi-percent text-base"></i>
                        </div>
                    </div>
                    <div class="my-3">
                        <div class="text-2xl font-black text-[#142d42] tracking-tight">
                            {{ number_format($loan->interest_rate, 2) }}%
                        </div>
                    </div>
                    <div class="text-[11px] text-teal-700 font-medium flex items-center gap-1">
                        <i class="bi bi-graph-down text-teal-500"></i>
                        <span>ក្នុងមួយឆ្នាំ (សមតុល្យថយចុះ)</span>
                    </div>
                </div>

                {{-- 3. Duration --}}
                <div class="rounded-2xl bg-white border border-slate-200/80 p-5 shadow-[0_4px_20px_rgb(15,41,66,0.03)] hover:border-slate-300 transition-all flex flex-col justify-between">
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-semibold text-slate-500">រយៈពេលសង (Duration)</span>
                        <div class="w-9 h-9 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center shadow-xs">
                            <i class="bi bi-calendar3 text-base"></i>
                        </div>
                    </div>
                    <div class="my-3">
                        <div class="text-2xl font-black text-[#142d42] tracking-tight">
                            {{ $months }} <span class="text-base font-normal text-slate-500">ខែ</span>
                        </div>
                    </div>
                    <div class="text-[11px] text-slate-400 flex items-center gap-1">
                        <i class="bi bi-clock-history"></i>
                        <span>បង់រៀងរាល់ខែ (សរុប {{ $months }} លើក)</span>
                    </div>
                </div>

                {{-- 4. Monthly Payment --}}
                <div class="rounded-2xl bg-gradient-to-br from-emerald-500/10 via-teal-500/5 to-white border-2 border-emerald-500/30 p-5 shadow-[0_4px_20px_rgb(16,185,129,0.06)] flex flex-col justify-between">
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-bold text-emerald-800">ត្រូវបង់ប្រចាំខែ (Monthly)</span>
                        <div class="w-9 h-9 rounded-xl bg-emerald-600 text-white flex items-center justify-center shadow-sm">
                            <i class="bi bi-wallet-fill text-base"></i>
                        </div>
                    </div>
                    <div class="my-3">
                        <div class="text-2xl font-black text-emerald-800 tracking-tight">
                            {{ $currencySymbol }}{{ number_format($monthlyPayment, 2) }}
                        </div>
                    </div>
                    <div class="text-[11px] text-emerald-700 font-semibold flex items-center gap-1">
                        <i class="bi bi-info-circle"></i>
                        <span>ប្រាក់ដើម + ការប្រាក់ក្នុងមួយខែ</span>
                    </div>
                </div>

                {{-- 5. Total Interest --}}
                <div class="rounded-2xl bg-white border border-slate-200/80 p-5 shadow-[0_4px_20px_rgb(15,41,66,0.03)] hover:border-slate-300 transition-all flex flex-col justify-between">
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-semibold text-slate-500">ការប្រាក់សរុប (Total Interest)</span>
                        <div class="w-9 h-9 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center shadow-xs">
                            <i class="bi bi-graph-up-arrow text-base"></i>
                        </div>
                    </div>
                    <div class="my-3">
                        <div class="text-2xl font-black text-[#142d42] tracking-tight">
                            {{ $currencySymbol }}{{ number_format($totalInterest, 2) }}
                        </div>
                    </div>
                    <div class="text-[11px] text-slate-400">
                        ចំណេញការប្រាក់សរុបគ្រប់គ្រា
                    </div>
                </div>

                {{-- 6. Total Payment --}}
                <div class="rounded-2xl bg-white border border-slate-200/80 p-5 shadow-[0_4px_20px_rgb(15,41,66,0.03)] hover:border-slate-300 transition-all flex flex-col justify-between">
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-semibold text-slate-500">ទឹកប្រាក់សរុប (Total Payable)</span>
                        <div class="w-9 h-9 rounded-xl bg-purple-50 text-purple-600 flex items-center justify-center shadow-xs">
                            <i class="bi bi-receipt-cutoff text-base"></i>
                        </div>
                    </div>
                    <div class="my-3">
                        <div class="text-2xl font-black text-[#142d42] tracking-tight">
                            {{ $currencySymbol }}{{ number_format($totalPayment, 2) }}
                        </div>
                    </div>
                    <div class="text-[11px] text-slate-400">
                        ប្រាក់ដើមបូកការប្រាក់សរុប
                    </div>
                </div>

                {{-- 7. Paid Amount --}}
                <div class="rounded-2xl bg-white border border-slate-200/80 p-5 shadow-[0_4px_20px_rgb(15,41,66,0.03)] hover:border-slate-300 transition-all flex flex-col justify-between">
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-semibold text-slate-500">បានសងរួច (Paid Amount)</span>
                        <div class="w-9 h-9 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center shadow-xs">
                            <i class="bi bi-check2-circle text-base"></i>
                        </div>
                    </div>
                    <div class="my-3">
                        <div class="text-2xl font-black text-emerald-700 tracking-tight">
                            {{ $currencySymbol }}{{ number_format($paidAmount, 2) }}
                        </div>
                    </div>
                    <div class="text-[11px] text-slate-400">
                        បានកត់ត្រាក្នុងប្រព័ន្ធទទួលប្រាក់សង
                    </div>
                </div>

                {{-- 8. Remaining Balance --}}
                <div class="rounded-2xl bg-white border border-slate-200/80 p-5 shadow-[0_4px_20px_rgb(15,41,66,0.03)] hover:border-slate-300 transition-all flex flex-col justify-between">
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-semibold text-slate-500">សមតុល្យនៅសល់ (Remaining)</span>
                        <div class="w-9 h-9 rounded-xl bg-rose-50 text-rose-600 flex items-center justify-center shadow-xs">
                            <i class="bi bi-hourglass-split text-base"></i>
                        </div>
                    </div>
                    <div class="my-3">
                        <div class="text-2xl font-black text-rose-600 tracking-tight">
                            {{ $currencySymbol }}{{ number_format($remainingBalance, 2) }}
                        </div>
                    </div>
                    <div class="text-[11px] text-slate-400">
                        សមតុល្យប្រាក់ដើមនៅសល់បច្ចុប្បន្ន
                    </div>
                </div>

            </div>
        </div>

        {{-- REPAYMENT SCHEDULE TABLE CONTAINER --}}
        <div class="bg-white rounded-2xl border border-slate-200/80 shadow-[0_8px_30px_rgb(15,41,66,0.04)] overflow-hidden">
            
            {{-- Table Card Header --}}
            <div class="p-5 sm:p-6 border-b border-slate-100 flex flex-col sm:flex-row sm:items-center justify-between gap-3 bg-gradient-to-r from-slate-50/50 to-white">
                <div>
                    <h3 class="text-base sm:text-lg font-bold text-[#0B2B40] flex items-center gap-2">
                        <i class="bi bi-calendar4-week text-[#0F4C5C]"></i>
                        <span>តារាងកាលវិភាគសងប្រាក់លម្អិត</span>
                    </h3>
                    <p class="text-xs text-slate-400 mt-0.5">
                        គណនាតាមរូបមន្តសមតុល្យថយចុះ (Reducing Balance Amortization) សរុប {{ $months }} លើក
                    </p>
                </div>

                <div class="flex items-center gap-3 text-xs text-slate-500">
                    <button type="button"
                            @click="openPayModal({{ $nextDueInstallment }}, '{{ number_format($monthlyPayment, 2, '.', '') }}', '{{ $nextDueDate }}')" 
                            class="no-print inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-emerald-50 text-emerald-700 hover:bg-emerald-100 font-bold border border-emerald-200 transition">
                        <i class="bi bi-plus-circle"></i>
                        <span>បង់លើកទី {{ $nextDueInstallment }}</span>
                    </button>

                    <button onclick="window.print()" class="no-print text-teal-700 hover:text-teal-800 font-semibold inline-flex items-center gap-1 hover:underline">
                        <i class="bi bi-printer"></i> បោះពុម្ព
                    </button>
                </div>
            </div>

            {{-- Table Content --}}
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse text-xs sm:text-sm">
                    <thead>
                        <tr class="border-b border-slate-200 bg-slate-50/80 text-[11px] font-bold uppercase tracking-wider text-slate-500">
                            <th class="pl-6 pr-3 py-4 text-center w-14">លើកទី</th>
                            <th class="px-4 py-4 text-left">កាលបរិច្ឆេទត្រូវបង់</th>
                            <th class="px-4 py-4 text-right">សមតុល្យដើមគ្រា</th>
                            <th class="px-4 py-4 text-right text-teal-700">ប្រាក់ដើមត្រូវបង់</th>
                            <th class="px-4 py-4 text-right text-amber-700">ការប្រាក់</th>
                            <th class="px-4 py-4 text-right font-extrabold text-slate-900 bg-slate-100/60">ទឹកប្រាក់សរុប</th>
                            <th class="px-4 py-4 text-right">សមតុល្យចុងគ្រា</th>
                            <th class="pl-4 pr-6 py-4 text-center w-36 no-print">ស្ថានភាព / បង់ប្រាក់</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-slate-100 text-slate-700 font-medium">
                        @php 
                            $runningBalance = $principal;
                            $sumPrincipal = 0;
                            $sumInterest = 0;
                            $sumTotal = 0;
                        @endphp

                        @for ($i = 1; $i <= $months; $i++)
                            @php
                                $startingBalance = $runningBalance;
                                $interest = $startingBalance * $monthlyRate;
                                $principalPaid = $monthlyPayment - $interest;
                                $endingBalance = $startingBalance - $principalPaid;

                                // Final month zero out correction
                                if ($i === $months || $endingBalance < 0.005) {
                                    $principalPaid = $startingBalance;
                                    $endingBalance = 0.0;
                                    $rowTotal = $principalPaid + $interest;
                                } else {
                                    $rowTotal = $monthlyPayment;
                                }

                                $runningBalance = $endingBalance;
                                
                                $sumPrincipal += $principalPaid;
                                $sumInterest += $interest;
                                $sumTotal += $rowTotal;

                                $installmentDueDate = $startDate->copy()->addMonths($i);
                                $isPaid = ($paidAmount >= ($monthlyPayment * $i - 0.05));
                            @endphp

                            <tr class="hover:bg-slate-50/80 transition-colors {{ $i % 2 === 0 ? 'bg-slate-50/30' : 'bg-white' }}">
                                <td class="pl-6 pr-3 py-3.5 text-center font-bold text-slate-400">
                                    <span class="w-6 h-6 rounded-full inline-flex items-center justify-center bg-slate-100 text-[11px] text-slate-600">
                                        {{ $i }}
                                    </span>
                                </td>
                                
                                <td class="px-4 py-3.5 font-medium text-slate-600 whitespace-nowrap">
                                    <div class="flex items-center gap-1.5">
                                        <i class="bi bi-calendar-event text-slate-400 text-xs"></i>
                                        <span>{{ $installmentDueDate->format('d M Y') }}</span>
                                    </div>
                                </td>

                                <td class="px-4 py-3.5 text-right font-medium text-slate-600 whitespace-nowrap">
                                    {{ $currencySymbol }}{{ number_format($startingBalance, 2) }}
                                </td>

                                <td class="px-4 py-3.5 text-right font-bold text-teal-700 whitespace-nowrap">
                                    {{ $currencySymbol }}{{ number_format($principalPaid, 2) }}
                                </td>

                                <td class="px-4 py-3.5 text-right font-medium text-amber-700 whitespace-nowrap">
                                    {{ $currencySymbol }}{{ number_format($interest, 2) }}
                                </td>

                                <td class="px-4 py-3.5 text-right font-black text-slate-900 bg-slate-100/30 whitespace-nowrap">
                                    {{ $currencySymbol }}{{ number_format($rowTotal, 2) }}
                                </td>

                                <td class="px-4 py-3.5 text-right font-semibold text-slate-600 whitespace-nowrap">
                                    {{ $currencySymbol }}{{ number_format($endingBalance, 2) }}
                                </td>

                                <td class="pl-4 pr-6 py-3.5 text-center no-print whitespace-nowrap">
                                    @if($isPaid)
                                        <span class="inline-flex items-center gap-1 px-2.5 py-1 text-[11px] font-bold bg-emerald-50 text-emerald-700 rounded-full border border-emerald-200">
                                            <i class="bi bi-check2"></i> បានបង់រួច
                                        </span>
                                    @else
                                        <div class="flex items-center justify-center gap-2">
                                            @if($i === $nextDueInstallment)
                                                <span class="inline-flex items-center gap-1 px-2 py-0.5 text-[10px] font-bold bg-amber-50 text-amber-700 rounded-md border border-amber-200">
                                                    <span class="w-1.5 h-1.5 rounded-full bg-amber-500 animate-ping"></span>
                                                    បន្ទាប់
                                                </span>
                                            @endif
                                            <button type="button"
                                                    @click="openPayModal({{ $i }}, '{{ number_format($rowTotal, 2, '.', '') }}', '{{ $installmentDueDate->format('Y-m-d') }}')"
                                                    class="inline-flex items-center gap-1 px-2.5 py-1 text-xs font-semibold text-white bg-emerald-600 hover:bg-emerald-700 rounded-lg shadow-xs transition-all active:scale-95"
                                                    title="កត់ត្រាការបង់ប្រាក់លើកទី {{ $i }}">
                                                <i class="bi bi-wallet2 text-[10px]"></i>
                                                <span>បង់ប្រាក់</span>
                                            </button>
                                        </div>
                                    @endif
                                </td>
                            </tr>
                        @endfor
                    </tbody>

                    {{-- Table Summary Footer --}}
                    <tfoot>
                        <tr class="bg-slate-100/90 border-t-2 border-slate-300 font-bold text-slate-900">
                            <td colspan="2" class="pl-6 py-4 text-left font-black tracking-wider text-xs sm:text-sm text-slate-800">
                                សរុបរួម (TOTALS)
                            </td>
                            <td class="px-4 py-4 text-right text-slate-400 text-xs">
                                —
                            </td>
                            <td class="px-4 py-4 text-right text-teal-700 font-black">
                                {{ $currencySymbol }}{{ number_format($sumPrincipal, 2) }}
                            </td>
                            <td class="px-4 py-4 text-right text-amber-700 font-black">
                                {{ $currencySymbol }}{{ number_format($sumInterest, 2) }}
                            </td>
                            <td class="px-4 py-4 text-right text-slate-900 font-black text-sm sm:text-base bg-slate-200/50">
                                {{ $currencySymbol }}{{ number_format($sumTotal, 2) }}
                            </td>
                            <td class="px-4 py-4 text-right text-slate-700 font-bold">
                                {{ $currencySymbol }}0.00
                            </td>
                            <td class="no-print"></td>
                        </tr>
                    </tfoot>
                </table>
            </div>

            {{-- Table Helper Note Footer --}}
            <div class="p-4 bg-slate-50/60 border-t border-slate-100 text-xs text-slate-500 flex flex-col sm:flex-row sm:items-center justify-between gap-2">
                <div class="flex items-center gap-2">
                    <i class="bi bi-info-circle-fill text-teal-600"></i>
                    <span>ចំណាំ៖ ការគណនាការប្រាក់ប្រែប្រួលតាមចំនួនថ្ងៃជាក់ស្តែងនៃខែនីមួយៗ និងសមតុល្យដើមគ្រាជាក់ស្តែង។</span>
                </div>
                <div class="no-print">
                    <span class="text-slate-400">ប្រព័ន្ធគ្រប់គ្រងឥណទាន ធនាគារ ចេនឡា</span>
                </div>
            </div>
        </div>

        {{-- PRINT SIGNATURE FOOTER AREA (Visible only when printed) --}}
        <div class="hidden print-only mt-12 pt-8 border-t border-slate-300">
            <div class="grid grid-cols-2 gap-8 text-center text-xs">
                <div>
                    <p class="font-bold text-slate-800 mb-16">ហត្ថលេខា និងឈ្មោះអតិថិជន (Borrower)</p>
                    <p class="border-t border-dashed border-slate-400 pt-2 text-slate-600">{{ $customerName }}</p>
                </div>
                <div>
                    <p class="font-bold text-slate-800 mb-16">ហត្ថលេខា និងត្រាមន្ត្រីឥណទាន (Loan Officer)</p>
                    <p class="border-t border-dashed border-slate-400 pt-2 text-slate-600">ធនាគារ ចេនឡា</p>
                </div>
            </div>
        </div>

        {{-- BOTTOM ACTION CONTROL LINKS (NO-PRINT) --}}
        <div class="no-print flex items-center justify-between gap-4 pt-2 pb-6">
            <a href="{{ route('loans.index') }}" 
               class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl border border-slate-200 bg-white text-slate-700 hover:bg-slate-50 font-semibold text-xs sm:text-sm shadow-xs transition-all active:scale-95">
                <i class="bi bi-arrow-left"></i>
                <span>ត្រឡប់ទៅកាន់បញ្ជីកិច្ចសន្យា</span>
            </a>

            <div class="flex items-center gap-3">
                <button type="button"
                        @click="openPayModal({{ $nextDueInstallment }}, '{{ number_format($monthlyPayment, 2, '.', '') }}', '{{ $nextDueDate }}')" 
                        class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-emerald-700 hover:to-teal-700 text-white font-bold text-xs sm:text-sm shadow-md transition-all active:scale-95">
                    <i class="bi bi-cash-stack"></i>
                    <span>បង់ប្រាក់ប្រចាំខែ ({{ $currencySymbol }}{{ number_format($monthlyPayment, 2) }})</span>
                </button>
            </div>
        </div>

    </div>

    {{-- MODAL: RECORD MONTHLY REPAYMENT --}}
    <div x-show="showPayModal" 
         x-cloak
         class="fixed inset-0 z-50 overflow-y-auto"
         role="dialog" 
         aria-modal="true">
        
        <!-- Backdrop Blur Overlay -->
        <div x-show="showPayModal"
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="fixed inset-0 bg-slate-900/50 backdrop-blur-xs"
             @click="showPayModal = false">
        </div>

        <div class="min-h-full flex items-center justify-center p-4">
            <div x-show="showPayModal"
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 scale-95"
                 x-transition:enter-end="opacity-100 scale-100"
                 x-transition:leave="transition ease-in duration-150"
                 x-transition:leave-start="opacity-100 scale-100"
                 x-transition:leave-end="opacity-0 scale-95"
                 class="relative w-full max-w-lg bg-white rounded-3xl border border-slate-200 shadow-2xl overflow-hidden p-6 text-slate-800">
                
                <!-- Modal Top Header -->
                <div class="flex items-center justify-between pb-4 border-b border-slate-100">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-2xl bg-emerald-50 text-emerald-700 flex items-center justify-center font-bold text-lg shadow-xs">
                            <i class="bi bi-cash-stack"></i>
                        </div>
                        <div>
                            <h3 class="font-bold text-base text-[#0B2B40]">
                                កត់ត្រាការបង់ប្រាក់សងរំលស់
                            </h3>
                            <p class="text-xs text-slate-400">
                                {{ $loanCode }} — {{ $customerName }}
                            </p>
                        </div>
                    </div>
                    <button type="button" @click="showPayModal = false" class="w-8 h-8 rounded-full bg-slate-100 hover:bg-slate-200 text-slate-500 flex items-center justify-center transition">
                        <i class="bi bi-x-lg text-xs"></i>
                    </button>
                </div>

                <!-- Form -->
                <form action="{{ route('repayments.store') }}" method="POST" class="mt-4 space-y-4">
                    @csrf
                    <input type="hidden" name="loan_id" value="{{ $loan->id }}">
                    <input type="hidden" name="redirect_to" value="{{ url()->current() }}">

                    <div class="p-3 bg-emerald-50/80 border border-emerald-200/60 rounded-xl flex items-center justify-between">
                        <span class="text-xs font-semibold text-emerald-800 flex items-center gap-1.5">
                            <i class="bi bi-calendar-check text-emerald-600"></i>
                            <span>បង់ប្រាក់សម្រាប់៖ <strong class="text-emerald-950">លើកទី <span x-text="modalMonth"></span></strong></span>
                        </span>
                        <span class="text-xs font-bold text-emerald-700 bg-white px-2 py-0.5 rounded-md border border-emerald-200 shadow-2xs">
                            ប្រចាំខែ (Monthly)
                        </span>
                    </div>

                    <!-- Payment Date & Method -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3.5">
                        <div>
                            <label class="block text-xs font-bold text-slate-600 mb-1">កាលបរិច្ឆេទសង <span class="text-rose-500">*</span></label>
                            <input type="date" name="payment_date" x-model="modalDate" required 
                                   class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2.5 text-xs focus:outline-none focus:bg-white focus:border-emerald-500 font-medium transition">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-600 mb-1">វិធីសាស្ត្រទូទាត់ <span class="text-rose-500">*</span></label>
                            <div class="relative">
                                <select name="payment_method" required 
                                        class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2.5 text-xs focus:outline-none focus:bg-white focus:border-emerald-500 font-medium appearance-none cursor-pointer transition">
                                    <option value="សាច់ប្រាក់">💵 សាច់ប្រាក់ (Cash)</option>
                                    <option value="ផ្ទេរតាមធនាគារ">🏦 ផ្ទេរតាមធនាគារ (Bank Transfer)</option>
                                    <option value="ប្រាក់ចល័ត">📱 ប្រាក់ចល័ត (Mobile / QR)</option>
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-3 flex items-center text-slate-400">
                                    <i class="bi bi-chevron-down text-xs"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Amount & Penalty -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3.5">
                        <div>
                            <label class="block text-xs font-bold text-slate-600 mb-1">ចំនួនទឹកប្រាក់ ($) <span class="text-rose-500">*</span></label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-3 flex items-center text-emerald-600 font-bold text-sm">$</span>
                                <input type="number" step="0.01" name="amount_paid" x-model="modalAmount" required 
                                       class="w-full bg-slate-50 border border-slate-200 rounded-xl pl-8 pr-3.5 py-2.5 text-xs focus:outline-none focus:bg-white focus:border-emerald-500 font-black text-slate-900 transition">
                            </div>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-600 mb-1">ប្រាក់ពិន័យ ($)</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-3 flex items-center text-rose-500 font-bold text-sm">$</span>
                                <input type="number" step="0.01" name="penalty_amount" value="0.00" 
                                       class="w-full bg-slate-50 border border-slate-200 rounded-xl pl-8 pr-3.5 py-2.5 text-xs focus:outline-none focus:bg-white focus:border-emerald-500 font-medium text-slate-800 transition">
                            </div>
                        </div>
                    </div>

                    <!-- Notes -->
                    <div>
                        <label class="block text-xs font-bold text-slate-600 mb-1">កំណត់ចំណាំ</label>
                        <textarea name="notes" rows="2" x-model="modalNotes" 
                                  class="w-full bg-slate-50 border border-slate-200 rounded-xl p-3 text-xs focus:outline-none focus:bg-white focus:border-emerald-500 font-medium placeholder:text-slate-400 transition"></textarea>
                    </div>

                    <!-- Modal Actions -->
                    <div class="flex items-center justify-end gap-3 pt-3 border-t border-slate-100">
                        <button type="button" @click="showPayModal = false" 
                                class="px-4 py-2.5 rounded-xl border border-slate-200 bg-white hover:bg-slate-50 text-slate-600 font-semibold text-xs transition">
                            បោះបង់
                        </button>
                        <button type="submit" 
                                class="px-5 py-2.5 rounded-xl bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-emerald-700 hover:to-teal-700 text-white font-bold text-xs shadow-md transition active:scale-95 flex items-center gap-1.5">
                            <i class="bi bi-check-circle-fill"></i>
                            <span>យល់ព្រមបង់ប្រាក់</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>

<style>
    [x-cloak] { display: none !important; }
    @media print {
        @page {
            size: A4 portrait;
            margin: 12mm 15mm;
        }
        body {
            background: white !important;
            color: black !important;
            font-size: 11px !important;
        }
        .no-print {
            display: none !important;
        }
        .print-only {
            display: block !important;
        }
        table {
            width: 100% !important;
            border-collapse: collapse !important;
        }
        th, td {
            border: 1px solid #cbd5e1 !important;
            padding: 6px 8px !important;
        }
        thead tr {
            background-color: #f1f5f9 !important;
            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
        }
        tfoot tr {
            background-color: #e2e8f0 !important;
            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
        }
        .shadow-sm, .shadow-md, .shadow-lg, .shadow-xs, .shadow-2xl {
            box-shadow: none !important;
        }
    }
</style>
@endsection

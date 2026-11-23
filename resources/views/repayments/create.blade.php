@extends('layouts.master')

@section('title', 'កត់ត្រាការសងប្រាក់ | ធនាគារ ចេនឡា')
@section('header_title', 'NEW REPAYMENT // កត់ត្រាការសងប្រាក់')

@section('content')
@php
    // Build loan map for Alpine JS quick-fill
    $loansMap = [];
    foreach($loans as $l) {
        $principal = (float) ($l->amount ?? 0);
        $duration = max(1, (int) floor($l->duration ?? 1));
        $rate = (($l->interest_rate ?? 0) / 100) / 12;
        if ($rate > 0) {
            $monthly = $principal * ($rate * pow(1 + $rate, $duration)) / (pow(1 + $rate, $duration) - 1);
        } else {
            $monthly = $principal / $duration;
        }
        $balance = (float) ($l->total_payable ?? $principal);

        $loansMap[$l->id] = [
            'id' => $l->id,
            'loan_number' => $l->loan_number ?? ('LN-' . date('Y') . '-' . str_pad($l->id, 4, '0', STR_PAD_LEFT)),
            'customer' => $l->customer?->name ?? $l->customer_name ?? 'អតិថិជន',
            'phone' => $l->customer?->phone ?? 'គ្មានលេខទូរស័ព្ទ',
            'amount' => number_format($principal, 2, '.', ''),
            'interest_rate' => $l->interest_rate ?? 0,
            'duration' => $l->duration ?? 0,
            'monthly' => number_format($monthly, 2, '.', ''),
            'balance' => number_format($balance, 2, '.', ''),
            'currency' => ($l->currency === 'KHR' || $l->currency === '៛') ? '៛' : '$',
        ];
    }
@endphp

<div x-data="{ 
        selectedLoanId: '{{ old('loan_id', $selectedLoanId ?? '') }}',
        amountPaid: '{{ old('amount_paid', $defaultAmount ?? '') }}',
        penaltyAmount: '{{ old('penalty_amount', '0.00') }}',
        loansMap: {{ \Illuminate\Support\Js::from($loansMap) }},
        get selectedLoan() {
            return this.loansMap[this.selectedLoanId] || null;
        },
        fillMonthly() {
            if (this.selectedLoan) {
                this.amountPaid = this.selectedLoan.monthly;
            }
        },
        fillFull() {
            if (this.selectedLoan) {
                this.amountPaid = this.selectedLoan.balance;
            }
        },
        init() {
            if (this.selectedLoanId && !this.amountPaid && this.selectedLoan) {
                this.amountPaid = this.selectedLoan.monthly;
            }
        }
     }" 
     class="relative min-h-screen bg-[#f4f7f9] font-khmer p-4 sm:p-6 lg:p-8 overflow-hidden antialiased text-slate-800">

    <!-- Subtle Khmer Diamond Pattern Background -->
    <div class="pointer-events-none fixed inset-0 opacity-[0.45] no-print"
         style="background-image: url(&quot;data:image/svg+xml,%3Csvg width='64' height='64' viewBox='0 0 64 64' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' stroke='%23cbd5e1' stroke-width='0.75'%3E%3Cpath d='M32 4 L60 32 L32 60 L4 32 Z'/%3E%3Cpath d='M32 16 L48 32 L32 48 L16 32 Z'/%3E%3Ccircle cx='32' cy='32' r='2.5'/%3E%3C/g%3E%3C/svg%3E&quot;);">
    </div>

    <div class="relative z-10 max-w-6xl mx-auto space-y-6">

        {{-- FLASH & VALIDATION MESSAGES --}}
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

        @if($errors->any())
            <div class="rounded-2xl bg-rose-50 border border-rose-200/80 p-4 text-rose-800 shadow-xs">
                <div class="flex items-start gap-3">
                    <div class="w-9 h-9 rounded-xl bg-rose-100 text-rose-700 flex items-center justify-center shrink-0 mt-0.5">
                        <i class="bi bi-exclamation-triangle-fill text-base"></i>
                    </div>
                    <div>
                        <h4 class="font-bold text-xs sm:text-sm">សូមពិនិត្យមើលទិន្នន័យដែលបានបញ្ចូលឡើងវិញ៖</h4>
                        <ul class="list-disc list-inside text-xs text-rose-700 mt-1 space-y-1">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endif

        {{-- TOP HEADER & NAVIGATION --}}
        <div class="rounded-2xl bg-white border border-slate-200/80 shadow-[0_4px_20px_rgb(15,41,66,0.03)] overflow-hidden">
            <div class="h-1.5 w-full bg-gradient-to-r from-[#142d42] via-[#1e5158] to-[#4caf7c]"></div>

            <div class="p-5 sm:p-6 flex flex-col md:flex-row md:items-center justify-between gap-4">
                <div class="flex items-center gap-3.5">
                    <a href="{{ route('repayments.index') }}" 
                       class="w-10 h-10 rounded-xl bg-slate-50 hover:bg-slate-100 border border-slate-200 flex items-center justify-center text-slate-600 hover:text-slate-900 transition-all active:scale-95 shadow-xs"
                       title="ត្រឡប់ទៅកាន់បញ្ជីប្រវត្តិសងប្រាក់">
                        <i class="bi bi-arrow-left text-base"></i>
                    </a>
                    <div>
                        <div class="flex items-center gap-2 flex-wrap">
                            <a href="{{ route('repayments.index') }}" class="text-xs font-semibold text-slate-400 hover:text-slate-600 transition">
                                គ្រប់គ្រងការសងប្រាក់
                            </a>
                            <i class="bi bi-chevron-right text-[10px] text-slate-300"></i>
                            <span class="text-xs font-semibold text-emerald-600">កត់ត្រាការសងប្រាក់ថ្មី</span>
                        </div>
                        <h1 class="text-xl sm:text-2xl font-bold text-[#142d42] tracking-tight mt-0.5">
                            កត់ត្រាការសងប្រាក់ (New Repayment)
                        </h1>
                    </div>
                </div>

                <div class="flex items-center gap-2.5 flex-wrap">
                    <a href="{{ route('repayments.index') }}" 
                       class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl text-xs sm:text-sm font-semibold text-slate-700 bg-white hover:bg-slate-50 border border-slate-300 shadow-xs transition-all active:scale-[0.98]">
                        <i class="bi bi-clock-history text-slate-500"></i>
                        <span>បញ្ជីប្រវត្តិសងប្រាក់</span>
                    </a>

                    <a href="{{ route('loans.index') }}" 
                       class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl text-xs sm:text-sm font-semibold text-slate-700 bg-slate-50 hover:bg-slate-100 border border-slate-200 shadow-xs transition-all active:scale-[0.98]">
                        <i class="bi bi-folder2-open text-slate-500"></i>
                        <span>បញ្ជីកិច្ចសន្យាខ្ចី</span>
                    </a>
                </div>
            </div>
        </div>

        {{-- MAIN CONTENT GRID: FORM (7 COLS) + LIVE LOAN DETAILS ASSISTANT (5 COLS) --}}
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">

            {{-- LEFT: FORM CARD (7 COLS) --}}
            <div class="lg:col-span-7 bg-white border border-slate-200/80 rounded-2xl shadow-[0_4px_20px_rgb(15,41,66,0.03)] overflow-hidden">
                <div class="p-5 border-b border-slate-100 bg-gradient-to-r from-slate-50/70 to-white flex items-center justify-between">
                    <div class="flex items-center gap-2.5">
                        <div class="w-8 h-8 rounded-xl bg-emerald-50 text-emerald-700 flex items-center justify-center">
                            <i class="bi bi-cash-coin text-base"></i>
                        </div>
                        <div>
                            <h2 class="font-bold text-[#0B2B40] text-sm sm:text-base">ទម្រង់កត់ត្រាការបង់ប្រាក់</h2>
                            <p class="text-[11px] text-slate-400">សូមបំពេញព័ត៌មានប្រតិបត្តិការបង់ប្រាក់ឱ្យបានត្រឹមត្រូវ</p>
                        </div>
                    </div>
                    <span class="text-[10px] font-bold uppercase tracking-wider text-emerald-700 bg-emerald-50 px-2.5 py-1 rounded-md border border-emerald-100">
                        Form Entry
                    </span>
                </div>

                <form action="{{ route('repayments.store') }}" method="POST" class="p-5 sm:p-6 space-y-5">
                    @csrf

                    {{-- 1. Select Loan Contract --}}
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1.5 flex items-center justify-between">
                            <span class="flex items-center gap-1.5">
                                <i class="bi bi-file-earmark-text text-teal-600"></i>
                                <span>ជ្រើសរើសកិច្ចសន្យាខ្ចី (Loan Contract) <span class="text-rose-500">*</span></span>
                            </span>
                            <span class="text-[11px] font-normal text-slate-400">{{ $loans->count() }} កិច្ចសន្យាសកម្ម</span>
                        </label>
                        <div class="relative">
                            <select name="loan_id" required 
                                    x-model="selectedLoanId"
                                    class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-xs sm:text-sm focus:outline-none focus:bg-white focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 text-slate-800 font-medium transition appearance-none cursor-pointer">
                                <option value="" disabled selected>-- សូមជ្រើសរើសកិច្ចសន្យាខ្ចី --</option>
                                @foreach($loans as $loan)
                                    @php
                                        $cName = $loan->customer?->name ?? $loan->customer_name ?? 'អតិថិជន';
                                        $lNum = $loan->loan_number ?? ('LN-' . date('Y') . '-' . str_pad($loan->id, 4, '0', STR_PAD_LEFT));
                                        $currency = ($loan->currency === 'KHR' || $loan->currency === '៛') ? '៛' : '$';
                                        $balance = $loan->total_payable ?? $loan->amount ?? 0;
                                    @endphp
                                    <option value="{{ $loan->id }}">
                                        {{ $lNum }} — {{ $cName }} (សមតុល្យនៅសល់: {{ $currency }}{{ number_format($balance, 2) }})
                                    </option>
                                @endforeach
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-3.5 flex items-center text-slate-400">
                                <i class="bi bi-chevron-down text-xs"></i>
                            </div>
                        </div>

                        {{-- Quick Fill Assistant --}}
                        <div x-show="selectedLoan" x-cloak class="mt-3 p-3.5 rounded-xl bg-emerald-50/80 border border-emerald-200/70 text-xs transition-all">
                            <div class="flex items-center justify-between mb-2">
                                <span class="font-medium text-emerald-900 flex items-center gap-1.5">
                                    <i class="bi bi-calendar-check text-emerald-600"></i>
                                    <span>ប្រាក់ត្រូវបង់ប្រចាំខែ (Monthly Installment)៖</span>
                                </span>
                                <span class="font-black text-emerald-800 text-sm">
                                    $<span x-text="selectedLoan ? selectedLoan.monthly : '0.00'"></span>
                                </span>
                            </div>
                            <div class="flex items-center gap-2 pt-2 border-t border-emerald-200/50 flex-wrap">
                                <button type="button" 
                                        @click="fillMonthly()"
                                        class="px-3 py-1.5 rounded-lg bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs transition shadow-xs active:scale-95 flex items-center gap-1.5">
                                    <i class="bi bi-lightning-fill text-amber-300"></i>
                                    <span>បំពេញបង់ប្រចាំខែ ($<span x-text="selectedLoan ? selectedLoan.monthly : '0.00'"></span>)</span>
                                </button>
                                <button type="button" 
                                        @click="fillFull()"
                                        class="px-3 py-1.5 rounded-lg bg-white hover:bg-slate-50 text-slate-700 font-semibold text-xs border border-slate-200 transition shadow-2xs active:scale-95 flex items-center gap-1.5">
                                    <span>បង់ផ្តាច់សមតុល្យ ($<span x-text="selectedLoan ? selectedLoan.balance : '0.00'"></span>)</span>
                                </button>
                            </div>
                        </div>
                    </div>

                    {{-- 2. Date and Payment Method --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1.5 flex items-center gap-1.5">
                                <i class="bi bi-calendar3 text-teal-600"></i>
                                <span>កាលបរិច្ឆេទសង <span class="text-rose-500">*</span></span>
                            </label>
                            <input type="date" name="payment_date" value="{{ old('payment_date', date('Y-m-d')) }}" required 
                                   class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-xs sm:text-sm focus:outline-none focus:bg-white focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 text-slate-800 font-medium transition">
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1.5 flex items-center gap-1.5">
                                <i class="bi bi-credit-card text-teal-600"></i>
                                <span>វិធីសាស្ត្រទូទាត់ <span class="text-rose-500">*</span></span>
                            </label>
                            <div class="relative">
                                <select name="payment_method" required 
                                        class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-xs sm:text-sm focus:outline-none focus:bg-white focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 text-slate-800 font-medium transition appearance-none cursor-pointer">
                                    <option value="សាច់ប្រាក់" {{ old('payment_method') == 'សាច់ប្រាក់' ? 'selected' : '' }}>💵 សាច់ប្រាក់ (Cash)</option>
                                    <option value="ផ្ទេរតាមធនាគារ" {{ old('payment_method') == 'ផ្ទេរតាមធនាគារ' ? 'selected' : '' }}>🏦 ផ្ទេរតាមធនាគារ (Bank Transfer)</option>
                                    <option value="ប្រាក់ចល័ត" {{ old('payment_method') == 'ប្រាក់ចល័ត' ? 'selected' : '' }}>📱 ប្រាក់ចល័ត (Mobile / QR)</option>
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-3.5 flex items-center text-slate-400">
                                    <i class="bi bi-chevron-down text-xs"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- 3. Amount and Penalty --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1.5 flex items-center gap-1.5">
                                <i class="bi bi-currency-dollar text-emerald-600"></i>
                                <span>ចំនួនទឹកប្រាក់ ($) <span class="text-rose-500">*</span></span>
                            </label>
                            <div class="relative">
                                <div class="pointer-events-none absolute inset-y-0 left-3.5 flex items-center text-emerald-600 font-bold text-base">
                                    $
                                </div>
                                <input type="number" step="0.01" name="amount_paid" x-model="amountPaid" placeholder="0.00" required 
                                       class="w-full bg-slate-50 border border-slate-200 rounded-xl pl-8 pr-4 py-2.5 text-xs sm:text-sm focus:outline-none focus:bg-white focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 text-slate-900 font-bold transition">
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1.5 flex items-center gap-1.5">
                                <i class="bi bi-shield-exclamation text-rose-500"></i>
                                <span>ប្រាក់ពិន័យ ($)</span>
                            </label>
                            <div class="relative">
                                <div class="pointer-events-none absolute inset-y-0 left-3.5 flex items-center text-rose-500 font-bold text-base">
                                    $
                                </div>
                                <input type="number" step="0.01" name="penalty_amount" x-model="penaltyAmount" value="0.00" 
                                       class="w-full bg-slate-50 border border-slate-200 rounded-xl pl-8 pr-4 py-2.5 text-xs sm:text-sm focus:outline-none focus:bg-white focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 text-slate-800 font-medium transition">
                            </div>
                        </div>
                    </div>

                    {{-- 4. Notes --}}
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1.5 flex items-center gap-1.5">
                            <i class="bi bi-chat-left-text text-teal-600"></i>
                            <span>កំណត់ចំណាំ (បើមាន)</span>
                        </label>
                        <textarea name="notes" rows="3" placeholder="បញ្ចូលព័ត៌មានលម្អិតបន្ថែម លេខប្រតិបត្តិការយោង ឬព័ត៌មានផ្សេងៗ..." 
                                  class="w-full bg-slate-50 border border-slate-200 rounded-xl p-3.5 text-xs sm:text-sm focus:outline-none focus:bg-white focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 text-slate-800 font-medium transition placeholder:text-slate-400">{{ old('notes') }}</textarea>
                    </div>

                    {{-- 5. Submit & Cancel Buttons --}}
                    <div class="pt-2 flex flex-col sm:flex-row items-center gap-3">
                        <button type="submit" 
                                class="w-full sm:flex-1 bg-gradient-to-r from-[#059669] to-[#047857] hover:from-[#047857] hover:to-[#065f46] text-white font-bold py-3.5 px-6 rounded-xl text-xs sm:text-sm flex items-center justify-center gap-2 transition-all shadow-md shadow-emerald-700/15 active:scale-[0.98]">
                            <i class="bi bi-check-circle-fill text-base"></i>
                            <span>រក្សាទុកការសងប្រាក់</span>
                        </button>

                        <a href="{{ route('repayments.index') }}" 
                           class="w-full sm:w-auto px-5 py-3.5 rounded-xl border border-slate-200 text-slate-600 hover:text-slate-900 hover:bg-slate-50 font-semibold text-xs sm:text-sm text-center transition">
                            បោះបង់
                        </a>
                    </div>
                </form>

                <div class="p-4 bg-slate-50/70 border-t border-slate-100 text-[11px] text-slate-500 flex items-center gap-2">
                    <i class="bi bi-info-circle text-teal-600 shrink-0 text-sm"></i>
                    <span>វិក្កយបត្រនឹងត្រូវបង្កើតដោយស្វ័យប្រវត្តិកូដ <span class="font-semibold text-slate-700">Receipt RC-XXX</span> បន្ទាប់ពីការរក្សាទុក។</span>
                </div>
            </div>

            {{-- RIGHT: LIVE PREVIEW & LOAN DETAILS ASSISTANT (5 COLS) --}}
            <div class="lg:col-span-5 space-y-5">

                {{-- Loan Overview Card --}}
                <div class="bg-white border border-slate-200/80 rounded-2xl shadow-[0_4px_20px_rgb(15,41,66,0.03)] overflow-hidden">
                    <div class="p-4 sm:p-5 border-b border-slate-100 bg-gradient-to-r from-slate-50/70 to-white flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <div class="w-7 h-7 rounded-lg bg-teal-50 text-teal-700 flex items-center justify-center">
                                <i class="bi bi-info-square-fill text-sm"></i>
                            </div>
                            <h3 class="font-bold text-[#0B2B40] text-xs sm:text-sm">ព័ត៌មានកិច្ចសន្យាខ្ចី</h3>
                        </div>
                        <span class="text-[10px] font-bold px-2 py-0.5 rounded-md bg-teal-50 text-teal-700 border border-teal-100">
                            Live Details
                        </span>
                    </div>

                    <div class="p-5">
                        <template x-if="selectedLoan">
                            <div class="space-y-4">
                                {{-- Customer header --}}
                                <div class="flex items-center gap-3 p-3.5 rounded-xl bg-slate-50 border border-slate-100">
                                    <div class="w-11 h-11 rounded-xl bg-emerald-100 text-emerald-800 font-black text-sm flex items-center justify-center shrink-0">
                                        <span x-text="selectedLoan.customer ? selectedLoan.customer.substring(0, 1) : 'អ'"></span>
                                    </div>
                                    <div class="min-w-0">
                                        <h4 class="font-bold text-slate-900 text-sm truncate" x-text="selectedLoan.customer"></h4>
                                        <div class="flex items-center gap-2 text-xs text-slate-500 mt-0.5">
                                            <span class="font-mono text-teal-700 font-semibold" x-text="selectedLoan.loan_number"></span>
                                            <span>•</span>
                                            <span x-text="selectedLoan.phone"></span>
                                        </div>
                                    </div>
                                </div>

                                {{-- Financial Breakdown --}}
                                <div class="grid grid-cols-2 gap-3 text-xs">
                                    <div class="p-3 rounded-xl bg-slate-50/70 border border-slate-100">
                                        <span class="text-slate-400 block text-[11px] mb-1">ទំហំប្រាក់កម្ចីដើម</span>
                                        <span class="font-bold text-slate-800 text-sm">
                                            $<span x-text="selectedLoan.amount"></span>
                                        </span>
                                    </div>
                                    <div class="p-3 rounded-xl bg-slate-50/70 border border-slate-100">
                                        <span class="text-slate-400 block text-[11px] mb-1">រយៈពេលកម្ចី</span>
                                        <span class="font-bold text-slate-800 text-sm">
                                            <span x-text="selectedLoan.duration"></span> ខែ
                                        </span>
                                    </div>
                                    <div class="p-3 rounded-xl bg-teal-50/60 border border-teal-100">
                                        <span class="text-teal-700 block text-[11px] mb-1 font-medium">បង់ប្រចាំខែ (ប៉ាន់ស្មាន)</span>
                                        <span class="font-black text-teal-800 text-sm">
                                            $<span x-text="selectedLoan.monthly"></span>
                                        </span>
                                    </div>
                                    <div class="p-3 rounded-xl bg-emerald-50/60 border border-emerald-100">
                                        <span class="text-emerald-700 block text-[11px] mb-1 font-medium">សមតុល្យត្រូវសងនៅសល់</span>
                                        <span class="font-black text-emerald-800 text-sm">
                                            $<span x-text="selectedLoan.balance"></span>
                                        </span>
                                    </div>
                                </div>

                                {{-- Remaining Balance Calculation Preview --}}
                                <div class="p-3.5 rounded-xl bg-gradient-to-br from-[#142d42] to-[#1e5158] text-white">
                                    <div class="flex items-center justify-between text-xs text-teal-200 mb-1">
                                        <span>សមតុល្យប៉ាន់ស្មានក្រោយពេលបង់៖</span>
                                        <i class="bi bi-arrow-down-circle text-teal-300"></i>
                                    </div>
                                    <div class="text-lg font-black text-white">
                                        $<span x-text="Math.max(0, (parseFloat(selectedLoan.balance || 0) - parseFloat(amountPaid || 0))).toFixed(2)"></span>
                                    </div>
                                    <div class="text-[10px] text-teal-200/80 mt-1">
                                        * សមតុល្យជាក់ស្តែងនឹងត្រូវកាត់កងចេញពីកិច្ចសន្យាភ្លាមៗពេលចុចរក្សាទុក។
                                    </div>
                                </div>
                            </div>
                        </template>

                        <template x-if="!selectedLoan">
                            <div class="text-center py-8 text-slate-400">
                                <div class="w-12 h-12 rounded-2xl bg-slate-100 text-slate-400 flex items-center justify-center mx-auto mb-2 text-xl">
                                    <i class="bi bi-arrow-left-circle"></i>
                                </div>
                                <p class="font-bold text-slate-700 text-xs sm:text-sm">មិនទាន់បានជ្រើសរើសកិច្ចសន្យាខ្ចី</p>
                                <p class="text-[11px] text-slate-400 mt-1">សូមជ្រើសរើសកិច្ចសន្យាកម្ចីនៅខាងឆ្វេង ដើម្បីមើលព័ត៌មានលម្អិត និងសមតុល្យ។</p>
                            </div>
                        </template>
                    </div>
                </div>

                {{-- Important Notice Card --}}
                <div class="p-5 rounded-2xl bg-white border border-slate-200/80 shadow-[0_4px_20px_rgb(15,41,66,0.03)] space-y-3">
                    <h4 class="font-bold text-slate-800 text-xs sm:text-sm flex items-center gap-2">
                        <i class="bi bi-shield-check text-emerald-600"></i>
                        <span>គោលការណ៍កត់ត្រាការសងប្រាក់</span>
                    </h4>
                    <ul class="text-xs text-slate-500 space-y-2 list-disc list-inside">
                        <li>ទឹកប្រាក់ដែលបានបង់ នឹងត្រូវកាត់កងដោយស្វ័យប្រវត្តិពី <b>Total Payable</b> របស់កិច្ចសន្យា។</li>
                        <li>ប្រសិនបើសមតុល្យសងស្មើ $0.00 ប្រព័ន្ធនឹងប្តូរស្ថានភាពកិច្ចសន្យាទៅជា <b>បិទបញ្ចប់ (Closed)</b> ដោយស្វ័យប្រវត្តិ។</li>
                        <li>វិក្កយបត្រនីមួយៗមានលេខសម្គាល់ <b>Receipt Code</b> សម្រាប់ផ្ទៀងផ្ទាត់ និងបោះពុម្ពជូនអតិថិជន។</li>
                    </ul>
                </div>

            </div>

        </div>

    </div>
</div>
@endsection

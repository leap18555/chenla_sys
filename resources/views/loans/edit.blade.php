@extends('layouts.master')

@section('title', 'កែសម្រួលកិច្ចសន្យាខ្ចី | ធនាគារ ចេនឡា')

@section('content')
@php
    $loanCode = $loan->loan_number ?? ('LN-' . date('Y') . '-' . str_pad($loan->id, 4, '0', STR_PAD_LEFT));
    $startDateVal = $loan->start_date 
        ? (is_string($loan->start_date) ? date('Y-m-d', strtotime($loan->start_date)) : $loan->start_date->format('Y-m-d'))
        : ($loan->created_at ? $loan->created_at->format('Y-m-d') : date('Y-m-d'));

    $currentStatus = ucfirst(strtolower($loan->status ?? 'Active'));
    if (!in_array($currentStatus, ['Active', 'Pending', 'Paid'])) {
        $currentStatus = 'Active';
    }
@endphp

<div x-data="{
        amount: {{ (float) old('amount', $loan->amount ?? 1000) }},
        rate: {{ (float) old('interest_rate', $loan->interest_rate ?? 18) }},
        duration: {{ (int) old('duration', $loan->duration ?? 12) }},
        method: '{{ old('method', $loan->method ?? 'Declining') }}',
        get monthlyPayment() {
            let p = parseFloat(this.amount) || 0;
            let r = ((parseFloat(this.rate) || 0) / 100) / 12;
            let m = Math.max(1, parseInt(this.duration) || 1);
            if (this.method === 'Declining' && r > 0) {
                return (p * (r * Math.pow(1 + r, m)) / (Math.pow(1 + r, m) - 1)).toFixed(2);
            } else {
                let totalInterest = p * (parseFloat(this.rate) / 100) * (m / 12);
                return ((p + totalInterest) / m).toFixed(2);
            }
        },
        get totalInterest() {
            let p = parseFloat(this.amount) || 0;
            let m = Math.max(1, parseInt(this.duration) || 1);
            let total = parseFloat(this.monthlyPayment) * m;
            return Math.max(0, total - p).toFixed(2);
        },
        get totalPayable() {
            let m = Math.max(1, parseInt(this.duration) || 1);
            return (parseFloat(this.monthlyPayment) * m).toFixed(2);
        }
     }" 
     class="max-w-4xl mx-auto space-y-6">

        {{-- TOP HEADER & BACK NAVIGATION --}}
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 bg-white p-5 rounded-2xl border border-slate-200/80 shadow-[0_4px_20px_rgb(15,41,66,0.03)]">
            <div class="flex items-center gap-3">
                <a href="{{ route('loans.show', $loan->id) }}" 
                   class="w-10 h-10 rounded-xl bg-slate-50 hover:bg-slate-100 border border-slate-200 flex items-center justify-center text-slate-600 hover:text-slate-900 transition-all active:scale-95 shadow-xs"
                   title="ត្រឡប់ទៅកាន់ព័ត៌មានលម្អិតកម្ចី">
                    <i class="bi bi-arrow-left text-base"></i>
                </a>
                <div>
                    <div class="flex items-center gap-2 flex-wrap">
                        <a href="{{ route('loans.index') }}" class="text-xs font-semibold text-slate-400 hover:text-slate-600">កិច្ចសន្យាខ្ចី</a>
                        <i class="bi bi-chevron-right text-[10px] text-slate-300"></i>
                        <a href="{{ route('loans.show', $loan->id) }}" class="text-xs font-bold text-teal-700 hover:underline">{{ $loanCode }}</a>
                        <i class="bi bi-chevron-right text-[10px] text-slate-300"></i>
                        <span class="text-xs font-medium text-slate-600">កែសម្រួលទិន្នន័យ</span>
                    </div>
                    <h1 class="text-lg sm:text-xl font-bold text-[#0B2B40] mt-0.5">
                        កែសម្រួលកិច្ចសន្យាខ្ចី <span class="text-teal-700">#{{ $loanCode }}</span>
                    </h1>
                </div>
            </div>

            <div class="flex items-center gap-2.5">
                @if(strtolower($currentStatus) === 'active')
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">
                        <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                        សកម្ម (Active)
                    </span>
                @elseif(strtolower($currentStatus) === 'paid')
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-blue-50 text-blue-700 border border-blue-200">
                        <i class="bi bi-check-circle-fill text-xs text-blue-500"></i>
                        បានសងរួច (Paid)
                    </span>
                @else
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-amber-50 text-amber-700 border border-amber-200">
                        <span class="w-2 h-2 rounded-full bg-amber-500"></span>
                        រង់ចាំ (Pending)
                    </span>
                @endif

                <a href="{{ route('loans.show', $loan->id) }}" 
                   class="inline-flex items-center gap-1.5 px-3.5 py-2 rounded-xl text-xs font-semibold text-slate-700 bg-slate-50 hover:bg-slate-100 border border-slate-200 transition">
                    <i class="bi bi-eye"></i>
                    <span class="hidden sm:inline">មើលកាលវិភាគ</span>
                </a>
            </div>
        </div>

        {{-- VALIDATION ERRORS BANNER --}}
        @if ($errors->any())
            <div class="rounded-2xl bg-rose-50 border border-rose-200/80 p-5 shadow-xs text-rose-800">
                <div class="flex items-start gap-3">
                    <div class="w-9 h-9 rounded-xl bg-rose-100 text-rose-700 flex items-center justify-center shrink-0 mt-0.5">
                        <i class="bi bi-exclamation-triangle-fill text-base"></i>
                    </div>
                    <div>
                        <h4 class="font-bold text-xs sm:text-sm">សូមពិនិត្យមើលកំហុសខាងក្រោមមុននឹងរក្សាទុក៖</h4>
                        <ul class="list-disc list-inside text-xs text-rose-700 mt-1.5 space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endif

        {{-- LIVE CALCULATION ESTIMATE BAR --}}
        <div class="rounded-2xl bg-gradient-to-r from-[#142d42] to-[#1e5158] text-white p-5 shadow-md">
            <div class="flex items-center justify-between mb-3 border-b border-white/10 pb-3">
                <span class="text-xs font-semibold text-teal-200 flex items-center gap-1.5">
                    <i class="bi bi-calculator"></i>
                    <span>ការគណនាស្វ័យប្រវត្តិតាមទិន្នន័យថ្មី (Live Estimate Preview)</span>
                </span>
                <span class="text-[11px] font-bold uppercase tracking-wider bg-white/10 px-2 py-0.5 rounded text-white/90">
                    <span x-text="method === 'Declining' ? 'សមតុល្យថយចុះ' : 'ការប្រាក់ថេរ'"></span>
                </span>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div class="bg-white/5 rounded-xl p-3 border border-white/10">
                    <span class="block text-[11px] text-slate-300">ត្រូវបង់ប្រចាំខែ (Monthly Payment)</span>
                    <span class="text-xl font-black text-emerald-300 tracking-tight">
                        $<span x-text="monthlyPayment"></span>
                    </span>
                </div>
                <div class="bg-white/5 rounded-xl p-3 border border-white/10">
                    <span class="block text-[11px] text-slate-300">ការប្រាក់សរុប (Total Interest)</span>
                    <span class="text-xl font-black text-amber-300 tracking-tight">
                        $<span x-text="totalInterest"></span>
                    </span>
                </div>
                <div class="bg-white/5 rounded-xl p-3 border border-white/10">
                    <span class="block text-[11px] text-slate-300">ទឹកប្រាក់សរុប (Total Payable)</span>
                    <span class="text-xl font-black text-teal-200 tracking-tight">
                        $<span x-text="totalPayable"></span>
                    </span>
                </div>
            </div>
        </div>

        {{-- MAIN FORM CARD --}}
        <div class="bg-white border border-slate-200/80 rounded-2xl shadow-[0_4px_20px_rgb(15,41,66,0.03)] overflow-hidden">
            <div class="h-1.5 w-full bg-gradient-to-r from-[#142d42] via-[#1e5158] to-[#4caf7c]"></div>

            <form action="{{ route('loans.update', $loan->id) }}" method="POST" class="p-6 sm:p-8 space-y-6">
                @csrf
                @method('PUT')

                {{-- SECTION 1: BORROWER & IDENTIFIERS --}}
                <div>
                    <div class="flex items-center gap-2 pb-2 mb-4 border-b border-slate-100">
                        <i class="bi bi-person-badge text-[#0F4C5C] text-base"></i>
                        <h3 class="text-sm font-bold text-[#0B2B40]">ព័ត៌មានអតិថិជន និងកិច្ចសន្យា</h3>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        {{-- Customer Select --}}
                        <div>
                            <label for="customer_id" class="block text-xs font-bold text-slate-600 mb-2 flex items-center justify-between">
                                <span>អតិថិជន (Borrower) <span class="text-rose-500">*</span></span>
                                <span class="text-[11px] font-normal text-slate-400">ជ្រើសរើសពីបញ្ជី</span>
                            </label>
                            <div class="relative">
                                <select name="customer_id" id="customer_id" required
                                        class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:border-teal-500 focus:ring-4 focus:ring-teal-500/10 text-xs text-slate-900 font-medium transition appearance-none cursor-pointer">
                                    @foreach($customers as $c)
                                        <option value="{{ $c->id }}" {{ old('customer_id', $loan->customer_id) == $c->id ? 'selected' : '' }}>
                                            {{ $c->name }} (ID-{{ str_pad($c->id, 5, '0', STR_PAD_LEFT) }})
                                        </option>
                                    @endforeach
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-4 flex items-center text-slate-400">
                                    <i class="bi bi-chevron-down text-xs"></i>
                                </div>
                            </div>
                        </div>

                        {{-- Loan Number (Locked) --}}
                        <div>
                            <label for="loan_number" class="block text-xs font-bold text-slate-600 mb-2 flex items-center justify-between">
                                <span>លេខកូដកិច្ចសន្យា (Loan Number) <span class="text-rose-500">*</span></span>
                                <span class="text-[11px] text-slate-400 font-normal"><i class="bi bi-lock-fill"></i> កូដសម្គាល់</span>
                            </label>
                            <div class="relative">
                                <input type="text" name="loan_number" id="loan_number" 
                                       value="{{ old('loan_number', $loanCode) }}" 
                                       class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-100/70 text-xs text-slate-700 font-bold focus:outline-none cursor-not-allowed">
                                <div class="absolute inset-y-0 right-4 flex items-center text-slate-400">
                                    <i class="bi bi-shield-check text-xs"></i>
                                </div>
                            </div>
                        </div>

                        {{-- Purpose --}}
                        <div>
                            <label for="purpose" class="block text-xs font-bold text-slate-600 mb-2">គោលបំណងកម្ចី (Loan Purpose)</label>
                            <div class="relative">
                                <select name="purpose" id="purpose" 
                                        class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:border-teal-500 focus:ring-4 focus:ring-teal-500/10 text-xs text-slate-900 font-medium transition appearance-none cursor-pointer">
                                    <option value="business" {{ old('purpose', strtolower($loan->purpose ?? 'business')) == 'business' ? 'selected' : '' }}>ធុរកិច្ច (Business)</option>
                                    <option value="personal" {{ old('purpose', strtolower($loan->purpose ?? '')) == 'personal' ? 'selected' : '' }}>ផ្ទាល់ខ្លួន (Personal)</option>
                                    <option value="education" {{ old('purpose', strtolower($loan->purpose ?? '')) == 'education' ? 'selected' : '' }}>ការសិក្សា (Education)</option>
                                    <option value="housing" {{ old('purpose', strtolower($loan->purpose ?? '')) == 'housing' ? 'selected' : '' }}>គេហដ្ឋាន (Housing)</option>
                                    <option value="other" {{ old('purpose', strtolower($loan->purpose ?? '')) == 'other' ? 'selected' : '' }}>ផ្សេងៗ (Other)</option>
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-4 flex items-center text-slate-400">
                                    <i class="bi bi-chevron-down text-xs"></i>
                                </div>
                            </div>
                        </div>

                        {{-- Loan Type / Currency --}}
                        <div class="grid grid-cols-2 gap-3">
                            <div>
                                <label class="block text-xs font-bold text-slate-600 mb-2">ប្រភេទ (Type)</label>
                                <input type="text" name="type" value="{{ old('type', $loan->type ?? 'Personal') }}"
                                       class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:border-teal-500 text-xs text-slate-900 font-medium transition">
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-slate-600 mb-2">រូបិយប័ណ្ណ (Currency)</label>
                                <input type="text" value="{{ $loan->currency ?? 'USD' }}" readonly
                                       class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-100 text-xs text-slate-600 font-bold cursor-not-allowed">
                            </div>
                        </div>
                    </div>
                </div>

                {{-- SECTION 2: FINANCIAL TERMS & RATES --}}
                <div class="pt-2">
                    <div class="flex items-center gap-2 pb-2 mb-4 border-b border-slate-100">
                        <i class="bi bi-cash-stack text-[#0F4C5C] text-base"></i>
                        <h3 class="text-sm font-bold text-[#0B2B40]">លក្ខខណ្ឌហិរញ្ញវត្ថុ & ការប្រាក់</h3>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        {{-- Principal Amount --}}
                        <div>
                            <label for="amount" class="block text-xs font-bold text-slate-600 mb-2">
                                ចំនួនប្រាក់ដើម ($) <span class="text-rose-500">*</span>
                            </label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-3.5 flex items-center text-emerald-600 font-bold text-sm">$</span>
                                <input type="number" step="0.01" min="1" name="amount" id="amount" 
                                       x-model.number="amount"
                                       value="{{ old('amount', $loan->amount) }}" required
                                       class="w-full pl-8 pr-4 py-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:border-teal-500 focus:ring-4 focus:ring-teal-500/10 text-xs text-slate-900 font-black transition">
                            </div>
                        </div>

                        {{-- Interest Rate --}}
                        <div>
                            <label for="interest_rate" class="block text-xs font-bold text-slate-600 mb-2">
                                អត្រាការប្រាក់ (% ក្នុងមួយឆ្នាំ) <span class="text-rose-500">*</span>
                            </label>
                            <div class="relative">
                                <span class="absolute inset-y-0 right-4 flex items-center text-teal-600 font-bold text-xs">% / ឆ្នាំ</span>
                                <input type="number" step="0.01" min="0" name="interest_rate" id="interest_rate" 
                                       x-model.number="rate"
                                       value="{{ old('interest_rate', $loan->interest_rate) }}" required
                                       class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:border-teal-500 focus:ring-4 focus:ring-teal-500/10 text-xs text-slate-900 font-black transition">
                            </div>
                        </div>

                        {{-- Duration --}}
                        <div>
                            <label for="duration" class="block text-xs font-bold text-slate-600 mb-2">
                                ចំនួនដងបង់ / រយៈពេល (ខែ) <span class="text-rose-500">*</span>
                            </label>
                            <div class="relative">
                                <span class="absolute inset-y-0 right-4 flex items-center text-slate-400 font-medium text-xs">ខែ (Months)</span>
                                <input type="number" min="1" max="360" name="duration" id="duration" 
                                       x-model.number="duration"
                                       value="{{ old('duration', $loan->duration) }}" required
                                       class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:border-teal-500 focus:ring-4 focus:ring-teal-500/10 text-xs text-slate-900 font-bold transition">
                            </div>
                        </div>

                        {{-- Frequency --}}
                        <div>
                            <label for="frequency" class="block text-xs font-bold text-slate-600 mb-2">
                                ប្រេកង់នៃការបង់ (Payment Frequency) <span class="text-rose-500">*</span>
                            </label>
                            <div class="relative">
                                <select name="frequency" id="frequency" required
                                        class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:border-teal-500 focus:ring-4 focus:ring-teal-500/10 text-xs text-slate-900 font-semibold transition appearance-none cursor-pointer">
                                    <option value="Monthly" {{ old('frequency', $loan->frequency ?? 'Monthly') == 'Monthly' ? 'selected' : '' }}>ប្រចាំខែ (Monthly)</option>
                                    <option value="Weekly" {{ old('frequency', $loan->frequency) == 'Weekly' ? 'selected' : '' }}>ប្រចាំសប្តាហ៍ (Weekly)</option>
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-4 flex items-center text-slate-400">
                                    <i class="bi bi-chevron-down text-xs"></i>
                                </div>
                            </div>
                        </div>

                        {{-- Start Date --}}
                        <div>
                            <label for="start_date" class="block text-xs font-bold text-slate-600 mb-2">
                                កាលបរិច្ឆេទចាប់ផ្តើម (Start Date) <span class="text-rose-500">*</span>
                            </label>
                            <input type="date" name="start_date" id="start_date" 
                                   value="{{ old('start_date', $startDateVal) }}" required
                                   class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:border-teal-500 focus:ring-4 focus:ring-teal-500/10 text-xs text-slate-900 font-medium transition">
                        </div>

                        {{-- Calculation Method --}}
                        <div>
                            <label for="method" class="block text-xs font-bold text-slate-600 mb-2">
                                វិធីសាស្ត្រគណនាការប្រាក់ <span class="text-rose-500">*</span>
                            </label>
                            <div class="relative">
                                <select name="method" id="method" required 
                                        x-model="method"
                                        class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:border-teal-500 focus:ring-4 focus:ring-teal-500/10 text-xs text-slate-900 font-semibold transition appearance-none cursor-pointer">
                                    <option value="Declining">សមតុល្យថយចុះ (Declining Balance - ស្តង់ដារ)</option>
                                    <option value="Fixed">ការប្រាក់ថេរ (Fixed / Flat Rate)</option>
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-4 flex items-center text-slate-400">
                                    <i class="bi bi-chevron-down text-xs"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- SECTION 3: STATUS & APPROVAL --}}
                <div class="pt-2">
                    <div class="flex items-center gap-2 pb-2 mb-4 border-b border-slate-100">
                        <i class="bi bi-sliders text-[#0F4C5C] text-base"></i>
                        <h3 class="text-sm font-bold text-[#0B2B40]">ស្ថានភាពកិច្ចសន្យា (Contract Status)</h3>
                    </div>

                    <div class="max-w-md">
                        <label for="status" class="block text-xs font-bold text-slate-600 mb-2">
                            ស្ថានភាពបច្ចុប្បន្ន <span class="text-rose-500">*</span>
                        </label>
                        <div class="relative">
                            <select name="status" id="status" required
                                    class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:border-teal-500 focus:ring-4 focus:ring-teal-500/10 text-xs text-slate-900 font-bold transition appearance-none cursor-pointer">
                                <option value="Active" {{ old('status', $currentStatus) == 'Active' ? 'selected' : '' }}>🟢 សកម្ម (Active - កំពុងដំណើរការ)</option>
                                <option value="Pending" {{ old('status', $currentStatus) == 'Pending' ? 'selected' : '' }}>🟡 រង់ចាំការអនុម័ត (Pending)</option>
                                <option value="Paid" {{ old('status', $currentStatus) == 'Paid' ? 'selected' : '' }}>🔵 បានទូទាត់រួច / បិទកិច្ចសន្យា (Paid)</option>
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-4 flex items-center text-slate-400">
                                <i class="bi bi-chevron-down text-xs"></i>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- ACTION BUTTONS --}}
                <div class="pt-6 border-t border-slate-100 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                    <div class="text-[11px] text-slate-400 flex items-center gap-1.5">
                        <i class="bi bi-info-circle text-teal-600"></i>
                        <span>ការកែប្រែប្រាក់ដើម ឬអត្រាការប្រាក់នឹងគណនាកាលវិភាគសងឡើងវិញដោយស្វ័យប្រវត្តិ។</span>
                    </div>

                    <div class="flex items-center gap-3">
                        <a href="{{ route('loans.show', $loan->id) }}" 
                           class="px-5 py-2.5 rounded-xl border border-slate-200 bg-white hover:bg-slate-50 text-slate-600 text-xs font-semibold shadow-xs transition">
                            បោះបង់
                        </a>
                        <button type="submit" 
                                class="inline-flex items-center gap-2 px-6 py-2.5 rounded-xl bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-emerald-700 hover:to-teal-700 text-white text-xs font-bold shadow-md shadow-emerald-700/10 transition-all active:scale-95">
                            <i class="bi bi-check-circle-fill"></i>
                            <span>រក្សាទុកការកែប្រែ</span>
                        </button>
                    </div>
                </div>

            </form>
        </div>

    </div>
@endsection

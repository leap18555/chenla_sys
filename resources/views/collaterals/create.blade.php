@extends('layouts.master')

@section('title', 'បន្ថែមទ្រព្យបញ្ចាំថ្មី | ធនាគារ ចេនឡា (Add Collateral)')

@section('content')
@php
    // Prepare customer and loan lookup datasets for reactive Alpine.js interactivity
    $customersData = $customers->map(function($c) {
        return [
            'id' => $c->id,
            'name' => $c->name,
            'phone' => $c->phone ?? 'គ្មានលេខទូរស័ព្ទ',
            'id_number' => $c->id_number ?? 'N/A',
        ];
    });

    $loansData = $loans->map(function($l) {
        return [
            'id' => $l->id,
            'customer_id' => $l->customer_id,
            'customer_name' => $l->customer?->name ?? 'អតិថិជន',
            'loan_number' => $l->loan_number ?? $l->loan_code ?? ('LN-' . str_pad($l->id, 4, '0', STR_PAD_LEFT)),
            'amount' => (float)$l->amount,
            'formatted_amount' => number_format((float)$l->amount, 2),
        ];
    });
@endphp

<div x-data="{
        customers: {{ Js::from($customersData) }},
        loans: {{ Js::from($loansData) }},
        selectedCustomerId: '{{ old('customer_id', '') }}',
        selectedLoanId: '{{ old('loan_id', '') }}',
        type: '{{ old('type', 'ប័ណ្ណកម្មសិទ្ធិដី') }}',
        value: '{{ old('value', '') }}',
        documentNumber: '{{ old('document_number', '') }}',
        receivedDate: '{{ old('received_date', date('Y-m-d')) }}',
        status: '{{ old('status', 'កំពុងរក្សាទុក') }}',
        description: '{{ old('description', '') }}',
        fileName: '',

        get selectedCustomer() {
            return this.customers.find(c => c.id == this.selectedCustomerId) || null;
        },

        get selectedLoan() {
            return this.loans.find(l => l.id == this.selectedLoanId) || null;
        },

        get customerLoans() {
            if (!this.selectedCustomerId) return this.loans;
            return this.loans.filter(l => l.customer_id == this.selectedCustomerId);
        },

        onCustomerChange() {
            if (this.selectedCustomerId && this.selectedLoanId) {
                const currentLoan = this.selectedLoan;
                if (currentLoan && currentLoan.customer_id != this.selectedCustomerId) {
                    this.selectedLoanId = '';
                }
            }
        },

        onLoanChange() {
            if (this.selectedLoanId) {
                const loan = this.selectedLoan;
                if (loan && loan.customer_id) {
                    this.selectedCustomerId = loan.customer_id;
                }
            }
        },

        get formattedValue() {
            const num = parseFloat(this.value);
            return isNaN(num) ? '0.00' : num.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
        },

        getCategoryIcon(cat) {
            if (cat.includes('ដី') || cat.toLowerCase().includes('land')) return 'bi-house-check';
            if (cat.includes('យានយន្ត') || cat.toLowerCase().includes('vehicle')) return 'bi-car-front';
            if (cat.includes('មាស') || cat.includes('អលង្ការ') || cat.toLowerCase().includes('gold')) return 'bi-gem';
            if (cat.includes('អេឡិចត្រូនិក') || cat.toLowerCase().includes('electronic')) return 'bi-laptop';
            return 'bi-shield-check';
        }
     }" 
     class="space-y-6">

    <!-- Top Header & Navigation Banner -->
    <div class="rounded-2xl bg-white border border-slate-200/90 shadow-2xs overflow-hidden">
        <div class="h-1.5 w-full bg-gradient-to-r from-[#0B2B40] via-[#0F4C5C] to-[#10B981]"></div>
        
        <div class="p-5 sm:p-6 flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div class="flex items-center gap-3.5">
                <a href="{{ route('collaterals.index') }}" 
                   class="w-10 h-10 rounded-xl bg-slate-50 hover:bg-slate-100 border border-slate-200 flex items-center justify-center text-slate-600 hover:text-slate-900 transition-all active:scale-95 shadow-xs"
                   title="ត្រឡប់ទៅកាន់បញ្ជីទ្រព្យបញ្ចាំ">
                    <i class="bi bi-arrow-left text-base"></i>
                </a>
                <div>
                    <div class="flex items-center gap-2 flex-wrap">
                        <a href="{{ route('collaterals.index') }}" class="text-xs font-semibold text-slate-400 hover:text-slate-600 transition flex items-center gap-1">
                            <i class="bi bi-safe2"></i>
                            <span>ឃ្លាំងទ្រព្យបញ្ចាំ</span>
                        </a>
                        <i class="bi bi-chevron-right text-[10px] text-slate-300"></i>
                        <span class="text-xs font-semibold text-[#10B981]">បញ្ចូលទ្រព្យបញ្ចាំថ្មី</span>
                    </div>
                    <h1 class="text-xl sm:text-2xl font-black text-[#0B2B40] tracking-tight mt-0.5">
                        បន្ថែមទ្រព្យបញ្ចាំក្នុងឃ្លាំង (Add Collateral)
                    </h1>
                </div>
            </div>

            <div class="flex items-center gap-2.5 flex-wrap">
                <a href="{{ route('collaterals.index') }}" 
                   class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl text-xs sm:text-sm font-semibold text-slate-700 bg-white hover:bg-slate-50 border border-slate-300 shadow-2xs transition-all active:scale-[0.98]">
                    <i class="bi bi-view-list text-slate-500"></i>
                    <span>បញ្ជីទ្រព្យបញ្ចាំទាំងអស់</span>
                </a>

                <a href="{{ route('loans.index') }}" 
                   class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl text-xs sm:text-sm font-semibold text-slate-700 bg-slate-50 hover:bg-slate-100 border border-slate-200 shadow-2xs transition-all active:scale-[0.98]">
                    <i class="bi bi-file-earmark-check text-slate-500"></i>
                    <span>កិច្ចសន្យាកម្ចី</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Alert Notifications -->
    @if(session('success'))
    <div x-data="{ show: true }" x-show="show" x-transition class="rounded-xl bg-emerald-50 border border-emerald-200 p-4 flex items-center justify-between text-[#0B2B40] shadow-2xs">
        <div class="flex items-center gap-3">
            <div class="w-8 h-8 rounded-lg bg-emerald-100 text-emerald-700 flex items-center justify-center shrink-0">
                <i class="bi bi-check-circle-fill text-lg text-[#059669]"></i>
            </div>
            <div>
                <h4 class="font-bold text-xs sm:text-sm text-emerald-900">ប្រតិបត្តិការជោគជ័យ (Success)</h4>
                <p class="text-xs text-emerald-700 mt-0.5">{{ session('success') }}</p>
            </div>
        </div>
        <button @click="show = false" class="text-emerald-500 hover:text-emerald-800 p-1.5 rounded-lg hover:bg-emerald-100/50 transition">
            <i class="bi bi-x-lg"></i>
        </button>
    </div>
    @endif

    @if($errors->any())
    <div x-data="{ show: true }" x-show="show" x-transition class="rounded-xl bg-rose-50 border border-rose-200 p-4 flex items-start justify-between text-rose-900 shadow-2xs">
        <div class="flex items-start gap-3">
            <div class="w-8 h-8 rounded-lg bg-rose-100 text-rose-700 flex items-center justify-center shrink-0 mt-0.5">
                <i class="bi bi-exclamation-triangle-fill text-rose-600"></i>
            </div>
            <div>
                <h4 class="font-bold text-xs sm:text-sm text-rose-900">មានបញ្ហាក្នុងការបញ្ចូលទិន្នន័យ (Validation Error)</h4>
                <ul class="text-xs text-rose-700 list-disc list-inside mt-1 space-y-0.5">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
        <button @click="show = false" class="text-rose-400 hover:text-rose-700 p-1.5 rounded-lg hover:bg-rose-100 transition">
            <i class="bi bi-x-lg"></i>
        </button>
    </div>
    @endif

    <!-- Main Content Grid: Left Form (7 cols) + Right Live Preview & Guidance (5 cols) -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">

        <!-- Form Column (7 cols on lg) -->
        <div class="lg:col-span-7 bg-white rounded-2xl border border-slate-200/90 shadow-2xs overflow-hidden">
            <div class="h-1 w-full bg-gradient-to-r from-[#0B2B40] to-[#10B981]"></div>
            
            <div class="p-5 sm:p-7">
                <!-- Header -->
                <div class="flex items-center justify-between pb-4 mb-6 border-b border-slate-100">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-[#EEF7F0] text-[#059669] flex items-center justify-center font-bold">
                            <i class="bi bi-shield-plus text-xl"></i>
                        </div>
                        <div>
                            <span class="text-[10px] font-bold tracking-wider text-slate-400 uppercase">VAULT INTAKE // បញ្ចូលទ្រព្យ</span>
                            <h2 class="text-base font-bold text-[#0B2B40]">ទម្រង់កត់ត្រាព័ត៌មានទ្រព្យបញ្ចាំ</h2>
                        </div>
                    </div>
                    <span class="text-[11px] bg-emerald-50 text-emerald-700 font-bold px-3 py-1 rounded-md border border-emerald-100 flex items-center gap-1.5">
                        <i class="bi bi-lock-fill text-[11px]"></i> សម្ងាត់ និងមានសុវត្ថិភាព
                    </span>
                </div>

                <form action="{{ route('collaterals.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                    @csrf
                    
                    <!-- Borrower Customer Selection -->
                    <div>
                        <label class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-1.5">
                            អតិថិជនម្ចាស់ទ្រព្យ / អ្នកខ្ចី (Borrower) <span class="text-rose-500">*</span>
                        </label>
                        <select name="customer_id" 
                                x-model="selectedCustomerId" 
                                @change="onCustomerChange()" 
                                class="w-full border border-slate-200 rounded-xl px-3.5 py-2.5 bg-slate-50 text-xs font-semibold text-slate-800 focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#10B981]/20 focus:border-[#10B981] transition" 
                                required>
                            <option value="">-- ជ្រើសរើសអតិថិជន --</option>
                            @foreach($customers as $customer)
                                <option value="{{ $customer->id }}" {{ old('customer_id') == $customer->id ? 'selected' : '' }}>
                                    {{ $customer->name }} ({{ $customer->phone ?? 'គ្មានលេខទូរស័ព្ទ' }})
                                </option>
                            @endforeach
                        </select>
                        <p class="text-[11px] text-slate-400 mt-1">ជ្រើសរើសឈ្មោះអតិថិជនដើម្បីស្វែងរកកិច្ចសន្យាកម្ចីដែលពាក់ព័ន្ធ</p>
                    </div>

                    <!-- Associated Loan Contract Selection -->
                    <div>
                        <label class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-1.5">
                            កិច្ចសន្យាកម្ចីពាក់ព័ន្ធ (Associated Loan) <span class="text-rose-500">*</span>
                        </label>
                        <select name="loan_id" 
                                x-model="selectedLoanId" 
                                @change="onLoanChange()" 
                                class="w-full border border-slate-200 rounded-xl px-3.5 py-2.5 bg-slate-50 text-xs font-semibold text-slate-800 focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#10B981]/20 focus:border-[#10B981] transition" 
                                required>
                            <option value="">-- ជ្រើសរើសកូដកម្ចី --</option>
                            <template x-for="loan in customerLoans" :key="loan.id">
                                <option :value="loan.id" 
                                        :selected="loan.id == selectedLoanId"
                                        x-text="loan.loan_number + ' - ' + loan.customer_name + ' ($' + loan.formatted_amount + ')'">
                                </option>
                            </template>
                        </select>
                        <p class="text-[11px] text-slate-400 mt-1">ទ្រព្យបញ្ចាំត្រូវភ្ជាប់ជាមួយកិច្ចសន្យាកម្ចីដើម្បីធានាសុពលភាពច្បាប់</p>
                    </div>

                    <!-- Asset Category & Value -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-1.5">
                                ប្រភេទទ្រព្យធានា (Category) <span class="text-rose-500">*</span>
                            </label>
                            <select name="type" 
                                    x-model="type" 
                                    class="w-full border border-slate-200 rounded-xl px-3.5 py-2.5 bg-slate-50 text-xs font-semibold text-slate-800 focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#10B981]/20 focus:border-[#10B981] transition" 
                                    required>
                                <option value="ប័ណ្ណកម្មសិទ្ធិដី">ប័ណ្ណកម្មសិទ្ធិដី (Land Title Deed)</option>
                                <option value="យានយន្ត">យានយន្ត (Vehicles)</option>
                                <option value="គ្រឿងអលង្ការ / មាស">គ្រឿងអលង្ការ / មាស (Jewelry & Gold)</option>
                                <option value="គ្រឿងអេឡិចត្រូនិក">គ្រឿងអេឡិចត្រូនិក (Electronics)</option>
                                <option value="ផ្សេងៗ">ផ្សេងៗ (Other Assets)</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-1.5">
                                តម្លៃប៉ាន់ស្មានទីផ្សារ (Est. Value $) <span class="text-rose-500">*</span>
                            </label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center text-slate-400 font-black text-sm">$</span>
                                <input type="number" 
                                       name="value" 
                                       x-model="value" 
                                       step="0.01" 
                                       min="0" 
                                       placeholder="0.00" 
                                       class="w-full pl-8 pr-3.5 border border-slate-200 rounded-xl py-2.5 bg-slate-50 text-xs font-bold text-slate-800 focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#10B981]/20 focus:border-[#10B981] transition" 
                                       required>
                            </div>
                        </div>
                    </div>

                    <!-- Document Number & Received Date -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-1.5">
                                លេខប័ណ្ណ / លេខឯកសារ (Doc No.)
                            </label>
                            <input type="text" 
                                   name="document_number" 
                                   x-model="documentNumber" 
                                   placeholder="ឧ. Nº 00234 / ភ្នំពេញ-08" 
                                   class="w-full border border-slate-200 rounded-xl px-3.5 py-2.5 bg-slate-50 text-xs font-medium text-slate-800 focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#10B981]/20 focus:border-[#10B981] transition">
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-1.5">
                                ថ្ងៃទទួលចូលឃ្លាំង (Received Date) <span class="text-rose-500">*</span>
                            </label>
                            <input type="date" 
                                   name="received_date" 
                                   x-model="receivedDate" 
                                   class="w-full border border-slate-200 rounded-xl px-3.5 py-2.5 bg-slate-50 text-xs font-semibold text-slate-800 focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#10B981]/20 focus:border-[#10B981] transition" 
                                   required>
                        </div>
                    </div>

                    <!-- Status Selection -->
                    <div>
                        <label class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-1.5">
                            ស្ថានភាពរក្សាទុកក្នុងឃ្លាំង (Vault Status) <span class="text-rose-500">*</span>
                        </label>
                        <div class="grid grid-cols-2 gap-3">
                            <label class="relative flex items-center p-3 rounded-xl border border-slate-200 bg-slate-50/70 hover:bg-emerald-50/50 cursor-pointer transition">
                                <input type="radio" 
                                       name="status" 
                                       value="កំពុងរក្សាទុក" 
                                       x-model="status" 
                                       class="text-[#10B981] focus:ring-[#10B981]">
                                <span class="ml-2.5 text-xs font-bold text-slate-700 flex items-center gap-1.5">
                                    <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span> កំពុងរក្សាទុក (In Vault)
                                </span>
                            </label>
                            <label class="relative flex items-center p-3 rounded-xl border border-slate-200 bg-slate-50/70 hover:bg-slate-100 cursor-pointer transition">
                                <input type="radio" 
                                       name="status" 
                                       value="បានដកវិញ" 
                                       x-model="status" 
                                       class="text-slate-600 focus:ring-slate-500">
                                <span class="ml-2.5 text-xs font-bold text-slate-600 flex items-center gap-1.5">
                                    <span class="w-2 h-2 rounded-full bg-slate-400"></span> បានដកវិញ (Released)
                                </span>
                            </label>
                        </div>
                    </div>

                    <!-- Detailed Description -->
                    <div>
                        <label class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-1.5">
                            ព័ត៌មានលម្អិតអំពីទ្រព្យ (Asset Description & Condition)
                        </label>
                        <textarea name="description" 
                                  x-model="description" 
                                  rows="3" 
                                  placeholder="បញ្ជាក់ម៉ាក ម៉ូឌែល លេខតួ ទីតាំងដី ទំហំ ក្បាលដី ឬស្ថានភាពជាក់ស្តែងនៃទ្រព្យ..." 
                                  class="w-full border border-slate-200 rounded-xl p-3 bg-slate-50 text-xs font-medium text-slate-800 focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#10B981]/20 focus:border-[#10B981] transition"></textarea>
                    </div>

                    <!-- File Upload Attachment -->
                    <div>
                        <label class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-1.5">
                            ឯកសារភ្ជាប់ ឬរូបថតទ្រព្យ (Attachment / Legal Document)
                        </label>
                        <div class="border-2 border-dashed border-slate-200 hover:border-[#10B981] rounded-2xl p-5 text-center bg-slate-50/60 hover:bg-emerald-50/30 transition group relative cursor-pointer">
                            <input type="file" 
                                   name="reference_document" 
                                   @change="fileName = $event.target.files[0] ? $event.target.files[0].name : ''" 
                                   class="absolute inset-0 opacity-0 cursor-pointer z-10">
                            <div class="flex flex-col items-center justify-center space-y-2">
                                <div class="w-12 h-12 rounded-xl bg-white shadow-2xs border border-slate-200 flex items-center justify-center text-[#059669] group-hover:scale-110 group-hover:bg-[#EEF7F0] transition">
                                    <i class="bi bi-cloud-arrow-up-fill text-xl"></i>
                                </div>
                                <div class="text-xs text-slate-700 font-bold" x-text="fileName ? fileName : 'ចុចដើម្បីជ្រើសរើស ឬទម្លាក់ឯកសារនៅទីនេះ'"></div>
                                <p class="text-[11px] text-slate-400">ទ្រទ្រង់ប្រភេទ PDF, PNG, JPG, JPEG (ទំហំអតិបរមា 10MB)</p>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="pt-4 border-t border-slate-100 flex items-center justify-end gap-3">
                        <a href="{{ route('collaterals.index') }}" 
                           class="px-5 py-2.5 rounded-xl text-xs font-bold text-slate-600 bg-slate-100 hover:bg-slate-200 transition">
                            បោះបង់ (Cancel)
                        </a>
                        <button type="submit" 
                                class="bg-[#0B2B40] hover:bg-[#0F4C5C] text-white font-bold py-2.5 px-6 rounded-xl shadow-xs transition duration-200 flex items-center justify-center gap-2 text-xs uppercase tracking-wider active:scale-[0.99]">
                            <i class="bi bi-check2-circle text-base text-[#10B981]"></i>
                            <span>រក្សាទុកទ្រព្យបញ្ចាំក្នុងឃ្លាំង</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Right Column: Live Summary Assistant & Inspection Checklist (5 cols on lg) -->
        <div class="lg:col-span-5 space-y-6">

            <!-- Live Preview Card -->
            <div class="bg-white rounded-2xl border border-slate-200/90 shadow-2xs overflow-hidden">
                <div class="h-1 w-full bg-gradient-to-r from-[#10B981] to-[#0B2B40]"></div>
                
                <div class="p-5 sm:p-6">
                    <div class="flex items-center justify-between pb-3 mb-4 border-b border-slate-100">
                        <span class="text-[10px] font-bold tracking-wider text-slate-400 uppercase">PREVIEW // មើលសង្ខេប</span>
                        <span class="text-[11px] font-bold px-2 py-0.5 rounded-md"
                              :class="status === 'កំពុងរក្សាទុក' ? 'bg-emerald-50 text-emerald-700 border border-emerald-200' : 'bg-slate-100 text-slate-600 border border-slate-200'"
                              x-text="status">
                        </span>
                    </div>

                    <!-- Valuation Highlight -->
                    <div class="rounded-xl bg-gradient-to-br from-[#0B2B40] to-[#0F4C5C] text-white p-5 shadow-xs mb-4">
                        <div class="text-[11px] text-emerald-300 font-bold uppercase tracking-wider flex items-center gap-1.5">
                            <i class="bi bi-cash-stack"></i> តម្លៃប៉ាន់ស្មានសរុប (Estimated Value)
                        </div>
                        <div class="text-3xl font-black mt-2 tracking-tight">
                            $<span x-text="formattedValue"></span>
                        </div>
                        <div class="text-[11px] text-slate-300 mt-1 flex items-center gap-1">
                            <i class="bi" :class="getCategoryIcon(type)"></i>
                            <span x-text="type"></span>
                        </div>
                    </div>

                    <!-- Dynamic Details List -->
                    <div class="space-y-3 text-xs">
                        <!-- Borrower -->
                        <div class="flex items-start justify-between py-2 border-b border-slate-100">
                            <span class="text-slate-400 font-medium">អតិថិជនអ្នកខ្ចី៖</span>
                            <span class="font-bold text-slate-800 text-right" x-text="selectedCustomer ? selectedCustomer.name : 'មិនទាន់ជ្រើសរើស'"></span>
                        </div>

                        <!-- Loan Code -->
                        <div class="flex items-start justify-between py-2 border-b border-slate-100">
                            <span class="text-slate-400 font-medium">កិច្ចសន្យាកម្ចី៖</span>
                            <span class="font-bold text-emerald-700 text-right" x-text="selectedLoan ? selectedLoan.loan_number + ' ($' + selectedLoan.formatted_amount + ')' : 'មិនទាន់ជ្រើសរើស'"></span>
                        </div>

                        <!-- Document No -->
                        <div class="flex items-start justify-between py-2 border-b border-slate-100">
                            <span class="text-slate-400 font-medium">លេខប័ណ្ណ/ឯកសារ៖</span>
                            <span class="font-mono font-bold text-slate-800 text-right" x-text="documentNumber ? documentNumber : 'គ្មានលេខប័ណ្ណ'"></span>
                        </div>

                        <!-- Received Date -->
                        <div class="flex items-start justify-between py-2 border-b border-slate-100">
                            <span class="text-slate-400 font-medium">ថ្ងៃទទួលចូលឃ្លាំង៖</span>
                            <span class="font-bold text-slate-800 text-right" x-text="receivedDate"></span>
                        </div>

                        <!-- Uploaded File -->
                        <div class="flex items-start justify-between py-2 border-b border-slate-100">
                            <span class="text-slate-400 font-medium">ឯកសារភ្ជាប់៖</span>
                            <span class="font-bold text-blue-600 text-right truncate max-w-[160px]" x-text="fileName ? fileName : 'មិនមានឯកសារ'"></span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Vault Standards & Security Checklist -->
            <div class="bg-white rounded-2xl border border-slate-200/90 shadow-2xs p-5 sm:p-6">
                <div class="flex items-center gap-2.5 pb-3 mb-4 border-b border-slate-100">
                    <div class="w-8 h-8 rounded-lg bg-emerald-50 text-emerald-700 flex items-center justify-center font-bold">
                        <i class="bi bi-shield-check text-base"></i>
                    </div>
                    <div>
                        <h4 class="text-xs font-bold text-slate-800 uppercase tracking-wider">លក្ខខណ្ឌត្រួតពិនិត្យទ្រព្យ (Checklist)</h4>
                        <p class="text-[11px] text-slate-400">បទដ្ឋានសុវត្ថិភាពឃ្លាំង ធនាគារ ចេនឡា</p>
                    </div>
                </div>

                <ul class="space-y-3 text-xs text-slate-600">
                    <li class="flex items-start gap-2.5">
                        <i class="bi bi-check-circle-fill text-emerald-500 mt-0.5 shrink-0"></i>
                        <span><strong>ផ្ទៀងផ្ទាត់ប័ណ្ណដើម៖</strong> ត្រូវប្រាកដថាប័ណ្ណកម្មសិទ្ធិដី ឬកាតគ្រីយានយន្តជាច្បាប់ដើមពិតប្រាកដ។</span>
                    </li>
                    <li class="flex items-start gap-2.5">
                        <i class="bi bi-check-circle-fill text-emerald-500 mt-0.5 shrink-0"></i>
                        <span><strong>ត្រួតពិនិត្យស្ថានភាពជាក់ស្តែង៖</strong> ត្រូវចុះវាយតម្លៃ និងផ្ទៀងផ្ទាត់ទីតាំង ឬលេខតួ/ម៉ាស៊ីនផ្ទាល់។</span>
                    </li>
                    <li class="flex items-start gap-2.5">
                        <i class="bi bi-check-circle-fill text-emerald-500 mt-0.5 shrink-0"></i>
                        <span><strong>ស្កេនរក្សាទុក៖</strong> ស្កេនច្បាប់ចម្លងបញ្ចូលទៅក្នុងប្រព័ន្ធ និងរក្សាទុកច្បាប់ដើមក្នុងទូសុវត្ថិភាព។</span>
                    </li>
                    <li class="flex items-start gap-2.5">
                        <i class="bi bi-check-circle-fill text-emerald-500 mt-0.5 shrink-0"></i>
                        <span><strong>ចុះហត្ថលេខាប្រគល់-ទទួល៖</strong> ត្រូវមានកំណត់ហេតុប្រគល់-ទទួលចុះហត្ថលេខាដោយអតិថិជន និងមន្ត្រីទទួលបន្ទុក។</span>
                    </li>
                </ul>
            </div>

        </div>

    </div>

</div>
@endsection

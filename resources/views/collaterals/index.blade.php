@extends('layouts.master')

@section('title', 'គ្រប់គ្រងទ្រព្យបញ្ចាំ | ធនាគារ ចេនឡា (Collateral Vault)')

@section('content')
@php
    $totalCollaterals = $collaterals->count();
    $totalValue = $collaterals->sum('value');
    $vaultedCollaterals = $collaterals->where('status', 'កំពុងរក្សាទុក');
    $vaultedCount = $vaultedCollaterals->count();
    $vaultedValue = $vaultedCollaterals->sum('value');
    $releasedCollaterals = $collaterals->where('status', 'បានដកវិញ');
    $releasedCount = $releasedCollaterals->count();
    $releasedValue = $releasedCollaterals->sum('value');

    // Count by category
    $landCount = $collaterals->filter(fn($c) => str_contains($c->type, 'ដី') || str_contains(strtolower($c->type), 'land'))->count();
    $vehicleCount = $collaterals->filter(fn($c) => str_contains($c->type, 'យានយន្ត') || str_contains(strtolower($c->type), 'vehicle'))->count();
    $goldCount = $collaterals->filter(fn($c) => str_contains($c->type, 'មាស') || str_contains($c->type, 'អលង្ការ') || str_contains(strtolower($c->type), 'gold') || str_contains(strtolower($c->type), 'jewelry'))->count();
    $electronicsCount = $collaterals->filter(fn($c) => str_contains($c->type, 'អេឡិចត្រូនិក') || str_contains(strtolower($c->type), 'electronic'))->count();

    // Map collaterals for Alpine.js reactive interactivity
    $collateralsData = $collaterals->map(function($c) {
        return [
            'id' => $c->id,
            'customer_id' => $c->customer_id,
            'customer_name' => $c->customer?->name ?? 'អតិថិជនមិនស្គាល់',
            'customer_phone' => $c->customer?->phone ?? 'គ្មានលេខទូរស័ព្ទ',
            'customer_id_number' => $c->customer?->id_number ?? 'N/A',
            'loan_id' => $c->loan_id,
            'loan_number' => $c->loan?->loan_number ?? $c->loan?->loan_code ?? ('LN-' . str_pad($c->loan_id, 4, '0', STR_PAD_LEFT)),
            'loan_amount' => $c->loan?->amount ? number_format($c->loan->amount, 2) : '0.00',
            'type' => $c->type,
            'description' => $c->description ?? '',
            'document_number' => $c->document_number ?? '',
            'value' => (float)$c->value,
            'formatted_value' => number_format((float)$c->value, 2),
            'received_date' => $c->received_date ? \Carbon\Carbon::parse($c->received_date)->format('Y-m-d') : '',
            'formatted_date' => $c->received_date ? \Carbon\Carbon::parse($c->received_date)->format('d/m/Y') : '-',
            'status' => $c->status ?? 'កំពុងរក្សាទុក',
            'reference_document' => $c->reference_document ? asset('storage/' . $c->reference_document) : null,
            'document_name' => $c->reference_document ? basename($c->reference_document) : null,
            'has_document' => !empty($c->reference_document),
        ];
    });
@endphp

<div x-data="{
        items: {{ Js::from($collateralsData) }},
        search: '',
        categoryFilter: 'all',
        statusFilter: 'all',
        viewModalOpen: false,
        editModalOpen: false,
        activeItem: {},
        editFormAction: '',

        // Filters evaluation
        filteredItems() {
            return this.items.filter(item => {
                const matchesSearch = this.search === '' ||
                    item.customer_name.toLowerCase().includes(this.search.toLowerCase()) ||
                    item.loan_number.toLowerCase().includes(this.search.toLowerCase()) ||
                    item.type.toLowerCase().includes(this.search.toLowerCase()) ||
                    (item.document_number && item.document_number.toLowerCase().includes(this.search.toLowerCase())) ||
                    (item.description && item.description.toLowerCase().includes(this.search.toLowerCase()));

                const matchesCategory = this.categoryFilter === 'all' || item.type === this.categoryFilter;
                const matchesStatus = this.statusFilter === 'all' || item.status === this.statusFilter;

                return matchesSearch && matchesCategory && matchesStatus;
            });
        },

        openView(item) {
            this.activeItem = Object.assign({}, item);
            this.viewModalOpen = true;
        },

        openEdit(item) {
            this.activeItem = Object.assign({}, item);
            this.editFormAction = '{{ url('collaterals') }}/' + item.id;
            this.editModalOpen = true;
        },

        getCategoryBadgeClass(type) {
            if (type.includes('ដី') || type.toLowerCase().includes('land')) {
                return 'bg-emerald-50 text-emerald-700 border-emerald-200';
            } else if (type.includes('យានយន្ត') || type.toLowerCase().includes('vehicle')) {
                return 'bg-blue-50 text-blue-700 border-blue-200';
            } else if (type.includes('មាស') || type.includes('អលង្ការ') || type.toLowerCase().includes('gold')) {
                return 'bg-amber-50 text-amber-700 border-amber-200';
            } else {
                return 'bg-purple-50 text-purple-700 border-purple-200';
            }
        },

        getCategoryIcon(type) {
            if (type.includes('ដី') || type.toLowerCase().includes('land')) {
                return 'bi-house-check';
            } else if (type.includes('យានយន្ត') || type.toLowerCase().includes('vehicle')) {
                return 'bi-car-front';
            } else if (type.includes('មាស') || type.includes('អលង្ការ') || type.toLowerCase().includes('gold')) {
                return 'bi-gem';
            } else {
                return 'bi-laptop';
            }
        }
     }"
     class="space-y-6">

    <!-- Top Header Banner (Matching Chenla Bank Design System) -->
    <div class="rounded-2xl bg-white border border-slate-200/90 shadow-2xs overflow-hidden">
        <div class="h-1.5 w-full bg-gradient-to-r from-[#0B2B40] via-[#0F4C5C] to-[#10B981]"></div>
        <div class="p-5 sm:p-6">
            <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-4">
                <div class="flex items-start sm:items-center gap-4">
                    <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-[#0B2B40] to-[#0F4C5C] text-white flex items-center justify-center shrink-0 shadow-sm border border-emerald-500/20">
                        <i class="bi bi-safe2 text-2xl text-[#10B981]"></i>
                    </div>
                    <div>
                        <div class="flex items-center gap-2 flex-wrap">
                            <span class="px-2.5 py-0.5 rounded-md bg-[#EEF7F0] text-[#059669] text-xs font-bold border border-emerald-200/70 inline-flex items-center gap-1.5">
                                <span class="w-2 h-2 rounded-full bg-[#10B981] animate-pulse"></span>
                                ឃ្លាំងសុវត្ថិភាព // COLLATERAL VAULT
                            </span>
                            <span class="text-xs text-slate-400">&bull; ធនាគារ ចេនឡា</span>
                        </div>
                        <h1 class="text-xl sm:text-2xl font-black text-[#0B2B40] mt-1.5 tracking-tight flex items-center gap-2">
                            <span>គ្រប់គ្រងទ្រព្យបញ្ចាំ និងឯកសារធានា</span>
                        </h1>
                        <p class="text-xs sm:text-sm text-slate-500 mt-0.5">
                            កត់ត្រា ត្រួតពិនិត្យ និងតាមដានទ្រព្យធានាកម្ចី ប័ណ្ណកម្មសិទ្ធិដីធ្លី យានយន្ត និងឯកសារច្បាប់ក្នុងឃ្លាំង
                        </p>
                    </div>
                </div>

                <div class="flex items-center gap-2.5 shrink-0 flex-wrap">
                    <button type="button" 
                            onclick="window.print()" 
                            class="inline-flex items-center justify-center gap-2 bg-white hover:bg-slate-50 text-slate-700 border border-slate-300 px-4 py-2.5 rounded-xl text-xs font-bold shadow-2xs transition-all duration-200 active:scale-95">
                        <i class="bi bi-printer text-slate-600"></i>
                        <span>បោះពុម្ពបញ្ជី (Print)</span>
                    </button>
                    
                    <a href="{{ route('collaterals.create') }}" 
                       class="inline-flex items-center justify-center gap-2 bg-[#10B981] hover:bg-[#059669] text-white font-bold px-4 py-2.5 rounded-xl text-xs shadow-xs transition-all duration-200 active:scale-95">
                        <i class="bi bi-plus-circle text-sm"></i>
                        <span>បញ្ចូលទ្រព្យបញ្ចាំថ្មី</span>
                    </a>
                </div>
            </div>

            <!-- KPI Summary Cards -->
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-4 mt-6 pt-5 border-t border-slate-100">
                <!-- KPI 1 -->
                <div class="p-4 rounded-xl bg-slate-50/80 border border-slate-200/80 hover:border-slate-300 transition">
                    <div class="flex items-center justify-between">
                        <span class="text-[11px] font-bold text-slate-500 uppercase tracking-wider">ទ្រព្យបញ្ចាំសរុប</span>
                        <div class="w-8 h-8 rounded-lg bg-[#0B2B40]/10 text-[#0B2B40] flex items-center justify-center">
                            <i class="bi bi-shield-lock text-sm"></i>
                        </div>
                    </div>
                    <div class="text-2xl font-black text-[#0B2B40] mt-2">
                        {{ number_format($totalCollaterals) }} <span class="text-xs font-normal text-slate-500">ធាតុ</span>
                    </div>
                    <div class="text-[11px] text-slate-500 mt-1 flex items-center gap-1">
                        <i class="bi bi-check2 text-emerald-600 font-bold"></i>
                        <span>ទិន្នន័យក្នុងប្រព័ន្ធទាំងមូល</span>
                    </div>
                </div>

                <!-- KPI 2 -->
                <div class="p-4 rounded-xl bg-emerald-50/50 border border-emerald-200/70 hover:border-emerald-300 transition">
                    <div class="flex items-center justify-between">
                        <span class="text-[11px] font-bold text-emerald-800 uppercase tracking-wider">តម្លៃប៉ាន់ស្មានក្នុងឃ្លាំង</span>
                        <div class="w-8 h-8 rounded-lg bg-emerald-100 text-emerald-700 flex items-center justify-center">
                            <i class="bi bi-cash-stack text-sm"></i>
                        </div>
                    </div>
                    <div class="text-2xl font-black text-[#059669] mt-2">
                        ${{ number_format($vaultedValue, 2) }}
                    </div>
                    <div class="text-[11px] text-emerald-700 mt-1 flex items-center gap-1">
                        <i class="bi bi-shield-fill-check"></i>
                        <span>{{ $vaultedCount }} មុខ កំពុងស្ថិតក្នុងឃ្លាំង</span>
                    </div>
                </div>

                <!-- KPI 3 -->
                <div class="p-4 rounded-xl bg-blue-50/50 border border-blue-200/70 hover:border-blue-300 transition">
                    <div class="flex items-center justify-between">
                        <span class="text-[11px] font-bold text-blue-800 uppercase tracking-wider">កំពុងរក្សាទុក (Vaulted)</span>
                        <div class="w-8 h-8 rounded-lg bg-blue-100 text-blue-700 flex items-center justify-center">
                            <i class="bi bi-safe text-sm"></i>
                        </div>
                    </div>
                    <div class="text-2xl font-black text-blue-900 mt-2">
                        {{ number_format($vaultedCount) }} <span class="text-xs font-normal text-blue-600">មុខ</span>
                    </div>
                    <div class="text-[11px] text-blue-700 mt-1">
                        {{ $totalCollaterals > 0 ? round(($vaultedCount / $totalCollaterals) * 100) : 0 }}% នៃទ្រព្យទាំងអស់
                    </div>
                </div>

                <!-- KPI 4 -->
                <div class="p-4 rounded-xl bg-amber-50/50 border border-amber-200/70 hover:border-amber-300 transition">
                    <div class="flex items-center justify-between">
                        <span class="text-[11px] font-bold text-amber-800 uppercase tracking-wider">បានដកវិញ (Released)</span>
                        <div class="w-8 h-8 rounded-lg bg-amber-100 text-amber-700 flex items-center justify-center">
                            <i class="bi bi-box-arrow-up-right text-sm"></i>
                        </div>
                    </div>
                    <div class="text-2xl font-black text-amber-900 mt-2">
                        {{ number_format($releasedCount) }} <span class="text-xs font-normal text-amber-600">មុខ</span>
                    </div>
                    <div class="text-[11px] text-amber-700 mt-1">
                        ${{ number_format($releasedValue, 2) }} ប្រគល់ជូនវិញ
                    </div>
                </div>
            </div>

            <!-- Category Distribution Quick Badges -->
            <div class="flex items-center gap-2 mt-4 pt-4 border-t border-slate-100 flex-wrap text-xs">
                <span class="text-slate-400 font-semibold flex items-center gap-1">
                    <i class="bi bi-tags"></i> ប្រភេទទ្រព្យ៖
                </span>
                <button type="button" @click="categoryFilter = 'ប័ណ្ណកម្មសិទ្ធិដី'" class="px-2.5 py-1 rounded-lg bg-slate-100 hover:bg-slate-200 text-slate-700 font-medium border border-slate-200 inline-flex items-center gap-1.5 transition">
                    <i class="bi bi-house-check text-emerald-600"></i> ប័ណ្ណកម្មសិទ្ធិដី: <strong class="text-slate-900">{{ $landCount }}</strong>
                </button>
                <button type="button" @click="categoryFilter = 'យានយន្ត'" class="px-2.5 py-1 rounded-lg bg-slate-100 hover:bg-slate-200 text-slate-700 font-medium border border-slate-200 inline-flex items-center gap-1.5 transition">
                    <i class="bi bi-car-front text-blue-600"></i> យានយន្ត: <strong class="text-slate-900">{{ $vehicleCount }}</strong>
                </button>
                <button type="button" @click="categoryFilter = 'គ្រឿងអលង្ការ / មាស'" class="px-2.5 py-1 rounded-lg bg-slate-100 hover:bg-slate-200 text-slate-700 font-medium border border-slate-200 inline-flex items-center gap-1.5 transition">
                    <i class="bi bi-gem text-amber-600"></i> មាស / អលង្ការ: <strong class="text-slate-900">{{ $goldCount }}</strong>
                </button>
                <button type="button" @click="categoryFilter = 'គ្រឿងអេឡិចត្រូនិក'" class="px-2.5 py-1 rounded-lg bg-slate-100 hover:bg-slate-200 text-slate-700 font-medium border border-slate-200 inline-flex items-center gap-1.5 transition">
                    <i class="bi bi-laptop text-purple-600"></i> អេឡិចត្រូនិក: <strong class="text-slate-900">{{ $electronicsCount }}</strong>
                </button>
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

    <!-- Collateral Full-Width Data Matrix Table Card -->
    <div class="bg-white rounded-2xl border border-slate-200/90 shadow-2xs overflow-hidden flex flex-col justify-between">
        <div class="h-1 w-full bg-gradient-to-r from-[#0F4C5C] via-[#10B981] to-[#0B2B40]"></div>
        
        <div class="p-5 sm:p-6">
            <!-- Table Header & Controls -->
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-4 mb-4 border-b border-slate-100">
                <div>
                    <span class="text-[10px] font-bold tracking-wider text-slate-400 uppercase">MATRIX // បញ្ជីទិន្នន័យ</span>
                    <h2 class="text-base font-bold text-[#0B2B40] flex items-center gap-2">
                        <span>បញ្ជីទ្រព្យបញ្ចាំក្នុងឃ្លាំង</span>
                        <span class="text-xs bg-emerald-50 text-emerald-800 px-2.5 py-0.5 rounded-full font-bold border border-emerald-200" x-text="filteredItems().length + ' ធាតុ'"></span>
                    </h2>
                </div>

                <!-- Status Filter Tabs & Action -->
                <div class="flex items-center gap-3 flex-wrap">
                    <div class="flex items-center gap-1 bg-slate-100 p-1 rounded-xl text-xs font-bold">
                        <button type="button" 
                                @click="statusFilter = 'all'" 
                                :class="statusFilter === 'all' ? 'bg-white text-[#0B2B40] shadow-2xs' : 'text-slate-500 hover:text-slate-800'"
                                class="px-3 py-1.5 rounded-lg transition">
                            ទាំងអស់
                        </button>
                        <button type="button" 
                                @click="statusFilter = 'កំពុងរក្សាទុក'" 
                                :class="statusFilter === 'កំពុងរក្សាទុក' ? 'bg-white text-emerald-700 shadow-2xs' : 'text-slate-500 hover:text-slate-800'"
                                class="px-3 py-1.5 rounded-lg transition flex items-center gap-1.5">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> ក្នុងឃ្លាំង
                        </button>
                        <button type="button" 
                                @click="statusFilter = 'បានដកវិញ'" 
                                :class="statusFilter === 'បានដកវិញ' ? 'bg-white text-slate-800 shadow-2xs' : 'text-slate-500 hover:text-slate-800'"
                                class="px-3 py-1.5 rounded-lg transition flex items-center gap-1.5">
                            <span class="w-1.5 h-1.5 rounded-full bg-slate-400"></span> បានដកវិញ
                        </button>
                    </div>

                    <a href="{{ route('collaterals.create') }}" 
                       class="inline-flex items-center gap-1.5 bg-[#0B2B40] hover:bg-[#0F4C5C] text-white px-3.5 py-2 rounded-xl text-xs font-bold transition shadow-2xs">
                        <i class="bi bi-plus-lg text-xs text-[#10B981]"></i>
                        <span>បន្ថែម</span>
                    </a>
                </div>
            </div>

            <!-- Live Search and Category Filter -->
            <div class="grid grid-cols-1 sm:grid-cols-12 gap-3 mb-4">
                <div class="sm:col-span-8 relative">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                        <i class="bi bi-search"></i>
                    </span>
                    <input type="text" 
                           x-model="search" 
                           placeholder="ស្វែងរកតាមឈ្មោះអតិថិជន, កូដកម្ចី, លេខប័ណ្ណ, ការពិពណ៌នា..." 
                           class="w-full pl-9 pr-8 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs font-medium text-slate-800 placeholder-slate-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#10B981]/20 focus:border-[#10B981] transition">
                    <button x-show="search.length > 0" 
                            @click="search = ''" 
                            class="absolute inset-y-0 right-0 pr-3 flex items-center text-slate-400 hover:text-slate-600">
                        <i class="bi bi-x-circle-fill text-xs"></i>
                    </button>
                </div>

                <div class="sm:col-span-4">
                    <select x-model="categoryFilter" 
                            class="w-full py-2.5 px-3 bg-slate-50 border border-slate-200 rounded-xl text-xs font-semibold text-slate-700 focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#10B981]/20 focus:border-[#10B981] transition">
                        <option value="all">គ្រប់ប្រភេទទ្រព្យទាំងអស់ (All)</option>
                        <option value="ប័ណ្ណកម្មសិទ្ធិដី">ប័ណ្ណកម្មសិទ្ធិដី (Land Title)</option>
                        <option value="យានយន្ត">យានយន្ត (Vehicles)</option>
                        <option value="គ្រឿងអលង្ការ / មាស">គ្រឿងអលង្ការ / មាស (Jewelry)</option>
                        <option value="គ្រឿងអេឡិចត្រូនិក">គ្រឿងអេឡិចត្រូនិក (Electronics)</option>
                        <option value="ផ្សេងៗ">ផ្សេងៗ (Other)</option>
                    </select>
                </div>
            </div>

            <!-- Table Content -->
            <div class="overflow-x-auto rounded-xl border border-slate-100">
                <table class="w-full text-left text-xs text-slate-600">
                    <thead>
                        <tr class="bg-slate-50/80 border-b border-slate-200/80 text-slate-500 font-bold uppercase tracking-wider text-[11px]">
                            <th class="py-3 px-3.5"># លេខកូដ</th>
                            <th class="py-3 px-3.5">ប្រភេទទ្រព្យ និងព័ត៌មាន</th>
                            <th class="py-3 px-3.5">អតិថិជនអ្នកខ្ចី</th>
                            <th class="py-3 px-3.5">កិច្ចសន្យាកម្ចី</th>
                            <th class="py-3 px-3.5">តម្លៃប៉ាន់ស្មាន ($)</th>
                            <th class="py-3 px-3.5">កាលបរិច្ឆេទ & លេខប័ណ្ណ</th>
                            <th class="py-3 px-3.5">ស្ថានភាព</th>
                            <th class="py-3 px-3.5">ឯកសារ</th>
                            <th class="py-3 px-3.5 text-right">សកម្មភាព</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        <template x-for="item in filteredItems()" :key="item.id">
                            <tr class="hover:bg-slate-50/70 transition-colors">
                                <!-- ID -->
                                <td class="py-3.5 px-3.5 font-mono text-[11px] font-bold text-slate-500" x-text="'#' + item.id"></td>

                                <!-- Asset Type & Description -->
                                <td class="py-3.5 px-3.5">
                                    <div class="flex items-start gap-2.5">
                                        <div class="w-8 h-8 rounded-lg flex items-center justify-center shrink-0 border mt-0.5"
                                             :class="getCategoryBadgeClass(item.type)">
                                            <i class="bi text-sm" :class="getCategoryIcon(item.type)"></i>
                                        </div>
                                        <div>
                                            <div class="font-bold text-slate-900" x-text="item.type"></div>
                                            <div class="text-[11px] text-slate-400 max-w-[200px] truncate" 
                                                 :title="item.description" 
                                                 x-text="item.description || 'គ្មានការពិពណ៌នា'"></div>
                                        </div>
                                    </div>
                                </td>

                                <!-- Customer -->
                                <td class="py-3.5 px-3.5">
                                    <div class="font-bold text-[#0B2B40]" x-text="item.customer_name"></div>
                                    <div class="text-[10px] text-slate-400 mt-0.5" x-text="item.customer_phone"></div>
                                </td>

                                <!-- Loan -->
                                <td class="py-3.5 px-3.5">
                                    <span class="text-[10px] font-mono text-emerald-800 bg-[#EEF7F0] px-2 py-0.5 rounded font-bold border border-emerald-200/60" x-text="item.loan_number"></span>
                                    <div class="text-[10px] text-slate-500 font-semibold mt-1" x-text="'$' + item.loan_amount"></div>
                                </td>

                                <!-- Value -->
                                <td class="py-3.5 px-3.5">
                                    <div class="font-extrabold text-[#059669] text-sm" x-text="'$' + item.formatted_value"></div>
                                </td>

                                <!-- Date & Doc Number -->
                                <td class="py-3.5 px-3.5">
                                    <div class="font-medium text-slate-700" x-text="item.formatted_date"></div>
                                    <div class="text-[10px] text-slate-400 font-mono mt-0.5 flex items-center gap-1">
                                        <i class="bi bi-file-text"></i>
                                        <span x-text="item.document_number ? item.document_number : 'គ្មានលេខប័ណ្ណ'"></span>
                                    </div>
                                </td>

                                <!-- Status -->
                                <td class="py-3.5 px-3.5">
                                    <template x-if="item.status === 'កំពុងរក្សាទុក'">
                                        <span class="inline-flex items-center gap-1 px-2.5 py-0.5 text-[10px] font-bold rounded-md bg-emerald-50 text-emerald-700 border border-emerald-200">
                                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                                            <span>កំពុងរក្សាទុក</span>
                                        </span>
                                    </template>
                                    <template x-if="item.status !== 'កំពុងរក្សាទុក'">
                                        <span class="inline-flex items-center gap-1 px-2.5 py-0.5 text-[10px] font-bold rounded-md bg-slate-100 text-slate-600 border border-slate-200">
                                            <span class="w-1.5 h-1.5 rounded-full bg-slate-400"></span>
                                            <span>បានដកវិញ</span>
                                        </span>
                                    </template>
                                </td>

                                <!-- Document Attachment -->
                                <td class="py-3.5 px-3.5">
                                    <template x-if="item.has_document">
                                        <a :href="item.reference_document" target="_blank" class="inline-flex items-center gap-1 text-[11px] font-semibold text-blue-600 hover:text-blue-800 hover:underline">
                                            <i class="bi bi-paperclip"></i>
                                            <span>ឯកសារ</span>
                                        </a>
                                    </template>
                                    <template x-if="!item.has_document">
                                        <span class="text-slate-300 text-[11px]">-</span>
                                    </template>
                                </td>

                                <!-- Actions -->
                                <td class="py-3.5 px-3.5 text-right">
                                    <div class="flex items-center justify-end gap-1">
                                        <!-- View Detail Button -->
                                        <button type="button" 
                                                @click="openView(item)" 
                                                title="មើលព័ត៌មានលម្អិត" 
                                                class="p-1.5 text-slate-400 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition">
                                            <i class="bi bi-eye text-sm"></i>
                                        </button>

                                        <!-- Edit Button -->
                                        <button type="button" 
                                                @click="openEdit(item)" 
                                                title="កែប្រែទិន្នន័យ" 
                                                class="p-1.5 text-slate-400 hover:text-amber-600 hover:bg-amber-50 rounded-lg transition">
                                            <i class="bi bi-pencil-square text-sm"></i>
                                        </button>

                                        <!-- Delete Form -->
                                        <form :action="'{{ url('collaterals') }}/' + item.id" method="POST" class="inline-block" onsubmit="return confirm('តើអ្នកពិតជាចង់លុបទិន្នន័យទ្រព្យបញ្ចាំនេះចេញពីប្រព័ន្ធមែនទេ? សកម្មភាពនេះមិនអាចត្រឡប់វិញបានឡើយ។');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    title="លុបទ្រព្យបញ្ចាំ" 
                                                    class="p-1.5 text-slate-400 hover:text-rose-600 hover:bg-rose-50 rounded-lg transition">
                                                <i class="bi bi-trash3 text-sm"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        </template>

                        <!-- Empty Filtered Results -->
                        <tr x-show="filteredItems().length === 0">
                            <td colspan="9" class="py-12 text-center">
                                <div class="w-14 h-14 rounded-2xl bg-slate-100 text-slate-400 flex items-center justify-center mx-auto mb-3">
                                    <i class="bi bi-shield-x text-2xl"></i>
                                </div>
                                <h4 class="font-bold text-slate-700 text-sm">មិនមានទិន្នន័យត្រូវស្វែងរកទេ</h4>
                                <p class="text-xs text-slate-400 mt-1">សូមសាកល្បងផ្លាស់ប្តូរពាក្យគន្លឹះ ឬជ្រើសរើសជម្រើសតម្រងផ្សេង</p>
                                <button type="button" @click="search = ''; categoryFilter = 'all'; statusFilter = 'all'" class="mt-3 text-xs font-bold text-emerald-600 hover:text-emerald-800">
                                    សម្អាតតម្រងទាំងអស់
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Footer Stats -->
            <div class="mt-4 pt-3 border-t border-slate-100 flex flex-col sm:flex-row items-center justify-between gap-2 text-xs text-slate-400">
                <div>
                    បង្ហាញ <span class="font-bold text-slate-700" x-text="filteredItems().length"></span> នៃ <span class="font-bold text-slate-700" x-text="items.length"></span> ធាតុសរុប
                </div>
                <div class="flex items-center gap-3">
                    <span class="inline-flex items-center gap-1">
                        <span class="w-2 h-2 rounded-full bg-emerald-500"></span> ក្នុងឃ្លាំង ({{ $vaultedCount }})
                    </span>
                    <span class="inline-flex items-center gap-1">
                        <span class="w-2 h-2 rounded-full bg-slate-400"></span> ដកវិញ ({{ $releasedCount }})
                    </span>
                </div>
            </div>
        </div>
    </div>

    <!-- ========================================== -->
    <!-- VIEW DETAILS MODAL                         -->
    <!-- ========================================== -->
    <div x-show="viewModalOpen" 
         x-cloak 
         class="fixed inset-0 z-50 overflow-y-auto" 
         aria-labelledby="modal-title" 
         role="dialog" 
         aria-modal="true">
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <!-- Background overlay -->
            <div x-show="viewModalOpen" 
                 x-transition:enter="ease-out duration-300"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 x-transition:leave="ease-in duration-200"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0"
                 @click="viewModalOpen = false" 
                 class="fixed inset-0 bg-slate-900/60 backdrop-blur-xs transition-opacity"></div>

            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

            <!-- Modal panel -->
            <div x-show="viewModalOpen" 
                 x-transition:enter="ease-out duration-300"
                 x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                 x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave="ease-in duration-200"
                 x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                 class="inline-block align-bottom bg-white rounded-2xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full border border-slate-200">
                
                <!-- Modal Top Accent -->
                <div class="h-1.5 w-full bg-gradient-to-r from-[#0B2B40] via-[#0F4C5C] to-[#10B981]"></div>

                <div class="p-6">
                    <!-- Header -->
                    <div class="flex items-center justify-between pb-4 border-b border-slate-100">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-[#EEF7F0] text-[#059669] flex items-center justify-center">
                                <i class="bi bi-file-earmark-lock text-xl"></i>
                            </div>
                            <div>
                                <h3 class="text-base font-bold text-[#0B2B40]">ព័ត៌មានលម្អិតអំពីទ្រព្យបញ្ចាំ</h3>
                                <p class="text-xs text-slate-400">អត្តលេខទ្រព្យ: #<span x-text="activeItem.id"></span></p>
                            </div>
                        </div>
                        <button type="button" @click="viewModalOpen = false" class="text-slate-400 hover:text-slate-600 p-1.5 rounded-lg hover:bg-slate-100 transition">
                            <i class="bi bi-x-lg text-sm"></i>
                        </button>
                    </div>

                    <!-- Details Body -->
                    <div class="mt-4 space-y-4 text-xs">
                        <!-- Category & Status Badge -->
                        <div class="flex items-center justify-between p-3 rounded-xl bg-slate-50 border border-slate-200/80">
                            <div>
                                <span class="text-[10px] font-bold text-slate-400 uppercase">ប្រភេទទ្រព្យ</span>
                                <div class="text-sm font-bold text-[#0B2B40] mt-0.5" x-text="activeItem.type"></div>
                            </div>
                            <div>
                                <template x-if="activeItem.status === 'កំពុងរក្សាទុក'">
                                    <span class="px-3 py-1 rounded-full text-xs font-bold bg-emerald-50 text-emerald-700 border border-emerald-200 flex items-center gap-1.5">
                                        <span class="w-2 h-2 rounded-full bg-emerald-500"></span> កំពុងរក្សាទុក
                                    </span>
                                </template>
                                <template x-if="activeItem.status !== 'កំពុងរក្សាទុក'">
                                    <span class="px-3 py-1 rounded-full text-xs font-bold bg-slate-100 text-slate-600 border border-slate-200 flex items-center gap-1.5">
                                        <span class="w-2 h-2 rounded-full bg-slate-400"></span> បានដកវិញ
                                    </span>
                                </template>
                            </div>
                        </div>

                        <!-- Borrower & Loan Info -->
                        <div class="grid grid-cols-2 gap-3">
                            <div class="p-3 rounded-xl border border-slate-200/80 bg-white">
                                <span class="text-[10px] font-bold text-slate-400 uppercase">អតិថិជនអ្នកខ្ចី</span>
                                <div class="text-xs font-bold text-slate-800 mt-1" x-text="activeItem.customer_name"></div>
                                <div class="text-[11px] text-slate-500 mt-0.5" x-text="'ទូរស័ព្ទ: ' + activeItem.customer_phone"></div>
                            </div>

                            <div class="p-3 rounded-xl border border-slate-200/80 bg-white">
                                <span class="text-[10px] font-bold text-slate-400 uppercase">កិច្ចសន្យាកម្ចី</span>
                                <div class="text-xs font-mono font-bold text-emerald-700 mt-1" x-text="activeItem.loan_number"></div>
                                <div class="text-[11px] text-slate-500 mt-0.5" x-text="'ទំហំកម្ចី: $' + activeItem.loan_amount"></div>
                            </div>
                        </div>

                        <!-- Financials & Doc No -->
                        <div class="grid grid-cols-2 gap-3">
                            <div class="p-3 rounded-xl border border-slate-200/80 bg-white">
                                <span class="text-[10px] font-bold text-slate-400 uppercase">តម្លៃប៉ាន់ស្មាន (Est. Value)</span>
                                <div class="text-sm font-extrabold text-[#059669] mt-1" x-text="'$' + activeItem.formatted_value"></div>
                            </div>

                            <div class="p-3 rounded-xl border border-slate-200/80 bg-white">
                                <span class="text-[10px] font-bold text-slate-400 uppercase">លេខប័ណ្ណ/ឯកសារ</span>
                                <div class="text-xs font-mono font-bold text-slate-800 mt-1" x-text="activeItem.document_number || 'គ្មានលេខប័ណ្ណ'"></div>
                            </div>
                        </div>

                        <!-- Date Received -->
                        <div class="p-3 rounded-xl border border-slate-200/80 bg-white">
                            <span class="text-[10px] font-bold text-slate-400 uppercase">កាលបរិច្ឆេទទទួលចូលឃ្លាំង</span>
                            <div class="text-xs font-bold text-slate-800 mt-0.5" x-text="activeItem.formatted_date"></div>
                        </div>

                        <!-- Description -->
                        <div class="p-3 rounded-xl border border-slate-200/80 bg-white">
                            <span class="text-[10px] font-bold text-slate-400 uppercase">ការពិពណ៌នាអំពីទ្រព្យ</span>
                            <p class="text-xs text-slate-600 mt-1 whitespace-pre-line" x-text="activeItem.description || 'មិនមានការពិពណ៌នាបន្ថែម'"></p>
                        </div>

                        <!-- Attachment link -->
                        <template x-if="activeItem.has_document">
                            <div class="p-3 rounded-xl bg-blue-50/60 border border-blue-200 flex items-center justify-between">
                                <div class="flex items-center gap-2">
                                    <i class="bi bi-file-earmark-arrow-down-fill text-blue-600 text-lg"></i>
                                    <div>
                                        <div class="font-bold text-blue-900">ឯកសារយោងភ្ជាប់</div>
                                        <div class="text-[10px] text-blue-600 truncate max-w-[200px]" x-text="activeItem.document_name"></div>
                                    </div>
                                </div>
                                <a :href="activeItem.reference_document" target="_blank" class="px-3 py-1.5 rounded-lg bg-blue-600 hover:bg-blue-700 text-white font-bold text-xs transition flex items-center gap-1">
                                    <i class="bi bi-download"></i> បើកមើល
                                </a>
                            </div>
                        </template>
                    </div>

                    <!-- Footer -->
                    <div class="mt-6 pt-4 border-t border-slate-100 flex items-center justify-end gap-2">
                        <button type="button" 
                                @click="viewModalOpen = false; openEdit(activeItem)" 
                                class="px-4 py-2 rounded-xl text-xs font-bold text-amber-700 bg-amber-50 hover:bg-amber-100 border border-amber-200 transition flex items-center gap-1.5">
                            <i class="bi bi-pencil-square"></i> កែប្រែ
                        </button>
                        <button type="button" 
                                @click="viewModalOpen = false" 
                                class="px-4 py-2 rounded-xl text-xs font-bold text-slate-600 bg-slate-100 hover:bg-slate-200 transition">
                            បិទ (Close)
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ========================================== -->
    <!-- EDIT COLLATERAL MODAL                      -->
    <!-- ========================================== -->
    <div x-show="editModalOpen" 
         x-cloak 
         class="fixed inset-0 z-50 overflow-y-auto" 
         aria-labelledby="modal-title" 
         role="dialog" 
         aria-modal="true">
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <!-- Background overlay -->
            <div x-show="editModalOpen" 
                 x-transition:enter="ease-out duration-300"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 x-transition:leave="ease-in duration-200"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0"
                 @click="editModalOpen = false" 
                 class="fixed inset-0 bg-slate-900/60 backdrop-blur-xs transition-opacity"></div>

            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

            <!-- Modal panel -->
            <div x-show="editModalOpen" 
                 x-transition:enter="ease-out duration-300"
                 x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                 x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave="ease-in duration-200"
                 x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                 class="inline-block align-bottom bg-white rounded-2xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-xl sm:w-full border border-slate-200">
                
                <!-- Modal Top Accent -->
                <div class="h-1.5 w-full bg-gradient-to-r from-amber-500 via-[#10B981] to-[#0B2B40]"></div>

                <div class="p-6">
                    <!-- Header -->
                    <div class="flex items-center justify-between pb-4 border-b border-slate-100">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-amber-50 text-amber-700 flex items-center justify-center">
                                <i class="bi bi-pencil-square text-xl"></i>
                            </div>
                            <div>
                                <h3 class="text-base font-bold text-[#0B2B40]">កែប្រែព័ត៌មានទ្រព្យបញ្ចាំ</h3>
                                <p class="text-xs text-slate-400">កែសម្រួលទិន្នន័យទ្រព្យ #<span x-text="activeItem.id"></span></p>
                            </div>
                        </div>
                        <button type="button" @click="editModalOpen = false" class="text-slate-400 hover:text-slate-600 p-1.5 rounded-lg hover:bg-slate-100 transition">
                            <i class="bi bi-x-lg text-sm"></i>
                        </button>
                    </div>

                    <!-- Edit Form -->
                    <form :action="editFormAction" method="POST" enctype="multipart/form-data" class="mt-4 space-y-4">
                        @csrf
                        @method('PUT')

                        <!-- Customer & Loan -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-1.5">
                                    អតិថិជន (Borrower) <span class="text-rose-500">*</span>
                                </label>
                                <select name="customer_id" x-model="activeItem.customer_id" class="w-full border border-slate-200 rounded-xl px-3 py-2.5 bg-slate-50 text-xs font-semibold text-slate-800 focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#10B981]/20 focus:border-[#10B981] transition" required>
                                    @foreach($customers as $customer)
                                        <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-1.5">
                                    កម្ចី (Loan Reference) <span class="text-rose-500">*</span>
                                </label>
                                <select name="loan_id" x-model="activeItem.loan_id" class="w-full border border-slate-200 rounded-xl px-3 py-2.5 bg-slate-50 text-xs font-semibold text-slate-800 focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#10B981]/20 focus:border-[#10B981] transition" required>
                                    @foreach($loans as $loan)
                                        <option value="{{ $loan->id }}">
                                            {{ $loan->loan_number ?? $loan->loan_code ?? ('LN-' . str_pad($loan->id, 4, '0', STR_PAD_LEFT)) }} 
                                            - {{ $loan->customer->name ?? 'អតិថិជន' }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- Category & Value -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-1.5">
                                    ប្រភេទទ្រព្យ (Category) <span class="text-rose-500">*</span>
                                </label>
                                <select name="type" x-model="activeItem.type" class="w-full border border-slate-200 rounded-xl px-3 py-2.5 bg-slate-50 text-xs font-semibold text-slate-800 focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#10B981]/20 focus:border-[#10B981] transition" required>
                                    <option value="ប័ណ្ណកម្មសិទ្ធិដី">ប័ណ្ណកម្មសិទ្ធិដី (Land Title)</option>
                                    <option value="យានយន្ត">យានយន្ត (Vehicles)</option>
                                    <option value="គ្រឿងអលង្ការ / មាស">គ្រឿងអលង្ការ / មាស (Jewelry & Gold)</option>
                                    <option value="គ្រឿងអេឡិចត្រូនិក">គ្រឿងអេឡិចត្រូនិក (Electronics)</option>
                                    <option value="ផ្សេងៗ">ផ្សេងៗ (Other Assets)</option>
                                </select>
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-1.5">
                                    តម្លៃប៉ាន់ស្មាន (Est. Value $) <span class="text-rose-500">*</span>
                                </label>
                                <div class="relative">
                                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-slate-400 font-black text-xs">$</span>
                                    <input type="number" step="0.01" min="0" name="value" x-model="activeItem.value" class="w-full pl-7 pr-3 border border-slate-200 rounded-xl py-2.5 bg-slate-50 text-xs font-bold text-slate-800 focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#10B981]/20 focus:border-[#10B981] transition" required>
                                </div>
                            </div>
                        </div>

                        <!-- Doc No & Date -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-1.5">
                                    លេខប័ណ្ណ/ឯកសារ (Doc No.)
                                </label>
                                <input type="text" name="document_number" x-model="activeItem.document_number" class="w-full border border-slate-200 rounded-xl px-3 py-2.5 bg-slate-50 text-xs font-medium text-slate-800 focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#10B981]/20 focus:border-[#10B981] transition">
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-1.5">
                                    ថ្ងៃទទួលចូលឃ្លាំង (Received Date) <span class="text-rose-500">*</span>
                                </label>
                                <input type="date" name="received_date" x-model="activeItem.received_date" class="w-full border border-slate-200 rounded-xl px-3 py-2.5 bg-slate-50 text-xs font-semibold text-slate-800 focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#10B981]/20 focus:border-[#10B981] transition" required>
                            </div>
                        </div>

                        <!-- Status -->
                        <div>
                            <label class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-1.5">
                                ស្ថានភាព (Vault Status) <span class="text-rose-500">*</span>
                            </label>
                            <select name="status" x-model="activeItem.status" class="w-full border border-slate-200 rounded-xl px-3 py-2.5 bg-slate-50 text-xs font-semibold text-slate-800 focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#10B981]/20 focus:border-[#10B981] transition">
                                <option value="កំពុងរក្សាទុក">កំពុងរក្សាទុក (Vaulted / In Storage)</option>
                                <option value="បានដកវិញ">បានដកវិញ (Released / Returned)</option>
                            </select>
                        </div>

                        <!-- Description -->
                        <div>
                            <label class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-1.5">
                                ការពិពណ៌នា (Description)
                            </label>
                            <textarea name="description" rows="2.5" x-model="activeItem.description" class="w-full border border-slate-200 rounded-xl p-3 bg-slate-50 text-xs font-medium text-slate-800 focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#10B981]/20 focus:border-[#10B981] transition"></textarea>
                        </div>

                        <!-- Upload new file (optional) -->
                        <div>
                            <label class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-1.5">
                                ប្តូរឯកសារភ្ជាប់ថ្មី (Change Attachment - Optional)
                            </label>
                            <input type="file" name="reference_document" class="w-full text-xs text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-slate-100 file:text-slate-700 hover:file:bg-slate-200">
                        </div>

                        <!-- Buttons -->
                        <div class="mt-6 pt-4 border-t border-slate-100 flex items-center justify-end gap-2">
                            <button type="button" @click="editModalOpen = false" class="px-4 py-2.5 rounded-xl text-xs font-bold text-slate-600 bg-slate-100 hover:bg-slate-200 transition">
                                បោះបង់ (Cancel)
                            </button>
                            <button type="submit" class="px-5 py-2.5 rounded-xl text-xs font-bold text-white bg-[#0B2B40] hover:bg-[#0F4C5C] shadow-xs transition flex items-center gap-1.5">
                                <i class="bi bi-check2"></i> រក្សាទុកការកែប្រែ
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection

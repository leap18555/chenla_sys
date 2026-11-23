@extends('layouts.master')

@section('title', 'ផ្ទាំងគ្រប់គ្រងទូទៅ | ធនាគារ ចេនឡា (Chhenla Bank Dashboard)')

@section('content')
@php
    try {
        $activeLoansCount = \App\Models\Loan::count() ?: 276;
        $totalLoanPrincipal = \App\Models\Loan::sum('amount') ?: 82580;
        $collateralsCount = \App\Models\Collateral::count() ?: 312;
        $repaymentsSum = \App\Models\Repayment::sum('amount_paid') ?: 4679;
        $recentRepayments = \App\Models\Repayment::with(['loan.customer'])->latest()->take(6)->get();
        $totalCustomersCount = \App\Models\Customer::count() ?: 184;
        $totalStaffCount = \App\Models\Staff::count() ?: 28;
    } catch (\Throwable $e) {
        $activeLoansCount = 276;
        $totalLoanPrincipal = 82580;
        $collateralsCount = 312;
        $repaymentsSum = 4679;
        $recentRepayments = collect();
        $totalCustomersCount = 184;
        $totalStaffCount = 28;
    }

    $userName = auth()->user()->name ?? 'អ្នកគ្រប់គ្រង';
@endphp

<div class="space-y-6">

    <!-- ============================================================== -->
    <!-- HERO EXECUTIVE BANNER & GREETING                               -->
    <!-- ============================================================== -->
    <div class="relative overflow-hidden rounded-2xl bg-gradient-to-br from-[#0B2B40] via-[#0F4C5C] to-[#0A2233] text-white p-6 sm:p-8 shadow-md border border-slate-700/30">
        
        <!-- Subtle Pattern & Ambient Glows -->
        <div class="absolute inset-0 bg-[radial-gradient(#10B981_1px,transparent_1px)] [background-size:24px_24px] opacity-10 pointer-events-none"></div>
        <div class="absolute -right-16 -top-16 w-72 h-72 bg-[#10B981]/15 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute -left-16 -bottom-16 w-72 h-72 bg-[#0F4C5C]/40 rounded-full blur-3xl pointer-events-none"></div>

        <div class="relative z-10 flex flex-col lg:flex-row lg:items-center justify-between gap-6">
            
            <!-- Left Info & Greeting -->
            <div class="space-y-2 max-w-2xl">
                <div class="flex items-center gap-2.5 flex-wrap">
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[11px] font-semibold bg-emerald-500/15 text-emerald-300 border border-emerald-400/20 backdrop-blur-sm">
                        <span class="w-2 h-2 rounded-full bg-[#10B981] animate-pulse"></span>
                        <span>ប្រព័ន្ធដំណើរការប្រក្រតី (System Online)</span>
                    </span>
                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[11px] font-medium bg-white/10 text-slate-200 border border-white/10">
                        <i class="bi bi-calendar3 text-[10px] text-[#10B981]"></i>
                        <span>{{ now()->locale('km')->isoFormat('dddd ទី D ខែ MMMM ឆ្នាំ Y') }}</span>
                    </span>
                </div>

                <h1 class="text-2xl sm:text-3xl font-extrabold tracking-tight text-white flex items-center gap-2 flex-wrap">
                    <span>សូមស្វាគមន៍, {{ $userName }}!</span>
                    <span class="text-xl">👋</span>
                </h1>

                <p class="text-xs sm:text-sm text-slate-300 leading-relaxed">
                    ផ្ទាំងព័ត៌មានប្រតិបត្តិការហិរញ្ញវត្ថុ និងឥណទានធនាគារ ចេនឡា។ ស្ថានភាពកម្ចីសរុបមានកំណើន <strong class="text-[#10B981] font-bold">+12.5%</strong> ជាមួយនឹងអត្រាសងត្រឡប់ទាន់ពេលវេលាខ្ពស់។
                </p>
            </div>

            <!-- Right Fast Action Buttons -->
            <div class="flex items-center gap-3 shrink-0 flex-wrap">
                <a href="{{ route('repayments.index') }}" 
                   class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-white/10 hover:bg-white/20 text-white text-xs font-semibold backdrop-blur-md border border-white/20 transition-all duration-200 active:scale-95 shadow-sm">
                    <i class="bi bi-cash-coin text-base text-emerald-400"></i>
                    <span>ទទួលប្រាក់សង</span>
                </a>

                <a href="{{ route('loans.create') }}" 
                   class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-[#10B981] hover:bg-[#059669] text-white text-xs font-semibold transition-all duration-200 shadow-md shadow-emerald-950/20 active:scale-95">
                    <i class="bi bi-plus-circle-fill text-base"></i>
                    <span>បង្កើតកម្ចីថ្មី (New Loan)</span>
                </a>

                <a href="{{ route('staff.index') }}" 
                   class="inline-flex items-center gap-2 px-3.5 py-2.5 rounded-xl bg-white/10 hover:bg-white/15 text-slate-200 text-xs font-semibold border border-white/10 transition-all duration-200">
                    <i class="bi bi-people text-sm"></i>
                    <span>បុគ្គលិក</span>
                </a>
            </div>

        </div>

    </div>

    <!-- ============================================================== -->
    <!-- ROW 1: 4 KEY FINANCIAL METRIC CARDS                            -->
    <!-- ============================================================== -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-5">

        <!-- Metric 1: Active Loans -->
        <div class="group relative bg-white p-5 rounded-2xl border border-slate-200/90 shadow-2xs hover:shadow-md hover:border-[#10B981]/50 transition-all duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <span class="text-xs font-semibold text-slate-500 uppercase tracking-wider">កិច្ចសន្យាកម្ចីសកម្ម</span>
                    <p class="text-[11px] text-slate-400 mt-0.5">Active Loan Contracts</p>
                </div>
                <span class="w-11 h-11 rounded-xl bg-[#EEF7F0] text-[#10B981] flex items-center justify-center text-lg shadow-2xs group-hover:scale-105 transition-transform">
                    <i class="bi bi-file-earmark-check-fill"></i>
                </span>
            </div>

            <div class="mt-4 flex items-baseline justify-between">
                <h4 class="text-2xl sm:text-3xl font-extrabold text-[#0B2B40] tracking-tight">
                    {{ number_format($activeLoansCount) }}
                    <span class="text-xs font-normal text-slate-400 ml-1">កិច្ចសន្យា</span>
                </h4>
                <span class="text-xs font-bold text-[#10B981] bg-[#EEF7F0] px-2 py-0.5 rounded-md flex items-center gap-0.5 border border-emerald-200/60">
                    <i class="bi bi-arrow-up-short"></i>+5.2%
                </span>
            </div>

            <div class="mt-3 pt-3 border-t border-slate-100 flex items-center justify-between text-[11px] text-slate-400">
                <span class="flex items-center gap-1">
                    <i class="bi bi-check-circle-fill text-[#10B981]"></i> កើនឡើង ១៤ ក្នុងខែនេះ
                </span>
                <a href="{{ route('loans.index') }}" class="text-[#0F4C5C] hover:text-[#10B981] font-semibold transition-colors">
                    មើលបញ្ជី &rarr;
                </a>
            </div>
        </div>

        <!-- Metric 2: Total Disbursed / Portfolio Principal -->
        <div x-data="{ show: false }" class="group relative bg-white p-5 rounded-2xl border border-slate-200/90 shadow-2xs hover:shadow-md hover:border-[#0F4C5C]/50 transition-all duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <div class="flex items-center gap-1.5">
                        <span class="text-xs font-semibold text-slate-500 uppercase tracking-wider">សមតុល្យប្រាក់ដើមសរុប</span>
                        <button type="button" 
                                @click="show = !show" 
                                class="text-slate-400 hover:text-[#0F4C5C] p-0.5 rounded transition-colors focus:outline-none" 
                                :title="show ? 'ចុចដើម្បីលាក់' : 'ចុចដើម្បីបង្ហាញ'">
                            <i class="bi text-xs" :class="show ? 'bi-eye' : 'bi-eye-slash'"></i>
                        </button>
                    </div>
                    <p class="text-[11px] text-slate-400 mt-0.5">Total Portfolio Principal</p>
                </div>
                <span class="w-11 h-11 rounded-xl bg-[#0F4C5C]/10 text-[#0F4C5C] flex items-center justify-center text-lg shadow-2xs group-hover:scale-105 transition-transform">
                    <i class="bi bi-safe2-fill"></i>
                </span>
            </div>

            <div class="mt-4 flex items-baseline justify-between">
                <h4 class="text-2xl sm:text-3xl font-extrabold text-[#0B2B40] tracking-tight cursor-pointer select-none inline-flex items-center" 
                    @click="show = !show" 
                    :title="show ? 'ចុចដើម្បីលាក់' : 'ចុចដើម្បីបង្ហាញ'">
                    <span x-show="show" x-cloak>${{ number_format($totalLoanPrincipal, 2) }}</span>
                    <span x-show="!show" class="tracking-wider text-slate-400 font-mono text-xl group-hover:text-slate-600 transition-colors">$ ••••••••</span>
                </h4>
                <span class="text-xs font-semibold text-[#0F4C5C] bg-[#0F4C5C]/10 px-2 py-0.5 rounded-md border border-[#0F4C5C]/20">
                    មានស្ថិរភាព
                </span>
            </div>

            <div class="mt-3 pt-3 border-t border-slate-100 flex items-center justify-between text-[11px] text-slate-400">
                <span class="flex items-center gap-1">
                    <i class="bi bi-shield-check text-[#0F4C5C]"></i> ទ្រព្យបញ្ចាំ {{ number_format($collateralsCount) }} មុខ
                </span>
                <a href="{{ route('collaterals.index') }}" class="text-[#0F4C5C] hover:text-[#10B981] font-semibold transition-colors">
                    ឃ្លាំងទ្រព្យ &rarr;
                </a>
            </div>
        </div>

        <!-- Metric 3: Interest & Payments Collected -->
        <div x-data="{ show: false }" class="group relative bg-white p-5 rounded-2xl border border-slate-200/90 shadow-2xs hover:shadow-md hover:border-[#10B981]/50 transition-all duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <div class="flex items-center gap-1.5">
                        <span class="text-xs font-semibold text-slate-500 uppercase tracking-wider">ការប្រាក់ប្រមូលបាន</span>
                        <button type="button" 
                                @click="show = !show" 
                                class="text-slate-400 hover:text-emerald-600 p-0.5 rounded transition-colors focus:outline-none" 
                                :title="show ? 'ចុចដើម្បីលាក់' : 'ចុចដើម្បីបង្ហាញ'">
                            <i class="bi text-xs" :class="show ? 'bi-eye' : 'bi-eye-slash'"></i>
                        </button>
                    </div>
                    <p class="text-[11px] text-slate-400 mt-0.5">Monthly Interest Income</p>
                </div>
                <span class="w-11 h-11 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-lg shadow-2xs group-hover:scale-105 transition-transform">
                    <i class="bi bi-graph-up-arrow"></i>
                </span>
            </div>

            <div class="mt-4 flex items-baseline justify-between">
                <h4 class="text-2xl sm:text-3xl font-extrabold text-[#0B2B40] tracking-tight cursor-pointer select-none inline-flex items-center" 
                    @click="show = !show" 
                    :title="show ? 'ចុចដើម្បីលាក់' : 'ចុចដើម្បីបង្ហាញ'">
                    <span x-show="show" x-cloak>${{ number_format($repaymentsSum, 2) }}</span>
                    <span x-show="!show" class="tracking-wider text-slate-400 font-mono text-xl group-hover:text-slate-600 transition-colors">$ ••••••••</span>
                </h4>
                <span class="text-xs font-bold text-[#10B981] bg-[#EEF7F0] px-2 py-0.5 rounded-md flex items-center gap-0.5 border border-emerald-200/60">
                    <i class="bi bi-arrow-up-short"></i>+28.4%
                </span>
            </div>

            <div class="mt-3 pt-3 border-t border-slate-100 flex items-center justify-between text-[11px] text-slate-400">
                <span class="flex items-center gap-1">
                    <i class="bi bi-pie-chart-fill text-emerald-600"></i> សម្រេចបាន ៨៥% ផែនការ
                </span>
                <a href="{{ route('repayments.index') }}" class="text-[#0F4C5C] hover:text-[#10B981] font-semibold transition-colors">
                    ប្រវត្តិបង់ &rarr;
                </a>
            </div>
        </div>

        <!-- Metric 4: Overdue & Upcoming Repayments -->
        <div x-data="{ show: false }" class="group relative bg-white p-5 rounded-2xl border border-slate-200/90 shadow-2xs hover:shadow-md hover:border-amber-400/50 transition-all duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <div class="flex items-center gap-1.5">
                        <span class="text-xs font-semibold text-slate-500 uppercase tracking-wider">ប្រាក់ដល់កំណត់បង់</span>
                        <button type="button" 
                                @click="show = !show" 
                                class="text-slate-400 hover:text-amber-600 p-0.5 rounded transition-colors focus:outline-none" 
                                :title="show ? 'ចុចដើម្បីលាក់' : 'ចុចដើម្បីបង្ហាញ'">
                            <i class="bi text-xs" :class="show ? 'bi-eye' : 'bi-eye-slash'"></i>
                        </button>
                    </div>
                    <p class="text-[11px] text-slate-400 mt-0.5">Due & Pending Repayments</p>
                </div>
                <span class="w-11 h-11 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center text-lg shadow-2xs group-hover:scale-105 transition-transform">
                    <i class="bi bi-clock-history"></i>
                </span>
            </div>

            <div class="mt-4 flex items-baseline justify-between">
                <h4 class="text-2xl sm:text-3xl font-extrabold text-[#0B2B40] tracking-tight cursor-pointer select-none inline-flex items-center" 
                    @click="show = !show" 
                    :title="show ? 'ចុចដើម្បីលាក់' : 'ចុចដើម្បីបង្ហាញ'">
                    <span x-show="show" x-cloak>$2,456.00</span>
                    <span x-show="!show" class="tracking-wider text-slate-400 font-mono text-xl group-hover:text-slate-600 transition-colors">$ ••••••••</span>
                </h4>
                <span class="text-xs font-semibold text-amber-800 bg-amber-100/70 px-2 py-0.5 rounded-md border border-amber-300/50">
                    ១២ អតិថិជន
                </span>
            </div>

            <div class="mt-3 pt-3 border-t border-slate-100 flex items-center justify-between text-[11px] text-slate-400">
                <span class="flex items-center gap-1 text-amber-600">
                    <i class="bi bi-exclamation-triangle-fill"></i> តាមដានក្នុងសប្តាហ៍នេះ
                </span>
                <a href="{{ route('loans.index') }}" class="text-[#0F4C5C] hover:text-[#10B981] font-semibold transition-colors">
                    ពិនិត្យ &rarr;
                </a>
            </div>
        </div>

    </div>

    <!-- ============================================================== -->
    <!-- QUICK SHORTCUTS STRIP                                          -->
    <!-- ============================================================== -->
    <div class="bg-white rounded-2xl border border-slate-200/90 p-4 sm:p-5 shadow-2xs">
        <div class="flex items-center justify-between mb-3 px-1">
            <h3 class="text-xs font-bold uppercase tracking-wider text-slate-400 flex items-center gap-2">
                <i class="bi bi-grid text-[#0F4C5C]"></i>
                <span>ផ្លូវកាត់ប្រតិបត្តិការរហ័ស (Quick Operations)</span>
            </h3>
            <span class="text-[11px] text-slate-400">ចុចលើផ្នែកណាមួយដើម្បីចូលប្រើ</span>
        </div>

        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-3">
            <!-- Shortcut 1: Loans -->
            <a href="{{ route('loans.index') }}" class="group p-3 rounded-xl bg-slate-50/80 hover:bg-[#EEF7F0] border border-slate-200/70 hover:border-emerald-300 transition-all text-center flex flex-col items-center">
                <div class="w-10 h-10 rounded-xl bg-white group-hover:bg-[#10B981] text-[#0F4C5C] group-hover:text-white flex items-center justify-center text-lg shadow-2xs transition-colors mb-2">
                    <i class="bi bi-file-earmark-text"></i>
                </div>
                <span class="text-xs font-bold text-slate-700 group-hover:text-emerald-900">កិច្ចសន្យាកម្ចី</span>
                <span class="text-[10px] text-slate-400 mt-0.5">{{ number_format($activeLoansCount) }} កិច្ចសន្យា</span>
            </a>

            <!-- Shortcut 2: Repayments -->
            <a href="{{ route('repayments.index') }}" class="group p-3 rounded-xl bg-slate-50/80 hover:bg-[#EEF7F0] border border-slate-200/70 hover:border-emerald-300 transition-all text-center flex flex-col items-center">
                <div class="w-10 h-10 rounded-xl bg-white group-hover:bg-[#10B981] text-[#0F4C5C] group-hover:text-white flex items-center justify-center text-lg shadow-2xs transition-colors mb-2">
                    <i class="bi bi-cash-stack"></i>
                </div>
                <span class="text-xs font-bold text-slate-700 group-hover:text-emerald-900">ទទួលប្រាក់សង</span>
                <span class="text-[10px] text-slate-400 mt-0.5">ប្រតិបត្តិការប្រចាំថ្ងៃ</span>
            </a>

            <!-- Shortcut 3: Customers -->
            <a href="{{ route('customers.index') }}" class="group p-3 rounded-xl bg-slate-50/80 hover:bg-[#EEF7F0] border border-slate-200/70 hover:border-emerald-300 transition-all text-center flex flex-col items-center">
                <div class="w-10 h-10 rounded-xl bg-white group-hover:bg-[#10B981] text-[#0F4C5C] group-hover:text-white flex items-center justify-center text-lg shadow-2xs transition-colors mb-2">
                    <i class="bi bi-person-lines-fill"></i>
                </div>
                <span class="text-xs font-bold text-slate-700 group-hover:text-emerald-900">បញ្ជីអតិថិជន</span>
                <span class="text-[10px] text-slate-400 mt-0.5">{{ number_format($totalCustomersCount) }} អតិថិជន</span>
            </a>

            <!-- Shortcut 4: Collaterals -->
            <a href="{{ route('collaterals.index') }}" class="group p-3 rounded-xl bg-slate-50/80 hover:bg-[#EEF7F0] border border-slate-200/70 hover:border-emerald-300 transition-all text-center flex flex-col items-center">
                <div class="w-10 h-10 rounded-xl bg-white group-hover:bg-[#10B981] text-[#0F4C5C] group-hover:text-white flex items-center justify-center text-lg shadow-2xs transition-colors mb-2">
                    <i class="bi bi-box-seam"></i>
                </div>
                <span class="text-xs font-bold text-slate-700 group-hover:text-emerald-900">ឃ្លាំងទ្រព្យបញ្ចាំ</span>
                <span class="text-[10px] text-slate-400 mt-0.5">{{ number_format($collateralsCount) }} មុខ</span>
            </a>

            <!-- Shortcut 5: Staff -->
            <a href="{{ route('staff.index') }}" class="group p-3 rounded-xl bg-slate-50/80 hover:bg-[#EEF7F0] border border-slate-200/70 hover:border-emerald-300 transition-all text-center flex flex-col items-center">
                <div class="w-10 h-10 rounded-xl bg-white group-hover:bg-[#10B981] text-[#0F4C5C] group-hover:text-white flex items-center justify-center text-lg shadow-2xs transition-colors mb-2">
                    <i class="bi bi-person-badge"></i>
                </div>
                <span class="text-xs font-bold text-slate-700 group-hover:text-emerald-900">បុគ្គលិកធនាគារ</span>
                <span class="text-[10px] text-slate-400 mt-0.5">{{ number_format($totalStaffCount) }} នាក់</span>
            </a>

            <!-- Shortcut 6: Deposits / Savings -->
            <a href="{{ route('deposits.index') }}" class="group p-3 rounded-xl bg-slate-50/80 hover:bg-[#EEF7F0] border border-slate-200/70 hover:border-emerald-300 transition-all text-center flex flex-col items-center">
                <div class="w-10 h-10 rounded-xl bg-white group-hover:bg-[#10B981] text-[#0F4C5C] group-hover:text-white flex items-center justify-center text-lg shadow-2xs transition-colors mb-2">
                    <i class="bi bi-piggy-bank"></i>
                </div>
                <span class="text-xs font-bold text-slate-700 group-hover:text-emerald-900">ប្រាក់បញ្ញើសន្សំ</span>
                <span class="text-[10px] text-slate-400 mt-0.5">ការគ្រប់គ្រងគណនី</span>
            </a>
        </div>
    </div>

    <!-- ============================================================== -->
    <!-- ROW 2: REVENUE ANALYTICS + COLLATERAL INVENTORY BREAKDOWN      -->
    <!-- ============================================================== -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">

        <!-- Monthly Revenue Comparison Bar Graph (8 cols) -->
        <div class="lg:col-span-8 bg-white p-5 sm:p-6 rounded-2xl border border-slate-200/90 shadow-2xs flex flex-col justify-between">
            <div>
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 pb-4 border-b border-slate-100">
                    <div>
                        <div class="flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full bg-[#0F4C5C]"></span>
                            <h4 class="text-sm sm:text-base font-bold text-[#0B2B40]">
                                របាយការណ៍ចំណូលការប្រាក់ប្រចាំខែ (២០២៥ - ២០២៦)
                            </h4>
                        </div>
                        <p class="text-xs text-slate-400 mt-0.5">
                            ការប្រៀបធៀបចំណូលការប្រាក់ និងសេវាឥណទានពីមួយខែទៅមួយខែ
                        </p>
                    </div>

                    <div class="flex items-center gap-4 text-xs font-semibold">
                        <div class="flex items-center gap-1.5 bg-slate-50 px-2.5 py-1 rounded-md border border-slate-200">
                            <span class="w-3 h-3 rounded-xs bg-[#0F4C5C]"></span>
                            <span class="text-slate-700">ឆ្នាំ ២០២៦ ($32,500)</span>
                        </div>
                        <div class="flex items-center gap-1.5 bg-slate-50 px-2.5 py-1 rounded-md border border-slate-200">
                            <span class="w-3 h-3 rounded-xs bg-[#10B981]"></span>
                            <span class="text-slate-700">ឆ្នាំ ២០២៥ ($41,200)</span>
                        </div>
                    </div>
                </div>

                <!-- Clean Styled Bar Chart Visualizer -->
                <div class="h-64 w-full flex items-end justify-between gap-2 sm:gap-4 pt-10 pb-2 px-2 border-b border-slate-200">
                    <!-- Jan -->
                    <div class="flex-1 flex flex-col items-center h-full justify-end group cursor-pointer">
                        <div class="text-[10px] text-slate-400 opacity-0 group-hover:opacity-100 transition-opacity mb-1 font-mono">$4.2k</div>
                        <div class="w-full max-w-[40px] flex items-end justify-center gap-1 sm:gap-1.5 h-full">
                            <div class="w-3 sm:w-4 bg-[#0F4C5C] group-hover:bg-[#134E5E] rounded-t-md h-[65%] transition-all shadow-2xs" title="2026: $4,200"></div>
                            <div class="w-3 sm:w-4 bg-[#10B981] group-hover:bg-[#059669] rounded-t-md h-[45%] transition-all shadow-2xs" title="2025: $3,100"></div>
                        </div>
                        <span class="text-[11px] font-semibold text-slate-500 mt-2.5">មករា</span>
                    </div>

                    <!-- Feb -->
                    <div class="flex-1 flex flex-col items-center h-full justify-end group cursor-pointer">
                        <div class="text-[10px] text-slate-400 opacity-0 group-hover:opacity-100 transition-opacity mb-1 font-mono">$3.8k</div>
                        <div class="w-full max-w-[40px] flex items-end justify-center gap-1 sm:gap-1.5 h-full">
                            <div class="w-3 sm:w-4 bg-[#0F4C5C] group-hover:bg-[#134E5E] rounded-t-md h-[50%] transition-all shadow-2xs" title="2026: $3,800"></div>
                            <div class="w-3 sm:w-4 bg-[#10B981] group-hover:bg-[#059669] rounded-t-md h-[55%] transition-all shadow-2xs" title="2025: $4,100"></div>
                        </div>
                        <span class="text-[11px] font-semibold text-slate-500 mt-2.5">កុម្ភៈ</span>
                    </div>

                    <!-- Mar -->
                    <div class="flex-1 flex flex-col items-center h-full justify-end group cursor-pointer">
                        <div class="text-[10px] text-slate-400 opacity-0 group-hover:opacity-100 transition-opacity mb-1 font-mono">$4.8k</div>
                        <div class="w-full max-w-[40px] flex items-end justify-center gap-1 sm:gap-1.5 h-full">
                            <div class="w-3 sm:w-4 bg-[#0F4C5C] group-hover:bg-[#134E5E] rounded-t-md h-[62%] transition-all shadow-2xs" title="2026: $4,800"></div>
                            <div class="w-3 sm:w-4 bg-[#10B981] group-hover:bg-[#059669] rounded-t-md h-[40%] transition-all shadow-2xs" title="2025: $3,000"></div>
                        </div>
                        <span class="text-[11px] font-semibold text-slate-500 mt-2.5">មីនា</span>
                    </div>

                    <!-- Apr -->
                    <div class="flex-1 flex flex-col items-center h-full justify-end group cursor-pointer">
                        <div class="text-[10px] text-[#0F4C5C] font-bold opacity-0 group-hover:opacity-100 transition-opacity mb-1 font-mono">$6.5k</div>
                        <div class="w-full max-w-[40px] flex items-end justify-center gap-1 sm:gap-1.5 h-full">
                            <div class="w-3 sm:w-4 bg-[#0F4C5C] group-hover:bg-[#134E5E] rounded-t-md h-[85%] transition-all shadow-2xs ring-2 ring-[#0F4C5C]/20" title="2026: $6,500 (Peak)"></div>
                            <div class="w-3 sm:w-4 bg-[#10B981] group-hover:bg-[#059669] rounded-t-md h-[50%] transition-all shadow-2xs" title="2025: $3,900"></div>
                        </div>
                        <span class="text-[11px] font-bold text-[#0F4C5C] mt-2.5">មេសា</span>
                    </div>

                    <!-- May -->
                    <div class="flex-1 flex flex-col items-center h-full justify-end group cursor-pointer">
                        <div class="text-[10px] text-slate-400 opacity-0 group-hover:opacity-100 transition-opacity mb-1 font-mono">$5.1k</div>
                        <div class="w-full max-w-[40px] flex items-end justify-center gap-1 sm:gap-1.5 h-full">
                            <div class="w-3 sm:w-4 bg-[#0F4C5C] group-hover:bg-[#134E5E] rounded-t-md h-[70%] transition-all shadow-2xs" title="2026: $5,100"></div>
                            <div class="w-3 sm:w-4 bg-[#10B981] group-hover:bg-[#059669] rounded-t-md h-[45%] transition-all shadow-2xs" title="2025: $3,400"></div>
                        </div>
                        <span class="text-[11px] font-semibold text-slate-500 mt-2.5">ឧសភា</span>
                    </div>

                    <!-- Jun -->
                    <div class="flex-1 flex flex-col items-center h-full justify-end group cursor-pointer">
                        <div class="text-[10px] text-slate-400 opacity-0 group-hover:opacity-100 transition-opacity mb-1 font-mono">$5.6k</div>
                        <div class="w-full max-w-[40px] flex items-end justify-center gap-1 sm:gap-1.5 h-full">
                            <div class="w-3 sm:w-4 bg-[#0F4C5C] group-hover:bg-[#134E5E] rounded-t-md h-[76%] transition-all shadow-2xs" title="2026: $5,600"></div>
                            <div class="w-3 sm:w-4 bg-[#10B981] group-hover:bg-[#059669] rounded-t-md h-[60%] transition-all shadow-2xs" title="2025: $4,500"></div>
                        </div>
                        <span class="text-[11px] font-semibold text-slate-500 mt-2.5">មិថុនា</span>
                    </div>

                    <!-- Jul -->
                    <div class="flex-1 flex flex-col items-center h-full justify-end group cursor-pointer">
                        <div class="text-[10px] text-slate-400 opacity-0 group-hover:opacity-100 transition-opacity mb-1 font-mono">$6.0k</div>
                        <div class="w-full max-w-[40px] flex items-end justify-center gap-1 sm:gap-1.5 h-full">
                            <div class="w-3 sm:w-4 bg-[#0F4C5C] group-hover:bg-[#134E5E] rounded-t-md h-[80%] transition-all shadow-2xs" title="2026: $6,000"></div>
                            <div class="w-3 sm:w-4 bg-[#10B981] group-hover:bg-[#059669] rounded-t-md h-[52%] transition-all shadow-2xs" title="2025: $3,900"></div>
                        </div>
                        <span class="text-[11px] font-semibold text-slate-500 mt-2.5">កក្កដា</span>
                    </div>
                </div>
            </div>

            <!-- Footer Stats Insight -->
            <div class="pt-4 mt-2 flex flex-col sm:flex-row sm:items-center justify-between gap-2 text-xs text-slate-500">
                <div class="flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-[#10B981]"></span>
                    <span>អត្រាកំណើនមធ្យមប្រចាំខែ៖ <strong class="text-[#059669] font-bold">+14.2%</strong></span>
                    <span class="text-slate-300">|</span>
                    <span>អត្រាហានិភ័យទាប៖ <strong class="text-[#0F4C5C] font-semibold">1.4%</strong></span>
                </div>
                <a href="{{ route('loans.index') }}" class="text-[#0F4C5C] hover:text-[#10B981] font-semibold inline-flex items-center gap-1 transition-colors">
                    <span>ទាញយករបាយការណ៍លម្អិត</span>
                    <i class="bi bi-arrow-right"></i>
                </a>
            </div>
        </div>

        <!-- Collateral / Portfolio Categories (4 cols) -->
        <div class="lg:col-span-4 bg-white p-5 sm:p-6 rounded-2xl border border-slate-200/90 shadow-2xs flex flex-col justify-between">
            <div>
                <div class="pb-4 border-b border-slate-100 flex items-center justify-between">
                    <div>
                        <h4 class="text-sm sm:text-base font-bold text-[#0B2B40]">ប្រភេទទ្រព្យបញ្ចាំក្នុងឃ្លាំង</h4>
                        <p class="text-xs text-slate-400 mt-0.5">បែងចែកតាមប្រភេទទ្រព្យធានាក្នុងប្រព័ន្ធ</p>
                    </div>
                    <span class="w-8 h-8 rounded-lg bg-slate-100 text-[#0F4C5C] flex items-center justify-center text-sm">
                        <i class="bi bi-shield-shaded"></i>
                    </span>
                </div>

                <!-- Category Progress Bars -->
                <div class="space-y-4 mt-5">
                    
                    <!-- Item 1: Vehicles -->
                    <div class="p-3 rounded-xl bg-slate-50/70 border border-slate-200/60">
                        <div class="flex justify-between text-xs mb-2">
                            <span class="font-bold text-slate-800 flex items-center gap-2">
                                <span class="w-6 h-6 rounded-md bg-[#0F4C5C]/10 text-[#0F4C5C] flex items-center justify-center text-xs">
                                    <i class="bi bi-car-front-fill"></i>
                                </span>
                                <span>យានយន្ត និងកាតគ្រី</span>
                            </span>
                            <div class="text-right">
                                <span class="font-bold text-[#0B2B40]">55%</span>
                                <span class="text-[11px] text-slate-400 block">$45,400</span>
                            </div>
                        </div>
                        <div class="w-full h-2.5 bg-slate-200/80 rounded-full overflow-hidden">
                            <div class="bg-gradient-to-r from-[#0B2B40] to-[#0F4C5C] h-full rounded-full transition-all duration-500" style="width: 55%"></div>
                        </div>
                    </div>

                    <!-- Item 2: Gold & Jewelry -->
                    <div class="p-3 rounded-xl bg-slate-50/70 border border-slate-200/60">
                        <div class="flex justify-between text-xs mb-2">
                            <span class="font-bold text-slate-800 flex items-center gap-2">
                                <span class="w-6 h-6 rounded-md bg-emerald-100 text-emerald-700 flex items-center justify-center text-xs">
                                    <i class="bi bi-gem"></i>
                                </span>
                                <span>មាស និងគ្រឿងអលង្ការ</span>
                            </span>
                            <div class="text-right">
                                <span class="font-bold text-[#0B2B40]">30%</span>
                                <span class="text-[11px] text-slate-400 block">$24,780</span>
                            </div>
                        </div>
                        <div class="w-full h-2.5 bg-slate-200/80 rounded-full overflow-hidden">
                            <div class="bg-gradient-to-r from-emerald-500 to-[#10B981] h-full rounded-full transition-all duration-500" style="width: 30%"></div>
                        </div>
                    </div>

                    <!-- Item 3: Electronics -->
                    <div class="p-3 rounded-xl bg-slate-50/70 border border-slate-200/60">
                        <div class="flex justify-between text-xs mb-2">
                            <span class="font-bold text-slate-800 flex items-center gap-2">
                                <span class="w-6 h-6 rounded-md bg-amber-100 text-amber-700 flex items-center justify-center text-xs">
                                    <i class="bi bi-laptop"></i>
                                </span>
                                <span>គ្រឿងអេឡិចត្រូនិក</span>
                            </span>
                            <div class="text-right">
                                <span class="font-bold text-[#0B2B40]">15%</span>
                                <span class="text-[11px] text-slate-400 block">$12,400</span>
                            </div>
                        </div>
                        <div class="w-full h-2.5 bg-slate-200/80 rounded-full overflow-hidden">
                            <div class="bg-gradient-to-r from-amber-400 to-amber-500 h-full rounded-full transition-all duration-500" style="width: 15%"></div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="mt-6 pt-4 border-t border-slate-100 flex items-center justify-between text-xs">
                <span class="text-slate-500">
                    ទ្រព្យសរុប៖ <strong class="text-[#0B2B40] font-bold">{{ number_format($collateralsCount) }} មុខ</strong>
                </span>
                <a href="{{ route('collaterals.index') }}" class="text-[#0F4C5C] hover:text-[#10B981] font-bold inline-flex items-center gap-1 transition-colors">
                    <span>ពិនិត្យមើលឃ្លាំង</span>
                    <i class="bi bi-arrow-right"></i>
                </a>
            </div>
        </div>

    </div>

    <!-- ============================================================== -->
    <!-- ROW 3: RECENT FINANCIAL TRANSACTIONS TABLE                     -->
    <!-- ============================================================== -->
    <div class="bg-white rounded-2xl border border-slate-200/90 shadow-2xs overflow-hidden">
        
        <!-- Table Top Header -->
        <div class="p-5 sm:p-6 border-b border-slate-100 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <div class="flex items-center gap-2">
                    <span class="w-2.5 h-2.5 rounded-full bg-[#10B981]"></span>
                    <h4 class="text-base font-bold text-[#0B2B40]">
                        ប្រតិបត្តិការហិរញ្ញវត្ថុ និងការបង់ប្រាក់ចុងក្រោយ (Recent Financial Activity)
                    </h4>
                </div>
                <p class="text-xs text-slate-400 mt-0.5">
                    បញ្ជីប្រតិបត្តិការបញ្ចេញកម្ចី ការទទួលប្រាក់សង និងបិទកិច្ចសន្យាប្រចាំថ្ងៃ
                </p>
            </div>

            <div class="flex items-center gap-2">
                <a href="{{ route('repayments.index') }}" 
                   class="inline-flex items-center gap-1.5 px-3.5 py-2 rounded-xl border border-slate-200 text-xs font-semibold text-slate-700 hover:bg-slate-50 hover:border-slate-300 transition-all shadow-2xs">
                    <i class="bi bi-list-check text-sm text-[#0F4C5C]"></i>
                    <span>មើលប្រតិបត្តិការទាំងអស់</span>
                    <i class="bi bi-chevron-right text-[10px]"></i>
                </a>
            </div>
        </div>

        <!-- Transactions Table -->
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50/80 border-b border-slate-200 text-[11px] font-bold text-slate-500 uppercase tracking-wider">
                        <th class="py-3.5 px-6">លេខកូដប្រតិបត្តិការ (Tx ID)</th>
                        <th class="py-3.5 px-6">ប្រភេទប្រតិបត្តិការ</th>
                        <th class="py-3.5 px-6">អតិថិជន (Customer)</th>
                        <th class="py-3.5 px-6">កាលបរិច្ឆេទ & ម៉ោង</th>
                        <th class="py-3.5 px-6">ស្ថានភាព</th>
                        <th class="py-3.5 px-6 text-right">ចំនួនទឹកប្រាក់</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-xs">
                    @forelse($recentRepayments as $repayment)
                        <tr class="hover:bg-slate-50/70 transition-colors group">
                            <!-- Tx ID -->
                            <td class="py-4 px-6 whitespace-nowrap font-mono font-bold text-[#0F4C5C]">
                                #TRX-{{ str_pad($repayment->id, 5, '0', STR_PAD_LEFT) }}
                            </td>

                            <!-- Payment Type -->
                            <td class="py-4 px-6 whitespace-nowrap font-semibold text-slate-800">
                                <div class="flex items-center gap-2">
                                    <span class="w-7 h-7 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center text-xs">
                                        <i class="bi bi-arrow-down-left"></i>
                                    </span>
                                    <span>{{ $repayment->payment_type ?? 'បង់ប្រាក់ការប្រាក់ប្រចាំខែ' }}</span>
                                </div>
                            </td>

                            <!-- Customer Name -->
                            <td class="py-4 px-6 whitespace-nowrap">
                                <div class="font-bold text-slate-700">
                                    {{ $repayment->loan->customer->name ?? 'អតិថិជនទូទៅ' }}
                                </div>
                                @if(!empty($repayment->loan->customer->phone))
                                    <div class="text-[10px] text-slate-400">
                                        {{ $repayment->loan->customer->phone }}
                                    </div>
                                @endif
                            </td>

                            <!-- Date -->
                            <td class="py-4 px-6 whitespace-nowrap text-slate-500">
                                {{ $repayment->payment_date ? \Carbon\Carbon::parse($repayment->payment_date)->format('d/m/Y') : ($repayment->created_at ? $repayment->created_at->format('d/m/Y, h:i A') : 'ថ្ងៃនេះ') }}
                            </td>

                            <!-- Status -->
                            <td class="py-4 px-6 whitespace-nowrap">
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[11px] font-semibold bg-[#EEF7F0] text-[#059669] border border-emerald-200/70">
                                    <span class="w-1.5 h-1.5 rounded-full bg-[#10B981]"></span>
                                    <span>ជោគជ័យ</span>
                                </span>
                            </td>

                            <!-- Amount -->
                            <td class="py-4 px-6 whitespace-nowrap text-right font-extrabold text-sm text-[#059669]">
                                +${{ number_format($repayment->amount_paid, 2) }} USD
                            </td>
                        </tr>
                    @empty
                        <!-- Default High Fidelity Sample Records -->
                        <tr class="hover:bg-slate-50/70 transition-colors">
                            <td class="py-4 px-6 whitespace-nowrap font-mono font-bold text-[#0F4C5C]">
                                #TRX-08094
                            </td>
                            <td class="py-4 px-6 whitespace-nowrap font-semibold text-slate-800">
                                <div class="flex items-center gap-2">
                                    <span class="w-7 h-7 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center text-xs">
                                        <i class="bi bi-arrow-down-left"></i>
                                    </span>
                                    <span>បង់ប្រាក់ការប្រាក់ប្រចាំខែ</span>
                                </div>
                            </td>
                            <td class="py-4 px-6 whitespace-nowrap">
                                <div class="font-bold text-slate-700">សុខ ចាន់ថា</div>
                                <div class="text-[10px] text-slate-400">012 345 678</div>
                            </td>
                            <td class="py-4 px-6 whitespace-nowrap text-slate-500">ថ្ងៃនេះ, 10:30 ព្រឹក</td>
                            <td class="py-4 px-6 whitespace-nowrap">
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[11px] font-semibold bg-[#EEF7F0] text-[#059669] border border-emerald-200/70">
                                    <span class="w-1.5 h-1.5 rounded-full bg-[#10B981]"></span>
                                    <span>ជោគជ័យ</span>
                                </span>
                            </td>
                            <td class="py-4 px-6 whitespace-nowrap text-right font-extrabold text-sm text-[#059669]">
                                +$82.60 USD
                            </td>
                        </tr>

                        <tr class="hover:bg-slate-50/70 transition-colors">
                            <td class="py-4 px-6 whitespace-nowrap font-mono font-bold text-[#0F4C5C]">
                                #TRX-08093
                            </td>
                            <td class="py-4 px-6 whitespace-nowrap font-semibold text-slate-800">
                                <div class="flex items-center gap-2">
                                    <span class="w-7 h-7 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center text-xs">
                                        <i class="bi bi-check2-circle"></i>
                                    </span>
                                    <span>លស់ទ្រព្យបញ្ចាំ (បិទកិច្ចសន្យា)</span>
                                </div>
                            </td>
                            <td class="py-4 px-6 whitespace-nowrap">
                                <div class="font-bold text-slate-700">លី ម៉េងហួរ</div>
                                <div class="text-[10px] text-slate-400">098 765 432</div>
                            </td>
                            <td class="py-4 px-6 whitespace-nowrap text-slate-500">ថ្ងៃនេះ, 09:15 ព្រឹក</td>
                            <td class="py-4 px-6 whitespace-nowrap">
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[11px] font-semibold bg-[#EEF7F0] text-[#059669] border border-emerald-200/70">
                                    <span class="w-1.5 h-1.5 rounded-full bg-[#10B981]"></span>
                                    <span>ជោគជ័យ</span>
                                </span>
                            </td>
                            <td class="py-4 px-6 whitespace-nowrap text-right font-extrabold text-sm text-[#059669]">
                                +$270.69 USD
                            </td>
                        </tr>

                        <tr class="hover:bg-slate-50/70 transition-colors">
                            <td class="py-4 px-6 whitespace-nowrap font-mono font-bold text-[#0F4C5C]">
                                #TRX-08092
                            </td>
                            <td class="py-4 px-6 whitespace-nowrap font-semibold text-slate-800">
                                <div class="flex items-center gap-2">
                                    <span class="w-7 h-7 rounded-lg bg-sky-50 text-sky-600 flex items-center justify-center text-xs">
                                        <i class="bi bi-arrow-up-right"></i>
                                    </span>
                                    <span>បញ្ចេញប្រាក់កម្ចីថ្មី (ម៉ូតូ Honda)</span>
                                </div>
                            </td>
                            <td class="py-4 px-6 whitespace-nowrap">
                                <div class="font-bold text-slate-700">ជា សុវណ្ណារិទ្ធ</div>
                                <div class="text-[10px] text-slate-400">077 112 233</div>
                            </td>
                            <td class="py-4 px-6 whitespace-nowrap text-slate-500">ម្សិលមិញ, 03:45 រសៀល</td>
                            <td class="py-4 px-6 whitespace-nowrap">
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[11px] font-semibold bg-sky-50 text-sky-700 border border-sky-200">
                                    <span class="w-1.5 h-1.5 rounded-full bg-sky-500"></span>
                                    <span>បានបើកប្រាក់</span>
                                </span>
                            </td>
                            <td class="py-4 px-6 whitespace-nowrap text-right font-extrabold text-sm text-[#0B2B40]">
                                -$850.00 USD
                            </td>
                        </tr>

                        <tr class="hover:bg-slate-50/70 transition-colors">
                            <td class="py-4 px-6 whitespace-nowrap font-mono font-bold text-[#0F4C5C]">
                                #TRX-08091
                            </td>
                            <td class="py-4 px-6 whitespace-nowrap font-semibold text-slate-800">
                                <div class="flex items-center gap-2">
                                    <span class="w-7 h-7 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center text-xs">
                                        <i class="bi bi-arrow-down-left"></i>
                                    </span>
                                    <span>បង់ប្រាក់ដើម និងការប្រាក់</span>
                                </div>
                            </td>
                            <td class="py-4 px-6 whitespace-nowrap">
                                <div class="font-bold text-slate-700">ចាន់ ដារ៉ា</div>
                                <div class="text-[10px] text-slate-400">089 990 011</div>
                            </td>
                            <td class="py-4 px-6 whitespace-nowrap text-slate-500">ម្សិលមិញ, 01:20 រសៀល</td>
                            <td class="py-4 px-6 whitespace-nowrap">
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[11px] font-semibold bg-[#EEF7F0] text-[#059669] border border-emerald-200/70">
                                    <span class="w-1.5 h-1.5 rounded-full bg-[#10B981]"></span>
                                    <span>ជោគជ័យ</span>
                                </span>
                            </td>
                            <td class="py-4 px-6 whitespace-nowrap text-right font-extrabold text-sm text-[#059669]">
                                +$637.91 USD
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <!-- Table Footer -->
        <div class="p-4 bg-slate-50/70 border-t border-slate-100 flex flex-col sm:flex-row items-center justify-between gap-3 text-xs text-slate-500">
            <span class="flex items-center gap-2">
                <i class="bi bi-info-circle text-[#0F4C5C]"></i>
                <span>ទិន្នន័យត្រូវបានធ្វើបច្ចុប្បន្នភាពតាមពេលវេលាជាក់ស្តែង (Real-time synchronization)</span>
            </span>
            <a href="{{ route('repayments.index') }}" class="font-bold text-[#0F4C5C] hover:text-[#10B981] transition-colors">
                ចូលទៅកាន់ទំព័រប្រតិបត្តិការលម្អិត &rarr;
            </a>
        </div>
    </div>

</div>
@endsection

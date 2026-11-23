@extends('layouts.master')

@section('title', 'របាយការណ៍ហិរញ្ញវត្ថុ | ធនាគារ ចេនឡា (Financial Reports)')

@section('content')
@php
    use App\Models\Loan;
    use App\Models\Repayment;
    use App\Models\Customer;
    use App\Models\Collateral;

    $loans = Loan::with('customer')->get();
    $repayments = Repayment::all();
    $customers = Customer::all();
    $collaterals = Collateral::all();

    $totalDisbursed = $loans->sum('amount');
    $totalCollected = $repayments->sum('amount_paid');
    $totalPayable = $loans->sum('total_payable') ?: $totalDisbursed;
    $remainingBalance = max(0, $totalPayable - $totalCollected);

    $activeLoans = $loans->where('status', 'active')->count();
    $pendingLoans = $loans->where('status', 'pending')->count();
    $completedLoans = $loans->where('status', 'paid')->count();
    $totalCustomers = $customers->count();
@endphp

<div class="space-y-6">

    <!-- Header Banner -->
    <div class="bg-white rounded-2xl border border-slate-200/90 shadow-2xs overflow-hidden">
        <div class="h-1.5 w-full bg-gradient-to-r from-[#0B2B40] via-[#0F4C5C] to-[#10B981]"></div>
        <div class="p-5 sm:p-6">
            <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-4">
                <div>
                    <div class="flex items-center gap-2">
                        <span class="px-2.5 py-0.5 rounded-md bg-[#EEF7F0] text-[#059669] text-xs font-bold border border-emerald-200/70">
                            ទិន្នន័យវិភាគ // Analytics & Reporting
                        </span>
                        <span class="text-xs text-slate-400">&bull; ធនាគារ ចេនឡា</span>
                    </div>
                    <h1 class="text-xl sm:text-2xl font-extrabold text-[#0B2B40] mt-1.5 tracking-tight flex items-center gap-2">
                        <i class="bi bi-bar-chart-line text-[#10B981]"></i>
                        <span>របាយការណ៍ហិរញ្ញវត្ថុ និងឥណទាន (Financial Reports)</span>
                    </h1>
                    <p class="text-xs sm:text-sm text-slate-500 mt-0.5">
                        ទិដ្ឋភាពទូទៅនៃផលប័ត្រកម្ចី ការប្រមូលប្រាក់សង និងស្ថានភាពហិរញ្ញវត្ថុរបស់ធនាគារ
                    </p>
                </div>

                <div class="flex items-center gap-2.5 shrink-0 flex-wrap">
                    <button type="button" 
                            onclick="window.print()" 
                            class="inline-flex items-center justify-center gap-2 bg-white hover:bg-slate-50 text-slate-700 border border-slate-300 px-4 py-2.5 rounded-xl text-xs font-bold shadow-2xs transition-all duration-200 active:scale-95">
                        <i class="bi bi-printer text-sm"></i>
                        <span>បោះពុម្ពរបាយការណ៍ (Print)</span>
                    </button>
                </div>
            </div>

            <!-- KPI Summary Cards -->
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-4 mt-6 pt-5 border-t border-slate-100">
                <div class="p-4 rounded-xl bg-slate-50 border border-slate-200/70">
                    <span class="text-[11px] font-semibold text-slate-400 uppercase tracking-wider block">ទំហំកម្ចីបញ្ចេញសរុប</span>
                    <div class="text-xl font-extrabold text-[#0B2B40] mt-1">${{ number_format($totalDisbursed, 2) }}</div>
                    <div class="text-[10px] text-slate-500 mt-0.5">កិច្ចសន្យាសរុប {{ $loans->count() }}</div>
                </div>

                <div class="p-4 rounded-xl bg-emerald-50/50 border border-emerald-200/60">
                    <span class="text-[11px] font-semibold text-emerald-700 uppercase tracking-wider block">ប្រាក់បានប្រមូលសរុប</span>
                    <div class="text-xl font-extrabold text-emerald-800 mt-1">${{ number_format($totalCollected, 2) }}</div>
                    <div class="text-[10px] text-emerald-600 mt-0.5">{{ $repayments->count() }} ប្រតិបត្តិការ</div>
                </div>

                <div class="p-4 rounded-xl bg-blue-50/50 border border-blue-200/60">
                    <span class="text-[11px] font-semibold text-blue-700 uppercase tracking-wider block">សមតុល្យនៅសល់</span>
                    <div class="text-xl font-extrabold text-blue-800 mt-1">${{ number_format($remainingBalance, 2) }}</div>
                    <div class="text-[10px] text-blue-600 mt-0.5">ដើម និងការប្រាក់រង់ចាំប្រមូល</div>
                </div>

                <div class="p-4 rounded-xl bg-cyan-50/50 border border-cyan-200/60">
                    <span class="text-[11px] font-semibold text-cyan-700 uppercase tracking-wider block">អតិថិជនសរុប</span>
                    <div class="text-xl font-extrabold text-cyan-800 mt-1">{{ number_format($totalCustomers) }} នាក់</div>
                    <div class="text-[10px] text-cyan-600 mt-0.5">កម្ចីសកម្ម {{ $activeLoans }} នាក់</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Loan Status & Details Overview -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Loan Portfolio Status Breakdown -->
        <div class="bg-white rounded-2xl border border-slate-200/90 shadow-2xs p-5">
            <h3 class="font-bold text-sm text-[#0B2B40] mb-4 flex items-center gap-2">
                <i class="bi bi-pie-chart text-[#10B981]"></i>
                <span>ស្ថានភាពផលប័ត្រកម្ចី (Loan Status)</span>
            </h3>
            <div class="space-y-3">
                <div class="flex items-center justify-between p-3 rounded-xl bg-emerald-50 text-emerald-800">
                    <span class="text-xs font-semibold">កម្ចីកំពុងដំណើរការ (Active)</span>
                    <span class="text-sm font-extrabold">{{ $activeLoans }} កិច្ចសន្យា</span>
                </div>
                <div class="flex items-center justify-between p-3 rounded-xl bg-amber-50 text-amber-800">
                    <span class="text-xs font-semibold">កម្ចីរង់ចាំអនុម័ត (Pending)</span>
                    <span class="text-sm font-extrabold">{{ $pendingLoans }} កិច្ចសន្យា</span>
                </div>
                <div class="flex items-center justify-between p-3 rounded-xl bg-blue-50 text-blue-800">
                    <span class="text-xs font-semibold">កម្ចីបានទូទាត់រួច (Completed)</span>
                    <span class="text-sm font-extrabold">{{ $completedLoans }} កិច្ចសន្យា</span>
                </div>
            </div>
        </div>

        <!-- Recent Repayments Summary -->
        <div class="lg:col-span-2 bg-white rounded-2xl border border-slate-200/90 shadow-2xs p-5">
            <h3 class="font-bold text-sm text-[#0B2B40] mb-4 flex items-center gap-2">
                <i class="bi bi-clock-history text-[#10B981]"></i>
                <span>ប្រតិបត្តិការទូទាត់ប្រាក់សងចុងក្រោយ</span>
            </h3>
            <div class="overflow-x-auto">
                <table class="w-full text-xs text-left text-slate-600">
                    <thead class="bg-slate-50 text-[11px] font-bold text-slate-400 uppercase">
                        <tr>
                            <th class="py-2.5 px-3">កាលបរិច្ឆេទ</th>
                            <th class="py-2.5 px-3">កម្ចី / អតិថិជន</th>
                            <th class="py-2.5 px-3">វិធីសាស្ត្រ</th>
                            <th class="py-2.5 px-3 text-right">ទឹកប្រាក់បានបង់</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($repayments->take(6) as $r)
                        <tr>
                            <td class="py-2.5 px-3 font-mono text-[11px]">
                                {{ $r->payment_date ? date('d/m/Y', strtotime($r->payment_date)) : $r->created_at->format('d/m/Y') }}
                            </td>
                            <td class="py-2.5 px-3 font-medium text-slate-800">
                                #{{ $r->loan?->loan_number ?? $r->loan_id }} - {{ $r->loan?->customer?->name ?? 'អតិថិជន' }}
                            </td>
                            <td class="py-2.5 px-3">
                                <span class="px-2 py-0.5 rounded bg-slate-100 font-semibold text-[10px] text-slate-600">
                                    {{ $r->payment_method ?? 'Cash' }}
                                </span>
                            </td>
                            <td class="py-2.5 px-3 text-right font-bold text-emerald-600">
                                ${{ number_format($r->amount_paid, 2) }}
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="py-6 text-center text-slate-400">មិនទាន់មានទិន្នន័យនៅឡើយទេ</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
@endsection

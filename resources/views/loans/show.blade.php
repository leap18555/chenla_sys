@extends('layouts.master')

@section('title', 'Loan Overview | MyBank Sunset')

@section('content')
<div class="min-h-screen bg-[#f8f9fa] p-4 md:p-6 lg:p-8 text-slate-800 antialiased">

    {{-- TOP BAR / HEADER CONTROL --}}
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 bg-white p-5 rounded-xl border border-slate-200/60 mb-6 no-print">
        <div>
            <h1 class="text-xl font-bold text-slate-900 tracking-tight flex items-center gap-2">
                <span class="text-slate-400">តារាងសងប្រាក់</span> 
                <span class="text-sm font-normal text-slate-400">| ស្ថានភាពកាលវិភាគសងប្រាក់</span>
            </h1>
        </div>
        
        <div class="flex items-center gap-3 w-full sm:w-auto">
            <div class="bg-slate-50 border border-slate-200 text-sm px-4 py-2 rounded-lg font-medium text-slate-700 min-w-[220px]">
                #L-{{ str_pad($loan->id, 5, '0', STR_PAD_LEFT) }} - {{ $loan->customer_name }}
            </div>
            <button onclick="window.print()" class="inline-flex items-center gap-2 px-4 py-2 bg-[#059669] hover:bg-[#047857] text-white text-sm font-semibold rounded-lg shadow-sm transition-colors">
                <i class="bi bi-printer"></i> បោះពុម្ព
            </button>
        </div>
    </div>

    {{-- SUB-HEADER TITLE SECTION --}}
    <div class="mb-6">
        <h2 class="text-lg font-bold text-slate-800">កាលវិភាគសងប្រាក់</h2>
        <p class="text-xs text-slate-400 mt-0.5">
            #L-{{ str_pad($loan->id, 5, '0', STR_PAD_LEFT) }} | {{ $loan->customer_name }} | បានបោះពុម្ព: {{ now()->format('d M Y') }}
        </p>
    </div>

    @php
        $principal = $loan->amount;
        $monthlyRate = ($loan->interest_rate / 100) / 12;
        $months = floor($loan->duration);

        if ($monthlyRate > 0) {
            $monthlyPayment = $principal * ($monthlyRate * pow(1 + $monthlyRate, $months)) / (pow(1 + $monthlyRate, $months) - 1);
        } else {
            $monthlyPayment = $principal / max($months, 1);
        }

        $currencySymbol = $loan->currency === 'KHR' ? '៛' : '$';
        $totalPayment = $monthlyPayment * $months;
        $totalInterest = $totalPayment - $principal;
    @endphp

    {{-- 2x4 STATS BLOCKS --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
        <div class="bg-[#f4f5f7] border border-slate-200/80 rounded-xl p-4">
            <p class="text-[11px] text-slate-400 font-medium mb-1">ប្រាក់ដើម (Principal)</p>
            <h3 class="text-lg font-bold text-slate-900">{{ $currencySymbol }}{{ number_format($principal, 2) }}</h3>
        </div>

        <div class="bg-[#f4f5f7] border border-slate-200/80 rounded-xl p-4">
            <p class="text-[11px] text-slate-400 font-medium mb-1">ការប្រាក់ (Interest Rate)</p>
            <h3 class="text-lg font-bold text-slate-900">{{ number_format($loan->interest_rate, 2) }}% សមតុល្យថយចុះ</h3>
        </div>

        <div class="bg-[#f4f5f7] border border-slate-200/80 rounded-xl p-4">
            <p class="text-[11px] text-slate-400 font-medium mb-1">ចំនួនដងបង់ (Duration)</p>
            <h3 class="text-lg font-bold text-slate-900">{{ $months }} ប្រចាំខែ</h3>
        </div>

        <div class="bg-[#f4f5f7] border border-slate-200/80 rounded-xl p-4">
            <p class="text-[11px] text-slate-400 font-medium mb-1">សមតុល្យនៅសល់ (Remaining Balance)</p>
            <h3 class="text-lg font-bold text-slate-900">{{ $currencySymbol }}{{ number_format($principal, 2) }}</h3>
        </div>

        <div class="bg-[#f4f5f7] border border-slate-200/80 rounded-xl p-4">
            <p class="text-[11px] text-slate-400 font-medium mb-1">ការប្រាក់សរុប (Total Interest)</p>
            <h3 class="text-lg font-bold text-slate-900">{{ $currencySymbol }}{{ number_format($totalInterest, 2) }}</h3>
        </div>

        <div class="bg-[#f4f5f7] border border-slate-200/80 rounded-xl p-4">
            <p class="text-[11px] text-slate-400 font-medium mb-1">ការទូទាត់សរុប (Total Payment)</p>
            <h3 class="text-lg font-bold text-slate-900">{{ $currencySymbol }}{{ number_format($totalPayment, 2) }}</h3>
        </div>

        <div class="bg-[#f4f5f7] border border-slate-200/80 rounded-xl p-4">
            <p class="text-[11px] text-slate-400 font-medium mb-1">បានសង (Paid)</p>
            <h3 class="text-lg font-bold text-slate-900">{{ $currencySymbol }}0.00</h3>
        </div>

        <div class="bg-[#f4f5f7] border border-slate-200/80 rounded-xl p-4">
            <p class="text-[11px] text-slate-400 font-medium mb-1">កាលបរិច្ឆេទត្រូវសងបន្ទាប់</p>
            <h3 class="text-sm font-bold text-slate-900">{{ now()->addMonth()->format('d M Y') }} <span class="text-slate-400 font-normal">/ {{ $currencySymbol }}{{ number_format($monthlyPayment, 2) }}</span></h3>
        </div>
    </div>

    {{-- MAIN PAYMENT TABLE SHEET AREA --}}
    <div class="bg-white rounded-xl border border-slate-200/70 shadow-sm overflow-hidden mb-8">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-slate-200 bg-white text-[11px] font-bold uppercase tracking-wider text-slate-400/90">
                        <th class="pl-6 pr-2 py-4 text-left w-12">#</th>
                        <th class="px-4 py-4 text-left">កាលបរិច្ឆេទត្រូវបង់</th>
                        <th class="px-4 py-4 text-right">សមតុល្យប្រាក់កម្ចី</th>
                        <th class="px-4 py-4 text-right text-indigo-600">ប្រាក់ដើម</th>
                        <th class="px-4 py-4 text-right">ការប្រាក់</th>
                        <th class="px-4 py-4 text-right text-slate-900">ចំនួនទឹកប្រាក់ដែលត្រូវបង់</th>
                        <th class="px-4 py-4 text-right">ប្រាក់នៅសល់</th>
                        <th class="pl-4 pr-6 py-4 text-center w-28 no-print">ស្ថានភាព</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-slate-100 text-[13px] text-slate-700 font-medium">
                    @php 
                        $runningBalance = $principal; 
                    @endphp

                    @for ($i = 1; $i <= $months; $i++)
                        @php
                            // 1. Current row starts with the running balance
                            $startingBalance = $runningBalance;

                            // 2. Calculate dynamic interest portion
                            $interest = $startingBalance * $monthlyRate;
                            
                            // 3. Principal portion
                            $principalPaid = $monthlyPayment - $interest;
                            
                            // 4. Update formula to match: Balance - Payment = Remaining
                            $remainingBalance = $startingBalance - $monthlyPayment;

                            // Adjust final month row or floating points to clear cleanly out to absolute zero
                            if ($i == $months || $remainingBalance < 0) {
                                $remainingBalance = 0;
                            }

                            // Update running tracking balance for the next row iteration
                            $runningBalance = $startingBalance - $principalPaid;
                        @endphp

                        <tr class="hover:bg-slate-50/60 transition-colors">
                            <td class="pl-6 pr-2 py-4 text-slate-400 font-normal">{{ $i }}</td>
                            <td class="px-4 py-4 text-slate-500 font-normal">
                                {{ now()->addMonths($i)->format('d M Y') }}
                            </td>
                            <td class="px-4 py-4 text-right text-slate-600">
                                {{ $currencySymbol }}{{ number_format($startingBalance, 2) }}
                            </td>
                            <td class="px-4 py-4 text-right font-semibold text-indigo-600">
                                {{ $currencySymbol }}{{ number_format($principalPaid, 2) }}
                            </td>
                            <td class="px-4 py-4 text-right text-slate-500">
                                {{ $currencySymbol }}{{ number_format($interest, 2) }}
                            </td>
                            <td class="px-4 py-4 text-right font-bold text-slate-900">
                                {{ $currencySymbol }}{{ number_format($monthlyPayment, 2) }}
                            </td>
                            <td class="px-4 py-4 text-right font-semibold text-slate-600">
                                {{ $currencySymbol }}{{ number_format($remainingBalance, 2) }}
                            </td>
                            <td class="pl-4 pr-6 py-4 text-center no-print">
                                @if($i === 1)
                                    <span class="inline-block px-2 py-0.5 text-[11px] font-semibold bg-amber-50 text-amber-700 rounded border border-amber-200/60">
                                        បានសងខ្លះ
                                    </span>
                                @else
                                    <span class="inline-block px-2 py-0.5 text-[11px] font-semibold bg-slate-50 text-slate-500 rounded border border-slate-200/60">
                                        ដល់កំណត់
                                    </span>
                                @endif
                            </td>
                        </tr>
                    @endfor
                </tbody>
            </table>
        </div>
    </div>

    {{-- RECORD CONTROL ACTIONS --}}
    <div class="no-print flex items-center justify-end gap-3 mt-4">
        <a href="{{ route('loans.index') }}" class="px-4 py-2 rounded-lg border border-slate-200 bg-white text-slate-600 hover:bg-slate-50 font-medium text-sm transition">
            ត្រឡប់ក្រោយ
        </a>
        <a href="{{ route('loans.edit', $loan->id) }}" class="px-4 py-2 rounded-lg bg-indigo-600 hover:bg-indigo-700 text-white font-medium text-sm transition shadow-sm">
            កែប្រែទិន្នន័យ
        </a>
        <form action="{{ route('loans.destroy', $loan->id) }}" method="POST" onsubmit="return confirm('Delete permanently?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="px-4 py-2 rounded-lg bg-red-50 hover:bg-red-100 text-red-600 font-medium text-sm transition border border-red-200/40">
                លុបចោល
            </button>
        </form>
    </div>
</div>

<style>
    @media print {
        body {
            background: white !important;
            font-size: 12px;
        }
        .no-print {
            display: none !important;
        }
        .shadow-sm {
            box-shadow: none !important;
        }
    }
</style>
@endsection
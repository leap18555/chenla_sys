@extends('layouts.master')

@section('title', 'ការសងប្រាក់')
@section('header_title', 'REPAYMENT MANAGEMENT // ការសងប្រាក់')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-12 gap-5">

    <!-- Form Card -->
    <div class="lg:col-span-5 bg-white border border-slate-200/80 rounded-xl shadow-xs p-5 self-start">
        <div class="border-b border-slate-100 pb-3 mb-4">
            <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block">TRANSACTION ENTRY</span>
            <h2 class="font-bold text-slate-800 text-sm">កត់ត្រាការសងប្រាក់ / រំលស់ប្រាក់កម្ចី</h2>
        </div>

        <form action="{{ route('repayments.store') }}" method="POST" class="space-y-3.5">
            @csrf
            
            <div>
                <label class="block text-xs font-bold text-slate-600 mb-1">ជ្រើសរើសប្រាក់កម្ចី / កិច្ចសន្យា</label>
                <select name="loan_id" required class="w-full bg-slate-50 border border-slate-200 rounded-lg p-2 text-xs focus:outline-none focus:border-orange-500 text-slate-800">
                    <option value="">-- សូមជ្រើសរើស --</option>
                    @foreach($loans as $loan)
                        <option value="{{ $loan->id }}">
                            កូដ #{{ $loan->id }} - {{ $loan->customer_name }} (សមតុល្យ: ${{ number_format($loan->total_payable, 2) }})
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="block text-xs font-bold text-slate-600 mb-1">កាលបរិច្ឆេទសង</label>
                    <input type="date" name="payment_date" value="{{ date('Y-m-d') }}" required class="w-full bg-slate-50 border border-slate-200 rounded-lg p-2 text-xs focus:outline-none focus:border-orange-500 text-slate-800">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-600 mb-1">ចំនួនទឹកប្រាក់ ($)</label>
                    <input type="number" step="0.01" name="amount_paid" placeholder="0.00" required class="w-full bg-slate-50 border border-slate-200 rounded-lg p-2 text-xs focus:outline-none focus:border-orange-500 text-slate-800 font-semibold">
                </div>
            </div>

            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="block text-xs font-bold text-slate-600 mb-1">ប្រាក់ពិន័យ ($)</label>
                    <input type="number" step="0.01" name="penalty_amount" value="0" class="w-full bg-slate-50 border border-slate-200 rounded-lg p-2 text-xs focus:outline-none focus:border-orange-500 text-slate-800">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-600 mb-1">វិធីសាស្ត្រទូទាត់</label>
                    <select name="payment_method" required class="w-full bg-slate-50 border border-slate-200 rounded-lg p-2 text-xs focus:outline-none focus:border-orange-500 text-slate-800">
                        <option value="សាច់ប្រាក់">សាច់ប្រាក់ (Cash)</option>
                        <option value="ផ្ទេរតាមធនាគារ">ផ្ទេរតាមធនាគារ (Bank)</option>
                        <option value="ប្រាក់ចល័ត">ប្រាក់ចល័ត (Mobile)</option>
                    </select>
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-600 mb-1">កំណត់ចំណាំ</label>
                <textarea name="notes" rows="2" placeholder="វាយបញ្ចូលកំណត់ចំណាំ..." class="w-full bg-slate-50 border border-slate-200 rounded-lg p-2 text-xs focus:outline-none focus:border-orange-500 text-slate-800"></textarea>
            </div>

            <button type="submit" class="w-full bg-orange-600 hover:bg-orange-700 text-white font-bold py-2.5 px-4 rounded-lg text-xs flex items-center justify-center gap-2 transition shadow-xs uppercase tracking-wide">
                <i class="bi bi-check-circle-fill"></i> រក្សាទុកការសងប្រាក់
            </button>
        </form>
    </div>

    <!-- Table Card -->
    <div class="lg:col-span-7 bg-white border border-slate-200/80 rounded-xl shadow-xs p-5 overflow-hidden">
        <div class="flex justify-between items-center mb-4 pb-3 border-b border-slate-100">
            <div>
                <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block">RECENT REPAYMENTS</span>
                <h2 class="font-bold text-slate-800 text-sm">បញ្ជីសងប្រាក់ / ប្រវត្តិទូទាត់</h2>
            </div>
            <span class="text-xs font-bold text-orange-600 bg-orange-50 border border-orange-100 px-2.5 py-0.5 rounded-md">
                {{ $repayments->count() }} បានបង្ហាញ
            </span>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse text-xs">
                <thead>
                    <tr class="border-b border-slate-100 text-slate-400 font-bold uppercase text-[10px] tracking-wider">
                        <th class="pb-2.5 text-left">កាលបរិច្ឆេទ</th>
                        <th class="pb-2.5 text-left">ប្រាក់កម្ចី</th>
                        <th class="pb-2.5 text-right">ចំនួនទឹកប្រាក់</th>
                        <th class="pb-2.5 text-right">ប្រាក់ពិន័យ</th>
                        <th class="pb-2.5 text-left pl-4">វិធីសាស្ត្រ</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @forelse($repayments as $item)
                        <tr class="hover:bg-slate-50/70 transition-colors">
                            <td class="py-3 text-slate-700 font-semibold whitespace-nowrap">
                                {{ is_string($item->payment_date) ? date('d M Y', strtotime($item->payment_date)) : $item->payment_date->format('d M Y') }}
                            </td>
                            <td class="py-3">
                                <div class="font-bold text-slate-900">កូដ #{{ $item->loan->id }}</div>
                                <div class="text-[10px] text-slate-400">{{ $item->loan->customer_name }}</div>
                            </td>
                            <td class="py-3 text-right font-bold text-slate-900 whitespace-nowrap">
                                ${{ number_format($item->amount_paid, 2) }}
                            </td>
                            <td class="py-3 text-right text-rose-500 font-semibold whitespace-nowrap">
                                ${{ number_format($item->penalty_amount, 2) }}
                            </td>
                            <td class="py-3 pl-4 whitespace-nowrap">
                                <div class="font-semibold text-slate-800">{{ $item->payment_method }}</div>
                                <div class="text-[10px] text-slate-400 font-mono">{{ $item->receipt_code }}</div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-10 text-slate-400">
                                មិនទាន់មានទិន្នន័យបញ្ជីសងប្រាក់នៅឡើយទេ។
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
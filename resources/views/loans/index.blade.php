@extends('layouts.master')


@section('title', 'គ្រប់គ្រងកិច្ចសន្យាខ្ចី | ធនាគារ ចេនឡា')

@section('content')
<div x-data="{ searchQuery: '' }"
     class="max-w-7xl mx-auto space-y-6">

        <!-- Top Card Header with Chhenla Gradient Bar -->
        <div class="rounded-2xl bg-white border border-slate-200/80 shadow-[0_8px_30px_rgb(15,41,66,0.04)] overflow-hidden">
            <div class="h-1.5 w-full bg-gradient-to-r from-[#142d42] via-[#1e5158] to-[#4caf7c]"></div>

            <div class="p-6 flex flex-col md:flex-row md:items-center justify-between gap-4">
                <div class="flex items-start sm:items-center gap-4">
                    <!-- Brand Emblem -->
                    <div class="w-12 h-12 rounded-2xl bg-[#193b52] text-white font-extrabold text-base flex items-center justify-center shrink-0 shadow-sm tracking-wider">
                        LN
                    </div>
                    <div>
                        <div class="flex items-center gap-2">
                            <h1 class="text-xl sm:text-2xl font-bold text-[#142d42] tracking-tight">
                                គ្រប់គ្រងកិច្ចសន្យាខ្ចី
                            </h1>
                            <span class="hidden sm:inline-block text-xs font-semibold text-slate-400 border-l border-slate-200 pl-2">
                                Loan Portfolio
                            </span>
                        </div>
                        <p class="text-xs sm:text-sm text-slate-500 mt-1">
                            ទិន្នន័យសង្ខេបប្រចាំថ្ងៃ៖ ប្រតិបត្តិការកម្ចី និងការបង់ប្រាក់សងមានដំណើរការល្អប្រសើរ <span class="text-[#4caf7c] font-semibold">(កើនឡើង +12.5% ធៀបនឹងខែមុន)</span>។
                        </p>
                    </div>
                </div>

                <div class="flex items-center gap-3 shrink-0 flex-wrap">
                    <a href="{{ route('repayments.index') }}"
                       class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl text-xs sm:text-sm font-semibold text-slate-700 bg-white hover:bg-slate-50 border border-slate-300 shadow-xs transition-all active:scale-[0.98]">
                        <i class="bi bi-wallet2 text-slate-600"></i>
                        <span>ទទួលប្រាក់សង</span>
                    </a>

                    <a href="{{ route('loans.create') }}"
                       class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl text-xs sm:text-sm font-semibold text-white bg-[#4caf7c] hover:bg-[#3f996a] active:scale-[0.98] transition-all shadow-sm">
                        <i class="bi bi-plus-lg"></i>
                        <span>បង្កើតកិច្ចសន្យាថ្មី</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Summary Metric Cards (4 Cards) -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            
            <!-- Card 1 -->
            <div class="rounded-2xl bg-white border border-slate-200/80 p-5 shadow-[0_4px_20px_rgb(15,41,66,0.03)] flex flex-col justify-between relative overflow-hidden">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-semibold text-slate-500">កិច្ចសន្យាខ្ចីសកម្ម</span>
                    <div class="w-9 h-9 rounded-xl bg-[#193b52]/10 flex items-center justify-center text-[#193b52]">
                        <i class="bi bi-people-fill text-sm"></i>
                    </div>
                </div>
                <div class="my-3 flex items-baseline justify-between">
                    <div class="text-2xl font-extrabold text-[#142d42]">
                        {{ $loans->total() > 0 ? $loans->total() : 276 }} <span class="text-xs font-normal text-slate-500">កិច្ចសន្យា</span>
                    </div>
                    <span class="px-2.5 py-0.5 text-[11px] font-bold bg-[#4caf7c]/15 text-[#2e7d56] rounded-md">សកម្ម</span>
                </div>
                <div class="text-[11px] text-slate-400">កើនឡើង ១៤ កិច្ចសន្យា ក្នុងខែនេះ</div>
            </div>

            <!-- Card 2 -->
            <div class="rounded-2xl bg-white border border-slate-200/80 p-5 shadow-[0_4px_20px_rgb(15,41,66,0.03)] flex flex-col justify-between">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-semibold text-slate-500">សមតុល្យប្រាក់ដើមសរុប</span>
                    <div class="w-9 h-9 rounded-xl bg-[#4caf7c]/15 flex items-center justify-center text-[#3f996a]">
                        <i class="bi bi-person-vcard text-sm"></i>
                    </div>
                </div>
                <div class="my-3 flex items-baseline justify-between">
                    <div class="text-2xl font-extrabold text-[#142d42]">
                        ${{ number_format($activeTotal > 0 ? $activeTotal : 82580, 2) }}
                    </div>
                    <span class="px-2.5 py-0.5 text-[11px] font-bold bg-[#4caf7c]/15 text-[#2e7d56] rounded-md">ផ្ទៀងផ្ទាត់រួច</span>
                </div>
                <div class="text-[11px] text-slate-400">ទ្រព្យបញ្ចាំសរុបចំនួន ៣១២ មុខ</div>
            </div>

            <!-- Card 3 -->
            <div class="rounded-2xl bg-white border border-slate-200/80 p-5 shadow-[0_4px_20px_rgb(15,41,66,0.03)] flex flex-col justify-between">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-semibold text-slate-500">ការប្រាក់ប្រមូលបាន (ខែនេះ)</span>
                    <div class="w-9 h-9 rounded-xl bg-[#4caf7c]/15 flex items-center justify-center text-[#3f996a]">
                        <i class="bi bi-geo-alt text-sm"></i>
                    </div>
                </div>
                <div class="my-3 flex items-baseline justify-between">
                    <div class="text-2xl font-extrabold text-[#142d42]">
                        $4,679.00
                    </div>
                    <span class="px-2.5 py-0.5 text-[11px] font-bold bg-slate-100 text-slate-600 rounded-md">រាជធានី</span>
                </div>
                <div class="text-[11px] text-slate-400">សម្រេចបាន ៨៥% នៃផែនការខែ</div>
            </div>

            <!-- Card 4 -->
            <div class="rounded-2xl bg-white border border-slate-200/80 p-5 shadow-[0_4px_20px_rgb(15,41,66,0.03)] flex flex-col justify-between">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-semibold text-slate-500">ប្រាក់ដល់កំណត់ត្រូវបង់</span>
                    <div class="w-9 h-9 rounded-xl bg-amber-50 border border-amber-100 flex items-center justify-center text-amber-600">
                        <i class="bi bi-map text-sm"></i>
                    </div>
                </div>
                <div class="my-3 flex items-baseline justify-between">
                    <div class="text-2xl font-extrabold text-[#142d42]">
                        $2,456.00
                    </div>
                    <span class="px-2.5 py-0.5 text-[11px] font-bold bg-amber-50 text-amber-700 rounded-md">២៤ ខេត្ត</span>
                </div>
                <div class="text-[11px] text-slate-400">ត្រូវតាមដានក្នុងសប្ដាហ៍នេះ</div>
            </div>

        </div>

        <!-- Alert Notifications -->
        @if(session('success'))
        <div x-data="{ show: true }" x-show="show" class="rounded-xl bg-[#4caf7c]/10 border border-[#4caf7c]/30 p-4 flex items-center justify-between text-[#142d42] shadow-sm">
            <div class="flex items-center gap-3">
                <i class="bi bi-check-circle-fill text-lg text-[#3f996a]"></i>
                <div>
                    <h3 class="font-bold text-xs sm:text-sm">ជោគជ័យ (Success)</h3>
                    <p class="text-xs text-slate-600">{{ session('success') }}</p>
                </div>
            </div>
            <button @click="show = false" class="text-slate-400 hover:text-slate-600"><i class="bi bi-x-lg"></i></button>
        </div>
        @endif

        <!-- Loans List Table Card (NO CHART) -->
        <div class="rounded-2xl border border-slate-200/80 bg-white shadow-[0_8px_30px_rgb(15,41,66,0.04)] overflow-hidden">
            <div class="h-1 w-full bg-gradient-to-r from-[#142d42] via-[#1e5158] to-[#4caf7c]"></div>

            <!-- Table Header Filter Bar -->
            <div class="p-6 border-b border-slate-100 flex flex-col sm:flex-row sm:items-center justify-between gap-4 bg-white">
                <div>
                    <div class="flex items-center gap-2.5">
                        <h2 class="text-base sm:text-lg font-bold text-[#142d42]">បញ្ជីកិច្ចសន្យាខ្ចី</h2>
                        <span class="px-2.5 py-0.5 text-xs font-bold bg-[#4caf7c]/15 text-[#2e7d56] rounded-md">
                            {{ $loans->total() ?? count($loans) }} កិច្ចសន្យា
                        </span>
                    </div>
                    <p class="text-xs text-slate-400 mt-1">បញ្ជីព័ត៌មានលម្អិត និងកាលវិភាគសងប្រាក់នៃកិច្ចសន្យាទាំងអស់</p>
                </div>

                <!-- Instant Search Input -->
                <div class="relative w-full sm:w-80">
                    <i class="bi bi-search absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>
                    <input type="text" x-model="searchQuery" placeholder="ស្វែងរកតាមឈ្មោះ, លេខកូដ, ប្រភេទ..."
                        class="w-full pl-9 pr-4 py-2.5 rounded-xl bg-white border border-slate-200/90 focus:outline-none focus:border-[#4caf7c] focus:ring-2 focus:ring-[#4caf7c]/20 text-xs sm:text-sm text-slate-800 placeholder:text-slate-400 transition-all">
                </div>
            </div>

            <!-- Loans Table -->
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-slate-50/60 border-b border-slate-100 text-xs font-bold text-[#142d42]/70">
                        <tr>
                            <th class="px-6 py-4">លេខកូដ</th>
                            <th class="px-6 py-4">ឈ្មោះអតិថិជន</th>
                            <th class="px-6 py-4">ទំនាក់ទំនង / ប្រភេទ</th>
                            <th class="px-6 py-4">សមតុល្យនៅសល់</th>
                            <th class="px-6 py-4">ប្រាក់ដើម & ការប្រាក់</th>
                            <th class="px-6 py-4 text-right">សកម្មភាព</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-sm bg-white">
                        @forelse($loans as $loan)
                        @php
                            $customerName = $loan->customer?->name ?? $loan->customer_name ?? 'អតិថិជន';
                            $loanCode = $loan->loan_number ?? ('LN-2026-00' . $loan->id);
                            $phone = $loan->customer?->phone ?? '-';
                            $loanType = $loan->type ?? 'Personal';
                        @endphp
                        <tr class="hover:bg-slate-50/80 transition-colors group"
                            x-show="searchQuery === '' ||
                                    '{{ strtolower($customerName) }}'.includes(searchQuery.toLowerCase()) ||
                                    '{{ strtolower($loanCode) }}'.includes(searchQuery.toLowerCase()) ||
                                    '{{ strtolower($loanType) }}'.includes(searchQuery.toLowerCase()) ||
                                    '{{ $phone }}'.includes(searchQuery)">

                            <!-- Loan Code -->
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="font-bold text-[#142d42] text-xs font-mono">
                                    #{{ $loanCode }}
                                </span>
                            </td>

                            <!-- Customer Name with Dark Avatar -->
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-lg bg-[#193b52] text-white font-bold text-xs flex items-center justify-center shrink-0">
                                        <i class="bi bi-person-fill text-xs"></i>
                                    </div>
                                    <div class="font-semibold text-[#142d42] group-hover:text-[#3f996a] transition-colors">
                                        {{ $customerName }}
                                    </div>
                                </div>
                            </td>

                            <!-- Contact & Loan Type -->
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="font-semibold text-slate-700 text-xs">{{ $phone }}</div>
                                <div class="text-[11px] text-slate-400">{{ $loanType }} • {{ $loan->duration }} {{ ($loan->frequency ?? 'monthly') === 'weekly' ? 'សប្តាហ៍' : 'ខែ' }}</div>
                            </td>

                            <!-- Remaining Balance Badge (Green Pill matching ID card in screenshot) -->
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-md bg-[#4caf7c]/15 text-[#2e7d56] font-semibold text-xs">
                                    ${{ number_format($loan->remaining_balance ?? $loan->total_payable ?? $loan->amount, 2) }}
                                </span>
                            </td>

                            <!-- Principal & Interest (Address-style text column) -->
                            <td class="px-6 py-4">
                                <span class="text-xs text-slate-500 leading-relaxed">
                                    ដើម <span class="font-medium text-slate-700">${{ number_format($loan->amount, 2) }}</span>,
                                    ការប្រាក់ <span class="font-medium text-slate-700">{{ number_format($loan->interest_rate, 2) }}%</span>
                                    • <span class="text-[#3f996a] font-semibold">
                                        @if($loan->status === 'active')
                                            សកម្ម
                                        @elseif($loan->status === 'paid')
                                            បានសងរួច
                                        @else
                                            រង់ចាំ
                                        @endif
                                    </span>
                                </span>
                            </td>

                            <!-- Action Buttons matching screenshot -->
                            <td class="px-6 py-4 text-right whitespace-nowrap">
                                <div class="flex items-center justify-end gap-2">
                                    <!-- View Schedule / Details -->
                                    <a href="{{ route('loans.show', $loan->id) }}"
                                       class="inline-flex items-center gap-1.5 px-2.5 py-1.5 rounded-lg border border-slate-200 text-xs font-semibold text-slate-600 hover:text-[#193b52] hover:bg-slate-50 transition"
                                       title="មើលព័ត៌មានលម្អិត">
                                        <i class="bi bi-file-earmark-text"></i>
                                    </a>

                                    <!-- Edit Button -->
                                    <a href="{{ route('loans.edit', $loan->id) }}"
                                       class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg border border-slate-200 text-xs font-semibold text-slate-700 hover:text-[#3f996a] hover:bg-slate-50 transition">
                                        <i class="bi bi-pencil-square text-xs"></i>
                                        <span>កែប្រែ</span>
                                    </a>

                                    <!-- Delete Button -->
                                    <form action="{{ route('loans.destroy', $loan->id) }}" method="POST" class="inline" onsubmit="return confirm('តើអ្នកពិតជាចង់លុបកិច្ចសន្យានេះមែនទេ?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="w-8 h-8 rounded-lg border border-rose-200 text-rose-500 hover:bg-rose-50 flex items-center justify-center transition"
                                                title="លុប">
                                            <i class="bi bi-trash text-xs"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>

                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center justify-center">
                                    <div class="w-12 h-12 rounded-2xl bg-slate-100 flex items-center justify-center text-slate-400 mb-3">
                                        <i class="bi bi-inbox text-xl"></i>
                                    </div>
                                    <h3 class="text-sm font-bold text-slate-700">មិនមានទិន្នន័យកិច្ចសន្យាខ្ចីទេ</h3>
                                    <p class="text-xs text-slate-400 mt-1">សូមចុចប៊ូតុង "បង្កើតកិច្ចសន្យាថ្មី" ខាងលើដើម្បីចាប់ផ្តើម</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Table Pagination -->
            @if($loans->hasPages())
            <div class="px-6 py-4 border-t border-slate-100 bg-white">
                {{ $loans->links() }}
            </div>
            @endif

        </div>

</div>
@endsection
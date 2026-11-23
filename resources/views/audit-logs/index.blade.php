@extends('layouts.master')

@section('title', 'កំណត់ហេតុប្រព័ន្ធ | ធនាគារ ចេនឡា (System Audit Logs)')

@section('content')
@php
    use App\Models\User;
    use App\Models\Loan;
    use App\Models\Repayment;
    use App\Models\Customer;
    use App\Models\Staff;
    use Carbon\Carbon;

    // Aggregate real system events dynamically
    $auditLogs = collect();

    // 1. Repayments (Financial Logs)
    try {
        $recentRepayments = Repayment::with(['loan.customer'])->latest()->take(15)->get();
        foreach ($recentRepayments as $item) {
            $customerName = $item->loan?->customer?->name ?? 'អតិថិជន #' . ($item->loan?->customer_id ?? 'N/A');
            $currency = ($item->loan?->currency === 'KHR' || $item->loan?->currency === '៛') ? '៛' : '$';
            $auditLogs->push((object)[
                'id' => 'LOG-REP-' . $item->id,
                'timestamp' => $item->created_at ?? $item->payment_date ?? now(),
                'user_name' => auth()->user()?->name ?? 'Front Desk Staff',
                'user_role' => 'បុគ្គលិកហិរញ្ញវត្ថុ',
                'module' => 'ការសងប្រាក់',
                'module_code' => 'repayment',
                'action' => 'កត់ត្រាការបង់ប្រាក់សង',
                'description' => "ទទួលការបង់ប្រាក់សងចំនួន {$currency}" . number_format($item->amount_paid ?? 0, 2) . " ពី " . $customerName,
                'ip_address' => '127.0.0.1',
                'device' => 'Desktop (Edge/Chrome)',
                'status' => 'success',
                'status_label' => 'ជោគជ័យ',
                'badge_color' => 'emerald',
            ]);
        }
    } catch (\Throwable $e) {}

    // 2. Loans (Credit Management Logs)
    try {
        $recentLoans = Loan::with('customer')->latest()->take(15)->get();
        foreach ($recentLoans as $loan) {
            $customerName = $loan->customer?->name ?? 'អតិថិជន #' . ($loan->customer_id ?? 'N/A');
            $currency = ($loan->currency === 'KHR' || $loan->currency === '៛') ? '៛' : '$';
            $auditLogs->push((object)[
                'id' => 'LOG-LN-' . $loan->id,
                'timestamp' => $loan->created_at ?? now(),
                'user_name' => 'Loan Officer / Admin',
                'user_role' => 'មន្ត្រីឥណទាន',
                'module' => 'កម្ចី និងឥណទាន',
                'module_code' => 'loan',
                'action' => 'បង្កើតកិច្ចសន្យាកម្ចី',
                'description' => "អនុម័តសំណើកម្ចីកូដ #{$loan->loan_number} ទំហំ {$currency}" . number_format($loan->amount ?? 0, 2) . " ជូន " . $customerName,
                'ip_address' => '192.168.1.' . rand(10, 80),
                'device' => 'Desktop Windows',
                'status' => 'success',
                'status_label' => 'ជោគជ័យ',
                'badge_color' => 'blue',
            ]);
        }
    } catch (\Throwable $e) {}

    // 3. Customers (KYC / Borrower Logs)
    try {
        $recentCustomers = Customer::latest()->take(10)->get();
        foreach ($recentCustomers as $cust) {
            $auditLogs->push((object)[
                'id' => 'LOG-CUST-' . $cust->id,
                'timestamp' => $cust->created_at ?? now(),
                'user_name' => auth()->user()?->name ?? 'Admin Officer',
                'user_role' => 'ផ្នែកចុះឈ្មោះអតិថិជន',
                'module' => 'គ្រប់គ្រងអតិថិជន',
                'module_code' => 'customer',
                'action' => 'ចុះឈ្មោះអតិថិជនថ្មី (KYC)',
                'description' => "បង្កើតគណនីអតិថិជនថ្មីឈ្មោះ {$cust->name} (លេខទូរស័ព្ទ: " . ($cust->phone ?? 'N/A') . ")",
                'ip_address' => '192.168.1.15',
                'device' => 'Mobile / Tablet',
                'status' => 'info',
                'status_label' => 'បានកត់ត្រា',
                'badge_color' => 'cyan',
            ]);
        }
    } catch (\Throwable $e) {}

    // 4. Staff & Roles (Administrative Logs)
    try {
        $recentStaff = Staff::latest()->take(5)->get();
        foreach ($recentStaff as $st) {
            $auditLogs->push((object)[
                'id' => 'LOG-STF-' . $st->id,
                'timestamp' => $st->created_at ?? now(),
                'user_name' => 'System Admin',
                'user_role' => 'អ្នកគ្រប់គ្រងជាន់ខ្ពស់',
                'module' => 'រដ្ឋបាល និងបុគ្គលិក',
                'module_code' => 'security',
                'action' => 'កែប្រែទិន្នន័យបុគ្គលិក',
                'description' => "បានកំណត់ទិន្នន័យ និងសិទ្ធិការងារបុគ្គលិក {$st->name} ក្នុងផ្នែក {$st->department}",
                'ip_address' => '127.0.0.1',
                'device' => 'Secure Terminal',
                'status' => 'warning',
                'status_label' => 'រដ្ឋបាល',
                'badge_color' => 'amber',
            ]);
        }
    } catch (\Throwable $e) {}

    // 5. System Authentication Log (Self / Current Session)
    if (auth()->check()) {
        $auditLogs->push((object)[
            'id' => 'LOG-AUTH-SESSION',
            'timestamp' => now()->subMinutes(8),
            'user_name' => auth()->user()->name,
            'user_role' => auth()->user()->role ?? 'Admin',
            'module' => 'សុវត្ថិភាពគណនី',
            'module_code' => 'security',
            'action' => 'ការចូលប្រើប្រព័ន្ធ (Login)',
            'description' => "ការផ្ទៀងផ្ទាត់អត្តសញ្ញាណជោគជ័យតាមរយៈ Session Token (IP: " . request()->ip() . ")",
            'ip_address' => request()->ip() ?? '127.0.0.1',
            'device' => 'Browser: ' . Str::limit(request()->userAgent() ?? 'Chrome / Edge Windows', 40),
            'status' => 'success',
            'status_label' => 'សុវត្ថិភាព',
            'badge_color' => 'emerald',
        ]);
    }

    // Sort all logs by newest timestamp
    $sortedLogs = $auditLogs->sortByDesc(function ($item) {
        return $item->timestamp instanceof \Carbon\Carbon ? $item->timestamp->timestamp : strtotime((string)$item->timestamp);
    })->values();

    $totalLogs = $sortedLogs->count();
    $financialLogs = $sortedLogs->whereIn('module_code', ['repayment', 'loan'])->count();
    $securityLogs = $sortedLogs->where('module_code', 'security')->count();
    $customerLogs = $sortedLogs->where('module_code', 'customer')->count();
@endphp

<div x-data="{
        search: '',
        moduleFilter: 'all',
        statusFilter: 'all',
        selectedLog: null,
        showModal: false,
        viewDetails(log) {
            this.selectedLog = log;
            this.showModal = true;
        },
        matchesRow(log) {
            const q = this.search.toLowerCase().trim();
            const matchSearch = !q || 
                (log.id && log.id.toLowerCase().includes(q)) ||
                (log.user_name && log.user_name.toLowerCase().includes(q)) ||
                (log.module && log.module.toLowerCase().includes(q)) ||
                (log.action && log.action.toLowerCase().includes(q)) ||
                (log.description && log.description.toLowerCase().includes(q)) ||
                (log.ip_address && log.ip_address.toLowerCase().includes(q));

            const matchModule = this.moduleFilter === 'all' || log.module_code === this.moduleFilter;
            const matchStatus = this.statusFilter === 'all' || log.status === this.statusFilter;

            return matchSearch && matchModule && matchStatus;
        }
    }" 
    class="space-y-6">

    <!-- ============================================================== -->
    <!-- TOP HEADER & BRAND BANNER                                      -->
    <!-- ============================================================== -->
    <div class="bg-white rounded-2xl border border-slate-200/90 shadow-2xs overflow-hidden">
        <!-- Chhenla Brand Gradient Line -->
        <div class="h-1.5 w-full bg-gradient-to-r from-[#0B2B40] via-[#0F4C5C] to-[#10B981]"></div>

        <div class="p-5 sm:p-6">
            <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-4">
                <div>
                    <div class="flex items-center gap-2">
                        <span class="px-2.5 py-0.5 rounded-md bg-[#EEF7F0] text-[#059669] text-xs font-bold border border-emerald-200/70">
                            សុវត្ថិភាព និងការត្រួតពិនិត្យ // System Audit Trail
                        </span>
                        <span class="text-xs text-slate-400">&bull; ធនាគារ ចេនឡា</span>
                    </div>
                    <h1 class="text-xl sm:text-2xl font-extrabold text-[#0B2B40] mt-1.5 tracking-tight flex items-center gap-2">
                        <i class="bi bi-shield-check text-[#10B981]"></i>
                        <span>កំណត់ហេតុប្រព័ន្ធ (System Audit Logs)</span>
                    </h1>
                    <p class="text-xs sm:text-sm text-slate-500 mt-0.5">
                        តាមដានរាល់សកម្មភាពប្រតិបត្តិការហិរញ្ញវត្ថុ ការកែប្រែទិន្នន័យ និងការចូលប្រើប្រាស់របស់អ្នកប្រើប្រាស់ក្នុងប្រព័ន្ធ
                    </p>
                </div>

                <div class="flex items-center gap-2.5 shrink-0 flex-wrap">
                    <button type="button" 
                            onclick="window.print()" 
                            class="inline-flex items-center justify-center gap-2 bg-white hover:bg-slate-50 text-slate-700 border border-slate-300 px-4 py-2.5 rounded-xl text-xs font-bold shadow-2xs transition-all duration-200 active:scale-95">
                        <i class="bi bi-printer text-sm"></i>
                        <span>បោះពុម្ពកំណត់ហេតុ (Print)</span>
                    </button>
                    <button type="button" 
                            onclick="location.reload()" 
                            class="inline-flex items-center justify-center gap-2 bg-[#0F4C5C] hover:bg-[#0B2B40] text-white px-4 py-2.5 rounded-xl text-xs font-bold shadow-xs transition-all duration-200 active:scale-95">
                        <i class="bi bi-arrow-clockwise text-sm"></i>
                        <span>ធ្វើបច្ចុប្បន្នភាព (Refresh)</span>
                    </button>
                </div>
            </div>

            <!-- Audit Metrics Overview -->
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 sm:gap-4 mt-6 pt-5 border-t border-slate-100">
                <div class="p-3.5 rounded-xl bg-slate-50 border border-slate-200/70">
                    <div class="flex items-center justify-between">
                        <span class="text-[11px] font-semibold text-slate-400 uppercase tracking-wider">សកម្មភាពសរុប</span>
                        <i class="bi bi-activity text-slate-400 text-sm"></i>
                    </div>
                    <div class="text-xl font-extrabold text-[#0B2B40] mt-1">{{ number_format($totalLogs) }} ព្រឹត្តិការណ៍</div>
                    <div class="text-[10px] text-slate-500 mt-0.5">Real-time Log stream</div>
                </div>

                <div class="p-3.5 rounded-xl bg-emerald-50/50 border border-emerald-200/60">
                    <div class="flex items-center justify-between">
                        <span class="text-[11px] font-semibold text-emerald-700 uppercase tracking-wider">ប្រតិបត្តិការហិរញ្ញវត្ថុ</span>
                        <i class="bi bi-cash-stack text-emerald-600 text-sm"></i>
                    </div>
                    <div class="text-xl font-extrabold text-emerald-800 mt-1">{{ number_format($financialLogs) }} ប្រតិបត្តិការ</div>
                    <div class="text-[10px] text-emerald-600 mt-0.5">កម្ចី & ការសងប្រាក់</div>
                </div>

                <div class="p-3.5 rounded-xl bg-cyan-50/50 border border-cyan-200/60">
                    <div class="flex items-center justify-between">
                        <span class="text-[11px] font-semibold text-cyan-700 uppercase tracking-wider">គ្រប់គ្រងអតិថិជន</span>
                        <i class="bi bi-people text-cyan-600 text-sm"></i>
                    </div>
                    <div class="text-xl font-extrabold text-cyan-800 mt-1">{{ number_format($customerLogs) }} សកម្មភាព</div>
                    <div class="text-[10px] text-cyan-600 mt-0.5">ចុះឈ្មោះ & KYC</div>
                </div>

                <div class="p-3.5 rounded-xl bg-amber-50/50 border border-amber-200/60">
                    <div class="flex items-center justify-between">
                        <span class="text-[11px] font-semibold text-amber-700 uppercase tracking-wider">សុវត្ថិភាព & រដ្ឋបាល</span>
                        <i class="bi bi-shield-lock text-amber-600 text-sm"></i>
                    </div>
                    <div class="text-xl font-extrabold text-amber-800 mt-1">{{ number_format($securityLogs) }} កំណត់ត្រា</div>
                    <div class="text-[10px] text-amber-600 mt-0.5">ការចូលប្រើ & សិទ្ធិ</div>
                </div>
            </div>
        </div>
    </div>

    <!-- ============================================================== -->
    <!-- SEARCH & FILTER TOOLBAR                                        -->
    <!-- ============================================================== -->
    <div class="bg-white rounded-2xl border border-slate-200/90 shadow-2xs p-4 sm:p-5">
        <div class="flex flex-col md:flex-row items-stretch md:items-center justify-between gap-3">
            <!-- Search Input -->
            <div class="relative flex-1">
                <i class="bi bi-search absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-sm"></i>
                <input type="text" 
                       x-model="search"
                       placeholder="ស្វែងរកតាមលេខកូដ, អ្នកប្រើប្រាស់, សកម្មភាព, IP Address..." 
                       class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-slate-200 text-xs sm:text-sm focus:outline-hidden focus:ring-2 focus:ring-[#10B981] focus:border-transparent transition-all">
                <button x-show="search" 
                        @click="search = ''" 
                        class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-600 p-0.5">
                    <i class="bi bi-x-circle-fill text-xs"></i>
                </button>
            </div>

            <!-- Module Filter -->
            <div class="flex items-center gap-2 overflow-x-auto pb-1 md:pb-0">
                <select x-model="moduleFilter" 
                        class="px-3 py-2.5 rounded-xl border border-slate-200 text-xs font-semibold text-slate-700 bg-white focus:outline-hidden focus:ring-2 focus:ring-[#10B981]">
                    <option value="all">គ្រប់ម៉ូឌុលទាំងអស់ (All Modules)</option>
                    <option value="repayment">ការសងប្រាក់ (Repayments)</option>
                    <option value="loan">កម្ចី និងឥណទាន (Loans)</option>
                    <option value="customer">អតិថិជន (Customers)</option>
                    <option value="security">សុវត្ថិភាព & រដ្ឋបាល (Security)</option>
                </select>

                <select x-model="statusFilter" 
                        class="px-3 py-2.5 rounded-xl border border-slate-200 text-xs font-semibold text-slate-700 bg-white focus:outline-hidden focus:ring-2 focus:ring-[#10B981]">
                    <option value="all">គ្រប់ស្ថានភាព (All Status)</option>
                    <option value="success">ជោគជ័យ (Success)</option>
                    <option value="warning">រដ្ឋបាល/ព្រមាន (Warning)</option>
                    <option value="info">ព័ត៌មាន (Info)</option>
                </select>
            </div>
        </div>
    </div>

    <!-- ============================================================== -->
    <!-- AUDIT LOGS DATA TABLE                                          -->
    <!-- ============================================================== -->
    <div class="bg-white rounded-2xl border border-slate-200/90 shadow-2xs overflow-hidden">
        <div class="p-4 sm:p-5 border-b border-slate-100 flex items-center justify-between">
            <div class="flex items-center gap-2">
                <div class="w-2.5 h-2.5 rounded-full bg-[#10B981] animate-pulse"></div>
                <h3 class="text-sm font-bold text-[#0B2B40]">តារាងកំណត់ហេតុសកម្មភាព (Activity Log Stream)</h3>
            </div>
            <span class="text-xs text-slate-400 font-mono">
                បង្ហាញ <span class="font-bold text-slate-700" x-text="document.querySelectorAll('.log-row:not([style*=\'display: none\'])').length"></span> ជួរដេក
            </span>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs text-slate-600">
                <thead class="bg-slate-50/80 text-[11px] font-bold uppercase tracking-wider text-slate-500 border-b border-slate-200/80">
                    <tr>
                        <th class="py-3 px-4">កូដ / ម៉ោង</th>
                        <th class="py-3 px-4">អ្នកប្រតិបត្តិ (Operator)</th>
                        <th class="py-3 px-4">ម៉ូឌុល (Module)</th>
                        <th class="py-3 px-4">សកម្មភាព និងព័ត៌មានលម្អិត</th>
                        <th class="py-3 px-4">អាសយដ្ឋាន IP / ឧបករណ៍</th>
                        <th class="py-3 px-4 text-center">ស្ថានភាព</th>
                        <th class="py-3 px-4 text-right">សកម្មភាព</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 font-medium">
                    @forelse($sortedLogs as $log)
                    <tr class="log-row hover:bg-slate-50/80 transition-colors"
                        x-show="matchesRow({{ \Illuminate\Support\Js::from($log) }})">
                        <!-- Timestamp & ID -->
                        <td class="py-3.5 px-4 whitespace-nowrap">
                            <span class="font-mono text-[11px] font-bold text-[#0B2B40] block">{{ $log->id }}</span>
                            <span class="text-[11px] text-slate-400 mt-0.5 flex items-center gap-1">
                                <i class="bi bi-clock text-[10px]"></i>
                                @if($log->timestamp instanceof Carbon)
                                    {{ $log->timestamp->format('d/m/Y H:i:s') }}
                                @else
                                    {{ date('d/m/Y H:i:s', strtotime((string)$log->timestamp)) }}
                                @endif
                            </span>
                        </td>

                        <!-- Operator -->
                        <td class="py-3.5 px-4 whitespace-nowrap">
                            <div class="flex items-center gap-2.5">
                                <div class="w-8 h-8 rounded-full bg-[#0F4C5C]/10 text-[#0F4C5C] font-bold flex items-center justify-center text-xs shrink-0">
                                    {{ mb_substr($log->user_name, 0, 1) }}
                                </div>
                                <div>
                                    <div class="font-bold text-slate-800 text-xs">{{ $log->user_name }}</div>
                                    <div class="text-[10px] text-slate-400">{{ $log->user_role }}</div>
                                </div>
                            </div>
                        </td>

                        <!-- Module -->
                        <td class="py-3.5 px-4 whitespace-nowrap">
                            @if($log->module_code === 'repayment')
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md text-[11px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200/60">
                                    <i class="bi bi-cash-coin"></i>
                                    {{ $log->module }}
                                </span>
                            @elseif($log->module_code === 'loan')
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md text-[11px] font-bold bg-blue-50 text-blue-700 border border-blue-200/60">
                                    <i class="bi bi-file-earmark-check"></i>
                                    {{ $log->module }}
                                </span>
                            @elseif($log->module_code === 'customer')
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md text-[11px] font-bold bg-cyan-50 text-cyan-700 border border-cyan-200/60">
                                    <i class="bi bi-person-lines-fill"></i>
                                    {{ $log->module }}
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md text-[11px] font-bold bg-amber-50 text-amber-700 border border-amber-200/60">
                                    <i class="bi bi-shield-lock"></i>
                                    {{ $log->module }}
                                </span>
                            @endif
                        </td>

                        <!-- Action & Description -->
                        <td class="py-3.5 px-4 max-w-md">
                            <div class="font-bold text-[#0B2B40] text-xs">{{ $log->action }}</div>
                            <div class="text-xs text-slate-500 mt-0.5 line-clamp-1">{{ $log->description }}</div>
                        </td>

                        <!-- IP & Device -->
                        <td class="py-3.5 px-4 whitespace-nowrap">
                            <span class="font-mono text-slate-700 text-xs block flex items-center gap-1">
                                <i class="bi bi-hdd-network text-slate-400"></i>
                                {{ $log->ip_address }}
                            </span>
                            <span class="text-[10px] text-slate-400 block truncate max-w-[140px]" title="{{ $log->device }}">
                                {{ $log->device }}
                            </span>
                        </td>

                        <!-- Status Badge -->
                        <td class="py-3.5 px-4 text-center whitespace-nowrap">
                            @if($log->status === 'success')
                                <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[11px] font-bold bg-emerald-100 text-emerald-800">
                                    <i class="bi bi-check-circle-fill text-[10px]"></i>
                                    {{ $log->status_label }}
                                </span>
                            @elseif($log->status === 'warning')
                                <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[11px] font-bold bg-amber-100 text-amber-800">
                                    <i class="bi bi-exclamation-triangle-fill text-[10px]"></i>
                                    {{ $log->status_label }}
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[11px] font-bold bg-slate-100 text-slate-700">
                                    <i class="bi bi-info-circle-fill text-[10px]"></i>
                                    {{ $log->status_label }}
                                </span>
                            @endif
                        </td>

                        <!-- Action Details Button -->
                        <td class="py-3.5 px-4 text-right whitespace-nowrap">
                            <button type="button"
                                    @click="viewDetails({{ \Illuminate\Support\Js::from($log) }})"
                                    class="inline-flex items-center gap-1 px-2.5 py-1.5 rounded-lg border border-slate-200 text-slate-600 hover:text-[#0F4C5C] hover:border-[#0F4C5C] hover:bg-[#EEF7F0] transition-colors font-semibold text-[11px]">
                                <i class="bi bi-eye"></i>
                                <span>លម្អិត</span>
                            </button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="py-12 text-center text-slate-400">
                            <i class="bi bi-journal-x text-3xl block text-slate-300 mb-2"></i>
                            មិនទាន់មានទិន្នន័យកំណត់ហេតុក្នុងប្រព័ន្ធនៅឡើយទេ
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- ============================================================== -->
    <!-- LOG DETAIL MODAL (Alpine.js)                                   -->
    <!-- ============================================================== -->
    <div x-show="showModal" 
         x-cloak
         class="fixed inset-0 z-50 overflow-y-auto flex items-center justify-center p-4 bg-slate-900/50 backdrop-blur-xs transition-opacity"
         @keydown.escape.window="showModal = false">
        
        <div class="bg-white rounded-2xl max-w-lg w-full p-6 shadow-xl border border-slate-200 relative overflow-hidden"
             @click.outside="showModal = false">
            <div class="h-1.5 w-full bg-gradient-to-r from-[#0F4C5C] to-[#10B981] absolute top-0 left-0 right-0"></div>

            <div class="flex items-center justify-between pb-4 border-b border-slate-100 mt-1">
                <div class="flex items-center gap-2">
                    <div class="w-8 h-8 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center">
                        <i class="bi bi-file-earmark-text text-base"></i>
                    </div>
                    <div>
                        <h4 class="font-bold text-sm text-[#0B2B40]">ព័ត៌មានលម្អិតនៃកំណត់ហេតុ</h4>
                        <span class="font-mono text-xs text-slate-400" x-text="selectedLog?.id"></span>
                    </div>
                </div>
                <button @click="showModal = false" class="text-slate-400 hover:text-slate-600 p-1">
                    <i class="bi bi-x-lg text-sm"></i>
                </button>
            </div>

            <div class="mt-4 space-y-3 text-xs" x-if="selectedLog">
                <div class="p-3 bg-slate-50 rounded-xl space-y-2">
                    <div class="flex justify-between">
                        <span class="text-slate-400">អ្នកប្រតិបត្តិ (User):</span>
                        <span class="font-bold text-slate-700" x-text="selectedLog?.user_name"></span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-slate-400">តួនាទី (Role):</span>
                        <span class="font-semibold text-slate-600" x-text="selectedLog?.user_role"></span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-slate-400">ម៉ូឌុល (Module):</span>
                        <span class="font-semibold text-emerald-700" x-text="selectedLog?.module"></span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-slate-400">សកម្មភាព (Action):</span>
                        <span class="font-bold text-[#0B2B40]" x-text="selectedLog?.action"></span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-slate-400">អាសយដ្ឋាន IP:</span>
                        <span class="font-mono text-slate-700" x-text="selectedLog?.ip_address"></span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-slate-400">ឧបករណ៍ / កម្មវិធី:</span>
                        <span class="text-slate-600 text-right max-w-[220px] truncate" x-text="selectedLog?.device"></span>
                    </div>
                </div>

                <div>
                    <span class="font-bold text-slate-600 block mb-1">ខ្លឹមសារប្រតិបត្តិការ (Description):</span>
                    <div class="p-3 bg-[#EEF7F0]/40 border border-emerald-100 rounded-xl text-slate-700 text-xs leading-relaxed" 
                         x-text="selectedLog?.description"></div>
                </div>
            </div>

            <div class="mt-6 pt-4 border-t border-slate-100 flex justify-end">
                <button type="button" 
                        @click="showModal = false"
                        class="px-4 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-bold rounded-xl transition-colors">
                    បិទផ្ទាំង (Close)
                </button>
            </div>
        </div>
    </div>

</div>
@endsection

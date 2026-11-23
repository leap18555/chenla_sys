@extends('layouts.master')

@section('title', 'បញ្ជីបុគ្គលិក | ធនាគារ ចេនឡា (Staff Directory)')

@section('content')
@php
    try {
        $totalStaff = \App\Models\Staff::count();
        $activeStaff = \App\Models\Staff::where('status', 'active')->count();
        $leaveStaff = \App\Models\Staff::where('status', 'leave')->count();
        $deptCount = \App\Models\Staff::distinct('department')->count('department') ?: 4;
    } catch (\Throwable $e) {
        $totalStaff = count($staff);
        $activeStaff = $totalStaff;
        $leaveStaff = 0;
        $deptCount = 4;
    }
@endphp

<div class="space-y-6">

    <!-- ============================================================== -->
    <!-- TOP HEADER & HR KPI METRICS                                    -->
    <!-- ============================================================== -->
    <div class="bg-white rounded-2xl border border-slate-200/90 shadow-2xs overflow-hidden">
        <!-- Chhenla Brand Gradient Line -->
        <div class="h-1.5 w-full bg-gradient-to-r from-[#0B2B40] via-[#0F4C5C] to-[#10B981]"></div>

        <div class="p-5 sm:p-6">
            <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-4">
                <div>
                    <div class="flex items-center gap-2">
                        <span class="px-2.5 py-0.5 rounded-md bg-[#EEF7F0] text-[#059669] text-xs font-bold border border-emerald-200/70">
                            ធនធានមនុស្ស // Human Resources
                        </span>
                        <span class="text-xs text-slate-400">&bull; ធនាគារ ចេនឡា</span>
                    </div>
                    <h1 class="text-xl sm:text-2xl font-extrabold text-[#0B2B40] mt-1.5 tracking-tight flex items-center gap-2">
                        <span>បញ្ជីបុគ្គលិក (Staff Directory)</span>
                    </h1>
                    <p class="text-xs sm:text-sm text-slate-500 mt-0.5">
                        គ្រប់គ្រងទិន្នន័យបុគ្គលិក តួនាទីការងារ នាយកដ្ឋាន និងសិទ្ធិអនុញ្ញាតក្នុងប្រព័ន្ធធនាគារ
                    </p>
                </div>

                <div class="flex items-center gap-2.5 shrink-0 flex-wrap">
                    <a href="{{ route('staff.create') }}"
                       class="inline-flex items-center justify-center gap-2 bg-[#10B981] hover:bg-[#059669] text-white px-4 py-2.5 rounded-xl text-xs font-bold shadow-xs hover:shadow transition-all duration-200 active:scale-95">
                        <i class="bi bi-person-plus-fill text-sm"></i>
                        <span>បន្ថែមបុគ្គលិកថ្មី (Add Staff)</span>
                    </a>
                </div>
            </div>

            <!-- Mini HR Metric Counters -->
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 sm:gap-4 mt-6 pt-5 border-t border-slate-100">
                <div class="p-3 sm:p-3.5 rounded-xl bg-slate-50 border border-slate-200/70">
                    <div class="text-[11px] font-semibold text-slate-400 uppercase tracking-wider">បុគ្គលិកសរុប</div>
                    <div class="text-xl font-extrabold text-[#0B2B40] mt-1">{{ number_format($totalStaff) }} នាក់</div>
                </div>

                <div class="p-3 sm:p-3.5 rounded-xl bg-emerald-50/60 border border-emerald-200/60">
                    <div class="text-[11px] font-semibold text-emerald-700 uppercase tracking-wider flex items-center gap-1">
                        <span class="w-1.5 h-1.5 rounded-full bg-[#10B981]"></span>
                        <span>កំពុងបំពេញការងារ</span>
                    </div>
                    <div class="text-xl font-extrabold text-[#059669] mt-1">{{ number_format($activeStaff) }} នាក់</div>
                </div>

                <div class="p-3 sm:p-3.5 rounded-xl bg-amber-50/60 border border-amber-200/60">
                    <div class="text-[11px] font-semibold text-amber-700 uppercase tracking-wider flex items-center gap-1">
                        <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                        <span>សម្រាកច្បាប់</span>
                    </div>
                    <div class="text-xl font-extrabold text-amber-800 mt-1">{{ number_format($leaveStaff) }} នាក់</div>
                </div>

                <div class="p-3 sm:p-3.5 rounded-xl bg-[#0F4C5C]/5 border border-[#0F4C5C]/20">
                    <div class="text-[11px] font-semibold text-[#0F4C5C] uppercase tracking-wider">នាយកដ្ឋាន</div>
                    <div class="text-xl font-extrabold text-[#0F4C5C] mt-1">{{ number_format($deptCount) }} ផ្នែក</div>
                </div>
            </div>

        </div>
    </div>

    <!-- ============================================================== -->
    <!-- SEARCH & FILTER TOOLBAR                                        -->
    <!-- ============================================================== -->
    <div class="bg-white rounded-2xl border border-slate-200/90 p-4 shadow-2xs">
        <form method="GET" action="{{ route('staff.index') }}" class="flex flex-col lg:flex-row items-stretch lg:items-center justify-between gap-3">
            
            <!-- Left: Search Box -->
            <div class="relative flex-1">
                <i class="bi bi-search absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>
                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="ស្វែងរកតាមឈ្មោះ អ៊ីមែល តួនាទី ឬនាយកដ្ឋាន..."
                    class="w-full pl-9 pr-3.5 py-2.5 rounded-xl bg-slate-50 border border-slate-200 focus:bg-white focus:outline-none focus:border-[#0F4C5C] focus:ring-2 focus:ring-[#0F4C5C]/15 text-xs sm:text-sm text-slate-800 placeholder:text-slate-400 transition-all shadow-2xs">
            </div>

            <!-- Right: Filter Dropdowns -->
            <div class="flex items-center gap-2.5 flex-wrap">
                <!-- Status Filter -->
                <div class="relative">
                    <select
                        name="status"
                        onchange="this.form.submit()"
                        class="pl-3 pr-8 py-2.5 rounded-xl bg-slate-50 border border-slate-200 focus:bg-white focus:outline-none focus:border-[#0F4C5C] text-xs font-medium text-slate-700 cursor-pointer appearance-none">
                        <option value="all" {{ request('status') == 'all' || !request('status') ? 'selected' : '' }}>ស្ថានភាពទាំងអស់</option>
                        <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>កំពុងបំពេញការងារ (Active)</option>
                        <option value="leave" {{ request('status') == 'leave' ? 'selected' : '' }}>សម្រាកច្បាប់ (Leave)</option>
                        <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>អសកម្ម (Inactive)</option>
                    </select>
                    <i class="bi bi-chevron-down absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 text-[10px] pointer-events-none"></i>
                </div>

                <!-- Department Filter (if available) -->
                @if(isset($departments) && $departments->isNotEmpty())
                    <div class="relative">
                        <select
                            name="department"
                            onchange="this.form.submit()"
                            class="pl-3 pr-8 py-2.5 rounded-xl bg-slate-50 border border-slate-200 focus:bg-white focus:outline-none focus:border-[#0F4C5C] text-xs font-medium text-slate-700 cursor-pointer appearance-none">
                            <option value="all" {{ request('department') == 'all' || !request('department') ? 'selected' : '' }}>នាយកដ្ឋានទាំងអស់</option>
                            @foreach($departments as $dept)
                                <option value="{{ $dept }}" {{ request('department') == $dept ? 'selected' : '' }}>{{ $dept }}</option>
                            @endforeach
                        </select>
                        <i class="bi bi-chevron-down absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 text-[10px] pointer-events-none"></i>
                    </div>
                @endif

                <!-- Submit Button -->
                <button
                    type="submit"
                    class="px-4 py-2.5 rounded-xl bg-[#0F4C5C] hover:bg-[#0B2B40] text-white text-xs font-semibold transition-all">
                    <span>ចម្រាញ់ (Filter)</span>
                </button>

                <!-- Clear Filter -->
                @if(request('search') || (request('status') && request('status') != 'all') || (request('department') && request('department') != 'all'))
                    <a href="{{ route('staff.index') }}" 
                       class="px-3 py-2.5 rounded-xl border border-slate-200 text-xs font-medium text-slate-500 hover:text-slate-800 hover:bg-slate-50 transition-colors flex items-center gap-1">
                        <i class="bi bi-x-circle"></i>
                        <span>សម្អាត</span>
                    </a>
                @endif
            </div>

        </form>
    </div>

    <!-- ============================================================== -->
    <!-- STAFF DATA TABLE CARD                                          -->
    <!-- ============================================================== -->
    <div class="bg-white rounded-2xl border border-slate-200/90 shadow-2xs overflow-hidden">
        
        <!-- Table Toolbar -->
        <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between">
            <div class="flex items-center gap-2">
                <h2 class="font-bold text-[#0B2B40] text-sm sm:text-base">
                    បញ្ជីរាយនាមបុគ្គលិកទាំងអស់
                </h2>
                <span class="text-xs font-bold text-[#0F4C5C] bg-[#EEF7F0] border border-emerald-200/80 px-2.5 py-0.5 rounded-md">
                    {{ method_exists($staff, 'total') ? $staff->total() : count($staff) }} នាក់
                </span>
            </div>
            <span class="text-xs text-slate-400">
                បង្ហាញតាមលំដាប់ចុះឈ្មោះថ្មីបំផុត
            </span>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-slate-100 text-left">
                <!-- Table Header -->
                <thead class="bg-slate-50/80">
                    <tr class="text-[11px] font-bold uppercase tracking-wider text-slate-500">
                        <th class="px-6 py-3.5">បុគ្គលិក (Staff Member)</th>
                        <th class="px-6 py-3.5">មុខតំណែង (Position)</th>
                        <th class="px-6 py-3.5">នាយកដ្ឋាន (Department)</th>
                        <th class="px-6 py-3.5">កម្រិតសិទ្ធិ (Role)</th>
                        <th class="px-6 py-3.5">ស្ថានភាព (Status)</th>
                        <th class="px-6 py-3.5 text-right">សកម្មភាព (Actions)</th>
                    </tr>
                </thead>

                <!-- Table Body -->
                <tbody class="divide-y divide-slate-100 bg-white text-xs">
                    @forelse($staff as $s)
                        @php
                            $roleVal = $s->role ?? 3;
                            $roleLabel = match ((string)$roleVal) {
                                '1', 'admin' => ['text' => 'អ្នកគ្រប់គ្រង (Admin)', 'class' => 'bg-amber-50 text-amber-800 border-amber-200'],
                                '2', 'manager' => ['text' => 'ប្រធានសាខា (Manager)', 'class' => 'bg-[#0F4C5C]/10 text-[#0F4C5C] border-[#0F4C5C]/20'],
                                default => ['text' => 'បុគ្គលិក (Staff)', 'class' => 'bg-slate-100 text-slate-700 border-slate-200'],
                            };
                        @endphp
                        <tr class="hover:bg-slate-50/70 transition-colors group">
                            
                            <!-- Member Info & Avatar -->
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center gap-3.5">
                                    <div class="h-10 w-10 rounded-xl bg-gradient-to-br from-[#0B2B40] to-[#0F4C5C] text-white flex items-center justify-center font-extrabold text-xs tracking-wider shrink-0 shadow-2xs group-hover:scale-105 transition-transform">
                                        {{ strtoupper(mb_substr($s->name, 0, 2)) }}
                                    </div>
                                    <div>
                                        <a href="{{ route('staff.show', $s->id) }}" class="font-bold text-[#0B2B40] text-sm hover:text-[#10B981] transition-colors block">
                                            {{ $s->name }}
                                        </a>
                                        <div class="text-[11px] text-slate-400 mt-0.5 flex items-center gap-1.5">
                                            <i class="bi bi-envelope text-[10px] text-slate-400"></i>
                                            <span>{{ $s->email ?? 'មិនមានអ៊ីមែល' }}</span>
                                        </div>
                                    </div>
                                </div>
                            </td>

                            <!-- Position -->
                            <td class="px-6 py-4 whitespace-nowrap font-medium text-slate-800">
                                <div class="flex items-center gap-1.5">
                                    <i class="bi bi-briefcase text-slate-400 text-xs"></i>
                                    <span>{{ $s->position ?? 'N/A' }}</span>
                                </div>
                            </td>

                            <!-- Department -->
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2.5 py-1 rounded-lg bg-slate-50 text-slate-700 text-xs font-semibold border border-slate-200/80">
                                    {{ $s->department ?? 'General' }}
                                </span>
                            </td>

                            <!-- Role -->
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2.5 py-1 rounded-lg text-[11px] font-bold border {{ $roleLabel['class'] }}">
                                    {{ $roleLabel['text'] }}
                                </span>
                            </td>

                            <!-- Status -->
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($s->status === 'active')
                                    <span class="inline-flex items-center gap-1.5 py-1 px-3 rounded-full text-xs font-bold bg-[#EEF7F0] text-[#059669] border border-emerald-200/70">
                                        <span class="w-2 h-2 rounded-full bg-[#10B981] animate-pulse"></span>
                                        <span>កំពុងបំពេញការងារ</span>
                                    </span>
                                @elseif($s->status === 'leave')
                                    <span class="inline-flex items-center gap-1.5 py-1 px-3 rounded-full text-xs font-bold bg-amber-50 text-amber-700 border border-amber-200/70">
                                        <span class="w-2 h-2 rounded-full bg-amber-500"></span>
                                        <span>សម្រាកច្បាប់</span>
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 py-1 px-3 rounded-full text-xs font-bold bg-slate-100 text-slate-600 border border-slate-200">
                                        <span class="w-2 h-2 rounded-full bg-slate-400"></span>
                                        <span>អសកម្ម (Inactive)</span>
                                    </span>
                                @endif
                            </td>

                            <!-- Actions -->
                            <td class="px-6 py-4 whitespace-nowrap text-right">
                                <div class="flex justify-end items-center gap-1.5">
                                    <!-- View Details -->
                                    <a href="{{ route('staff.show', $s->id) }}"
                                       class="p-2 text-slate-400 hover:text-[#0F4C5C] hover:bg-slate-100 rounded-xl transition-colors"
                                       title="មើលព័ត៌មានលម្អិត">
                                        <i class="bi bi-eye text-sm"></i>
                                    </a>

                                    <!-- Edit -->
                                    <a href="{{ route('staff.edit', $s->id) }}"
                                       class="p-2 text-slate-400 hover:text-[#10B981] hover:bg-emerald-50 rounded-xl transition-colors"
                                       title="កែប្រែព័ត៌មាន">
                                        <i class="bi bi-pencil text-sm"></i>
                                    </a>

                                    <!-- Delete -->
                                    <form method="POST" action="{{ route('staff.destroy', $s->id) }}" class="inline"
                                          onsubmit="return confirm('តើអ្នកពិតជាចង់លុបបុគ្គលិក {{ $s->name }} នេះចេញពីប្រព័ន្ធមែនទេ?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="p-2 text-slate-400 hover:text-rose-600 hover:bg-rose-50 rounded-xl transition-colors"
                                                title="លុបបុគ្គលិក">
                                            <i class="bi bi-trash text-sm"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-16 text-center">
                                <div class="flex flex-col items-center justify-center max-w-sm mx-auto">
                                    <div class="w-16 h-16 rounded-2xl bg-[#EEF7F0] flex items-center justify-center text-[#10B981] text-2xl mb-4 shadow-2xs">
                                        <i class="bi bi-people"></i>
                                    </div>
                                    <h3 class="text-base font-bold text-[#0B2B40]">
                                        មិនមានទិន្នន័យបុគ្គលិកឡើយ
                                    </h3>
                                    <p class="text-xs text-slate-400 mt-1.5">
                                        @if(request('search') || request('status') || request('department'))
                                            មិនមានបុគ្គលិកណាដែលត្រូវគ្នានឹងលក្ខខណ្ឌចម្រាញ់ស្វែងរករបស់អ្នកឡើយ។
                                        @else
                                            មិនទាន់មានបុគ្គលិកនៅក្នុងប្រព័ន្ធនៅឡើយទេ។ ចុចប៊ូតុងខាងក្រោមដើម្បីបន្ថែមបុគ្គលិកដំបូង។
                                        @endif
                                    </p>
                                    <div class="flex items-center gap-2 mt-4">
                                        @if(request('search') || request('status') || request('department'))
                                            <a href="{{ route('staff.index') }}"
                                               class="px-4 py-2 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-semibold transition">
                                                សម្អាតការស្វែងរក
                                            </a>
                                        @endif
                                        <a href="{{ route('staff.create') }}"
                                           class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-[#10B981] hover:bg-[#059669] text-white text-xs font-bold shadow-xs transition">
                                            <i class="bi bi-person-plus-fill"></i>
                                            <span>បន្ថែមបុគ្គលិក</span>
                                        </a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if(method_exists($staff, 'hasPages') && $staff->hasPages())
            <div class="px-6 py-4 bg-slate-50/50 border-t border-slate-100">
                {{ $staff->withQueryString()->links() }}
            </div>
        @endif
    </div>

</div>
@endsection

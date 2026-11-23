@extends('layouts.master')

@section('title', 'ព័ត៌មានបុគ្គលិក | ' . ($staff->name ?? 'Staff Details'))

@section('content')
@php
    $staffCode = '#STF-' . str_pad($staff->id, 5, '0', STR_PAD_LEFT);
    $roleVal = (string)($staff->role ?? 3);
    $roleInfo = match ($roleVal) {
        '1', 'admin' => [
            'name'  => 'អ្នកគ្រប់គ្រងប្រព័ន្ធជាន់ខ្ពស់ (System Admin)',
            'short' => 'Admin',
            'badge' => 'bg-amber-50 text-amber-800 border-amber-200/80',
            'icon'  => 'bi-shield-shaded text-amber-600',
        ],
        '2', 'manager' => [
            'name'  => 'ប្រធានគ្រប់គ្រងសាខា (Branch Manager)',
            'short' => 'Manager',
            'badge' => 'bg-[#0F4C5C]/10 text-[#0F4C5C] border-[#0F4C5C]/20',
            'icon'  => 'bi-person-badge-fill text-[#0F4C5C]',
        ],
        default => [
            'name'  => 'បុគ្គលិកប្រតិបត្តិការ (Staff Member)',
            'short' => 'Staff',
            'badge' => 'bg-emerald-50 text-emerald-800 border-emerald-200/80',
            'icon'  => 'bi-person-workspace text-emerald-600',
        ],
    };

    $initials = strtoupper(mb_substr($staff->name ?? 'ST', 0, 2));
@endphp

<div class="max-w-5xl mx-auto space-y-6">

    <!-- Success Feedback Flash Alert -->
    @if(session('success'))
        <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 px-5 py-4 rounded-2xl flex items-center justify-between gap-4 shadow-2xs">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 rounded-xl bg-emerald-500 text-white flex items-center justify-center shrink-0">
                    <i class="bi bi-check2-circle text-lg"></i>
                </div>
                <div>
                    <p class="font-bold text-xs text-emerald-950">ជោគជ័យ!</p>
                    <p class="font-medium text-xs text-emerald-700">{{ session('success') }}</p>
                </div>
            </div>
            <button type="button" onclick="this.parentElement.remove()" class="text-emerald-500 hover:text-emerald-700 p-1">
                <i class="bi bi-x-lg text-xs"></i>
            </button>
        </div>
    @endif

    <!-- Top Action Toolbar -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <a href="{{ route('staff.index') }}" class="group inline-flex items-center gap-2.5 text-slate-500 hover:text-[#0B2B40] transition-colors">
            <div class="flex items-center justify-center w-9 h-9 rounded-xl bg-white border border-slate-200 shadow-2xs group-hover:border-slate-300 transition-colors">
                <i class="bi bi-arrow-left text-sm text-slate-600 group-hover:text-[#0B2B40]"></i>
            </div>
            <div class="flex flex-col">
                <span class="text-[10px] font-bold uppercase tracking-wider text-slate-400">ត្រឡប់ក្រោយ</span>
                <span class="text-xs font-bold text-slate-700 group-hover:text-[#0B2B40]">បញ្ជីបុគ្គលិក (Staff Directory)</span>
            </div>
        </a>

        <!-- Action Buttons -->
        <div class="flex items-center gap-2.5 flex-wrap">
            <button type="button" onclick="window.print()" class="inline-flex items-center gap-2 px-3.5 py-2 rounded-xl bg-white border border-slate-200 text-slate-700 hover:bg-slate-50 text-xs font-semibold shadow-2xs transition-all">
                <i class="bi bi-printer text-xs text-slate-500"></i>
                <span>បោះពុម្ព (Print Profile)</span>
            </button>

            <a href="{{ route('staff.edit', $staff->id) }}"
               class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-[#0F4C5C] hover:bg-[#0B2B40] text-white text-xs font-bold shadow-2xs transition-all active:scale-95">
                <i class="bi bi-pencil-square text-xs"></i>
                <span>កែប្រែព័ត៌មាន (Edit)</span>
            </a>

            <form method="POST" action="{{ route('staff.destroy', $staff->id) }}" class="inline"
                  onsubmit="return confirm('តើអ្នកពិតជាចង់លុបកំណត់ត្រាបុគ្គលិក {{ $staff->name }} នេះចេញពីប្រព័ន្ធមែនទេ?');">
                @csrf
                @method('DELETE')
                <button type="submit"
                        class="inline-flex items-center gap-1.5 px-3.5 py-2 rounded-xl bg-rose-50 border border-rose-200 text-rose-600 hover:bg-rose-100 text-xs font-bold shadow-2xs transition-all">
                    <i class="bi bi-trash text-xs"></i>
                    <span>លុប</span>
                </button>
            </form>
        </div>
    </div>

    <!-- Main Staff Profile Card -->
    <div class="bg-white rounded-3xl border border-slate-200/90 shadow-2xs overflow-hidden">
        
        <!-- Chhenla Gradient Accent Bar -->
        <div class="h-1.5 w-full bg-gradient-to-r from-[#0B2B40] via-[#0F4C5C] to-[#10B981]"></div>

        <!-- Cover Banner with Geometric Pattern -->
        <div class="h-36 sm:h-44 bg-gradient-to-r from-[#0B2B40] via-[#0F4C5C] to-[#134E5E] relative overflow-hidden">
            <div class="absolute inset-0 bg-[radial-gradient(#10B981_1px,transparent_1px)] [background-size:20px_20px] opacity-15"></div>
            <div class="absolute -right-12 -top-12 w-64 h-64 bg-[#10B981]/20 rounded-full blur-3xl pointer-events-none"></div>

            <div class="absolute top-4 right-5 flex items-center gap-2">
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[11px] font-mono font-bold bg-white/10 text-white border border-white/20 backdrop-blur-sm">
                    <i class="bi bi-hash text-emerald-300"></i>
                    <span>{{ $staffCode }}</span>
                </span>
            </div>
        </div>

        <!-- Avatar & Basic Info Header Strip -->
        <div class="px-6 sm:px-8 pb-6 border-b border-slate-100 relative">
            <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4 -mt-14 sm:-mt-16">
                <!-- Avatar & Identity -->
                <div class="flex items-end gap-5">
                    <div class="relative">
                        <div class="w-24 h-24 sm:w-28 sm:h-28 rounded-2xl bg-gradient-to-br from-[#0B2B40] via-[#0F4C5C] to-[#0A2233] text-white flex items-center justify-center font-extrabold text-3xl shadow-lg ring-4 ring-white shrink-0">
                            {{ $initials }}
                        </div>
                        @if(($staff->status ?? '') === 'active')
                            <span class="absolute bottom-1 right-1 w-5 h-5 rounded-full bg-[#10B981] ring-2 ring-white" title="Active"></span>
                        @elseif(($staff->status ?? '') === 'leave')
                            <span class="absolute bottom-1 right-1 w-5 h-5 rounded-full bg-amber-500 ring-2 ring-white" title="On Leave"></span>
                        @else
                            <span class="absolute bottom-1 right-1 w-5 h-5 rounded-full bg-slate-400 ring-2 ring-white" title="Inactive"></span>
                        @endif
                    </div>

                    <div class="mb-2">
                        <div class="flex items-center gap-2.5 flex-wrap">
                            <h1 class="text-xl sm:text-2xl font-extrabold text-[#0B2B40] tracking-tight">
                                {{ $staff->name }}
                            </h1>
                            @if(($staff->status ?? '') === 'active')
                                <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[11px] font-bold bg-[#EEF7F0] text-[#059669] border border-emerald-200/80">
                                    <span class="w-1.5 h-1.5 rounded-full bg-[#10B981]"></span>
                                    <span>កំពុងបំពេញការងារ</span>
                                </span>
                            @elseif(($staff->status ?? '') === 'leave')
                                <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[11px] font-bold bg-amber-50 text-amber-700 border border-amber-200/80">
                                    <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                                    <span>សម្រាកច្បាប់</span>
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[11px] font-bold bg-slate-100 text-slate-600 border border-slate-200">
                                    <span class="w-1.5 h-1.5 rounded-full bg-slate-400"></span>
                                    <span>អសកម្ម (Inactive)</span>
                                </span>
                            @endif
                        </div>

                        <p class="text-xs sm:text-sm text-slate-600 font-semibold mt-1 flex items-center gap-2">
                            <span>{{ $staff->position ?? 'N/A' }}</span>
                            <span class="text-slate-300">&bull;</span>
                            <span class="text-[#0F4C5C] font-bold">{{ $staff->department ?? 'General' }}</span>
                        </p>
                    </div>
                </div>

                <!-- Role Badge Pill -->
                <div class="mb-2">
                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl text-xs font-bold border {{ $roleInfo['badge'] }}">
                        <i class="bi {{ $roleInfo['icon'] }}"></i>
                        <span>{{ $roleInfo['name'] }}</span>
                    </span>
                </div>
            </div>
        </div>

        <!-- 2-Column Detailed Information Layout -->
        <div class="p-6 sm:p-8 grid grid-cols-1 lg:grid-cols-12 gap-6 bg-slate-50/30">
            
            <!-- Left Column: Detailed Information (7 cols) -->
            <div class="lg:col-span-7 space-y-6">
                
                <!-- Employment Profile Details -->
                <div class="bg-white rounded-2xl border border-slate-200/80 p-5 shadow-2xs space-y-4">
                    <div class="flex items-center gap-2 pb-3 border-b border-slate-100">
                        <span class="w-7 h-7 rounded-lg bg-[#0F4C5C]/10 text-[#0F4C5C] flex items-center justify-center text-xs">
                            <i class="bi bi-briefcase-fill"></i>
                        </span>
                        <h3 class="text-xs font-bold uppercase tracking-wider text-slate-400">
                            ព័ត៌មានការងារ និងអង្គភាព (Employment Information)
                        </h3>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3.5 text-xs">
                        <div class="p-3 rounded-xl bg-slate-50/80 border border-slate-200/60">
                            <span class="text-[11px] font-semibold text-slate-400 block mb-1">មុខតំណែង</span>
                            <span class="font-bold text-[#0B2B40] text-sm">{{ $staff->position ?? 'N/A' }}</span>
                        </div>

                        <div class="p-3 rounded-xl bg-slate-50/80 border border-slate-200/60">
                            <span class="text-[11px] font-semibold text-slate-400 block mb-1">នាយកដ្ឋាន</span>
                            <span class="font-bold text-[#0B2B40] text-sm">{{ $staff->department ?? 'N/A' }}</span>
                        </div>

                        <div class="p-3 rounded-xl bg-slate-50/80 border border-slate-200/60">
                            <span class="text-[11px] font-semibold text-slate-400 block mb-1">ស្ថានភាពការងារ</span>
                            <span class="font-bold text-[#059669] capitalize text-sm">{{ $staff->status ?? 'Active' }}</span>
                        </div>

                        <div class="p-3 rounded-xl bg-slate-50/80 border border-slate-200/60">
                            <span class="text-[11px] font-semibold text-slate-400 block mb-1">កាលបរិច្ឆេទចុះឈ្មោះ</span>
                            <span class="font-bold text-[#0B2B40] text-sm">
                                {{ $staff->created_at ? $staff->created_at->format('d/m/Y, h:i A') : 'N/A' }}
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Contact & Communication -->
                <div class="bg-white rounded-2xl border border-slate-200/80 p-5 shadow-2xs space-y-4">
                    <div class="flex items-center gap-2 pb-3 border-b border-slate-100">
                        <span class="w-7 h-7 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center text-xs">
                            <i class="bi bi-person-lines-fill"></i>
                        </span>
                        <h3 class="text-xs font-bold uppercase tracking-wider text-slate-400">
                            ទំនាក់ទំនងផ្លូវការ (Contact Channels)
                        </h3>
                    </div>

                    <div class="space-y-3 text-xs">
                        <div class="flex items-center justify-between p-3.5 rounded-xl bg-slate-50/80 border border-slate-200/60">
                            <span class="font-medium text-slate-500 flex items-center gap-2">
                                <i class="bi bi-envelope text-[#0F4C5C]"></i>
                                <span>អាសយដ្ឋានអ៊ីមែល</span>
                            </span>
                            <span class="font-bold text-[#0B2B40] font-mono">{{ $staff->email ?? 'មិនទាន់មាន' }}</span>
                        </div>

                        <div class="flex items-center justify-between p-3.5 rounded-xl bg-slate-50/80 border border-slate-200/60">
                            <span class="font-medium text-slate-500 flex items-center gap-2">
                                <i class="bi bi-geo-alt text-[#0F4C5C]"></i>
                                <span>ទីស្នាក់ការបម្រើការងារ</span>
                            </span>
                            <span class="font-bold text-[#0B2B40]">ការិយាល័យកណ្តាល - ធនាគារ ចេនឡា</span>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Right Column: Digital Staff ID Card Preview (5 cols) -->
            <div class="lg:col-span-5 space-y-6">
                
                <!-- Digital ID Card Container -->
                <div class="bg-gradient-to-br from-[#0B2B40] via-[#0F4C5C] to-[#0A2233] text-white rounded-2xl p-6 shadow-md border border-slate-700/40 relative overflow-hidden">
                    <div class="absolute -right-10 -bottom-10 w-44 h-44 bg-[#10B981]/20 rounded-full blur-2xl pointer-events-none"></div>

                    <!-- Bank Header on Card -->
                    <div class="flex items-center justify-between pb-4 border-b border-white/10">
                        <div class="flex items-center gap-2">
                            <div class="w-7 h-7 rounded-lg bg-white text-[#0B2B40] flex items-center justify-center font-extrabold text-xs">
                                CL
                            </div>
                            <div>
                                <span class="font-extrabold text-xs text-white tracking-wider block">CHHENLA BANK</span>
                                <span class="text-[9px] text-emerald-300 block">ធនាគារ ចេនឡា ភីអិលស៊ី</span>
                            </div>
                        </div>
                        <span class="text-[10px] uppercase font-bold text-slate-300 tracking-wider">STAFF PASS</span>
                    </div>

                    <!-- Card Body -->
                    <div class="py-5 flex items-center gap-4">
                        <div class="w-16 h-16 rounded-xl bg-white/10 border border-white/20 flex items-center justify-center text-2xl font-extrabold text-white shrink-0 shadow-inner">
                            {{ $initials }}
                        </div>
                        <div>
                            <h4 class="font-extrabold text-base text-white">{{ $staff->name }}</h4>
                            <p class="text-xs text-emerald-300 font-semibold">{{ $staff->position ?? 'Staff Member' }}</p>
                            <p class="text-[11px] text-slate-300 mt-0.5">{{ $staff->department ?? 'General' }}</p>
                        </div>
                    </div>

                    <!-- Card Footer -->
                    <div class="pt-4 border-t border-white/10 flex items-center justify-between text-[11px]">
                        <div>
                            <span class="text-slate-400 block text-[9px] uppercase font-bold">STAFF ID</span>
                            <span class="font-mono font-bold text-white">{{ $staffCode }}</span>
                        </div>
                        <div class="text-right">
                            <span class="text-slate-400 block text-[9px] uppercase font-bold">STATUS</span>
                            <span class="font-bold text-[#10B981] uppercase">{{ $staff->status ?? 'ACTIVE' }}</span>
                        </div>
                    </div>
                </div>

                <!-- Quick Tips / Permissions Box -->
                <div class="bg-white rounded-2xl border border-slate-200/80 p-5 shadow-2xs space-y-3">
                    <h4 class="text-xs font-bold text-[#0B2B40] flex items-center gap-1.5">
                        <i class="bi bi-shield-lock-fill text-[#0F4C5C]"></i>
                        <span>កំណត់ចំណាំសិទ្ធិប្រព័ន្ធ (Permissions Note)</span>
                    </h4>
                    <p class="text-xs text-slate-500 leading-relaxed">
                        បុគ្គលិកនេះត្រូវបានកំណត់ជា <strong class="text-[#0B2B40]">{{ $roleInfo['name'] }}</strong>។ គាត់អាចចូលមើល និងគ្រប់គ្រងប្រតិបត្តិការឥណទាន និងអតិថិជនស្របតាមកម្រិតសិទ្ធិដែលបានផ្ដល់ជូន។
                    </p>
                    <div class="pt-2">
                        <a href="{{ route('staff.edit', $staff->id) }}" class="text-xs font-bold text-[#0F4C5C] hover:text-[#10B981] inline-flex items-center gap-1 transition-colors">
                            <span>ផ្លាស់ប្តូរសិទ្ធិ ឬតួនាទី</span>
                            <i class="bi bi-chevron-right text-[10px]"></i>
                        </a>
                    </div>
                </div>

            </div>

        </div>

    </div>

</div>
@endsection

@extends('layouts.master')

@section('title', 'កែប្រែព័ត៌មានបុគ្គលិក | ' . ($staff->name ?? 'Staff Profile'))

@section('content')
<div class="max-w-4xl mx-auto space-y-6">

    <!-- Top Navigation -->
    <div class="flex items-center justify-between">
        <a href="{{ route('staff.show', $staff->id) }}" class="group inline-flex items-center gap-2.5 text-slate-500 hover:text-[#0B2B40] transition-colors">
            <div class="flex items-center justify-center w-9 h-9 rounded-xl bg-white border border-slate-200 shadow-2xs group-hover:border-slate-300 transition-colors">
                <i class="bi bi-arrow-left text-sm text-slate-600 group-hover:text-[#0B2B40]"></i>
            </div>
            <div class="flex flex-col">
                <span class="text-[10px] font-bold uppercase tracking-wider text-slate-400">ត្រឡប់ក្រោយ</span>
                <span class="text-xs font-bold text-slate-700 group-hover:text-[#0B2B40]">ប្រវត្តិរូបបុគ្គលិក (Staff Profile)</span>
            </div>
        </a>

        <span class="text-xs text-slate-400 hidden sm:inline-block">
            កែប្រែកំណត់ត្រាបុគ្គលិក #STF-{{ str_pad($staff->id, 4, '0', STR_PAD_LEFT) }}
        </span>
    </div>

    <!-- Active Employee Mini Banner -->
    <div class="bg-white rounded-2xl border border-slate-200/90 p-5 shadow-2xs flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
        <div class="flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-[#0B2B40] to-[#0F4C5C] text-white flex items-center justify-center font-extrabold text-base tracking-wider shrink-0 shadow-2xs">
                {{ strtoupper(mb_substr($staff->name ?? 'ST', 0, 2)) }}
            </div>
            <div>
                <div class="flex items-center gap-2">
                    <h2 class="text-base font-bold text-[#0B2B40]">{{ $staff->name }}</h2>
                    @if(($staff->status ?? '') === 'active')
                        <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[10px] font-semibold bg-[#EEF7F0] text-[#059669] border border-emerald-200/70">
                            <span class="w-1.5 h-1.5 rounded-full bg-[#10B981]"></span>
                            <span>កំពុងបំពេញការងារ</span>
                        </span>
                    @elseif(($staff->status ?? '') === 'leave')
                        <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[10px] font-semibold bg-amber-50 text-amber-700 border border-amber-200/70">
                            <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                            <span>សម្រាកច្បាប់</span>
                        </span>
                    @else
                        <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[10px] font-semibold bg-slate-100 text-slate-600 border border-slate-200">
                            <span class="w-1.5 h-1.5 rounded-full bg-slate-400"></span>
                            <span>អសកម្ម</span>
                        </span>
                    @endif
                </div>
                <p class="text-xs text-slate-400 mt-0.5">
                    {{ $staff->position ?? 'N/A' }} &bull; {{ $staff->department ?? 'General' }}
                </p>
            </div>
        </div>

        <div class="text-xs text-slate-400 text-right">
            <span>បានចុះឈ្មោះ៖ <strong>{{ $staff->created_at ? $staff->created_at->format('d/m/Y') : 'N/A' }}</strong></span>
        </div>
    </div>

    <!-- Edit Form Card Container -->
    <div class="bg-white rounded-2xl border border-slate-200/90 shadow-2xs overflow-hidden">
        
        <!-- Chhenla Gradient Accent Bar -->
        <div class="h-1.5 w-full bg-gradient-to-r from-[#0B2B40] via-[#0F4C5C] to-[#10B981]"></div>

        <!-- Form Header -->
        <div class="p-6 sm:p-8 border-b border-slate-100 bg-slate-50/40">
            <div class="flex items-center gap-4">
                <div class="w-11 h-11 rounded-xl bg-[#0F4C5C] text-white flex items-center justify-center text-lg shadow-2xs shrink-0">
                    <i class="bi bi-pencil-square"></i>
                </div>
                <div>
                    <h1 class="text-xl sm:text-2xl font-extrabold text-[#0B2B40] tracking-tight">
                        កែប្រែព័ត៌មានបុគ្គលិក (Update Staff Information)
                    </h1>
                    <p class="text-xs sm:text-sm text-slate-500 mt-0.5">
                        ធ្វើបច្ចុប្បន្នភាពកំណត់ត្រាការងារ និងសិទ្ធិប្រើប្រាស់សម្រាប់បុគ្គលិកនេះ
                    </p>
                </div>
            </div>
        </div>

        <!-- Edit Form -->
        <form action="{{ route('staff.update', $staff->id) }}" method="POST" class="p-6 sm:p-8 space-y-8">
            @csrf
            @method('PUT')

            <!-- Validation Errors Summary -->
            @if ($errors->any())
                <div class="p-4 bg-rose-50 border border-rose-200 rounded-xl">
                    <div class="flex items-center gap-2 text-rose-800 font-bold text-xs mb-1.5">
                        <i class="bi bi-exclamation-circle-fill text-rose-600"></i>
                        <span>សូមពិនិត្យកំហុសទិន្នន័យដូចខាងក្រោម៖</span>
                    </div>
                    <ul class="list-disc list-inside text-xs text-rose-700 font-medium space-y-0.5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- ========================================== -->
            <!-- SECTION 1: PERSONAL & CONTACT IDENTITY     -->
            <!-- ========================================== -->
            <div class="space-y-4">
                <div class="flex items-center gap-2 pb-2 border-b border-slate-100">
                    <span class="w-6 h-6 rounded-lg bg-[#0F4C5C]/10 text-[#0F4C5C] flex items-center justify-center text-xs font-bold">1</span>
                    <h2 class="text-sm font-bold text-[#0B2B40]">ព័ត៌មានផ្ទាល់ខ្លួន និងទំនាក់ទំនង (Personal Details)</h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <!-- Name -->
                    <div class="space-y-1.5">
                        <label for="name" class="block text-xs font-bold text-slate-700">
                            គោត្តនាម និងនាម (Full Name) <span class="text-rose-500">*</span>
                        </label>
                        <div class="relative">
                            <i class="bi bi-person absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-sm"></i>
                            <input
                                type="text"
                                name="name"
                                id="name"
                                value="{{ old('name', $staff->name) }}"
                                required
                                class="w-full pl-10 pr-3.5 py-2.5 rounded-xl bg-white border border-slate-200 focus:outline-none focus:border-[#0F4C5C] focus:ring-2 focus:ring-[#0F4C5C]/15 text-xs sm:text-sm text-slate-800 placeholder:text-slate-400 transition-all shadow-2xs">
                        </div>
                        @error('name')
                            <p class="text-rose-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div class="space-y-1.5">
                        <label for="email" class="block text-xs font-bold text-slate-700">
                            អាសយដ្ឋានអ៊ីមែល (Email) <span class="text-rose-500">*</span>
                        </label>
                        <div class="relative">
                            <i class="bi bi-envelope absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-sm"></i>
                            <input
                                type="email"
                                name="email"
                                id="email"
                                value="{{ old('email', $staff->email) }}"
                                required
                                class="w-full pl-10 pr-3.5 py-2.5 rounded-xl bg-white border border-slate-200 focus:outline-none focus:border-[#0F4C5C] focus:ring-2 focus:ring-[#0F4C5C]/15 text-xs sm:text-sm text-slate-800 placeholder:text-slate-400 transition-all shadow-2xs">
                        </div>
                        @error('email')
                            <p class="text-rose-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- ========================================== -->
            <!-- SECTION 2: EMPLOYMENT & ORGANIZATION       -->
            <!-- ========================================== -->
            <div class="space-y-4">
                <div class="flex items-center gap-2 pb-2 border-b border-slate-100">
                    <span class="w-6 h-6 rounded-lg bg-[#0F4C5C]/10 text-[#0F4C5C] flex items-center justify-center text-xs font-bold">2</span>
                    <h2 class="text-sm font-bold text-[#0B2B40]">តួនាទី និងនាយកដ្ឋានការងារ (Employment & Department)</h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <!-- Position -->
                    <div class="space-y-1.5">
                        <label for="position" class="block text-xs font-bold text-slate-700">
                            មុខតំណែង (Job Title) <span class="text-rose-500">*</span>
                        </label>
                        <div class="relative">
                            <i class="bi bi-briefcase absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-sm"></i>
                            <input
                                type="text"
                                name="position"
                                id="position"
                                value="{{ old('position', $staff->position) }}"
                                required
                                class="w-full pl-10 pr-3.5 py-2.5 rounded-xl bg-white border border-slate-200 focus:outline-none focus:border-[#0F4C5C] focus:ring-2 focus:ring-[#0F4C5C]/15 text-xs sm:text-sm text-slate-800 placeholder:text-slate-400 transition-all shadow-2xs">
                        </div>
                        @error('position')
                            <p class="text-rose-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Department -->
                    <div class="space-y-1.5">
                        <label for="department" class="block text-xs font-bold text-slate-700">
                            នាយកដ្ឋាន (Department) <span class="text-rose-500">*</span>
                        </label>
                        <div class="relative">
                            <i class="bi bi-building absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-sm"></i>
                            <input
                                type="text"
                                name="department"
                                id="department"
                                value="{{ old('department', $staff->department) }}"
                                required
                                class="w-full pl-10 pr-3.5 py-2.5 rounded-xl bg-white border border-slate-200 focus:outline-none focus:border-[#0F4C5C] focus:ring-2 focus:ring-[#0F4C5C]/15 text-xs sm:text-sm text-slate-800 placeholder:text-slate-400 transition-all shadow-2xs">
                        </div>
                        @error('department')
                            <p class="text-rose-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- ========================================== -->
            <!-- SECTION 3: ROLE & ACCOUNT STATUS           -->
            <!-- ========================================== -->
            <div class="space-y-4">
                <div class="flex items-center gap-2 pb-2 border-b border-slate-100">
                    <span class="w-6 h-6 rounded-lg bg-[#0F4C5C]/10 text-[#0F4C5C] flex items-center justify-center text-xs font-bold">3</span>
                    <h2 class="text-sm font-bold text-[#0B2B40]">សិទ្ធិប្រព័ន្ធ និងស្ថានភាពការងារ (Role & Status)</h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <!-- Role -->
                    <div class="space-y-1.5">
                        <label for="role" class="block text-xs font-bold text-slate-700">
                            កម្រិតសិទ្ធិប្រើប្រាស់ (System Role) <span class="text-rose-500">*</span>
                        </label>
                        <div class="relative">
                            <i class="bi bi-shield-check absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-sm"></i>
                            <select
                                name="role"
                                id="role"
                                required
                                class="w-full pl-10 pr-10 py-2.5 rounded-xl bg-white border border-slate-200 focus:outline-none focus:border-[#0F4C5C] focus:ring-2 focus:ring-[#0F4C5C]/15 text-xs sm:text-sm text-slate-800 shadow-2xs appearance-none cursor-pointer">
                                <option value="3" {{ old('role', (string)$staff->role) === '3' || old('role', $staff->role) === 'staff' ? 'selected' : '' }}>បុគ្គលិកទូទៅ (Staff / Officer)</option>
                                <option value="2" {{ old('role', (string)$staff->role) === '2' || old('role', $staff->role) === 'manager' ? 'selected' : '' }}>ប្រធានសាខា (Branch Manager)</option>
                                <option value="1" {{ old('role', (string)$staff->role) === '1' || old('role', $staff->role) === 'admin' ? 'selected' : '' }}>អ្នកគ្រប់គ្រងជាន់ខ្ពស់ (System Admin)</option>
                            </select>
                            <i class="bi bi-chevron-down absolute right-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-xs pointer-events-none"></i>
                        </div>
                        @error('role')
                            <p class="text-rose-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Status Select -->
                    <div class="space-y-1.5">
                        <label for="status" class="block text-xs font-bold text-slate-700">
                            ស្ថានភាពការងារ (Employment Status) <span class="text-rose-500">*</span>
                        </label>
                        <div class="relative">
                            <i class="bi bi-toggle-on absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-sm"></i>
                            <select
                                name="status"
                                id="status"
                                required
                                class="w-full pl-10 pr-10 py-2.5 rounded-xl bg-white border border-slate-200 focus:outline-none focus:border-[#0F4C5C] focus:ring-2 focus:ring-[#0F4C5C]/15 text-xs sm:text-sm text-slate-800 shadow-2xs appearance-none cursor-pointer">
                                <option value="active" {{ old('status', $staff->status) === 'active' ? 'selected' : '' }}>កំពុងបំពេញការងារ (Active)</option>
                                <option value="leave" {{ old('status', $staff->status) === 'leave' ? 'selected' : '' }}>សម្រាកច្បាប់ (Leave)</option>
                                <option value="inactive" {{ old('status', $staff->status) === 'inactive' ? 'selected' : '' }}>អសកម្ម (Inactive)</option>
                            </select>
                            <i class="bi bi-chevron-down absolute right-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-xs pointer-events-none"></i>
                        </div>
                        @error('status')
                            <p class="text-rose-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Form Actions -->
            <div class="flex flex-col sm:flex-row items-center justify-between gap-3 pt-6 border-t border-slate-200">
                <a href="{{ route('staff.show', $staff->id) }}"
                   class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-5 py-2.5 rounded-xl border border-slate-200 bg-white text-slate-700 font-semibold text-xs hover:bg-slate-50 transition shadow-2xs">
                    <i class="bi bi-arrow-left text-xs"></i>
                    <span>ត្រឡប់ក្រោយដោយមិនរក្សាទុក</span>
                </a>

                <button type="submit"
                        class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-6 py-2.5 rounded-xl bg-[#10B981] hover:bg-[#059669] text-white font-bold text-xs shadow-xs hover:shadow transition-all duration-200 active:scale-95">
                    <i class="bi bi-cloud-arrow-up-fill text-xs"></i>
                    <span>ធ្វើបច្ចុប្បន្នភាពទិន្នន័យ (Update Staff Profile)</span>
                </button>
            </div>

        </form>
    </div>

</div>
@endsection

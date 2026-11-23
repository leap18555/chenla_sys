@extends('layouts.master')

@section('title', 'បន្ថែមបុគ្គលិកថ្មី | ធនាគារ ចេនឡា (Register New Staff)')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">

    <!-- Top Back Navigation -->
    <div class="flex items-center justify-between">
        <a href="{{ route('staff.index') }}" class="group inline-flex items-center gap-2.5 text-slate-500 hover:text-[#0B2B40] transition-colors">
            <div class="flex items-center justify-center w-9 h-9 rounded-xl bg-white border border-slate-200 shadow-2xs group-hover:border-slate-300 transition-colors">
                <i class="bi bi-arrow-left text-sm text-slate-600 group-hover:text-[#0B2B40]"></i>
            </div>
            <div class="flex flex-col">
                <span class="text-[10px] font-bold uppercase tracking-wider text-slate-400">ត្រឡប់ក្រោយ</span>
                <span class="text-xs font-bold text-slate-700 group-hover:text-[#0B2B40]">បញ្ជីបុគ្គលិក (Staff Directory)</span>
            </div>
        </a>

        <span class="text-xs text-slate-400 hidden sm:inline-block">
            ទម្រង់ចុះឈ្មោះបុគ្គលិកថ្មីចូលក្នុងប្រព័ន្ធធនាគារ
        </span>
    </div>

    <!-- Main Enrollment Form Container -->
    <div class="bg-white rounded-2xl border border-slate-200/90 shadow-2xs overflow-hidden">
        
        <!-- Chhenla Gradient Accent Bar -->
        <div class="h-1.5 w-full bg-gradient-to-r from-[#0B2B40] via-[#0F4C5C] to-[#10B981]"></div>

        <!-- Form Hero Header -->
        <div class="p-6 sm:p-8 border-b border-slate-100 bg-slate-50/40">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-[#0B2B40] to-[#0F4C5C] text-white flex items-center justify-center text-xl shadow-xs shrink-0">
                    <i class="bi bi-person-plus-fill"></i>
                </div>
                <div>
                    <h1 class="text-xl sm:text-2xl font-extrabold text-[#0B2B40] tracking-tight">
                        ចុះឈ្មោះបុគ្គលិកថ្មី (New Staff Enrollment)
                    </h1>
                    <p class="text-xs sm:text-sm text-slate-500 mt-0.5">
                        សូមបំពេញព័ត៌មានលម្អិតរបស់បុគ្គលិកខាងក្រោមដើម្បីបញ្ចូលទៅក្នុងមូលដ្ឋានទិន្នន័យធនាគារ ចេនឡា
                    </p>
                </div>
            </div>
        </div>

        <!-- Enrollment Form -->
        <form method="POST" action="{{ route('staff.store') }}" class="p-6 sm:p-8 space-y-8">
            @csrf

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
                    <h2 class="text-sm font-bold text-[#0B2B40]">ព័ត៌មានផ្ទាល់ខ្លួន និងទំនាក់ទំនង (Personal & Contact Info)</h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <!-- Full Name -->
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
                                value="{{ old('name') }}"
                                placeholder="ឧ. សុខ ចាន់ថន"
                                required
                                class="w-full pl-10 pr-3.5 py-2.5 rounded-xl bg-white border border-slate-200 focus:outline-none focus:border-[#0F4C5C] focus:ring-2 focus:ring-[#0F4C5C]/15 text-xs sm:text-sm text-slate-800 placeholder:text-slate-400 transition-all shadow-2xs">
                        </div>
                        @error('name')
                            <p class="text-rose-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email Address -->
                    <div class="space-y-1.5">
                        <label for="email" class="block text-xs font-bold text-slate-700">
                            អាសយដ្ឋានអ៊ីមែលផ្លូវការ (Email) <span class="text-rose-500">*</span>
                        </label>
                        <div class="relative">
                            <i class="bi bi-envelope absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-sm"></i>
                            <input
                                type="email"
                                name="email"
                                id="email"
                                value="{{ old('email') }}"
                                placeholder="chanthorn.s@chhenlabank.com"
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
                            មុខតំណែង / តួនាទី (Job Position) <span class="text-rose-500">*</span>
                        </label>
                        <div class="relative">
                            <i class="bi bi-briefcase absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-sm"></i>
                            <input
                                type="text"
                                name="position"
                                id="position"
                                value="{{ old('position') }}"
                                placeholder="ឧ. មន្ត្រីឥណទានជាន់ខ្ពស់ (Senior Loan Officer)"
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
                                value="{{ old('department') }}"
                                placeholder="ឧ. ផ្នែកឥណទាន និងហានិភ័យ (Credit & Risk)"
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
            <!-- SECTION 3: SYSTEM ROLE & SECURITY          -->
            <!-- ========================================== -->
            <div class="space-y-4">
                <div class="flex items-center gap-2 pb-2 border-b border-slate-100">
                    <span class="w-6 h-6 rounded-lg bg-[#0F4C5C]/10 text-[#0F4C5C] flex items-center justify-center text-xs font-bold">3</span>
                    <h2 class="text-sm font-bold text-[#0B2B40]">សិទ្ធិប្រព័ន្ធ និងសុវត្ថិភាព (System Role & Security)</h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <!-- Role Select -->
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
                                <option value="" disabled {{ old('role') ? '' : 'selected' }}>-- ជ្រើសរើសកម្រិតសិទ្ធិ --</option>
                                <option value="3" {{ old('role') == '3' || old('role') == 'staff' ? 'selected' : '' }}>បុគ្គលិកទូទៅ (Staff / Officer)</option>
                                <option value="2" {{ old('role') == '2' || old('role') == 'manager' ? 'selected' : '' }}>ប្រធានសាខា (Branch Manager)</option>
                                <option value="1" {{ old('role') == '1' || old('role') == 'admin' ? 'selected' : '' }}>អ្នកគ្រប់គ្រងជាន់ខ្ពស់ (System Admin)</option>
                            </select>
                            <i class="bi bi-chevron-down absolute right-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-xs pointer-events-none"></i>
                        </div>
                        @error('role')
                            <p class="text-rose-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password (Optional for User Login) -->
                    <div class="space-y-1.5" x-data="{ showPass: false }">
                        <label for="password" class="block text-xs font-bold text-slate-700">
                            ពាក្យសម្ងាត់គណនីចូលប្រព័ន្ធ (Password) <span class="text-slate-400 text-[11px] font-normal">(ស្រេចចិត្ត)</span>
                        </label>
                        <div class="relative">
                            <i class="bi bi-key absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-sm"></i>
                            <input
                                :type="showPass ? 'text' : 'password'"
                                name="password"
                                id="password"
                                placeholder="យ៉ាងតិច ៨ តួអក្សរ (ប្រសិនបើបង្កើតគណនីចូល)"
                                class="w-full pl-10 pr-10 py-2.5 rounded-xl bg-white border border-slate-200 focus:outline-none focus:border-[#0F4C5C] focus:ring-2 focus:ring-[#0F4C5C]/15 text-xs sm:text-sm text-slate-800 placeholder:text-slate-400 transition-all shadow-2xs">
                            <button type="button" 
                                    @click="showPass = !showPass"
                                    class="absolute right-3.5 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-600 focus:outline-none">
                                <i class="bi" :class="showPass ? 'bi-eye' : 'bi-eye-slash'"></i>
                            </button>
                        </div>
                        @error('password')
                            <p class="text-rose-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Status Assignment (Radio Cards) -->
                <div class="space-y-2 pt-2">
                    <label class="block text-xs font-bold text-slate-700">
                        ស្ថានភាពការងារបច្ចុប្បន្ន (Employment Status) <span class="text-rose-500">*</span>
                    </label>
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                        <!-- Active -->
                        <label class="relative flex items-center gap-3 p-3.5 bg-white border border-slate-200 rounded-xl cursor-pointer hover:border-[#10B981] hover:bg-[#EEF7F0]/30 transition-all shadow-2xs">
                            <input type="radio" name="status" value="active" class="w-4 h-4 text-[#10B981] border-slate-300 focus:ring-[#10B981]" {{ old('status', 'active') == 'active' ? 'checked' : '' }}>
                            <div>
                                <span class="text-xs sm:text-sm font-bold text-slate-800 flex items-center gap-1.5">
                                    <span class="w-2 h-2 rounded-full bg-[#10B981]"></span>
                                    <span>កំពុងបំពេញការងារ</span>
                                </span>
                                <p class="text-[10px] text-slate-400 mt-0.5">Active</p>
                            </div>
                        </label>

                        <!-- Leave -->
                        <label class="relative flex items-center gap-3 p-3.5 bg-white border border-slate-200 rounded-xl cursor-pointer hover:border-amber-400 hover:bg-amber-50/30 transition-all shadow-2xs">
                            <input type="radio" name="status" value="leave" class="w-4 h-4 text-amber-500 border-slate-300 focus:ring-amber-500" {{ old('status') == 'leave' ? 'checked' : '' }}>
                            <div>
                                <span class="text-xs sm:text-sm font-bold text-slate-800 flex items-center gap-1.5">
                                    <span class="w-2 h-2 rounded-full bg-amber-500"></span>
                                    <span>សម្រាកច្បាប់</span>
                                </span>
                                <p class="text-[10px] text-slate-400 mt-0.5">On Leave</p>
                            </div>
                        </label>

                        <!-- Inactive -->
                        <label class="relative flex items-center gap-3 p-3.5 bg-white border border-slate-200 rounded-xl cursor-pointer hover:border-slate-400 hover:bg-slate-50 transition-all shadow-2xs">
                            <input type="radio" name="status" value="inactive" class="w-4 h-4 text-slate-500 border-slate-300 focus:ring-slate-500" {{ old('status') == 'inactive' ? 'checked' : '' }}>
                            <div>
                                <span class="text-xs sm:text-sm font-bold text-slate-800 flex items-center gap-1.5">
                                    <span class="w-2 h-2 rounded-full bg-slate-400"></span>
                                    <span>អសកម្ម</span>
                                </span>
                                <p class="text-[10px] text-slate-400 mt-0.5">Inactive</p>
                            </div>
                        </label>
                    </div>
                    @error('status')
                        <p class="text-rose-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Form Action Footer -->
            <div class="flex flex-col sm:flex-row items-center justify-between gap-3 pt-6 border-t border-slate-200">
                <a href="{{ route('staff.index') }}"
                   class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-5 py-2.5 rounded-xl border border-slate-200 bg-white text-slate-700 font-semibold text-xs hover:bg-slate-50 transition shadow-2xs">
                    <i class="bi bi-x-circle text-xs"></i>
                    <span>បោះបង់ (Cancel)</span>
                </a>

                <button type="submit"
                        class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-6 py-2.5 rounded-xl bg-[#10B981] hover:bg-[#059669] text-white font-bold text-xs shadow-xs hover:shadow transition-all duration-200 active:scale-95">
                    <i class="bi bi-check-circle-fill text-xs"></i>
                    <span>រក្សាទុកទិន្នន័យបុគ្គលិក (Save Staff Record)</span>
                </button>
            </div>

        </form>
    </div>

</div>
@endsection

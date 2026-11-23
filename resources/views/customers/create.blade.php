@extends('layouts.master')

@section('title', 'ចុះឈ្មោះអតិថិជនថ្មី | ធនាគារ ចេនឡា')

@section('content')
@php
    $provinceMap = [
        'Phnom Penh'       => 'ភ្នំពេញ',
        'Banteay Meanchey' => 'បន្ទាយមានជ័យ',
        'Battambang'       => 'បាត់ដំបង',
        'Kampong Cham'     => 'កំពង់ចាម',
        'Kampong Chhnang'  => 'កំពង់ឆ្នាំង',
        'Kampong Speu'     => 'កំពង់ស្ពឺ',
        'Kampong Thom'     => 'កំពង់ធំ',
        'Kampot'           => 'កំពត',
        'Kandal'           => 'កណ្តាល',
        'Kep'              => 'កែប',
        'Koh Kong'         => 'កោះកុង',
        'Kratie'           => 'ក្រចេះ',
        'Mondulkiri'       => 'មណ្ឌលគិរី',
        'Preah Vihear'     => 'ព្រះវិហារ',
        'Prey Veng'        => 'ព្រៃវែង',
        'Pursat'           => 'ពោធិ៍សាត់',
        'Ratanakiri'       => 'រតនគិរី',
        'Siem Reap'        => 'សៀមរាប',
        'Preah Sihanouk'   => 'ព្រះសីហនុ',
        'Stung Treng'      => 'ស្ទឹងត្រែង',
        'Svay Rieng'       => 'ស្វាយរៀង',
        'Takeo'            => 'តាកែវ',
        'Oddar Meanchey'   => 'ឧត្តរមានជ័យ',
        'Pailin'           => 'ប៉ៃលិន',
        'Tboung Khmum'     => 'ត្បូងឃ្មុំ'
    ];
@endphp

<div class="relative min-h-screen bg-[#f4f8fa] font-khmer py-8 px-4 sm:px-6 lg:px-8 overflow-hidden">

    <!-- 1. Traditional Khmer Kbach Art Pattern Overlay -->
    <div class="pointer-events-none fixed inset-0 opacity-[0.4]"
         style="background-image: url(&quot;data:image/svg+xml,%3Csvg width='80' height='80' viewBox='0 0 80 80' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' stroke='%231e5158' stroke-width='0.6' stroke-opacity='0.28'%3E%3Cpath d='M40 4 L76 40 L40 76 L4 40 Z'/%3E%3Cpath d='M40 14 L66 40 L40 66 L14 40 Z'/%3E%3Cpath d='M40 4 C33 18 33 22 40 28 C47 22 47 18 40 4 Z'/%3E%3Cpath d='M40 76 C33 62 33 58 40 52 C47 58 47 62 40 76 Z'/%3E%3Cpath d='M4 40 C18 33 22 33 28 40 C22 47 18 47 4 40 Z'/%3E%3Cpath d='M76 40 C62 33 58 33 52 40 C58 47 62 47 76 40 Z'/%3E%3Ccircle cx='40' cy='40' r='5'/%3E%3Ccircle cx='40' cy='40' r='1.5' fill='%231e5158' fill-opacity='0.25'/%3E%3C/g%3E%3C/svg%3E&quot;);">
    </div>

    <!-- 2. Soft Ambient Teal & Deep Blue Glow -->
    <div class="pointer-events-none fixed -top-32 -left-32 w-96 h-96 rounded-full bg-[#1e5158]/10 blur-3xl"></div>
    <div class="pointer-events-none fixed -bottom-32 -right-32 w-96 h-96 rounded-full bg-[#4caf7c]/10 blur-3xl"></div>

    <!-- 3. Majestic Angkor Wat Silhouette Watermark at Bottom -->
    <div class="pointer-events-none fixed bottom-0 inset-x-0 flex justify-center opacity-[0.06] text-[#142d42] select-none overflow-hidden">
        <svg class="w-full max-w-6xl h-auto" viewBox="0 0 1200 300" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
            <rect x="40" y="275" width="1120" height="25"/>
            <rect x="90" y="252" width="1020" height="23"/>
            <rect x="150" y="228" width="900" height="24"/>
            <rect x="200" y="198" width="800" height="30"/>
            <path d="M555 198 L565 110 L578 65 L590 35 L600 10 L610 35 L622 65 L635 110 L645 198 Z"/>
            <path d="M415 198 L423 135 L435 95 L445 68 L455 48 L465 68 L475 95 L487 135 L495 198 Z"/>
            <path d="M705 198 L713 135 L725 95 L735 68 L745 48 L755 68 L765 95 L777 135 L785 198 Z"/>
            <path d="M265 198 L272 155 L282 122 L292 98 L300 80 L308 98 L318 122 L328 155 L335 198 Z"/>
            <path d="M865 198 L872 155 L882 122 L892 98 L900 80 L908 98 L918 122 L928 155 L935 198 Z"/>
            <polygon points="180,198 215,172 250,198"/>
            <polygon points="350,198 380,178 410,198"/>
            <polygon points="500,198 527,175 554,198"/>
            <polygon points="646,198 673,175 700,198"/>
            <polygon points="790,198 820,178 850,198"/>
            <polygon points="950,198 985,172 1020,198"/>
        </svg>
    </div>

    <!-- Main Container -->
    <div class="relative z-10 max-w-3xl mx-auto space-y-5">

        <!-- Top Page Title & Back Action (Square Style) -->
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div class="flex items-center gap-3.5">
                <div class="w-11 h-11 rounded-sm bg-gradient-to-br from-[#142d42] to-[#1e5158] text-white font-extrabold text-sm flex items-center justify-center shadow-sm shrink-0 tracking-wider border border-[#142d42]">
                    CH
                </div>
                <div>
                    <h1 class="text-xl sm:text-2xl font-bold text-[#142d42] tracking-tight">
                        បង្កើតអតិថិជនថ្មី
                    </h1>
                    <p class="text-xs text-[#1e5158]/80 font-medium mt-0.5">
                        ធនាគារ ចេនឡា (Chhenla Bank PLC.) • ប្រព័ន្ធគ្រប់គ្រងព័ត៌មានអតិថិជន
                    </p>
                </div>
            </div>

            <a href="{{ route('customers.index') }}"
               class="inline-flex items-center self-start sm:self-auto gap-2 px-4 py-2.5 rounded-sm text-xs sm:text-sm font-semibold bg-white border border-slate-300 text-[#142d42] hover:bg-[#142d42] hover:text-white hover:border-[#142d42] shadow-sm transition-all">
                <i class="bi bi-arrow-left"></i>
                <span>ត្រឡប់ទៅបញ្ជីអតិថិជន</span>
            </a>
        </div>

        <!-- Validation Error Alert (Square Box) -->
        @if($errors->any())
        <div x-data="{ show: true }" x-show="show" class="rounded-sm bg-rose-50 border-l-4 border-rose-600 border-y border-r border-rose-200 p-4 flex items-center justify-between text-rose-800 shadow-sm">
            <div class="flex items-center gap-3">
                <i class="bi bi-exclamation-triangle-fill text-lg text-rose-600"></i>
                <div>
                    <h3 class="font-bold text-xs sm:text-sm">មានបញ្ហា (Validation Error)</h3>
                    <p class="text-xs opacity-90">សូមពិនិត្យមើលព័ត៌មានដែលបានបញ្ចូលឡើងវិញ!</p>
                </div>
            </div>
            <button type="button" @click="show = false" class="text-rose-600 hover:text-rose-800">
                <i class="bi bi-x-lg"></i>
            </button>
        </div>
        @endif

        <!-- Main Registration Card (Sharp / Boxy Corners `rounded-sm`) -->
        <div class="rounded-sm bg-white/95 backdrop-blur-md border border-slate-300 shadow-[0_10px_30px_rgb(20,45,66,0.07)] overflow-hidden">

            <!-- Calm & Trustworthy Top Accent Bar (Deep Blue -> Teal -> Soft Green) -->
            <div class="h-1.5 w-full bg-gradient-to-r from-[#142d42] via-[#1e5158] to-[#4caf7c]"></div>

            <div class="p-6 sm:p-10">

                <!-- Card Header with Square Soft Green Badge -->
                <div class="pb-6 border-b border-slate-200 flex flex-wrap items-start justify-between gap-4">
                    <div>
                        <h2 class="text-xl sm:text-2xl font-bold text-[#142d42]">
                            ការចុះឈ្មោះអតិថិជន
                        </h2>
                        <p class="text-xs sm:text-sm text-slate-500 mt-1">
                            ចុះឈ្មោះអតិថិជនថ្មីទៅក្នុងប្រព័ន្ធធនាគារ ចេនឡា ដោយសុវត្ថិភាព
                        </p>
                    </div>
                    <span class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-sm bg-[#4caf7c]/15 border border-[#4caf7c]/40 text-[#266b47] text-xs font-bold tracking-wide">
                        <span class="w-2 h-2 bg-[#4caf7c]"></span>
                        អតិថិជនថ្មី
                    </span>
                </div>

                <form action="{{ route('customers.store') }}" method="POST" enctype="multipart/form-data" class="mt-7 space-y-8">
                    @csrf

                    <!-- ========================================== -->
                    <!-- SECTION 1: ១. ព័ត៌មានផ្ទាល់ខ្លួន              -->
                    <!-- ========================================== -->
                    <div class="space-y-5">
                        <div class="flex items-center gap-2.5 border-l-4 border-[#142d42] pl-3">
                            <span class="w-6 h-6 rounded-sm bg-[#142d42] text-white text-xs font-bold flex items-center justify-center">១</span>
                            <h3 class="text-sm sm:text-base font-bold text-[#142d42]">
                                ព័ត៌មានផ្ទាល់ខ្លួន (Personal Information)
                            </h3>
                        </div>

                        <!-- First Name & Last Name -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                            <div>
                                <label class="block text-xs sm:text-sm font-semibold text-[#142d42] mb-2">
                                    នាមត្រកូល (Last Name)
                                </label>
                                <input type="text" name="last_name" value="{{ old('last_name') }}" placeholder="បញ្ចូលនាមត្រកូល"
                                    class="w-full px-4 py-2.5 rounded-sm bg-[#f9fbfc] border border-slate-300 text-sm text-slate-800 placeholder:text-slate-400 focus:bg-white focus:border-[#1e5158] focus:ring-2 focus:ring-[#1e5158]/15 focus:outline-none transition-all">
                            </div>

                            <div>
                                <label class="block text-xs sm:text-sm font-semibold text-[#142d42] mb-2">
                                    នាមខ្លួន (First Name)
                                </label>
                                <input type="text" name="first_name" value="{{ old('first_name') }}" placeholder="បញ្ចូលនាមខ្លួន"
                                    class="w-full px-4 py-2.5 rounded-sm bg-[#f9fbfc] border border-slate-300 text-sm text-slate-800 placeholder:text-slate-400 focus:bg-white focus:border-[#1e5158] focus:ring-2 focus:ring-[#1e5158]/15 focus:outline-none transition-all">
                            </div>
                        </div>

                        <!-- Full Name (Khmer) - Bound to required `name` attribute -->
                        <div>
                            <label class="block text-xs sm:text-sm font-semibold text-[#142d42] mb-2">
                                ឈ្មោះពេញជាភាសាខ្មែរ (Full Name) <span class="text-rose-500">*</span>
                            </label>
                            <div class="relative">
                                <i class="bi bi-person absolute left-3.5 top-1/2 -translate-y-1/2 text-[#1e5158]/80 text-base"></i>
                                <input type="text" name="name" required value="{{ old('name') }}" placeholder="បញ្ចូលឈ្មោះពេញជាភាសាខ្មែរ"
                                    class="w-full pl-10 pr-4 py-2.5 rounded-sm bg-[#f9fbfc] border @error('name') border-rose-500 @else border-slate-300 @enderror text-sm text-slate-800 placeholder:text-slate-400 focus:bg-white focus:border-[#1e5158] focus:ring-2 focus:ring-[#1e5158]/15 focus:outline-none transition-all">
                            </div>
                            @error('name') <span class="text-xs text-rose-500 mt-1.5 block">{{ $message }}</span> @enderror
                        </div>

                        <!-- Gender & Date of Birth -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                            <div>
                                <label class="block text-xs sm:text-sm font-semibold text-[#142d42] mb-2">
                                    ភេទ (Gender)
                                </label>
                                <div class="relative">
                                    <i class="bi bi-gender-ambiguous absolute left-3.5 top-1/2 -translate-y-1/2 text-[#1e5158]/80 text-sm pointer-events-none"></i>
                                    <select name="gender"
                                        class="w-full pl-10 pr-4 py-2.5 rounded-sm bg-[#f9fbfc] border border-slate-300 text-sm text-slate-800 focus:bg-white focus:border-[#1e5158] focus:ring-2 focus:ring-[#1e5158]/15 focus:outline-none transition-all">
                                        <option value="">-- ជ្រើសរើសភេទ --</option>
                                        <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>ប្រុស (Male)</option>
                                        <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>ស្រី (Female)</option>
                                    </select>
                                </div>
                            </div>

                            <div>
                                <label class="block text-xs sm:text-sm font-semibold text-[#142d42] mb-2">
                                    ថ្ងៃខែឆ្នាំកំណើត (Date of Birth)
                                </label>
                                <div class="relative">
                                    <i class="bi bi-calendar3 absolute left-3.5 top-1/2 -translate-y-1/2 text-[#1e5158]/80 text-sm pointer-events-none"></i>
                                    <input type="date" name="dob" value="{{ old('dob') }}"
                                        class="w-full pl-10 pr-4 py-2.5 rounded-sm bg-[#f9fbfc] border border-slate-300 text-sm text-slate-800 focus:bg-white focus:border-[#1e5158] focus:ring-2 focus:ring-[#1e5158]/15 focus:outline-none transition-all">
                                </div>
                            </div>
                        </div>

                        <!-- ID Card Number & Nationality -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                            <div>
                                <label class="block text-xs sm:text-sm font-semibold text-[#142d42] mb-2">
                                    លេខអត្តសញ្ញាណប័ណ្ណ (ID Card)
                                </label>
                                <div class="relative">
                                    <i class="bi bi-person-vcard absolute left-3.5 top-1/2 -translate-y-1/2 text-[#1e5158]/80 text-sm"></i>
                                    <input type="text" name="id_number" value="{{ old('id_number') }}" placeholder="012345678(01)"
                                        class="w-full pl-10 pr-4 py-2.5 rounded-sm bg-[#f9fbfc] border @error('id_number') border-rose-500 @else border-slate-300 @enderror text-sm text-slate-800 placeholder:text-slate-400 focus:bg-white focus:border-[#1e5158] focus:ring-2 focus:ring-[#1e5158]/15 focus:outline-none transition-all">
                                </div>
                                @error('id_number') <span class="text-xs text-rose-500 mt-1.5 block">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label class="block text-xs sm:text-sm font-semibold text-[#142d42] mb-2">
                                    សញ្ជាតិ (Nationality)
                                </label>
                                <div class="relative">
                                    <i class="bi bi-flag absolute left-3.5 top-1/2 -translate-y-1/2 text-[#1e5158]/80 text-sm"></i>
                                    <input type="text" name="nationality" value="{{ old('nationality', 'ខ្មែរ (Cambodian)') }}"
                                        class="w-full pl-10 pr-4 py-2.5 rounded-sm bg-[#f9fbfc] border border-slate-300 text-sm text-slate-800 placeholder:text-slate-400 focus:bg-white focus:border-[#1e5158] focus:ring-2 focus:ring-[#1e5158]/15 focus:outline-none transition-all">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Section Divider -->
                    <div class="border-t border-slate-200"></div>

                    <!-- ========================================== -->
                    <!-- SECTION 2: ២. ព័ត៌មានទំនាក់ទំនង               -->
                    <!-- ========================================== -->
                    <div class="space-y-5">
                        <div class="flex items-center gap-2.5 border-l-4 border-[#1e5158] pl-3">
                            <span class="w-6 h-6 rounded-sm bg-[#1e5158] text-white text-xs font-bold flex items-center justify-center">២</span>
                            <h3 class="text-sm sm:text-base font-bold text-[#142d42]">
                                ព័ត៌មានទំនាក់ទំនង (Contact Information)
                            </h3>
                        </div>

                        <!-- Phone Number -->
                        <div>
                            <label class="block text-xs sm:text-sm font-semibold text-[#142d42] mb-2">
                                លេខទូរស័ព្ទ (Phone Number) <span class="text-rose-500">*</span>
                            </label>
                            <div class="relative">
                                <i class="bi bi-telephone absolute left-3.5 top-1/2 -translate-y-1/2 text-[#1e5158]/80 text-sm"></i>
                                <input type="text" name="phone" required value="{{ old('phone') }}" placeholder="+855 12 345 678"
                                    class="w-full pl-10 pr-4 py-2.5 rounded-sm bg-[#f9fbfc] border @error('phone') border-rose-500 @else border-slate-300 @enderror text-sm text-slate-800 placeholder:text-slate-400 focus:bg-white focus:border-[#1e5158] focus:ring-2 focus:ring-[#1e5158]/15 focus:outline-none transition-all">
                            </div>
                            @error('phone') <span class="text-xs text-rose-500 mt-1.5 block">{{ $message }}</span> @enderror
                        </div>

                        <!-- Email Address -->
                        <div>
                            <label class="block text-xs sm:text-sm font-semibold text-[#142d42] mb-2">
                                អាសយដ្ឋានអ៊ីមែល (Email Address)
                            </label>
                            <div class="relative">
                                <i class="bi bi-envelope absolute left-3.5 top-1/2 -translate-y-1/2 text-[#1e5158]/80 text-sm"></i>
                                <input type="email" name="email" value="{{ old('email') }}" placeholder="example@gmail.com"
                                    class="w-full pl-10 pr-4 py-2.5 rounded-sm bg-[#f9fbfc] border @error('email') border-rose-500 @else border-slate-300 @enderror text-sm text-slate-800 placeholder:text-slate-400 focus:bg-white focus:border-[#1e5158] focus:ring-2 focus:ring-[#1e5158]/15 focus:outline-none transition-all">
                            </div>
                            @error('email') <span class="text-xs text-rose-500 mt-1.5 block">{{ $message }}</span> @enderror
                        </div>

                        <!-- Current Address Details (Square Box Container) -->
                        <div>
                            <label class="block text-xs sm:text-sm font-semibold text-[#142d42] mb-2">
                                អាសយដ្ឋានបច្ចុប្បន្ន (Current Address)
                            </label>
                            <div class="p-4 rounded-sm bg-[#f4f8fa] border border-slate-300 space-y-4">
                                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                                    <!-- House / Village -->
                                    <div>
                                        <label class="block text-[11px] font-bold text-[#1e5158] mb-1.5">ផ្ទះលេខ / ភូមិ</label>
                                        <div class="relative">
                                            <i class="bi bi-house-door absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>
                                            <input type="text" name="house_no" value="{{ old('house_no') }}" placeholder="ផ្ទះលេខ ឬភូមិ..."
                                                class="w-full pl-8 pr-3 py-2 rounded-sm bg-white border border-slate-300 text-xs sm:text-sm text-slate-800 placeholder:text-slate-400 focus:border-[#1e5158] focus:ring-2 focus:ring-[#1e5158]/15 focus:outline-none transition-all">
                                        </div>
                                    </div>

                                    <!-- Street / Sangkat -->
                                    <div>
                                        <label class="block text-[11px] font-bold text-[#1e5158] mb-1.5">ផ្លូវ / ឃុំ / សង្កាត់</label>
                                        <div class="relative">
                                            <i class="bi bi-signpost-split absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>
                                            <input type="text" name="street" value="{{ old('street') }}" placeholder="ផ្លូវ ឬសង្កាត់..."
                                                class="w-full pl-8 pr-3 py-2 rounded-sm bg-white border border-slate-300 text-xs sm:text-sm text-slate-800 placeholder:text-slate-400 focus:border-[#1e5158] focus:ring-2 focus:ring-[#1e5158]/15 focus:outline-none transition-all">
                                        </div>
                                    </div>

                                    <!-- District / Khan -->
                                    <div>
                                        <label class="block text-[11px] font-bold text-[#1e5158] mb-1.5">ក្រុង / ស្រុក / ខណ្ឌ</label>
                                        <div class="relative">
                                            <i class="bi bi-building absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>
                                            <input type="text" name="district" value="{{ old('district') }}" placeholder="ស្រុក ឬខណ្ឌ..."
                                                class="w-full pl-8 pr-3 py-2 rounded-sm bg-white border border-slate-300 text-xs sm:text-sm text-slate-800 placeholder:text-slate-400 focus:border-[#1e5158] focus:ring-2 focus:ring-[#1e5158]/15 focus:outline-none transition-all">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Province & Occupation -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                            <div>
                                <label class="block text-xs sm:text-sm font-semibold text-[#142d42] mb-2">
                                    រាជធានី / ខេត្ត (Province) <span class="text-rose-500">*</span>
                                </label>
                                <div class="relative">
                                    <i class="bi bi-geo-alt absolute left-3.5 top-1/2 -translate-y-1/2 text-[#1e5158]/80 text-sm pointer-events-none"></i>
                                    <select name="pob"
                                        class="w-full pl-10 pr-4 py-2.5 rounded-sm bg-[#f9fbfc] border @error('pob') border-rose-500 @else border-slate-300 @enderror text-sm text-slate-800 focus:bg-white focus:border-[#1e5158] focus:ring-2 focus:ring-[#1e5158]/15 focus:outline-none transition-all">
                                        <option value="">-- ជ្រើសរើសរាជធានី / ខេត្ត --</option>
                                        @foreach($provinceMap as $key => $value)
                                            <option value="{{ $key }}" {{ old('pob') == $key ? 'selected' : '' }}>{{ $value }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('pob') <span class="text-xs text-rose-500 mt-1.5 block">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label class="block text-xs sm:text-sm font-semibold text-[#142d42] mb-2">
                                    មុខរបរ (Occupation)
                                </label>
                                <div class="relative">
                                    <i class="bi bi-briefcase absolute left-3.5 top-1/2 -translate-y-1/2 text-[#1e5158]/80 text-sm"></i>
                                    <input type="text" name="occupation" value="{{ old('occupation') }}" placeholder="ឧ. បុគ្គលិកក្រុមហ៊ុន / អាជីវករ"
                                        class="w-full pl-10 pr-4 py-2.5 rounded-sm bg-[#f9fbfc] border border-slate-300 text-sm text-slate-800 placeholder:text-slate-400 focus:bg-white focus:border-[#1e5158] focus:ring-2 focus:ring-[#1e5158]/15 focus:outline-none transition-all">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Form Actions (Square Buttons `rounded-sm`) -->
                    <div class="flex flex-col-reverse sm:flex-row items-center justify-end gap-3 pt-6 border-t border-slate-200">
                        <a href="{{ route('customers.index') }}"
                           class="w-full sm:w-auto text-center px-6 py-2.5 rounded-sm border border-slate-300 bg-white text-slate-700 font-semibold text-xs sm:text-sm hover:bg-slate-100 hover:text-[#142d42] transition-all">
                            បោះបង់ (Cancel)
                        </a>
                        <button type="submit"
                            class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-7 py-2.5 rounded-sm bg-[#4caf7c] hover:bg-[#3d9868] text-white font-bold text-xs sm:text-sm shadow-sm active:scale-[0.99] transition-all">
                            <i class="bi bi-check2-square text-base"></i>
                            <span>រក្សាទុក និងចុះឈ្មោះអតិថិជន</span>
                        </button>
                    </div>
                </form>

            </div>
        </div>

        <!-- Chhenla Bank Security Footer -->
        <div class="pt-2 pb-4 flex items-center justify-center gap-2 text-xs text-[#1e5158]/80 font-medium">
            <i class="bi bi-shield-lock-fill text-[#4caf7c] text-sm"></i>
            <span>© {{ date('Y') }} ធនាគារ ចេនឡា (Chhenla Bank PLC.) • ប្រព័ន្ធធនាគារមានសុវត្ថិភាព និងទំនុកចិត្តខ្ពស់</span>
        </div>

    </div>
</div>
@endsection
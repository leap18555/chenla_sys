@extends('layouts.master')

@section('title', 'កែប្រែព័ត៌មានអតិថិជន | ធនាគារ ចេនឡា')

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

        <!-- Top Page Title & Back Action -->
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div class="flex items-center gap-3.5">
                <div class="w-11 h-11 rounded-sm bg-gradient-to-br from-[#142d42] to-[#1e5158] text-white font-extrabold text-sm flex items-center justify-center shadow-sm shrink-0 tracking-wider border border-[#142d42]">
                    CH
                </div>
                <div>
                    <h1 class="text-xl sm:text-2xl font-bold text-[#142d42] tracking-tight">
                        កែប្រែព័ត៌មានអតិថិជន
                    </h1>
                    <p class="text-xs text-[#1e5158]/80 font-medium mt-0.5">
                        ធនាគារ ចេនឡា (Chhenla Bank PLC.) • កែសម្រួលទិន្នន័យប្រព័ន្ធ
                    </p>
                </div>
            </div>

            <a href="{{ route('customers.index') }}"
               class="inline-flex items-center self-start sm:self-auto gap-2 px-4 py-2.5 rounded-sm text-xs sm:text-sm font-semibold bg-white border border-slate-300 text-[#142d42] hover:bg-[#142d42] hover:text-white hover:border-[#142d42] shadow-sm transition-all">
                <i class="bi bi-arrow-left"></i>
                <span>ត្រឡប់ទៅបញ្ជីអតិថិជន</span>
            </a>
        </div>

        <!-- Validation Error Alert -->
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

        <!-- Main Edit Card -->
        <div class="rounded-sm bg-white/95 backdrop-blur-md border border-slate-300 shadow-[0_10px_30px_rgb(20,45,66,0.07)] overflow-hidden">

            <!-- Top Accent Bar -->
            <div class="h-1.5 w-full bg-gradient-to-r from-[#142d42] via-[#1e5158] to-[#4caf7c]"></div>

            <div class="p-6 sm:p-10">

                <!-- Card Header -->
                <div class="pb-6 border-b border-slate-200 flex flex-wrap items-start justify-between gap-4">
                    <div>
                        <h2 class="text-xl sm:text-2xl font-bold text-[#142d42]">
                            ទម្រង់កែប្រែព័ត៌មានអតិថិជន
                        </h2>
                        <p class="text-xs sm:text-sm text-slate-500 mt-1">
                            សូមធានាថាព័ត៌មានទាំងអស់ត្រឹមត្រូវតាមកំណត់ត្រាអត្តសញ្ញាណប័ណ្ណធនាគារ។
                        </p>
                    </div>
                    <span class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-sm bg-amber-500/15 border border-amber-500/40 text-amber-800 text-xs font-bold tracking-wide">
                        <span class="w-2 h-2 bg-amber-500"></span>
                        កែប្រែទិន្នន័យ
                    </span>
                </div>

                <form action="{{ route('customers.update', $customer->id) }}" method="POST" enctype="multipart/form-data" class="mt-7 space-y-8">
                    @csrf
                    @method('PUT')

                    <!-- Photo Upload Section -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 p-4 rounded-sm bg-[#f4f8fa] border border-slate-300">
                        <div class="flex flex-col items-center justify-center p-5 text-center bg-white rounded-sm border border-slate-300 shadow-sm">
                            <i class="bi bi-person-vcard text-2xl text-[#142d42] mb-2"></i>
                            <span class="text-xs font-bold text-[#142d42]">រូបថតអត្តសញ្ញាណប័ណ្ណ</span>
                            <span class="text-[10px] text-slate-400 mb-1">National ID Photo</span>
                            @if($customer->id_photo)
                                <span class="text-[10px] text-[#2e7d56] font-medium mb-2"><i class="bi bi-image"></i> មានរូបថតរួចរាល់</span>
                            @else
                                <span class="text-[10px] text-amber-600 font-medium mb-2">មិនទាន់មានរូបថត</span>
                            @endif
                            <label class="px-4 py-1.5 rounded-sm bg-[#142d42] hover:bg-[#1e5158] text-white text-[11px] font-medium transition-all cursor-pointer">
                                <span>ប្តូររូបថត (Change)</span>
                                <input type="file" name="id_photo" class="hidden" accept="image/*">
                            </label>
                        </div>

                        <div class="flex flex-col items-center justify-center p-5 text-center bg-white rounded-sm border border-slate-300 shadow-sm">
                            <i class="bi bi-book text-2xl text-[#1e5158] mb-2"></i>
                            <span class="text-xs font-bold text-[#142d42]">រូបថតសៀវភៅគ្រួសារ</span>
                            <span class="text-[10px] text-slate-400 mb-1">Family Book Photo</span>
                            @if($customer->family_photo)
                                <span class="text-[10px] text-[#2e7d56] font-medium mb-2"><i class="bi bi-image"></i> មានរូបថតរួចរាល់</span>
                            @else
                                <span class="text-[10px] text-amber-600 font-medium mb-2">មិនទាន់មានរូបថត</span>
                            @endif
                            <label class="px-4 py-1.5 rounded-sm bg-[#1e5158] hover:bg-[#142d42] text-white text-[11px] font-medium transition-all cursor-pointer">
                                <span>ប្តូររូបថត (Change)</span>
                                <input type="file" name="family_photo" class="hidden" accept="image/*">
                            </label>
                        </div>
                    </div>

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

                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">
                            <div class="sm:col-span-2">
                                <label class="block text-xs sm:text-sm font-semibold text-[#142d42] mb-2">ឈ្មោះពេញ (Full Name) <span class="text-rose-500">*</span></label>
                                <input type="text" name="name" required value="{{ old('name', $customer->name) }}" placeholder="បញ្ចូលឈ្មោះពេញ"
                                    class="w-full px-4 py-2.5 rounded-sm bg-[#f9fbfc] border border-slate-300 text-sm text-slate-800 focus:bg-white focus:border-[#1e5158] focus:ring-2 focus:ring-[#1e5158]/15 focus:outline-none transition-all">
                            </div>

                            <div>
                                <label class="block text-xs sm:text-sm font-semibold text-[#142d42] mb-2">អ៊ីមែល (Email)</label>
                                <input type="email" name="email" value="{{ old('email', $customer->email) }}" placeholder="name@example.com"
                                    class="w-full px-4 py-2.5 rounded-sm bg-[#f9fbfc] border border-slate-300 text-sm text-slate-800 focus:bg-white focus:border-[#1e5158] focus:ring-2 focus:ring-[#1e5158]/15 focus:outline-none transition-all">
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">
                            <div>
                                <label class="block text-xs sm:text-sm font-semibold text-[#142d42] mb-2">លេខទូរស័ព្ទ (Phone) <span class="text-rose-500">*</span></label>
                                <input type="text" name="phone" required value="{{ old('phone', $customer->phone) }}" placeholder="012 345 678"
                                    class="w-full px-4 py-2.5 rounded-sm bg-[#f9fbfc] border border-slate-300 text-sm text-slate-800 focus:bg-white focus:border-[#1e5158] focus:ring-2 focus:ring-[#1e5158]/15 focus:outline-none transition-all">
                            </div>

                            <div>
                                <label class="block text-xs sm:text-sm font-semibold text-[#142d42] mb-2">លេខអត្តសញ្ញាណប័ណ្ណ (ID Number)</label>
                                <input type="text" name="id_number" value="{{ old('id_number', $customer->id_number) }}" placeholder="012345678(01)"
                                    class="w-full px-4 py-2.5 rounded-sm bg-[#f9fbfc] border border-slate-300 text-sm text-slate-800 focus:bg-white focus:border-[#1e5158] focus:ring-2 focus:ring-[#1e5158]/15 focus:outline-none transition-all">
                            </div>

                            <div>
                                <label class="block text-xs sm:text-sm font-semibold text-[#142d42] mb-2">ថ្ងៃខែឆ្នាំកំណើត (DOB)</label>
                                <input type="date" name="dob" value="{{ old('dob', $customer->dob ? \Carbon\Carbon::parse($customer->dob)->format('Y-m-d') : '') }}"
                                    class="w-full px-4 py-2.5 rounded-sm bg-[#f9fbfc] border border-slate-300 text-sm text-slate-800 focus:bg-white focus:border-[#1e5158] focus:ring-2 focus:ring-[#1e5158]/15 focus:outline-none transition-all">
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                            <div>
                                <label class="block text-xs sm:text-sm font-semibold text-[#142d42] mb-2">ភេទ (Gender)</label>
                                <div class="relative">
                                    <select name="gender" class="w-full px-4 py-2.5 rounded-sm bg-[#f9fbfc] border border-slate-300 text-sm text-slate-800 focus:bg-white focus:border-[#1e5158] focus:ring-2 focus:ring-[#1e5158]/15 focus:outline-none transition-all appearance-none">
                                        <option value="" disabled hidden>ជ្រើសរើសភេទ</option>
                                        <option value="Male" {{ old('gender', $customer->gender) == 'Male' ? 'selected' : '' }}>ប្រុស (Male)</option>
                                        <option value="Female" {{ old('gender', $customer->gender) == 'Female' ? 'selected' : '' }}>ស្រី (Female)</option>
                                        <option value="Other" {{ old('gender', $customer->gender) == 'Other' ? 'selected' : '' }}>ផ្សេងៗ (Other)</option>
                                    </select>
                                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-slate-400">
                                        <i class="bi bi-chevron-down text-xs"></i>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <label class="block text-xs sm:text-sm font-semibold text-[#142d42] mb-2">មុខរបរ (Job / Occupation)</label>
                                <input type="text" name="job" value="{{ old('job', $customer->job) }}" placeholder="ឧ. អាជីវករ / បុគ្គលិក"
                                    class="w-full px-4 py-2.5 rounded-sm bg-[#f9fbfc] border border-slate-300 text-sm text-slate-800 focus:bg-white focus:border-[#1e5158] focus:ring-2 focus:ring-[#1e5158]/15 focus:outline-none transition-all">
                            </div>
                        </div>
                    </div>

                    <!-- Section Divider -->
                    <div class="border-t border-slate-200"></div>

                    <!-- ========================================== -->
                    <!-- SECTION 2: ២. ព័ត៌មានទំនាក់ទំនង និងអាសយដ្ឋាន       -->
                    <!-- ========================================== -->
                    <div class="space-y-5">
                        <div class="flex items-center gap-2.5 border-l-4 border-[#1e5158] pl-3">
                            <span class="w-6 h-6 rounded-sm bg-[#1e5158] text-white text-xs font-bold flex items-center justify-center">២</span>
                            <h3 class="text-sm sm:text-base font-bold text-[#142d42]">
                                ព័ត៌មានទំនាក់ទំនង និងអាសយដ្ឋាន (Address & Location)
                            </h3>
                        </div>

                        <div>
                            <label class="block text-xs sm:text-sm font-semibold text-[#142d42] mb-2">រាជធានី / ខេត្ត (Province) <span class="text-rose-500">*</span></label>
                            <div class="relative">
                                <select name="pob" required class="w-full px-4 py-2.5 rounded-sm bg-[#f9fbfc] border border-slate-300 text-sm text-slate-800 focus:bg-white focus:border-[#1e5158] focus:ring-2 focus:ring-[#1e5158]/15 focus:outline-none transition-all appearance-none">
                                    <option value="" disabled hidden>-- ជ្រើសរើសរាជធានី / ខេត្ត --</option>
                                    @foreach($provinceMap as $key => $value)
                                        <option value="{{ $key }}" {{ old('pob', $customer->pob) == $key ? 'selected' : '' }}>{{ $value }}</option>
                                    @endforeach
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-slate-400">
                                    <i class="bi bi-chevron-down text-xs"></i>
                                </div>
                            </div>
                        </div>

                        <div class="p-4 rounded-sm bg-[#f4f8fa] border border-slate-300 space-y-4">
                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                                <div>
                                    <label class="block text-[11px] font-bold text-[#1e5158] mb-1.5">ផ្ទះលេខ / ភូមិ</label>
                                    <input type="text" name="house_no" value="{{ old('house_no', $customer->house_no) }}" placeholder="ផ្ទះ ឬភូមិ..."
                                        class="w-full px-3 py-2 rounded-sm bg-white border border-slate-300 text-xs sm:text-sm text-slate-800 focus:border-[#1e5158] focus:ring-2 focus:ring-[#1e5158]/15 focus:outline-none transition-all">
                                </div>

                                <div>
                                    <label class="block text-[11px] font-bold text-[#1e5158] mb-1.5">ផ្លូវ / ឃុំ / សង្កាត់</label>
                                    <input type="text" name="street" value="{{ old('street', $customer->street) }}" placeholder="ផ្លូវ ឬសង្កាត់..."
                                        class="w-full px-3 py-2 rounded-sm bg-white border border-slate-300 text-xs sm:text-sm text-slate-800 focus:border-[#1e5158] focus:ring-2 focus:ring-[#1e5158]/15 focus:outline-none transition-all">
                                </div>

                                <div>
                                    <label class="block text-[11px] font-bold text-[#1e5158] mb-1.5">ក្រុង / ស្រុក / ខណ្ឌ</label>
                                    <input type="text" name="district" value="{{ old('district', $customer->district) }}" placeholder="ស្រុក ឬខណ្ឌ..."
                                        class="w-full px-3 py-2 rounded-sm bg-white border border-slate-300 text-xs sm:text-sm text-slate-800 focus:border-[#1e5158] focus:ring-2 focus:ring-[#1e5158]/15 focus:outline-none transition-all">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Form Actions -->
                    <div class="flex flex-col-reverse sm:flex-row items-center justify-end gap-3 pt-6 border-t border-slate-200">
                        <a href="{{ route('customers.index') }}"
                           class="w-full sm:w-auto text-center px-6 py-2.5 rounded-sm border border-slate-300 bg-white text-slate-700 font-semibold text-xs sm:text-sm hover:bg-slate-100 hover:text-[#142d42] transition-all">
                            បោះបង់ (Cancel)
                        </a>
                        <button type="submit"
                            class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-7 py-2.5 rounded-sm bg-[#4caf7c] hover:bg-[#3d9868] text-white font-bold text-xs sm:text-sm shadow-sm active:scale-[0.99] transition-all">
                            <i class="bi bi-check2-square text-base"></i>
                            <span>កែប្រែ និងរក្សាទុកទិន្នន័យ</span>
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
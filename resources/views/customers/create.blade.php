@extends('layouts.master')

@section('title', 'Create Customer | Chhenla Bank')

@section('content')

<div class="max-w-4xl mx-auto pb-12 space-y-5 animate-in fade-in duration-300">

    <!-- Top Navigation Header -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-lg bg-[#fffbe2] border border-[#fef3c7] text-[#d97706] text-[11px] font-bold tracking-wider uppercase mb-1 font-khmer">
                <span>BANKING REGISTRATION // បង្កើតអតិថិជនថ្មី</span>
            </div>
            <h1 class="text-2xl font-black text-slate-800 font-khmer tracking-tight">
                បង្កើត អតិថិជនថ្មី
            </h1>
        </div>

        <a href="{{ route('customers.index') }}"
           class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-white border border-slate-200 text-xs font-semibold text-slate-600 hover:text-slate-900 hover:border-slate-300 transition-all shadow-sm">
            <i class="bi bi-arrow-left text-sm"></i>
            <span>ត្រឡប់ក្រោយ (Back)</span>
        </a>
    </div>

    <!-- Error Validation Display -->
    @if ($errors->any())
    <div class="rounded-2xl bg-rose-50 border border-rose-200/80 p-4 text-rose-700 text-xs shadow-sm">
        <div class="flex items-center gap-2 font-bold text-rose-800 mb-1.5">
            <i class="bi bi-exclamation-triangle-fill text-sm text-rose-500"></i>
            <span>Please fix the following validation errors:</span>
        </div>
        <ul class="list-disc list-inside space-y-0.5 opacity-90 pl-1">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <!-- Main Card Container -->
    <div class="rounded-2xl border border-slate-200/70 bg-white shadow-sm overflow-hidden">
        
        <!-- Card Header -->
        <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between bg-white">
            <div>
                <span class="text-[10px] font-bold uppercase tracking-widest text-slate-400 block">CUSTOMER PROFILE // ពត៌មានអតិថិជន</span>
                <h2 class="text-base font-bold text-slate-800 font-khmer">ទម្រង់បែបបទចុះឈ្មោះអតិថិជន</h2>
            </div>
            <div class="w-8 h-8 rounded-lg bg-[#fffbe2] text-[#d97706] flex items-center justify-center font-bold text-xs">
                <i class="bi bi-person-plus-fill"></i>
            </div>
        </div>

        <form action="{{ route('customers.store') }}"
              method="POST"
              enctype="multipart/form-data"
              class="p-6 space-y-6 bg-white">
            @csrf

            <!-- Identity Document Upload Section -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <!-- National ID Upload Box -->
                <div class="flex items-center justify-between p-4 bg-[#f8f9fa] rounded-xl border border-slate-200/60 hover:border-[#f59e0b] transition-all group">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-white border border-slate-200/80 flex items-center justify-center text-[#d97706] shadow-sm group-hover:scale-105 transition-transform">
                            <i class="bi bi-person-vcard text-lg"></i>
                        </div>
                        <div>
                            <p class="text-xs font-bold text-slate-800 font-khmer">រូបថតអត្តសញ្ញាណប័ណ្ណ</p>
                            <p class="text-[10px] text-slate-400">National ID Photo</p>
                        </div>
                    </div>
                    <label class="px-3.5 py-1.5 rounded-lg bg-white border border-slate-200 hover:bg-[#fffbe2] hover:border-[#fef3c7] hover:text-[#d97706] text-slate-700 text-[11px] font-bold transition-all cursor-pointer shadow-sm">
                        <span>Upload</span>
                        <input type="file" name="id_photo" class="hidden" accept="image/*">
                    </label>
                </div>

                <!-- Family Book Upload Box -->
                <div class="flex items-center justify-between p-4 bg-[#f8f9fa] rounded-xl border border-slate-200/60 hover:border-[#f59e0b] transition-all group">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-white border border-slate-200/80 flex items-center justify-center text-[#d97706] shadow-sm group-hover:scale-105 transition-transform">
                            <i class="bi bi-book text-lg"></i>
                        </div>
                        <div>
                            <p class="text-xs font-bold text-slate-800 font-khmer">រូបថតសៀវភៅគ្រួសារ</p>
                            <p class="text-[10px] text-slate-400">Family Book Photo</p>
                        </div>
                    </div>
                    <label class="px-3.5 py-1.5 rounded-lg bg-white border border-slate-200 hover:bg-[#fffbe2] hover:border-[#fef3c7] hover:text-[#d97706] text-slate-700 text-[11px] font-bold transition-all cursor-pointer shadow-sm">
                        <span>Upload</span>
                        <input type="file" name="family_photo" class="hidden" accept="image/*">
                    </label>
                </div>
            </div>

            <!-- Full Name & Email -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div class="sm:col-span-2">
                    <label class="block text-[11px] font-bold uppercase tracking-wider text-slate-500 mb-1 font-khmer">
                        ឈ្មោះពេញ <span class="text-slate-400 font-normal">// Full Name</span>
                    </label>
                    <input type="text" name="name" required value="{{ old('name') }}" placeholder="បញ្ចូលឈ្មោះពេញ"
                           class="w-full px-3.5 py-2 text-xs font-medium rounded-xl bg-[#f8f9fa] border border-slate-200 focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#f59e0b]/20 focus:border-[#f59e0b] transition-all text-slate-800 placeholder:text-slate-400 font-khmer">
                </div>

                <div>
                    <label class="block text-[11px] font-bold uppercase tracking-wider text-slate-500 mb-1 font-khmer">
                        អ៊ីមែល <span class="text-slate-400 font-normal">// Email</span>
                    </label>
                    <input type="email" name="email" required value="{{ old('email') }}" placeholder="name@example.com"
                           class="w-full px-3.5 py-2 text-xs font-medium rounded-xl bg-[#f8f9fa] border border-slate-200 focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#f59e0b]/20 focus:border-[#f59e0b] transition-all text-slate-800 placeholder:text-slate-400">
                </div>
            </div>

            <!-- Phone, ID Number, & DOB -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div>
                    <label class="block text-[11px] font-bold uppercase tracking-wider text-slate-500 mb-1 font-khmer">
                        លេខទូរស័ព្ទ <span class="text-slate-400 font-normal">// Phone</span>
                    </label>
                    <input type="text" name="phone" required value="{{ old('phone') }}" placeholder="012 345 678"
                           class="w-full px-3.5 py-2 text-xs font-medium rounded-xl bg-[#f8f9fa] border border-slate-200 focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#f59e0b]/20 focus:border-[#f59e0b] transition-all text-slate-800 placeholder:text-slate-400">
                </div>

                <div>
                    <label class="block text-[11px] font-bold uppercase tracking-wider text-slate-500 mb-1 font-khmer">
                        លេខអត្តសញ្ញាណប័ណ្ណ <span class="text-slate-400 font-normal">// ID Number</span>
                    </label>
                    <input type="text" name="id_number" required value="{{ old('id_number') }}" placeholder="98765432"
                           class="w-full px-3.5 py-2 text-xs font-medium rounded-xl bg-[#f8f9fa] border border-slate-200 focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#f59e0b]/20 focus:border-[#f59e0b] transition-all text-slate-800 placeholder:text-slate-400">
                </div>

                <div>
                    <label class="block text-[11px] font-bold uppercase tracking-wider text-slate-500 mb-1 font-khmer">
                        ថ្ងៃខែឆ្នាំកំណើត <span class="text-slate-400 font-normal">// DOB</span>
                    </label>
                    <input type="date" name="dob" required value="{{ old('dob') }}"
                           class="w-full px-3.5 py-2 text-xs font-medium rounded-xl bg-[#f8f9fa] border border-slate-200 focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#f59e0b]/20 focus:border-[#f59e0b] transition-all text-slate-700">
                </div>
            </div>

            <!-- Gender, Occupation, & Province Selection -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div>
                    <label class="block text-[11px] font-bold uppercase tracking-wider text-slate-500 mb-1 font-khmer">
                        ភេទ <span class="text-slate-400 font-normal">// Gender</span>
                    </label>
                    <div class="relative">
                        <select name="gender" required class="w-full px-3.5 py-2 text-xs font-medium rounded-xl bg-[#f8f9fa] border border-slate-200 focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#f59e0b]/20 focus:border-[#f59e0b] transition-all appearance-none text-slate-700 font-khmer">
                            <option value="" disabled selected hidden>ជ្រើសរើសភេទ</option>
                            <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>ប្រុស (Male)</option>
                            <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>ស្រី (Female)</option>
                            <option value="Other" {{ old('gender') == 'Other' ? 'selected' : '' }}>ផ្សេងៗ (Other)</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-slate-400">
                            <i class="bi bi-chevron-down text-[10px]"></i>
                        </div>
                    </div>
                </div>

                <div>
                    <label class="block text-[11px] font-bold uppercase tracking-wider text-slate-500 mb-1 font-khmer">
                        មុខរបរ <span class="text-slate-400 font-normal">// Job / Occupation</span>
                    </label>
                    <input type="text" name="job" required value="{{ old('job') }}" placeholder="ឧ. អាជីវករ, វិស្វករ"
                           class="w-full px-3.5 py-2 text-xs font-medium rounded-xl bg-[#f8f9fa] border border-slate-200 focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#f59e0b]/20 focus:border-[#f59e0b] transition-all text-slate-800 font-khmer placeholder:text-slate-400">
                </div>

                <div>
                    <label class="block text-[11px] font-bold uppercase tracking-wider text-slate-500 mb-1 font-khmer">
                        រាជធានី/ខេត្ត <span class="text-slate-400 font-normal">// Province</span>
                    </label>
                    <div class="relative">
                        <select name="pob" required class="w-full px-3.5 py-2 text-xs font-medium rounded-xl bg-[#f8f9fa] border border-slate-200 focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#f59e0b]/20 focus:border-[#f59e0b] transition-all appearance-none text-slate-700 font-khmer">
                            <option value="" disabled selected hidden>ជ្រើសរើសរាជធានី/ខេត្ត</option>
                            <option value="Phnom Penh" {{ old('pob') == 'Phnom Penh' ? 'selected' : '' }}>រាជធានីភ្នំពេញ</option>
                            <option value="Siem Reap" {{ old('pob') == 'Siem Reap' ? 'selected' : '' }}>ខេត្តសៀមរាប</option>
                            <option value="Battambang" {{ old('pob') == 'Battambang' ? 'selected' : '' }}>ខេត្តបាត់ដំបង</option>
                            <option value="Kampong Thom" {{ old('pob') == 'Kampong Thom' ? 'selected' : '' }}>ខេត្តកំពង់ធំ</option>
                            <option value="Kampong Chhnang" {{ old('pob') == 'Kampong Chhnang' ? 'selected' : '' }}>ខេត្តកំពង់ឆ្នាំង</option>
                            <option value="Kampong Cham" {{ old('pob') == 'Kampong Cham' ? 'selected' : '' }}>ខេត្តកំពង់ចាម</option>
                            <option value="Tboung Khmum" {{ old('pob') == 'Tboung Khmum' ? 'selected' : '' }}>ខេត្តត្បូងឃ្មុំ</option>
                            <option value="Pursat" {{ old('pob') == 'Pursat' ? 'selected' : '' }}>ខេត្តពោធិ៍សាត់</option>
                            <option value="Banteay Meanchey" {{ old('pob') == 'Banteay Meanchey' ? 'selected' : '' }}>ខេត្តបន្ទាយមានជ័យ</option>
                            <option value="Kandal" {{ old('pob') == 'Kandal' ? 'selected' : '' }}>ខេត្តកណ្តាល</option>
                            <option value="Preah Sihanouk" {{ old('pob') == 'Preah Sihanouk' ? 'selected' : '' }}>ខេត្តព្រះសីហនុ</option>
                            <option value="Kampot" {{ old('pob') == 'Kampot' ? 'selected' : '' }}>ខេត្តកំពត</option>
                            <option value="Kep" {{ old('pob') == 'Kep' ? 'selected' : '' }}>ខេត្តកែប</option>
                            <option value="Koh Kong" {{ old('pob') == 'Koh Kong' ? 'selected' : '' }}>ខេត្តកោះកុង</option>
                            <option value="Takeo" {{ old('pob') == 'Takeo' ? 'selected' : '' }}>ខេត្តតាកែវ</option>
                            <option value="Prey Veng" {{ old('pob') == 'Prey Veng' ? 'selected' : '' }}>ខេត្តព្រៃវែង</option>
                            <option value="Svay Rieng" {{ old('pob') == 'Svay Rieng' ? 'selected' : '' }}>ខេត្តស្វាយរៀង</option>
                            <option value="Preah Vihear" {{ old('pob') == 'Preah Vihear' ? 'selected' : '' }}>ខេត្តព្រះវិហារ</option>
                            <option value="Oddar Meanchey" {{ old('pob') == 'Oddar Meanchey' ? 'selected' : '' }}>ខេត្តឧត្តរមានជ័យ</option>
                            <option value="Pailin" {{ old('pob') == 'Pailin' ? 'selected' : '' }}>ខេត្តប៉ៃលិន</option>
                            <option value="Stung Treng" {{ old('pob') == 'Stung Treng' ? 'selected' : '' }}>ខេត្តស្ទឹងត្រែង</option>
                            <option value="Kratie" {{ old('pob') == 'Kratie' ? 'selected' : '' }}>ខេត្តក្រចេះ</option>
                            <option value="Mondulkiri" {{ old('pob') == 'Mondulkiri' ? 'selected' : '' }}>ខេត្តមណ្ឌលគិរី</option>
                            <option value="Ratanakiri" {{ old('pob') == 'Ratanakiri' ? 'selected' : '' }}>ខេត្តរតនគិរី</option>
                            <option value="Kampong Speu" {{ old('pob') == 'Kampong Speu' ? 'selected' : '' }}>ខេត្តកំពង់ស្ពឺ</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-slate-400">
                            <i class="bi bi-chevron-down text-[10px]"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Address Details -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 border-t border-slate-100 pt-5">
                <div>
                    <label class="block text-[11px] font-bold uppercase tracking-wider text-slate-500 mb-1 font-khmer">
                        ភូមិ <span class="text-slate-400 font-normal">// Village</span>
                    </label>
                    <input type="text" name="house_no" required value="{{ old('house_no') }}" placeholder="ឧ. ភូមិស្វាយដង្គំ"
                           class="w-full px-3.5 py-2 text-xs font-medium rounded-xl bg-[#f8f9fa] border border-slate-200 focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#f59e0b]/20 focus:border-[#f59e0b] transition-all text-slate-800 font-khmer placeholder:text-slate-400">
                </div>

                <div>
                    <label class="block text-[11px] font-bold uppercase tracking-wider text-slate-500 mb-1 font-khmer">
                        ឃុំ / សង្កាត់ <span class="text-slate-400 font-normal">// Commune</span>
                    </label>
                    <input type="text" name="street" required value="{{ old('street') }}" placeholder="ឧ. សង្កាត់ស្វាយដង្គំ"
                           class="w-full px-3.5 py-2 text-xs font-medium rounded-xl bg-[#f8f9fa] border border-slate-200 focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#f59e0b]/20 focus:border-[#f59e0b] transition-all text-slate-800 font-khmer placeholder:text-slate-400">
                </div>

                <div>
                    <label class="block text-[11px] font-bold uppercase tracking-wider text-slate-500 mb-1 font-khmer">
                        ខណ្ឌ / ស្រុក <span class="text-slate-400 font-normal">// District</span>
                    </label>
                    <input type="text" name="district" required value="{{ old('district') }}" placeholder="ឧ. ក្រុងសៀមរាប"
                           class="w-full px-3.5 py-2 text-xs font-medium rounded-xl bg-[#f8f9fa] border border-slate-200 focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#f59e0b]/20 focus:border-[#f59e0b] transition-all text-slate-800 font-khmer placeholder:text-slate-400">
                </div>
            </div>

            <!-- Footer Action Triggers -->
            <div class="flex items-center justify-end gap-3 pt-5 border-t border-slate-100">
                <a href="{{ route('customers.index') }}"
                   class="px-5 py-2 rounded-xl border border-slate-200 bg-white text-xs font-semibold text-slate-600 hover:bg-slate-50 hover:text-slate-800 transition-all">
                    បោះបង់ (Cancel)
                </a>

                <button type="submit"
                        class="px-5 py-2 rounded-xl bg-[#d97706] hover:bg-[#b45309] text-white text-xs font-bold transition-all flex items-center gap-2 font-khmer tracking-wide shadow-sm shadow-[#d97706]/30">
                    <i class="bi bi-check2-circle text-sm"></i>
                    <span>រក្សាទុកអតិថិជន (Save Profile)</span>
                </button>
            </div>

        </form>
    </div>
</div>

@endsection
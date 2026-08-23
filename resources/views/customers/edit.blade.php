@extends('layouts.master')

@section('title', 'Edit Customer | Chhenla Bank')

@section('content')

<div class="max-w-4xl mx-auto pb-12 space-y-6 animate-in fade-in duration-500">

    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-indigo-500/10 text-indigo-600 text-[10px] font-bold uppercase tracking-wider mb-2">
                <span class="w-1.5 h-1.5 rounded-full bg-indigo-500 animate-pulse"></span>
                Banking Registration
            </div>
            <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight font-khmer">
                <span>កែប្រែ ព័ត៌មានអតិថិជន</span>
            </h1>
        </div>

        <a href="{{ route('customers.index') }}"
           class="inline-flex items-center gap-2 px-4 py-2 rounded-xl
                  bg-white border border-slate-200 text-sm text-slate-600
                  hover:border-indigo-500 hover:text-indigo-600 transition-all duration-300 shadow-sm">
            <i class="bi bi-arrow-left-circle-fill"></i>
            Back
        </a>
    </div>

    @if ($errors->any())
    <div class="rounded-2xl bg-rose-500/10 border border-rose-500/20 p-4 text-rose-700 text-xs">
        <strong class="block font-bold mb-1">Please fix the following validation errors:</strong>
        <ul class="list-disc list-inside space-y-0.5 opacity-90">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="rounded-3xl overflow-hidden border border-slate-200 bg-white shadow-lg">
        
        <div class="px-6 py-4 border-b border-slate-100 bg-slate-50/50">
            <h2 class="text-lg font-bold text-slate-800">Edit Customer Form</h2>
            <p class="text-xs text-slate-500">Ensure all inputs match system identity records.</p>
        </div>

        <form action="{{ route('customers.update', $customer->id) }}"
              method="POST"
              enctype="multipart/form-data"
              class="p-6 space-y-5 bg-white">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 bg-slate-50/60 p-4 rounded-2xl border border-slate-100">
                <div class="flex flex-col items-center justify-center p-5 text-center bg-white rounded-xl border border-slate-200 shadow-sm">
                    <i class="bi bi-person-vcard text-2xl text-indigo-500 mb-2"></i>
                    <span class="text-xs font-bold text-slate-700 font-khmer">រូបថតអត្តសញ្ញាណប័ណ្ណ</span>
                    <span class="text-[10px] text-slate-400 mb-1">National ID Photo</span>
                    @if($customer->id_photo)
                        <span class="text-[10px] text-emerald-600 font-medium mb-2"><i class="bi bi-image"></i> Existing photo saved</span>
                    @else
                        <span class="text-[10px] text-amber-500 font-medium mb-2">No photo uploaded</span>
                    @endif
                    <label class="px-4 py-1.5 rounded-lg bg-indigo-600 hover:bg-indigo-700 text-white text-[11px] font-medium transition-all cursor-pointer">
                        <span>Change Photo</span>
                        <input type="file" name="id_photo" class="hidden" accept="image/*">
                    </label>
                </div>

                <div class="flex flex-col items-center justify-center p-5 text-center bg-white rounded-xl border border-slate-200 shadow-sm">
                    <i class="bi bi-book text-2xl text-purple-500 mb-2"></i>
                    <span class="text-xs font-bold text-slate-700 font-khmer">រូបថតសៀវភៅគ្រួសារ</span>
                    <span class="text-[10px] text-slate-400 mb-1">Family Book Photo</span>
                    @if($customer->family_photo)
                        <span class="text-[10px] text-emerald-600 font-medium mb-2"><i class="bi bi-image"></i> Existing photo saved</span>
                    @else
                        <span class="text-[10px] text-amber-500 font-medium mb-2">No photo uploaded</span>
                    @endif
                    <label class="px-4 py-1.5 rounded-lg bg-purple-600 hover:bg-purple-700 text-white text-[11px] font-medium transition-all cursor-pointer">
                        <span>Change Photo</span>
                        <input type="file" name="family_photo" class="hidden" accept="image/*">
                    </label>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div class="sm:col-span-2">
                    <label class="block text-[11px] uppercase tracking-wider text-slate-400 font-bold mb-1 font-khmer">ឈ្មោះពេញ (Full Name)</label>
                    <input type="text" name="name" required value="{{ old('name', $customer->name) }}" placeholder="Example name"
                           class="w-full px-3 py-2 text-sm rounded-xl bg-white border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all">
                </div>

                <div>
                    <label class="block text-[11px] uppercase tracking-wider text-slate-400 font-bold mb-1 font-khmer">អ៊ីមែល (Email)</label>
                    <input type="email" name="email" required value="{{ old('email', $customer->email) }}" placeholder="name@example.com"
                           class="w-full px-3 py-2 text-sm rounded-xl bg-white border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all">
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div>
                    <label class="block text-[11px] uppercase tracking-wider text-slate-400 font-bold mb-1 font-khmer">លេខទូរស័ព្ទ (Phone)</label>
                    <input type="text" name="phone" required value="{{ old('phone', $customer->phone) }}" placeholder=""
                           class="w-full px-3 py-2 text-sm rounded-xl bg-white border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all">
                </div>

                <div>
                    <label class="block text-[11px] uppercase tracking-wider text-slate-400 font-bold mb-1 font-khmer">លេខអត្តសញ្ញាណប័ណ្ណ (ID Number)</label>
                    <input type="text" name="id_number" required value="{{ old('id_number', $customer->id_number) }}" placeholder="98765432"
                           class="w-full px-3 py-2 text-sm rounded-xl bg-white border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all">
                </div>

                <div>
                    <label class="block text-[11px] uppercase tracking-wider text-slate-400 font-bold mb-1 font-khmer">ថ្ងៃខែឆ្នាំកំណើត (DOB)</label>
                    <input type="date" name="dob" required value="{{ old('dob', $customer->dob ? \Carbon\Carbon::parse($customer->dob)->format('Y-m-d') : '') }}"
                           class="w-full px-3 py-2 text-sm rounded-xl bg-white border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all text-slate-500">
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div>
                    <label class="block text-[11px] uppercase tracking-wider text-slate-400 font-bold mb-1 font-khmer">ភេទ (Gender)</label>
                    <div class="relative">
                        <select name="gender" required class="w-full px-3 py-2 text-sm rounded-xl bg-white border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all appearance-none text-slate-500 font-khmer">
                            <option value="" disabled hidden>Select gender</option>
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
                    <label class="block text-[11px] uppercase tracking-wider text-slate-400 font-bold mb-1 font-khmer">មុខរបរ (Job / Occupation)</label>
                    <input type="text" name="job" required value="{{ old('job', $customer->job) }}" placeholder="e.g., Merchant, Engineer"
                           class="w-full px-3 py-2 text-sm rounded-xl bg-white border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all font-khmer placeholder:text-slate-300">
                </div>

                <div>
                    <label class="block text-[11px] uppercase tracking-wider text-slate-400 font-bold mb-1 font-khmer">រាជធានី/ខេត្ត (Province)</label>
                    <div class="relative">
                        <select name="pob" required class="w-full px-3 py-2 text-sm rounded-xl bg-white border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all appearance-none text-slate-500 font-khmer">
                            <option value="" disabled hidden>ជ្រើសរើសរាជធានី/ខេត្ត</option>
                            @php
                                $provinces = [
                                    "Phnom Penh", "Banteay Meanchey", "Battambang", "Kampong Cham", "Kampong Chhnang", 
                                    "Kampong Speu", "Kampong Thom", "Kampot", "Kandal", "Kep", "Koh Kong", 
                                    "Kratie", "Mondulkiri", "Oddar Meanchey", "Pailin", "Preah Vihear", 
                                    "Prey Veng", "Pursat", "Ratanakiri", "Siem Reap", "Preah Sihanouk", 
                                    "Stung Treng", "Svay Rieng", "Takeo", "Tboung Khmum"
                                ];
                            @endphp
                            @foreach($provinces as $province)
                                @php
                                    // Custom text translations for specific entities to display fully in Khmer
                                    $khmerLabel = $province == "Phnom Penh" ? "រាជធានីភ្នំពេញ" : "ខេត្ត" . ($province == "Takeo" ? "តាកែវ" : ($province == "Kampong Cham" ? "កំពង់ចាម" : ($province == "Kampong Chhnang" ? "កំពង់ឆ្នាំង" : ($province == "Kampong Speu" ? "កំពង់ស្ពឺ" : ($province == "Kampong Thom" ? "កំពង់ធំ" : ($province == "Preah Sihanouk" ? "ព្រះសីហនុ" : ($province == "Banteay Meanchey" ? "បន្ទាយមានជ័យ" : ($province == "Battambang" ? "បាត់ដំបង" : ($province == "Kampot" ? "កំពត" : ($province == "Kandal" ? "កណ្តាល" : ($province == "Kep" ? "កែប" : ($province == "Koh Kong" ? "កោះកុង" : ($province == "Kratie" ? "ក្រចេះ" : ($province == "Mondulkiri" ? "មណ្ឌលគិរី" : ($province == "Oddar Meanchey" ? "ឧត្តរមានជ័យ" : ($province == "Pailin" ? "ប៉ៃលិន" : ($province == "Preah Vihear" ? "ព្រះវិហារ" : ($province == "Prey Veng" ? "ព្រៃវែង" : ($province == "Pursat" ? "ពោធិ៍សាត់" : ($province == "Ratanakiri" ? "រតនគិរី" : ($province == "Siem Reap" ? "សៀមរាប" : ($province == "Stung Treng" ? "ស្ទឹងត្រែង" : ($province == "Svay Rieng" ? "ស្វាយរៀង" : "ត្បូងឃ្មុំ")))))))))))))))))))))));
                                @endphp
                                <option value="{{ $province }}" {{ old('pob', $customer->pob) == $province ? 'selected' : '' }}>{{ $khmerLabel }}</option>
                            @endforeach
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-slate-400">
                            <i class="bi bi-chevron-down text-xs"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 border-t border-slate-100 pt-4">
                <div>
                    <label class="block text-[11px] uppercase tracking-wider text-slate-400 font-bold mb-1 font-khmer">ភូមិ (Village)</label>
                    <input type="text" name="house_no" required value="{{ old('house_no', $customer->house_no) }}" placeholder="e.g., ភូមិស្វាយដង្គំ"
                           class="w-full px-3 py-2 text-sm rounded-xl bg-white border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all font-khmer">
                </div>

                <div>
                    <label class="block text-[11px] uppercase tracking-wider text-slate-400 font-bold mb-1 font-khmer">ឃុំ / សង្កាត់ (Commune)</label>
                    <input type="text" name="street" required value="{{ old('street', $customer->street) }}" placeholder="e.g., សង្កាត់ស្វាយដង្គំ"
                           class="w-full px-3 py-2 text-sm rounded-xl bg-white border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all font-khmer">
                </div>

                <div>
                    <label class="block text-[11px] uppercase tracking-wider text-slate-400 font-bold mb-1 font-khmer">ខណ្ឌ / ស្រុក (District)</label>
                    <input type="text" name="district" required value="{{ old('district', $customer->district) }}" placeholder="e.g., ក្រុងសៀមរាប"
                           class="w-full px-3 py-2 text-sm rounded-xl bg-white border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all font-khmer">
                </div>
            </div>

            <div class="flex items-center justify-end gap-3 pt-3 border-t border-slate-100">
                <a href="{{ route('customers.index') }}"
                   class="px-5 py-2 rounded-xl border border-slate-200 bg-white text-xs text-slate-600 font-semibold hover:bg-slate-50 transition-all">
                    Cancel
                </a>

                <button type="submit"
                        class="px-5 py-2 rounded-xl bg-[#00a37b] hover:bg-[#008f6c] text-white text-xs font-bold transition-all flex items-center gap-2 font-khmer tracking-wide shadow-md">
                    <i class="bi bi-check-circle-fill"></i>
                    កែប្រែទិន្នន័យ (Update Profile)
                </button>
            </div>

        </form>
    </div>
</div>

@endsection
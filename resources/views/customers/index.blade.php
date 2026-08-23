@extends('layouts.master')

@section('title', 'គ្រប់គ្រងអតិថិជន | Pawndesk')

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

<div x-data="{ currentTab: '{{ $errors->any() ? 'create' : 'list' }}', searchQuery: '' }" class="space-y-6 font-khmer bg-slate-50 p-6 rounded-2xl">
    
    <!-- Top Header Section -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 pb-4 border-b border-slate-200">
        <div>
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-amber-100 text-amber-800 text-xs font-bold uppercase tracking-wider mb-2">
                <span class="w-2 h-2 rounded-full bg-amber-500 animate-pulse"></span>
                COLLATERAL CORE v2.0
            </div>
            <div class="flex items-baseline gap-3">
                <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">
                    គ្រប់គ្រងអតិថិជន
                </h1>
                <span class="text-xs font-medium text-slate-500">Pawndesk System</span>
            </div>
        </div>

        <div>
            <button @click="currentTab = (currentTab === 'list' ? 'create' : 'list')"
                class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl text-sm font-bold text-slate-900 bg-amber-400 hover:bg-amber-500 active:scale-95 transition-all shadow-md shadow-amber-400/20">
                <i class="bi" :class="currentTab === 'list' ? 'bi-person-plus-fill' : 'bi-list-ul'"></i>
                <span x-text="currentTab === 'list' ? 'ចុះឈ្មោះអតិថិជនថ្មី' : 'មើលបញ្ជីអតិថិជន'"></span>
            </button>
        </div>
    </div>

    <!-- Alert Notifications -->
    @if(session('success'))
    <div x-data="{ show: true }" x-show="show" class="rounded-xl bg-emerald-50 border border-emerald-200 p-4 flex items-center justify-between text-emerald-800">
        <div class="flex items-center gap-3">
            <i class="bi bi-check-circle-fill text-xl text-emerald-600"></i>
            <div>
                <h3 class="font-bold text-sm">ជោគជ័យ (Success)</h3>
                <p class="text-xs opacity-90">{{ session('success') }}</p>
            </div>
        </div>
        <button @click="show = false" class="text-emerald-600 hover:text-emerald-800"><i class="bi bi-x-lg"></i></button>
    </div>
    @endif

    @if($errors->any())
    <div x-data="{ show: true }" x-show="show" class="rounded-xl bg-rose-50 border border-rose-200 p-4 flex items-center justify-between text-rose-800">
        <div class="flex items-center gap-3">
            <i class="bi bi-exclamation-triangle-fill text-xl text-rose-600"></i>
            <div>
                <h3 class="font-bold text-sm">មានបញ្ហា (Validation Error)</h3>
                <p class="text-xs opacity-90">សូមពិនិត្យមើលព័ត៌មានដែលបានបញ្ចូលឡើងវិញ!</p>
            </div>
        </div>
        <button @click="show = false" class="text-rose-600 hover:text-rose-800"><i class="bi bi-x-lg"></i></button>
    </div>
    @endif

    <!-- TAB 1: Customer List -->
    <div x-show="currentTab === 'list'" x-transition>
        <div class="rounded-2xl border border-slate-200 bg-white shadow-sm overflow-hidden">
            
            <!-- Table Header Filter Bar -->
            <div class="p-5 border-b border-slate-100 flex flex-col sm:flex-row sm:items-center justify-between gap-4 bg-white">
                <div class="flex items-center gap-3">
                    <h2 class="text-lg font-bold text-slate-900">បញ្ជីអតិថិជនបញ្ចាំ</h2>
                    <span class="px-2.5 py-0.5 text-xs font-bold bg-amber-100 text-amber-800 rounded-full border border-amber-200">
                        {{ count($customers) }} នាក់
                    </span>
                </div>

                <!-- Instant Search Input -->
                <div class="relative w-full sm:w-80">
                    <i class="bi bi-search absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-sm"></i>
                    <input type="text" x-model="searchQuery" placeholder="ស្វែងរកតាមឈ្មោះ លេខទូរស័ព្ទ..." 
                        class="w-full pl-10 pr-4 py-2 rounded-xl bg-slate-50 border border-slate-200 focus:outline-none focus:border-amber-500 focus:ring-1 focus:ring-amber-500 text-sm text-slate-900 placeholder:text-slate-400 transition-all">
                </div>
            </div>

            <!-- Customer Table -->
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-slate-50 border-b border-slate-200 text-xs font-bold text-slate-600 uppercase">
                        <tr>
                            <th class="px-6 py-4">អតិថិជន</th>
                            <th class="px-6 py-4">ទំនាក់ទំនង</th>
                            <th class="px-6 py-4">អត្តសញ្ញាណប័ណ្ណ</th>
                            <th class="px-6 py-4">អាសយដ្ឋាន</th>
                            <th class="px-6 py-4 text-right">សកម្មភាព</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-sm bg-white">
                        @forelse($customers as $customer)
                        <tr class="hover:bg-amber-50/50 transition-colors group"
                            x-show="searchQuery === '' || 
                                    '{{ strtolower($customer->name) }}'.includes(searchQuery.toLowerCase()) || 
                                    '{{ $customer->phone }}'.includes(searchQuery) || 
                                    '{{ strtolower($customer->email ?? '') }}'.includes(searchQuery.toLowerCase()) ||
                                    '{{ strtolower($customer->id_number ?? '') }}'.includes(searchQuery.toLowerCase())">
                            
                            <!-- Customer Info -->
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-xl bg-amber-400 text-slate-900 font-black text-xs flex items-center justify-center shrink-0 shadow-sm">
                                        {{ strtoupper(substr($customer->name, 0, 2)) }}
                                    </div>
                                    <div>
                                        <div class="font-bold text-slate-900 group-hover:text-amber-700 transition-colors">
                                            {{ $customer->name }}
                                        </div>
                                        <div class="text-[11px] text-slate-400 font-mono">
                                            ID-{{ str_pad($customer->id, 6, '0', STR_PAD_LEFT) }}
                                        </div>
                                    </div>
                                </div>
                            </td>

                            <!-- Contact -->
                            <td class="px-6 py-4">
                                <div class="font-medium text-slate-800">{{ $customer->phone }}</div>
                                <div class="text-xs text-slate-500">{{ $customer->email ?? 'មិនមាន' }}</div>
                            </td>

                            <!-- ID Card -->
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-lg bg-blue-50 border border-blue-200 text-blue-700 font-mono font-semibold text-xs">
                                    <i class="bi bi-card-heading"></i> {{ $customer->id_number ?? 'មិនមាន' }}
                                </span>
                            </td>

                            <!-- Address -->
                            <td class="px-6 py-4">
                                <span class="text-xs text-slate-600">
                                    @if(isset($customer->house_no) || isset($customer->street) || isset($customer->district) || isset($customer->pob))
                                        ភូមិ/ផ្ទះ៖ <span class="font-semibold text-slate-900">{{ $customer->house_no ?? '***' }}</span>, 
                                        ផ្លូវ/សង្កាត់៖ <span class="font-semibold text-slate-900">{{ $customer->street ?? '***' }}</span>, 
                                        ស្រុក/ខណ្ឌ៖ <span class="font-semibold text-slate-900">{{ $customer->district ?? '***' }}</span>
                                        @if($customer->pob)
                                            , ខេត្ត៖ <span class="text-amber-700 font-bold">{{ $provinceMap[$customer->pob] ?? $customer->pob }}</span>
                                        @endif
                                    @else
                                        <span class="text-slate-400 italic">មិនទាន់មានទិន្នន័យ</span>
                                    @endif
                                </span>
                            </td>

                            <!-- Actions -->
                            <td class="px-6 py-4">
                                <div class="flex justify-end gap-2">
                                    <a href="{{ route('customers.edit', $customer->id) }}"
                                       class="w-8 h-8 rounded-lg bg-slate-100 text-slate-600 hover:bg-amber-400 hover:text-slate-900 transition-all flex items-center justify-center">
                                        <i class="bi bi-pencil-square text-xs"></i>
                                    </a>

                                    <form method="POST" action="{{ route('customers.destroy', $customer->id) }}" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                onclick="return confirm('តើអ្នកពិតជាចង់លុបទិន្នន័យអតិថិជននេះមែនទេ?')"
                                                class="w-8 h-8 rounded-lg bg-rose-50 text-rose-600 hover:bg-rose-600 hover:text-white transition-all flex items-center justify-center border border-rose-100">
                                            <i class="bi bi-trash-fill text-xs"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="py-16 text-center text-slate-400">
                                មិនមានទិន្នន័យអតិថិជនឡើយ
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- TAB 2: Registration Form -->
    <div x-show="currentTab === 'create'" x-transition style="display: none;">
        <div class="rounded-2xl border border-slate-200 bg-white shadow-sm p-6 sm:p-8">
            <div class="pb-6 border-b border-slate-100 mb-6">
                <h2 class="text-xl font-bold text-slate-900">ទម្រង់បែបបទចុះឈ្មោះអតិថិជនថ្មី</h2>
                <p class="text-xs text-slate-500 mt-1">សូមបញ្ចូលព័ត៌មានលម្អិតរបស់អតិថិជនសម្រាប់ប្រព័ន្ធ Pawndesk</p>
            </div>

            <form action="{{ route('customers.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <!-- Personal Info -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                    <div>
                        <label class="block text-xs uppercase font-bold text-slate-600 mb-2">ឈ្មោះពេញ (Full Name) *</label>
                        <input type="text" name="name" required value="{{ old('name') }}" placeholder="បញ្ចូលឈ្មោះពេញ..." 
                            class="w-full px-4 py-3 rounded-xl bg-slate-50 border @error('name') border-rose-500 @else border-slate-200 @enderror text-sm text-slate-900 focus:border-amber-500 focus:ring-1 focus:ring-amber-500 focus:outline-none">
                        @error('name') <span class="text-xs text-rose-500 mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-xs uppercase font-bold text-slate-600 mb-2">លេខទូរស័ព្ទ (Phone) *</label>
                        <input type="text" name="phone" required value="{{ old('phone') }}" placeholder="012345678" 
                            class="w-full px-4 py-3 rounded-xl bg-slate-50 border @error('phone') border-rose-500 @else border-slate-200 @enderror text-sm text-slate-900 focus:border-amber-500 focus:ring-1 focus:ring-amber-500 focus:outline-none">
                        @error('phone') <span class="text-xs text-rose-500 mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-xs uppercase font-bold text-slate-600 mb-2">អ៊ីមែល (Email Address)</label>
                        <input type="email" name="email" value="{{ old('email') }}" placeholder="example@mail.com" 
                            class="w-full px-4 py-3 rounded-xl bg-slate-50 border @error('email') border-rose-500 @else border-slate-200 @enderror text-sm text-slate-900 focus:border-amber-500 focus:ring-1 focus:ring-amber-500 focus:outline-none">
                        @error('email') <span class="text-xs text-rose-500 mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-xs uppercase font-bold text-slate-600 mb-2">លេខអត្តសញ្ញាណប័ណ្ណ (ID Card)</label>
                        <input type="text" name="id_number" value="{{ old('id_number') }}" placeholder="012345678(01)" 
                            class="w-full px-4 py-3 rounded-xl bg-slate-50 border @error('id_number') border-rose-500 @else border-slate-200 @enderror text-sm text-slate-900 focus:border-amber-500 focus:ring-1 focus:ring-amber-500 focus:outline-none">
                        @error('id_number') <span class="text-xs text-rose-500 mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-xs uppercase font-bold text-slate-600 mb-2">រាជធានី / ខេត្ត (Province/POB)</label>
                        <select name="pob" class="w-full px-4 py-3 rounded-xl bg-slate-50 border @error('pob') border-rose-500 @else border-slate-200 @enderror text-sm text-slate-900 focus:border-amber-500 focus:ring-1 focus:ring-amber-500 focus:outline-none">
                            <option value="">-- ជ្រើសរើសខេត្ត --</option>
                            @foreach($provinceMap as $key => $value)
                                <option value="{{ $key }}" {{ old('pob') == $key ? 'selected' : '' }}>{{ $value }}</option>
                            @endforeach
                        </select>
                        @error('pob') <span class="text-xs text-rose-500 mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-xs uppercase font-bold text-slate-600 mb-2">ផ្ទះ / ភូមិ (House / Village)</label>
                        <input type="text" name="house_no" value="{{ old('house_no') }}" placeholder="បញ្ចូលផ្ទះ ឬភូមិ..." 
                            class="w-full px-4 py-3 rounded-xl bg-slate-50 border border-slate-200 text-sm text-slate-900 focus:border-amber-500 focus:ring-1 focus:ring-amber-500 focus:outline-none">
                    </div>

                    <div>
                        <label class="block text-xs uppercase font-bold text-slate-600 mb-2">ផ្លូវ / សង្កាត់ (Street / Sangkat)</label>
                        <input type="text" name="street" value="{{ old('street') }}" placeholder="បញ្ចូលផ្លូវ ឬសង្កាត់..." 
                            class="w-full px-4 py-3 rounded-xl bg-slate-50 border border-slate-200 text-sm text-slate-900 focus:border-amber-500 focus:ring-1 focus:ring-amber-500 focus:outline-none">
                    </div>

                    <div>
                        <label class="block text-xs uppercase font-bold text-slate-600 mb-2">ក្រុង / ស្រុក / ខណ្ឌ (District)</label>
                        <input type="text" name="district" value="{{ old('district') }}" placeholder="បញ្ចូលស្រុក ឬខណ្ឌ..." 
                            class="w-full px-4 py-3 rounded-xl bg-slate-50 border border-slate-200 text-sm text-slate-900 focus:border-amber-500 focus:ring-1 focus:ring-amber-500 focus:outline-none">
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="flex items-center justify-end gap-3 pt-6 border-t border-slate-100">
                    <button type="button" @click="currentTab = 'list'"
                        class="px-6 py-2.5 rounded-xl border border-slate-200 text-slate-600 font-semibold text-sm hover:bg-slate-50">
                        ត្រឡប់ទៅវិញ
                    </button>
                    <button type="submit" 
                        class="px-6 py-2.5 rounded-xl bg-amber-400 hover:bg-amber-500 text-slate-900 font-bold text-sm shadow-md shadow-amber-400/20 active:scale-95 transition-all">
                        រក្សាទុកទិន្នន័យ
                    </button>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection
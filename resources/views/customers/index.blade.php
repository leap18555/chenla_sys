@extends('layouts.master')

@section('title', 'គ្រប់គ្រងអតិថិជន | ធនាគារ ចេនឡា')

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

<div x-data="{ searchQuery: '' }"
     class="relative min-h-screen bg-[#f4f7f9] font-khmer p-4 sm:p-6 lg:p-8 overflow-hidden">

    <!-- Subtle Khmer Diamond Pattern Background -->
    <div class="pointer-events-none fixed inset-0 opacity-[0.45]"
         style="background-image: url(&quot;data:image/svg+xml,%3Csvg width='64' height='64' viewBox='0 0 64 64' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' stroke='%23cbd5e1' stroke-width='0.75'%3E%3Cpath d='M32 4 L60 32 L32 60 L4 32 Z'/%3E%3Cpath d='M32 16 L48 32 L32 48 L16 32 Z'/%3E%3Ccircle cx='32' cy='32' r='2.5'/%3E%3C/g%3E%3C/svg%3E&quot;);">
    </div>

    <div class="relative z-10 max-w-7xl mx-auto space-y-6">

        <!-- Top Card Header with Chhenla Gradient Bar -->
        <div class="rounded-2xl bg-white border border-slate-200/80 shadow-[0_8px_30px_rgb(15,41,66,0.04)] overflow-hidden">
            <div class="h-1.5 w-full bg-gradient-to-r from-[#142d42] via-[#1e5158] to-[#4caf7c]"></div>

            <div class="p-6 flex flex-col md:flex-row md:items-center justify-between gap-4">
                <div class="flex items-start sm:items-center gap-4">
                    <!-- Brand Emblem -->
                    <div class="w-12 h-12 rounded-2xl bg-[#193b52] text-white font-extrabold text-base flex items-center justify-center shrink-0 shadow-sm tracking-wider">
                        CH
                    </div>
                    <div>
                        <div class="flex items-center gap-2">
                            <h1 class="text-xl sm:text-2xl font-bold text-[#142d42] tracking-tight">
                                គ្រប់គ្រងអតិថិជន
                            </h1>
                            <span class="hidden sm:inline-block text-xs font-semibold text-slate-400 border-l border-slate-200 pl-2">
                                Chhenla Bank PLC.
                            </span>
                        </div>
                        <p class="text-xs sm:text-sm text-slate-500 mt-1">
                            ទិន្នន័យសង្ខេបនៃអតិថិជន និងការគ្រប់គ្រងព័ត៌មានទំនាក់ទំនងប្រចាំថ្ងៃក្នុងប្រព័ន្ធ <span class="text-[#4caf7c] font-semibold">ធនាគារ ចេនឡា</span>។
                        </p>
                    </div>
                </div>

                <div class="flex items-center gap-3 shrink-0">
                    <!-- Link to Create Customer Page -->
                    <a href="{{ route('customers.create') }}"
                       class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl text-xs sm:text-sm font-semibold text-white bg-[#4caf7c] hover:bg-[#3f996a] active:scale-[0.98] transition-all shadow-sm">
                        <i class="bi bi-plus-lg"></i>
                        <span>ចុះឈ្មោះអតិថិជនថ្មី</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Summary Metric Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            <div class="rounded-2xl bg-white border border-slate-200/80 p-5 shadow-[0_4px_20px_rgb(15,41,66,0.03)] flex flex-col justify-between relative overflow-hidden">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-semibold text-slate-500">អតិថិជនសរុប</span>
                    <div class="w-9 h-9 rounded-xl bg-[#193b52]/10 flex items-center justify-center text-[#193b52]">
                        <i class="bi bi-people-fill text-sm"></i>
                    </div>
                </div>
                <div class="my-3 flex items-baseline justify-between">
                    <div class="text-2xl font-extrabold text-[#142d42]">
                        {{ count($customers) }} <span class="text-xs font-normal text-slate-500">នាក់</span>
                    </div>
                    <span class="px-2.5 py-0.5 text-[11px] font-bold bg-[#4caf7c]/15 text-[#2e7d56] rounded-md">សកម្ម</span>
                </div>
                <div class="text-[11px] text-slate-400">ទិន្នន័យអតិថិជនក្នុងប្រព័ន្ធសរុប</div>
            </div>

            <div class="rounded-2xl bg-white border border-slate-200/80 p-5 shadow-[0_4px_20px_rgb(15,41,66,0.03)] flex flex-col justify-between">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-semibold text-slate-500">មានអត្តសញ្ញាណប័ណ្ណ</span>
                    <div class="w-9 h-9 rounded-xl bg-[#4caf7c]/15 flex items-center justify-center text-[#3f996a]">
                        <i class="bi bi-person-vcard text-sm"></i>
                    </div>
                </div>
                <div class="my-3 flex items-baseline justify-between">
                    <div class="text-2xl font-extrabold text-[#142d42]">
                        {{ $customers->whereNotNull('id_number')->count() }} <span class="text-xs font-normal text-slate-500">នាក់</span>
                    </div>
                    <span class="px-2.5 py-0.5 text-[11px] font-bold bg-[#4caf7c]/15 text-[#2e7d56] rounded-md">ផ្ទៀងផ្ទាត់រួច</span>
                </div>
                <div class="text-[11px] text-slate-400">អតិថិជនមានឯកសារសម្គាល់ខ្លួន</div>
            </div>

            <div class="rounded-2xl bg-white border border-slate-200/80 p-5 shadow-[0_4px_20px_rgb(15,41,66,0.03)] flex flex-col justify-between">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-semibold text-slate-500">អតិថិជននៅភ្នំពេញ</span>
                    <div class="w-9 h-9 rounded-xl bg-[#4caf7c]/15 flex items-center justify-center text-[#3f996a]">
                        <i class="bi bi-geo-alt text-sm"></i>
                    </div>
                </div>
                <div class="my-3 flex items-baseline justify-between">
                    <div class="text-2xl font-extrabold text-[#142d42]">
                        {{ $customers->where('pob', 'Phnom Penh')->count() }} <span class="text-xs font-normal text-slate-500">នាក់</span>
                    </div>
                    <span class="px-2.5 py-0.5 text-[11px] font-bold bg-slate-100 text-slate-600 rounded-md">រាជធានី</span>
                </div>
                <div class="text-[11px] text-slate-400">អាសយដ្ឋានក្នុងរាជធានីភ្នំពេញ</div>
            </div>

            <div class="rounded-2xl bg-white border border-slate-200/80 p-5 shadow-[0_4px_20px_rgb(15,41,66,0.03)] flex flex-col justify-between">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-semibold text-slate-500">តាមបណ្តាខេត្ត</span>
                    <div class="w-9 h-9 rounded-xl bg-amber-50 border border-amber-100 flex items-center justify-center text-amber-600">
                        <i class="bi bi-map text-sm"></i>
                    </div>
                </div>
                <div class="my-3 flex items-baseline justify-between">
                    <div class="text-2xl font-extrabold text-[#142d42]">
                        {{ $customers->whereNotNull('pob')->where('pob', '!=', 'Phnom Penh')->count() }} <span class="text-xs font-normal text-slate-500">នាក់</span>
                    </div>
                    <span class="px-2.5 py-0.5 text-[11px] font-bold bg-amber-50 text-amber-700 rounded-md">២៤ ខេត្ត</span>
                </div>
                <div class="text-[11px] text-slate-400">អតិថិជនមកពីបណ្តាខេត្តនានា</div>
            </div>
        </div>

        <!-- Alert Notifications -->
        @if(session('success'))
        <div x-data="{ show: true }" x-show="show" class="rounded-xl bg-[#4caf7c]/10 border border-[#4caf7c]/30 p-4 flex items-center justify-between text-[#142d42] shadow-sm">
            <div class="flex items-center gap-3">
                <i class="bi bi-check-circle-fill text-lg text-[#3f996a]"></i>
                <div>
                    <h3 class="font-bold text-xs sm:text-sm">ជោគជ័យ (Success)</h3>
                    <p class="text-xs text-slate-600">{{ session('success') }}</p>
                </div>
            </div>
            <button @click="show = false" class="text-slate-400 hover:text-slate-600"><i class="bi bi-x-lg"></i></button>
        </div>
        @endif

        <!-- Customer List Table -->
        <div class="rounded-2xl border border-slate-200/80 bg-white shadow-[0_8px_30px_rgb(15,41,66,0.04)] overflow-hidden">
            <div class="h-1 w-full bg-gradient-to-r from-[#142d42] via-[#1e5158] to-[#4caf7c]"></div>

            <!-- Table Header Filter Bar -->
            <div class="p-6 border-b border-slate-100 flex flex-col sm:flex-row sm:items-center justify-between gap-4 bg-white">
                <div>
                    <div class="flex items-center gap-2.5">
                        <h2 class="text-base sm:text-lg font-bold text-[#142d42]">បញ្ជីអតិថិជន</h2>
                        <span class="px-2.5 py-0.5 text-xs font-bold bg-[#4caf7c]/15 text-[#2e7d56] rounded-md">
                            {{ count($customers) }} នាក់
                        </span>
                    </div>
                    <p class="text-xs text-slate-400 mt-1">បញ្ជីព័ត៌មានលម្អិត និងអាសយដ្ឋានរបស់អតិថិជនទាំងអស់</p>
                </div>

                <!-- Instant Search Input -->
                <div class="relative w-full sm:w-80">
                    <i class="bi bi-search absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>
                    <input type="text" x-model="searchQuery" placeholder="ស្វែងរកតាមឈ្មោះ, លេខទូរស័ព្ទ, អត្តសញ្ញាណប័ណ្ណ..."
                        class="w-full pl-9 pr-4 py-2.5 rounded-xl bg-white border border-slate-200/90 focus:outline-none focus:border-[#4caf7c] focus:ring-2 focus:ring-[#4caf7c]/20 text-xs sm:text-sm text-slate-800 placeholder:text-slate-400 transition-all">
                </div>
            </div>

            <!-- Customer Table -->
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-slate-50/60 border-b border-slate-100 text-xs font-bold text-[#142d42]/70">
                        <tr>
                            <th class="px-6 py-4">លេខកូដ</th>
                            <th class="px-6 py-4">ឈ្មោះអតិថិជន</th>
                            <th class="px-6 py-4">ទំនាក់ទំនង</th>
                            <th class="px-6 py-4">អត្តសញ្ញាណប័ណ្ណ</th>
                            <th class="px-6 py-4">អាសយដ្ឋាន</th>
                            <th class="px-6 py-4 text-right">សកម្មភាព</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-sm bg-white">
                        @forelse($customers as $customer)
                        <tr class="hover:bg-slate-50/80 transition-colors group"
                            x-show="searchQuery === '' ||
                                    '{{ strtolower($customer->name) }}'.includes(searchQuery.toLowerCase()) ||
                                    '{{ $customer->phone }}'.includes(searchQuery) ||
                                    '{{ strtolower($customer->email ?? '') }}'.includes(searchQuery.toLowerCase()) ||
                                    '{{ strtolower($customer->id_number ?? '') }}'.includes(searchQuery.toLowerCase())">

                            <!-- ID Code -->
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="font-bold text-[#142d42] text-xs font-mono">
                                    #CUS-{{ str_pad($customer->id, 4, '0', STR_PAD_LEFT) }}
                                </span>
                            </td>

                            <!-- Customer Name -->
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-lg bg-[#193b52] text-white font-bold text-xs flex items-center justify-center shrink-0">
                                        {{ strtoupper(substr($customer->name, 0, 2)) }}
                                    </div>
                                    <div class="font-semibold text-[#142d42] group-hover:text-[#3f996a] transition-colors">
                                        {{ $customer->name }}
                                    </div>
                                </div>
                            </td>

                            <!-- Contact -->
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="font-semibold text-slate-700 text-xs">{{ $customer->phone }}</div>
                                <div class="text-[11px] text-slate-400">{{ $customer->email ?? 'មិនមានអ៊ីមែល' }}</div>
                            </td>

                            <!-- ID Card Badge -->
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($customer->id_number)
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md bg-[#4caf7c]/15 text-[#2e7d56] font-semibold text-xs">
                                        {{ $customer->id_number }}
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-md bg-slate-100 text-slate-500 text-xs">
                                        មិនមាន
                                    </span>
                                @endif
                            </td>

                            <!-- Address -->
                            <td class="px-6 py-4">
                                <span class="text-xs text-slate-500 leading-relaxed">
                                    @if(isset($customer->house_no) || isset($customer->street) || isset($customer->district) || isset($customer->pob))
                                        ផ្ទះ <span class="font-medium text-slate-700">{{ $customer->house_no ?? '-' }}</span>,
                                        ផ្លូវ <span class="font-medium text-slate-700">{{ $customer->street ?? '-' }}</span>,
                                        ខណ្ឌ <span class="font-medium text-slate-700">{{ $customer->district ?? '-' }}</span>
                                        @if($customer->pob)
                                            • <span class="text-[#3f996a] font-semibold">{{ $provinceMap[$customer->pob] ?? $customer->pob }}</span>
                                        @endif
                                    @else
                                        <span class="text-slate-400 italic">មិនទាន់មានទិន្នន័យ</span>
                                    @endif
                                </span>
                            </td>

                            <!-- Actions -->
                            <td class="px-6 py-4 whitespace-nowrap text-right">
                                <div class="flex justify-end gap-2">
                                    <a href="{{ route('customers.edit', $customer->id) }}"
                                       class="px-2.5 py-1.5 rounded-lg bg-white text-slate-600 hover:bg-slate-50 hover:text-[#142d42] border border-slate-200 transition-all inline-flex items-center gap-1 text-xs font-medium">
                                        <i class="bi bi-pencil-square"></i>
                                        <span>កែប្រែ</span>
                                    </a>

                                    <form method="POST" action="{{ route('customers.destroy', $customer->id) }}" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                onclick="return confirm('តើអ្នកពិតជាចង់លុបទិន្នន័យអតិថិជននេះមែនទេ?')"
                                                class="w-8 h-8 rounded-lg bg-white text-rose-600 hover:bg-rose-50 transition-all inline-flex items-center justify-center border border-slate-200 hover:border-rose-200">
                                            <i class="bi bi-trash text-xs"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="py-16 text-center text-slate-400 text-xs">
                                មិនមានទិន្នន័យអតិថិជនឡើយ
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Chhenla Bank Security Footer -->
        <div class="pt-4 pb-2 flex items-center justify-center gap-2 text-xs text-slate-400">
            <i class="bi bi-shield-check text-[#4caf7c] text-sm"></i>
            <span>© {{ date('Y') }} ធនាគារ ចេនឡា • ប្រព័ន្ធធនាគារមានសុវត្ថិភាព</span>
        </div>

    </div>
</div>
@endsection
@extends('layouts.master')

@section('title', 'ព័ត៌មានលម្អិតអតិថិជន | ធនាគារ ចេនឡា')

@section('content')

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
    <div class="relative z-10 max-w-5xl mx-auto space-y-6">

        {{-- TOP HEADER --}}
        <div class="rounded-sm bg-white border border-slate-200/80 shadow-[0_8px_30px_rgb(15,41,66,0.04)] overflow-hidden">
            <div class="h-1.5 w-full bg-gradient-to-r from-[#142d42] via-[#1e5158] to-[#4caf7c]"></div>

            <div class="p-6 flex flex-col md:flex-row md:items-center justify-between gap-4">
                <div class="flex items-start sm:items-center gap-4">
                    <!-- Brand Emblem -->
                    <div class="w-12 h-12 rounded-sm bg-[#193b52] text-white font-extrabold text-base flex items-center justify-center shrink-0 shadow-sm tracking-wider">
                        CH
                    </div>
                    <div>
                        <div class="flex items-center gap-2">
                            <h1 class="text-xl sm:text-2xl font-bold text-[#142d42] tracking-tight">
                                ព័ត៌មានលម្អិតអតិថិជន
                            </h1>
                            <span class="hidden sm:inline-block text-xs font-semibold text-slate-400 border-l border-slate-200 pl-2">
                                Chhenla Bank PLC.
                            </span>
                        </div>
                        <p class="text-xs sm:text-sm text-slate-500 mt-1">
                            ប្រវត្តិរូបផ្លូវការរបស់អតិថិជន រួមទាំងអត្តសញ្ញាណប័ណ្ណ កំណត់ត្រាគ្រួសារ និងព័ត៌មានធនាគារក្នុងប្រព័ន្ធ <span class="text-[#4caf7c] font-semibold">ធនាគារ ចេនឡា</span>។
                        </p>
                    </div>
                </div>

                <div class="flex flex-wrap items-center gap-3 shrink-0">
                    <a href="{{ route('customers.index') }}"
                       class="inline-flex items-center gap-2 px-4 py-2.5 rounded-sm text-xs sm:text-sm font-semibold bg-white border border-slate-300 text-[#142d42] hover:bg-[#142d42] hover:text-white hover:border-[#142d42] shadow-sm transition-all">
                        <i class="bi bi-arrow-left"></i>
                        <span>ត្រឡប់ទៅបញ្ជីអតិថិជន</span>
                    </a>

                    <button onclick="window.print()"
                            class="inline-flex items-center gap-2 px-5 py-2.5 rounded-sm text-xs sm:text-sm font-semibold text-white bg-[#4caf7c] hover:bg-[#3f996a] active:scale-[0.98] transition-all shadow-sm">
                        <i class="bi bi-printer-fill"></i>
                        <span>បោះពុម្ពឯកសារ</span>
                    </button>
                </div>
            </div>
        </div>

        {{-- MAIN PROFILE CARD --}}
        <div class="rounded-sm bg-white/95 backdrop-blur-md border border-slate-300 shadow-[0_10px_30px_rgb(20,45,66,0.07)] overflow-hidden">
            <div class="h-1 w-full bg-gradient-to-r from-[#142d42] via-[#1e5158] to-[#4caf7c]"></div>

            <div class="p-6 sm:p-10 flex flex-col lg:flex-row gap-8 items-center">

                {{-- PROFILE IMAGE --}}
                <div class="relative">
                    <div class="w-44 h-44 rounded-sm overflow-hidden border-4 border-slate-100 shadow-md">
                        @php
                            $profileImage = null;
                            if (!empty($item->id_photo) && file_exists(storage_path('app/public/' . $item->id_photo))) {
                                $profileImage = asset('storage/' . $item->id_photo);
                            } else {
                                $profileImage = 'https://ui-avatars.com/api/?name=' . urlencode($item->name) . '&background=142d42&color=fff&size=400';
                            }
                        @endphp
                        <img src="{{ $profileImage }}" class="w-full h-full object-cover" alt="រូបថតអតិថិជន">
                    </div>
                    <div class="absolute -bottom-3 left-1/2 -translate-x-1/2 px-4 py-1.5 rounded-sm bg-[#4caf7c] text-white text-[11px] font-bold uppercase tracking-wider shadow-sm">
                        គណនីសកម្ម
                    </div>
                </div>

                {{-- CUSTOMER INFO --}}
                <div class="flex-1">
                    <div class="flex flex-wrap items-center gap-3 mb-4">
                        <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-sm bg-[#193b52]/10 text-[#142d42] text-xs font-bold tracking-wide">
                            លេខកូដអតិថិជន : #CUS-{{ str_pad($item->id, 4, '0', STR_PAD_LEFT) }}
                        </span>
                        <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-sm bg-[#4caf7c]/15 text-[#2e7d56] text-xs font-bold tracking-wide">
                            <span class="w-1.5 h-1.5 bg-[#4caf7c]"></span>
                            បានផ្ទៀងផ្ទាត់
                        </span>
                    </div>

                    <h2 class="text-3xl sm:text-4xl font-extrabold text-[#142d42] tracking-tight">
                        {{ $item->name }}
                    </h2>

                    <p class="text-slate-500 text-sm mt-3 max-w-3xl">
                        ប្រវត្តិរូបអតិថិជនធនាគារដែលបានចុះឈ្មោះ ជាមួយការផ្ទៀងផ្ទាត់អត្តសញ្ញាណសុវត្ថិភាព និងកំណត់ត្រាគ្រួសារជាផ្លូវការ។
                    </p>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-8">

                        {{-- EMAIL --}}
                        <div class="rounded-sm bg-[#f4f8fa] border border-slate-200/80 p-4">
                            <div class="w-10 h-10 rounded-sm bg-[#193b52]/10 flex items-center justify-center text-[#142d42] mb-3">
                                <i class="bi bi-envelope-fill text-lg"></i>
                            </div>
                            <p class="text-slate-400 text-[11px] uppercase tracking-[0.15em] font-bold">
                                អាសយដ្ឋានអ៊ីមែល
                            </p>
                            <h3 class="text-[#142d42] font-bold mt-2 break-all text-sm">
                                {{ $item->email ?? 'មិនមានអ៊ីមែល' }}
                            </h3>
                        </div>

                        {{-- PHONE --}}
                        <div class="rounded-sm bg-[#f4f8fa] border border-slate-200/80 p-4">
                            <div class="w-10 h-10 rounded-sm bg-[#4caf7c]/15 flex items-center justify-center text-[#3f996a] mb-3">
                                <i class="bi bi-telephone-fill text-lg"></i>
                            </div>
                            <p class="text-slate-400 text-[11px] uppercase tracking-[0.15em] font-bold">
                                លេខទូរស័ព្ទ
                            </p>
                            <h3 class="text-[#142d42] font-bold mt-2 text-sm">
                                {{ $item->phone }}
                            </h3>
                        </div>

                        {{-- SECURITY --}}
                        <div class="rounded-sm bg-[#f4f8fa] border border-slate-200/80 p-4">
                            <div class="w-10 h-10 rounded-sm bg-[#1e5158]/10 flex items-center justify-center text-[#1e5158] mb-3">
                                <i class="bi bi-shield-lock-fill text-lg"></i>
                            </div>
                            <p class="text-slate-400 text-[11px] uppercase tracking-[0.15em] font-bold">
                                ស្ថានភាពសុវត្ថិភាព
                            </p>
                            <h3 class="text-[#2e7d56] font-bold mt-2 text-sm">
                                មានការការពារ
                            </h3>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        {{-- DOCUMENT GRID --}}
        <div class="grid grid-cols-1 xl:grid-cols-2 gap-6">

            {{-- ID CARD --}}
            <div class="rounded-sm bg-white/95 backdrop-blur-md border border-slate-300 shadow-[0_10px_30px_rgb(20,45,66,0.07)] overflow-hidden">
                <div class="h-1 w-full bg-gradient-to-r from-[#142d42] to-[#1e5158]"></div>

                <div class="px-6 py-5 border-b border-slate-100 flex items-center justify-between bg-[#f4f8fa]/50">
                    <div>
                        <p class="text-[#1e5158] text-[11px] uppercase tracking-[0.15em] font-bold">
                            អត្តសញ្ញាណជាតិ
                        </p>
                        <h2 class="text-lg font-bold text-[#142d42] mt-1">
                            អត្តសញ្ញាណប័ណ្ណខ្មែរ
                        </h2>
                    </div>
                    <div class="w-12 h-12 rounded-sm bg-[#193b52]/10 flex items-center justify-center text-[#142d42]">
                        <i class="bi bi-person-vcard-fill text-xl"></i>
                    </div>
                </div>

                <div class="p-6 space-y-6">

                    {{-- ID IMAGE --}}
                    <div class="flex justify-center">
                        @php
                            $idImage = null;
                            if (!empty($item->id_photo) && file_exists(storage_path('app/public/' . $item->id_photo))) {
                                $idImage = asset('storage/' . $item->id_photo);
                            } else {
                                $idImage = 'https://placehold.co/600x380/f4f8fa/475569?text=មិនទាន់មានរូបអត្តសញ្ញាណប័ណ្ណ';
                            }
                        @endphp
                        <div class="w-full max-w-md aspect-[1.586/1] rounded-sm overflow-hidden border-2 border-slate-200 shadow-sm bg-[#f4f8fa]">
                            <img src="{{ $idImage }}" class="w-full h-full object-cover" alt="រូបថតអត្តសញ្ញាណប័ណ្ណ">
                        </div>
                    </div>

                    <div class="space-y-4">
                        <div class="grid grid-cols-2 gap-4">
                            <div class="rounded-sm bg-[#f4f8fa] border border-slate-200/80 p-4">
                                <p class="text-slate-400 text-[11px] uppercase tracking-[0.15em] font-bold">
                                    លេខអត្តសញ្ញាណប័ណ្ណ
                                </p>
                                <h3 class="text-[#142d42] text-base font-bold mt-2">
                                    {{ $item->id_number ?? 'មិនមាន' }}
                                </h3>
                            </div>

                            <div class="rounded-sm bg-[#f4f8fa] border border-slate-200/80 p-4">
                                <p class="text-slate-400 text-[11px] uppercase tracking-[0.15em] font-bold">
                                    ភេទ
                                </p>
                                <h3 class="text-[#142d42] text-base font-bold mt-2">
                                    {{ $item->gender ?? 'មិនមាន' }}
                                </h3>
                            </div>
                        </div>

                        <div class="rounded-sm bg-[#f4f8fa] border border-slate-200/80 p-4">
                            <p class="text-slate-400 text-[11px] uppercase tracking-[0.15em] font-bold">
                                ថ្ងៃខែឆ្នាំកំណើត
                            </p>
                            <h3 class="text-[#142d42] text-base font-bold mt-2">
                                {{ $item->dob ?? 'មិនមាន' }}
                            </h3>
                        </div>

                        <div class="rounded-sm bg-[#f4f8fa] border border-slate-200/80 p-4">
                            <p class="text-slate-400 text-[11px] uppercase tracking-[0.15em] font-bold">
                                ទីកន្លែងកំណើត
                            </p>
                            <h3 class="text-[#142d42] text-base font-bold mt-2 leading-relaxed">
                                {{ $item->pob ?? 'មិនមាន' }}
                            </h3>
                        </div>
                    </div>
                </div>
            </div>

            {{-- FAMILY BOOK --}}
            <div class="rounded-sm bg-white/95 backdrop-blur-md border border-slate-300 shadow-[0_10px_30px_rgb(20,45,66,0.07)] overflow-hidden">
                <div class="h-1 w-full bg-gradient-to-r from-[#1e5158] to-[#4caf7c]"></div>

                <div class="px-6 py-5 border-b border-slate-100 flex items-center justify-between bg-[#f4f8fa]/50">
                    <div>
                        <p class="text-[#1e5158] text-[11px] uppercase tracking-[0.15em] font-bold">
                            កំណត់ត្រាគ្រួសារ
                        </p>
                        <h2 class="text-lg font-bold text-[#142d42] mt-1">
                            សៀវភៅគ្រួសារ
                        </h2>
                    </div>
                    <div class="w-12 h-12 rounded-sm bg-[#1e5158]/10 flex items-center justify-center text-[#1e5158]">
                        <i class="bi bi-book-fill text-xl"></i>
                    </div>
                </div>

                <div class="p-6 space-y-6">

                    {{-- FAMILY IMAGE --}}
                    @php
                        $familyImage = null;
                        if (!empty($item->family_photo) && file_exists(storage_path('app/public/' . $item->family_photo))) {
                            $familyImage = asset('storage/' . $item->family_photo);
                        } else {
                            $familyImage = 'https://placehold.co/800x500/f4f8fa/475569?text=មិនទាន់មានរូបសៀវភៅគ្រួសារ';
                        }
                    @endphp

                    <div class="rounded-sm overflow-hidden border border-slate-200 shadow-sm bg-[#f4f8fa]">
                        <img src="{{ $familyImage }}" class="w-full h-64 object-cover" alt="រូបថតសៀវភៅគ្រួសារ">
                    </div>

                    {{-- ADDRESS --}}
                    <div class="rounded-sm bg-[#f4f8fa] border border-slate-200/80 p-5">
                        <p class="text-[#1e5158] text-[11px] uppercase tracking-[0.15em] font-bold mb-3">
                            អាសយដ្ឋានស្នាក់នៅ
                        </p>
                        <h3 class="text-[#142d42] text-base font-bold leading-relaxed">
                            @if($item->house_no || $item->street || $item->district)
                                ផ្ទះ {{ $item->house_no }},
                                ផ្លូវ {{ $item->street }},
                                {{ $item->district }}
                            @else
                                <span class="text-slate-400 italic">មិនទាន់មានព័ត៌មានអាសយដ្ឋាន</span>
                            @endif
                        </h3>
                    </div>

                    {{-- FAMILY TABLE --}}
                    <div class="rounded-sm overflow-hidden border border-slate-200 shadow-sm">
                        <table class="w-full">
                            <thead class="bg-[#f4f8fa] border-b border-slate-200">
                                <tr>
                                    <th class="px-5 py-3.5 text-left text-slate-500 text-[11px] uppercase tracking-[0.15em] font-bold">
                                        ទំនាក់ទំនង
                                    </th>
                                    <th class="px-5 py-3.5 text-left text-slate-500 text-[11px] uppercase tracking-[0.15em] font-bold">
                                        ឈ្មោះពេញ
                                    </th>
                                    <th class="px-5 py-3.5 text-left text-slate-500 text-[11px] uppercase tracking-[0.15em] font-bold">
                                        មុខរបរ
                                    </th>
                                </tr>
                            </thead>

                            <tbody class="divide-y divide-slate-100 bg-white">
                                <tr class="hover:bg-[#f4f8fa]/60 transition-colors">
                                    <td class="px-5 py-3.5 text-slate-500 font-semibold text-sm">
                                        មេគ្រួសារ
                                    </td>
                                    <td class="px-5 py-3.5 text-[#142d42] font-bold text-sm">
                                        {{ $item->name }}
                                    </td>
                                    <td class="px-5 py-3.5 text-slate-600 text-sm">
                                        {{ $item->job ?? 'ពាណិជ្ជករ' }}
                                    </td>
                                </tr>

                                @if(isset($item->family_members) && is_iterable($item->family_members))
                                    @foreach($item->family_members as $member)
                                        <tr class="hover:bg-[#f4f8fa]/60 transition-colors">
                                            <td class="px-5 py-3.5 text-slate-500 text-sm">
                                                {{ $member->relation }}
                                            </td>
                                            <td class="px-5 py-3.5 text-[#142d42] font-semibold text-sm">
                                                {{ $member->name }}
                                            </td>
                                            <td class="px-5 py-3.5 text-slate-600 text-sm">
                                                {{ $member->job }}
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>

        </div>

        <!-- Chhenla Bank Security Footer -->
        <div class="pt-2 pb-4 flex items-center justify-center gap-2 text-xs text-[#1e5158]/80 font-medium">
            <i class="bi bi-shield-lock-fill text-[#4caf7c] text-sm"></i>
            <span>© {{ date('Y') }} ធនាគារ ចេនឡា (Chhenla Bank PLC.) • ប្រព័ន្ធធនាគារមានសុវត្ថិភាព និងទំនុកចិត្តខ្ពស់</span>
        </div>

    </div>
</div>

<style>
    @media print {
        body {
            background: white !important;
            color: black !important;
        }

        a,
        button {
            display: none !important;
        }

        .shadow-md,
        .shadow-lg,
        .shadow-sm {
            box-shadow: none !important;
        }

        .border,
        .border-slate-200,
        .border-slate-300 {
            border-color: #cbd5e1 !important;
        }

        .bg-\[\#f4f8fa\],
        .bg-\[\#f4f8fa\]\/50,
        .bg-white\/95 {
            background: transparent !important;
        }

        .text-\[\#142d42\],
        .text-\[\#193b52\] {
            color: #000000 !important;
        }

        .text-slate-500,
        .text-slate-400 {
            color: #475569 !important;
        }

        .pointer-events-none.fixed {
            display: none !important;
        }
    }
</style>

@endsection

@extends('layouts.master')

@section('header_title', 'ព័ត៌មានរូបរាងកាយ (User Profile)')
@section('title', 'ប្រវត្តិរូបអ្នកប្រើប្រាស់ | ' . ($user->name ?? 'User Profile'))

@section('content')

@php
    /*
    |--------------------------------------------------------------------------
    | USER ROLE & METADATA
    |--------------------------------------------------------------------------
    */
    $role = (int) ($user->role ?? 0);

    $roleName = match ($role) {
        1 => 'Super Admin',
        2 => 'Branch Manager',
        3 => 'Staff',
        default => 'User',
    };

    $roleNameKhmer = match ($role) {
        1 => 'អ្នកគ្រប់គ្រងប្រព័ន្ធ (Admin)',
        2 => 'អ្នកគ្រប់គ្រងសាខា (Manager)',
        3 => 'បុគ្គលិកប្រតិបត្តិការ (Staff)',
        default => 'អ្នកប្រើប្រាស់ (User)',
    };

    $isAdmin = $role === 1 || (method_exists($user, 'isAdmin') && $user->isAdmin());

    // Role theme styling (Brand-aligned: Navy, Teal, Emerald, Gold)
    $roleBadge = match ($role) {
        1 => [
            'badge' => 'bg-amber-50 text-amber-700 border-amber-200 ring-1 ring-amber-300/40',
            'dot'   => 'bg-amber-500',
            'icon'  => 'bi-shield-shaded text-amber-600',
            'title' => 'អ្នកគ្រប់គ្រងប្រព័ន្ធពេញលេញ (Super Admin)',
        ],
        2 => [
            'badge' => 'bg-[#0F4C5C]/10 text-[#0F4C5C] border-[#0F4C5C]/30 ring-1 ring-[#0F4C5C]/20',
            'dot'   => 'bg-[#0F4C5C]',
            'icon'  => 'bi-person-badge-fill text-[#0F4C5C]',
            'title' => 'អ្នកគ្រប់គ្រងសាខា (Branch Manager)',
        ],
        3 => [
            'badge' => 'bg-emerald-50 text-emerald-700 border-emerald-200 ring-1 ring-emerald-300/40',
            'dot'   => 'bg-emerald-500',
            'icon'  => 'bi-person-workspace text-emerald-600',
            'title' => 'បុគ្គលិកប្រតិបត្តិការ (Staff Member)',
        ],
        default => [
            'badge' => 'bg-slate-100 text-slate-700 border-slate-200 ring-1 ring-slate-200',
            'dot'   => 'bg-slate-400',
            'icon'  => 'bi-person-fill text-slate-500',
            'title' => 'អ្នកប្រើប្រាស់ទូទៅ (User)',
        ],
    };

    // User Avatar with smart fallback
    $avatar = $user->avatar_url ?? (!empty($user->avatar) ? asset('storage/' . ltrim($user->avatar, '/')) : asset('images/default-avatar.png'));
    $fallbackAvatar = 'https://ui-avatars.com/api/?name=' . urlencode($user->name ?? 'User') . '&background=0F4C5C&color=ffffff&bold=true';
    $userIdFormatted = '#USR-' . str_pad($user->id ?? 1, 5, '0', STR_PAD_LEFT);
@endphp

<div class="py-6 px-3 sm:px-6 lg:px-8 space-y-6 max-w-6xl mx-auto">

    {{-- SUCCESS ALERT --}}
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

    {{-- ============================================================== --}}
    {{-- MAIN PROFILE CARD                                              --}}
    {{-- ============================================================== --}}
    <div class="bg-white rounded-3xl border border-slate-200/90 shadow-sm overflow-hidden">

        {{-- TOP ACCENT STRIP --}}
        <div class="h-1.5 w-full bg-gradient-to-r from-[#0B2B40] via-[#0F4C5C] to-[#10B981]"></div>

        {{-- 1. COVER BANNER (PURE BACKGROUND & METADATA CHIPS) --}}
        <div class="h-40 sm:h-48 bg-gradient-to-r from-[#0B2B40] via-[#0F4C5C] to-[#134E5E] relative overflow-hidden">
            
            {{-- Geometric Dot Pattern --}}
            <div class="absolute inset-0 bg-[radial-gradient(#10B981_1px,transparent_1px)] [background-size:20px_20px] opacity-15"></div>

            {{-- Ambient Radial Glows --}}
            <div class="absolute -top-12 -right-12 w-72 h-72 rounded-full bg-[#10B981]/20 blur-3xl pointer-events-none"></div>
            <div class="absolute -bottom-16 left-1/4 w-64 h-64 rounded-full bg-amber-400/10 blur-2xl pointer-events-none"></div>

            {{-- Bank Shield Watermark --}}
            <div class="absolute right-6 sm:right-10 top-1/2 -translate-y-1/2 select-none pointer-events-none text-white/10">
                <i class="bi bi-shield-lock-fill text-8xl sm:text-9xl"></i>
            </div>

            {{-- Brand Badge on Top-Left --}}
            <div class="absolute top-4 left-5 sm:left-7 flex items-center gap-2 px-3 py-1.5 rounded-full bg-black/20 backdrop-blur-md border border-white/15 text-white/95 text-[11px] font-semibold tracking-wider uppercase">
                <span class="w-2 h-2 rounded-full bg-[#10B981] animate-pulse"></span>
                <span>CHHENLA BANK &bull; SECURE USER IDENTITY</span>
            </div>

            {{-- ID Chip on Top-Right --}}
            <div class="absolute top-4 right-5 sm:right-7 flex items-center gap-2 px-3 py-1.5 rounded-full bg-black/30 backdrop-blur-md border border-white/15 text-white/95 text-xs font-mono font-bold tracking-wider">
                <i class="bi bi-fingerprint text-amber-400"></i>
                <span>{{ $userIdFormatted }}</span>
            </div>

        </div>

        {{-- 2. WHITE CARD BODY WITH PROPER VERTICAL HIERARCHY --}}
        <div class="px-6 sm:px-8 lg:px-10 pb-8 pt-0">

            {{-- AVATAR & ACTION BUTTONS ROW --}}
            <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-5 -mt-14 sm:-mt-16 mb-5">
                
                {{-- AVATAR CONTAINER (OVERLAPS BANNER SAFELY) --}}
                <div class="relative w-28 h-28 sm:w-32 sm:h-32 rounded-3xl overflow-hidden border-4 border-white shadow-xl bg-slate-100 ring-1 ring-slate-200/80 shrink-0">
                    <img
                        src="{{ $avatar }}"
                        alt="{{ $user->name ?? 'User' }}"
                        class="w-full h-full object-cover"
                        onerror="this.onerror=null; this.src='{{ $fallbackAvatar }}';"
                    >
                    {{-- Active status indicator --}}
                    <div
                        class="absolute bottom-1 right-1 w-5 h-5 rounded-full bg-emerald-500 border-2 border-white shadow-sm flex items-center justify-center"
                        title="Active Session">
                        <span class="w-1.5 h-1.5 rounded-full bg-white animate-pulse"></span>
                    </div>
                </div>

                {{-- ACTION BUTTONS (CLEANLY POSITIONED IN THE WHITE AREA) --}}
                <div class="flex flex-wrap items-center gap-2.5">
                    
                    {{-- Edit Profile Button --}}
                    <a
                        href="{{ route('profile.edit') }}"
                        class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-[#0F4C5C] text-xs font-bold text-white hover:bg-[#0B2B40] transition-all shadow-xs active:scale-[0.98]"
                    >
                        <i class="bi bi-pencil-fill text-xs"></i>
                        <span>កែប្រែប្រវត្តិរូប (Edit)</span>
                    </a>

                    {{-- Admin Dashboard (if admin) --}}
                    @if($isAdmin && Route::has('user.Home'))
                        <a
                            href="{{ route('user.Home') }}"
                            class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-amber-500 text-xs font-bold text-white hover:bg-amber-600 transition-all shadow-xs active:scale-[0.98]"
                        >
                            <i class="bi bi-speedometer2 text-xs"></i>
                            <span>ផ្ទាំងគ្រប់គ្រង (Dashboard)</span>
                        </a>
                    @endif

                    {{-- Print Button --}}
                    <button
                        type="button"
                        onclick="window.print()"
                        class="inline-flex items-center gap-1.5 px-3.5 py-2.5 rounded-xl border border-slate-200 bg-white text-xs font-bold text-slate-700 hover:bg-slate-50 transition-all shadow-2xs"
                        title="បោះពុម្ព (Print)"
                    >
                        <i class="bi bi-printer text-xs"></i>
                        <span>បោះពុម្ព</span>
                    </button>

                    {{-- Back Button --}}
                    <a
                        href="{{ url()->previous() }}"
                        class="inline-flex items-center gap-1.5 px-3.5 py-2.5 rounded-xl border border-slate-200 bg-white text-xs font-bold text-slate-600 hover:bg-slate-50 transition-all shadow-2xs"
                    >
                        <i class="bi bi-arrow-left text-xs"></i>
                        <span>ត្រឡប់ក្រោយ</span>
                    </a>

                </div>

            </div>

            {{-- USER DETAILS (100% ON WHITE BACKGROUND: CRYSTAL CLEAR READABILITY) --}}
            <div class="space-y-2.5 pb-6 border-b border-slate-100">
                
                {{-- Name + Verified + Role Badge --}}
                <div class="flex flex-wrap items-center gap-3">
                    <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">
                        {{ $user->name ?? 'User' }}
                    </h1>

                    <span title="Verified Account" class="inline-flex text-emerald-500 text-lg">
                        <i class="bi bi-patch-check-fill"></i>
                    </span>

                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold border {{ $roleBadge['badge'] }}">
                        <span class="w-1.5 h-1.5 rounded-full {{ $roleBadge['dot'] }}"></span>
                        <span>{{ $roleName }}</span>
                    </span>
                </div>

                {{-- Contact & Meta Info --}}
                <div class="flex flex-wrap items-center gap-4 text-xs font-medium text-slate-500">
                    
                    {{-- Email with Copy Button --}}
                    <span 
                        class="inline-flex items-center gap-1.5 hover:text-[#0F4C5C] transition-colors cursor-pointer"
                        onclick="navigator.clipboard.writeText('{{ $user->email }}'); alert('បានចម្លងអ៊ីមែល៖ {{ $user->email }}');"
                        title="ចុចដើម្បីចម្លងអ៊ីមែល"
                    >
                        <i class="bi bi-envelope text-slate-400"></i>
                        <span>{{ $user->email ?? 'មិនមានអ៊ីមែល' }}</span>
                        <i class="bi bi-copy text-[10px] text-slate-400"></i>
                    </span>

                    {{-- Phone (if available) --}}
                    @if(!empty($user->phone))
                        <span class="inline-flex items-center gap-1.5 text-slate-500">
                            <i class="bi bi-telephone text-slate-400"></i>
                            <span>{{ $user->phone }}</span>
                        </span>
                    @endif

                    {{-- Registration Date --}}
                    <span class="inline-flex items-center gap-1.5 text-slate-400">
                        <i class="bi bi-calendar3 text-slate-400"></i>
                        <span>កាលបរិច្ឆេទចុះឈ្មោះ៖</span>
                        <span class="text-slate-700 font-semibold">
                            {{ $user->created_at ? $user->created_at->format('d M, Y') : 'N/A' }}
                        </span>
                        @if($user->created_at)
                            <span>({{ $user->created_at->diffForHumans() }})</span>
                        @endif
                    </span>

                </div>

            </div>

            {{-- 3. 4 KEY METRIC / STAT CARDS --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mt-6">

                {{-- STAT 1: ACCOUNT STATUS --}}
                <div class="bg-slate-50/70 hover:bg-white border border-slate-200/80 hover:border-emerald-300/80 rounded-2xl p-4 transition-all duration-200 shadow-2xs hover:shadow-xs group">
                    <div class="flex items-center justify-between gap-2 mb-2">
                        <span class="text-xs font-semibold text-slate-500 truncate leading-normal">
                            ស្ថានភាពគណនី
                        </span>
                        <div class="w-8 h-8 rounded-xl bg-emerald-500/10 text-emerald-600 border border-emerald-500/20 flex items-center justify-center shrink-0 text-sm">
                            <i class="bi bi-shield-check"></i>
                        </div>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-emerald-500 shrink-0 animate-pulse"></span>
                        <h3 class="text-sm font-bold text-slate-800 truncate">
                            ដំណើរការសកម្ម
                        </h3>
                        <span class="text-[11px] font-semibold text-emerald-600 bg-emerald-50 px-1.5 py-0.5 rounded-md border border-emerald-200/60 shrink-0">
                            Active
                        </span>
                    </div>
                    <p class="text-[11px] font-medium text-slate-400 mt-1 truncate">
                        បានផ្ទៀងផ្ទាត់ក្នុងប្រព័ន្ធ
                    </p>
                </div>

                {{-- STAT 2: ROLE LEVEL --}}
                <div class="bg-slate-50/70 hover:bg-white border border-slate-200/80 hover:border-[#0F4C5C]/40 rounded-2xl p-4 transition-all duration-200 shadow-2xs hover:shadow-xs group">
                    <div class="flex items-center justify-between gap-2 mb-2">
                        <span class="text-xs font-semibold text-slate-500 truncate leading-normal">
                            តួនាទី និងសិទ្ធិ
                        </span>
                        <div class="w-8 h-8 rounded-xl bg-[#0F4C5C]/10 text-[#0F4C5C] border border-[#0F4C5C]/20 flex items-center justify-center shrink-0 text-sm">
                            <i class="bi bi-person-badge-fill"></i>
                        </div>
                    </div>
                    <h3 class="text-sm font-bold text-slate-800 truncate" title="{{ $roleNameKhmer }}">
                        {{ $roleNameKhmer }}
                    </h3>
                    <p class="text-[11px] font-medium text-slate-400 mt-1 truncate">
                        កម្រិតសិទ្ធិ Level {{ $role }} &bull; {{ $roleName }}
                    </p>
                </div>

                {{-- STAT 3: MEMBERSHIP --}}
                <div class="bg-slate-50/70 hover:bg-white border border-slate-200/80 hover:border-amber-300/80 rounded-2xl p-4 transition-all duration-200 shadow-2xs hover:shadow-xs group">
                    <div class="flex items-center justify-between gap-2 mb-2">
                        <span class="text-xs font-semibold text-slate-500 truncate leading-normal">
                            កាលបរិច្ឆេទចុះឈ្មោះ
                        </span>
                        <div class="w-8 h-8 rounded-xl bg-amber-500/10 text-amber-600 border border-amber-500/20 flex items-center justify-center shrink-0 text-sm">
                            <i class="bi bi-calendar3"></i>
                        </div>
                    </div>
                    <h3 class="text-sm font-bold text-slate-800 truncate">
                        {{ $user->created_at ? $user->created_at->format('d M, Y') : 'ថ្មីៗនេះ' }}
                    </h3>
                    <p class="text-[11px] font-medium text-slate-400 mt-1 truncate">
                        {{ $user->created_at ? 'សមាជិក ' . $user->created_at->diffForHumans() : 'សមាជិកថ្មី' }}
                    </p>
                </div>

                {{-- STAT 4: SECURITY --}}
                <div class="bg-slate-50/70 hover:bg-white border border-slate-200/80 hover:border-sky-300/80 rounded-2xl p-4 transition-all duration-200 shadow-2xs hover:shadow-xs group">
                    <div class="flex items-center justify-between gap-2 mb-2">
                        <span class="text-xs font-semibold text-slate-500 truncate leading-normal">
                            សុវត្ថិភាពទិន្នន័យ
                        </span>
                        <div class="w-8 h-8 rounded-xl bg-sky-500/10 text-sky-600 border border-sky-500/20 flex items-center justify-center shrink-0 text-sm">
                            <i class="bi bi-shield-lock-fill"></i>
                        </div>
                    </div>
                    <h3 class="text-sm font-bold text-slate-800 truncate">
                        SSL 256-Bit Encrypted
                    </h3>
                    <p class="text-[11px] font-medium text-slate-400 mt-1 truncate">
                        ការការពារសុវត្ថិភាពកម្រិតខ្ពស់
                    </p>
                </div>

            </div>

        </div>

    </div>

    {{-- ============================================================== --}}
    {{-- TWO-COLUMN CONTENT GRID                                        --}}
    {{-- ============================================================== --}}
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">

        {{-- LEFT COLUMN: ACCOUNT DETAILS & BIO (7 COLS) --}}
        <div class="lg:col-span-7 space-y-6">

            {{-- ACCOUNT INFORMATION CARD --}}
            <div class="bg-white rounded-3xl border border-slate-200/90 shadow-sm p-6 sm:p-7">
                
                {{-- Card Header --}}
                <div class="flex items-center justify-between pb-4 border-b border-slate-100 mb-5">
                    <div class="flex items-center gap-3">
                        <div class="w-9 h-9 rounded-xl bg-[#0F4C5C]/10 text-[#0F4C5C] flex items-center justify-center shrink-0">
                            <i class="bi bi-person-lines-fill text-base"></i>
                        </div>
                        <div>
                            <h2 class="text-sm sm:text-base font-bold text-slate-900">
                                ព័ត៌មានលម្អិតគណនី (Account Details)
                            </h2>
                            <p class="text-xs text-slate-400">
                                ព័ត៌មានអត្តសញ្ញាណ និងទំនាក់ទំនងក្នុងប្រព័ន្ធធនាគារ
                            </p>
                        </div>
                    </div>

                    <a href="{{ route('profile.edit') }}" class="text-xs font-bold text-[#0F4C5C] hover:text-[#0B2B40] transition-colors flex items-center gap-1">
                        <i class="bi bi-pencil text-[11px]"></i>
                        <span>កែប្រែ</span>
                    </a>
                </div>

                {{-- Key-Value Grid --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3.5">

                    {{-- Full Name --}}
                    <div class="bg-slate-50/70 border border-slate-200/70 rounded-2xl p-4">
                        <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block mb-1">
                            ឈ្មោះពេញ (Full Name)
                        </span>
                        <div class="flex items-center gap-2">
                            <i class="bi bi-person text-slate-400 text-sm"></i>
                            <span class="text-sm font-bold text-slate-800">
                                {{ $user->name ?? 'N/A' }}
                            </span>
                        </div>
                    </div>

                    {{-- Account ID --}}
                    <div class="bg-slate-50/70 border border-slate-200/70 rounded-2xl p-4">
                        <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block mb-1">
                            លេខសម្គាល់ (Account ID)
                        </span>
                        <div class="flex items-center gap-2">
                            <i class="bi bi-upc-scan text-[#0F4C5C] text-sm"></i>
                            <span class="text-sm font-bold font-mono text-[#0F4C5C]">
                                {{ $userIdFormatted }}
                            </span>
                        </div>
                    </div>

                    {{-- Email Address --}}
                    <div class="bg-slate-50/70 border border-slate-200/70 rounded-2xl p-4 sm:col-span-2">
                        <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block mb-1">
                            អាសយដ្ឋានអ៊ីមែល (Email Address)
                        </span>
                        <div class="flex items-center justify-between gap-2">
                            <div class="flex items-center gap-2 overflow-hidden">
                                <i class="bi bi-envelope text-slate-400 text-sm shrink-0"></i>
                                <span class="text-sm font-bold text-slate-800 truncate">
                                    {{ $user->email ?? 'N/A' }}
                                </span>
                            </div>
                            <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200 shrink-0">
                                <i class="bi bi-shield-check"></i>
                                <span>Verified</span>
                            </span>
                        </div>
                    </div>

                    {{-- Phone Number --}}
                    <div class="bg-slate-50/70 border border-slate-200/70 rounded-2xl p-4">
                        <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block mb-1">
                            លេខទូរស័ព្ទ (Phone Number)
                        </span>
                        <div class="flex items-center gap-2">
                            <i class="bi bi-phone text-slate-400 text-sm"></i>
                            <span class="text-sm font-bold text-slate-800">
                                {{ $user->phone ?? 'មិនទាន់បានបញ្ចូល' }}
                            </span>
                        </div>
                    </div>

                    {{-- Created At --}}
                    <div class="bg-slate-50/70 border border-slate-200/70 rounded-2xl p-4">
                        <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block mb-1">
                            កាលបរិច្ឆេទបង្កើត (Created At)
                        </span>
                        <div class="flex items-center gap-2">
                            <i class="bi bi-calendar3 text-slate-400 text-sm"></i>
                            <span class="text-sm font-semibold text-slate-800">
                                {{ $user->created_at ? $user->created_at->format('d/m/Y H:i') : 'N/A' }}
                            </span>
                        </div>
                    </div>

                </div>

            </div>

            {{-- BIO / NOTES CARD --}}
            <div class="bg-white rounded-3xl border border-slate-200/90 shadow-sm p-6 sm:p-7">
                <div class="flex items-center gap-3 pb-3 border-b border-slate-100 mb-4">
                    <div class="w-9 h-9 rounded-xl bg-amber-500/10 text-amber-600 flex items-center justify-center shrink-0">
                        <i class="bi bi-card-text text-base"></i>
                    </div>
                    <div>
                        <h3 class="text-sm sm:text-base font-bold text-slate-900">
                            ពិពណ៌នាអំពីអ្នក (Bio & Notes)
                        </h3>
                        <p class="text-xs text-slate-400">ព័ត៌មានបន្ថែម ឬកំណត់ចំណាំផ្ទាល់ខ្លួន</p>
                    </div>
                </div>

                @if(!empty($user->bio))
                    <div class="rounded-2xl bg-slate-50/80 border border-slate-200/70 p-4.5 text-slate-700 text-xs sm:text-sm leading-relaxed relative">
                        <i class="bi bi-quote text-3xl text-slate-300 absolute top-2 right-4 pointer-events-none"></i>
                        {{ $user->bio }}
                    </div>
                @else
                    <div class="rounded-2xl border border-dashed border-slate-200 p-5 text-center">
                        <i class="bi bi-chat-square-text text-2xl text-slate-300 mb-1.5 block"></i>
                        <p class="text-xs font-semibold text-slate-600">មិនទាន់មានការពិពណ៌នាអំពីអ្នកនៅឡើយទេ</p>
                        <p class="text-[11px] text-slate-400 mt-0.5">អ្នកអាចបន្ថែមជីវប្រវត្តិសង្ខេប ឬកំណត់ត្រាការងាររបស់អ្នកនៅទំព័រកែប្រែព័ត៌មាន។</p>
                        <a href="{{ route('profile.edit') }}" class="inline-flex items-center gap-1.5 text-xs font-bold text-[#0F4C5C] hover:underline mt-2.5">
                            <i class="bi bi-plus-circle text-xs"></i>
                            <span>បន្ថែមព័ត៌មានពិពណ៌នា</span>
                        </a>
                    </div>
                @endif
            </div>

        </div>

        {{-- RIGHT COLUMN: ROLE PRIVILEGES & SECURITY (5 COLS) --}}
        <div class="lg:col-span-5 space-y-6">

            {{-- ROLE PRIVILEGES CARD --}}
            <div class="bg-white rounded-3xl border border-slate-200/90 shadow-sm p-6 sm:p-7">
                
                {{-- Role Header --}}
                <div class="flex items-center gap-3 pb-4 border-b border-slate-100 mb-4">
                    <div class="w-9 h-9 rounded-xl {{ $role === 1 ? 'bg-amber-500/10 text-amber-600' : ($role === 2 ? 'bg-[#0F4C5C]/10 text-[#0F4C5C]' : 'bg-emerald-500/10 text-emerald-600') }} flex items-center justify-center shrink-0">
                        <i class="bi {{ $roleBadge['icon'] }} text-base"></i>
                    </div>
                    <div>
                        <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block">កម្រិតសិទ្ធិប្រើប្រាស់</span>
                        <h3 class="text-sm sm:text-base font-bold text-slate-900">
                            {{ $roleNameKhmer }}
                        </h3>
                    </div>
                </div>

                {{-- Role Details based on user role --}}
                @if($role === 1)
                    {{-- ADMIN --}}
                    <div class="rounded-2xl border border-amber-500/20 bg-amber-500/5 p-4 mb-4">
                        <div class="flex items-center gap-2 text-amber-800 font-bold text-xs uppercase tracking-wider mb-1.5">
                            <i class="bi bi-shield-lock-fill text-amber-600"></i>
                            <span>សិទ្ធិគ្រប់គ្រងប្រព័ន្ធពេញលេញ (SUPER ADMIN)</span>
                        </div>
                        <p class="text-slate-600 text-xs leading-relaxed">
                            អ្នកមានសិទ្ធិពេញលេញក្នុងការគ្រប់គ្រងគណនីប្រព័ន្ធ គ្រប់គ្រងបុគ្គលិក កែប្រែទិន្នន័យកម្ចី ពិនិត្យរបាយការណ៍ហិរញ្ញវត្ថុ និងត្រួតពិនិត្យកំណត់ត្រាប្រតិបត្តិការ Audit Logs។
                        </p>
                    </div>

                    <div class="space-y-2.5 text-xs font-medium text-slate-700">
                        <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wider mb-1.5">សិទ្ធិអនុញ្ញាតក្នុងប្រព័ន្ធ៖</p>
                        <div class="flex items-center gap-2.5">
                            <i class="bi bi-check-circle-fill text-emerald-500 text-sm shrink-0"></i>
                            <span>គ្រប់គ្រងអ្នកប្រើប្រាស់ និងសិទ្ធិ (User Access Control)</span>
                        </div>
                        <div class="flex items-center gap-2.5">
                            <i class="bi bi-check-circle-fill text-emerald-500 text-sm shrink-0"></i>
                            <span>ត្រួតពិនិត្យ និងអនុម័តប្រាក់កម្ចី (Loan Approvals)</span>
                        </div>
                        <div class="flex items-center gap-2.5">
                            <i class="bi bi-check-circle-fill text-emerald-500 text-sm shrink-0"></i>
                            <span>ទាញយក និងបោះពុម្ពរបាយការណ៍ហិរញ្ញវត្ថុ (Reports)</span>
                        </div>
                        <div class="flex items-center gap-2.5">
                            <i class="bi bi-check-circle-fill text-emerald-500 text-sm shrink-0"></i>
                            <span>ពិនិត្យសកម្មភាពសុវត្ថិភាព Audit Logs</span>
                        </div>
                    </div>

                @elseif($role === 2)
                    {{-- MANAGER --}}
                    <div class="rounded-2xl border border-[#0F4C5C]/20 bg-[#0F4C5C]/5 p-4 mb-4">
                        <div class="flex items-center gap-2 text-[#0F4C5C] font-bold text-xs uppercase tracking-wider mb-1.5">
                            <i class="bi bi-briefcase-fill"></i>
                            <span>សិទ្ធិអ្នកគ្រប់គ្រងសាខា (Branch Manager)</span>
                        </div>
                        <p class="text-slate-600 text-xs leading-relaxed">
                            អ្នកមានសិទ្ធិគ្រប់គ្រងប្រតិបត្តិការប្រាក់កម្ចី និងទិន្នន័យដែលពាក់ព័ន្ធនឹងសាខា ពិនិត្យបញ្ជីអតិថិជន និងគ្រប់គ្រងការងាររបស់បុគ្គលិកក្រោមឱវាទ។
                        </p>
                    </div>

                    <div class="space-y-2.5 text-xs font-medium text-slate-700">
                        <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wider mb-1.5">សិទ្ធិអនុញ្ញាតក្នុងប្រព័ន្ធ៖</p>
                        <div class="flex items-center gap-2.5">
                            <i class="bi bi-check-circle-fill text-emerald-500 text-sm shrink-0"></i>
                            <span>គ្រប់គ្រងប្រតិបត្តិការប្រចាំសាខា (Branch Operations)</span>
                        </div>
                        <div class="flex items-center gap-2.5">
                            <i class="bi bi-check-circle-fill text-emerald-500 text-sm shrink-0"></i>
                            <span>ពិនិត្យ និងអនុម័តសំណើប្រាក់កម្ចីសាខា (Loan Review)</span>
                        </div>
                        <div class="flex items-center gap-2.5">
                            <i class="bi bi-check-circle-fill text-emerald-500 text-sm shrink-0"></i>
                            <span>របាយការណ៍ស្ថិតិអតិថិជនប្រចាំសាខា (Branch Reports)</span>
                        </div>
                    </div>

                @elseif($role === 3)
                    {{-- STAFF --}}
                    <div class="rounded-2xl border border-emerald-500/20 bg-emerald-500/5 p-4 mb-4">
                        <div class="flex items-center gap-2 text-emerald-800 font-bold text-xs uppercase tracking-wider mb-1.5">
                            <i class="bi bi-person-workspace"></i>
                            <span>សិទ្ធិបុគ្គលិកប្រតិបត្តិការ (Operations Staff)</span>
                        </div>
                        <p class="text-slate-600 text-xs leading-relaxed">
                            អ្នកអាចចុះឈ្មោះអតិថិជនថ្មី បង្កើតសំណើកម្ចី និងកត់ត្រាការទូទាត់ប្រាក់ប្រចាំថ្ងៃស្របតាមគោលការណ៍របស់ធនាគារ។
                        </p>
                    </div>

                    <div class="space-y-2.5 text-xs font-medium text-slate-700">
                        <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wider mb-1.5">សិទ្ធិអនុញ្ញាតក្នុងប្រព័ន្ធ៖</p>
                        <div class="flex items-center gap-2.5">
                            <i class="bi bi-check-circle-fill text-emerald-500 text-sm shrink-0"></i>
                            <span>ចុះឈ្មោះ និងកែប្រែព័ត៌មានអតិថិជន (Customer Registry)</span>
                        </div>
                        <div class="flex items-center gap-2.5">
                            <i class="bi bi-check-circle-fill text-emerald-500 text-sm shrink-0"></i>
                            <span>បញ្ចូលសំណើប្រាក់កម្ចីថ្មី (Loan Origination)</span>
                        </div>
                        <div class="flex items-center gap-2.5">
                            <i class="bi bi-check-circle-fill text-emerald-500 text-sm shrink-0"></i>
                            <span>កត់ត្រាប្រតិបត្តិការបង់ប្រាក់ (Payment Entry)</span>
                        </div>
                    </div>

                @else
                    {{-- USER --}}
                    <div class="rounded-2xl border border-slate-200 bg-slate-50/70 p-4 mb-4">
                        <div class="flex items-center gap-2 text-slate-800 font-bold text-xs uppercase tracking-wider mb-1.5">
                            <i class="bi bi-person-check-fill"></i>
                            <span>សិទ្ធិអ្នកប្រើប្រាស់ទូទៅ (Standard Access)</span>
                        </div>
                        <p class="text-slate-600 text-xs leading-relaxed">
                            អ្នកអាចពិនិត្យមើលព័ត៌មានផ្ទាល់ខ្លួន និងកែប្រែទិន្នន័យប្រវត្តិរូបរបស់អ្នកបាន។
                        </p>
                    </div>
                @endif

            </div>

            {{-- SECURITY CENTER CARD --}}
            <div class="bg-white rounded-3xl border border-slate-200/90 shadow-sm p-6 sm:p-7">
                
                <div class="flex items-center gap-3 pb-4 border-b border-slate-100 mb-4">
                    <div class="w-9 h-9 rounded-xl bg-blue-500/10 text-blue-600 flex items-center justify-center shrink-0">
                        <i class="bi bi-shield-shaded text-base"></i>
                    </div>
                    <div>
                        <h3 class="text-sm sm:text-base font-bold text-slate-900">
                            មជ្ឈមណ្ឌលសុវត្ថិភាព (Security)
                        </h3>
                        <p class="text-xs text-slate-400">ស្ថានភាពសុវត្ថិភាពនៃគណនីរបស់អ្នក</p>
                    </div>
                </div>

                <div class="space-y-3">
                    
                    {{-- Password Status --}}
                    <div class="flex items-center justify-between p-3.5 rounded-2xl bg-slate-50/70 border border-slate-200/70">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-xl bg-white border border-slate-200 flex items-center justify-center text-slate-600 shadow-2xs">
                                <i class="bi bi-key-fill text-xs text-slate-500"></i>
                            </div>
                            <div>
                                <p class="text-xs font-bold text-slate-800">ពាក្យសម្ងាត់ (Password)</p>
                                <p class="text-[11px] text-slate-400">បានការពារត្រឹមត្រូវ</p>
                            </div>
                        </div>

                        <a href="{{ route('profile.edit') }}" class="text-xs font-bold text-[#0F4C5C] hover:underline">
                            ប្តូរ
                        </a>
                    </div>

                    {{-- Email Verification --}}
                    <div class="flex items-center justify-between p-3.5 rounded-2xl bg-slate-50/70 border border-slate-200/70">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-xl bg-white border border-slate-200 flex items-center justify-center text-slate-600 shadow-2xs">
                                <i class="bi bi-envelope-check-fill text-xs text-emerald-500"></i>
                            </div>
                            <div>
                                <p class="text-xs font-bold text-slate-800">ការផ្ទៀងផ្ទាត់អ៊ីមែល</p>
                                <p class="text-[11px] text-emerald-600 font-medium">Verified Account</p>
                            </div>
                        </div>

                        <span class="text-emerald-500 text-sm">
                            <i class="bi bi-check-circle-fill"></i>
                        </span>
                    </div>

                </div>

                <div class="mt-5 pt-4 border-t border-slate-100">
                    <a
                        href="{{ route('profile.edit') }}"
                        class="w-full inline-flex items-center justify-center gap-2 rounded-xl bg-slate-900 px-4 py-2.5 text-xs font-bold text-white hover:bg-slate-800 transition-all shadow-xs"
                    >
                        <i class="bi bi-gear-fill text-xs"></i>
                        <span>កំណត់ និងកែប្រែគណនី (Manage Profile)</span>
                    </a>
                </div>

            </div>

        </div>

    </div>

</div>

@endsection

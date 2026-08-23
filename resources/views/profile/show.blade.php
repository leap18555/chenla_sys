@extends('layouts.master')

@section('header_title', 'ព័ត៌មានរូបរាងកាយ (User Profile)')

@section('content')

@php
    /*
    |--------------------------------------------------------------------------
    | USER ROLE
    |--------------------------------------------------------------------------
    | Database:
    | 1 = Admin
    | 2 = Manager
    | 3 = Staff
    */

    $role = (int) ($user->role ?? 0);

    $roleName = match ($role) {
        1 => 'Admin',
        2 => 'Manager',
        3 => 'Staff',
        default => 'User',
    };

    $roleNameKhmer = match ($role) {
        1 => 'អ្នកគ្រប់គ្រង (Admin)',
        2 => 'អ្នកគ្រប់គ្រងសាខា (Manager)',
        3 => 'បុគ្គលិក (Staff)',
        default => 'អ្នកប្រើប្រាស់ (User)',
    };

    $isAdmin = $role === 1;

    /*
    |--------------------------------------------------------------------------
    | ROLE BADGE
    |--------------------------------------------------------------------------
    */

    $roleBadgeClass = match ($role) {
        1 => 'bg-amber-500/10 border-amber-500/20 text-amber-700',
        2 => 'bg-blue-500/10 border-blue-500/20 text-blue-700',
        3 => 'bg-emerald-500/10 border-emerald-500/20 text-emerald-700',
        default => 'bg-slate-100 border-slate-200 text-slate-700',
    };

    $roleDotClass = match ($role) {
        1 => 'bg-amber-500',
        2 => 'bg-blue-500',
        3 => 'bg-emerald-500',
        default => 'bg-slate-400',
    };

    /*
    |--------------------------------------------------------------------------
    | AVATAR
    |--------------------------------------------------------------------------
    */

    $avatar = !empty($user->avatar_url)
        ? asset('storage/customers/' . basename($user->avatar_url))
        : asset('images/default-avatar.png');

    $fallbackAvatar = 'https://ui-avatars.com/api/?name='
        . urlencode($user->name ?? 'User')
        . '&background=f59e0b&color=ffffff&bold=true';
@endphp


<div class="py-6 px-2 sm:px-4 max-w-5xl mx-auto space-y-6">

    {{-- SUCCESS ALERT --}}
    @if(session('success'))
        <div class="bg-emerald-50/80 border border-emerald-200/80 text-emerald-800 px-4 py-3.5 rounded-2xl flex items-center gap-3 shadow-sm backdrop-blur-sm">

            <div class="w-8 h-8 rounded-xl bg-emerald-500/10 border border-emerald-500/20 flex items-center justify-center text-emerald-600 shrink-0">
                <i class="bi bi-check-circle-fill text-base"></i>
            </div>

            <span class="font-semibold text-xs leading-relaxed">
                {{ session('success') }}
            </span>

        </div>
    @endif


    {{-- MAIN PROFILE CARD --}}
    <div class="bg-white rounded-3xl border border-slate-200/70 shadow-sm overflow-hidden">


        {{-- HERO DECORATIVE BANNER --}}
        <div class="h-32 bg-gradient-to-r from-slate-900 via-slate-800 to-amber-950 relative overflow-hidden">

            <div class="absolute inset-0 bg-[radial-gradient(#f59e0b_1px,transparent_1px)] [background-size:16px_16px] opacity-10"></div>

            <div class="absolute right-6 top-1/2 -translate-y-1/2 text-white/5 pointer-events-none">
                <i class="bi bi-shield-lock-fill text-8xl"></i>
            </div>

        </div>


        <div class="p-6 sm:p-8 lg:p-10 -mt-16 relative">


            {{-- TOP SECTION --}}
            <div class="flex flex-col sm:flex-row items-start sm:items-end justify-between gap-6 pb-8 border-b border-slate-100">

                <div class="flex flex-col sm:flex-row items-start sm:items-end gap-5">


                    {{-- PROFILE IMAGE --}}
                    <div class="relative shrink-0">

                        <div class="w-28 h-28 rounded-2xl overflow-hidden border-4 border-white shadow-md bg-slate-100 ring-1 ring-slate-200/80">

                            <img
                                src="{{ $avatar }}"
                                alt="{{ $user->name ?? 'User' }}"
                                class="w-full h-full object-cover"
                                onerror="this.onerror=null; this.src='{{ $fallbackAvatar }}';"
                            >

                        </div>


                        {{-- ONLINE DOT --}}
                        <div
                            class="absolute -bottom-1 -right-1 w-5 h-5 rounded-full bg-emerald-500 border-4 border-white shadow-sm"
                            title="Active Session">
                        </div>

                    </div>


                    {{-- USER INFO --}}
                    <div class="space-y-1.5">


                        {{-- NAME + ROLE --}}
                        <div class="flex flex-wrap items-center gap-2.5">

                            <h1 class="text-2xl font-bold text-slate-900 tracking-tight">
                                {{ $user->name ?? 'Unknown User' }}
                            </h1>


                            {{-- ONLY ONE ROLE DISPLAY --}}
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full border text-xs font-bold {{ $roleBadgeClass }}">

                                <span class="w-1.5 h-1.5 rounded-full {{ $roleDotClass }}"></span>

                                {{ $roleName }}

                            </span>

                        </div>


                        {{-- EMAIL --}}
                        <p class="text-slate-500 text-xs font-medium flex items-center gap-2">

                            <i class="bi bi-envelope text-slate-400"></i>

                            {{ $user->email ?? 'No email address' }}

                        </p>


                        {{-- CREATED DATE --}}
                        <p class="text-[11px] text-slate-400 font-medium flex items-center gap-1.5">

                            <i class="bi bi-calendar3 text-slate-400"></i>

                            <span>សមាជិកតាំងពី</span>

                            @if($user->created_at)

                                <span class="text-slate-600 font-semibold">
                                    {{ $user->created_at->format('M d, Y') }}
                                </span>

                            @else

                                <span class="text-slate-600 font-semibold">
                                    មិនមានទិន្នន័យ
                                </span>

                            @endif

                        </p>

                    </div>

                </div>


                {{-- AUTHENTICATED BADGE --}}
                <div class="hidden sm:flex items-center gap-2 px-3 py-1.5 rounded-xl bg-amber-500/10 border border-amber-500/20 text-amber-700 font-bold text-[10px] uppercase tracking-wider">

                    <span class="w-2 h-2 rounded-full bg-amber-500 animate-pulse"></span>

                    <span>AUTHENTICATED LOGGED IN</span>

                </div>

            </div>


            {{-- STATS GRID --}}
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mt-8">


                {{-- ACCOUNT STATUS --}}
                <div class="bg-slate-50/80 border border-slate-200/60 rounded-2xl p-5 hover:border-amber-500/30 transition-colors">

                    <div class="flex items-center justify-between text-slate-400 mb-2">

                        <span class="text-[10px] font-bold uppercase tracking-wider">
                            Account Status
                        </span>

                        <i class="bi bi-check-circle-fill text-emerald-500 text-sm"></i>

                    </div>

                    <h3 class="text-base font-bold text-emerald-600">
                        ដំណើរការសកម្ម (Active)
                    </h3>

                </div>


                {{-- USER ROLE --}}
                <div class="bg-slate-50/80 border border-slate-200/60 rounded-2xl p-5 hover:border-amber-500/30 transition-colors">

                    <div class="flex items-center justify-between text-slate-400 mb-2">

                        <span class="text-[10px] font-bold uppercase tracking-wider">
                            User Role
                        </span>

                        <i class="bi bi-shield-check text-amber-500 text-sm"></i>

                    </div>

                    <h3 class="text-base font-bold text-slate-800">
                        {{ $roleNameKhmer }}
                    </h3>

                </div>


                {{-- MEMBERSHIP --}}
                <div class="bg-slate-50/80 border border-slate-200/60 rounded-2xl p-5 hover:border-amber-500/30 transition-colors">

                    <div class="flex items-center justify-between text-slate-400 mb-2">

                        <span class="text-[10px] font-bold uppercase tracking-wider">
                            Membership
                        </span>

                        <i class="bi bi-clock-history text-slate-400 text-sm"></i>

                    </div>

                    <h3 class="text-base font-bold text-slate-800">

                        @if($user->created_at)
                            {{ $user->created_at->diffForHumans() }}
                        @else
                            N/A
                        @endif

                    </h3>

                </div>

            </div>


            {{-- ROLE PRIVILEGES --}}
            @if($role === 1)

                {{-- ADMIN --}}
                <div class="mt-6 rounded-2xl border border-amber-500/20 bg-amber-500/5 p-5">

                    <div class="flex items-start gap-3">

                        <div class="w-8 h-8 rounded-xl bg-amber-500/10 border border-amber-500/20 flex items-center justify-center text-amber-600 shrink-0">

                            <i class="bi bi-shield-lock text-base"></i>

                        </div>

                        <div>

                            <h3 class="text-xs font-bold text-slate-900 tracking-wide uppercase">
                                សិទ្ធិគ្រប់គ្រងប្រព័ន្ធ
                                (Elevated Privileges Active)
                            </h3>

                            <p class="text-slate-600 mt-1 text-xs leading-relaxed">
                                អ្នកមានសិទ្ធិពេញលេញក្នុងការគ្រប់គ្រងគណនីប្រព័ន្ធ
                                កែប្រែទិន្នន័យឃ្លាំង ពិនិត្យរបាយការណ៍ប្រតិបត្តិការ
                                និងសកម្មភាព Audit Logs។
                            </p>

                        </div>

                    </div>

                </div>


            @elseif($role === 2)

                {{-- MANAGER --}}
                <div class="mt-6 rounded-2xl border border-blue-500/20 bg-blue-500/5 p-5">

                    <div class="flex items-start gap-3">

                        <div class="w-8 h-8 rounded-xl bg-blue-500/10 border border-blue-500/20 flex items-center justify-center text-blue-600 shrink-0">

                            <i class="bi bi-person-badge text-base"></i>

                        </div>

                        <div>

                            <h3 class="text-xs font-bold text-slate-900 tracking-wide uppercase">
                                សិទ្ធិអ្នកគ្រប់គ្រងសាខា
                            </h3>

                            <p class="text-slate-600 mt-1 text-xs leading-relaxed">
                                អ្នកមានសិទ្ធិគ្រប់គ្រងប្រតិបត្តិការ និងទិន្នន័យដែលពាក់ព័ន្ធនឹងសាខា
                                តាមសិទ្ធិដែលបានកំណត់។
                            </p>

                        </div>

                    </div>

                </div>


            @elseif($role === 3)

                {{-- STAFF --}}
                <div class="mt-6 rounded-2xl border border-emerald-500/20 bg-emerald-500/5 p-5">

                    <div class="flex items-start gap-3">

                        <div class="w-8 h-8 rounded-xl bg-emerald-500/10 border border-emerald-500/20 flex items-center justify-center text-emerald-600 shrink-0">

                            <i class="bi bi-person-workspace text-base"></i>

                        </div>

                        <div>

                            <h3 class="text-xs font-bold text-slate-900 tracking-wide uppercase">
                                សិទ្ធិបុគ្គលិក
                            </h3>

                            <p class="text-slate-600 mt-1 text-xs leading-relaxed">
                                អ្នកអាចប្រើប្រាស់ប្រព័ន្ធតាមសិទ្ធិដែលបានកំណត់សម្រាប់បុគ្គលិក។
                            </p>

                        </div>

                    </div>

                </div>

            @endif


            {{-- ACTION BUTTONS --}}
            <div class="mt-8 pt-6 border-t border-slate-100 flex flex-wrap items-center justify-between gap-3">


                <div class="flex items-center gap-3">

                    {{-- BACK BUTTON --}}
                    <a
                        href="{{ url()->previous() }}"
                        class="inline-flex items-center gap-2 rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-xs font-bold text-slate-700 hover:bg-slate-50 hover:border-slate-300 transition-all shadow-sm"
                    >

                        <i class="bi bi-arrow-left text-sm"></i>

                        <span>
                            ត្រឡប់ក្រោយ
                        </span>

                    </a>


                    {{-- EDIT PROFILE --}}
                    <a
                        href="{{ route('profile.edit') }}"
                        class="inline-flex items-center gap-2 rounded-xl bg-slate-900 px-4 py-2.5 text-xs font-bold text-white hover:bg-slate-800 transition-all shadow-sm"
                    >

                        <i class="bi bi-pencil text-xs"></i>

                        <span>
                            កែប្រែព័ត៌មាន (Edit Profile)
                        </span>

                    </a>

                </div>


                {{-- ADMIN DASHBOARD --}}
                @if($isAdmin)

                    <a
                        href="{{ route('user.Home') }}"
                        class="inline-flex items-center gap-2 rounded-xl bg-amber-500 px-4 py-2.5 text-xs font-bold text-white hover:bg-amber-600 transition-all shadow-sm"
                    >

                        <i class="bi bi-layout-sidebar-inset text-sm"></i>

                        <span>
                            ផ្ទាំងគ្រប់គ្រង (Dashboard)
                        </span>

                    </a>

                @endif

            </div>

        </div>

    </div>

</div>

@endsection
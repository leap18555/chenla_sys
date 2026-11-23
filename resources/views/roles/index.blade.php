@extends('layouts.master')

@section('title', 'គ្រប់គ្រងតួនាទី & សិទ្ធិ | ធនាគារ ចេនឡា')
@section('header_title', 'ការកំណត់តួនាទី និងសិទ្ធិប្រើប្រាស់')

@section('content')
<div x-data="{
    searchQuery: '',
    confirmDelete(roleName, formId) {
        if (confirm(`តើអ្នកពិតជាចង់លុបតួនាទី '${roleName}' នេះមែនទេ? សកម្មភាពនេះមិនអាចត្រឡប់វិញបានទេ។`)) {
            document.getElementById(formId).submit();
        }
    }
}" class="space-y-6 max-w-7xl mx-auto pb-10">

    {{-- Alert Messages --}}
    @if(session('success'))
        <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 px-5 py-3.5 rounded-2xl flex items-center justify-between gap-4 shadow-sm animate-fade-in">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 rounded-xl bg-emerald-500 text-white flex items-center justify-center shrink-0 shadow-xs">
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

    @if(session('error'))
        <div class="bg-rose-50 border border-rose-200 text-rose-800 px-5 py-3.5 rounded-2xl flex items-center justify-between gap-4 shadow-sm">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 rounded-xl bg-rose-500 text-white flex items-center justify-center shrink-0 shadow-xs">
                    <i class="bi bi-exclamation-octagon text-lg"></i>
                </div>
                <div>
                    <p class="font-bold text-xs text-rose-950">កំហុស!</p>
                    <p class="font-medium text-xs text-rose-700">{{ session('error') }}</p>
                </div>
            </div>
            <button type="button" onclick="this.parentElement.remove()" class="text-rose-500 hover:text-rose-700 p-1">
                <i class="bi bi-x-lg text-xs"></i>
            </button>
        </div>
    @endif

    {{-- Top Brand Banner Header --}}
    <div class="rounded-2xl bg-white border border-slate-200/90 shadow-[0_8px_30px_rgb(11,43,64,0.04)] overflow-hidden">
        {{-- Chhenla Signature Gradient Strip --}}
        <div class="h-1.5 w-full bg-gradient-to-r from-[#0B2B40] via-[#0F4C5C] to-[#10B981]"></div>

        <div class="p-5 sm:p-6 flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div class="flex items-start sm:items-center gap-4">
                {{-- Brand Emblem Icon --}}
                <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-[#0B2B40] to-[#0F4C5C] text-white flex items-center justify-center shrink-0 shadow-sm ring-4 ring-[#0F4C5C]/10">
                    <i class="bi bi-shield-lock text-xl text-[#10B981]"></i>
                </div>
                <div>
                    <div class="flex items-center gap-2 flex-wrap">
                        <h1 class="text-xl sm:text-2xl font-bold text-[#0B2B40] tracking-tight">
                            គ្រប់គ្រងតួនាទី & សិទ្ធិ
                        </h1>
                        <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[11px] font-semibold bg-[#0F4C5C]/10 text-[#0F4C5C] border border-[#0F4C5C]/20">
                            Roles & Permissions
                        </span>
                        <span class="hidden sm:inline-block text-xs font-semibold text-slate-400 border-l border-slate-200 pl-2">
                            Chhenla Bank PLC.
                        </span>
                    </div>
                    <p class="text-xs sm:text-sm text-slate-500 mt-1">
                        កំណត់សិទ្ធិប្រើប្រាស់ និងកម្រិតសុវត្ថិភាពសម្រាប់បុគ្គលិកក្នុងការចូលដំណើរការផ្នែកផ្សេងៗនៃប្រព័ន្ធ
                    </p>
                </div>
            </div>

            <div class="flex items-center gap-3 shrink-0">
                <a href="{{ route('roles.create') }}"
                   class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl text-xs sm:text-sm font-semibold text-white bg-gradient-to-r from-[#0F4C5C] to-[#10B981] hover:from-[#0B2B40] hover:to-[#059669] shadow-sm hover:shadow transition-all duration-200 active:scale-[0.98]">
                    <i class="bi bi-plus-lg text-sm"></i>
                    <span>បង្កើតតួនាទីថ្មី (Add Role)</span>
                </a>
            </div>
        </div>
    </div>

    {{-- Stats Cards Overview --}}
    @php
        $totalRoles = $roles->count();
        $totalPermissionsAssigned = $roles->pluck('permissions')->flatten()->unique('id')->count();
        $totalUsersWithRoles = $roles->sum(function($r) {
            return $r->users_count ?? ($r->relationLoaded('users') ? $r->users->count() : (method_exists($r, 'users') ? $r->users()->count() : 0));
        });
    @endphp
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        <!-- Card 1: Total Roles -->
        <div class="bg-white p-4 sm:p-5 rounded-2xl border border-slate-200/90 shadow-sm flex items-center justify-between">
            <div>
                <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">ចំនួនតួនាទីសរុប</p>
                <h3 class="text-2xl font-extrabold text-[#0B2B40] mt-1">{{ number_format($totalRoles) }}</h3>
                <span class="inline-flex items-center gap-1 text-[11px] text-emerald-600 font-medium mt-1">
                    <i class="bi bi-shield-check"></i> សកម្មក្នុងប្រព័ន្ធ
                </span>
            </div>
            <div class="w-11 h-11 rounded-xl bg-[#0F4C5C]/10 text-[#0F4C5C] flex items-center justify-center text-lg">
                <i class="bi bi-person-badge"></i>
            </div>
        </div>

        <!-- Card 2: Permissions in Use -->
        <div class="bg-white p-4 sm:p-5 rounded-2xl border border-slate-200/90 shadow-sm flex items-center justify-between">
            <div>
                <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">សិទ្ធិត្រូវបានផ្តល់</p>
                <h3 class="text-2xl font-extrabold text-[#0B2B40] mt-1">{{ number_format($totalPermissionsAssigned) }}</h3>
                <span class="inline-flex items-center gap-1 text-[11px] text-teal-600 font-medium mt-1">
                    <i class="bi bi-key"></i> សិទ្ធិកំពុងប្រើប្រាស់
                </span>
            </div>
            <div class="w-11 h-11 rounded-xl bg-teal-50 text-teal-600 flex items-center justify-center text-lg">
                <i class="bi bi-lock"></i>
            </div>
        </div>

        <!-- Card 3: Users Assigned -->
        <div class="bg-white p-4 sm:p-5 rounded-2xl border border-slate-200/90 shadow-sm flex items-center justify-between">
            <div>
                <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">អ្នកប្រើប្រាស់មានតួនាទី</p>
                <h3 class="text-2xl font-extrabold text-[#0B2B40] mt-1">{{ number_format($totalUsersWithRoles) }}</h3>
                <span class="inline-flex items-center gap-1 text-[11px] text-slate-500 font-medium mt-1">
                    <i class="bi bi-people"></i> គណនីបុគ្គលិកសរុប
                </span>
            </div>
            <div class="w-11 h-11 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center text-lg">
                <i class="bi bi-people-fill"></i>
            </div>
        </div>

        <!-- Card 4: Access Security Status -->
        <div class="bg-white p-4 sm:p-5 rounded-2xl border border-slate-200/90 shadow-sm flex items-center justify-between">
            <div>
                <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">កម្រិតសុវត្ថិភាព</p>
                <h3 class="text-base font-bold text-emerald-600 mt-2 flex items-center gap-1.5">
                    <span class="w-2.5 h-2.5 rounded-full bg-emerald-500 animate-pulse"></span>
                    RBAC Protected
                </h3>
                <span class="text-[11px] text-slate-400 font-medium mt-0.5 block">
                    Role-Based Access
                </span>
            </div>
            <div class="w-11 h-11 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-lg">
                <i class="bi bi-shield-fill-check"></i>
            </div>
        </div>
    </div>

    {{-- Main Table Container Card --}}
    <div class="bg-white rounded-2xl border border-slate-200/90 shadow-sm overflow-hidden">
        
        {{-- Search and Toolbar Filter --}}
        <div class="p-4 sm:p-5 border-b border-slate-100 flex flex-col sm:flex-row sm:items-center justify-between gap-3 bg-slate-50/50">
            <div class="relative flex-1 max-w-md">
                <i class="bi bi-search absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>
                <input 
                    type="text" 
                    x-model="searchQuery"
                    placeholder="ស្វែងរកតាមឈ្មោះតួនាទី ឬសិទ្ធិ... (Search role or permission)" 
                    class="w-full pl-9 pr-8 py-2 text-xs bg-white border border-slate-200 rounded-xl focus:outline-none focus:border-[#0F4C5C] focus:ring-2 focus:ring-[#0F4C5C]/10 text-slate-800 placeholder:text-slate-400 transition-all shadow-2xs"
                >
                <button 
                    x-show="searchQuery.length > 0" 
                    @click="searchQuery = ''" 
                    class="absolute right-2.5 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-600 text-xs p-1"
                    x-cloak
                >
                    <i class="bi bi-x-circle-fill"></i>
                </button>
            </div>

            <div class="text-xs text-slate-500 font-medium flex items-center gap-2">
                <i class="bi bi-layers text-[#0F4C5C]"></i>
                <span>សរុប: <strong class="text-slate-800">{{ $roles->count() }}</strong> តួនាទី</span>
            </div>
        </div>

        {{-- Table View --}}
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50/80 border-b border-slate-200/80 text-[11px] uppercase tracking-wider font-bold text-slate-500">
                        <th class="py-3.5 px-5 w-72">ឈ្មោះតួនាទី (Role)</th>
                        <th class="py-3.5 px-5">សិទ្ធិទទួលបាន (Assigned Permissions)</th>
                        <th class="py-3.5 px-5 text-center w-36">បុគ្គលិក (Users)</th>
                        <th class="py-3.5 px-5 text-right w-32">សកម្មភាព (Actions)</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-xs">
                    @forelse($roles as $role)
                        @php
                            $userCount = $role->users_count ?? ($role->relationLoaded('users') ? $role->users->count() : (method_exists($role, 'users') ? $role->users()->count() : 0));
                            $permNames = $role->permissions->pluck('name')->implode(' ');
                            $isSuperAdmin = in_array(strtolower($role->name), ['super admin', 'admin', 'administrator', 'អ្នកគ្រប់គ្រងប្រព័ន្ធ']);
                        @endphp
                        <tr x-show="!searchQuery || '{{ strtolower($role->name . ' ' . ($role->slug ?? '') . ' ' . $permNames) }}'.includes(searchQuery.toLowerCase())"
                            class="hover:bg-slate-50/80 transition-colors group">
                            
                            {{-- Role Column --}}
                            <td class="py-4 px-5">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-xl {{ $isSuperAdmin ? 'bg-amber-50 text-amber-600 border border-amber-200' : 'bg-[#0F4C5C]/10 text-[#0F4C5C] border border-[#0F4C5C]/20' }} flex items-center justify-center shrink-0 group-hover:scale-105 transition-transform">
                                        <i class="bi {{ $isSuperAdmin ? 'bi-shield-shaded' : 'bi-shield-check' }} text-base"></i>
                                    </div>
                                    <div class="min-w-0">
                                        <div class="flex items-center gap-2">
                                            <span class="font-bold text-slate-800 text-sm group-hover:text-[#0F4C5C] transition-colors">
                                                {{ $role->name }}
                                            </span>
                                            @if($isSuperAdmin)
                                                <span class="px-1.5 py-0.5 rounded text-[10px] font-bold bg-amber-100 text-amber-800">
                                                    Full Access
                                                </span>
                                            @endif
                                        </div>
                                        <div class="flex items-center gap-2 mt-0.5 text-[11px] text-slate-400">
                                            <span>#ROL-{{ str_pad($role->id, 3, '0', STR_PAD_LEFT) }}</span>
                                            @if(!empty($role->slug))
                                                <span>•</span>
                                                <span class="font-mono text-[10px] text-slate-500 bg-slate-100 px-1.5 py-0.2 rounded">{{ $role->slug }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </td>

                            {{-- Permissions Badges Column --}}
                            <td class="py-4 px-5">
                                <div class="space-y-2">
                                    <div class="flex items-center gap-2">
                                        <span class="text-[11px] font-bold text-slate-500">
                                            សិទ្ធិចំនួន <strong class="text-[#0F4C5C]">{{ $role->permissions->count() }}</strong>
                                        </span>
                                    </div>

                                    <div class="flex flex-wrap gap-1.5 max-w-2xl">
                                        @forelse($role->permissions->take(8) as $permission)
                                            <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg bg-slate-50 text-slate-700 border border-slate-200/80 text-[11px] font-medium hover:bg-[#EEF7F0] hover:text-[#0F4C5C] hover:border-[#10B981]/40 transition-colors">
                                                <i class="bi bi-check-circle-fill text-[#10B981] text-[10px]"></i>
                                                {{ $permission->name }}
                                            </span>
                                        @empty
                                            <span class="text-slate-400 italic text-[11px] flex items-center gap-1.5 bg-slate-50 px-3 py-1.5 rounded-lg border border-slate-200/60">
                                                <i class="bi bi-shield-slash text-xs text-slate-400"></i>
                                                មិនទាន់មានសិទ្ធិត្រូវបានភ្ជាប់នៅឡើយទេ
                                            </span>
                                        @endforelse

                                        @if($role->permissions->count() > 8)
                                            <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg bg-[#0F4C5C]/5 text-[#0F4C5C] border border-[#0F4C5C]/20 text-[11px] font-bold">
                                                +{{ $role->permissions->count() - 8 }} សិទ្ធិបន្ថែមទៀត
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </td>

                            {{-- Assigned Users Count Column --}}
                            <td class="py-4 px-5 text-center whitespace-nowrap">
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full {{ $userCount > 0 ? 'bg-[#EEF7F0] text-[#0F4C5C] border border-[#10B981]/30 font-bold' : 'bg-slate-100 text-slate-500 border border-slate-200 font-medium' }} text-xs">
                                    <i class="bi bi-person text-xs"></i>
                                    {{ $userCount }} នាក់
                                </span>
                            </td>

                            {{-- Actions Column --}}
                            <td class="py-4 px-5 text-right whitespace-nowrap">
                                <div class="flex items-center justify-end gap-1.5">
                                    {{-- Edit Role --}}
                                    <a href="{{ route('roles.edit', $role->id) }}" 
                                       title="កែប្រែតួនាទី"
                                       class="w-8 h-8 rounded-xl bg-slate-100 hover:bg-[#EEF7F0] text-slate-600 hover:text-[#0F4C5C] hover:border hover:border-[#10B981]/30 flex items-center justify-center transition-all duration-150 shadow-2xs">
                                        <i class="bi bi-pencil-square text-xs"></i>
                                    </a>

                                    {{-- Delete Role --}}
                                    <form id="delete-role-{{ $role->id }}" action="{{ route('roles.destroy', $role->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" 
                                                title="លុបតួនាទី"
                                                @click="confirmDelete('{{ addslashes($role->name) }}', 'delete-role-{{ $role->id }}')"
                                                class="w-8 h-8 rounded-xl bg-slate-100 hover:bg-rose-50 text-slate-500 hover:text-rose-600 hover:border hover:border-rose-200 flex items-center justify-center transition-all duration-150 shadow-2xs">
                                            <i class="bi bi-trash3 text-xs"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        {{-- Empty Database State --}}
                        <tr>
                            <td colspan="4" class="py-16 text-center">
                                <div class="flex flex-col items-center justify-center max-w-sm mx-auto">
                                    <div class="w-16 h-16 rounded-3xl bg-[#0F4C5C]/10 text-[#0F4C5C] flex items-center justify-center mb-3 text-2xl">
                                        <i class="bi bi-shield-x"></i>
                                    </div>
                                    <h4 class="text-slate-800 font-bold text-sm">មិនទាន់មានទិន្នន័យតួនាទីនៅឡើយទេ</h4>
                                    <p class="text-slate-400 text-xs mt-1 text-center">សូមចុចប៊ូតុង "បង្កើតតួនាទីថ្មី" ដើម្បីកំណត់តួនាទីដំបូងសម្រាប់ប្រព័ន្ធធនាគារ</p>
                                    <a href="{{ route('roles.create') }}" class="mt-4 inline-flex items-center gap-2 px-4 py-2 bg-[#10B981] hover:bg-[#059669] text-white font-bold text-xs rounded-xl shadow-sm transition-all">
                                        <i class="bi bi-plus-lg"></i>
                                        <span>បង្កើតតួនាទីថ្មី</span>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Client-side Filter Empty State --}}
        <div x-show="searchQuery && $el.closest('.bg-white').querySelectorAll('tbody tr[style*=\'display: none\']').length === {{ $roles->count() }}"
             x-cloak
             class="py-12 text-center border-t border-slate-100">
            <div class="w-12 h-12 rounded-2xl bg-slate-100 text-slate-400 flex items-center justify-center mx-auto mb-2 text-xl">
                <i class="bi bi-search"></i>
            </div>
            <p class="text-slate-600 font-bold text-xs">មិនមានលទ្ធផលត្រូវគ្នានឹង "<span x-text="searchQuery" class="text-[#0F4C5C]"></span>" ឡើយ</p>
            <button @click="searchQuery = ''" class="mt-2 text-[11px] font-semibold text-[#10B981] hover:underline">
                សម្អាតការស្វែងរក
            </button>
        </div>

        {{-- Table Footer Summary --}}
        <div class="px-5 py-3.5 bg-slate-50 border-t border-slate-100 flex items-center justify-between text-xs text-slate-500">
            <span class="flex items-center gap-1.5">
                <i class="bi bi-info-circle text-slate-400"></i>
                <span>ការកែប្រែតួនាទីនឹងមានប្រសិទ្ធភាពភ្លាមៗចំពោះបុគ្គលិកដែលកាន់តួនាទីនោះ</span>
            </span>
            <span class="text-[11px] font-semibold text-slate-400 uppercase tracking-wider">
                Chhenla Bank RBAC
            </span>
        </div>

    </div>

</div>
@endsection

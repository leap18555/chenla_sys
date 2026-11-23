@extends('layouts.master')

@section('title', 'បង្កើតតួនាទីថ្មី | ធនាគារ ចេនឡា')
@section('header_title', 'បង្កើតតួនាទីថ្មី')

@section('content')
@php
    // Group permissions dynamically into logical business modules
    $groupedPermissions = [];
    foreach ($permissions as $permission) {
        $pName = strtolower($permission->name);
        if (str_contains($pName, 'role') || str_contains($pName, 'permission') || str_contains($pName, 'សិទ្ធិ') || str_contains($pName, 'តួនាទី')) {
            $groupKey = 'roles';
            $groupTitle = 'ការគ្រប់គ្រងតួនាទី & សិទ្ធិ (Roles & Access)';
            $groupIcon = 'bi-shield-lock';
            $groupDesc = 'កំណត់សិទ្ធិបង្កើត កែប្រែ ឬលុបតួនាទីក្នុងប្រព័ន្ធ';
        } elseif (str_contains($pName, 'borrower') || str_contains($pName, 'customer') || str_contains($pName, 'client') || str_contains($pName, 'អតិថិជន') || str_contains($pName, 'អ្នកខ្ចី')) {
            $groupKey = 'borrowers';
            $groupTitle = 'អតិថិជន & អ្នកខ្ចី (Customers & Borrowers)';
            $groupIcon = 'bi-people';
            $groupDesc = 'ការគ្រប់គ្រងព័ត៌មានអតិថិជន ចុះឈ្មោះ និងឯកសារផ្ទាល់ខ្លួន';
        } elseif (str_contains($pName, 'loan') || str_contains($pName, 'credit') || str_contains($pName, 'repay') || str_contains($pName, 'កម្ចី') || str_contains($pName, 'ឥណទាន') || str_contains($pName, 'បង់ប្រាក់')) {
            $groupKey = 'loans';
            $groupTitle = 'កម្ចី & ឥណទាន (Loans & Repayments)';
            $groupIcon = 'bi-cash-coin';
            $groupDesc = 'ការអនុម័ត បញ្ចេញប្រាក់កម្ចី និងតាមដានការសងត្រឡប់';
        } elseif (str_contains($pName, 'report') || str_contains($pName, 'analytic') || str_contains($pName, 'របាយការណ៍')) {
            $groupKey = 'reports';
            $groupTitle = 'របាយការណ៍ & ស្ថិតិ (Reports & Analytics)';
            $groupIcon = 'bi-bar-chart-line';
            $groupDesc = 'ការមើល ទាញយករបាយការណ៍ហិរញ្ញវត្ថុ និងស្ថិតិប្រតិបត្តិការ';
        } elseif (str_contains($pName, 'user') || str_contains($pName, 'staff') || str_contains($pName, 'បុគ្គលិក') || str_contains($pName, 'គណនី')) {
            $groupKey = 'users';
            $groupTitle = 'បុគ្គលិក & គណនីប្រើប្រាស់ (Staff & Accounts)';
            $groupIcon = 'bi-person-badge';
            $groupDesc = 'ការគ្រប់គ្រងគណនីបុគ្គលិក និងព័ត៌មានសម្ងាត់';
        } elseif (str_contains($pName, 'collateral') || str_contains($pName, 'ទ្រព្យ')) {
            $groupKey = 'collaterals';
            $groupTitle = 'ទ្រព្យបញ្ចាំ & ធានា (Collaterals)';
            $groupIcon = 'bi-box-seam';
            $groupDesc = 'គ្រប់គ្រងឯកសារ និងវត្ថុបញ្ចាំធានាកម្ចី';
        } else {
            $groupKey = 'general';
            $groupTitle = 'សិទ្ធិទូទៅក្នុងប្រព័ន្ធ (General System Rights)';
            $groupIcon = 'bi-gear';
            $groupDesc = 'មុខងារ និងសិទ្ធិបន្ថែមផ្សេងៗក្នុងប្រព័ន្ធធនាគារ';
        }

        if (!isset($groupedPermissions[$groupKey])) {
            $groupedPermissions[$groupKey] = [
                'title' => $groupTitle,
                'icon'  => $groupIcon,
                'desc'  => $groupDesc,
                'items' => []
            ];
        }
        $groupedPermissions[$groupKey]['items'][] = $permission;
    }

    $oldPerms = old('permissions', []);
    if (!is_array($oldPerms)) {
        $oldPerms = [];
    }
@endphp

<div x-data="{
    roleName: '{{ old('name', '') }}',
    searchQuery: '',
    selectedPerms: {{ json_encode(array_map('strval', $oldPerms)) }},
    totalPerms: {{ $permissions->count() }},

    togglePermission(id) {
        id = id.toString();
        if (this.selectedPerms.includes(id)) {
            this.selectedPerms = this.selectedPerms.filter(item => item !== id);
        } else {
            this.selectedPerms.push(id);
        }
    },

    isPermSelected(id) {
        return this.selectedPerms.includes(id.toString());
    },

    toggleAll() {
        const allIds = {{ json_encode($permissions->pluck('id')->map(fn($id) => (string)$id)->toArray()) }};
        if (this.selectedPerms.length === allIds.length) {
            this.selectedPerms = [];
        } else {
            this.selectedPerms = [...allIds];
        }
    },

    toggleGroup(groupItems) {
        const groupIds = groupItems.map(item => item.id.toString());
        const allInGroupSelected = groupIds.every(id => this.selectedPerms.includes(id));

        if (allInGroupSelected) {
            this.selectedPerms = this.selectedPerms.filter(id => !groupIds.includes(id));
        } else {
            const toAdd = groupIds.filter(id => !this.selectedPerms.includes(id));
            this.selectedPerms = [...this.selectedPerms, ...toAdd];
        }
    },

    isGroupAllSelected(groupItems) {
        const groupIds = groupItems.map(item => item.id.toString());
        return groupIds.length > 0 && groupIds.every(id => this.selectedPerms.includes(id));
    }
}" class="max-w-5xl mx-auto space-y-6 pb-12">

    {{-- Top Action & Breadcrumb Navigation Header --}}
    <div class="rounded-2xl bg-white border border-slate-200/90 shadow-sm overflow-hidden">
        <div class="h-1.5 w-full bg-gradient-to-r from-[#0B2B40] via-[#0F4C5C] to-[#10B981]"></div>

        <div class="p-5 sm:p-6 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div class="flex items-center gap-3.5">
                <a href="{{ route('roles.index') }}" 
                   title="ត្រឡប់ក្រោយ"
                   class="w-10 h-10 rounded-xl bg-slate-100 hover:bg-[#EEF7F0] text-slate-600 hover:text-[#0F4C5C] flex items-center justify-center transition-colors">
                    <i class="bi bi-arrow-left text-lg"></i>
                </a>
                <div>
                    <div class="flex items-center gap-2">
                        <h1 class="text-lg sm:text-xl font-bold text-[#0B2B40]">
                            បង្កើតតួនាទីថ្មី
                        </h1>
                        <span class="text-xs text-slate-400 font-medium">| Chhenla Bank PLC.</span>
                    </div>
                    <p class="text-xs text-slate-500 mt-0.5">
                        បង្កើតតួនាទី និងកំណត់សិទ្ធិប្រើប្រាស់សម្រាប់បុគ្គលិកធនាគារ
                    </p>
                </div>
            </div>

            <div class="flex items-center gap-2">
                <a href="{{ route('roles.index') }}" 
                   class="px-4 py-2 text-xs font-semibold text-slate-600 hover:bg-slate-100 rounded-xl transition-colors">
                    បោះបង់ (Cancel)
                </a>
            </div>
        </div>
    </div>

    {{-- Main Create Role Form --}}
    <form action="{{ route('roles.store') }}" method="POST" class="space-y-6">
        @csrf

        {{-- Section 1: Role Basic Information --}}
        <div class="bg-white rounded-2xl border border-slate-200/90 shadow-sm p-5 sm:p-6 space-y-5">
            <div class="flex items-center gap-2.5 pb-4 border-b border-slate-100">
                <div class="w-8 h-8 rounded-lg bg-[#0F4C5C]/10 text-[#0F4C5C] flex items-center justify-center font-bold text-sm">
                    1
                </div>
                <div>
                    <h2 class="text-sm font-bold text-slate-800">ព័ត៌មានទូទៅនៃតួនាទី (Role Information)</h2>
                    <p class="text-[11px] text-slate-500">កំណត់ឈ្មោះតួនាទី និងអត្តសញ្ញាណសម្គាល់ក្នុងប្រព័ន្ធ</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 items-start">
                <div class="md:col-span-2 space-y-2">
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider">
                        ឈ្មោះតួនាទី (Role Name) <span class="text-rose-500">*</span>
                    </label>
                    <div class="relative">
                        <i class="bi bi-shield-lock absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-sm"></i>
                        <input 
                            type="text" 
                            name="name" 
                            x-model="roleName"
                            required 
                            autofocus
                            placeholder="ឧ. ប្រធានសាខា (Branch Manager), បេឡាធិការ (Cashier)..."
                            class="w-full pl-10 pr-4 py-2.5 rounded-xl bg-white border @error('name') border-rose-400 focus:ring-rose-200 @else border-slate-200 focus:border-[#0F4C5C] focus:ring-[#0F4C5C]/10 @enderror text-xs text-slate-800 placeholder:text-slate-400 focus:outline-none focus:ring-2 transition-all shadow-2xs"
                        >
                    </div>
                    @error('name')
                        <p class="text-rose-500 text-[11px] mt-1.5 flex items-center gap-1">
                            <i class="bi bi-exclamation-circle-fill"></i> {{ $message }}
                        </p>
                    @enderror
                    <p class="text-[11px] text-slate-400">
                        ឈ្មោះតួនាទីត្រូវតែមានលក្ខណៈច្បាស់លាស់ និងមិនស្ទួនជាមួយតួនាទីដែលមានស្រាប់។
                    </p>
                </div>

                {{-- Live Role Badge Preview --}}
                <div class="p-4 rounded-xl bg-slate-50 border border-slate-200/80 space-y-2">
                    <span class="text-[10px] font-bold uppercase tracking-wider text-slate-400 block">ទម្រង់បង្ហាញផ្ទាល់ (Live Preview)</span>
                    <div class="flex items-center gap-2.5">
                        <div class="w-8 h-8 rounded-lg bg-[#0F4C5C]/10 text-[#0F4C5C] flex items-center justify-center font-bold text-xs shrink-0">
                            <i class="bi bi-shield-check"></i>
                        </div>
                        <div class="min-w-0">
                            <span class="block text-xs font-bold text-slate-800 truncate" x-text="roleName.trim() ? roleName : 'ឈ្មោះតួនាទីរបស់អ្នក'"></span>
                            <span class="text-[10px] text-slate-400">Chhenla Bank Staff Role</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Section 2: Permissions Assignment Matrix --}}
        <div class="bg-white rounded-2xl border border-slate-200/90 shadow-sm p-5 sm:p-6 space-y-5">
            
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-4 border-b border-slate-100">
                <div class="flex items-center gap-2.5">
                    <div class="w-8 h-8 rounded-lg bg-[#10B981]/15 text-[#0F4C5C] flex items-center justify-center font-bold text-sm">
                        2
                    </div>
                    <div>
                        <h2 class="text-sm font-bold text-slate-800">កំណត់សិទ្ធិប្រើប្រាស់ (Permission Matrix)</h2>
                        <p class="text-[11px] text-slate-500">ជ្រើសរើសសិទ្ធិដែលតួនាទីនេះត្រូវបានអនុញ្ញាតឱ្យប្រើប្រាស់</p>
                    </div>
                </div>

                {{-- Master Control & Counter --}}
                <div class="flex items-center gap-3">
                    <div class="text-xs font-semibold px-3 py-1.5 rounded-lg bg-[#EEF7F0] text-[#0F4C5C] border border-[#10B981]/30">
                        បានជ្រើសរើស <strong x-text="selectedPerms.length"></strong> / <span x-text="totalPerms"></span> សិទ្ធិ
                    </div>

                    <button 
                        type="button" 
                        @click="toggleAll()" 
                        class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-slate-100 hover:bg-[#EEF7F0] text-slate-700 hover:text-[#0F4C5C] text-xs font-bold transition-colors">
                        <i class="bi bi-check-all text-sm"></i>
                        <span x-text="selectedPerms.length === totalPerms ? 'ដោះជ្រើសរើសទាំងអស់ (Deselect All)' : 'ជ្រើសរើសទាំងអស់ (Select All)'"></span>
                    </button>
                </div>
            </div>

            {{-- Permission Quick Search --}}
            <div class="relative max-w-sm">
                <i class="bi bi-search absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>
                <input 
                    type="text" 
                    x-model="searchQuery" 
                    placeholder="ស្វែងរកសិទ្ធិក្នុងបញ្ជី... (Filter permissions)" 
                    class="w-full pl-8 pr-3 py-1.5 text-xs bg-slate-50 border border-slate-200 rounded-lg focus:outline-none focus:bg-white focus:border-[#0F4C5C] text-slate-800 placeholder:text-slate-400 transition-all"
                >
            </div>

            {{-- Grouped Permissions Modules --}}
            <div class="space-y-5">
                @foreach($groupedPermissions as $group)
                    <div class="rounded-xl border border-slate-200/80 bg-slate-50/40 p-4 space-y-3"
                         x-data="{ groupItems: {{ json_encode($group['items']) }} }"
                         x-show="!searchQuery || groupItems.some(i => i.name.toLowerCase().includes(searchQuery.toLowerCase()))">
                        
                        {{-- Module Header with Group Toggle --}}
                        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2 pb-2.5 border-b border-slate-200/70">
                            <div class="flex items-center gap-2.5">
                                <div class="w-7 h-7 rounded-lg bg-[#0F4C5C]/10 text-[#0F4C5C] flex items-center justify-center text-xs shrink-0">
                                    <i class="bi {{ $group['icon'] }}"></i>
                                </div>
                                <div>
                                    <h3 class="text-xs font-bold text-slate-800">{{ $group['title'] }}</h3>
                                    <p class="text-[10px] text-slate-400">{{ $group['desc'] }}</p>
                                </div>
                            </div>

                            <button 
                                type="button" 
                                @click="toggleGroup(groupItems)"
                                class="inline-flex items-center gap-1.5 text-[11px] font-semibold text-[#0F4C5C] hover:text-[#10B981] self-start sm:self-auto bg-white px-2.5 py-1 rounded-md border border-slate-200/80 shadow-2xs hover:bg-[#EEF7F0] transition-colors">
                                <i class="bi bi-check2-circle text-xs"></i>
                                <span x-text="isGroupAllSelected(groupItems) ? 'ដោះចេញពីក្រុម' : 'ជ្រើសទាំងអស់ក្នុងក្រុម'"></span>
                            </button>
                        </div>

                        {{-- Permission Items Grid --}}
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-2.5 pt-1">
                            @foreach($group['items'] as $permission)
                                <label 
                                    x-show="!searchQuery || '{{ strtolower($permission->name) }}'.includes(searchQuery.toLowerCase())"
                                    @click.prevent="togglePermission('{{ $permission->id }}')"
                                    :class="isPermSelected('{{ $permission->id }}') 
                                        ? 'border-[#10B981] bg-[#EEF7F0]/60 text-[#0F4C5C] ring-1 ring-[#10B981]/40' 
                                        : 'border-slate-200 bg-white hover:border-slate-300 text-slate-700'"
                                    class="flex items-center gap-2.5 p-2.5 rounded-xl border transition-all cursor-pointer select-none group shadow-2xs">
                                    
                                    {{-- Hidden Form Input --}}
                                    <input 
                                        type="checkbox" 
                                        name="permissions[]" 
                                        value="{{ $permission->id }}" 
                                        :checked="isPermSelected('{{ $permission->id }}')"
                                        class="hidden"
                                    >

                                    {{-- Custom Styled Checkbox Pill --}}
                                    <div :class="isPermSelected('{{ $permission->id }}') ? 'bg-[#10B981] text-white border-[#10B981]' : 'border-slate-300 bg-white text-transparent'"
                                         class="w-4 h-4 rounded-md border flex items-center justify-center transition-colors shrink-0">
                                        <i class="bi bi-check-lg text-xs leading-none"></i>
                                    </div>

                                    <div class="min-w-0 flex-1">
                                        <span class="block text-xs font-semibold truncate"
                                              :class="isPermSelected('{{ $permission->id }}') ? 'text-[#0B2B40] font-bold' : 'text-slate-700'">
                                            {{ $permission->name }}
                                        </span>
                                        <span class="text-[10px] text-slate-400">ID: #{{ $permission->id }}</span>
                                    </div>
                                </label>
                            @endforeach
                        </div>

                    </div>
                @endforeach
            </div>

            @if($permissions->isEmpty())
                <div class="py-8 text-center text-slate-400 text-xs">
                    <i class="bi bi-shield-x text-2xl block mb-1"></i>
                    មិនទាន់មានទិន្នន័យសិទ្ធិក្នុងប្រព័ន្ធឡើយ។
                </div>
            @endif

        </div>

        {{-- Form Actions Bar --}}
        <div class="flex items-center justify-between bg-white p-4 sm:p-5 rounded-2xl border border-slate-200/90 shadow-sm">
            <a href="{{ route('roles.index') }}" 
               class="px-4 py-2 text-xs font-semibold text-slate-600 hover:bg-slate-100 rounded-xl transition-colors">
                បោះបង់ (Cancel)
            </a>

            <div class="flex items-center gap-3">
                <button 
                    type="submit" 
                    class="inline-flex items-center gap-2 px-6 py-2.5 bg-gradient-to-r from-[#0F4C5C] to-[#10B981] hover:from-[#0B2B40] hover:to-[#059669] text-white font-bold text-xs rounded-xl shadow-sm hover:shadow transition-all duration-200 active:scale-[0.98]">
                    <i class="bi bi-check-circle-fill"></i>
                    <span>រក្សាទុកតួនាទី (Save Role)</span>
                </button>
            </div>
        </div>

    </form>

</div>
@endsection

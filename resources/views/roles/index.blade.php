@extends('layouts.master')

@section('title', 'PAWNDESK | ការកំណត់តួនាទី')
@section('header_title', 'បញ្ជីតួនាទី & សិទ្ធិ')

@section('content')
<div class="space-y-4">
    <!-- Top Action & Info Header -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 bg-white p-4 rounded-2xl border border-slate-100 shadow-sm">
        <div>
            <h2 class="text-base font-bold text-slate-800 flex items-center gap-2">
                <i class="bi bi-shield-lock text-amber-500"></i>
                <span>បញ្ជីតួនាទី (Roles List)</span>
            </h2>
            <p class="text-xs text-slate-500 mt-0.5">គ្រប់គ្រងតួនាទី កំណត់សិទ្ធិប្រើប្រាស់ និងសកម្មភាពរបស់អ្នកប្រើប្រាស់ក្នុងប្រព័ន្ធ</p>
        </div>

        <a href="{{ route('roles.create') }}" class="inline-flex items-center justify-center gap-2 px-4 py-2 bg-gradient-to-r from-amber-500 to-orange-500 hover:from-amber-600 hover:to-orange-600 text-white font-semibold text-xs rounded-xl shadow-sm hover:shadow transition-all duration-200">
            <i class="bi bi-plus-circle-fill text-sm"></i>
            <span>បង្កើតតួនាទីថ្មី (Add Role)</span>
        </a>
    </div>

    <!-- Data Table Card Container -->
    <div class="dashboard-card overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50/80 border-b border-slate-100 text-[11px] uppercase tracking-wider font-bold text-slate-500">
                        <th class="py-3.5 px-5">ឈ្មោះតួនាទី (Role Name)</th>
                        <th class="py-3.5 px-5">សិទ្ធិទទួលបាន (Permissions)</th>
                        <th class="py-3.5 px-5 text-center">ចំនួនអ្នកប្រើប្រាស់ (Users)</th>
                        <th class="py-3.5 px-5 text-right">សកម្មភាព (Actions)</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-xs">
                    @forelse($roles as $role)
                        <tr class="hover:bg-slate-50/60 transition-colors group">
                            <!-- Role Name -->
                            <td class="py-3.5 px-5 font-bold text-slate-800 whitespace-nowrap">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-lg bg-amber-50 text-amber-600 flex items-center justify-center border border-amber-100 group-hover:bg-amber-500 group-hover:text-white transition-colors">
                                        <i class="bi bi-shield-check text-sm"></i>
                                    </div>
                                    <div>
                                        <span class="block text-slate-800 font-bold">{{ $role->name }}</span>
                                        <span class="text-[10px] font-normal text-slate-400 uppercase tracking-wider">ID: #{{ $role->id }}</span>
                                    </div>
                                </div>
                            </td>

                            <!-- Permissions List Badges -->
                            <td class="py-3.5 px-5">
                                <div class="flex flex-wrap gap-1.5 max-w-xl">
                                    @forelse($role->permissions as $permission)
                                        <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg bg-slate-100 text-slate-600 border border-slate-200/60 text-[11px] font-medium">
                                            <i class="bi bi-check2 text-amber-500 text-[10px]"></i>
                                            {{ $permission->name }}
                                        </span>
                                    @empty
                                        <span class="text-slate-400 italic text-[11px] flex items-center gap-1">
                                            <i class="bi bi-exclamation-circle text-xs"></i> គ្មានសិទ្ធិត្រូវបានទួលស្គាល់ឡើយ
                                        </span>
                                    @endforelse
                                </div>
                            </td>

                            <!-- User Count Badge (Feature Addition) -->
                            <td class="py-3.5 px-5 text-center whitespace-nowrap">
                                <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full bg-amber-50 text-amber-700 border border-amber-200/60 font-semibold text-[11px]">
                                    <i class="bi bi-person text-xs"></i>
                                    {{ $role->users_count ?? $role->users()->count() }} នាក់
                                </span>
                            </td>

                            <!-- Actions -->
                            <td class="py-3.5 px-5 text-right whitespace-nowrap">
                                <div class="flex items-center justify-end gap-1.5">
                                    <!-- Edit Link -->
                                    <a href="{{ route('roles.edit', $role->id) }}" 
                                       title="កែប្រែ"
                                       class="w-8 h-8 rounded-lg bg-slate-100 hover:bg-amber-100 text-slate-600 hover:text-amber-700 flex items-center justify-center transition-colors">
                                        <i class="bi bi-pencil"></i>
                                    </a>

                                    <!-- Delete Button Form -->
                                    <form action="{{ route('roles.destroy', $role->id) }}" method="POST" class="inline" onsubmit="return confirm('តើអ្នកពិតជាចង់លុបតួនាទីនេះមែនទេ?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                title="លុប"
                                                class="w-8 h-8 rounded-lg bg-slate-100 hover:bg-rose-100 text-slate-600 hover:text-rose-600 flex items-center justify-center transition-colors">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <!-- Empty State -->
                        <tr>
                            <td colspan="4" class="py-12 text-center">
                                <div class="flex flex-col items-center justify-center">
                                    <div class="w-12 h-12 rounded-2xl bg-amber-50 text-amber-500 flex items-center justify-center mb-3 text-xl">
                                        <i class="bi bi-shield-x"></i>
                                    </div>
                                    <p class="text-slate-600 font-bold text-sm">មិនទាន់មានទិន្នន័យតួនាទីនៅឡើយទេ</p>
                                    <p class="text-slate-400 text-xs mt-0.5">សូមចុចប៊ូតុង "បង្កើតតួនាទីថ្មី" ដើម្បីបន្ថែមតួនាទីដំបូង</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
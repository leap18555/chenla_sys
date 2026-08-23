@extends('layouts.master')

@section('title', 'PAWNDESK | កែប្រែតួនាទី')

@section('content')
<div class="max-w-5xl mx-auto space-y-4">
    <form action="{{ route('roles.update', $role->id) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm space-y-6">
            
            <!-- Role Name -->
            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase mb-2">ឈ្មោះតួនាទី (Role Name) *</label>
                <input type="text" name="name" value="{{ old('name', $role->name) }}" required
                    class="w-full max-w-md px-4 py-2.5 rounded-xl border border-slate-200 text-xs text-slate-800 focus:outline-none focus:border-amber-400">
            </div>

            <!-- Permissions Checkboxes -->
            <div class="pt-4 border-t border-slate-100">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-xs font-bold text-slate-800 uppercase">សិទ្ធិទទួលបាន (Permissions)</h3>
                    <button type="button" onclick="toggleAllPermissions(this)" class="text-xs font-bold text-amber-600 hover:underline">
                        <span id="select-all-label">ជ្រើសរើសទាំងអស់ / ដោះបង់</span>
                    </button>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3">
                    @forelse($permissions as $permission)
                        <label for="perm-{{ $permission->id }}" class="flex items-center gap-3 p-3 rounded-xl border border-slate-200 hover:border-amber-300 transition-all cursor-pointer">
                            <input 
                                type="checkbox" 
                                name="permissions[]" 
                                value="{{ $permission->id }}" 
                                id="perm-{{ $permission->id }}"
                                class="permission-checkbox w-4 h-4 rounded text-amber-500 focus:ring-amber-400"
                                {{ (isset($rolePermissions) && in_array($permission->id, $rolePermissions)) || (is_array(old('permissions')) && in_array($permission->id, old('permissions'))) ? 'checked' : '' }}
                            >
                            <span class="text-xs font-semibold text-slate-700">{{ $permission->name }}</span>
                        </label>
                    @empty
                        <p class="text-xs text-slate-400 col-span-full">មិនទាន់មានសិទ្ធិក្នុងប្រព័ន្ធឡើយ (No permissions found in DB)</p>
                    @endforelse
                </div>
            </div>

            <!-- Buttons -->
            <div class="flex items-center justify-end gap-3 pt-4 border-t border-slate-100">
                <a href="{{ route('roles.index') }}" class="px-4 py-2 text-xs font-semibold text-slate-600 bg-slate-100 rounded-xl">បោះបង់ (Cancel)</a>
                <button type="submit" class="px-5 py-2.5 bg-amber-500 text-white font-bold text-xs rounded-xl hover:bg-amber-600">រក្សាទុក (Save Changes)</button>
            </div>
        </div>
    </form>
</div>
@endsection
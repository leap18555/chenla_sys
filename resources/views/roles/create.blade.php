@extends('layouts.master')

@section('title', 'PAWNDESK | បង្កើតតួនាទីថ្មី')
@section('header_title', 'បង្កើតតួនាទីថ្មី')

@section('content')
<div class="max-w-5xl mx-auto space-y-4">

    <!-- Top Header -->
    <div class="flex items-center justify-between bg-white p-4 rounded-2xl border border-slate-100 shadow-sm">
        <div class="flex items-center gap-3">
            <a href="{{ route('roles.index') }}" class="w-9 h-9 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-600 flex items-center justify-center transition-colors">
                <i class="bi bi-arrow-left text-base"></i>
            </a>
            <div>
                <h2 class="text-base font-bold text-slate-800">បង្កើតតួនាទី និងកំណត់សិទ្ធិ</h2>
                <p class="text-xs text-slate-500">បង្កើតតួនាទីថ្មី និងជ្រើសរើសសិទ្ធិប្រើប្រាស់សម្រាប់ប្រព័ន្ធ</p>
            </div>
        </div>

        <a href="{{ route('roles.index') }}" class="px-3.5 py-2 text-slate-600 hover:bg-slate-100 rounded-xl text-xs font-semibold transition-colors">
            បោះបង់ (Cancel)
        </a>
    </div>

    <!-- Main Form Card -->
    <form action="{{ route('roles.store') }}" method="POST" class="space-y-4">
        @csrf

        <div class="dashboard-card p-5 space-y-6">
            
            <!-- Role Name Input -->
            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                    ឈ្មោះតួនាទី (Role Name) <span class="text-rose-500">*</span>
                </label>
                <div class="relative max-w-md">
                    <i class="bi bi-shield-lock absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-sm"></i>
                    <input 
                        type="text" 
                        name="name" 
                        value="{{ old('name') }}"
                        required 
                        placeholder="ឧ. Editor, Manager, Cashier..."
                        class="w-full pl-9 pr-4 py-2.5 rounded-xl bg-white border @error('name') border-rose-400 focus:ring-rose-200 @else border-slate-200 focus:border-amber-400 focus:ring-amber-100 @enderror text-xs text-slate-800 placeholder:text-slate-400 focus:outline-none focus:ring-2 transition-all"
                    >
                </div>
                @error('name')
                    <p class="text-rose-500 text-[11px] mt-1.5 flex items-center gap-1">
                        <i class="bi bi-exclamation-circle"></i> {{ $message }}
                    </p>
                @enderror
            </div>

            <!-- Permissions Selection Header -->
            <div class="pt-4 border-t border-slate-100">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <h3 class="text-xs font-bold text-slate-800 uppercase tracking-wider">
                            ជ្រើសរើសសិទ្ធិប្រើប្រាស់ (Assign Permissions)
                        </h3>
                        <p class="text-slate-400 text-[11px] mt-0.5">សូមគូសធីកលើសិទ្ធិទាំងឡាយណាដែលតួនាទីនេះអាចប្រើប្រាស់បាន</p>
                    </div>

                    <!-- Select All Quick Toggle -->
                    <button 
                        type="button" 
                        onclick="toggleAllPermissions(this)" 
                        class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-slate-100 hover:bg-amber-100 text-slate-600 hover:text-amber-800 text-xs font-bold transition-colors"
                    >
                        <i class="bi bi-check-all text-sm"></i>
                        <span id="select-all-label">ជ្រើសរើសទាំងអស់ (Select All)</span>
                    </button>
                </div>

                <!-- Permission Checkboxes Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3">
                    @forelse($permissions as $permission)
                        <label 
                            for="perm-{{ $permission->id }}" 
                            class="flex items-center gap-3 p-3 rounded-xl border border-slate-200/80 hover:border-amber-300 hover:bg-amber-50/30 transition-all cursor-pointer group"
                        >
                            <input 
                                type="checkbox" 
                                name="permissions[]" 
                                value="{{ $permission->id }}" 
                                id="perm-{{ $permission->id }}"
                                class="permission-checkbox w-4 h-4 rounded border-slate-300 text-amber-500 focus:ring-amber-400 focus:ring-offset-0 cursor-pointer"
                                {{ is_array(old('permissions')) && in_array($permission->id, old('permissions')) ? 'checked' : '' }}
                            >
                            <div class="select-none">
                                <span class="block text-xs font-semibold text-slate-700 group-hover:text-amber-800">
                                    {{ $permission->name }}
                                </span>
                                <span class="text-[10px] text-slate-400">ID: #{{ $permission->id }}</span>
                            </div>
                        </label>
                    @empty
                        <div class="col-span-full py-8 text-center text-slate-400 text-xs">
                            <i class="bi bi-exclamation-triangle text-lg block mb-1"></i>
                            មិនទាន់មានសិទ្ធិនៅក្នុងប្រព័ន្ធនៅឡើយទេ
                        </div>
                    @endforelse
                </div>
            </div>

        </div>

        <!-- Submit Footer Button -->
        <div class="flex items-center justify-end gap-3 bg-white p-4 rounded-2xl border border-slate-100 shadow-sm">
            <a href="{{ route('roles.index') }}" class="px-4 py-2 text-xs font-semibold text-slate-600 hover:bg-slate-100 rounded-xl transition-colors">
                បោះបង់
            </a>
            <button 
                type="submit" 
                class="inline-flex items-center gap-2 px-5 py-2.5 bg-gradient-to-r from-amber-500 to-orange-500 hover:from-amber-600 hover:to-orange-600 text-white font-bold text-xs rounded-xl shadow-sm hover:shadow transition-all"
            >
                <i class="bi bi-check-circle-fill"></i>
                <span>រក្សាទុក (Save Role)</span>
            </button>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
    function toggleAllPermissions(button) {
        const checkboxes = document.querySelectorAll('.permission-checkbox');
        const label = document.getElementById('select-all-label');
        const allChecked = Array.from(checkboxes).every(cb => cb.checked);

        checkboxes.forEach(cb => cb.checked = !allChecked);
        
        if (allChecked) {
            label.innerText = 'ជ្រើសរើសទាំងអស់ (Select All)';
        } else {
            label.innerText = 'ដោះជ្រើសរើសទាំងអស់ (Deselect All)';
        }
    }
</script>
@endpush
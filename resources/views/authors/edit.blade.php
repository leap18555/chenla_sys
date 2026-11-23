@extends('layouts.master')

@section('header_title', 'កែប្រែអ្នកនិពន្ធ')

@section('content')
<div class="max-w-2xl mx-auto px-2">

    {{-- Back Link --}}
    <div class="mb-5">
        <a href="{{ route('authors.index') }}" class="inline-flex items-center gap-2 text-sm text-slate-500 hover:text-[#1a5276] font-medium transition-colors">
            <i class="bi bi-arrow-left"></i>
            <span>ត្រឡប់ទៅបញ្ជី</span>
        </a>
    </div>

    {{-- Form Card --}}
    <div class="bg-white rounded-2xl border border-slate-200/60 shadow-sm overflow-hidden">

        {{-- Card Header --}}
        <div class="px-6 py-5 border-b border-slate-100 bg-[#0d9488]">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 rounded-xl bg-white/15 flex items-center justify-center text-white">
                    <i class="bi bi-pencil-square text-lg"></i>
                </div>
                <div>
                    <h3 class="text-base font-bold text-white">កែប្រែអ្នកនិពន្ធ</h3>
                    <p class="text-xs text-white/60 mt-0.5">ធ្វើបច្ចុប្បន្នភាពព័ត៌មានអ្នកនិពន្ធ</p>
                </div>
            </div>
        </div>

        {{-- Card Body --}}
        <div class="p-6">
            <form action="{{ route('authors.update', $author->id) }}" method="POST">
                @csrf
                @method('PUT')

                {{-- Full Name --}}
                <div class="mb-5">
                    <label for="name" class="block text-sm font-semibold text-slate-700 mb-2">
                        ឈ្មោះពេញ <span class="text-rose-500">*</span>
                    </label>
                    <input type="text" name="name" id="name" value="{{ old('name', $author->name) }}" required
                        class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm text-slate-800 placeholder:text-slate-400 focus:outline-none focus:border-[#1a5276]/40 focus:ring-2 focus:ring-[#1a5276]/10 transition-all @error('name') border-rose-300 ring-2 ring-rose-100 @enderror"
                        placeholder="បញ្ចូលឈ្មោះពេញ">
                    @error('name')
                        <p class="mt-1.5 text-xs text-rose-500 flex items-center gap-1"><i class="bi bi-exclamation-circle"></i> {{ $message }}</p>
                    @enderror
                </div>

                {{-- Email --}}
                <div class="mb-5">
                    <label for="email" class="block text-sm font-semibold text-slate-700 mb-2">
                        អ៊ីមែល <span class="text-rose-500">*</span>
                    </label>
                    <input type="email" name="email" id="email" value="{{ old('email', $author->email) }}" required
                        class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm text-slate-800 placeholder:text-slate-400 focus:outline-none focus:border-[#1a5276]/40 focus:ring-2 focus:ring-[#1a5276]/10 transition-all @error('email') border-rose-300 ring-2 ring-rose-100 @enderror"
                        placeholder="example@email.com">
                    @error('email')
                        <p class="mt-1.5 text-xs text-rose-500 flex items-center gap-1"><i class="bi bi-exclamation-circle"></i> {{ $message }}</p>
                    @enderror
                </div>

                {{-- Phone --}}
                <div class="mb-5">
                    <label for="phone" class="block text-sm font-semibold text-slate-700 mb-2">
                        លេខទូរស័ព្ទ
                    </label>
                    <input type="text" name="phone" id="phone" value="{{ old('phone', $author->phone) }}"
                        class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm text-slate-800 placeholder:text-slate-400 focus:outline-none focus:border-[#1a5276]/40 focus:ring-2 focus:ring-[#1a5276]/10 transition-all @error('phone') border-rose-300 ring-2 ring-rose-100 @enderror"
                        placeholder="012 345 678">
                    @error('phone')
                        <p class="mt-1.5 text-xs text-rose-500 flex items-center gap-1"><i class="bi bi-exclamation-circle"></i> {{ $message }}</p>
                    @enderror
                </div>

                {{-- Website --}}
                <div class="mb-5">
                    <label for="website" class="block text-sm font-semibold text-slate-700 mb-2">
                        គេហទំព័រ
                    </label>
                    <input type="url" name="website" id="website" value="{{ old('website', $author->website) }}"
                        class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm text-slate-800 placeholder:text-slate-400 focus:outline-none focus:border-[#1a5276]/40 focus:ring-2 focus:ring-[#1a5276]/10 transition-all @error('website') border-rose-300 ring-2 ring-rose-100 @enderror"
                        placeholder="https://example.com">
                    @error('website')
                        <p class="mt-1.5 text-xs text-rose-500 flex items-center gap-1"><i class="bi bi-exclamation-circle"></i> {{ $message }}</p>
                    @enderror
                </div>

                {{-- Active Status --}}
                <div class="mb-6">
                    <label class="flex items-center gap-3 cursor-pointer group">
                        <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', $author->is_active) ? 'checked' : '' }}
                            class="w-4.5 h-4.5 rounded border-slate-300 text-[#22a86a] focus:ring-[#22a86a]/20 cursor-pointer">
                        <span class="text-sm font-medium text-slate-700 group-hover:text-slate-900 transition-colors">ស្ថានភាពសកម្ម</span>
                    </label>
                </div>

                {{-- Actions --}}
                <div class="flex items-center justify-between pt-5 border-t border-slate-100">
                    <a href="{{ route('authors.index') }}" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl border border-slate-200 text-sm font-semibold text-slate-600 hover:bg-slate-50 transition-colors">
                        <i class="bi bi-x-lg text-xs"></i>
                        <span>បោះបង់</span>
                    </a>
                    <button type="submit" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-[#1a5276] hover:bg-[#154363] text-white text-sm font-semibold shadow-sm transition-colors">
                        <i class="bi bi-check-lg"></i>
                        <span>រក្សាទុកការផ្លាស់ប្ដូរ</span>
                    </button>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection

@extends('layouts.master')

@section('header_title', 'ព័ត៌មានអ្នកនិពន្ធ')

@section('content')
<div class="max-w-2xl mx-auto px-2">

    {{-- Back Link --}}
    <div class="mb-5">
        <a href="{{ route('authors.index') }}" class="inline-flex items-center gap-2 text-sm text-slate-500 hover:text-[#1a5276] font-medium transition-colors">
            <i class="bi bi-arrow-left"></i>
            <span>ត្រឡប់ទៅបញ្ជី</span>
        </a>
    </div>

    {{-- Detail Card --}}
    <div class="bg-white rounded-2xl border border-slate-200/60 shadow-sm overflow-hidden">

        {{-- Card Header --}}
        <div class="px-6 py-5 border-b border-slate-100 bg-[#1a5276] flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-white/15 flex items-center justify-center text-white font-bold text-base">
                    {{ strtoupper(substr($author->name, 0, 1)) }}
                </div>
                <div>
                    <h3 class="text-base font-bold text-white">{{ $author->name }}</h3>
                    <p class="text-xs text-white/60 mt-0.5">ព័ត៌មានលម្អិតអ្នកនិពន្ធ</p>
                </div>
            </div>
            <a href="{{ route('authors.edit', $author->id) }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-white/15 hover:bg-white/25 text-white text-xs font-semibold transition-colors">
                <i class="bi bi-pencil-square"></i>
                <span>កែប្រែ</span>
            </a>
        </div>

        {{-- Card Body --}}
        <div class="p-6">
            <div class="space-y-0 divide-y divide-slate-100">

                {{-- ID --}}
                <div class="flex items-center py-4 first:pt-0">
                    <div class="w-40 flex items-center gap-2 text-sm text-slate-500 font-medium shrink-0">
                        <i class="bi bi-hash text-slate-400"></i>
                        <span>លេខសម្គាល់</span>
                    </div>
                    <div class="text-sm text-slate-800 font-semibold">{{ $author->id }}</div>
                </div>

                {{-- Name --}}
                <div class="flex items-center py-4">
                    <div class="w-40 flex items-center gap-2 text-sm text-slate-500 font-medium shrink-0">
                        <i class="bi bi-person text-slate-400"></i>
                        <span>ឈ្មោះ</span>
                    </div>
                    <div class="text-sm text-slate-800 font-semibold">{{ $author->name }}</div>
                </div>

                {{-- Email --}}
                <div class="flex items-center py-4">
                    <div class="w-40 flex items-center gap-2 text-sm text-slate-500 font-medium shrink-0">
                        <i class="bi bi-envelope text-slate-400"></i>
                        <span>អ៊ីមែល</span>
                    </div>
                    <div class="text-sm text-[#1a5276] font-medium">{{ $author->email }}</div>
                </div>

                {{-- Phone --}}
                <div class="flex items-center py-4">
                    <div class="w-40 flex items-center gap-2 text-sm text-slate-500 font-medium shrink-0">
                        <i class="bi bi-telephone text-slate-400"></i>
                        <span>ទូរស័ព្ទ</span>
                    </div>
                    <div class="text-sm text-slate-800 font-medium">{{ $author->phone ?? 'មិនមាន' }}</div>
                </div>

                {{-- Website --}}
                <div class="flex items-center py-4">
                    <div class="w-40 flex items-center gap-2 text-sm text-slate-500 font-medium shrink-0">
                        <i class="bi bi-globe text-slate-400"></i>
                        <span>គេហទំព័រ</span>
                    </div>
                    <div class="text-sm">
                        @if($author->website)
                            <a href="{{ $author->website }}" target="_blank" class="text-[#1a5276] hover:text-[#0d9488] font-medium transition-colors inline-flex items-center gap-1">
                                {{ $author->website }}
                                <i class="bi bi-box-arrow-up-right text-xs"></i>
                            </a>
                        @else
                            <span class="text-slate-400">មិនមាន</span>
                        @endif
                    </div>
                </div>

                {{-- Status --}}
                <div class="flex items-center py-4">
                    <div class="w-40 flex items-center gap-2 text-sm text-slate-500 font-medium shrink-0">
                        <i class="bi bi-circle-fill text-xs text-slate-400"></i>
                        <span>ស្ថានភាព</span>
                    </div>
                    <div>
                        @if($author->is_active)
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-emerald-50 text-emerald-700 text-xs font-semibold">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                សកម្ម
                            </span>
                        @else
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-slate-100 text-slate-500 text-xs font-semibold">
                                <span class="w-1.5 h-1.5 rounded-full bg-slate-400"></span>
                                អសកម្ម
                            </span>
                        @endif
                    </div>
                </div>

                {{-- Created At --}}
                <div class="flex items-center py-4 last:pb-0">
                    <div class="w-40 flex items-center gap-2 text-sm text-slate-500 font-medium shrink-0">
                        <i class="bi bi-calendar3 text-slate-400"></i>
                        <span>ថ្ងៃបង្កើត</span>
                    </div>
                    <div class="text-sm text-slate-800 font-medium">{{ $author->created_at->format('Y-m-d H:i') }}</div>
                </div>

            </div>

            {{-- Back Button --}}
            <div class="mt-6 pt-5 border-t border-slate-100">
                <a href="{{ route('authors.index') }}" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl border border-slate-200 text-sm font-semibold text-slate-600 hover:bg-slate-50 transition-colors">
                    <i class="bi bi-arrow-left text-xs"></i>
                    <span>ត្រឡប់ទៅបញ្ជី</span>
                </a>
            </div>
        </div>
    </div>

</div>
@endsection

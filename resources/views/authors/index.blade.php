@extends('layouts.master')

@section('header_title', 'អ្នកនិពន្ធ')

@section('content')
<div class="max-w-7xl mx-auto px-2">

    {{-- Page Header --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
        <div>
            <h2 class="text-xl font-bold text-slate-800">បញ្ជីអ្នកនិពន្ធ</h2>
            <p class="text-sm text-slate-400 mt-1">គ្រប់គ្រងព័ត៌មានអ្នកនិពន្ធទាំងអស់នៅក្នុងប្រព័ន្ធ</p>
        </div>
        <a href="{{ route('authors.create') }}" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-[#22a86a] hover:bg-[#1e9660] text-white text-sm font-semibold shadow-sm transition-colors">
            <i class="bi bi-plus-lg"></i>
            <span>បន្ថែមអ្នកនិពន្ធថ្មី</span>
        </a>
    </div>

    {{-- Success Alert --}}
    @if(session('success'))
        <div class="mb-5 flex items-center gap-3 p-4 rounded-xl bg-emerald-50 border border-emerald-200/60 text-emerald-800 text-sm" x-data="{ show: true }" x-show="show" x-transition>
            <i class="bi bi-check-circle-fill text-emerald-500 text-base"></i>
            <span class="flex-1 font-medium">{{ session('success') }}</span>
            <button @click="show = false" class="text-emerald-400 hover:text-emerald-600 transition-colors">
                <i class="bi bi-x-lg text-sm"></i>
            </button>
        </div>
    @endif

    {{-- Table Card --}}
    <div class="bg-white rounded-2xl border border-slate-200/60 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="bg-slate-50/80 border-b border-slate-200/60">
                        <th class="text-left py-3.5 px-5 font-semibold text-slate-500 text-xs uppercase tracking-wider">លេខ</th>
                        <th class="text-left py-3.5 px-5 font-semibold text-slate-500 text-xs uppercase tracking-wider">ឈ្មោះ</th>
                        <th class="text-left py-3.5 px-5 font-semibold text-slate-500 text-xs uppercase tracking-wider">អ៊ីមែល</th>
                        <th class="text-left py-3.5 px-5 font-semibold text-slate-500 text-xs uppercase tracking-wider">ទូរស័ព្ទ</th>
                        <th class="text-left py-3.5 px-5 font-semibold text-slate-500 text-xs uppercase tracking-wider">ស្ថានភាព</th>
                        <th class="text-center py-3.5 px-5 font-semibold text-slate-500 text-xs uppercase tracking-wider">សកម្មភាព</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($authors as $author)
                    <tr class="hover:bg-slate-50/50 transition-colors">
                        <td class="py-3.5 px-5 text-slate-500 font-medium">{{ $author->id }}</td>
                        <td class="py-3.5 px-5">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-lg bg-[#1a5276]/10 text-[#1a5276] flex items-center justify-center text-xs font-bold">
                                    {{ strtoupper(substr($author->name, 0, 1)) }}
                                </div>
                                <span class="font-semibold text-slate-800">{{ $author->name }}</span>
                            </div>
                        </td>
                        <td class="py-3.5 px-5 text-slate-500">{{ $author->email }}</td>
                        <td class="py-3.5 px-5 text-slate-500">{{ $author->phone ?? 'មិនមាន' }}</td>
                        <td class="py-3.5 px-5">
                            @if($author->is_active)
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-emerald-50 text-emerald-700 text-xs font-semibold">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                    សកម្ម
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-slate-100 text-slate-500 text-xs font-semibold">
                                    <span class="w-1.5 h-1.5 rounded-full bg-slate-400"></span>
                                    អសកម្ម
                                </span>
                            @endif
                        </td>
                        <td class="py-3.5 px-5">
                            <div class="flex items-center justify-center gap-1.5">
                                <a href="{{ route('authors.show', $author->id) }}" class="p-2 rounded-lg text-slate-400 hover:text-[#1a5276] hover:bg-[#1a5276]/5 transition-colors" title="មើល">
                                    <i class="bi bi-eye text-sm"></i>
                                </a>
                                <a href="{{ route('authors.edit', $author->id) }}" class="p-2 rounded-lg text-slate-400 hover:text-[#0d9488] hover:bg-[#0d9488]/5 transition-colors" title="កែប្រែ">
                                    <i class="bi bi-pencil-square text-sm"></i>
                                </a>
                                <form action="{{ route('authors.destroy', $author->id) }}" method="POST" class="inline" onsubmit="return confirm('តើអ្នកពិតជាចង់លុបអ្នកនិពន្ធនេះមែនទេ?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-2 rounded-lg text-slate-400 hover:text-rose-500 hover:bg-rose-50 transition-colors" title="លុប">
                                        <i class="bi bi-trash3 text-sm"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="py-16 text-center">
                            <div class="flex flex-col items-center gap-3">
                                <div class="w-14 h-14 rounded-2xl bg-slate-100 flex items-center justify-center text-slate-300">
                                    <i class="bi bi-person-x text-2xl"></i>
                                </div>
                                <p class="text-sm text-slate-400 font-medium">មិនមានអ្នកនិពន្ធនៅឡើយទេ</p>
                                <a href="{{ route('authors.create') }}" class="text-sm text-[#1a5276] hover:text-[#0d9488] font-semibold transition-colors">
                                    <i class="bi bi-plus-lg mr-1"></i> បន្ថែមអ្នកនិពន្ធថ្មី
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        @if($authors->hasPages())
        <div class="px-5 py-4 border-t border-slate-100 flex justify-end">
            {{ $authors->links() }}
        </div>
        @endif
    </div>

</div>
@endsection

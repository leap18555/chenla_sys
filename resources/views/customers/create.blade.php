@extends('layouts.master')

@section('title', 'New Customer | MyBank Sunset')

@section('content')
<div class="max-w-4xl mx-auto space-y-8 animate-in slide-in-from-bottom-4 duration-700 pb-20">
    
    <div class="flex items-center gap-4">
        <a href="{{ route('customers.index') }}" 
           class="w-10 h-10 flex items-center justify-center rounded-xl bg-white text-slate-400 hover:text-[#FF5F6D] transition-all shadow-sm border border-orange-50">
            <i class="bi bi-arrow-left"></i>
        </a>
        <div>
            <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">Create Customer Registry</h1>
            <p class="text-slate-500 text-sm">Fill in Identity and Family Book information.</p>
        </div>
    </div>

    <div class="glass-card rounded-[2.5rem] p-10 shadow-xl shadow-orange-900/5 border-white">
        
        @if(session('success'))
            <div class="bg-emerald-50 border border-emerald-100 text-emerald-600 p-4 rounded-2xl mb-6 flex items-center gap-3">
                <i class="bi bi-check-circle-fill"></i>
                <span class="text-sm font-bold">{{ session('success') }}</span>
            </div>
        @endif

        {{-- IMPORTANT: Added enctype for image uploads --}}
        <form action="{{ route('customers.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
            @csrf

            <div class="space-y-6">
                <h2 class="text-sm font-black text-orange-400 uppercase tracking-widest border-b border-orange-50 pb-2">1. Personal Details</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="md:col-span-2">
                        <label class="block text-[11px] uppercase tracking-widest text-slate-400 font-black mb-2 ml-1">Full Name</label>
                        <input type="text" name="name" class="w-full bg-white/50 border border-orange-100 rounded-2xl px-5 py-3.5 focus:border-[#FF5F6D] outline-none transition-all" placeholder="Enter Full Name" required>
                    </div>
                    <div>
                        <label class="block text-[11px] uppercase tracking-widest text-slate-400 font-black mb-2 ml-1">Email</label>
                        <input type="email" name="email" class="w-full bg-white/50 border border-orange-100 rounded-2xl px-5 py-3.5 focus:border-[#FF5F6D] outline-none" placeholder="example@mail.com" required>
                    </div>
                    <div>
                        <label class="block text-[11px] uppercase tracking-widest text-slate-400 font-black mb-2 ml-1">Phone</label>
                        <input type="text" name="phone" class="w-full bg-white/50 border border-orange-100 rounded-2xl px-5 py-3.5 focus:border-[#FF5F6D] outline-none" placeholder="012 345 678" required>
                    </div>
                </div>
            </div>

            <div class="space-y-6 bg-blue-50/30 p-6 rounded-[2rem] border border-blue-100">
                <h2 class="text-sm font-black text-blue-500 uppercase tracking-widest border-b border-blue-100 pb-2 flex items-center gap-2">
                    <i class="bi bi-card-heading"></i> Khmer Identity Card
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-[11px] uppercase tracking-widest text-blue-400 font-black mb-2 ml-1">ID Number (Nº)</label>
                        <input type="text" name="id_number" class="w-full bg-white border border-blue-100 rounded-2xl px-5 py-3.5 focus:border-blue-500 outline-none" placeholder="012345678">
                    </div>
                    <div>
                        <label class="block text-[11px] uppercase tracking-widest text-blue-400 font-black mb-2 ml-1">Date of Birth</label>
                        <input type="date" name="dob" class="w-full bg-white border border-blue-100 rounded-2xl px-5 py-3.5 focus:border-blue-500 outline-none">
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-[11px] uppercase tracking-widest text-blue-400 font-black mb-2 ml-1">Place of Birth</label>
                        <input type="text" name="pob" class="w-full bg-white border border-blue-100 rounded-2xl px-5 py-3.5 focus:border-blue-500 outline-none" placeholder="Province/City">
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-[11px] uppercase tracking-widest text-blue-400 font-black mb-2 ml-1">Upload ID Photo (Portrait)</label>
                        <input type="file" name="id_photo" class="w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-black file:bg-blue-600 file:text-white hover:file:bg-blue-700">
                    </div>
                </div>
            </div>

            <div class="space-y-6 bg-pink-50/30 p-6 rounded-[2rem] border border-pink-100">
                <h2 class="text-sm font-black text-pink-500 uppercase tracking-widest border-b border-pink-100 pb-2 flex items-center gap-2">
                    <i class="bi bi-book"></i> Family Book Details
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <label class="block text-[11px] uppercase tracking-widest text-pink-400 font-black mb-2 ml-1">House No.</label>
                        <input type="text" name="house_no" class="w-full bg-white border border-pink-100 rounded-2xl px-5 py-3.5 focus:border-pink-500 outline-none" placeholder="12A">
                    </div>
                    <div>
                        <label class="block text-[11px] uppercase tracking-widest text-pink-400 font-black mb-2 ml-1">Street</label>
                        <input type="text" name="street" class="w-full bg-white border border-pink-100 rounded-2xl px-5 py-3.5 focus:border-pink-500 outline-none" placeholder="271">
                    </div>
                    <div>
                        <label class="block text-[11px] uppercase tracking-widest text-pink-400 font-black mb-2 ml-1">District/Khan</label>
                        <input type="text" name="district" class="w-full bg-white border border-pink-100 rounded-2xl px-5 py-3.5 focus:border-pink-500 outline-none" placeholder="Sen Sok">
                    </div>
                    <div class="md:col-span-3">
                        <label class="block text-[11px] uppercase tracking-widest text-pink-400 font-black mb-2 ml-1">Upload Family Photo</label>
                        <input type="file" name="family_photo" class="w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-black file:bg-pink-600 file:text-white hover:file:bg-pink-700">
                    </div>
                </div>
            </div>

            <div class="pt-6 flex items-center justify-end gap-4 border-t border-orange-50">
                <a href="{{ route('customers.index') }}" class="px-6 py-3 text-sm font-bold text-slate-400 hover:text-slate-600">Discard</a>
                <button type="submit" class="sunset-gradient text-white px-10 py-4 rounded-2xl font-bold shadow-lg shadow-orange-500/30 hover:scale-[1.02] transition-all flex items-center gap-2">
                    <i class="bi bi-check-all text-xl"></i> Create Member Profile
                </button>
            </div>

        </form>
    </div>
</div>
@endsection
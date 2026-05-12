@extends('layouts.master')

@section('content')
<div class="min-h-screen bg-[#F8F9FA] py-12 px-4">
    <div class="max-w-3xl mx-auto">
        
        <div class="flex items-start gap-4 mb-8">
            <a href="{{ route('customers.index') }}" class="p-2 bg-white rounded-lg shadow-sm border border-slate-100 hover:bg-slate-50 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </a>
            <div>
                <h2 class="text-3xl font-bold text-slate-800">Edit Customer</h2>
                <p class="text-slate-500">Update the profile information and contact details.</p>
            </div>
        </div>

        <div class="bg-white rounded-[2.5rem] shadow-xl shadow-slate-200/50 p-10 md:p-16">
            <form action="{{ route('customers.update', $customer->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    
                    <div class="md:col-span-2">
                        <label class="block text-[11px] font-bold text-orange-400 uppercase tracking-widest mb-2 ml-1">Full Name</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-orange-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                            </div>
                            <input type="text" name="name" value="{{ old('name', $customer->name) }}"
                                   class="block w-full pl-12 pr-4 py-4 bg-white border border-orange-100 rounded-2xl focus:ring-4 focus:ring-orange-50 focus:border-orange-200 text-slate-600 placeholder-slate-300 transition duration-200">
                        </div>
                    </div>

                    <div>
                        <label class="block text-[11px] font-bold text-orange-400 uppercase tracking-widest mb-2 ml-1">Email Address</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-orange-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg>
                            </div>
                            <input type="email" name="email" value="{{ old('email', $customer->email) }}"
                                   class="block w-full pl-12 pr-4 py-4 bg-white border border-orange-100 rounded-2xl focus:ring-4 focus:ring-orange-50 focus:border-orange-200 text-slate-600 placeholder-slate-300 transition duration-200">
                        </div>
                    </div>

                    <div>
                        <label class="block text-[11px] font-bold text-orange-400 uppercase tracking-widest mb-2 ml-1">Phone Number</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-orange-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" /></svg>
                            </div>
                            <input type="text" name="phone" value="{{ old('phone', $customer->phone) }}"
                                   class="block w-full pl-12 pr-4 py-4 bg-white border border-orange-100 rounded-2xl focus:ring-4 focus:ring-orange-50 focus:border-orange-200 text-slate-600 placeholder-slate-300 transition duration-200">
                        </div>
                    </div>

                </div>

                <div class="mt-16 flex items-center justify-end gap-8">
                    <a href="{{ route('customers.index') }}" class="text-slate-400 font-semibold hover:text-slate-600 transition">
                        Discard
                    </a>
                    <button type="submit"
                            class="flex items-center gap-2 px-10 py-4 bg-gradient-to-r from-[#F07B7B] to-[#F9B37A] text-white rounded-2xl font-bold shadow-lg shadow-orange-200 hover:opacity-90 transition transform active:scale-95">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                        Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
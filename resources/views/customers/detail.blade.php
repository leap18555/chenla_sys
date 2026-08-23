@extends('layouts.master')

@section('title', 'Customer Details | Chhenla Bank')

@section('content')

<div class="max-w-7xl mx-auto py-10 space-y-10 animate-in fade-in duration-700">

    {{-- HEADER --}}
    <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-6">
        <div>
            <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-indigo-500/10 text-indigo-600 text-xs font-bold uppercase tracking-[0.2em] mb-5">
                <span class="w-2 h-2 rounded-full bg-indigo-500 animate-pulse"></span>
                Customer Profile
            </div>

            <h1 class="text-5xl font-extrabold text-slate-900 tracking-tight">
                Banking Identity
            </h1>

            <p class="text-slate-500 text-lg mt-4 max-w-2xl">
                Official customer profile including identity card, family records, and banking information.
            </p>
        </div>

        <div class="flex flex-wrap items-center gap-4">
            <a href="{{ route('customers.index') }}"
               class="inline-flex items-center gap-3 px-6 py-4 rounded-2xl bg-white border border-slate-200 text-slate-600 hover:border-indigo-500 hover:text-indigo-600 transition-all duration-300 shadow-sm font-semibold">
                <i class="bi bi-arrow-left-circle-fill"></i>
                Back To Customers
            </a>

            <button onclick="window.print()"
                    class="inline-flex items-center gap-3 px-6 py-4 rounded-2xl bg-gradient-to-r from-indigo-500 to-purple-600 text-white font-bold shadow-lg shadow-indigo-500/20 hover:opacity-95 transition-all duration-300">
                <i class="bi bi-printer-fill"></i>
                Print Document
            </button>
        </div>
    </div>

    {{-- MAIN PROFILE CARD --}}
    <div class="rounded-[40px] overflow-hidden border border-slate-200 bg-white/80 backdrop-blur-xl shadow-md">
        <div class="p-10 flex flex-col lg:flex-row gap-10 items-center">

            {{-- PROFILE IMAGE --}}
            <div class="relative">
                <div class="w-48 h-48 rounded-[36px] overflow-hidden border-4 border-slate-100 shadow-lg">

                    @php
                        $profileImage = null;

                        if (!empty($item->id_photo) && file_exists(storage_path('app/public/' . $item->id_photo))) {
                            $profileImage = asset('storage/' . $item->id_photo);
                        } else {
                            $profileImage = 'https://ui-avatars.com/api/?name=' . urlencode($item->name) . '&background=4f46e5&color=fff&size=400';
                        }
                    @endphp

                    <img
                        src="{{ $profileImage }}"
                        class="w-full h-full object-cover"
                        alt="Customer Avatar"
                    >
                </div>

                <div class="absolute -bottom-4 left-1/2 -translate-x-1/2 px-5 py-2 rounded-2xl bg-emerald-500 text-white text-xs font-black uppercase tracking-[0.2em] shadow-md">
                    Active Account
                </div>
            </div>

            {{-- CUSTOMER INFO --}}
            <div class="flex-1">

                <div class="flex flex-wrap items-center gap-4 mb-5">
                    <div class="px-4 py-2 rounded-2xl bg-indigo-500/10 text-indigo-600 text-xs font-bold uppercase tracking-[0.2em]">
                        Customer ID : #{{ $item->id }}
                    </div>

                    <div class="px-4 py-2 rounded-2xl bg-emerald-500/10 text-emerald-600 text-xs font-bold uppercase tracking-[0.2em]">
                        Verified
                    </div>
                </div>

                <h2 class="text-5xl font-black text-slate-900 tracking-tight">
                    {{ $item->name }}
                </h2>

                <p class="text-slate-500 text-lg mt-4 max-w-3xl">
                    Registered banking customer profile with secure identity verification and official household records.
                </p>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-5 mt-10">

                    {{-- EMAIL --}}
                    <div class="rounded-3xl bg-slate-50/50 border border-slate-200 p-5">
                        <div class="w-12 h-12 rounded-2xl bg-indigo-500/10 flex items-center justify-center text-indigo-600 mb-4">
                            <i class="bi bi-envelope-fill text-xl"></i>
                        </div>

                        <p class="text-slate-400 text-xs uppercase tracking-[0.2em] font-bold">
                            Email Address
                        </p>

                        <h3 class="text-slate-800 font-bold mt-3 break-all">
                            {{ $item->email }}
                        </h3>
                    </div>

                    {{-- PHONE --}}
                    <div class="rounded-3xl bg-slate-50/50 border border-slate-200 p-5">
                        <div class="w-12 h-12 rounded-2xl bg-emerald-500/10 flex items-center justify-center text-emerald-600 mb-4">
                            <i class="bi bi-telephone-fill text-xl"></i>
                        </div>

                        <p class="text-slate-400 text-xs uppercase tracking-[0.2em] font-bold">
                            Phone Number
                        </p>

                        <h3 class="text-slate-800 font-bold mt-3">
                            {{ $item->phone }}
                        </h3>
                    </div>

                    {{-- SECURITY --}}
                    <div class="rounded-3xl bg-slate-50/50 border border-slate-200 p-5">
                        <div class="w-12 h-12 rounded-2xl bg-purple-500/10 flex items-center justify-center text-purple-600 mb-4">
                            <i class="bi bi-shield-lock-fill text-xl"></i>
                        </div>

                        <p class="text-slate-400 text-xs uppercase tracking-[0.2em] font-bold">
                            Security Status
                        </p>

                        <h3 class="text-emerald-600 font-bold mt-3">
                            Protected
                        </h3>
                    </div>

                </div>
            </div>
        </div>
    </div>

    {{-- DOCUMENT GRID --}}
    <div class="grid grid-cols-1 xl:grid-cols-2 gap-8">

        {{-- ID CARD --}}
        <div class="rounded-[40px] overflow-hidden border border-indigo-100 bg-white shadow-md">

            <div class="px-8 py-6 border-b border-slate-100 flex items-center justify-between bg-slate-50/50">
                <div>
                    <p class="text-indigo-600 text-xs uppercase tracking-[0.2em] font-black">
                        National Identity
                    </p>

                    <h2 class="text-2xl font-black text-slate-900 mt-2">
                        Khmer Identity Card
                    </h2>
                </div>

                <div class="w-14 h-14 rounded-2xl bg-indigo-50 flex items-center justify-center text-indigo-600">
                    <i class="bi bi-person-vcard-fill text-2xl"></i>
                </div>
            </div>

            <div class="p-8 space-y-8">

                {{-- ID IMAGE --}}
                <div class="flex justify-center">

                    @php
                        $idImage = null;

                        if (!empty($item->id_photo) && file_exists(storage_path('app/public/' . $item->id_photo))) {
                            $idImage = asset('storage/' . $item->id_photo);
                        } else {
                            $idImage = 'https://placehold.co/600x380/f1f5f9/475569?text=No+ID+Card+Uploaded';
                        }
                    @endphp

                    <div class="w-full max-w-md aspect-[1.586/1] rounded-[30px] overflow-hidden border-4 border-slate-100 shadow-md bg-slate-50">

                        <img
                            src="{{ $idImage }}"
                            class="w-full h-full object-cover"
                            alt="Identity Document Photo"
                        >
                    </div>
                </div>

                <div class="space-y-6">

                    <div class="grid grid-cols-2 gap-5">

                        <div class="rounded-2xl bg-slate-50/60 border border-slate-200 p-5">
                            <p class="text-slate-400 text-xs uppercase tracking-[0.2em] font-bold">
                                ID Number
                            </p>

                            <h3 class="text-slate-800 text-lg font-black mt-3">
                                {{ $item->id_number ?? 'N/A' }}
                            </h3>
                        </div>

                        <div class="rounded-2xl bg-slate-50/60 border border-slate-200 p-5">
                            <p class="text-slate-400 text-xs uppercase tracking-[0.2em] font-bold">
                                Gender
                            </p>

                            <h3 class="text-slate-800 text-lg font-black mt-3">
                                {{ $item->gender ?? 'N/A' }}
                            </h3>
                        </div>

                    </div>

                    <div class="rounded-2xl bg-slate-50/60 border border-slate-200 p-5">
                        <p class="text-slate-400 text-xs uppercase tracking-[0.2em] font-bold">
                            Date of Birth
                        </p>

                        <h3 class="text-slate-800 text-lg font-black mt-3">
                            {{ $item->dob ?? 'N/A' }}
                        </h3>
                    </div>

                    <div class="rounded-2xl bg-slate-50/60 border border-slate-200 p-5">
                        <p class="text-slate-400 text-xs uppercase tracking-[0.2em] font-bold">
                            Place of Birth
                        </p>

                        <h3 class="text-slate-800 text-lg font-black mt-3 leading-relaxed">
                            {{ $item->pob ?? 'N/A' }}
                        </h3>
                    </div>

                </div>
            </div>
        </div>

        {{-- FAMILY BOOK --}}
        <div class="rounded-[40px] overflow-hidden border border-purple-100 bg-white shadow-md">

            <div class="px-8 py-6 border-b border-slate-100 flex items-center justify-between bg-slate-50/50">
                <div>
                    <p class="text-purple-600 text-xs uppercase tracking-[0.2em] font-black">
                        Household Record
                    </p>

                    <h2 class="text-2xl font-black text-slate-900 mt-2">
                        Family Book
                    </h2>
                </div>

                <div class="w-14 h-14 rounded-2xl bg-purple-50 flex items-center justify-center text-purple-600">
                    <i class="bi bi-book-fill text-2xl"></i>
                </div>
            </div>

            <div class="p-8 space-y-8">

                {{-- FAMILY IMAGE --}}
                @php
                    $familyImage = null;

                    if (!empty($item->family_photo) && file_exists(storage_path('app/public/' . $item->family_photo))) {
                        $familyImage = asset('storage/' . $item->family_photo);
                    } else {
                        $familyImage = 'https://placehold.co/800x500/f1f5f9/475569?text=No+Family+Book+Uploaded';
                    }
                @endphp

                <div class="rounded-[30px] overflow-hidden border border-slate-100 shadow-md bg-slate-50">
                    <img
                        src="{{ $familyImage }}"
                        class="w-full h-72 object-cover"
                        alt="Family Book Record Photo"
                    >
                </div>

                {{-- ADDRESS --}}
                <div class="rounded-3xl bg-slate-50/60 border border-slate-200 p-6">
                    <p class="text-purple-600 text-xs uppercase tracking-[0.2em] font-bold mb-4">
                        Residential Address
                    </p>

                    <h3 class="text-slate-800 text-xl font-bold leading-relaxed">
                        @if($item->house_no || $item->street || $item->district)
                            No. {{ $item->house_no }},
                            Street {{ $item->street }},
                            {{ $item->district }}
                        @else
                            Address information not fully specified
                        @endif
                    </h3>
                </div>

                {{-- FAMILY TABLE --}}
                <div class="rounded-3xl overflow-hidden border border-slate-200 shadow-sm">
                    <table class="w-full">

                        <thead class="bg-slate-50 border-b border-slate-200">
                            <tr>
                                <th class="px-5 py-4 text-left text-slate-500 text-[11px] uppercase tracking-[0.2em] font-black">
                                    Relation
                                </th>

                                <th class="px-5 py-4 text-left text-slate-500 text-[11px] uppercase tracking-[0.2em] font-black">
                                    Full Name
                                </th>

                                <th class="px-5 py-4 text-left text-slate-500 text-[11px] uppercase tracking-[0.2em] font-black">
                                    Occupation
                                </th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-slate-100 bg-white">

                            <tr>
                                <td class="px-5 py-4 text-slate-500 font-semibold">
                                    Head
                                </td>

                                <td class="px-5 py-4 text-slate-900 font-bold">
                                    {{ $item->name }}
                                </td>

                                <td class="px-5 py-4 text-slate-600">
                                    {{ $item->job ?? 'Merchant' }}
                                </td>
                            </tr>

                            @if(isset($item->family_members) && is_iterable($item->family_members))
                                @foreach($item->family_members as $member)
                                    <tr>
                                        <td class="px-5 py-4 text-slate-500">
                                            {{ $member->relation }}
                                        </td>

                                        <td class="px-5 py-4 text-slate-900 font-semibold">
                                            {{ $member->name }}
                                        </td>

                                        <td class="px-5 py-4 text-slate-600">
                                            {{ $member->job }}
                                        </td>
                                    </tr>
                                @endforeach
                            @endif

                        </tbody>
                    </table>
                </div>

            </div>
        </div>

    </div>
</div>

<style>
    @media print {
        body {
            background: white !important;
            color: black !important;
        }

        a,
        button {
            display: none !important;
        }

        .shadow-md,
        .shadow-lg,
        .shadow-sm {
            box-shadow: none !important;
        }

        .border,
        .border-slate-200,
        .border-indigo-100,
        .border-purple-100 {
            border-color: #cbd5e1 !important;
        }

        .bg-slate-50,
        .bg-slate-50\/50,
        .bg-slate-50\/60,
        .bg-white\/80 {
            background: transparent !important;
        }
        
        .text-slate-900,
        .text-slate-800,
        .text-slate-700 {
            color: #000000 !important;
        }
        
        .text-slate-500,
        .text-slate-400 {
            color: #475569 !important;
        }
    }
</style>

@endsection
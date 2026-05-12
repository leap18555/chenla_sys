@extends('layouts.master')

@section('content')
<div class="container mx-auto py-10 px-4 space-y-12">
    
    <div class="flex justify-between items-center">
        <a href="{{ route('customers.index') }}" class="text-slate-500 hover:text-blue-600 font-bold flex items-center gap-2">
            <i class="bi bi-arrow-left"></i> Back to List
        </a>
        <button onclick="window.print()" class="bg-slate-800 text-white px-4 py-2 rounded-lg text-sm font-bold shadow-md">
            <i class="bi bi-printer"></i> Print Document
        </a>
    </div>

    <div class="max-w-2xl mx-auto">
        <h2 class="text-center text-sm font-bold text-slate-400 uppercase tracking-[0.3em] mb-4">National Identity Card</h2>
        <div class="relative bg-gradient-to-br from-blue-50 to-white border-2 border-blue-200 rounded-2xl shadow-2xl p-6 overflow-hidden">
            <div class="absolute top-0 right-0 opacity-5 pointer-events-none">
                <i class="bi bi-shield-check text-[200px]"></i>
            </div>

            <div class="relative flex gap-6">
                <div class="flex-shrink-0">
                    <div class="w-32 h-40 bg-white border-2 border-blue-100 rounded-lg shadow-md overflow-hidden">
                        <img src="{{ asset('storage/' . $item->id_photo) }}" 
                             onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode($item->name) }}&size=200'"
                             class="w-full h-full object-cover">
                    </div>
                    <p class="text-[10px] text-center mt-2 font-mono text-blue-800 font-bold uppercase tracking-widest">
                        Nº {{ $item->id_number ?? '000000000' }}
                    </p>
                </div>

                <div class="flex-grow space-y-3">
                    <div class="border-b border-blue-100 pb-2">
                        <p class="text-[10px] text-blue-400 font-bold uppercase">Full Name</p>
                        <h3 class="text-xl font-black text-blue-900">{{ $item->name }}</h3>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <p class="text-[10px] text-blue-400 font-bold uppercase">Date of Birth</p>
                            <p class="text-sm font-bold text-slate-700">{{ $item->dob ?? 'Jan 01, 1990' }}</p>
                        </div>
                        <div>
                            <p class="text-[10px] text-blue-400 font-bold uppercase">Gender</p>
                            <p class="text-sm font-bold text-slate-700">{{ $item->gender ?? 'Male' }}</p>
                        </div>
                    </div>

                    <div>
                        <p class="text-[10px] text-blue-400 font-bold uppercase">Place of Birth</p>
                        <p class="text-sm font-bold text-slate-700 leading-tight">
                            {{ $item->pob ?? 'Phnom Penh, Cambodia' }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-4xl mx-auto">
        <h2 class="text-center text-sm font-bold text-slate-400 uppercase tracking-[0.3em] mb-4">Family Record Book</h2>
        <div class="bg-[#FFF9F9] border-2 border-pink-200 rounded-[2rem] shadow-xl overflow-hidden">
            <div class="bg-pink-600 p-4 text-center">
                <p class="text-white font-serif text-lg tracking-widest uppercase">Family Book / សៀវភៅគ្រួសារ</p>
            </div>

            <div class="p-8 md:flex gap-10">
                <div class="md:w-1/3 space-y-4">
                    <div class="bg-white p-2 shadow-sm rotate-2 border border-pink-100 rounded-sm">
                        <img src="{{ asset('storage/' . $item->family_photo) }}" 
                             alt="Family Photo"
                             onerror="this.src='https://placehold.co/400x300?text=Family+Photo'"
                             class="w-full aspect-video object-cover grayscale-[30%]">
                    </div>
                    <div class="pt-4 text-center">
                        <p class="text-xs text-pink-400 font-bold">House Address</p>
                        <p class="text-sm text-slate-600 italic">No. {{ $item->house_no }}, St. {{ $item->street }}, {{ $item->district }}</p>
                    </div>
                </div>

                <div class="md:w-2/3 mt-6 md:mt-0">
                    <table class="w-full text-left text-sm border-collapse">
                        <thead>
                            <tr class="border-b-2 border-pink-100">
                                <th class="py-2 text-pink-600 font-black uppercase text-[10px]">Relation</th>
                                <th class="py-2 text-pink-600 font-black uppercase text-[10px]">Full Name</th>
                                <th class="py-2 text-pink-600 font-black uppercase text-[10px]">Occupation</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-pink-50">
                            <tr>
                                <td class="py-3 text-slate-500 font-bold">Head</td>
                                <td class="py-3 text-slate-800 font-black">{{ $item->name }}</td>
                                <td class="py-3 text-slate-600">{{ $item->job ?? 'Merchant' }}</td>
                            </tr>
                            @if(isset($item->family_members))
                                @foreach($item->family_members as $member)
                                <tr>
                                    <td class="py-3 text-slate-400">{{ $member->relation }}</td>
                                    <td class="py-3 text-slate-700 font-bold">{{ $member->name }}</td>
                                    <td class="py-3 text-slate-500">{{ $member->job }}</td>
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
    @import url('https://fonts.googleapis.com/css2?family=Khmer&display=swap');
    
    .font-khmer {
        font-family: 'Khmer', cursive;
    }

    @media print {
        body { background: white; }
        .container { width: 100%; max-width: 100%; margin: 0; padding: 0; }
        button, a { display: none; }
    }
</style>
@endsection
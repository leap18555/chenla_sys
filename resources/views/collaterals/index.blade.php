@extends('layouts.master')

@section('content')
<div class="min-h-screen bg-[#FDFBF7] p-6 text-gray-800 font-sans">
    
    <!-- Top Header & Breadcrumb -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
        <div>
            <div class="flex items-center space-x-2 text-xs font-bold text-[#D97706] tracking-wide uppercase mb-1">
                <span>SYSTEM MANAGEMENT</span>
                <span class="text-gray-300">//</span>
                <span class="text-gray-500">ទ្រព្យបញ្ចាំ</span>
            </div>
            <h1 class="text-2xl font-black text-gray-900 tracking-tight">គ្រប់គ្រងទ្រព្យបញ្ចាំ (COLLATERAL VAULT)</h1>
        </div>

        <div class="flex items-center space-x-3">
            <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-medium bg-amber-50 text-amber-800 border border-amber-200">
                <span class="w-1.5 h-1.5 rounded-full bg-amber-500 mr-1.5 animate-pulse"></span>
                VAULT ONLINE
            </span>
            <div class="text-xs text-gray-400 font-mono bg-white px-3 py-1.5 rounded-lg border border-gray-200 shadow-2xs">
                {{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}
            </div>
        </div>
    </div>

    <!-- Main Content Layout -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
        
        <!-- Left Side: Add Collateral Form -->
        <div class="lg:col-span-5 bg-white p-6 rounded-2xl border border-gray-100 shadow-xs flex flex-col justify-between">
            <div>
                <!-- Card Header -->
                <div class="flex justify-between items-center pb-4 mb-5 border-b border-gray-100">
                    <div>
                        <span class="text-[10px] font-bold tracking-widest text-gray-400 uppercase">FORM // បញ្ចូលទិន្នន័យ</span>
                        <h2 class="text-base font-bold text-gray-900">បន្ថែមទ្រព្យបញ្ចាំថ្មី</h2>
                    </div>
                    <span class="text-[11px] bg-orange-50 text-orange-600 font-semibold px-2.5 py-1 rounded-md border border-orange-100">
                        CONFIDENTIAL
                    </span>
                </div>

                <form action="{{ route('collaterals.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                    @csrf
                    
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-1.5">អតិថិជន (BORROWER)</label>
                            <select name="customer_id" class="w-full border border-gray-200 rounded-xl p-2.5 bg-[#FBFBFB] text-xs font-medium text-gray-900 focus:bg-white focus:outline-none focus:ring-2 focus:ring-amber-500/20 focus:border-amber-500 transition" required>
                                <option value="" class="bg-white text-gray-900">ជ្រើសរើសអតិថិជន...</option>
                                @foreach($customers as $customer)
                                    <option value="{{ $customer->id }}" class="bg-white text-gray-900">{{ $customer->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-1.5">ប្រាក់កម្ចី (LOAN CODE)</label>
                            <select name="loan_id" class="w-full border border-gray-200 rounded-xl p-2.5 bg-[#FBFBFB] text-xs font-medium text-gray-900 focus:bg-white focus:outline-none focus:ring-2 focus:ring-amber-500/20 focus:border-amber-500 transition" required>
                                <option value="" class="bg-white text-gray-900">ជ្រើសរើសកម្ចី...</option>
                                @foreach($loans as $loan)
                                    <option value="{{ $loan->id }}" class="bg-white text-gray-900">{{ $loan->loan_code }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-1.5">ប្រភេទ (CATEGORY)</label>
                            <select name="type" class="w-full border border-gray-200 rounded-xl p-2.5 bg-[#FBFBFB] text-xs font-medium text-gray-800 focus:bg-white focus:outline-none focus:ring-2 focus:ring-amber-500/20 focus:border-amber-500 transition" required>
                                <option value="ប័ណ្ណកម្មសិទ្ធិដី">ប័ណ្ណកម្មសិទ្ធិដី (Land Title)</option>
                                <option value="យានយន្ត">យានយន្ត (Vehicles)</option>
                                <option value="គ្រឿងអលង្ការ / មាស">គ្រឿងអលង្ការ / មាស (Jewelry & Gold)</option>
                                <option value="គ្រឿងអេឡិចត្រូនិក">គ្រឿងអេឡិចត្រូនិក (Electronics)</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-1.5">តម្លៃ (EST. VALUE $)</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400 font-bold text-xs">$</span>
                                <input type="number" name="value" step="0.01" placeholder="0.00" class="w-full pl-7 border border-gray-200 rounded-xl p-2.5 bg-[#FBFBFB] text-xs font-semibold text-gray-800 focus:bg-white focus:outline-none focus:ring-2 focus:ring-amber-500/20 focus:border-amber-500 transition" required>
                            </div>
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-1.5">ការពិពណ៌នា (DESCRIPTION)</label>
                        <textarea name="description" rows="2" placeholder="ព័ត៌មានលម្អិតអំពីទ្រព្យ..." class="w-full border border-gray-200 rounded-xl p-2.5 bg-[#FBFBFB] text-xs font-medium text-gray-800 focus:bg-white focus:outline-none focus:ring-2 focus:ring-amber-500/20 focus:border-amber-500 transition"></textarea>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-1.5">លេខឯកសារ (DOC NO.)</label>
                            <input type="text" name="document_number" placeholder="ឧ. Nº 00234" class="w-full border border-gray-200 rounded-xl p-2.5 bg-[#FBFBFB] text-xs font-medium text-gray-800 focus:bg-white focus:outline-none focus:ring-2 focus:ring-amber-500/20 focus:border-amber-500 transition">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-1.5">ថ្ងៃទទួល (RECEIVED DATE)</label>
                            <input type="date" name="received_date" class="w-full border border-gray-200 rounded-xl p-2.5 bg-[#FBFBFB] text-xs font-medium text-gray-800 focus:bg-white focus:outline-none focus:ring-2 focus:ring-amber-500/20 focus:border-amber-500 transition" required>
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-1.5">ស្ថានភាព (STATUS)</label>
                        <select name="status" class="w-full border border-gray-200 rounded-xl p-2.5 bg-[#FBFBFB] text-xs font-medium text-gray-800 focus:bg-white focus:outline-none focus:ring-2 focus:ring-amber-500/20 focus:border-amber-500 transition">
                            <option value="កំពុងរក្សាទុក">កំពុងរក្សាទុក (Vaulted)</option>
                            <option value="បានដកវិញ">បានដកវិញ (Released)</option>
                        </select>
                    </div>

                    <!-- Modern Reference Upload Box -->
                    <div class="border border-dashed border-gray-300 rounded-xl p-4 text-center bg-[#FAF9F5] hover:bg-amber-50/50 hover:border-amber-300 transition group relative cursor-pointer">
                        <input type="file" name="reference_document" class="absolute inset-0 opacity-0 cursor-pointer z-10">
                        <div class="flex flex-col items-center space-y-1">
                            <div class="p-2 bg-white rounded-lg shadow-2xs border border-gray-100 group-hover:scale-105 transition transform">
                                <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
                            </div>
                            <p class="text-xs text-gray-700 font-bold pt-1">បណ្ដោះអាសន្ន/ឯកសារយោង</p>
                            <p class="text-[10px] text-gray-400">PDF, PNG, JPG ឬ DOCX (អតិបរមា 10MB)</p>
                        </div>
                    </div>

                    <button type="submit" class="w-full bg-gray-900 hover:bg-amber-600 text-white font-bold py-3 px-4 rounded-xl shadow-xs transition duration-200 flex items-center justify-center space-x-2 text-xs uppercase tracking-wider">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                        <span>រក្សាទុកទ្រព្យបញ្ចាំ</span>
                    </button>
                </form>
            </div>
        </div>

        <!-- Right Side: Collateral Data Matrix Table -->
        <div class="lg:col-span-7 bg-white p-6 rounded-2xl border border-gray-100 shadow-xs flex flex-col justify-between">
            <div>
                <!-- Table Header -->
                <div class="flex justify-between items-center pb-4 mb-4 border-b border-gray-100">
                    <div>
                        <span class="text-[10px] font-bold tracking-widest text-gray-400 uppercase">MATRIX // បញ្ជីទិន្នន័យ</span>
                        <h2 class="text-base font-bold text-gray-900">បញ្ជីទ្រព្យបញ្ចាំក្នុងឃ្លាំង</h2>
                    </div>
                    <span class="text-xs bg-amber-50 text-amber-900 px-3 py-1 rounded-full font-bold border border-amber-200/60">
                        {{ $collaterals->count() }} ធាតុ
                    </span>
                </div>

                <!-- Table -->
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-xs text-gray-600">
                        <thead>
                            <tr class="border-b border-gray-100 text-gray-400 font-bold uppercase tracking-wider text-[10px]">
                                <th class="pb-3 pl-2">ទ្រព្យបញ្ចាំ</th>
                                <th class="pb-3">អតិថិជន / កម្ចី</th>
                                <th class="pb-3">តម្លៃរាយ</th>
                                <th class="pb-3">ឯកសារ</th>
                                <th class="pb-3">ស្ថានភាព</th>
                                <th class="pb-3 text-right pr-2">សកម្មភាព</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @foreach($collaterals as $item)
                            <tr class="hover:bg-[#FAF9F5] transition duration-150">
                                <td class="py-3.5 pl-2">
                                    <div class="font-bold text-gray-900">{{ $item->type }}</div>
                                    <div class="text-[11px] text-gray-400 truncate max-w-[130px]">{{ $item->description ?? 'គ្មានការពិពណ៌នា' }}</div>
                                </td>
                                <td class="py-3.5">
                                    <div class="text-gray-900 font-semibold">{{ $item->customer->name ?? 'N/A' }}</div>
                                    <div class="text-[10px] font-mono text-amber-700 bg-amber-50/50 px-1.5 py-0.5 rounded w-max mt-0.5 border border-amber-100">
                                        {{ $item->loan->loan_code ?? 'N/A' }}
                                    </div>
                                </td>
                                <td class="py-3.5">
                                    <div class="font-extrabold text-gray-900">${{ number_format($item->value, 2) }}</div>
                                    <div class="text-[10px] font-mono text-gray-400">{{ $item->document_number ?? '-' }}</div>
                                </td>
                                <td class="py-3.5">
                                    @if($item->reference_document)
                                        <span class="inline-flex items-center text-[10px] font-bold text-emerald-700 bg-emerald-50 px-2 py-0.5 rounded border border-emerald-100">
                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                            មាន
                                        </span>
                                    @else
                                        <span class="inline-flex items-center text-[10px] text-gray-400 bg-gray-50 px-2 py-0.5 rounded border border-gray-100">
                                            គ្មាន
                                        </span>
                                    @endif
                                </td>
                                <td class="py-3.5">
                                    @if($item->status == 'កំពុងរក្សាទុក')
                                        <span class="px-2.5 py-1 text-[10px] font-extrabold rounded-md bg-amber-50 text-amber-800 border border-amber-200/80">
                                            {{ $item->status }}
                                        </span>
                                    @else
                                        <span class="px-2.5 py-1 text-[10px] font-extrabold rounded-md bg-gray-100 text-gray-600 border border-gray-200">
                                            {{ $item->status }}
                                        </span>
                                    @endif
                                </td>
                                <td class="py-3.5 text-right pr-2 space-x-1">
                                    <button class="p-1.5 text-gray-400 hover:text-amber-600 hover:bg-white rounded-lg border border-transparent hover:border-gray-200 transition shadow-2xs">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                    </button>
                                    <form action="{{ route('collaterals.destroy', $item->id) }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="return confirm('តើអ្នកប្រាកដជាចង់លុបទិន្នន័យនេះ?')" class="p-1.5 text-gray-400 hover:text-red-600 hover:bg-white rounded-lg border border-transparent hover:border-gray-200 transition shadow-2xs">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
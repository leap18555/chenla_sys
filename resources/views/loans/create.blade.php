@extends('layouts.master')

@section('title', 'បង្កើតប្រាក់កម្ចី | Create Loan')

@section('content')
<div class="min-h-screen bg-[#f8f9fa] py-10 px-4 md:px-8 font-sans">
    <div class="max-w-2xl mx-auto">
        
        {{-- Page Title / Header Style --}}
        <div class="mb-6 pl-2">
            <h1 class="text-xl font-bold text-slate-800 tracking-tight">ប្រាក់កម្ចី</h1>
        </div>

        {{-- Validation Errors --}}
        @if ($errors->any())
            <div class="mb-6 rounded-2xl bg-red-50 border border-red-100 p-4 shadow-sm">
                <ul class="list-disc list-inside space-y-1">
                    @foreach ($errors->all() as $error)
                        <li class="text-sm text-red-600 font-medium">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Main Card Container --}}
        <div class="bg-white border border-slate-100 rounded-3xl shadow-[0_10px_30px_rgba(0,0,0,0.02)] p-6 md:p-8">
            
            {{-- Form Header Area --}}
            <div class="flex items-center justify-between border-b border-slate-100 pb-5 mb-6">
                <div>
                    <h2 class="text-lg font-bold text-slate-800">បង្កើតប្រាក់កម្ចី</h2>
                </div>
                <button type="button" class="px-4 py-1.5 text-xs font-semibold text-slate-500 bg-[#eef0f2] border border-slate-200 rounded-lg hover:bg-slate-200 transition-colors">
                    សម្ងាត់
                </button>
            </div>

            {{-- Form --}}
            <form action="{{ route('loans.store') }}" method="POST" class="space-y-5">
                @csrf

                {{-- Row 1: Customer & Loan Number --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label for="customer_id" class="block text-xs font-bold text-slate-400 mb-2">អតិថិជន</label>
                        <div class="relative">
                            <select name="customer_id" id="customer_id" required
                                class="w-full px-4 py-3.5 rounded-xl border border-slate-200 bg-[#f1f3f5] text-slate-700 font-medium focus:border-emerald-500 focus:bg-white focus:ring-4 focus:ring-emerald-500/10 outline-none transition-all appearance-none cursor-pointer">
                                <option value="" disabled {{ old('customer_id') ? '' : 'selected' }}>ជ្រើសរើសអតិថិជន</option>
                                
                                @foreach($customers ?? [] as $customer)
                                    <option value="{{ $customer->id }}" {{ old('customer_id') == $customer->id ? 'selected' : '' }}>
                                        {{ $customer->name }} (ID-{{ str_pad($customer->id, 6, '0', STR_PAD_LEFT) }})
                                    </option>
                                @endforeach
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-4 flex items-center text-slate-400">
                                <i class="bi bi-chevron-down text-xs"></i>
                            </div>
                        </div>
                    </div>

                    <div>
                        <label for="loan_number" class="block text-xs font-bold text-slate-400 mb-2">លេខប្រាក់កម្ចី</label>
                        <input type="text" name="loan_number" id="loan_number" value="{{ old('loan_number', $loanNumber ?? 'LN-'.date('Y').'-001') }}" readonly
                            class="w-full px-4 py-3.5 rounded-xl border border-slate-200 bg-[#eef0f2] text-slate-600 font-semibold focus:outline-none cursor-not-allowed">
                    </div>
                </div>

               {{-- Row 2: Purpose --}}
                <div>
                    <label for="purpose" class="block text-xs font-bold text-slate-400 mb-2">គោលបំណង</label>
                    <select name="purpose" id="purpose" 
                        class="w-full px-4 py-3.5 rounded-xl border border-slate-200 bg-[#f1f3f5] text-slate-800 font-medium focus:border-emerald-500 focus:bg-white focus:ring-4 focus:ring-emerald-500/10 outline-none transition-all appearance-none">
                        
                        <option value="" disabled {{ old('purpose') ? '' : 'selected' }}>ជ្រើសរើសគោលបំណង...</option>
                        
                        <option value="business" {{ old('purpose') == 'business' ? 'selected' : '' }}>ធុរកិច្ច (Business)</option>
                        <option value="personal" {{ old('purpose') == 'personal' ? 'selected' : '' }}>ផ្ទាល់ខ្លួន (Personal)</option>
                        <option value="education" {{ old('purpose') == 'education' ? 'selected' : '' }}>ការសិក្សា (Education)</option>
                        <option value="other" {{ old('purpose') == 'other' ? 'selected' : '' }}>ផ្សេងៗ (Other)</option>
                        
                    </select>
                </div>

                {{-- Row 3: Principal Amount & Interest Rate --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label for="amount" class="block text-xs font-bold text-slate-400 mb-2">ប្រាក់ដើម</label>
                        <input type="number" step="0.01" min="0" name="amount" id="amount" value="{{ old('amount') }}" placeholder="0.00" required
                            class="w-full px-4 py-3.5 rounded-xl border border-slate-200 bg-[#f1f3f5] text-slate-800 font-semibold focus:border-emerald-500 focus:bg-white focus:ring-4 focus:ring-emerald-500/10 outline-none transition-all">
                    </div>

                    <div>
                        <label for="interest_rate" class="block text-xs font-bold text-slate-400 mb-2">ការប្រាក់ប្រចាំឆ្នាំ %</label>
                        <input type="number" step="0.01" min="0" name="interest_rate" id="interest_rate" value="{{ old('interest_rate', '18') }}" required
                            class="w-full px-4 py-3.5 rounded-xl border border-slate-200 bg-[#f1f3f5] text-slate-800 font-semibold focus:border-emerald-500 focus:bg-white focus:ring-4 focus:ring-emerald-500/10 outline-none transition-all">
                    </div>
                </div>

                {{-- Row 4: Number of Payments & Frequency --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label for="duration" class="block text-xs font-bold text-slate-400 mb-2">ចំនូនដងបង់</label>
                        <input type="number" name="duration" id="duration" value="{{ old('duration', '12') }}" required
                            class="w-full px-4 py-3.5 rounded-xl border border-slate-200 bg-[#f1f3f5] text-slate-800 font-semibold focus:border-emerald-500 focus:bg-white focus:ring-4 focus:ring-emerald-500/10 outline-none transition-all">
                    </div>

                    <div>
                        <label for="frequency" class="block text-xs font-bold text-slate-400 mb-2">ភាពញឹកញាប់</label>
                        <div class="relative">
                            <select name="frequency" id="frequency" required
                                class="w-full px-4 py-3.5 rounded-xl border border-slate-200 bg-[#f1f3f5] text-slate-700 font-medium focus:border-emerald-500 focus:bg-white focus:ring-4 focus:ring-emerald-500/10 outline-none transition-all appearance-none cursor-pointer">
                                <option value="Monthly" {{ old('frequency', 'Monthly') == 'Monthly' ? 'selected' : '' }}>ប្រចាំខែ</option>
                                <option value="Weekly" {{ old('frequency') == 'Weekly' ? 'selected' : '' }}>ប្រចាំសប្តាហ៍</option>
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-4 flex items-center text-slate-400">
                                <i class="bi bi-chevron-down text-xs"></i>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Row 5: Start Date & Calculation Method --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label for="start_date" class="block text-xs font-bold text-slate-400 mb-2">កាលបរិច្ឆេទចាប់ផ្តើម</label>
                        <div class="relative">
                            <input type="date" name="start_date" id="start_date" value="{{ old('start_date', date('Y-m-d')) }}" required
                                class="w-full px-4 py-3.5 rounded-xl border border-slate-200 bg-[#f1f3f5] text-slate-700 font-semibold focus:border-emerald-500 focus:bg-white focus:ring-4 focus:ring-emerald-500/10 outline-none transition-all">
                        </div>
                    </div>

                    <div>
                        <label for="method" class="block text-xs font-bold text-slate-400 mb-2">វិធីគណនា</label>
                        <div class="relative">
                            <select name="method" id="method" required
                                class="w-full px-4 py-3.5 rounded-xl border border-slate-200 bg-[#f1f3f5] text-slate-700 font-medium focus:border-emerald-500 focus:bg-white focus:ring-4 focus:ring-emerald-500/10 outline-none transition-all appearance-none cursor-pointer">
                                <option value="Declining" {{ old('method', 'Declining') == 'Declining' ? 'selected' : '' }}>សមតុល្យថយចុះ</option>
                                <option value="Fixed" {{ old('method') == 'Fixed' ? 'selected' : '' }}>ការប្រាក់ថេរ</option>
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-4 flex items-center text-slate-400">
                                <i class="bi bi-chevron-down text-xs"></i>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Row 6: Status --}}
                <div>
                    <label for="status" class="block text-xs font-bold text-slate-400 mb-2">ស្ថានភាព</label>
                    <div class="relative">
                        <select name="status" id="status" required
                            class="w-full px-4 py-3.5 rounded-xl border border-slate-200 bg-[#f1f3f5] text-slate-700 font-medium focus:border-emerald-500 focus:bg-white focus:ring-4 focus:ring-emerald-500/10 outline-none transition-all appearance-none cursor-pointer">
                            <option value="Active" {{ old('status', 'Active') == 'Active' ? 'selected' : '' }}>សកម្ម</option>
                            <option value="Pending" {{ old('status') == 'Pending' ? 'selected' : '' }}>រង់ចាំការអនុម័ត</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-4 flex items-center text-slate-400">
                            <i class="bi bi-chevron-down text-xs"></i>
                        </div>
                    </div>
                </div>

                {{-- Submit Button Area --}}
                <div class="pt-4">
                    <button type="submit"
                        class="w-full inline-flex items-center justify-center gap-2 px-6 py-4 rounded-xl bg-[#00875a] text-white font-bold text-base shadow-sm hover:bg-[#00704a] active:scale-[0.99] transition-all duration-150">
                        <i class="bi bi-plus-lg text-lg"></i>
                        រក្សាទុកប្រាក់កម្ចី
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection
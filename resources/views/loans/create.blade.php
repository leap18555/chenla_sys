@extends('layouts.master')

@section('content')
<div class="min-h-screen bg-[radial-gradient(ellipse_at_top_right,_var(--tw-gradient-stops))] from-indigo-100 via-slate-50 to-white py-16 px-4">
    <div class="max-w-3xl mx-auto">
        
        {{-- Breadcrumb/Back Link --}}
        <a href="{{ route('loans.index') }}" class="inline-flex items-center text-sm font-medium text-indigo-600 hover:text-indigo-700 mb-6 transition-colors group">
            <svg class="w-4 h-4 mr-2 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            Back to Loan Dashboard
        </a>

        <div class="flex flex-col md:flex-row md:items-end justify-between mb-10 gap-4">
            <div>
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800 mb-2">
                    Finance Module
                </span>
                <h1 class="text-4xl font-extrabold tracking-tight text-slate-900">New Loan Application</h1>
            </div>
        </div>

        {{-- Error Messages --}}
        @if ($errors->any())
            <div class="mb-6 p-4 rounded-2xl bg-red-50 border border-red-100 text-red-600 text-sm shadow-sm">
                <div class="flex items-center mb-2">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                    <span class="font-bold">Please correct the following errors:</span>
                </div>
                <ul class="list-disc list-inside space-y-1 ml-2">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Main Form Card --}}
        <div class="bg-white/80 backdrop-blur-xl border border-white shadow-2xl shadow-slate-200/50 rounded-3xl overflow-hidden">
            <div class="p-8 md:p-12">
                <form action="{{ route('loans.store') }}" method="POST" class="space-y-8">
                    @csrf

                    <div class="grid grid-cols-1 gap-y-8 gap-x-6 sm:grid-cols-2">

                        {{-- CUSTOMER NAME --}}
                        <div class="sm:col-span-2">
                            <label for="customer_name" class="block text-sm font-bold text-slate-700 uppercase tracking-wider mb-2">Full Name</label>
                            <input type="text" name="customer_name" id="customer_name" value="{{ old('customer_name') }}" class="block w-full px-4 py-4 rounded-2xl border-slate-200 bg-slate-50/50 focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all" placeholder="Enter legal name" required>
                        </div>

                        {{-- LOAN TYPE (Added to fix the error) --}}
                        <div class="sm:col-span-2">
                            <label for="type" class="block text-sm font-bold text-slate-700 uppercase tracking-wider mb-2">Loan Type</label>
                            <select name="type" id="type" class="block w-full px-4 py-4 rounded-2xl border-slate-200 bg-slate-50/50 focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all cursor-pointer" required>
                                <option value="" disabled {{ old('type') ? '' : 'selected' }}>Select loan purpose</option>
                                <option value="Personal" {{ old('type') == 'Personal' ? 'selected' : '' }}>Personal Loan</option>
                                <option value="Business" {{ old('type') == 'Business' ? 'selected' : '' }}>Business Loan</option>
                                <option value="Education" {{ old('type') == 'Education' ? 'selected' : '' }}>Education Loan</option>
                            </select>
                        </div>

                        {{-- CURRENCY SELECT --}}
                        <div>
                            <label for="currency" class="block text-sm font-bold text-slate-700 uppercase tracking-wider mb-2">Currency</label>
                            <select name="currency" id="currency" onchange="updateCurrencySymbol()" class="block w-full px-4 py-4 rounded-2xl border-slate-200 bg-slate-50/50 focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all cursor-pointer">
                                <option value="USD" {{ old('currency') == 'USD' ? 'selected' : '' }}>USD ($)</option>
                                <option value="KHR" {{ old('currency') == 'KHR' ? 'selected' : '' }}>KHR (៛)</option>
                            </select>
                        </div>

                        {{-- LOAN AMOUNT --}}
                        <div>
                            <label for="amount" class="block text-sm font-bold text-slate-700 uppercase tracking-wider mb-2">Principal Amount</label>
                            <div class="relative group">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <span id="currency-symbol" class="text-slate-400 font-medium transition-colors">$</span>
                                </div>
                                <input type="number" name="amount" id="amount" value="{{ old('amount') }}" class="block w-full pl-9 pr-4 py-4 rounded-2xl border-slate-200 bg-slate-50/50 focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all" placeholder="0.00" required>
                            </div>
                        </div>

                        {{-- ANNUAL RATE --}}
                        <div class="sm:col-span-1">
                            <label for="interest_rate" class="block text-sm font-bold text-slate-700 uppercase tracking-wider mb-2">Annual Rate (%)</label>
                            <input type="number" step="0.01" name="interest_rate" id="interest_rate" value="{{ old('interest_rate', '2.00') }}" class="block w-full px-4 py-4 rounded-2xl border-slate-200 bg-slate-50/50 focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all" placeholder="2.00" required>
                        </div>

                        {{-- TERM LENGTH --}}
                        <div class="sm:col-span-2">
                            <label for="duration" class="block text-sm font-bold text-slate-700 uppercase tracking-wider mb-2">
                                Term Length (Months) <span class="text-xs lowercase font-normal text-slate-400 ml-2">(0.5 = 2 weeks)</span>
                            </label>
                            <div class="flex items-center space-x-4">
                                <input type="range" min="0.5" max="36" step="0.5" id="duration_slider" value="{{ old('duration', 12) }}" class="w-full h-2 bg-slate-200 rounded-lg appearance-none cursor-pointer accent-indigo-600">
                                <input type="number" step="0.1" name="duration" id="duration" value="{{ old('duration', 12) }}" class="w-24 px-4 py-3 rounded-xl border-slate-200 bg-slate-50/50 text-center font-bold text-indigo-600 focus:ring-2 focus:ring-indigo-500 transition-all">
                            </div>
                            <div id="duration-label" class="mt-2 text-sm font-medium text-indigo-500">Selected: 12 Months</div>
                        </div>
                    </div>

                    {{-- ACTIONS --}}
                    <div class="pt-10 flex justify-end">
                        <button type="submit" class="w-full sm:w-auto inline-flex items-center justify-center py-4 px-10 border border-transparent text-base font-bold rounded-2xl text-white bg-indigo-600 hover:bg-indigo-700 shadow-lg transition-all active:scale-[0.98]">
                            Confirm & Generate Loan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    const slider = document.getElementById('duration_slider');
    const input = document.getElementById('duration');
    const label = document.getElementById('duration-label');
    const currencySelect = document.getElementById('currency');
    const symbolSpan = document.getElementById('currency-symbol');

    function updateLabel(val) {
        if (parseFloat(val) === 0.5) {
            label.innerText = "Selected: 2 Weeks (0.5 Months)";
        } else {
            label.innerText = `Selected: ${val} Months`;
        }
    }

    slider.addEventListener('input', (e) => {
        input.value = e.target.value;
        updateLabel(e.target.value);
    });

    input.addEventListener('input', (e) => {
        slider.value = e.target.value;
        updateLabel(e.target.value);
    });

    function updateCurrencySymbol() {
        symbolSpan.innerText = currencySelect.value === 'KHR' ? '៛' : '$';
    }

    // Initialize on load
    updateCurrencySymbol();
    updateLabel(input.value);
</script>
@endsection
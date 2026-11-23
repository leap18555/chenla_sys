<!DOCTYPE html>
<html lang="km" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <title>ធនាគារ ចេនឡា | វិបផតថលអតិថិជន និងប្តូរប្រាក់ស្ថាប័ន</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Google Fonts (Kantumruy Pro, Plus Jakarta Sans, Space Grotesk) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kantumruy+Pro:wght@300;400;500;600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Space+Grotesk:wght@500;600;700&display=swap" rel="stylesheet">

    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Kantumruy Pro', 'Plus Jakarta Sans', 'sans-serif'],
                        display: ['Space Grotesk', 'Kantumruy Pro', 'sans-serif'],
                        khmer: ['Kantumruy Pro', 'sans-serif'],
                    },
                    colors: {
                        navy: {
                            800: '#11253e',
                            900: '#0B2B40',
                            950: '#071527'
                        },
                        teal: {
                            700: '#0F4C5C',
                            800: '#0c3d4a',
                            900: '#082a33',
                        },
                        emerald: {
                            50: '#ecfdf5',
                            100: '#d1fae5',
                            500: '#10B981',
                            600: '#059669',
                            700: '#047857'
                        },
                        gold: {
                            400: '#FBBF24',
                            500: '#D4AF37',
                            600: '#B8860B',
                        }
                    },
                    boxShadow: {
                        soft: '0 20px 50px -10px rgba(11, 43, 64, 0.08)',
                        card: '0 12px 35px -5px rgba(11, 43, 64, 0.06)',
                        glow: '0 10px 30px -5px rgba(16, 185, 129, 0.35)',
                        'navy-glow': '0 20px 45px -10px rgba(7, 21, 39, 0.5)',
                    }
                }
            }
        }
    </script>

    <style>
        * {
            box-sizing: border-box;
            font-family: 'Kantumruy Pro', 'Plus Jakarta Sans', sans-serif;
        }

        body { 
            background-color: #f8fafc; 
            color: #0B2B40;
            line-height: 1.6;
            background-image: 
                radial-gradient(at 0% 0%, rgba(15, 76, 92, 0.05) 0px, transparent 50%),
                radial-gradient(at 100% 0%, rgba(16, 185, 129, 0.04) 0px, transparent 50%),
                radial-gradient(at 50% 100%, rgba(11, 43, 64, 0.03) 0px, transparent 50%);
        }

        .khmer-pattern {
            background-image: url("data:image/svg+xml,%3Csvg width='56' height='56' viewBox='0 0 56 56' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' stroke='%230F4C5C' stroke-width='1' stroke-opacity='0.04'%3E%3Cpath d='M28 4 L52 28 L28 52 L4 28 Z'/%3E%3Cpath d='M28 14 L42 28 L28 42 L14 28 Z'/%3E%3Ccircle cx='28' cy='28' r='3' fill='%230F4C5C' fill-opacity='0.04'/%3E%3C/g%3E%3C/svg%3E");
        }

        .bento-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(226, 232, 240, 0.85);
            box-shadow: 0 10px 30px -5px rgba(11, 43, 64, 0.05);
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        }
        
        .bento-card:hover {
            border-color: rgba(15, 76, 92, 0.3);
            box-shadow: 0 20px 40px -10px rgba(11, 43, 64, 0.09);
        }

        .bento-card-navy {
            background: linear-gradient(135deg, #071527 0%, #0B2B40 55%, #0F4C5C 100%);
            border: 1px solid rgba(255, 255, 255, 0.12);
            box-shadow: 0 20px 50px -10px rgba(7, 21, 39, 0.4);
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .btn-positive {
            background: linear-gradient(135deg, #059669 0%, #10B981 100%);
            color: #ffffff;
            font-weight: 700;
            box-shadow: 0 10px 25px rgba(5, 150, 105, 0.25);
            transition: all 0.25s ease;
        }

        .btn-positive:hover {
            transform: translateY(-2px);
            background: linear-gradient(135deg, #047857 0%, #059669 100%);
            box-shadow: 0 16px 32px rgba(5, 150, 105, 0.35);
        }

        .text-gradient {
            background: linear-gradient(to right, #0B2B40, #0F4C5C, #059669);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        [x-cloak] { display: none !important; }
    </style>
</head>

<body class="antialiased khmer-pattern" x-data="{
    showBalance: true,
    moveFundsModal: false,
    statementModal: false,
    toastMsg: '',
    showToast(msg) {
        this.toastMsg = msg;
        setTimeout(() => { this.toastMsg = ''; }, 3500);
    },
    // Ledger filter
    ledgerFilter: 'all',
    // FX Swap state
    fxSendAmount: 2500,
    fxFromCurr: 'USD',
    fxToCurr: 'KHR',
    fxRates: {
        'USD_KHR': 4115.00,
        'KHR_USD': 0.000243,
        'USD_THB': 34.82,
        'THB_USD': 0.0287,
        'USD_EUR': 0.92,
        'EUR_USD': 1.085,
    },
    swapCurrencies() {
        let temp = this.fxFromCurr;
        this.fxFromCurr = this.fxToCurr;
        this.fxToCurr = temp;
    },
    get fxCalculated() {
        let key = this.fxFromCurr + '_' + this.fxToCurr;
        let rate = this.fxRates[key] || 1;
        return (this.fxSendAmount * rate).toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 });
    },
    executeSwap() {
        this.showToast('បានប្តូរប្រាក់ដោយជោគជ័យ ' + this.fxSendAmount + ' ' + this.fxFromCurr + ' ទៅជា ' + this.fxCalculated + ' ' + this.fxToCurr + '!');
    }
}">

    <!-- ប្រអប់ជូនដំណឹង Toast -->
    <div x-show="toastMsg" x-cloak class="fixed bottom-6 right-6 z-50 bg-navy-950 text-white px-5 py-3.5 rounded-2xl shadow-2xl border border-emerald-500/30 flex items-center gap-3 transition-all transform ease-out duration-300">
        <div class="w-7 h-7 rounded-lg bg-emerald-500/20 text-emerald-400 flex items-center justify-center">
            <i data-lucide="check-circle" class="w-4 h-4"></i>
        </div>
        <span class="text-xs font-semibold" x-text="toastMsg"></span>
    </div>

    <!-- របារម៉ឺនុយរុករក -->
    <nav class="fixed top-0 w-full z-40 p-4 md:p-6">
        <div class="max-w-7xl mx-auto flex justify-between items-center bg-white/90 backdrop-blur-xl border border-slate-200/90 rounded-2xl px-6 md:px-8 py-3.5 shadow-sm">
            
            <!-- ស្លាកសញ្ញា -->
            <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                <div class="w-9 h-9 rounded-xl bg-gradient-to-br from-navy-950 via-navy-900 to-teal-700 flex items-center justify-center shadow-sm">
                    <span class="font-display font-bold text-white text-sm">CH</span>
                </div>
                <div>
                    <span class="text-lg font-extrabold tracking-tight text-navy-950">
                        CHHENLA<span class="text-emerald-500 font-black">.</span>
                    </span>
                    <span class="hidden sm:inline-block ml-2 text-[11px] font-bold text-teal-700 font-khmer uppercase">ធនាគារ ចេនឡា</span>
                </div>
            </a>

            <!-- តំណភ្ជាប់ -->
            <div class="hidden md:flex gap-8 text-xs uppercase tracking-wider font-bold">
                <a href="{{ route('home') }}" class="text-slate-600 hover:text-teal-700 transition-colors">ទំព័រដើម</a>
                <a href="#account" class="text-navy-950 hover:text-teal-700 transition-colors border-b-2 border-emerald-500 pb-0.5">វិបផតថល</a>
                <a href="#fx-exchange" class="text-slate-600 hover:text-teal-700 transition-colors">តុប្តូរប្រាក់</a>
                <a href="#transactions" class="text-slate-600 hover:text-teal-700 transition-colors">សៀវភៅបញ្ជី</a>
                <a href="#support" class="text-slate-600 hover:text-teal-700 transition-colors">ផ្នែកជំនួយ</a>
            </div>

            <!-- សកម្មភាពគណនី -->
            <div class="flex items-center gap-3">
                <a href="{{ route('home') }}" class="text-xs font-bold text-slate-600 hover:text-teal-700 transition-all px-3 py-1.5 rounded-lg hover:bg-slate-50 hidden sm:block">
                    គេហទំព័រសាធារណៈ
                </a>
                <a href="{{ route('login') }}" class="text-xs font-bold bg-navy-950 text-white hover:bg-navy-900 px-4 py-2 rounded-xl transition-all flex items-center gap-1.5 shadow-sm">
                    <i data-lucide="user" class="w-3.5 h-3.5 text-emerald-400"></i>
                    <span>ប្តូរគណនី</span>
                </a>
            </div>

        </div>
    </nav>

    <!-- មាតិកាចម្បង -->
    <main class="max-w-7xl mx-auto px-6 pt-32 md:pt-36 pb-20">
        
        <!-- ក្បាលទំព័រ -->
        <header class="mb-10 flex flex-col md:flex-row md:items-end justify-between gap-5">
            <div>
                <div class="flex items-center gap-2 mb-2">
                    <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                    <p class="text-teal-700 font-bold text-xs uppercase tracking-widest">វិបផតថលអតិថិជនស្ថាប័ន &bull; ការិយាល័យកម្ពុជា</p>
                </div>
                <h1 class="text-3xl md:text-5xl font-extrabold text-navy-950 tracking-tight">
                    សូមស្វាគមន៍ការវិលត្រឡប់មកវិញ, <span class="text-gradient">ប៊ុន លាភ</span>
                </h1>
            </div>

            <div class="flex items-center gap-3">
                <div class="bg-white border border-emerald-200/90 rounded-full px-4 py-2 flex items-center gap-2.5 shadow-sm">
                    <span class="relative flex h-2.5 w-2.5">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-500 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-emerald-500"></span>
                    </span>
                    <span class="text-xs font-bold text-emerald-800 tracking-wide">សុវត្ថិភាព 256-Bit SSL ការពារ</span>
                </div>

                <button @click="showBalance = !showBalance" class="bg-white border border-slate-200/90 hover:bg-slate-50 text-slate-700 px-3.5 py-2 rounded-full text-xs font-semibold flex items-center gap-1.5 shadow-sm transition-all" title="បង្ហាញ ឬលាក់សមតុល្យ">
                    <i data-lucide="eye" class="w-3.5 h-3.5" x-show="showBalance"></i>
                    <i data-lucide="eye-off" class="w-3.5 h-3.5" x-show="!showBalance" x-cloak></i>
                    <span x-text="showBalance ? 'លាក់' : 'បង្ហាញ'"></span>
                </button>
            </div>
        </header>

        <!-- Bento Grid គណនី -->
        <div id="account" class="grid grid-cols-1 md:grid-cols-12 gap-6 mb-12">
            
            <!-- កាតសមតុល្យចម្បង (Deep Navy) -->
            <div class="md:col-span-8 bento-card-navy rounded-[2.5rem] p-8 md:p-12 relative overflow-hidden text-white flex flex-col justify-between">
                
                <div class="relative z-10 flex flex-col h-full">
                    
                    <div class="flex justify-between items-start mb-8">
                        <div>
                            <span class="text-emerald-400 text-xs font-bold uppercase tracking-widest flex items-center gap-1.5">
                                <i data-lucide="wallet" class="w-3.5 h-3.5"></i> សាច់ប្រាក់អាចប្រើប្រាស់បាន
                            </span>
                            <h2 class="font-display text-4xl sm:text-6xl md:text-7xl font-extrabold mt-3 tracking-tight">
                                <span x-show="showBalance">$12,450<span class="text-emerald-300/80 font-normal text-3xl md:text-4xl">.00</span></span>
                                <span x-show="!showBalance" x-cloak class="tracking-widest">••••••••</span>
                            </h2>
                            <p class="text-xs text-slate-300 mt-2 font-mono">
                                រូបិយប័ណ្ណគោល: ដុល្លារ (USD) &bull; សមមូលប្រាក់រៀល: ៛51,231,750
                            </p>
                        </div>

                        <div class="w-13 h-13 p-3 bg-white/10 rounded-2xl flex items-center justify-center border border-white/15 backdrop-blur-sm">
                            <i data-lucide="shield-check" class="text-emerald-400 w-7 h-7"></i>
                        </div>
                    </div>

                    <div class="grid sm:grid-cols-2 gap-4 mb-8 max-w-lg">
                        <div class="bg-white/5 border border-white/10 rounded-2xl p-4 backdrop-blur-sm">
                            <span class="text-xs text-slate-300 block mb-1 font-medium">កម្រិតផ្ទេរប្រាក់ប្រចាំថ្ងៃ</span>
                            <span class="font-display font-bold text-lg text-white">$50,000.00</span>
                        </div>
                        <div class="bg-white/5 border border-white/10 rounded-2xl p-4 backdrop-blur-sm">
                            <span class="text-xs text-slate-300 block mb-1 font-medium">អត្រាផលចំណេញប្រចាំឆ្នាំ</span>
                            <span class="font-display font-bold text-lg text-emerald-400">+4.8% APY ធានា</span>
                        </div>
                    </div>
                    
                    <div class="mt-auto flex flex-wrap gap-4">
                        <button @click="moveFundsModal = true" class="btn-positive px-7 py-3.5 rounded-xl flex items-center gap-2 text-sm">
                            <i data-lucide="arrow-up-right" class="w-4 h-4"></i>
                            <span>ផ្ទេរប្រាក់</span>
                        </button>
                        <button @click="statementModal = true" class="px-7 py-3.5 bg-white/10 border border-white/20 text-white font-bold rounded-xl hover:bg-white/20 transition-all flex items-center gap-2 text-sm backdrop-blur-sm">
                            <i data-lucide="download" class="w-4 h-4"></i>
                            <span>ទាញយករបាយការណ៍</span>
                        </button>
                    </div>

                </div>

                <!-- ពន្លឺផ្ទៃខាងក្រោយ -->
                <div class="absolute -bottom-24 -right-24 w-96 h-96 bg-emerald-500/15 rounded-full blur-[100px] pointer-events-none"></div>
                <div class="absolute -top-20 -left-20 w-80 h-80 bg-teal-500/15 rounded-full blur-[90px] pointer-events-none"></div>
            </div>

            <!-- កាតគណនីសកម្ម -->
            <div class="md:col-span-4 bento-card rounded-[2.5rem] p-8 md:p-10 flex flex-col justify-between">
                <div>
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-navy-950 text-lg font-bold">
                            គណនីតុដេកសកម្ម
                        </h3>
                        <span class="text-xs font-bold bg-emerald-50 text-emerald-800 border border-emerald-200 px-3 py-1 rounded-full">
                            ០២ បានផ្ទៀងផ្ទាត់
                        </span>
                    </div>

                    <div class="space-y-4">
                        <!-- កាតសាជីវកម្ម -->
                        <div class="p-4 bg-slate-50 border border-slate-200/90 rounded-2xl flex items-center justify-between group hover:border-teal-700 hover:bg-teal-50/40 transition-all cursor-pointer">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 bg-white rounded-xl flex items-center justify-center text-teal-700 shadow-sm border border-slate-100">
                                    <i data-lucide="credit-card" class="w-6 h-6"></i>
                                </div>
                                <div>
                                    <p class="text-[10px] text-slate-500 uppercase font-bold tracking-wider">កាតសាជីវកម្ម</p>
                                    <p class="text-sm font-bold text-navy-950 tracking-tight font-mono">VISA &bull;&bull;&bull;&bull; 8940</p>
                                </div>
                            </div>
                            <span class="text-xs font-bold text-emerald-600 bg-emerald-50 px-2.5 py-1 rounded-lg">សកម្ម</span>
                        </div>

                        <!-- តុដេកអ៊ិនគ្រីប -->
                        <div class="p-4 bg-slate-50 border border-slate-200/90 rounded-2xl flex items-center justify-between group hover:border-emerald-600 hover:bg-emerald-50/40 transition-all cursor-pointer">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 bg-white rounded-xl flex items-center justify-center text-emerald-600 shadow-sm border border-slate-100">
                                    <i data-lucide="lock" class="w-6 h-6"></i>
                                </div>
                                <div>
                                    <p class="text-[10px] text-slate-500 uppercase font-bold tracking-wider">តុដេកថែរក្សាទ្រព្យ</p>
                                    <p class="text-sm font-bold text-navy-950 tracking-tight">ទ្រព្យបញ្ចាំអចលនទ្រព្យ</p>
                                </div>
                            </div>
                            <span class="text-xs font-bold text-teal-700 bg-teal-50 px-2.5 py-1 rounded-lg">មានសុវត្ថិភាព</span>
                        </div>
                    </div>
                </div>

                <div class="pt-6 border-t border-slate-100 mt-6 flex items-center justify-between text-xs text-slate-500 font-medium">
                    <span class="flex items-center gap-1.5">
                        <i data-lucide="smartphone" class="w-4 h-4 text-slate-400"></i>
                        ការផ្ទៀងផ្ទាត់ 2FA
                    </span>
                    <span class="text-emerald-700 font-bold flex items-center gap-1">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                        បានបើកដំណើរការ
                    </span>
                </div>
            </div>

        </div>

        <!-- ========================================================= -->
        <!-- តុប្តូរប្រាក់អន្តរធនាគារភ្លាមៗ (LIVE FX EXCHANGE DESK) -->
        <!-- ========================================================= -->
        <section id="fx-exchange" class="mb-14 bento-card rounded-[2.5rem] p-8 md:p-12 border border-slate-200/90 relative overflow-hidden">
            <div class="grid lg:grid-cols-12 gap-10 items-center">

                <div class="lg:col-span-5 space-y-4">
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs font-bold">
                        <i data-lucide="refresh-cw" class="w-3.5 h-3.5 text-emerald-600"></i>
                        ការទូទាត់អន្តរធនាគារភ្លាមៗ
                    </div>
                    <h2 class="text-2xl md:text-3xl font-extrabold text-navy-950 tracking-tight">
                        តុប្តូរប្រាក់ពហុរូបិយប័ណ្ណភ្លាមៗ
                    </h2>
                    <p class="text-slate-600 text-sm leading-relaxed">
                        ប្តូរប្រាក់រវាង ប្រាក់ដុល្លារ (USD), ប្រាក់រៀល (KHR), ប្រាក់បាតថៃ (THB), និងប្រាក់អឺរ៉ូ (EUR) ភ្លាមៗតាមអត្រាទីផ្សារស្ថាប័នដោយមិនគិតកម្រៃជើងសារ។
                    </p>

                    <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200/80 space-y-2 text-xs">
                        <div class="flex justify-between">
                            <span class="text-slate-500">អត្រាគោលស្តង់ដារ:</span>
                            <span class="font-bold text-navy-950 font-mono">1 USD = 4,115.00 KHR</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-slate-500">ថ្លៃសេវាប្តូរប្រាក់:</span>
                            <span class="font-bold text-emerald-600">0.00% ឥតគិតថ្លៃ</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-slate-500">គណនីទទួលផល:</span>
                            <span class="font-bold text-navy-950">គណនីពិសេស ចេនឡា</span>
                        </div>
                    </div>
                </div>

                <!-- ទម្រង់ប្តូរប្រាក់ -->
                <div class="lg:col-span-7 bg-slate-50/80 border border-slate-200/90 rounded-3xl p-6 md:p-8 space-y-5">
                    
                    <!-- ផ្ញើចេញ -->
                    <div class="space-y-1.5">
                        <label class="text-[11px] font-bold uppercase tracking-wider text-slate-500">អ្នកផ្ញើចេញ (កាត់ចេញពីសមតុល្យ)</label>
                        <div class="flex bg-white rounded-2xl border border-slate-200 overflow-hidden shadow-sm">
                            <input type="number" x-model="fxSendAmount" class="w-full px-5 py-3.5 font-display font-extrabold text-xl text-navy-950 outline-none">
                            <select x-model="fxFromCurr" class="bg-slate-100 px-5 font-bold text-sm text-navy-950 border-l border-slate-200 outline-none">
                                <option value="USD">ដុល្លារ ($)</option>
                                <option value="KHR">រៀល (៛)</option>
                                <option value="THB">បាត (฿)</option>
                                <option value="EUR">អឺរ៉ូ (€)</option>
                            </select>
                        </div>
                    </div>

                    <!-- ប៊ូតុងត្រឡប់រូបិយប័ណ្ណ -->
                    <div class="flex justify-center -my-2 relative z-10">
                        <button type="button" @click="swapCurrencies()" class="w-10 h-10 rounded-full bg-navy-950 hover:bg-teal-700 text-white flex items-center justify-center shadow-md transition-all hover:rotate-180 duration-300">
                            <i data-lucide="arrow-down-up" class="w-4 h-4"></i>
                        </button>
                    </div>

                    <!-- ទទួលបាន -->
                    <div class="space-y-1.5">
                        <label class="text-[11px] font-bold uppercase tracking-wider text-slate-500">អ្នកទទួលបាន (បញ្ចូលទៅក្នុងគណនី)</label>
                        <div class="flex bg-white rounded-2xl border border-slate-200 overflow-hidden shadow-sm">
                            <input type="text" readonly :value="fxCalculated" class="w-full px-5 py-3.5 font-display font-extrabold text-xl text-emerald-600 bg-slate-50 outline-none cursor-default">
                            <select x-model="fxToCurr" class="bg-slate-100 px-5 font-bold text-sm text-navy-950 border-l border-slate-200 outline-none">
                                <option value="KHR">រៀល (៛)</option>
                                <option value="USD">ដុល្លារ ($)</option>
                                <option value="THB">បាត (฿)</option>
                                <option value="EUR">អឺរ៉ូ (€)</option>
                            </select>
                        </div>
                    </div>

                    <button type="button" @click="executeSwap()" class="w-full py-4 btn-positive text-white font-bold rounded-xl text-sm flex items-center justify-center gap-2">
                        <i data-lucide="check" class="w-4 h-4"></i>
                        <span>បញ្ជាក់ និងអនុវត្តការប្តូរប្រាក់ភ្លាមៗ</span>
                    </button>
                </div>

            </div>
        </section>

        <!-- ========================================================= -->
        <!-- សៀវភៅបញ្ជីប្រតិបត្តិការ (LEDGER & ACTIVITY) -->
        <!-- ========================================================= -->
        <section id="transactions" class="mb-20">
            
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
                <div>
                    <h2 class="text-2xl font-bold text-navy-950 tracking-tight">
                        សកម្មភាពថ្មីៗ & កំណត់ត្រាសៀវភៅបញ្ជី
                    </h2>
                    <p class="text-slate-500 text-sm mt-0.5">ប្រព័ន្ធកត់ត្រាសវនកម្មស្វ័យប្រវត្តនៃរាល់ប្រតិបត្តិការដែលបានទូទាត់រួច។</p>
                </div>

                <div class="flex items-center gap-2.5">
                    <!-- តម្រងប្រភេទ -->
                    <div class="bg-slate-100 p-1 rounded-xl flex items-center text-xs font-bold text-slate-600">
                        <button @click="ledgerFilter = 'all'" :class="ledgerFilter === 'all' ? 'bg-white text-navy-950 shadow-sm' : 'text-slate-500'" class="px-3.5 py-1.5 rounded-lg transition-all">ទាំងអស់</button>
                        <button @click="ledgerFilter = 'inflow'" :class="ledgerFilter === 'inflow' ? 'bg-white text-navy-950 shadow-sm' : 'text-slate-500'" class="px-3.5 py-1.5 rounded-lg transition-all">ប្រាក់ចូល</button>
                        <button @click="ledgerFilter = 'outflow'" :class="ledgerFilter === 'outflow' ? 'bg-white text-navy-950 shadow-sm' : 'text-slate-500'" class="px-3.5 py-1.5 rounded-lg transition-all">ប្រាក់ចេញ</button>
                    </div>

                    <button @click="statementModal = true" class="text-xs font-bold uppercase tracking-wider text-teal-700 hover:text-teal-900 bg-teal-50 hover:bg-teal-100 border border-teal-200/80 px-4 py-2 rounded-xl flex items-center gap-2 transition-all">
                        <i data-lucide="file-spreadsheet" class="w-3.5 h-3.5"></i>
                        <span>ទាញយក CSV</span>
                    </button>
                </div>
            </div>

            <div class="bento-card rounded-[2rem] overflow-hidden">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="text-[11px] uppercase tracking-wider text-slate-500 bg-slate-50 border-b border-slate-200/80">
                            <th class="px-8 py-5 font-bold">ឈ្មោះប្រតិបត្តិការ</th>
                            <th class="px-8 py-5 font-bold text-center">ស្ថានភាព</th>
                            <th class="px-8 py-5 font-bold text-right">ទំហំទឹកប្រាក់</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-sm">
                        
                        <!-- ជួរទី១: ប្រាក់ចូល -->
                        <tr class="group hover:bg-slate-50/70 transition-colors" x-show="ledgerFilter === 'all' || ledgerFilter === 'inflow'">
                            <td class="px-8 py-5">
                                <div class="flex items-center gap-4">
                                    <div class="w-11 h-11 rounded-xl bg-emerald-50 flex items-center justify-center text-emerald-600 border border-emerald-100 shadow-sm">
                                        <i data-lucide="arrow-down-left" class="w-5 h-5"></i>
                                    </div>
                                    <div>
                                        <p class="font-bold text-navy-950 tracking-tight">ការបែងចែកប្រាក់ចំណូលរតនាគារ</p>
                                        <p class="text-xs text-slate-400 mt-0.5">ថ្ងៃនេះ, 09:41 ព្រឹក &bull; ផ្ទេរប្រាក់តាមប្រព័ន្ធស្វ័យប្រវត្ត</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-8 py-5 text-center">
                                <span class="px-3.5 py-1.5 bg-emerald-50 text-emerald-700 rounded-full text-xs font-bold uppercase tracking-wider border border-emerald-200">
                                    ទូទាត់រួច
                                </span>
                            </td>
                            <td class="px-8 py-5 text-right font-extrabold text-emerald-600 text-lg font-mono">
                                +$1,200.00
                            </td>
                        </tr>

                        <!-- ជួរទី២: ប្រាក់ចេញ -->
                        <tr class="group hover:bg-slate-50/70 transition-colors" x-show="ledgerFilter === 'all' || ledgerFilter === 'outflow'">
                            <td class="px-8 py-5">
                                <div class="flex items-center gap-4">
                                    <div class="w-11 h-11 rounded-xl bg-slate-100 flex items-center justify-center text-slate-600 border border-slate-200 shadow-sm">
                                        <i data-lucide="server" class="w-5 h-5"></i>
                                    </div>
                                    <div>
                                        <p class="font-bold text-navy-950 tracking-tight">វិក្កយបត្រហេដ្ឋារចនាសម្ព័ន្ធ Cloud</p>
                                        <p class="text-xs text-slate-400 mt-0.5">ម្សិលមិញ, 14:20 រសៀល &bull; កាតសាជីវកម្ម •••• 8940</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-8 py-5 text-center">
                                <span class="px-3.5 py-1.5 bg-slate-100 text-slate-600 rounded-full text-xs font-bold uppercase tracking-wider border border-slate-200">
                                    ទូទាត់រួច
                                </span>
                            </td>
                            <td class="px-8 py-5 text-right font-extrabold text-navy-950 text-lg font-mono">
                                -$199.00
                            </td>
                        </tr>

                        <!-- ជួរទី៣: ប្តូរប្រាក់ -->
                        <tr class="group hover:bg-slate-50/70 transition-colors" x-show="ledgerFilter === 'all' || ledgerFilter === 'inflow'">
                            <td class="px-8 py-5">
                                <div class="flex items-center gap-4">
                                    <div class="w-11 h-11 rounded-xl bg-teal-50 flex items-center justify-center text-teal-700 border border-teal-100 shadow-sm">
                                        <i data-lucide="repeat" class="w-5 h-5"></i>
                                    </div>
                                    <div>
                                        <p class="font-bold text-navy-950 tracking-tight">ប្តូរប្រាក់: ដុល្លារ (USD) &rarr; រៀល (KHR)</p>
                                        <p class="text-xs text-slate-400 mt-0.5">15 វិច្ឆិកា 2026 &bull; អត្រាប្តូរ 4,115.00</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-8 py-5 text-center">
                                <span class="px-3.5 py-1.5 bg-emerald-50 text-emerald-700 rounded-full text-xs font-bold uppercase tracking-wider border border-emerald-200">
                                    ទូទាត់រួច
                                </span>
                            </td>
                            <td class="px-8 py-5 text-right font-extrabold text-emerald-600 text-lg font-mono">
                                +៛4,115,000
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>

        </section>

        <!-- ========================================================= -->
        <!-- ផ្នែកបម្រើអតិថិជនពិសេស (SUPPORT CONCIERGE) -->
        <!-- ========================================================= -->
        <section id="support" class="grid lg:grid-cols-3 gap-8">
            
            <div class="lg:col-span-1">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-teal-50 text-teal-800 text-xs font-bold mb-3">
                    <i data-lucide="headphones" class="w-3.5 h-3.5"></i>
                    ផ្នែកទំនាក់ទំនងអតិថិជនពិសេស
                </div>
                <h2 class="text-3xl font-extrabold text-navy-950 mb-3">
                    សេវាជំនួយអតិថិជន
                </h2>
                <p class="text-slate-600 mb-8 leading-relaxed text-sm">
                    ទំនាក់ទំនងផ្ទាល់ជាមួយមន្ត្រីធនាគារជាន់ខ្ពស់ និងក្រុមបច្ចេកទេសរតនាគារសម្រាប់លោក ប៊ុន លាភ។
                </p>

                <div class="space-y-4">
                    <a href="tel:+85523999888" class="flex items-center gap-4 p-5 bento-card rounded-2xl group cursor-pointer hover:border-teal-700 transition-all">
                        <div class="w-11 h-11 bg-teal-50 rounded-xl flex items-center justify-center text-teal-700 border border-teal-100">
                            <i data-lucide="phone-call" class="w-5 h-5"></i>
                        </div>
                        <div>
                            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">ការិយាល័យធនាគារអាទិភាព</p>
                            <p class="font-bold text-navy-950 group-hover:text-teal-700 transition-colors">+855 23 999 888</p>
                        </div>
                    </a>

                    <a href="https://t.me/Hengbunleap1" target="_blank" class="flex items-center gap-4 p-5 bento-card rounded-2xl group cursor-pointer hover:border-teal-700 transition-all">
                        <div class="w-11 h-11 bg-emerald-50 rounded-xl flex items-center justify-center text-emerald-600 border border-emerald-100">
                            <i data-lucide="send" class="w-5 h-5"></i>
                        </div>
                        <div>
                            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Telegram ផ្ទាល់</p>
                            <p class="font-bold text-navy-950 group-hover:text-emerald-700 transition-colors">@Hengbunleap1</p>
                        </div>
                    </a>
                </div>
            </div>
            
            <div class="lg:col-span-2 bento-card rounded-[2.5rem] p-8 md:p-12">
                <form class="space-y-6" @submit.prevent="showToast('សំណើត្រូវបានបញ្ជូនទៅកាន់មន្ត្រីទំនាក់ទំនងរួចរាល់ហើយ!')">
                    <div class="grid md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label class="text-xs font-bold text-slate-600 uppercase tracking-wider ml-1">លេខយោងអត្តសញ្ញាណ</label>
                            <input type="text" value="ប៊ុន លាភ &bull; គណនី #8940" readonly class="w-full bg-slate-50 border border-slate-200 rounded-xl p-4 text-slate-700 outline-none cursor-not-allowed font-medium text-sm">
                        </div>

                        <div class="space-y-2">
                            <label class="text-xs font-bold text-slate-600 uppercase tracking-wider ml-1">ប្រធានបទស្នើសុំ</label>
                            <select class="w-full bg-slate-50 border border-slate-200 rounded-xl p-4 text-slate-800 focus:bg-white focus:border-teal-700 outline-none transition-all text-sm font-medium">
                                <option>ការសាកសួរអំពីរតនាគារ និងការប្តូរប្រាក់ស្ថាប័ន</option>
                                <option>ការផ្ទេរទ្រព្យសម្បត្តិ និងការដោះលែងទ្រព្យបញ្ចាំ</option>
                                <option>វិញ្ញាបនបត្រសវនកម្មសុវត្ថិភាព និងអនុលោមភាព</option>
                                <option>ការស្នើសុំដំឡើងទំហំឥណទានពាណិជ្ជកម្ម</option>
                            </select>
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label class="text-xs font-bold text-slate-600 uppercase tracking-wider ml-1">សារសុវត្ថិភាព</label>
                        <textarea rows="4" placeholder="សូមសរសេរព័ត៌មានលម្អិតអំពីតម្រូវការធនាគាររបស់លោកអ្នកនៅទីនេះ..." class="w-full bg-slate-50 border border-slate-200 rounded-xl p-4 text-slate-800 focus:bg-white focus:border-teal-700 outline-none transition-all text-sm" required></textarea>
                    </div>

                    <button type="submit" class="btn-positive w-full py-4 text-white font-bold rounded-xl transition-all flex items-center justify-center gap-2">
                        <i data-lucide="send" class="w-4 h-4"></i>
                        <span>បញ្ជូនសំណើទៅកាន់មន្ត្រីបម្រើការ</span>
                    </button>
                </form>
            </div>

        </section>

    </main>

    <!-- ផ្ទាំងបង្អួចផ្ទេរប្រាក់ (Move Funds Modal) -->
    <div x-show="moveFundsModal" x-cloak class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-navy-950/60 backdrop-blur-sm">
        <div class="bg-white rounded-[2rem] max-w-lg w-full p-8 shadow-2xl border border-slate-200 space-y-6">
            <div class="flex justify-between items-center pb-4 border-b border-slate-100">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center">
                        <i data-lucide="arrow-up-right" class="w-5 h-5"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-navy-950">ផ្ទេរប្រាក់</h3>
                        <p class="text-xs text-slate-500">ផ្ទេរប្រាក់ផ្ទៃក្នុង ឬអន្តរធនាគារ</p>
                    </div>
                </div>
                <button @click="moveFundsModal = false" class="text-slate-400 hover:text-navy-950">
                    <i data-lucide="x" class="w-5 h-5"></i>
                </button>
            </div>

            <div class="space-y-4">
                <div class="space-y-1.5">
                    <label class="text-xs font-bold uppercase tracking-wider text-slate-500">គណនីអ្នកទទួល / ធនាគារ</label>
                    <input type="text" placeholder="ឧ. 098 765 432 (បាគង / ABA / ចេនឡា)" class="w-full bg-slate-50 border border-slate-200 rounded-xl p-3.5 text-sm outline-none focus:border-teal-700 font-medium">
                </div>
                <div class="space-y-1.5">
                    <label class="text-xs font-bold uppercase tracking-wider text-slate-500">ចំនួនទឹកប្រាក់ (ដុល្លារ USD)</label>
                    <input type="number" placeholder="0.00" class="w-full bg-slate-50 border border-slate-200 rounded-xl p-3.5 text-lg font-bold outline-none focus:border-teal-700">
                </div>
            </div>

            <div class="flex gap-3 pt-2">
                <button @click="moveFundsModal = false" class="w-1/2 py-3 bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold rounded-xl text-xs">
                    បោះបង់
                </button>
                <button @click="moveFundsModal = false; showToast('បានចាប់ផ្តើមដំណើរការផ្ទេរប្រាក់ដោយជោគជ័យ!')" class="w-1/2 py-3 btn-positive text-white font-bold rounded-xl text-xs">
                    អនុញ្ញាតការផ្ទេរប្រាក់
                </button>
            </div>
        </div>
    </div>

    <!-- ផ្ទាំងបង្អួចទាញយករបាយការណ៍ (Download Statement Modal) -->
    <div x-show="statementModal" x-cloak class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-navy-950/60 backdrop-blur-sm">
        <div class="bg-white rounded-[2rem] max-w-md w-full p-8 shadow-2xl border border-slate-200 space-y-6">
            <div class="flex justify-between items-center pb-4 border-b border-slate-100">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-teal-50 text-teal-700 flex items-center justify-center">
                        <i data-lucide="download" class="w-5 h-5"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-navy-950">ទាញយករបាយការណ៍គណនី</h3>
                        <p class="text-xs text-slate-500">របាយការណ៍ផ្លូវការមានហត្ថលេខាឌីជីថល</p>
                    </div>
                </div>
                <button @click="statementModal = false" class="text-slate-400 hover:text-navy-950">
                    <i data-lucide="x" class="w-5 h-5"></i>
                </button>
            </div>

            <p class="text-xs text-slate-600 leading-relaxed">
                បង្កើតរបាយការណ៍សៀវភៅបញ្ជីផ្លូវការដែលបានផ្ទៀងផ្ទាត់សម្រាប់គណនី #8940 សម្រាប់រយៈពេលប្រតិបត្តិការបច្ចុប្បន្ន។
            </p>

            <div class="space-y-2">
                <button @click="statementModal = false; showToast('កំពុងទាញយករបាយការណ៍ផ្លូវការជាទម្រង់ PDF...')" class="w-full py-3.5 bg-navy-950 hover:bg-navy-900 text-white font-bold rounded-xl text-xs flex items-center justify-center gap-2">
                    <i data-lucide="file-text" class="w-4 h-4 text-emerald-400"></i>
                    <span>ទាញយកជាឯកសារ PDF ផ្លូវការ</span>
                </button>
                <button @click="statementModal = false; showToast('កំពុងទាញយកទិន្នន័យជាទម្រង់ CSV...')" class="w-full py-3.5 bg-slate-100 hover:bg-slate-200 text-navy-950 font-bold rounded-xl text-xs flex items-center justify-center gap-2">
                    <i data-lucide="table" class="w-4 h-4 text-teal-700"></i>
                    <span>ទាញយកទិន្នន័យសៀវភៅបញ្ជី (CSV)</span>
                </button>
            </div>
        </div>
    </div>

    <!-- បាតទំព័រ -->
    <footer class="py-12 border-t border-slate-200 bg-white text-center">
        <div class="font-display text-xl font-bold tracking-tight text-navy-950 mb-2">
            CHHENLA<span class="text-emerald-500">.</span>
        </div>
        <p class="text-xs text-slate-500 font-medium">
            &copy; 2026 ធនាគារ ចេនឡា (Chhenla Financial Group). រក្សាសិទ្ធិគ្រប់យ៉ាង &bull; វិបផតថលអតិថិជនសម្រាប់លោក ប៊ុន លាភ។
        </p>
    </footer>

    <script>
        // Initialize Lucide Icons
        lucide.createIcons();
    </script>
</body>
</html>

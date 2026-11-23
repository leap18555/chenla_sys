<!DOCTYPE html>
<html lang="km" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ធនាគារ ចេនឡា | Chhenla Bank - ប្រព័ន្ធធនាគារឌីជីថលឈានមុខគេ</title>

    <!-- Tailwind CSS CDN -->
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
                            950: '#071527',
                        },
                        teal: {
                            700: '#0F4C5C',
                            800: '#0c3d4a',
                            900: '#082a33',
                        },
                        emerald: {
                            500: '#10B981',
                            600: '#059669',
                            700: '#047857',
                        },
                        gold: {
                            400: '#FBBF24',
                            500: '#D4AF37',
                            600: '#B8860B',
                        }
                    },
                    boxShadow: {
                        'soft': '0 20px 50px -12px rgba(11, 43, 64, 0.08)',
                        'card': '0 12px 35px -6px rgba(11, 43, 64, 0.06)',
                        'glow': '0 10px 30px -5px rgba(16, 185, 129, 0.35)',
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
            overflow-x: hidden;
            line-height: 1.6;
        }

        .khmer-pattern {
            background-image: url("data:image/svg+xml,%3Csvg width='56' height='56' viewBox='0 0 56 56' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' stroke='%230F4C5C' stroke-width='1' stroke-opacity='0.04'%3E%3Cpath d='M28 4 L52 28 L28 52 L4 28 Z'/%3E%3Cpath d='M28 14 L42 28 L28 42 L14 28 Z'/%3E%3Ccircle cx='28' cy='28' r='3' fill='%230F4C5C' fill-opacity='0.04'/%3E%3C/g%3E%3C/svg%3E");
        }

        .glass-nav {
            background: rgba(255, 255, 255, 0.88);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(226, 232, 240, 0.85);
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.94);
            backdrop-filter: blur(16px);
            border: 1px solid rgba(226, 232, 240, 0.9);
            box-shadow: 0 16px 40px -8px rgba(11, 43, 64, 0.06);
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .glass-card:hover {
            transform: translateY(-4px);
            border-color: rgba(15, 76, 92, 0.3);
            box-shadow: 0 25px 50px -12px rgba(11, 43, 64, 0.12);
        }

        .gradient-dark {
            background: linear-gradient(135deg, #071527 0%, #0B2B40 55%, #0F4C5C 100%);
        }

        .gradient-emerald {
            background: linear-gradient(135deg, #059669 0%, #10B981 100%);
        }

        .text-gradient-teal {
            background: linear-gradient(135deg, #0B2B40 0%, #0F4C5C 50%, #059669 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .ticker-wrap {
            width: 100%;
            overflow: hidden;
            white-space: nowrap;
        }

        .ticker-move {
            display: inline-block;
            white-space: nowrap;
            animation: ticker 34s linear infinite;
        }

        .ticker-move:hover {
            animation-play-state: paused;
        }

        @keyframes ticker {
            0% { transform: translate3d(0, 0, 0); }
            100% { transform: translate3d(-50%, 0, 0); }
        }

        [x-cloak] { display: none !important; }
    </style>
</head>

<body class="khmer-pattern selection:bg-emerald-500 selection:text-white" x-data="{ mobileMenuOpen: false }">

    <!-- ========================================================= -->
    <!-- របារជូនដំណឹងខាងលើ (TOP BAR) -->
    <!-- ========================================================= -->
    <div class="bg-navy-950 text-white text-xs py-2.5 px-4 border-b border-white/10 hidden sm:block">
        <div class="max-w-7xl mx-auto flex items-center justify-between">
            <div class="flex items-center gap-3">
                <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full bg-emerald-500/20 text-emerald-300 font-semibold text-[11px] border border-emerald-500/30">
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
                    អនុលោមតាម NBC
                </span>
                <span class="text-slate-300">ហេដ្ឋារចនាសម្ព័ន្ធធនាគារឌីជីថលស្របច្បាប់នៃព្រះរាជាណាចក្រកម្ពុជា</span>
            </div>
            <div class="flex items-center gap-6 text-slate-300 text-[11px]">
                <span class="flex items-center gap-1.5"><i data-lucide="phone-call" class="w-3.5 h-3.5 text-emerald-400"></i> +855 (23) 999 888</span>
                <span class="flex items-center gap-1.5"><i data-lucide="shield-check" class="w-3.5 h-3.5 text-emerald-400"></i> សុវត្ថិភាពកម្រិត 256-Bit SSL</span>
                <a href="{{ route('exchange') }}" class="text-emerald-400 hover:text-emerald-300 font-semibold underline underline-offset-2">វិបផតថលអតិថិជន &rarr;</a>
            </div>
        </div>
    </div>

    <!-- ========================================================= -->
    <!-- របារម៉ឺនុយរុករក (NAVIGATION BAR) -->
    <!-- ========================================================= -->
    <header class="sticky top-0 z-50 glass-nav transition-all duration-300">
        <div class="max-w-7xl mx-auto px-6 h-20 flex items-center justify-between">

            <!-- Logo -->
            <a href="/" class="flex items-center gap-3.5 group">
                <div class="w-11 h-11 rounded-2xl bg-gradient-to-br from-navy-950 via-navy-900 to-teal-700 p-0.5 shadow-md flex items-center justify-center transform group-hover:scale-105 transition-transform">
                    <div class="w-full h-full rounded-[14px] bg-navy-950 flex items-center justify-center border border-white/10">
                        <span class="font-display font-black text-white text-base tracking-tighter">CH</span>
                    </div>
                </div>
                <div>
                    <div class="flex items-center gap-1.5">
                        <span class="font-display text-xl font-extrabold tracking-tight text-navy-950">CHHENLA</span>
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                    </div>
                    <p class="text-[11px] font-bold text-teal-700 uppercase -mt-0.5 font-khmer">ធនាគារ ចេនឡា</p>
                </div>
            </a>

            <!-- Desktop Menu Links (ភាសាខ្មែរ) -->
            <nav class="hidden lg:flex items-center gap-8 text-sm font-semibold text-slate-700">
                <a href="#services" class="hover:text-teal-700 transition-colors">សេវាកម្ម</a>
                <a href="#loans" class="hover:text-teal-700 transition-colors">កម្ចី & ឥណទាន</a>
                <a href="#fx-calculator" class="hover:text-teal-700 transition-colors">អត្រាប្តូរប្រាក់</a>
                <a href="#security" class="hover:text-teal-700 transition-colors">ប្រព័ន្ធសុវត្ថិភាព</a>
                <a href="{{ route('exchange') }}" class="text-emerald-600 hover:text-emerald-700 font-bold flex items-center gap-1.5">
                    <span>វិបផតថលប្តូរប្រាក់</span>
                    <span class="text-[10px] bg-emerald-100 text-emerald-800 px-2 py-0.5 rounded-full font-bold">ផ្សាយផ្ទាល់</span>
                </a>
                <a href="https://t.me/Hengbunleap1" target="_blank" class="hover:text-teal-700 transition-colors flex items-center gap-1">
                    <span>ជំនួយ</span>
                    <i data-lucide="external-link" class="w-3.5 h-3.5 text-slate-400"></i>
                </a>
            </nav>

            <!-- Action Buttons -->
            <div class="hidden sm:flex items-center gap-3">
                <a href="{{ route('login') }}" class="px-5 py-2.5 text-xs font-bold text-navy-950 bg-slate-100/90 hover:bg-slate-200/80 rounded-xl transition-all flex items-center gap-2">
                    <i data-lucide="lock" class="w-3.5 h-3.5 text-teal-700"></i>
                    <span>ចូលប្រើប្រាស់</span>
                </a>
                <a href="{{ route('register') }}" class="px-6 py-2.5 text-xs font-bold text-white gradient-emerald hover:opacity-95 rounded-xl shadow-glow transition-all flex items-center gap-2">
                    <span>បើកគណនីថ្មី</span>
                    <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
                </a>
            </div>

            <!-- Mobile Hamburger Button -->
            <div class="lg:hidden flex items-center">
                <button @click="mobileMenuOpen = !mobileMenuOpen" class="p-2 text-slate-700 hover:text-navy-950 focus:outline-none">
                    <i data-lucide="menu" class="w-6 h-6" x-show="!mobileMenuOpen"></i>
                    <i data-lucide="x" class="w-6 h-6" x-show="mobileMenuOpen" x-cloak></i>
                </button>
            </div>
        </div>

        <!-- Mobile Dropdown -->
        <div x-show="mobileMenuOpen" x-cloak class="lg:hidden bg-white/95 backdrop-blur-xl border-b border-slate-200 px-6 py-5 space-y-4">
            <a href="#services" @click="mobileMenuOpen = false" class="block text-sm font-semibold text-slate-700 hover:text-teal-700">សេវាកម្មធនាគារ</a>
            <a href="#loans" @click="mobileMenuOpen = false" class="block text-sm font-semibold text-slate-700 hover:text-teal-700">កម្ចី និងឥណទាន</a>
            <a href="#fx-calculator" @click="mobileMenuOpen = false" class="block text-sm font-semibold text-slate-700 hover:text-teal-700">អត្រាប្តូរប្រាក់បរទេស</a>
            <a href="#security" @click="mobileMenuOpen = false" class="block text-sm font-semibold text-slate-700 hover:text-teal-700">ប្រព័ន្ធសុវត្ថិភាព</a>
            <a href="{{ route('exchange') }}" class="block text-sm font-bold text-emerald-600">វិបផតថលប្តូរប្រាក់ស្ថាប័ន</a>
            <div class="pt-4 border-t border-slate-200 flex flex-col gap-2.5">
                <a href="{{ route('login') }}" class="w-full text-center py-2.5 text-xs font-bold text-navy-950 bg-slate-100 rounded-xl">ចូលប្រើប្រាស់</a>
                <a href="{{ route('register') }}" class="w-full text-center py-2.5 text-xs font-bold text-white gradient-emerald rounded-xl">បើកគណនីថ្មី</a>
            </div>
        </div>
    </header>

    <!-- ========================================================= -->
    <!-- របារផ្សាយផ្ទាល់អត្រាប្តូរប្រាក់ (LIVE FX TICKER) -->
    <!-- ========================================================= -->
    <div class="bg-navy-900 border-b border-navy-800 text-slate-300 py-2.5 text-xs font-medium">
        <div class="ticker-wrap flex items-center">
            <div class="ticker-move flex items-center gap-8">
                <span class="flex items-center gap-2"><strong class="text-white">ដុល្លារ / រៀល (USD/KHR)</strong> 4,115.00 <span class="text-emerald-400 font-bold">+0.05%</span></span>
                <span class="text-slate-600">&bull;</span>
                <span class="flex items-center gap-2"><strong class="text-white">ដុល្លារ / បាត (USD/THB)</strong> 34.82 <span class="text-emerald-400 font-bold">+0.12%</span></span>
                <span class="text-slate-600">&bull;</span>
                <span class="flex items-center gap-2"><strong class="text-white">អឺរ៉ូ / ដុល្លារ (EUR/USD)</strong> 1.0850 <span class="text-rose-400 font-bold">-0.08%</span></span>
                <span class="text-slate-600">&bull;</span>
                <span class="flex items-center gap-2"><strong class="text-white">ដុល្លារ / យន់ (USD/CNY)</strong> 7.2340 <span class="text-emerald-400 font-bold">+0.02%</span></span>
                <span class="text-slate-600">&bull;</span>
                <span class="flex items-center gap-2"><strong class="text-white">តម្លៃមាសអន្តរជាតិ (XAU/USD)</strong> $2,684.50/oz <span class="text-gold-400 font-bold">+0.45%</span></span>
                <span class="text-slate-600">&bull;</span>
                <span class="flex items-center gap-2"><strong class="text-white">ប្រាក់បញ្ញើមានកាលកំណត់ ៣ខែ</strong> 6.85% ក្នុងមួយឆ្នាំ <span class="text-emerald-400 font-bold">ធានាផលចំណេញ</span></span>
                <span class="text-slate-600">&bull;</span>
                <!-- Duplicate for loop -->
                <span class="flex items-center gap-2"><strong class="text-white">ដុល្លារ / រៀល (USD/KHR)</strong> 4,115.00 <span class="text-emerald-400 font-bold">+0.05%</span></span>
                <span class="text-slate-600">&bull;</span>
                <span class="flex items-center gap-2"><strong class="text-white">ដុល្លារ / បាត (USD/THB)</strong> 34.82 <span class="text-emerald-400 font-bold">+0.12%</span></span>
                <span class="text-slate-600">&bull;</span>
                <span class="flex items-center gap-2"><strong class="text-white">អឺរ៉ូ / ដុល្លារ (EUR/USD)</strong> 1.0850 <span class="text-rose-400 font-bold">-0.08%</span></span>
                <span class="text-slate-600">&bull;</span>
                <span class="flex items-center gap-2"><strong class="text-white">តម្លៃមាសអន្តរជាតិ (XAU/USD)</strong> $2,684.50/oz <span class="text-gold-400 font-bold">+0.45%</span></span>
            </div>
        </div>
    </div>

    <!-- ========================================================= -->
    <!-- ផ្នែកខាងមុខ (HERO SECTION) -->
    <!-- ========================================================= -->
    <section class="relative pt-12 pb-24 md:pt-20 md:pb-32 overflow-hidden">
        <!-- Ambient radial gradients -->
        <div class="absolute top-1/4 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[700px] h-[500px] bg-gradient-to-tr from-teal-700/10 via-emerald-500/10 to-transparent rounded-full blur-3xl pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-6 relative z-10">
            <div class="grid lg:grid-cols-12 gap-12 lg:gap-8 items-center">

                <!-- ជួរឈរខាងឆ្វេង: អត្ថបទ & ប៊ូតុង -->
                <div class="lg:col-span-7 space-y-6">
                    <div class="inline-flex items-center gap-2.5 px-4 py-2 rounded-full bg-teal-50 border border-teal-200/80 text-teal-800 text-xs font-bold shadow-sm">
                        <span class="w-2 h-2 rounded-full bg-emerald-500 animate-ping"></span>
                        <span>ប្រព័ន្ធធនាគារឌីជីថលជំនាន់ថ្មី &bull; Chhenla Core 4.0</span>
                    </div>

                    <h1 class="text-3xl sm:text-5xl lg:text-[56px] font-extrabold tracking-tight text-navy-950 leading-[1.25]">
                        ប្រព័ន្ធធនាគារឌីជីថល <br class="hidden sm:inline">
                        <span class="text-gradient-teal">ឈានមុខ និងទំនើបបំផុត</span> <br>
                        សម្រាប់អាជីវកម្ម និងបុគ្គល
                    </h1>

                    <p class="text-slate-600 text-base sm:text-lg leading-relaxed max-w-2xl font-normal">
                        ផ្តល់ជូននូវសេវាកម្មកម្ចីពាណិជ្ជកម្ម និងបុគ្គលរហ័សទាន់ចិត្ត ការទូទាត់ និងប្តូរប្រាក់ពហុរូបិយប័ណ្ណភ្លាមៗ (USD និង KHR) ការគ្រប់គ្រងទ្រព្យបញ្ចាំប្រកបដោយតម្លាភាព និងសេវាថែរក្សាទ្រព្យសម្បត្តិប្រកបដោយសុវត្ថិភាពខ្ពស់បំផុត។
                    </p>

                    <!-- ប៊ូតុងសកម្មភាព -->
                    <div class="flex flex-col sm:flex-row gap-4 pt-2">
                        <a href="{{ route('register') }}" class="px-8 py-4 text-sm font-bold text-white gradient-emerald hover:shadow-glow rounded-2xl flex items-center justify-center gap-2.5 transition-all">
                            <span>បើកគណនីឌីជីថល</span>
                            <i data-lucide="arrow-up-right" class="w-4 h-4"></i>
                        </a>

                        <a href="{{ route('exchange') }}" class="px-8 py-4 text-sm font-bold text-navy-900 bg-white hover:bg-slate-50 border border-slate-200/90 rounded-2xl shadow-sm flex items-center justify-center gap-2.5 hover:border-teal-700 transition-all">
                            <i data-lucide="repeat" class="w-4 h-4 text-teal-700"></i>
                            <span>វិបផតថលប្តូរប្រាក់ភ្លាមៗ</span>
                        </a>
                    </div>

                    <!-- សូចនាករទំនុកចិត្ត -->
                    <div class="pt-6 border-t border-slate-200/80 grid grid-cols-3 gap-6 max-w-lg">
                        <div>
                            <p class="font-display text-2xl font-bold text-navy-950">$1.8B+</p>
                            <p class="text-xs text-slate-500 font-medium mt-0.5">ទ្រព្យស្ថិតក្រោមការគ្រប់គ្រង</p>
                        </div>
                        <div>
                            <p class="font-display text-2xl font-bold text-emerald-600">0.4s</p>
                            <p class="text-xs text-slate-500 font-medium mt-0.5">ល្បឿននៃការទូទាត់ភ្លាមៗ</p>
                        </div>
                        <div>
                            <p class="font-display text-2xl font-bold text-navy-950">99.99%</p>
                            <p class="text-xs text-slate-500 font-medium mt-0.5">ស្ថេរភាពដំណើរការ 24/7</p>
                        </div>
                    </div>
                </div>

                <!-- ជួរឈរខាងស្តាំ: រូបភាពកាត និងផ្ទាំងព័ត៌មានអន្តរកម្ម -->
                <div class="lg:col-span-5 relative">
                    <div class="relative mx-auto max-w-md">

                        <!-- កាតធនាគារ Platinum -->
                        <div class="gradient-dark rounded-[2.25rem] p-7 text-white shadow-navy-glow border border-white/15 relative overflow-hidden transform -rotate-1 hover:rotate-0 transition-transform duration-500">
                            <!-- ពន្លឺផ្ទៃខាងក្រោយ -->
                            <div class="absolute -right-16 -top-16 w-52 h-52 bg-emerald-500/20 rounded-full blur-2xl pointer-events-none"></div>

                            <div class="flex justify-between items-start mb-8">
                                <div>
                                    <span class="text-[11px] tracking-widest uppercase font-bold text-emerald-400">គណនីពិសេស ចេនឡា</span>
                                    <h3 class="font-display text-2xl font-bold tracking-tight mt-1">Bun Leap</h3>
                                </div>
                                <div class="w-10 h-10 rounded-xl bg-white/10 flex items-center justify-center border border-white/20">
                                    <i data-lucide="wifi" class="w-5 h-5 text-emerald-400"></i>
                                </div>
                            </div>

                            <div class="space-y-1 mb-8">
                                <span class="text-xs text-slate-400 font-medium">សាច់ប្រាក់អាចប្រើប្រាស់សរុប</span>
                                <div class="font-display text-4xl font-extrabold tracking-tight flex items-baseline gap-2">
                                    $148,920<span class="text-xl text-emerald-400 font-normal">.50</span>
                                </div>
                                <p class="text-[11px] text-emerald-400/90 font-medium flex items-center gap-1">
                                    <i data-lucide="trending-up" class="w-3.5 h-3.5"></i> +12.4% កំណើនផលចំណេញប្រចាំខែនេះ
                                </p>
                            </div>

                            <div class="flex justify-between items-end pt-4 border-t border-white/10 text-xs">
                                <div>
                                    <span class="text-[10px] text-slate-400 block font-medium">លេខគណនី</span>
                                    <span class="font-mono tracking-widest text-slate-200">**** 8940 2198</span>
                                </div>
                                <div class="text-right">
                                    <span class="text-[10px] text-slate-400 block font-medium">ប្រភេទគណនី</span>
                                    <span class="text-gold-400 font-bold">ឥស្សរជនពាណិជ្ជកម្ម</span>
                                </div>
                            </div>
                        </div>

                        <!-- ផ្ទាំងជូនដំណឹងអណ្តែត: ប្រាក់កម្ចី -->
                        <div class="absolute -bottom-6 -left-6 bg-white/95 backdrop-blur-xl border border-slate-200/90 rounded-2xl p-4 shadow-xl flex items-center gap-3 max-w-[290px] animate-bounce" style="animation-duration: 4s;">
                            <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center flex-shrink-0 border border-emerald-100">
                                <i data-lucide="arrow-down-left" class="w-5 h-5"></i>
                            </div>
                            <div class="overflow-hidden">
                                <p class="text-xs font-bold text-navy-950 truncate">ទម្លាក់ប្រាក់កម្ចីជោគជ័យ: $25,000</p>
                                <p class="text-[10px] text-slate-500 font-medium">ទើបតែអនុម័ត &bull; ចូលគណនី</p>
                            </div>
                        </div>

                        <!-- ផ្ទាំងសុវត្ថិភាពអណ្តែត -->
                        <div class="absolute -top-4 -right-4 bg-white/95 backdrop-blur-xl border border-slate-200/90 rounded-2xl p-3 shadow-lg flex items-center gap-2.5">
                            <div class="w-8 h-8 rounded-lg bg-teal-50 text-teal-700 flex items-center justify-center">
                                <i data-lucide="shield-check" class="w-4 h-4"></i>
                            </div>
                            <div>
                                <p class="text-[11px] font-bold text-navy-950">តុដេកសុវត្ថិភាព 256-Bit</p>
                                <p class="text-[9px] text-emerald-600 font-semibold">ប្រព័ន្ធការពារសូន្យហានិភ័យ</p>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- ========================================================= -->
    <!-- កញ្ចប់សេវាកម្មចម្បង (CORE SERVICES) -->
    <!-- ========================================================= -->
    <section id="services" class="py-24 bg-white border-y border-slate-200/70">
        <div class="max-w-7xl mx-auto px-6">

            <div class="text-center max-w-2xl mx-auto mb-16 space-y-3">
                <span class="text-xs font-bold text-teal-700 uppercase tracking-widest bg-teal-50 border border-teal-100 px-3.5 py-1 rounded-full">
                    កញ្ចប់សេវាកម្មធនាគារពេញលេញ
                </span>
                <h2 class="text-2xl sm:text-4xl font-extrabold text-navy-950 tracking-tight">
                    រៀបចំឡើងយ៉ាងពិសេសសម្រាប់សហគ្រាស និងរូបវន្តបុគ្គល
                </h2>
                <p class="text-slate-600 text-sm sm:text-base">
                    ចាប់ពីសេវាកម្ចីឥណទានខ្នាតតូច និងពាណិជ្ជកម្មជាមួយការគ្រប់គ្រងទ្រព្យបញ្ចាំប្រកបដោយតម្លាភាព រហូតដល់ការប្តូរប្រាក់បរទេសភ្លាមៗ។
                </p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">

                <!-- សេវាកម្មទី១: កម្ចី និងឥណទាន -->
                <div class="glass-card rounded-[2rem] p-8 flex flex-col justify-between">
                    <div>
                        <div class="w-14 h-14 rounded-2xl bg-teal-50 text-teal-700 border border-teal-100 flex items-center justify-center mb-6">
                            <i data-lucide="landmark" class="w-7 h-7"></i>
                        </div>
                        <h3 class="text-lg font-bold text-navy-950 mb-2">
                            កម្ចីពាណិជ្ជកម្ម និងឥណទានបុគ្គល
                        </h3>
                        <p class="text-slate-600 text-sm leading-relaxed mb-6">
                            កាលវិភាគសងត្រឡប់ច្បាស់លាស់ អត្រាការប្រាក់សមរម្យ និងការដាក់ពាក្យស្នើសុំកម្ចីតាមអនឡាញប្រកបដោយភាពរហ័សទាន់ចិត្ត។
                        </p>
                        <ul class="space-y-2.5 text-xs text-slate-600 font-medium">
                            <li class="flex items-center gap-2">
                                <i data-lucide="check-circle-2" class="w-4 h-4 text-emerald-600"></i>
                                វាយតម្លៃ និងអនុម័តកម្ចីឌីជីថលរហ័ស
                            </li>
                            <li class="flex items-center gap-2">
                                <i data-lucide="check-circle-2" class="w-4 h-4 text-emerald-600"></i>
                                រយៈពេលសងបត់បែនចាប់ពី ៦ ដល់ ៦០ ខែ
                            </li>
                            <li class="flex items-center gap-2">
                                <i data-lucide="check-circle-2" class="w-4 h-4 text-emerald-600"></i>
                                ជម្រើសរូបិយប័ណ្ណជា ប្រាក់រៀល (KHR) ឬ ដុល្លារ (USD)
                            </li>
                        </ul>
                    </div>

                    <div class="pt-6 mt-6 border-t border-slate-100">
                        <a href="#loans" class="text-xs font-bold text-teal-700 hover:text-teal-800 flex items-center gap-1 group">
                            <span>គណនាការបង់ប្រាក់រំលស់</span>
                            <i data-lucide="arrow-right" class="w-3.5 h-3.5 group-hover:translate-x-1 transition-transform"></i>
                        </a>
                    </div>
                </div>

                <!-- សេវាកម្មទី២: ប្តូរប្រាក់បរទេស -->
                <div class="glass-card rounded-[2rem] p-8 flex flex-col justify-between border-teal-600/30 ring-1 ring-teal-600/10">
                    <div>
                        <div class="w-14 h-14 rounded-2xl bg-emerald-50 text-emerald-600 border border-emerald-100 flex items-center justify-center mb-6">
                            <i data-lucide="repeat" class="w-7 h-7"></i>
                        </div>
                        <h3 class="text-lg font-bold text-navy-950 mb-2">
                            សេវាប្តូរប្រាក់ និងគ្រប់គ្រងរតនាគារ
                        </h3>
                        <p class="text-slate-600 text-sm leading-relaxed mb-6">
                            ប្តូរប្រាក់ដោយគ្មានការពន្យារពេល ផ្អែកលើអត្រាទីផ្សារជាក់ស្តែងសម្រាប់ USD, KHR, THB, EUR, CNY ដោយគ្មានការលាក់កំបាំងថ្លៃសេវា។
                        </p>
                        <ul class="space-y-2.5 text-xs text-slate-600 font-medium">
                            <li class="flex items-center gap-2">
                                <i data-lucide="check-circle-2" class="w-4 h-4 text-emerald-600"></i>
                                អត្រាប្តូរប្រាក់អន្តរធនាគារភ្លាមៗ (Real-time)
                            </li>
                            <li class="flex items-center gap-2">
                                <i data-lucide="check-circle-2" class="w-4 h-4 text-emerald-600"></i>
                                ទូទាត់ចូលក្នុងសមតុល្យគណនីភ្លាមៗ
                            </li>
                            <li class="flex items-center gap-2">
                                <i data-lucide="check-circle-2" class="w-4 h-4 text-emerald-600"></i>
                                របាយការណ៍សៀវភៅបញ្ជីកត់ត្រាអេឡិចត្រូនិកច្បាស់លាស់
                            </li>
                        </ul>
                    </div>

                    <div class="pt-6 mt-6 border-t border-slate-100">
                        <a href="{{ route('exchange') }}" class="text-xs font-bold text-emerald-600 hover:text-emerald-700 flex items-center gap-1 group">
                            <span>ចូលវិបផតថលប្តូរប្រាក់</span>
                            <i data-lucide="arrow-right" class="w-3.5 h-3.5 group-hover:translate-x-1 transition-transform"></i>
                        </a>
                    </div>
                </div>

                <!-- សេវាកម្មទី៣: ទ្រព្យបញ្ចាំ និងប្រាក់បញ្ញើ -->
                <div class="glass-card rounded-[2rem] p-8 flex flex-col justify-between">
                    <div>
                        <div class="w-14 h-14 rounded-2xl bg-gold-400/15 text-gold-600 border border-gold-400/20 flex items-center justify-center mb-6">
                            <i data-lucide="shield-check" class="w-7 h-7"></i>
                        </div>
                        <h3 class="text-lg font-bold text-navy-950 mb-2">
                            សេវាថែរក្សាទ្រព្យបញ្ចាំ និងប្រាក់បញ្ញើ
                        </h3>
                        <p class="text-slate-600 text-sm leading-relaxed mb-6">
                            គ្រប់គ្រងទ្រព្យធានា (ប្លង់ដី អចលនទ្រព្យ យានយន្ត មាស) ប្រកបដោយសុវត្ថិភាព ជាមួយនឹងការវាយតម្លៃត្រឹមត្រូវតាមផ្លូវច្បាប់។
                        </p>
                        <ul class="space-y-2.5 text-xs text-slate-600 font-medium">
                            <li class="flex items-center gap-2">
                                <i data-lucide="check-circle-2" class="w-4 h-4 text-emerald-600"></i>
                                បញ្ជីផ្ទៀងផ្ទាត់ប័ណ្ណកម្មសិទ្ធិឌីជីថល
                            </li>
                            <li class="flex items-center gap-2">
                                <i data-lucide="check-circle-2" class="w-4 h-4 text-emerald-600"></i>
                                ប្រាក់បញ្ញើសន្សំមានកាលកំណត់ការប្រាក់ខ្ពស់
                            </li>
                            <li class="flex items-center gap-2">
                                <i data-lucide="check-circle-2" class="w-4 h-4 text-emerald-600"></i>
                                ពិធីសារអនុញ្ញាតហត្ថលេខាពីរជាន់ (Dual-signature)
                            </li>
                        </ul>
                    </div>

                    <div class="pt-6 mt-6 border-t border-slate-100">
                        <a href="{{ route('login') }}" class="text-xs font-bold text-teal-700 hover:text-teal-800 flex items-center gap-1 group">
                            <span>ចូលពិនិត្យតុដេក</span>
                            <i data-lucide="arrow-right" class="w-3.5 h-3.5 group-hover:translate-x-1 transition-transform"></i>
                        </a>
                    </div>
                </div>

            </div>

        </div>
    </section>

    <!-- ========================================================= -->
    <!-- ម៉ាស៊ីនគិតលេខហិរញ្ញវត្ថុអន្តរកម្ម (CALCULATORS) -->
    <!-- ========================================================= -->
    <section id="loans" class="py-24 bg-slate-50 relative overflow-hidden" x-data="{
        activeTab: 'loan',
        // Loan state
        loanAmount: 10000,
        loanDuration: 24,
        loanRate: 9.5,
        currency: 'USD',
        get monthlyPayment() {
            let P = this.loanAmount;
            let r = (this.loanRate / 100) / 12;
            let n = this.loanDuration;
            if (r === 0) return (P / n).toFixed(2);
            let payment = (P * r * Math.pow(1 + r, n)) / (Math.pow(1 + r, n) - 1);
            return payment.toFixed(2);
        },
        get totalInterest() {
            let total = (parseFloat(this.monthlyPayment) * this.loanDuration) - this.loanAmount;
            return total > 0 ? total.toFixed(2) : 0;
        },
        // FX State
        fxAmount: 1000,
        fxFrom: 'USD',
        fxTo: 'KHR',
        rates: {
            'USD_KHR': 4115,
            'KHR_USD': 0.000243,
            'USD_THB': 34.82,
            'THB_USD': 0.0287,
            'USD_EUR': 0.92,
            'EUR_USD': 1.085,
        },
        calculateFx() {
            let pair = this.fxFrom + '_' + this.fxTo;
            let rate = this.rates[pair] || 1;
            return (this.fxAmount * rate).toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 });
        }
    }">
        <div class="max-w-7xl mx-auto px-6">

            <div class="text-center max-w-2xl mx-auto mb-14 space-y-3">
                <span class="text-xs font-bold text-teal-700 uppercase tracking-widest bg-teal-50 border border-teal-100 px-3.5 py-1 rounded-full">
                    ម៉ាស៊ីនគិតលេខហិរញ្ញវត្ថុឆ្លាតវៃ
                </span>
                <h2 class="text-2xl sm:text-4xl font-extrabold text-navy-950 tracking-tight">
                    គណនាការបង់ប្រាក់រំលស់ ឬអត្រាប្តូរប្រាក់ភ្លាមៗ
                </h2>
                <p class="text-slate-600 text-sm sm:text-base">
                    លោកអ្នកអាចធ្វើការគណនាប្រាក់ត្រូវសងប្រចាំខែ ឬគណនាការប្តូរប្រាក់តាមអត្រាជាក់ស្តែងភ្លាមៗមុនពេលសម្រេចចិត្ត។
                </p>

                <!-- ប៊ូតុងប្តូរ Tab -->
                <div class="inline-flex p-1.5 rounded-2xl bg-white border border-slate-200/90 shadow-sm mt-4">
                    <button @click="activeTab = 'loan'" :class="activeTab === 'loan' ? 'bg-navy-950 text-white shadow-sm' : 'text-slate-600 hover:text-navy-950'" class="px-6 py-2.5 rounded-xl text-xs font-bold transition-all flex items-center gap-2">
                        <i data-lucide="calculator" class="w-4 h-4"></i>
                        <span>ម៉ាស៊ីនគិតប្រាក់កម្ចី</span>
                    </button>
                    <button @click="activeTab = 'fx'" :class="activeTab === 'fx' ? 'bg-navy-950 text-white shadow-sm' : 'text-slate-600 hover:text-navy-950'" class="px-6 py-2.5 rounded-xl text-xs font-bold transition-all flex items-center gap-2">
                        <i data-lucide="refresh-cw" class="w-4 h-4"></i>
                        <span>ម៉ាស៊ីនប្តូរប្រាក់ផ្ទាល់</span>
                    </button>
                </div>
            </div>

            <!-- Tab ទី១: ម៉ាស៊ីនគិតប្រាក់កម្ចី -->
            <div x-show="activeTab === 'loan'" class="max-w-4xl mx-auto glass-card rounded-[2.5rem] p-8 md:p-12 border border-slate-200/80">
                <div class="grid md:grid-cols-12 gap-8 items-center">

                    <!-- Sliders & Inputs -->
                    <div class="md:col-span-7 space-y-6">

                        <!-- ទំហំទឹកប្រាក់កម្ចី -->
                        <div class="space-y-2">
                            <div class="flex justify-between items-center">
                                <label class="text-xs font-bold uppercase tracking-wider text-slate-500">ចំនួនទឹកប្រាក់កម្ចី (<span x-text="currency"></span>)</label>
                                <span class="font-display text-lg font-extrabold text-navy-950" x-text="(currency === 'USD' ? '$' : '៛') + Number(loanAmount).toLocaleString()"></span>
                            </div>
                            <input type="range" x-model="loanAmount" min="500" max="100000" step="500" class="w-full h-2 bg-slate-200 rounded-lg appearance-none cursor-pointer accent-teal-700">
                            <div class="flex justify-between text-[11px] text-slate-400 font-semibold font-mono">
                                <span>$500</span>
                                <span>$50,000</span>
                                <span>$100,000+</span>
                            </div>
                        </div>

                        <!-- រយៈពេលកម្ចី -->
                        <div class="space-y-2">
                            <div class="flex justify-between items-center">
                                <label class="text-xs font-bold uppercase tracking-wider text-slate-500">រយៈពេលកម្ចី (ខែ)</label>
                                <span class="font-display text-lg font-extrabold text-navy-950" x-text="loanDuration + ' ខែ'"></span>
                            </div>
                            <input type="range" x-model="loanDuration" min="6" max="60" step="6" class="w-full h-2 bg-slate-200 rounded-lg appearance-none cursor-pointer accent-teal-700">
                            <div class="flex justify-between text-[11px] text-slate-400 font-semibold">
                                <span>៦ ខែ</span>
                                <span>២៤ ខែ</span>
                                <span>៦០ ខែ</span>
                            </div>
                        </div>

                        <!-- អត្រាការប្រាក់ -->
                        <div class="flex items-center justify-between p-4 bg-slate-100/80 rounded-2xl border border-slate-200/70">
                            <div>
                                <span class="text-xs font-bold text-navy-950 block">អត្រាការប្រាក់ថេរប្រចាំឆ្នាំ</span>
                                <span class="text-[11px] text-slate-500">អត្រាអនុគ្រោះពិសេសសម្រាប់អតិថិជន</span>
                            </div>
                            <span class="font-display text-lg font-bold text-teal-700" x-text="loanRate + '% ក្នុងមួយឆ្នាំ'"></span>
                        </div>
                    </div>

                    <!-- កាតលទ្ធផលបង្ហាញ -->
                    <div class="md:col-span-5 gradient-dark rounded-3xl p-7 text-white space-y-6">
                        <div>
                            <span class="text-xs uppercase font-bold tracking-widest text-emerald-400 block mb-1">ប៉ាន់ស្មានត្រូវបង់ប្រចាំខែ</span>
                            <div class="font-display text-4xl font-extrabold tracking-tight">
                                <span x-text="currency === 'USD' ? '$' : '៛'"></span><span x-text="Number(monthlyPayment).toLocaleString()"></span>
                            </div>
                            <p class="text-[11px] text-slate-300 mt-1">ប្រាក់ដើម + ការប្រាក់ សរុបក្នុងមួយខែ</p>
                        </div>

                        <div class="space-y-2.5 pt-4 border-t border-white/10 text-xs">
                            <div class="flex justify-between text-slate-300">
                                <span>ប្រាក់ដើមកម្ចីសរុប:</span>
                                <strong class="text-white" x-text="'$' + Number(loanAmount).toLocaleString()"></strong>
                            </div>
                            <div class="flex justify-between text-slate-300">
                                <span>ការប្រាក់សរុបត្រូវបង់:</span>
                                <strong class="text-emerald-400" x-text="'$' + Number(totalInterest).toLocaleString()"></strong>
                            </div>
                            <div class="flex justify-between text-slate-300">
                                <span>ទឹកប្រាក់សរុបត្រូវសង:</span>
                                <strong class="text-white" x-text="'$' + (Number(loanAmount) + Number(totalInterest)).toLocaleString()"></strong>
                            </div>
                        </div>

                        <a href="{{ route('register') }}" class="w-full py-3.5 bg-emerald-500 hover:bg-emerald-600 text-navy-950 font-bold text-xs uppercase tracking-wider rounded-xl flex items-center justify-center gap-2 transition-all">
                            <span>ដាក់ពាក្យស្នើសុំកម្ចីនេះ</span>
                            <i data-lucide="arrow-right" class="w-4 h-4"></i>
                        </a>
                    </div>

                </div>
            </div>

            <!-- Tab ទី២: ម៉ាស៊ីនប្តូរប្រាក់ផ្ទាល់ -->
            <div x-show="activeTab === 'fx'" x-cloak class="max-w-4xl mx-auto glass-card rounded-[2.5rem] p-8 md:p-12 border border-slate-200/80">
                <div class="grid md:grid-cols-2 gap-8 items-center" id="fx-calculator">

                    <div class="space-y-6">
                        <!-- ប្រាក់ត្រូវប្តូរចេញ -->
                        <div class="space-y-2">
                            <label class="text-xs font-bold uppercase tracking-wider text-slate-500">អ្នកប្តូរចេញ (ផ្ទេរចេញ)</label>
                            <div class="flex gap-2">
                                <input type="number" x-model="fxAmount" class="w-full bg-slate-50 border border-slate-200 rounded-2xl p-4 text-navy-950 font-display font-bold text-xl outline-none focus:border-teal-700">
                                <select x-model="fxFrom" class="bg-slate-100 border border-slate-200 rounded-2xl px-4 font-bold text-sm text-navy-950 outline-none">
                                    <option value="USD">ដុល្លារ ($)</option>
                                    <option value="KHR">រៀល (៛)</option>
                                    <option value="EUR">អឺរ៉ូ (€)</option>
                                    <option value="THB">បាត (฿)</option>
                                </select>
                            </div>
                        </div>

                        <!-- ប្រាក់ទទួលបាន -->
                        <div class="space-y-2">
                            <label class="text-xs font-bold uppercase tracking-wider text-slate-500">អ្នកទទួលបាន (គណនាជាក់ស្តែង)</label>
                            <div class="flex gap-2">
                                <input type="text" readonly :value="calculateFx()" class="w-full bg-slate-100 border border-slate-200 rounded-2xl p-4 text-emerald-600 font-display font-bold text-xl outline-none cursor-default">
                                <select x-model="fxTo" class="bg-slate-100 border border-slate-200 rounded-2xl px-4 font-bold text-sm text-navy-950 outline-none">
                                    <option value="KHR">រៀល (៛)</option>
                                    <option value="USD">ដុល្លារ ($)</option>
                                    <option value="THB">បាត (฿)</option>
                                    <option value="EUR">អឺរ៉ូ (€)</option>
                                </select>
                            </div>
                        </div>

                        <div class="p-4 bg-emerald-50 rounded-2xl border border-emerald-100 text-xs text-emerald-800 flex items-center justify-between font-medium">
                            <span>ថ្លៃសេវាប្តូរប្រាក់:</span>
                            <span class="font-bold">0.00% (ឥតគិតថ្លៃ - អត្រាស្ថាប័ន)</span>
                        </div>
                    </div>

                    <div class="gradient-dark rounded-3xl p-8 text-white space-y-6">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-white/10 flex items-center justify-center">
                                <i data-lucide="shield-check" class="w-5 h-5 text-emerald-400"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-base">ការទូទាត់ប្តូរប្រាក់ផ្ទាល់</h4>
                                <p class="text-xs text-slate-300">កត់ត្រាក្នុងសៀវភៅបញ្ជីកូដនីយកម្មត្រឹមត្រូវ</p>
                            </div>
                        </div>

                        <p class="text-xs text-slate-300 leading-relaxed">
                            រាល់ប្រតិបត្តិការប្តូរប្រាក់ទាំងអស់ ត្រូវបានអនុវត្តភ្លាមៗតាមអត្រាទីផ្សារជាក់ស្តែងចូលទៅក្នុងគណនី ឬកាបូបរូបិយប័ណ្ណរបស់លោកអ្នក។
                        </p>

                        <a href="{{ route('exchange') }}" class="w-full py-4 text-center gradient-emerald hover:opacity-95 text-white font-bold text-xs uppercase tracking-wider rounded-xl block shadow-glow transition-all">
                            <span>បន្តទៅកាន់តុប្តូរប្រាក់ &rarr;</span>
                        </a>
                    </div>

                </div>
            </div>

        </div>
    </section>

    <!-- ========================================================= -->
    <!-- ស្ថាបត្យកម្មសុវត្ថិភាព និងអនុលោមភាព (SECURITY) -->
    <!-- ========================================================= -->
    <section id="security" class="py-24 bg-white border-b border-slate-200/80">
        <div class="max-w-7xl mx-auto px-6">

            <div class="grid lg:grid-cols-2 gap-16 items-center">

                <div>
                    <span class="text-xs font-bold text-teal-700 uppercase tracking-widest bg-teal-50 border border-teal-100 px-3.5 py-1 rounded-full">
                        ស្តង់ដារសុវត្ថិភាពកម្រិតខ្ពស់
                    </span>
                    <h2 class="text-2xl sm:text-4xl font-extrabold text-navy-950 tracking-tight mt-3 mb-6">
                        ការពារទ្រព្យសម្បត្តិរបស់លោកអ្នកដោយបច្ចេកវិទ្យាកូដនីយកម្មកម្រិតខ្ពស់
                    </h2>
                    <p class="text-slate-600 text-sm sm:text-base leading-relaxed mb-8">
                        ហេដ្ឋារចនាសម្ព័ន្ធស្នូលរបស់យើងរួមបញ្ចូលនូវប្រព័ន្ធការពារពហុជាន់ ការផ្ទៀងផ្ទាត់ជីវមាត្រ 2FA ការតាមដានហានិភ័យ AML និងអនុលោមតាមស្តង់ដារធនាគារជាតិនៃកម្ពុជាជានិច្ច។
                    </p>

                    <div class="space-y-4">
                        <div class="flex items-start gap-4 p-4 rounded-2xl bg-slate-50 border border-slate-200/70">
                            <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center flex-shrink-0">
                                <i data-lucide="lock" class="w-5 h-5"></i>
                            </div>
                            <div>
                                <h4 class="text-sm font-bold text-navy-950">ការអ៊ិនគ្រីបទិន្នន័យ Hardware 256-Bit</h4>
                                <p class="text-xs text-slate-500 mt-0.5">ការពារទិន្នន័យ និងប្រតិបត្តិការហិរញ្ញវត្ថុទាំងស្រុងពីចុងម្ខាងទៅចុងម្ខាង។</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-4 p-4 rounded-2xl bg-slate-50 border border-slate-200/70">
                            <div class="w-10 h-10 rounded-xl bg-teal-50 text-teal-700 flex items-center justify-center flex-shrink-0">
                                <i data-lucide="file-check-2" class="w-5 h-5"></i>
                            </div>
                            <div>
                                <h4 class="text-sm font-bold text-navy-950">កំណត់ត្រាសវនកម្មស្វ័យប្រវត្ត (Audit Logging)</h4>
                                <p class="text-xs text-slate-500 mt-0.5">រាល់ការដាក់ប្រាក់ ដកប្រាក់ ផ្ទេរប្រាក់ និងទម្លាក់កម្ចីត្រូវបានកត់ត្រាឥតកែប្រែបាន។</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-4 p-4 rounded-2xl bg-slate-50 border border-slate-200/70">
                            <div class="w-10 h-10 rounded-xl bg-gold-400/15 text-gold-600 flex items-center justify-center flex-shrink-0">
                                <i data-lucide="badge-check" class="w-5 h-5"></i>
                            </div>
                            <div>
                                <h4 class="text-sm font-bold text-navy-950">អនុលោមភាពតាមច្បាប់ជាតិ</h4>
                                <p class="text-xs text-slate-500 mt-0.5">ស្របតាមការណែនាំ និងបទបញ្ញត្តិរបស់ធនាគារជាតិនៃកម្ពុជា (NBC)។</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ប្រអប់បង្ហាញស្ថានភាពប្រព័ន្ធ -->
                <div class="gradient-dark rounded-[2.5rem] p-8 md:p-12 text-white border border-white/10 relative overflow-hidden shadow-2xl">
                    <div class="relative z-10 space-y-6">
                        <div class="flex justify-between items-center pb-6 border-b border-white/10">
                            <div class="flex items-center gap-3">
                                <span class="w-3 h-3 rounded-full bg-emerald-400 animate-ping"></span>
                                <span class="font-bold text-lg">ស្ថានភាពដំណើរការប្រព័ន្ធ</span>
                            </div>
                            <span class="px-3 py-1 bg-emerald-500/20 text-emerald-300 rounded-full text-xs font-semibold border border-emerald-500/30">
                                ដំណើរការធម្មតា 100%
                            </span>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div class="p-4 rounded-2xl bg-white/5 border border-white/10 backdrop-blur-sm">
                                <span class="text-xs text-slate-400 font-medium block mb-1">ច្រកទូទាត់បាគង / NBC</span>
                                <span class="font-bold text-emerald-400 text-sm">បានភ្ជាប់ជោគជ័យ</span>
                            </div>
                            <div class="p-4 rounded-2xl bg-white/5 border border-white/10 backdrop-blur-sm">
                                <span class="text-xs text-slate-400 font-medium block mb-1">ច្រកទូទាត់កាត Card Gateway</span>
                                <span class="font-bold text-emerald-400 text-sm">សកម្ម (0.02ms)</span>
                            </div>
                            <div class="p-4 rounded-2xl bg-white/5 border border-white/10 backdrop-blur-sm">
                                <span class="text-xs text-slate-400 font-medium block mb-1">ប្រព័ន្ធពិនិត្យកម្ចី</span>
                                <span class="font-bold text-white text-sm">អនឡាញ 24/7</span>
                            </div>
                            <div class="p-4 rounded-2xl bg-white/5 border border-white/10 backdrop-blur-sm">
                                <span class="text-xs text-slate-400 font-medium block mb-1">ប្រព័ន្ធបម្រុងទុកទិន្នន័យ</span>
                                <span class="font-bold text-white text-sm">ស្វ័យប្រវត្តគ្រប់ទីតាំង</span>
                            </div>
                        </div>

                        <div class="p-4 rounded-2xl bg-emerald-500/10 border border-emerald-500/20 text-xs text-emerald-200">
                            <strong>ស្តង់ដារអន្តរជាតិ:</strong> ប្រព័ន្ធស្កេនស្វែងរកហានិភ័យ និងការការពារការជ្រៀតចូលត្រូវបានត្រួតពិនិត្យជាប្រចាំ ២៤ម៉ោងលើ ២៤ម៉ោង។
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </section>

    <!-- ========================================================= -->
    <!-- អំពាវនាវឱ្យធ្វើសកម្មភាព (CALL TO ACTION) -->
    <!-- ========================================================= -->
    <section class="py-20 bg-slate-900 text-white relative overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-r from-navy-950 via-teal-900 to-navy-950 opacity-90"></div>
        <div class="max-w-5xl mx-auto px-6 relative z-10 text-center space-y-8">
            <span class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-emerald-500/20 text-emerald-300 text-xs font-bold border border-emerald-500/30">
                <i data-lucide="sparkles" class="w-3.5 h-3.5"></i>
                ត្រៀមខ្លួនទទួលយកបទពិសោធន៍ធនាគារឌីជីថលហើយឬនៅ?
            </span>

            <h2 class="text-2xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight max-w-3xl mx-auto leading-tight">
                បើកទ្វារឆ្ពោះទៅកាន់ការគ្រប់គ្រងហិរញ្ញវត្ថុដ៏ឆ្លាតវៃជាមួយធនាគារ ចេនឡា ថ្ងៃនេះ
            </h2>

            <p class="text-slate-300 text-sm sm:text-base max-w-xl mx-auto">
                ចូលរួមជាមួយអតិថិជនរាប់ម៉ឺននាក់ ទាំងសហគ្រាសពាណិជ្ជកម្ម និងបុគ្គលក្នុងការបង្កើនសក្តានុពលហិរញ្ញវត្ថុរបស់លោកអ្នក។
            </p>

            <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                <a href="{{ route('register') }}" class="w-full sm:w-auto px-8 py-4 gradient-emerald hover:opacity-95 text-white font-bold text-sm rounded-2xl shadow-glow transition-all flex items-center justify-center gap-2">
                    <span>ចុះឈ្មោះបើកគណនី</span>
                    <i data-lucide="arrow-right" class="w-4 h-4"></i>
                </a>
                <a href="{{ route('exchange') }}" class="w-full sm:w-auto px-8 py-4 bg-white/10 hover:bg-white/20 border border-white/20 text-white font-bold text-sm rounded-2xl transition-all flex items-center justify-center gap-2">
                    <i data-lucide="repeat" class="w-4 h-4 text-emerald-400"></i>
                    <span>សាកល្បងវិបផតថលប្តូរប្រាក់</span>
                </a>
            </div>
        </div>
    </section>

    <!-- ========================================================= -->
    <!-- បាតទំព័រ (FOOTER) -->
    <!-- ========================================================= -->
    <footer class="bg-navy-950 text-slate-400 text-xs border-t border-white/10 pt-16 pb-12">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid grid-cols-2 md:grid-cols-5 gap-8 mb-12">

                <!-- ព័ត៌មានស្ថាប័ន -->
                <div class="col-span-2 space-y-4">
                    <div class="flex items-center gap-3">
                        <div class="w-9 h-9 rounded-xl bg-gradient-to-br from-teal-700 to-emerald-500 flex items-center justify-center text-white font-bold">
                            CH
                        </div>
                        <span class="text-lg font-extrabold text-white">ធនាគារ ចេនឡា (CHHENLA)</span>
                    </div>
                    <p class="text-slate-400 leading-relaxed max-w-sm">
                        ប្រព័ន្ធធនាគារឌីជីថល ចេនឡា ផ្តល់ជូននូវការផ្តល់កម្ចីឥណទានស្នូល ការប្តូរប្រាក់ពហុរូបិយប័ណ្ណស្ថាប័ន និងការគ្រប់គ្រងទ្រព្យបញ្ចាំប្រកបដោយសុវត្ថិភាពខ្ពស់។
                    </p>
                    <div class="flex items-center gap-3 pt-2">
                        <a href="https://t.me/Hengbunleap1" target="_blank" class="w-9 h-9 rounded-lg bg-white/10 hover:bg-emerald-500 hover:text-white flex items-center justify-center transition-colors">
                            <i data-lucide="send" class="w-4 h-4"></i>
                        </a>
                        <a href="tel:+85523999888" class="w-9 h-9 rounded-lg bg-white/10 hover:bg-emerald-500 hover:text-white flex items-center justify-center transition-colors">
                            <i data-lucide="phone" class="w-4 h-4"></i>
                        </a>
                        <a href="mailto:support@chhenla.bank" class="w-9 h-9 rounded-lg bg-white/10 hover:bg-emerald-500 hover:text-white flex items-center justify-center transition-colors">
                            <i data-lucide="mail" class="w-4 h-4"></i>
                        </a>
                    </div>
                </div>

                <!-- ជួរទី២: ផលិតផល -->
                <div>
                    <h5 class="text-white font-bold uppercase tracking-wider mb-4 text-xs font-display">ផលិតផលសេវាកម្ម</h5>
                    <ul class="space-y-2.5">
                        <li><a href="#services" class="hover:text-emerald-400 transition-colors">កម្ចីពាណិជ្ជកម្ម</a></li>
                        <li><a href="#services" class="hover:text-emerald-400 transition-colors">ឥណទានបុគ្គល</a></li>
                        <li><a href="#fx-calculator" class="hover:text-emerald-400 transition-colors">ប្តូរប្រាក់បរទេស</a></li>
                        <li><a href="#services" class="hover:text-emerald-400 transition-colors">ប្រាក់បញ្ញើសន្សំ</a></li>
                        <li><a href="#services" class="hover:text-emerald-400 transition-colors">តុដេកទ្រព្យបញ្ចាំ</a></li>
                    </ul>
                </div>

                <!-- ជួរទី៣: វេទិកា -->
                <div>
                    <h5 class="text-white font-bold uppercase tracking-wider mb-4 text-xs font-display">វេទិកាប្រព័ន្ធ</h5>
                    <ul class="space-y-2.5">
                        <li><a href="{{ route('exchange') }}" class="hover:text-emerald-400 transition-colors">វិបផតថលអតិថិជន</a></li>
                        <li><a href="{{ route('login') }}" class="hover:text-emerald-400 transition-colors">ចូលប្រើប្រាស់បុគ្គលិក</a></li>
                        <li><a href="{{ route('register') }}" class="hover:text-emerald-400 transition-colors">ចុះឈ្មោះអតិថិជនកម្ចី</a></li>
                        <li><a href="#security" class="hover:text-emerald-400 transition-colors">ស្ថាបត្យកម្មសុវត្ថិភាព</a></li>
                    </ul>
                </div>

                <!-- ជួរទី៤: ទំនាក់ទំនង -->
                <div>
                    <h5 class="text-white font-bold uppercase tracking-wider mb-4 text-xs font-display">ផ្នែកបម្រើអតិថិជន</h5>
                    <ul class="space-y-2.5">
                        <li class="text-slate-300 font-semibold">ទូរស័ព្ទបន្ទាន់: +855 23 999 888</li>
                        <li><a href="https://t.me/Hengbunleap1" target="_blank" class="text-emerald-400 hover:underline">Telegram: @Hengbunleap1</a></li>
                        <li>រាជធានីភ្នំពេញ ព្រះរាជាណាចក្រកម្ពុជា</li>
                        <li>ចន្ទ - សៅរ៍: ៨:០០ ព្រឹក - ៥:០០ ល្ងាច</li>
                    </ul>
                </div>

            </div>

            <!-- បាតក្រោមបង្អស់ -->
            <div class="pt-8 border-t border-white/10 flex flex-col sm:flex-row justify-between items-center gap-4 text-slate-500 text-[11px]">
                <p>&copy; {{ date('Y') }} ធនាគារ ចេនឡា (Chhenla Bank). រក្សាសិទ្ធិគ្រប់យ៉ាង។</p>
                <div class="flex items-center gap-6">
                    <span class="flex items-center gap-1.5"><i data-lucide="shield" class="w-3.5 h-3.5 text-emerald-500"></i> អនុលោមតាមធនាគារជាតិនៃកម្ពុជា</span>
                    <span>គោលការណ៍ឯកជនភាព</span>
                    <span>លក្ខខណ្ឌប្រើប្រាស់</span>
                </div>
            </div>
        </div>
    </footer>

    <script>
        // Initialize Lucide icons
        lucide.createIcons();
    </script>
</body>
</html>

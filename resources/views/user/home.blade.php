<!DOCTYPE html>
<html lang="km">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

    <title>@yield('title', 'PawnDesk | Modern Collateral & Loan System')</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Fonts: Inter & Noto Sans Khmer -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Noto+Sans+Khmer:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --bg-main: #f8fafc;
            --sidebar-bg: #ffffff;
            --card-bg: rgba(255, 255, 255, 0.85);
            --card-border: rgba(226, 232, 240, 0.9);
            --gold-accent: #d97706;
            --gold-glow: rgba(217, 119, 6, 0.12);
            --text-primary: #0f172a;
            --text-secondary: #64748b;
        }

        * {
            font-family: 'Inter', 'Noto Sans Khmer', sans-serif;
        }

        body {
            background-color: var(--bg-main);
            color: var(--text-primary);
            overflow: hidden;
        }

        /* Glassmorphic Light Cards */
        .glass-card {
            background: var(--card-bg);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid var(--card-border);
            border-radius: 12px;
            box-shadow: 0 4px 20px -2px rgba(15, 23, 42, 0.05);
            transition: all 0.2s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .glass-card-hover:hover {
            border-color: rgba(217, 119, 6, 0.4);
            transform: translateY(-2px);
            box-shadow: 0 10px 25px -5px rgba(15, 23, 42, 0.08), 0 0 15px var(--gold-glow);
        }

        /* Sidebar Nav Links */
        .sidebar-link {
            transition: all 0.2s ease;
            color: var(--text-secondary);
            border-radius: 8px;
            font-weight: 500;
        }

        .sidebar-link:hover {
            background-color: #f1f5f9;
            color: var(--text-primary);
        }

        .sidebar-active {
            background: linear-gradient(90deg, rgba(217, 119, 6, 0.12) 0%, rgba(217, 119, 6, 0.02) 100%) !important;
            color: var(--gold-accent) !important;
            border-left: 3px solid var(--gold-accent) !important;
            border-radius: 0 8px 8px 0 !important;
        }

        /* Animated Pulsing Light */
        @keyframes goldPulse {
            0%, 100% { opacity: 1; transform: scale(1); box-shadow: 0 0 0 0 rgba(217, 119, 6, 0.4); }
            50% { opacity: 0.6; transform: scale(1.05); box-shadow: 0 0 8px 2px rgba(217, 119, 6, 0.5); }
        }
        .pulse-gold {
            animation: goldPulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }

        /* SVG Graph Animations */
        @keyframes drawPath {
            to { stroke-dashoffset: 0; }
        }
        @keyframes fillUp {
            from { opacity: 0; }
            to { opacity: 0.15; }
        }

        .animate-svg-line {
            stroke-dasharray: 2000;
            stroke-dashoffset: 2000;
            animation: drawPath 2.5s cubic-bezier(0.4, 0, 0.2, 1) forwards;
        }

        .animate-svg-fill {
            animation: fillUp 1.5s ease-in-out 1.2s forwards;
            opacity: 0;
        }

        .fade-in-up {
            animation: fadeInUp 0.4s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(12px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Scrollbars */
        ::-webkit-scrollbar { width: 6px; height: 6px; }
        ::-webkit-scrollbar-track { background: #f8fafc; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 3px; }
        ::-webkit-scrollbar-thumb:hover { background: #94a3b8; }
    </style>
</head>

<body class="antialiased">

<div class="flex h-screen overflow-hidden">

    <!-- SIDEBAR -->
    <aside class="w-72 bg-white flex flex-col justify-between p-4 border-r border-slate-200 shrink-0">
        
        <div>
            <!-- Branding Area -->
            <div class="flex items-center gap-3 mb-6 p-3 rounded-xl bg-slate-50 border border-slate-200">
                <div class="w-9 h-9 rounded-lg bg-amber-500/10 border border-amber-500/30 flex items-center justify-center text-amber-600 shadow-[0_0_12px_rgba(217,119,6,0.15)]">
                    <i class="bi bi-gem text-lg"></i>
                </div>
                <div>
                    <h1 class="text-sm font-bold tracking-wide text-slate-900 uppercase leading-tight">PawnDesk</h1>
                    <p class="text-[10px] text-amber-600 font-bold tracking-wider">COLLATERAL CORE v2.0</p>
                </div>
            </div>

            <!-- Navigation Links -->
            <nav class="space-y-1">
                <ul>
                    <li class="mb-1">
                        <a href="{{ route('user.Home') }}" class="sidebar-link {{ Request::routeIs('user.Home') ? 'sidebar-active' : '' }} flex items-center gap-3 py-2.5 px-3 text-xs tracking-wide">
                            <i class="bi bi-grid-1x2-fill text-sm"></i>
                            <span>ផ្ទាំងគ្រប់គ្រង (Dashboard)</span>
                        </a>
                    </li>

                    <li class="mb-1">
                        <a href="{{ route('customers.index') }}" class="sidebar-link {{ Request::routeIs('customers.index') ? 'sidebar-active' : '' }} flex items-center gap-3 py-2.5 px-3 text-xs tracking-wide">
                            <i class="bi bi-people text-sm"></i>
                            <span>អតិថិជន (Borrowers)</span>
                        </a>
                    </li>

                    <li class="mb-1">
                        <a href="{{ route('loans.index') }}" class="sidebar-link {{ Request::routeIs('loans.index') ? 'sidebar-active' : '' }} flex items-center gap-3 py-2.5 px-3 text-xs tracking-wide">
                            <i class="bi bi-journal-check text-sm"></i>
                            <span>កិច្ចសន្យាបញ្ចាំ (Pawn Loans)</span>
                        </a>
                    </li>

                    <li class="mb-1">
                        <a href="{{ route('collaterals.index') }}" class="sidebar-link flex items-center gap-3 py-2.5 px-3 text-xs tracking-wide">
                            <i class="bi bi-box-seam text-sm"></i>
                            <span>ទ្រព្យបញ្ចាំ / ឃ្លាំង (Collateral Vault)</span>
                        </a>
                    </li>

                    <li class="mb-1">
                        <a href="{{ route('repayments.index') }}" class="sidebar-link flex items-center gap-3 py-2.5 px-3 text-xs tracking-wide">
                            <i class="bi bi-wallet2 text-sm"></i>
                            <span>ការបង់ប្រាក់ / ការលស់ (Repayments)</span>
                        </a>
                    </li>

                    <li class="mb-1">
                        <a href="#" class="sidebar-link flex items-center gap-3 py-2.5 px-3 text-xs tracking-wide">
                            <i class="bi bi-printer text-sm"></i>
                            <span>របាយការណ៍ & បោះពុម្ភ (Reports)</span>
                        </a>
                    </li>

                    <!-- SYSTEM ACTIVITY LOG FEATURE -->
                    <div class="pt-4 pb-1 text-[10px] font-bold text-slate-400 px-3 uppercase tracking-widest">សកម្មភាពប្រព័ន្ធ</div>
                    
                    <li class="mb-1">
                        <a href="#" class="sidebar-link flex items-center gap-3 py-2.5 px-3 text-xs tracking-wide">
                            <i class="bi bi-terminal-dash text-sm"></i>
                            <span>កំណត់ហេតុ (Audit Logs)</span>
                        </a>
                    </li>

                    <!-- System Configuration -->
                    <div class="pt-3 pb-1 text-[10px] font-bold text-slate-400 px-3 uppercase tracking-widest">កំណត់ប្រព័ន្ធ</div>

                    <li class="mb-1">
                        <a href="{{ route('staff.index') }}" class="sidebar-link flex items-center gap-3 py-2.5 px-3 text-xs tracking-wide">
                            <i class="bi bi-person-gear text-sm"></i>
                            <span>អ្នកប្រើប្រាស់ (Users)</span>
                        </a>
                    </li>

                    <li class="mb-1">
                        <a href="{{ route('roles.index') }}" class="sidebar-link flex items-center gap-3 py-2.5 px-3 text-xs tracking-wide">
                            <i class="bi bi-shield-lock text-sm"></i>
                            <span>តួនាទី (Roles & Permissions)</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>

        <!-- Sidebar Footer Action Group -->
        <div class="space-y-3 pt-3 border-t border-slate-200">
            <div class="flex items-center justify-between gap-2">
                <a href="#" class="rounded-lg bg-slate-100 hover:bg-slate-200 border border-slate-200 flex items-center justify-center gap-2 py-1.5 px-3 font-semibold text-[11px] text-slate-700 transition-colors flex-1 text-center">
                    <i class="bi bi-arrow-clockwise"></i>
                    <span>ផ្ទុកឡើងវិញ</span>
                </a>
                <div class="rounded-lg bg-amber-500/10 border border-amber-500/30 text-amber-700 font-bold text-[10px] py-1.5 px-2.5 flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-amber-500 pulse-gold"></span>
                    <span>VAULT ONLINE</span>
                </div>
            </div>

            <!-- Profile Widget -->
            <div class="flex items-center justify-between p-2.5 rounded-xl bg-slate-50 border border-slate-200">
                <div class="flex items-center gap-2.5">
                    <div class="w-8 h-8 rounded-lg bg-gradient-to-tr from-amber-600 to-amber-400 flex items-center justify-center font-bold text-xs text-white shadow-sm">
                        AM
                    </div>
                    <div>
                        <h3 class="font-semibold text-xs text-slate-800 leading-tight">Admin Manager</h3>
                        <p class="text-[10px] text-slate-500">Super Administrator</p>
                    </div>
                </div>
                
                <form method="POST" action="{{ route('user.Home') }}" class="inline">
                    @csrf
                    <button type="submit" title="ចាកចេញ" class="text-slate-400 hover:text-rose-600 p-1.5 rounded-lg hover:bg-rose-50 transition-colors flex items-center justify-center">
                        <i class="bi bi-box-arrow-right text-sm"></i>
                    </button>
                </form>
            </div>
        </div>
    </aside>

    <!-- MAIN BODY WRAPPER -->
    <div class="flex-1 flex flex-col overflow-hidden">

        <!-- HEADER -->
        <header class="h-16 bg-white/80 backdrop-blur-md border-b border-slate-200 px-8 flex items-center justify-between z-10 shrink-0">

            <div>
                <h2 class="text-xs font-bold uppercase tracking-wider text-amber-700 border border-amber-500/30 px-3 py-1.5 rounded-lg bg-amber-500/10">
                    SYSTEM DASHBOARD // @yield('header_title', 'ផ្ទាំងគ្រប់គ្រង')
                </h2>
            </div>

            <div class="flex items-center gap-3">
                <div class="relative hidden md:block">
                    <i class="bi bi-search absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>
                    <input type="text" placeholder="ស្វែងរកទ្រព្យបញ្ចាំ, អតិថិជន..." class="w-64 pl-8 pr-3 py-1.5 rounded-lg bg-slate-50 border border-slate-200 focus:outline-none focus:border-amber-500/60 text-xs text-slate-800 placeholder:text-slate-400 transition-colors">
                </div>

                <div class="relative">
                    <select class="appearance-none bg-slate-50 border border-slate-200 text-xs font-semibold text-slate-700 py-1.5 pl-3 pr-8 rounded-lg focus:outline-none focus:border-amber-500/60 cursor-pointer">
                        <option>USD ($)</option>
                        <option>KHR (៛)</option>
                    </select>
                    <i class="bi bi-chevron-down absolute right-2.5 top-1/2 -translate-y-1/2 text-[10px] text-slate-400 pointer-events-none"></i>
                </div>

                <button class="w-8 h-8 rounded-lg border border-slate-200 bg-slate-50 flex items-center justify-center text-slate-600 hover:text-amber-600 hover:border-amber-500/40 transition-colors">
                    <i class="bi bi-moon text-xs"></i>
                </button>

                <div class="flex border border-slate-200 bg-slate-50 p-0.5 rounded-lg text-[11px] font-bold">
                    <button class="px-2.5 py-1 text-slate-500 hover:text-slate-800 transition-colors">EN</button>
                    <button class="px-2.5 py-1 rounded-md bg-amber-500 text-white shadow-sm">ខ្មែរ</button>
                </div>
            </div>

        </header>

        <!-- MAIN CONTENT AREA -->
        <main class="flex-1 overflow-y-auto p-8 bg-slate-50">
            <div class="max-w-[1600px] mx-auto fade-in-up">
                
                @hasSection('content')
                    @yield('content')
                @else
                    <!-- DEFAULT DASHBOARD OVERVIEW & GRAPHS CONTENT -->
                    <div class="space-y-8">
                        
                        <!-- STATS OVERVIEW CARDS -->
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                            
                            <div class="glass-card p-5 glass-card-hover flex flex-col justify-between">
                                <div>
                                    <div class="flex items-center justify-between mb-2">
                                        <span class="text-xs font-bold uppercase tracking-wider text-slate-500">ផលប័ត្រកម្ចីសរុប // TOTAL LOANS</span>
                                        <div class="w-8 h-8 rounded-lg bg-amber-500/10 border border-amber-500/30 flex items-center justify-center text-amber-600">
                                            <i class="bi bi-currency-dollar text-base"></i>
                                        </div>
                                    </div>
                                    <h3 class="text-3xl font-extrabold text-slate-900 tracking-tight">$1,248,500</h3>
                                </div>
                                <div class="mt-4 pt-3 border-t border-slate-100 flex items-center gap-1.5 text-[11px] font-semibold text-emerald-600">
                                    <i class="bi bi-arrow-up-right"></i>
                                    <span>+12.5% ធៀបនឹងខែមុន</span>
                                </div>
                            </div>

                            <div class="glass-card p-5 glass-card-hover flex flex-col justify-between">
                                <div>
                                    <div class="flex items-center justify-between mb-2">
                                        <span class="text-xs font-bold uppercase tracking-wider text-slate-500">ទ្រព្យបញ្ចាំក្នុងឃ្លាំង // VAULT ITEMS</span>
                                        <div class="w-8 h-8 rounded-lg bg-amber-500/10 border border-amber-500/30 flex items-center justify-center text-amber-600">
                                            <i class="bi bi-safe text-base"></i>
                                        </div>
                                    </div>
                                    <h3 class="text-3xl font-extrabold text-slate-900 tracking-tight">1,842 <span class="text-xs font-medium text-slate-500">គ្រឿង</span></h3>
                                </div>
                                <div class="mt-4 pt-3 border-t border-slate-100 flex items-center gap-1.5 text-[11px] font-semibold text-emerald-600">
                                    <i class="bi bi-arrow-up-right"></i>
                                    <span>+4.2% ទ្រព្យដែលបានបន្ថែម</span>
                                </div>
                            </div>

                            <div class="glass-card p-5 glass-card-hover flex flex-col justify-between">
                                <div>
                                    <div class="flex items-center justify-between mb-2">
                                        <span class="text-xs font-bold uppercase tracking-wider text-slate-500">អត្រាការប្រាក់ទទួលបាន // INTEREST REVENUE</span>
                                        <div class="w-8 h-8 rounded-lg bg-amber-500/10 border border-amber-500/30 flex items-center justify-center text-amber-600">
                                            <i class="bi bi-graph-up-arrow text-base"></i>
                                        </div>
                                    </div>
                                    <h3 class="text-3xl font-extrabold text-amber-600 tracking-tight">$42,180</h3>
                                </div>
                                <div class="mt-4 pt-3 border-t border-slate-100 flex items-center gap-1.5 text-[11px] font-semibold text-slate-500">
                                    <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                                    <span>ប្រមូលការប្រាក់បាន 98.4%</span>
                                </div>
                            </div>

                            <div class="glass-card p-5 glass-card-hover flex flex-col justify-between">
                                <div>
                                    <div class="flex items-center justify-between mb-2">
                                        <span class="text-xs font-bold uppercase tracking-wider text-slate-500">កម្ចីហួសកាលកំណត់ // OVERDUE PAWNS</span>
                                        <div class="w-8 h-8 rounded-lg bg-rose-500/10 border border-rose-500/30 flex items-center justify-center text-rose-600">
                                            <i class="bi bi-exclamation-triangle text-base"></i>
                                        </div>
                                    </div>
                                    <h3 class="text-3xl font-extrabold text-rose-600 tracking-tight">14 <span class="text-xs font-medium text-slate-500">កិច្ចសន្យា</span></h3>
                                </div>
                                <div class="mt-4 pt-3 border-t border-slate-100 flex items-center gap-1.5 text-[11px] font-semibold text-rose-600">
                                    <i class="bi bi-clock-history"></i>
                                    <span>រៀបចំដេញថ្លៃ / លក់ឡៃឡុង</span>
                                </div>
                            </div>
                        </div>

                        <!-- CHARTS SECTION -->
                        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                            
                            <!-- Main Line Graph Block -->
                            <div class="lg:col-span-2 glass-card p-6">
                                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
                                    <div>
                                        <span class="text-[10px] font-bold tracking-widest text-slate-400 uppercase">FINANCIAL LEDGER</span>
                                        <h4 class="text-lg font-bold text-slate-900 uppercase">និន្នាការនៃការបញ្ចេញកម្ចី និងការលស់ទ្រព្យ</h4>
                                    </div>
                                    <div class="flex items-center gap-4 text-xs font-semibold">
                                        <div class="flex items-center gap-2 text-slate-700">
                                            <span class="w-3 h-3 rounded bg-amber-500"></span>
                                            <span>ប្រាក់បញ្ចេញបញ្ចាំ</span>
                                        </div>
                                        <div class="flex items-center gap-2 text-slate-700">
                                            <span class="w-3 h-3 rounded bg-sky-500"></span>
                                            <span>ប្រាក់លស់ត្រឡប់</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Custom SVG Line Graph Matrix -->
                                <div class="relative w-full aspect-[21/9] min-h-[250px] rounded-lg border border-slate-200 bg-slate-50/50 p-2">
                                    <svg viewBox="0 0 1000 400" class="w-full h-full overflow-visible" preserveAspectRatio="none">
                                        <line x1="0" y1="100" x2="1000" y2="100" stroke="#e2e8f0" stroke-width="1" stroke-dasharray="4"/>
                                        <line x1="0" y1="200" x2="1000" y2="200" stroke="#e2e8f0" stroke-width="1" stroke-dasharray="4"/>
                                        <line x1="0" y1="300" x2="1000" y2="300" stroke="#e2e8f0" stroke-width="1" stroke-dasharray="4"/>
                                        <line x1="0" y1="400" x2="1000" y2="400" stroke="#cbd5e1" stroke-width="2"/>

                                        <!-- Disbursement (Filled vector area - Amber Gold) -->
                                        <path d="M 0 350 L 150 280 L 300 310 L 450 180 L 600 220 L 750 110 L 900 140 L 1000 70 L 1000 400 L 0 400 Z" fill="#d97706" class="animate-svg-fill"/>
                                        <path d="M 0 350 L 150 280 L 300 310 L 450 180 L 600 220 L 750 110 L 900 140 L 1000 70" fill="none" stroke="#d97706" stroke-width="3" class="animate-svg-line"/>
                                        
                                        <!-- Collections line - Sky Blue -->
                                        <path d="M 0 380 L 150 340 L 300 290 L 450 260 L 600 210 L 750 190 L 900 130 L 1000 95" fill="none" stroke="#0284c7" stroke-width="2.5" class="animate-svg-line"/>

                                        <circle cx="750" cy="110" r="5" fill="#d97706" stroke="#ffffff" stroke-width="2"/>
                                        <circle cx="750" cy="190" r="5" fill="#0284c7" stroke="#ffffff" stroke-width="2"/>
                                    </svg>
                                </div>

                                <div class="flex justify-between items-center mt-3 px-1 text-[10px] font-bold text-slate-500 uppercase tracking-wider">
                                    <span>មករា</span><span>កុម្ភៈ</span><span>មីនា</span><span>មេសា</span><span>ឧសភា</span><span>មិថុនា</span><span>កក្កដា</span>
                                </div>
                            </div>

                            <!-- Doughnut Composition Block -->
                            <div class="glass-card p-6 flex flex-col justify-between">
                                <div>
                                    <span class="text-[10px] font-bold tracking-widest text-slate-400 uppercase">COLLATERAL MATRIX</span>
                                    <h4 class="text-lg font-bold text-slate-900 uppercase mb-6">ប្រភេទទ្រព្យបញ្ចាំ (Categories)</h4>
                                </div>

                                <div class="relative flex items-center justify-center my-4">
                                    <svg width="180" height="180" viewBox="0 0 42 42" class="transform -rotate-90">
                                        <circle cx="21" cy="21" r="15.915" fill="transparent" stroke="#e2e8f0" stroke-width="5"></circle>
                                        
                                        <!-- Animated segments -->
                                        <circle cx="21" cy="21" r="15.915" fill="transparent" stroke="#d97706" stroke-width="5" stroke-dasharray="45 100" stroke-dashoffset="0" class="animate-svg-donut"></circle>
                                        <circle cx="21" cy="21" r="15.915" fill="transparent" stroke="#0284c7" stroke-width="5" stroke-dasharray="30 100" stroke-dashoffset="-45" class="animate-svg-donut" style="animation-delay: 0.2s;"></circle>
                                        <circle cx="21" cy="21" r="15.915" fill="transparent" stroke="#9333ea" stroke-width="5" stroke-dasharray="25 100" stroke-dashoffset="-75" class="animate-svg-donut" style="animation-delay: 0.4s;"></circle>
                                    </svg>
                                    <div class="absolute flex flex-col items-center justify-center">
                                        <span class="text-2xl font-black text-slate-900">100%</span>
                                        <span class="text-[9px] font-bold text-slate-500 uppercase">សរុបក្នុងឃ្លាំង</span>
                                    </div>
                                </div>

                                <div class="space-y-2 mt-4 text-xs font-semibold">
                                    <div class="flex items-center justify-between p-2.5 rounded-lg bg-slate-50 border border-slate-200">
                                        <div class="flex items-center gap-2.5">
                                            <span class="w-2.5 h-2.5 rounded-full bg-amber-600"></span>
                                            <span class="text-slate-700">គ្រឿងអលង្ការ / មាស (Jewelry & Gold)</span>
                                        </div>
                                        <span class="text-slate-900 font-bold">45%</span>
                                    </div>
                                    <div class="flex items-center justify-between p-2.5 rounded-lg bg-slate-50 border border-slate-200">
                                        <div class="flex items-center gap-2.5">
                                            <span class="w-2.5 h-2.5 rounded-full bg-sky-600"></span>
                                            <span class="text-slate-700">គ្រឿងអេឡិចត្រូនិក / Laptop</span>
                                        </div>
                                        <span class="text-slate-900 font-bold">30%</span>
                                    </div>
                                    <div class="flex items-center justify-between p-2.5 rounded-lg bg-slate-50 border border-slate-200">
                                        <div class="flex items-center gap-2.5">
                                            <span class="w-2.5 h-2.5 rounded-full bg-purple-600"></span>
                                            <span class="text-slate-700">យានយន្ត / កាតគ្រី (Vehicles)</span>
                                        </div>
                                        <span class="text-slate-900 font-bold">25%</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

            </div>
        </main>

    </div>
</div>

</body>
</html>
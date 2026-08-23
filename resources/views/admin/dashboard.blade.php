<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Neo-Modern Banking Dashboard</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Staggered Entry Animations */
        .animate-fade-in-up {
            animation: fadeInUp 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards;
            opacity: 0;
            transform: translateY(20px);
        }
        .delay-100 { animation-delay: 0.1s; }
        .delay-200 { animation-delay: 0.2s; }
        .delay-300 { animation-delay: 0.3s; }

        @keyframes fadeInUp {
            to { opacity: 1; transform: translateY(0); }
        }

        /* Glassmorphism & Bento Panel Styling */
        .glass-panel {
            background: rgba(15, 23, 42, 0.6);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.05);
        }

        .neon-accent {
            box-shadow: inset 0 0 30px rgba(6, 182, 212, 0.03), 0 0 20px rgba(6, 182, 212, 0.05);
        }
        
        .hide-scrollbar::-webkit-scrollbar {
            display: none;
        }
    </style>
</head>
<body class="bg-slate-950 min-h-screen text-slate-200 font-sans antialiased overflow-x-hidden p-4 md:p-8">
    
    <!-- Ambient Tech Background Orbs -->
    <div class="fixed top-[-10%] left-[-10%] w-[50vw] h-[50vw] bg-cyan-900 rounded-full mix-blend-screen filter blur-[150px] opacity-20 animate-pulse pointer-events-none"></div>
    <div class="fixed bottom-[-10%] right-[-10%] w-[40vw] h-[40vw] bg-blue-900 rounded-full mix-blend-screen filter blur-[150px] opacity-20 animate-pulse pointer-events-none" style="animation-delay: 1.5s;"></div>

    <div class="max-w-6xl mx-auto relative z-10">
        
        <!-- Header -->
        <header class="mb-8 flex justify-between items-end animate-fade-in-up">
            <div>
                <p class="text-cyan-500 text-xs font-bold tracking-widest uppercase mb-1">Secure Session Active</p>
                <h1 class="text-3xl md:text-4xl font-extrabold tracking-tight text-white">
                    Welcome Back, <span class="text-transparent bg-clip-text bg-gradient-to-r from-cyan-400 to-blue-500">{{ $user->name ?? 'Developer' }}</span>
                </h1>
            </div>
            <div class="hidden md:block">
                <img src="{{ $user->avatar ?? 'https://ui-avatars.com/api/?name=' . urlencode($user->name ?? 'User') . '&background=0f172a&color=06b6d4' }}" 
                     alt="Profile" 
                     class="w-12 h-12 rounded-full border-2 border-slate-700">
            </div>
        </header>

        <!-- Bento Grid Layout -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            
            <!-- Main Balance Card (Spans 2 Columns) -->
            <div class="md:col-span-2 glass-panel rounded-3xl p-8 neon-accent animate-fade-in-up delay-100 flex flex-col justify-between relative overflow-hidden group">
                <!-- Decorative background elements -->
                <div class="absolute -right-10 -top-10 w-40 h-40 bg-cyan-500/10 rounded-full blur-2xl group-hover:bg-cyan-500/20 transition-all duration-700"></div>
                
                <div>
                    <h2 class="text-slate-400 text-xs font-bold uppercase tracking-widest mb-2">Total Balance</h2>
                    <div class="text-5xl md:text-6xl font-bold text-white tracking-tighter flex items-baseline gap-1">
                        <span class="text-3xl text-slate-500 font-normal">$</span>{{ number_format($user->balance ?? 24590.50, 2) }}
                    </div>
                </div>
                
                <div class="mt-10 flex gap-4">
                    <button class="bg-gradient-to-r from-cyan-500 to-blue-600 hover:from-cyan-400 hover:to-blue-500 text-white font-bold py-3 px-8 rounded-xl transition-all duration-300 shadow-[0_0_15px_rgba(6,182,212,0.3)] hover:shadow-[0_0_25px_rgba(6,182,212,0.5)] transform hover:-translate-y-0.5">
                        Transfer
                    </button>
                    <button class="bg-slate-800/80 hover:bg-slate-700/80 border border-slate-700 text-white font-semibold py-3 px-8 rounded-xl transition-all duration-300 backdrop-blur-md">
                        Deposit
                    </button>
                </div>
            </div>

            <!-- Quick Action: Active Card -->
            <div class="glass-panel rounded-3xl p-6 animate-fade-in-up delay-200 flex flex-col">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-slate-400 text-xs font-bold uppercase tracking-widest">Active Card</h2>
                    <button class="text-cyan-400 hover:text-cyan-300">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                    </button>
                </div>
                
                <!-- Virtual Card UI -->
                <div class="w-full h-48 bg-gradient-to-br from-slate-800 to-slate-900 rounded-2xl border border-slate-700 p-5 flex flex-col justify-between relative overflow-hidden group hover:border-cyan-500/50 transition-colors cursor-pointer shadow-lg shadow-black/50">
                    <div class="flex justify-between items-start z-10">
                        <!-- Chip Icon -->
                        <svg class="w-8 h-8 text-yellow-500/70" fill="none" stroke="currentColor" viewBox="0 0 24 24"><rect width="16" height="12" x="4" y="6" rx="2" stroke-width="1.5"></rect><path stroke-width="1.5" d="M4 12h16M12 6v12"></path></svg>
                        <span class="text-xs font-bold text-slate-300 tracking-widest">VISA</span>
                    </div>
                    <div class="z-10 mt-auto">
                        <div class="text-lg font-mono tracking-widest text-slate-200 mb-2 drop-shadow-md">•••• •••• •••• 4289</div>
                        <div class="flex justify-between text-xs text-slate-400 font-medium">
                            <span>{{ $user->name ?? 'CARDHOLDER' }}</span>
                            <span>12/28</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Transactions (Spans 3 Columns) -->
            <div class="md:col-span-3 glass-panel rounded-3xl p-6 md:p-8 animate-fade-in-up delay-300">
                <div class="flex justify-between items-center mb-6 border-b border-slate-800/50 pb-4">
                    <h2 class="text-slate-400 text-xs font-bold uppercase tracking-widest">Recent Activity</h2>
                    <a href="{{ route('home')}}" class="text-cyan-400 text-sm hover:text-cyan-300 transition-colors font-medium">View Ledger</a>
                </div>
                
                <div class="space-y-3">
                    
                    <!-- Expense Item -->
                    <div class="flex items-center justify-between p-4 rounded-2xl bg-slate-800/20 hover:bg-slate-800/60 transition-colors border border-transparent hover:border-slate-700/50 group">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-full bg-slate-800 border border-slate-700 text-slate-300 flex items-center justify-center group-hover:text-cyan-400 transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                            </div>
                            <div>
                                <div class="font-semibold text-slate-200">Tech Hardware Hub</div>
                                <div class="text-xs text-slate-500 mt-0.5">Today, 14:30 • Point of Sale</div>
                            </div>
                        </div>
                        <div class="font-bold text-slate-200">
                            -$1,299.00
                        </div>
                    </div>
                    
                    <!-- Income Item -->
                    <div class="flex items-center justify-between p-4 rounded-2xl bg-slate-800/20 hover:bg-slate-800/60 transition-colors border border-transparent hover:border-slate-700/50 group">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-full bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 flex items-center justify-center">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path></svg>
                            </div>
                            <div>
                                <div class="font-semibold text-slate-200">Direct Deposit</div>
                                <div class="text-xs text-slate-500 mt-0.5">Yesterday, 09:00 • ACH Transfer</div>
                            </div>
                        </div>
                        <div class="font-bold text-emerald-400">
                            +$4,500.00
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</body>
</html>
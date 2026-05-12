<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <title>Chhenla Bank | Portal</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>

    <style>
        body { 
            font-family: 'Plus Jakarta Sans', sans-serif; 
            background-color: #030303; 
            background-image: 
                radial-gradient(at 0% 0%, rgba(254, 125, 45, 0.08) 0px, transparent 40%),
                radial-gradient(at 100% 0%, rgba(254, 125, 45, 0.05) 0px, transparent 40%);
        }
        
        .bento-card {
            background: rgba(255, 255, 255, 0.03);
            backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.08);
            transition: all 0.4s cubic-bezier(0.23, 1, 0.32, 1);
        }
        
        .bento-card:hover {
            border-color: rgba(254, 125, 45, 0.4);
            background: rgba(255, 255, 255, 0.05);
            transform: translateY(-5px);
            box-shadow: 0 20px 40px -20px rgba(0,0,0,0.7);
        }

        .btn-primary {
            background: linear-gradient(135deg, #FE7D2D 0%, #FF5F00 100%);
            box-shadow: 0 10px 20px -5px rgba(254, 125, 45, 0.3);
        }

        .text-gradient {
            background: linear-gradient(to right, #fff, #94a3b8);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
    </style>
</head>

<body class="text-slate-400 antialiased">

<nav class="fixed top-0 w-full z-50 p-6">
    <div class="max-w-7xl mx-auto flex justify-between items-center bg-[#030303]/60 backdrop-blur-xl border border-white/10 rounded-2xl px-8 py-4">
        <div class="flex items-center gap-3">
            <div class="w-8 h-8 bg-[#FE7D2D] rounded-lg flex items-center justify-center">
                <div class="w-4 h-4 bg-black rounded-sm rotate-45"></div>
            </div>
            <span class="text-lg font-extrabold tracking-tighter text-white">CHHENLA<span class="text-[#FE7D2D]">.</span></span>
        </div>
        <div class="hidden md:flex gap-10 text-[11px] uppercase tracking-[0.2em] font-bold">
            <a href="#account" class="text-white hover:text-[#FE7D2D] transition-colors">Portal</a>
            <a href="#transactions" class="text-slate-500 hover:text-[#FE7D2D] transition-colors">Ledger</a>
            <a href="#support" class="text-slate-500 hover:text-[#FE7D2D] transition-colors">Identity</a>
        </div>
        <button class="text-sm font-bold text-white hover:text-[#FE7D2D] transition-all">
            Logout
        </button>
    </div>
</nav>

<main class="max-w-7xl mx-auto px-6 pt-40 pb-20">
    
    <header class="mb-12 flex flex-col md:flex-row md:items-end justify-between gap-4">
        <div>
            <p class="text-[#FE7D2D] font-bold text-[11px] uppercase tracking-[0.3em] mb-3">Institutional Access</p>
            <h1 class="text-5xl font-extrabold text-white tracking-tighter">
                Welcome back, <span class="text-gradient">Bun Leap</span>
            </h1>
        </div>
        <div class="bg-white/5 border border-white/10 rounded-full px-5 py-2 flex items-center gap-3">
            <span class="relative flex h-2 w-2">
                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-500 opacity-75"></span>
                <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span>
            </span>
            <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Secure Connection</span>
        </div>
    </header>

    <div id="account" class="grid grid-cols-1 md:grid-cols-12 gap-6 mb-16">
        
        <div class="md:col-span-8 bento-card rounded-[2.5rem] p-12 relative overflow-hidden group">
            <div class="relative z-10 flex flex-col h-full">
                <div class="flex justify-between items-start mb-16">
                    <div>
                        <span class="text-slate-500 text-[11px] font-bold uppercase tracking-[0.2em]">Available Capital</span>
                        <h2 class="text-7xl font-extrabold text-white mt-4 tracking-tighter">
                            $12,450<span class="text-slate-600 font-medium text-4xl">.00</span>
                        </h2>
                    </div>
                    <div class="w-16 h-16 bg-[#FE7D2D]/10 rounded-2xl flex items-center justify-center border border-[#FE7D2D]/20">
                        <i data-lucide="component" class="text-[#FE7D2D] w-8 h-8"></i>
                    </div>
                </div>
                
                <div class="mt-auto flex flex-wrap gap-4">
                    <button class="btn-primary px-10 py-4 text-white font-extrabold rounded-2xl transition-all hover:scale-105 active:scale-95">
                        Move Funds
                    </button>
                    <button class="px-10 py-4 bg-white/5 border border-white/10 text-white font-bold rounded-2xl hover:bg-white/10 transition-all">
                        Statement
                    </button>
                </div>
            </div>
            <div class="absolute -bottom-20 -right-20 w-96 h-96 bg-[#FE7D2D]/5 rounded-full blur-[120px]"></div>
        </div>

        <div class="md:col-span-4 bento-card rounded-[2.5rem] p-10 flex flex-col">
            <h3 class="text-white text-lg font-bold mb-8 flex items-center gap-2">
                Active Nodes <span class="text-[10px] bg-white/5 px-2 py-1 rounded text-slate-500">02</span>
            </h3>
            <div class="space-y-4">
                <div class="p-5 bg-white/[0.02] border border-white/5 rounded-[1.5rem] flex items-center justify-between group hover:border-[#FE7D2D]/30 transition-all cursor-pointer">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-white/5 rounded-xl flex items-center justify-center text-white group-hover:text-[#FE7D2D] transition-colors">
                            <i data-lucide="credit-card" class="w-6 h-6"></i>
                        </div>
                        <div>
                            <p class="text-[10px] text-slate-500 uppercase font-bold tracking-widest">Corporate</p>
                            <p class="text-sm font-bold text-white tracking-tight">VISA •••• 890</p>
                        </div>
                    </div>
                    <i data-lucide="chevron-right" class="w-4 h-4 text-slate-700 group-hover:text-[#FE7D2D]"></i>
                </div>
                <div class="p-5 bg-white/[0.02] border border-white/5 rounded-[1.5rem] flex items-center justify-between group hover:border-[#FE7D2D]/30 transition-all cursor-pointer">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-white/5 rounded-xl flex items-center justify-center text-white group-hover:text-[#FE7D2D] transition-colors">
                            <i data-lucide="shield-check" class="w-6 h-6"></i>
                        </div>
                        <div>
                            <p class="text-[10px] text-slate-500 uppercase font-bold tracking-widest">Encrypted</p>
                            <p class="text-sm font-bold text-white tracking-tight">Vault 02</p>
                        </div>
                    </div>
                    <i data-lucide="chevron-right" class="w-4 h-4 text-slate-700 group-hover:text-[#FE7D2D]"></i>
                </div>
            </div>
        </div>
    </div>

    <section id="transactions" class="mb-20">
        <div class="flex justify-between items-center mb-8">
            <h2 class="text-2xl font-bold text-white tracking-tight">Recent Activity</h2>
            <button class="text-[11px] font-bold uppercase tracking-widest text-[#FE7D2D] hover:opacity-80 flex items-center gap-2 transition-all">
                Export Ledger <i data-lucide="external-link" class="w-3 h-3"></i>
            </button>
        </div>
        <div class="bento-card rounded-[2rem] overflow-hidden">
            <table class="w-full text-left">
                <thead>
                    <tr class="text-[10px] uppercase tracking-[0.2em] text-slate-500 border-b border-white/5">
                        <th class="px-10 py-6 font-bold">Transaction Entity</th>
                        <th class="px-10 py-6 font-bold text-center">Protocol</th>
                        <th class="px-10 py-6 font-bold text-right">Volume</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5">
                    <tr class="group hover:bg-white/[0.02] transition-colors">
                        <td class="px-10 py-8">
                            <div class="flex items-center gap-5">
                                <div class="w-12 h-12 rounded-full bg-[#FE7D2D]/10 flex items-center justify-center text-[#FE7D2D] border border-[#FE7D2D]/20">
                                    <i data-lucide="arrow-up-right" class="w-5 h-5"></i>
                                </div>
                                <div>
                                    <p class="font-bold text-white tracking-tight">Revenue Distribution</p>
                                    <p class="text-xs text-slate-600 mt-1">Today, 09:41 AM</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-10 py-8 text-center">
                            <span class="px-4 py-1.5 bg-emerald-500/10 text-emerald-500 rounded-full text-[10px] font-bold uppercase tracking-widest border border-emerald-500/20">Settled</span>
                        </td>
                        <td class="px-10 py-8 text-right font-extrabold text-white text-lg">+$1,200.00</td>
                    </tr>
                    <tr class="group hover:bg-white/[0.02] transition-colors">
                        <td class="px-10 py-8">
                            <div class="flex items-center gap-5">
                                <div class="w-12 h-12 rounded-full bg-white/5 flex items-center justify-center text-slate-400 border border-white/10">
                                    <i data-lucide="shopping-cart" class="w-5 h-5"></i>
                                </div>
                                <div>
                                    <p class="font-bold text-white tracking-tight">Apple Infrastructure</p>
                                    <p class="text-xs text-slate-600 mt-1">Yesterday, 14:20 PM</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-10 py-8 text-center">
                            <span class="px-4 py-1.5 bg-white/5 text-slate-400 rounded-full text-[10px] font-bold uppercase tracking-widest border border-white/10">Pending</span>
                        </td>
                        <td class="px-10 py-8 text-right font-extrabold text-white text-lg">-$199.00</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>

    <section id="support" class="grid lg:grid-cols-3 gap-8">
        <div class="lg:col-span-1">
            <h2 class="text-3xl font-extrabold text-white mb-6">Support<br>Concierge</h2>
            <p class="text-slate-500 mb-10 leading-relaxed font-light text-lg">Direct access to institutional advisors and technical support.</p>
            <div class="space-y-4">
                <div class="flex items-center gap-5 p-6 bento-card rounded-[1.5rem] group cursor-pointer">
                    <div class="w-12 h-12 bg-[#FE7D2D]/10 rounded-xl flex items-center justify-center text-[#FE7D2D]">
                        <i data-lucide="phone-call" class="w-5 h-5"></i>
                    </div>
                    <div>
                        <p class="text-[10px] font-bold text-slate-500 uppercase tracking-widest">Priority Line</p>
                        <p class="font-bold text-white group-hover:text-[#FE7D2D] transition-colors">+855 23 999 888</p>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="lg:col-span-2 bento-card rounded-[2.5rem] p-12">
            <form class="space-y-8">
                <div class="grid md:grid-cols-2 gap-8">
                    <div class="space-y-3">
                        <label class="text-[10px] font-bold text-slate-500 uppercase tracking-widest ml-1">Identity Reference</label>
                        <input type="text" value="Bun Leap" readonly class="w-full bg-white/5 border border-white/10 rounded-2xl p-4 text-white/50 outline-none cursor-not-allowed">
                    </div>
                    <div class="space-y-3">
                        <label class="text-[10px] font-bold text-slate-500 uppercase tracking-widest ml-1">Subject</label>
                        <select class="w-128 w-full bg-white/5 border border-white/10 rounded-2xl p-4 text-white focus:border-[#FE7D2D] outline-none transition-all appearance-none">
                            <option>Treasury Inquiry</option>
                            <option>Asset Migration</option>
                            <option>Security Audit</option>
                        </select>
                    </div>
                </div>
                <div class="space-y-3">
                    <label class="text-[10px] font-bold text-slate-500 uppercase tracking-widest ml-1">Secure Message</label>
                    <textarea rows="4" placeholder="Detail your request..." class="w-full bg-white/5 border border-white/10 rounded-2xl p-5 text-white focus:border-[#FE7D2D] outline-none transition-all"></textarea>
                </div>
                <button class="btn-primary w-full py-5 text-white font-extrabold rounded-2xl transition-all hover:scale-[1.02] active:scale-100">
                    Dispatch Request
                </button>
            </form>
        </div>
    </section>
</main>

<footer class="py-20 border-t border-white/5 bg-black text-center">
    <div class="text-xl font-bold tracking-tighter text-white mb-10">CHHENLA<span class="text-[#FE7D2D]">.</span></div>
    <p class="text-[10px] font-bold text-slate-600 uppercase tracking-[0.4em]">
        © 2026 Chhenla Financial Protocol. Authored for bun leap.
    </p>
</footer>

<script>
    lucide.createIcons();
</script>
</body>
</html>
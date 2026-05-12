<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Chhenla | The Future of Banking</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; scroll-behavior: smooth; }
        .bento-card { transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); overflow: hidden; position: relative; }
        .bento-card:hover { transform: translateY(-5px); border-color: rgba(254, 125, 45, 0.3); }
        .feature-gradient { background: linear-gradient(180deg, rgba(254, 125, 45, 0.1) 0%, transparent 100%); }
    </style>
</head>

<body class="bg-[#0B0F13] text-white selection:bg-[#FE7D2D]/30">

<nav class="fixed top-0 w-full z-50 border-b border-white/5 bg-[#0B0F13]/80 backdrop-blur-md">
    <div class="max-w-7xl mx-auto px-6 h-20 flex items-center justify-between">
        <div class="text-2xl font-extrabold tracking-tighter">CHHENLA<span class="text-[#FE7D2D]">.</span></div>
        <div class="hidden md:flex gap-8 text-sm font-medium text-slate-400">
            <a href="#features" class="hover:text-white transition">Features</a>
            <a href="#invest" class="hover:text-white transition">Invest</a>
            <a href="https://t.me/Hengbunleap1" class="hover:text-white transition">Support</a>
        </div>
        <div class="flex items-center gap-4">
            <a href="{{ route('login') }}" class="text-sm font-semibold hover:text-[#FE7D2D] transition">Sign In</a>
            <a href="{{ route('register') }}" class="px-5 py-2.5 bg-[#FE7D2D] text-white text-sm font-bold rounded-full hover:scale-105 transition active:scale-95">
                Open Account
            </a>
        </div>
    </div>
</nav>

<section class="relative pt-32 pb-20 overflow-hidden">
    <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full h-[600px] bg-[#FE7D2D]/5 blur-[120px] rounded-full"></div>
    <div class="relative max-w-7xl mx-auto px-6 text-center">
        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/5 border border-white/10 text-xs font-medium mb-8">
            <span class="w-2 h-2 rounded-full bg-[#FE7D2D] animate-pulse"></span>
            Now supporting Banking & Crypto Assets
        </div>
        <h1 class="text-5xl md:text-8xl font-extrabold tracking-tighter mb-8 leading-[1.1]">
            Chhenla is Banking for the <br>
            <span class="bg-gradient-to-r from-[#FE7D2D] to-[#ffab76] bg-clip-text text-transparent">Next Generation.</span>
        </h1>
        <p class="text-slate-400 text-lg md:text-xl max-w-2xl mx-auto mb-10 leading-relaxed">
            Experience a modern financial ecosystem built for speed, security, and complete transparency.
        </p>
       <div class="flex flex-col sm:flex-row gap-4 justify-center items-center mb-16">
            <a href="{{ route('register') }}" class="w-full sm:w-auto px-8 py-4 bg-white text-black font-bold rounded-2xl hover:bg-slate-100 transition shadow-xl shadow-white/5 text-center">
                Get Started Now
            </a>

            <a href="{{ route('exchange') }}" class="w-full sm:w-auto px-8 py-4 bg-white/5 border border-white/10 font-bold rounded-2xl hover:bg-white/10 transition text-center">
                Account
            </a>
        </div>
        <div class="relative max-w-5xl mx-auto rounded-[2rem] border border-white/10 overflow-hidden shadow-2xl shadow-[#FE7D2D]/10">
            <img src="https://images.unsplash.com/photo-1563986768609-322da13575f3?auto=format&fit=crop&q=80&w=1200" alt="Dashboard Preview" class="w-full h-auto">
        </div>
    </div>
</section>

<section class="border-y border-white/5 bg-white/[0.02] py-10">
    <div class="max-w-7xl mx-auto px-6 grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
        <div>
            <div class="text-3xl font-bold text-white">$2.4M+</div>
            <div class="text-sm text-slate-500 uppercase tracking-widest mt-1">Processed</div>
        </div>
        <div>
            <div class="text-3xl font-bold text-[#FE7D2D]">40+</div>
            <div class="text-sm text-slate-500 uppercase tracking-widest mt-1">Currencies</div>
        </div>
        <div>
            <div class="text-3xl font-bold text-white">0.01%</div>
            <div class="text-sm text-slate-500 uppercase tracking-widest mt-1">FX Fees</div>
        </div>
        <div>
            <div class="text-3xl font-bold text-white">24/7</div>
            <div class="text-sm text-slate-500 uppercase tracking-widest mt-1">Live Support</div>
        </div>
    </div>
</section>

<section id="features" class="max-w-7xl mx-auto px-6 py-24">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="md:col-span-2 bento-card bg-white/5 border border-white/10 rounded-[2.5rem] p-10 flex flex-col justify-between h-[450px]">
            <div class="absolute top-0 right-0 w-1/2 h-full opacity-40">
                <img src="https://images.unsplash.com/photo-1550751827-4bd374c3f58b?auto=format&fit=crop&q=80&w=800" alt="Tech" class="h-full w-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-l from-transparent to-[#0B0F13]"></div>
            </div>
            <div class="relative z-10">
                <i data-lucide="shield-check" class="text-[#FE7D2D] mb-6" size="40"></i>
                <h3 class="text-3xl font-bold mb-4">Biometric Vaults</h3>
                <p class="text-slate-400 max-w-md">Multi-layer encryption with FaceID and Fingerprint hardware-level security.</p>
            </div>
            <div class="relative z-10 flex -space-x-3 overflow-hidden">
                <img class="h-10 w-10 rounded-full border-2 border-[#0B0F13] object-cover" src="https://images.unsplash.com/photo-1535713875002-d1d0cf377fde?auto=format&fit=crop&q=80&w=100" alt="u">
                <img class="h-10 w-10 rounded-full border-2 border-[#0B0F13] object-cover" src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?auto=format&fit=crop&q=80&w=100" alt="u">
                <div class="flex items-center justify-center h-10 px-4 rounded-full border-2 border-[#0B0F13] bg-[#FE7D2D] text-xs font-bold uppercase">Trusted globally</div>
            </div>
        </div>

        <div id="invest" class="bento-card bg-gradient-to-br from-[#1a1a1a] to-[#0B0F13] border border-white/10 rounded-[2.5rem] p-10 flex flex-col justify-between">
            <div>
                <i data-lucide="bitcoin" class="text-yellow-500 mb-6" size="40"></i>
                <h3 class="text-xl font-bold mb-2">Crypto Investing</h3>
                <p class="text-sm text-slate-400">Buy BTC, ETH, and 50+ assets directly from your balance.</p>
            </div>
            <div class="mt-4 p-4 bg-white/5 rounded-2xl">
                <div class="flex justify-between text-xs mb-1"><p>BTC/USD</p><p class="text-green-400">+4.2%</p></div>
                <div class="h-1 w-full bg-white/10 rounded-full overflow-hidden">
                    <div class="h-full bg-green-400 w-3/4"></div>
                </div>
            </div>
        </div>

        <div class="bento-card bg-white/5 border border-white/10 rounded-[2.5rem] p-10 flex flex-col justify-between">
            <img src="https://images.unsplash.com/photo-1620712943543-bcc4628c9757?auto=format&fit=crop&q=80&w=400" alt="Transfer" class="absolute inset-0 w-full h-full object-cover opacity-20">
            <i data-lucide="zap" class="text-[#FE7D2D] mb-6 relative z-10" size="40"></i>
            <div class="relative z-10">
                <h3 class="text-xl font-bold mb-2">Instant Transfers</h3>
                <p class="text-sm text-slate-400">Send money anywhere in under 2 seconds.</p>
            </div>
        </div>

        <div class="md:col-span-2 bento-card bg-white/5 border border-white/10 rounded-[2.5rem] p-10 flex items-center justify-between overflow-hidden">
            <div class="absolute inset-0 opacity-10">
                <img src="https://images.unsplash.com/photo-1460925895917-afdab827c52f?auto=format&fit=crop&q=80&w=800" alt="Charts" class="w-full h-full object-cover">
            </div>
            <div class="z-10">
                <h3 class="text-3xl font-bold mb-4">AI Smart Loans</h3>
                <p class="text-slate-400 max-w-xs">Get approved in minutes based on your cash flow, not just your credit score.</p>
            </div>
            <div class="opacity-20 scale-150 rotate-12">
                <i data-lucide="bot" size="120"></i>
            </div>
        </div>
    </div>
</section>

<section class="max-w-7xl mx-auto px-6 py-20 bg-white/[0.02] rounded-[3rem] border border-white/5">
    <div class="grid md:grid-cols-2 gap-16 items-center">
        <div>
            <h2 class="text-4xl md:text-5xl font-extrabold mb-6">Your money, <br><span class="text-[#FE7D2D]">your lifestyle.</span></h2>
            <div class="space-y-6">
                <div class="flex gap-4">
                    <div class="w-12 h-12 rounded-xl bg-[#FE7D2D]/20 flex items-center justify-center shrink-0">
                        <i data-lucide="credit-card" class="text-[#FE7D2D]"></i>
                    </div>
                    <div>
                        <h4 class="font-bold">Virtual Cards</h4>
                        <p class="text-slate-400 text-sm">Create disposable cards for safe online shopping.</p>
                    </div>
                </div>
                <div class="flex gap-4">
                    <div class="w-12 h-12 rounded-xl bg-[#FE7D2D]/20 flex items-center justify-center shrink-0">
                        <i data-lucide="pie-chart" class="text-[#FE7D2D]"></i>
                    </div>
                    <div>
                        <h4 class="font-bold">Budget Analytics</h4>
                        <p class="text-slate-400 text-sm">See exactly where your money goes with AI categorization.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="grid grid-cols-2 gap-4">
            <img src="https://images.unsplash.com/photo-1556742044-3c52d6e88c62?auto=format&fit=crop&q=80&w=400" class="rounded-3xl h-64 w-full object-cover" alt="Lifestyle">
            <img src="https://images.unsplash.com/photo-1559526324-4b87b5e36e44?auto=format&fit=crop&q=80&w=400" class="rounded-3xl h-64 w-full object-cover mt-8" alt="Banking">
        </div>
    </div>
</section>

<section class="max-w-7xl mx-auto px-6 py-24">
    <div class="text-center mb-16">
        <h2 class="text-3xl font-bold">Loved by users worldwide</h2>
    </div>
    <div class="grid md:grid-cols-3 gap-8">
        <div class="p-8 rounded-3xl bg-white/5 border border-white/10">
            <div class="flex gap-1 text-[#FE7D2D] mb-4"><i data-lucide="star" size="16"></i><i data-lucide="star" size="16"></i><i data-lucide="star" size="16"></i><i data-lucide="star" size="16"></i><i data-lucide="star" size="16"></i></div>
            <p class="text-slate-300 italic mb-6">"The fastest onboarding I've ever experienced. Had my virtual card in 3 minutes."</p>
            <div class="font-bold">Sarah Jenkins</div>
        </div>
        <div class="p-8 rounded-3xl bg-white/5 border border-white/10">
            <div class="flex gap-1 text-[#FE7D2D] mb-4"><i data-lucide="star" size="16"></i><i data-lucide="star" size="16"></i><i data-lucide="star" size="16"></i><i data-lucide="star" size="16"></i><i data-lucide="star" size="16"></i></div>
            <p class="text-slate-300 italic mb-6">"Finally a bank that understands crypto and traditional finance in one app."</p>
            <div class="font-bold">Michael Chen</div>
        </div>
        <div class="p-8 rounded-3xl bg-white/5 border border-white/10">
            <div class="flex gap-1 text-[#FE7D2D] mb-4"><i data-lucide="star" size="16"></i><i data-lucide="star" size="16"></i><i data-lucide="star" size="16"></i><i data-lucide="star" size="16"></i><i data-lucide="star" size="16"></i></div>
            <p class="text-slate-300 italic mb-6">"Customer support via Telegram is a game changer. No more waiting on hold."</p>
            <div class="font-bold">Alex Rivers</div>
        </div>
    </div>
</section>

<footer class="border-t border-white/5 py-16 bg-[#080B0E]">
    <div class="max-w-7xl mx-auto px-6">
        <div class="grid md:grid-cols-4 gap-12 mb-12">
            <div class="col-span-2">
                <div class="text-2xl font-bold tracking-tighter mb-6">CHHENLA<span class="text-[#FE7D2D]">.</span></div>
                <p class="text-slate-500 max-w-sm mb-6">Building the future of Local finance with transparency, security, and technology.</p>
                <div class="flex gap-4">
                    <a href="#" class="w-10 h-10 rounded-full bg-white/5 flex items-center justify-center hover:bg-[#FE7D2D] transition"><i data-lucide="twitter" size="18"></i></a>
                    <a href="#" class="w-10 h-10 rounded-full bg-white/5 flex items-center justify-center hover:bg-[#FE7D2D] transition"><i data-lucide="instagram" size="18"></i></a>
                </div>
            </div>
            <div>
                <h4 class="font-bold mb-6">Platform</h4>
                <ul class="space-y-4 text-sm text-slate-500">
                    <li><a href="#" class="hover:text-white">Personal Account</a></li>
                    <li><a href="#" class="hover:text-white">Business Suite</a></li>
                    <li><a href="#" class="hover:text-white">Crypto Trading</a></li>
                </ul>
            </div>
            <div>
                <h4 class="font-bold mb-6">Company</h4>
                <ul class="space-y-4 text-sm text-slate-500">
                    <li><a href="#" class="hover:text-white">Privacy Policy</a></li>
                    <li><a href="#" class="hover:text-white">Terms of Service</a></li>
                    <li><a href="https://t.me/Hengbunleap1" class="hover:text-white">Contact Support</a></li>
                </ul>
            </div>
        </div>
        <div class="pt-12 border-t border-white/5 flex flex-col md:flex-row justify-between gap-4">
            <p class="text-xs text-slate-600">© 2025 Chhenla Financial Group. All rights reserved.</p>
            <div class="flex gap-6">
                 <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/5e/Visa_Inc._logo.svg/2560px-Visa_Inc._logo.svg.png" class="h-4 opacity-30 grayscale" alt="Visa">
                 <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/2/2a/Mastercard-logo.svg/1280px-Mastercard-logo.svg.png" class="h-4 opacity-30 grayscale" alt="Mastercard">
            </div>
        </div>
    </div>
</footer>

<script>
    lucide.createIcons();
</script>
</body>
</html>
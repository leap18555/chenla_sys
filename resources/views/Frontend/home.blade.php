<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <title>Chhenla | Engineered Banking</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@500;700;800&family=Space+Grotesk:wght@500;700&display=swap" rel="stylesheet">
    <!-- AOS Animation Library -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Plus Jakarta Sans', 'sans-serif'],
                        mono: ['Space Grotesk', 'monospace'],
                    },
                    colors: {
                        brand: {
                            500: '#FE7D2D',
                            950: '#0B0F19',
                        }
                    }
                }
            }
        }
    </script>
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #FBFBFA;
        }
        /* Neo-Brutalist Solid Offset Shadow */
        .brutal-card {
            background: #FFFFFF;
            border: 3px solid #000000;
            box-shadow: 6px 6px 0px 0px #000000;
            transition: all 0.2s ease-in-out;
        }
        .brutal-card:hover {
            transform: translate(-4px, -4px);
            box-shadow: 10px 10px 0px 0px #FE7D2D;
            border-color: #000000;
        }
        .brutal-btn-primary {
            background: #FE7D2D;
            color: #000000;
            border: 3px solid #000000;
            box-shadow: 4px 4px 0px 0px #000000;
            transition: all 0.15s ease-in-out;
        }
        .brutal-btn-primary:hover {
            transform: translate(-2px, -2px);
            box-shadow: 6px 6px 0px 0px #000000;
        }
        .brutal-btn-primary:active {
            transform: translate(2px, 2px);
            box-shadow: 0px 0px 0px 0px #000000;
        }
        .brutal-btn-secondary {
            background: #FFFFFF;
            color: #000000;
            border: 3px solid #000000;
            box-shadow: 4px 4px 0px 0px #000000;
            transition: all 0.15s ease-in-out;
        }
        .brutal-btn-secondary:hover {
            transform: translate(-2px, -2px);
            box-shadow: 6px 6px 0px 0px #FE7D2D;
        }
        /* Tech Grid Overlay background */
        .tech-grid {
            background-size: 40px 40px;
            background-image: 
                linear-gradient(to right, rgba(0, 0, 0, 0.04) 1px, transparent 1px),
                linear-gradient(to bottom, rgba(0, 0, 0, 0.04) 1px, transparent 1px);
        }
    </style>
</head>

<body class="text-black selection:bg-brand-500 selection:text-white overflow-x-hidden tech-grid">

<!-- Navigation -->
<nav class="fixed top-0 w-full z-50 border-b-3 border-black bg-[#FBFBFA]/90 backdrop-blur-md">
    <div class="max-w-7xl mx-auto px-6 h-20 flex items-center justify-between">
        <div class="text-2xl font-black tracking-tighter font-mono flex items-center gap-2">
            <span class="bg-brand-500 text-black px-2 py-0.5 border-2 border-black shadow-[2px_2px_0px_0px_#000000]">CH</span>
            CHHENLA
        </div>
        <div class="hidden md:flex gap-8 text-sm font-bold font-mono">
            <a href="#features" class="hover:underline underline-offset-4 decoration-brand-500 decoration-2">FEATURES</a>
            <a href="#invest" class="hover:underline underline-offset-4 decoration-brand-500 decoration-2">INVEST</a>
            <a href="https://t.me/Hengbunleap1" target="_blank" class="hover:underline underline-offset-4 decoration-brand-500 decoration-2">TELEGRAM SUPPORT</a>
        </div>
        <div class="flex items-center gap-4">
            <a href="{{ route('login') }}" class="text-sm font-bold font-mono hover:text-brand-500 transition-colors">SIGN IN</a>
            <a href="{{ route('register') }}" class="brutal-btn-primary px-5 py-2.5 text-xs font-black font-mono tracking-widest uppercase">
                Open Account
            </a>
        </div>
    </div>
</nav>

<!-- Hero Section -->
<section class="relative pt-36 pb-24 border-b-3 border-black overflow-hidden bg-white">
    <div class="max-w-7xl mx-auto px-6 relative z-10">
        <div class="text-left max-w-5xl">
            <!-- Badge -->
            <div data-aos="fade-right" class="inline-flex items-center gap-2 px-4 py-2 border-2 border-black bg-yellow-300 text-xs font-black font-mono uppercase shadow-[3px_3px_0px_0px_#000000] mb-8">
                <span class="w-2.5 h-2.5 bg-black animate-ping rounded-none"></span>
                Status: Operational // Core &amp; Crypto Live
            </div>
            
            <h1 data-aos="fade-up" data-aos-delay="100" class="text-5xl md:text-8xl font-black tracking-tight mb-8 leading-[0.95] uppercase font-mono">
                Engineered <br>
                <span class="bg-brand-500 text-black px-4 inline-block border-3 border-black shadow-[8px_8px_0px_0px_#000000]">Banking.</span>
            </h1>
            
            <p data-aos="fade-up" data-aos-delay="200" class="text-slate-700 text-lg md:text-xl max-w-2xl mb-12 font-medium leading-relaxed">
                No fluff. No decorative bank glass. Just high-throughput transactions, low friction FX exchange, and clean crypto ledgers.
            </p>
            
            <div data-aos="fade-up" data-aos-delay="300" class="flex flex-col sm:flex-row gap-4 mb-16">
                <a href="{{ route('register') }}" class="brutal-btn-primary px-8 py-4 font-black font-mono text-center uppercase tracking-wider">
                    Get Started Now
                </a>
                <a href="{{ route('exchange') }}" class="brutal-btn-secondary px-8 py-4 font-black font-mono text-center uppercase tracking-wider">
                    Access Ledger
                </a>
            </div>
        </div>

        <!-- Brutalist Screen Container -->
        <div data-aos="zoom-in" data-aos-delay="400" class="relative max-w-5xl mx-auto border-3 border-black bg-black p-3 shadow-[12px_12px_0px_0px_rgba(0,0,0,1)]">
            <div class="bg-slate-100 border-b-3 border-black px-4 py-2 flex items-center gap-2 justify-between">
                <div class="flex gap-2">
                    <span class="w-3 h-3 rounded-full bg-red-500 border border-black"></span>
                    <span class="w-3 h-3 rounded-full bg-yellow-500 border border-black"></span>
                    <span class="w-3 h-3 rounded-full bg-green-500 border border-black"></span>
                </div>
                <div class="font-mono text-xs font-bold text-slate-500">CHHENLA_CORE_DASHBOARD_V4.X</div>
                <div class="w-10"></div>
            </div>
            <img src="https://images.unsplash.com/photo-1563986768609-322da13575f3?auto=format&fit=crop&q=80&w=1200" alt="Dashboard Preview" class="w-full h-auto grayscale contrast-125 border-t-3 border-black">
        </div>
    </div>
</section>

<!-- Plain Metric Block Grid -->
<section class="border-b-3 border-black bg-yellow-300 py-12">
    <div class="max-w-7xl mx-auto px-6 grid grid-cols-2 md:grid-cols-4 gap-8">
        <div class="border-r-0 md:border-r-3 border-black last:border-0 p-4 text-left">
            <div class="text-4xl font-black font-mono">$2.4M+</div>
            <div class="text-xs font-black uppercase font-mono tracking-widest mt-1 text-slate-800">Volume Settled</div>
        </div>
        <div class="border-r-0 md:border-r-3 border-black last:border-0 p-4 text-left">
            <div class="text-4xl font-black font-mono">40+</div>
            <div class="text-xs font-black uppercase font-mono tracking-widest mt-1 text-slate-800">FX Channels</div>
        </div>
        <div class="border-r-0 md:border-r-3 border-black last:border-0 p-4 text-left">
            <div class="text-4xl font-black font-mono">0.01%</div>
            <div class="text-xs font-black uppercase font-mono tracking-widest mt-1 text-slate-800">Slippage Cap</div>
        </div>
        <div class="p-4 text-left">
            <div class="text-4xl font-black font-mono">24/7</div>
            <div class="text-xs font-black uppercase font-mono tracking-widest mt-1 text-slate-800">Telegram Sync</div>
        </div>
    </div>
</section>

<!-- Grid Layout Features -->
<section id="features" class="max-w-7xl mx-auto px-6 py-24">
    <div class="mb-16">
        <h2 class="text-4xl md:text-6xl font-black font-mono tracking-tight mb-4 uppercase">Product Spec</h2>
        <p class="text-slate-600 max-w-xl font-mono text-sm uppercase font-bold">// System architecture and built-in interfaces.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <!-- Feature 1 -->
        <div data-aos="fade-up" class="brutal-card p-8 flex flex-col justify-between h-[420px]">
            <div>
                <div class="w-12 h-12 bg-lime-300 border-2 border-black flex items-center justify-center mb-6 shadow-[2px_2px_0px_0px_#000000]">
                    <i data-lucide="shield-check" size="24"></i>
                </div>
                <h3 class="text-2xl font-black font-mono mb-4 uppercase">Biometric Vaults</h3>
                <p class="text-slate-600 text-sm leading-relaxed">Multi-layer encryption featuring secure key validation built with strict local hardware-level loops.</p>
            </div>
            <div class="border-t-2 border-slate-200 pt-4 flex justify-between items-center font-mono text-xs font-bold text-slate-500">
                <span>AUTH_METHOD: FACEID</span>
                <span class="text-emerald-600">ACTIVE</span>
            </div>
        </div>

        <!-- Feature 2 -->
        <div id="invest" data-aos="fade-up" data-aos-delay="100" class="brutal-card p-8 flex flex-col justify-between h-[420px]">
            <div>
                <div class="w-12 h-12 bg-amber-400 border-2 border-black flex items-center justify-center mb-6 shadow-[2px_2px_0px_0px_#000000]">
                    <i data-lucide="bitcoin" size="24"></i>
                </div>
                <h3 class="text-2xl font-black font-mono mb-4 uppercase">Crypto Ledger</h3>
                <p class="text-slate-600 text-sm leading-relaxed">Direct fiat-to-crypto settlements. Execute orders on BTC, ETH, and other assets without internal custody hops.</p>
            </div>
            <div class="p-4 bg-slate-100 border-2 border-black font-mono text-xs">
                <div class="flex justify-between font-bold mb-1">
                    <span>BTC/USD</span>
                    <span class="text-emerald-600">+4.2%</span>
                </div>
                <div class="w-full bg-slate-300 h-2 border border-black">
                    <div class="bg-black h-full w-[78%]"></div>
                </div>
            </div>
        </div>

        <!-- Feature 3 -->
        <div data-aos="fade-up" data-aos-delay="200" class="brutal-card p-8 flex flex-col justify-between h-[420px]">
            <div>
                <div class="w-12 h-12 bg-cyan-300 border-2 border-black flex items-center justify-center mb-6 shadow-[2px_2px_0px_0px_#000000]">
                    <i data-lucide="zap" size="24"></i>
                </div>
                <h3 class="text-2xl font-black font-mono mb-4 uppercase">Instant Wire</h3>
                <p class="text-slate-600 text-sm leading-relaxed">Skip the traditional routing protocols. Execute international settlements in under 2 seconds flat.</p>
            </div>
            <div class="border-t-2 border-slate-200 pt-4 flex justify-between items-center font-mono text-xs font-bold text-slate-500">
                <span>ROUTE_TYPE: DIRECT_SWIFT</span>
                <span class="text-brand-500">SECURE</span>
            </div>
        </div>
    </div>
</section>

<!-- Lifestyle Section -->
<section data-aos="fade-up" class="max-w-7xl mx-auto px-6 py-16 mb-24">
    <div class="border-3 border-black bg-[#FBFBFA] brutal-card p-12 grid md:grid-cols-2 gap-12 items-center">
        <div>
            <h2 class="text-4xl md:text-5xl font-black font-mono uppercase mb-8 leading-none">Your capital.<br><span class="text-brand-500">your control.</span></h2>
            <div class="space-y-6">
                <div class="flex gap-4 items-start">
                    <div class="w-10 h-10 border-2 border-black bg-pink-300 flex items-center justify-center shrink-0 shadow-[2px_2px_0px_0px_#000000]">
                        <i data-lucide="credit-card" size="18"></i>
                    </div>
                    <div>
                        <h4 class="font-bold font-mono text-lg uppercase">Virtual Disposable Cards</h4>
                        <p class="text-slate-600 text-sm mt-1">Spin up self-destructing credit tokens for safe single-use online purchases.</p>
                    </div>
                </div>
                <div class="flex gap-4 items-start">
                    <div class="w-10 h-10 border-2 border-black bg-purple-300 flex items-center justify-center shrink-0 shadow-[2px_2px_0px_0px_#000000]">
                        <i data-lucide="pie-chart" size="18"></i>
                    </div>
                    <div>
                        <h4 class="font-bold font-mono text-lg uppercase">System Analytics</h4>
                        <p class="text-slate-600 text-sm mt-1">Clear categorization of outbound flows without third-party analytics scripts.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="grid grid-cols-2 gap-4">
            <img src="https://images.unsplash.com/photo-1556742044-3c52d6e88c62?auto=format&fit=crop&q=80&w=400" class="border-3 border-black h-48 w-full object-cover shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]" alt="Lifestyle">
            <img src="https://images.unsplash.com/photo-1559526324-4b87b5e36e44?auto=format&fit=crop&q=80&w=400" class="border-3 border-black h-48 w-full object-cover mt-6 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]" alt="Banking">
        </div>
    </div>
</section>

<!-- Testimonials Grid -->
<section class="max-w-7xl mx-auto px-6 py-24 border-t-3 border-black">
    <div class="mb-16 text-center">
        <h2 class="text-3xl md:text-5xl font-black font-mono uppercase">Verified Operators</h2>
        <p class="text-slate-600 mt-2 font-mono text-sm">// Real feedback from platform nodes.</p>
    </div>
    <div class="grid md:grid-cols-3 gap-8">
        <div class="brutal-card p-8">
            <div class="flex text-brand-500 gap-1 mb-6">
                <i data-lucide="star" size="16" class="fill-current"></i><i data-lucide="star" size="16" class="fill-current"></i><i data-lucide="star" size="16" class="fill-current"></i><i data-lucide="star" size="16" class="fill-current"></i><i data-lucide="star" size="16" class="fill-current"></i>
            </div>
            <p class="text-slate-700 font-mono text-sm italic mb-6 leading-relaxed">"The onboarding is completely automated. Had a live system card ready in 3 minutes flat."</p>
            <div class="font-black font-mono uppercase text-sm border-t-2 border-black pt-4">Heng Bunleap</div>
        </div>
        <div class="brutal-card p-8">
            <div class="flex text-brand-500 gap-1 mb-6">
                <i data-lucide="star" size="16" class="fill-current"></i><i data-lucide="star" size="16" class="fill-current"></i><i data-lucide="star" size="16" class="fill-current"></i><i data-lucide="star" size="16" class="fill-current"></i><i data-lucide="star" size="16" class="fill-current"></i>
            </div>
            <p class="text-slate-700 font-mono text-sm italic mb-6 leading-relaxed">"Perfect bridge system. Holds my traditional cash and executes raw crypto trades directly."</p>
            <div class="font-black font-mono uppercase text-sm border-t-2 border-black pt-4">Horm Bunhak</div>
        </div>
        <div class="brutal-card p-8">
            <div class="flex text-brand-500 gap-1 mb-6">
                <i data-lucide="star" size="16" class="fill-current"></i><i data-lucide="star" size="16" class="fill-current"></i><i data-lucide="star" size="16" class="fill-current"></i><i data-lucide="star" size="16" class="fill-current"></i><i data-lucide="star" size="16" class="fill-current"></i>
            </div>
            <p class="text-slate-700 font-mono text-sm italic mb-6 leading-relaxed">"Telegram integration lets me check balances, wire approvals, and receive receipts instantly."</p>
            <div class="font-black font-mono uppercase text-sm border-t-2 border-black pt-4">Seing Hunthorn</div>
        </div>
    </div>
</section>

<!-- Footer -->
<footer class="border-t-3 border-black py-16 bg-[#FBFBFA] text-black">
    <div class="max-w-7xl mx-auto px-6">
        <div class="grid md:grid-cols-4 gap-12 mb-12">
            <div class="col-span-2">
                <div class="text-2xl font-black tracking-tighter mb-6 font-mono">CHHENLA<span class="text-brand-500">.</span></div>
                <p class="text-slate-600 max-w-sm mb-6 font-medium text-sm">Engineered localized and global high-speed clearing systems with complete structural transparency.</p>
                <div class="flex gap-4">
                    <a href="#" class="w-10 h-10 border-2 border-black bg-white flex items-center justify-center hover:bg-brand-500 transition shadow-[2px_2px_0px_0px_#000000]"><i data-lucide="twitter" size="18"></i></a>
                    <a href="#" class="w-10 h-10 border-2 border-black bg-white flex items-center justify-center hover:bg-brand-500 transition shadow-[2px_2px_0px_0px_#000000]"><i data-lucide="instagram" size="18"></i></a>
                </div>
            </div>
            <div>
                <h4 class="font-black font-mono uppercase text-sm mb-6">Platform</h4>
                <ul class="space-y-4 text-xs font-mono font-bold text-slate-600">
                    <li><a href="#" class="hover:text-brand-500">// Personal Ledger</a></li>
                    <li><a href="#" class="hover:text-brand-500">// Business Node</a></li>
                    <li><a href="#" class="hover:text-brand-500">// Crypto Assets</a></li>
                </ul>
            </div>
            <div>
                <h4 class="font-black font-mono uppercase text-sm mb-6">System</h4>
                <ul class="space-y-4 text-xs font-mono font-bold text-slate-600">
                    <li><a href="#" class="hover:text-brand-500">// Privacy Loop</a></li>
                    <li><a href="#" class="hover:text-brand-500">// Terms of Node</a></li>
                    <li><a href="https://t.me/Hengbunleap1" class="hover:text-brand-500">// Terminal Support</a></li>
                </ul>
            </div>
        </div>
        <div class="pt-12 border-t-2 border-slate-200 flex flex-col md:flex-row justify-between gap-4 font-mono text-xs">
            <p class="text-slate-500">© 2026 CHHENLA FINANCIAL GROUP. ALL CHANNELS OPERATIONAL.</p>
            <div class="flex gap-6 items-center">
                 <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/5e/Visa_Inc._logo.svg/2560px-Visa_Inc._logo.svg.png" class="h-4 opacity-40 grayscale" alt="Visa">
                 <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/2/2a/Mastercard-logo.svg/1280px-Mastercard-logo.svg.png" class="h-4 opacity-40 grayscale" alt="Mastercard">
            </div>
        </div>
    </div>
</footer>

<!-- AOS Script and Initialization -->
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    lucide.createIcons();
    // Initialize Animations
    AOS.init({
        duration: 800, 
        once: true,    
        offset: 100    
    });
</script>
</body>
</html>
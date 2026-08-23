<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Chhenla Bank</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@500;700;800&display=swap" rel="stylesheet">

    <script src="https://unpkg.com/lucide@latest"></script>

    <!-- AOS Animation Library -->
    <link rel="stylesheet" href="https://unpkg.com/aos@2.3.4/dist/aos.css"/>

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            overflow-x: hidden;
            background-color: #F8F9FA;
        }

        /* Brutalist Flat Hard Shadows */
        .brutal-card {
            background: #FFFFFF;
            border: 3px solid #000000;
            box-shadow: 8px 8px 0px #000000;
        }

        .brutal-btn {
            background: #FE7D2D;
            border: 3px solid #000000;
            box-shadow: 4px 4px 0px #000000;
            transition: all 0.1s ease;
        }

        .brutal-btn:hover {
            transform: translate(-2px, -2px);
            box-shadow: 6px 6px 0px #000000;
        }

        .brutal-btn:active {
            transform: translate(4px, 4px);
            box-shadow: 0px 0px 0px #000000;
        }

        .brutal-input {
            border: 2px solid #000000;
            transition: all 0.1s ease;
        }

        .brutal-input:focus {
            box-shadow: 3px 3px 0px #000000;
        }
    </style>
</head>

<body class="min-h-screen text-black flex flex-col items-center justify-center p-6 selection:bg-[#FE7D2D]/30">

    <!-- Top Status Badge -->
    <div class="mb-6 bg-[#EAEA00] border-2 border-black px-3 py-1 text-xs font-bold tracking-wider uppercase flex items-center gap-2 shadow-[3px_3px_0px_#000]"
         data-aos="fade-down"
         data-aos-duration="600">
        <span class="w-2 h-2 bg-black inline-block"></span>
        SECURE NODE // AUTH_REQUIRED
    </div>

    <!-- Logo Box -->
    <a href="/"
       class="mb-8 flex items-center gap-2 text-2xl font-extrabold tracking-tighter uppercase"
       data-aos="fade-down"
       data-aos-delay="100">
        <div class="bg-black text-white px-2 py-1 border-2 border-black font-black">CH</div>
        <span>CHHENLA<span class="text-[#FE7D2D]">.</span></span>
    </a>

    <!-- Main Brutalist Form Card -->
    <div class="w-full max-w-[440px] brutal-card p-8 md:p-10"
         data-aos="zoom-in"
         data-aos-duration="600"
         data-aos-delay="200">

        <div class="mb-8 border-b-2 border-black pb-6">
            <h1 class="text-3xl font-black uppercase tracking-tight mb-1">
                ACCESS SYSTEM
            </h1>
            <p class="text-slate-600 text-xs font-medium tracking-wide">
                PROVIDE CREDENTIALS TO LOAD YOUR PORTFOLIO LEDGER.
            </p>
        </div>

        @if(session('error'))
            <div class="bg-red-100 border-2 border-black p-4 mb-6 text-xs font-bold uppercase flex items-center gap-3 shadow-[3px_3px_0px_#000]">
                <i data-lucide="alert-circle" class="w-4 h-4 text-red-600 stroke-[3]"></i>
                <span>{{ session('error') }}</span>
            </div>
        @endif

        <form action="{{ route('login') }}" method="POST" class="space-y-6">
            @csrf

            <!-- Email -->
            <div class="space-y-1.5">
                <label for="email" class="text-xs font-bold tracking-wider uppercase text-black">
                    CORE EMAIL ADDRESS
                </label>
                <div class="relative group">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-black">
                        <i data-lucide="mail" class="w-4 h-4 stroke-[2.5]"></i>
                    </div>
                    <input
                        type="email"
                        name="email"
                        id="email"
                        placeholder="NAME@COMPANY.COM"
                        required
                        class="w-full pl-11 pr-4 py-3.5 text-sm font-bold bg-white brutal-input focus:outline-none uppercase placeholder:text-slate-400 placeholder:normal-case">
                </div>
            </div>

            <!-- Password -->
            <div class="space-y-1.5">
                <div class="flex justify-between items-center">
                    <label for="password" class="text-xs font-bold tracking-wider uppercase text-black">
                        PASSWORD / KEY
                    </label>
                    <a href="#" class="text-xs font-bold text-black uppercase underline decoration-2 hover:text-[#FE7D2D]">
                        FORGOT?
                    </a>
                </div>
                <div class="relative group">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-black">
                        <i data-lucide="lock" class="w-4 h-4 stroke-[2.5]"></i>
                    </div>
                    <input
                        type="password"
                        name="password"
                        id="password"
                        placeholder="••••••••"
                        required
                        class="w-full pl-11 pr-12 py-3.5 text-sm font-bold bg-white brutal-input focus:outline-none">
                    
                    <button 
                        type="button" 
                        id="toggle-password" 
                        class="absolute inset-y-0 right-0 pr-4 flex items-center text-black hover:text-[#FE7D2D] focus:outline-none">
                        <i data-lucide="eye" class="w-4 h-4 stroke-[2.5]" id="toggle-icon"></i>
                    </button>
                </div>
            </div>

            <!-- Remember Option -->
            <div class="flex items-center space-x-3 pt-1">
                <div class="relative flex items-center">
                    <input
                        type="checkbox"
                        name="remember"
                        id="remember"
                        class="peer h-5 w-5 cursor-pointer appearance-none border-2 border-black bg-white checked:bg-[#FE7D2D] transition-all">
                    <i data-lucide="check" class="absolute left-0.5 text-black scale-0 peer-checked:scale-100 transition-transform pointer-events-none w-4 h-4 stroke-[3]"></i>
                </div>
                <label for="remember" class="text-xs font-bold tracking-wide text-black uppercase cursor-pointer select-none">
                    REMEMBER THIS DEVICE SESSION
                </label>
            </div>

            <!-- Action Button -->
            <button
                type="submit"
                class="w-full py-4 text-sm font-black uppercase tracking-widest brutal-btn text-white">
                GET STARTED NOW
            </button>
        </form>

        <!-- Footer Registry Link -->
        <div class="mt-8 pt-6 border-t-2 border-black text-center">
            <p class="text-xs font-bold uppercase tracking-wide">
                NEW TO CHHENLA?
                <a href="{{ route('register') }}" class="text-black ml-1 underline decoration-2 hover:text-[#FE7D2D]">
                    CREATE AN ACCOUNT
                </a>
            </p>
        </div>
    </div>

    <!-- Bottom System Information Footer -->
    <footer class="mt-10 text-black text-[11px] font-bold uppercase tracking-wider flex items-center gap-3"
            data-aos="fade-up"
            data-aos-delay="400">
        <span>&copy; {{ date('Y') }} CHHENLA BANK</span>
        <span class="w-1.5 h-1.5 bg-black"></span>
        <span>CORE // CRYPTO LIVE</span>
    </footer>

    <!-- Scripts -->
    <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>

    <script>
        lucide.createIcons();

        AOS.init({
            once: true,
            duration: 500,
        });

        // Password Reveal Input Handler
        const passwordInput = document.getElementById('password');
        const toggleBtn = document.getElementById('toggle-password');
        const toggleIcon = document.getElementById('toggle-icon');

        toggleBtn.addEventListener('click', () => {
            const isPassword = passwordInput.getAttribute('type') === 'password';
            passwordInput.setAttribute('type', isPassword ? 'text' : 'password');
            toggleIcon.setAttribute('data-lucide', isPassword ? 'eye-off' : 'eye');
            lucide.createIcons();
        });
    </script>

</body>
</html>
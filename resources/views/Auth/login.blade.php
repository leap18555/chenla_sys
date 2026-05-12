<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Chhenla Bank</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .glass-card {
            background: rgba(255, 255, 255, 0.03);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
    </style>
</head>
<body class="min-h-screen bg-[#0B0F13] text-white flex flex-col items-center justify-center p-6 selection:bg-[#FE7D2D]/30">

    <div class="fixed top-0 left-1/2 -translate-x-1/2 w-full h-[500px] bg-[#FE7D2D]/5 blur-[120px] rounded-full -z-10"></div>

    <a href="/" class="mb-10 text-2xl font-extrabold tracking-tighter">
        CHHENLA<span class="text-[#FE7D2D]">.</span>
    </a>

    <div class="w-full max-w-[440px] glass-card p-8 md:p-10 rounded-[2.5rem] shadow-2xl">
        <div class="mb-8">
            <h1 class="text-3xl font-bold tracking-tight mb-2">Welcome back</h1>
            <p class="text-slate-400 text-sm">Please enter your details to access your account.</p>
        </div>

        @if(session('error'))
            <div class="bg-red-500/10 border border-red-500/20 text-red-400 p-4 rounded-2xl mb-6 text-sm flex items-center gap-3">
                <i data-lucide="alert-circle" size="18"></i>
                {{ session('error') }}
            </div>
        @endif
        
        <form action="{{ route('login') }}" method="POST" class="space-y-6">
            @csrf
            
            <div class="space-y-2">
                <label for="email" class="text-sm font-semibold ml-1 text-slate-300">Email Address</label>
                <div class="relative group">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-500 group-focus-within:text-[#FE7D2D] transition-colors">
                        <i data-lucide="mail" size="18"></i>
                    </div>
                    <input type="email" name="email" id="email" placeholder="name@company.com" required
                           class="w-full pl-11 pr-4 py-3.5 rounded-2xl bg-white/5 border border-white/10 focus:border-[#FE7D2D]/50 focus:ring-4 focus:ring-[#FE7D2D]/10 focus:outline-none transition-all placeholder:text-slate-600">
                </div>
            </div>

            <div class="space-y-2">
                <div class="flex justify-between items-center ml-1">
                    <label for="password" class="text-sm font-semibold text-slate-300">Password</label>
                    <a href="#" class="text-xs font-bold text-[#FE7D2D] hover:underline">Forgot?</a>
                </div>
                <div class="relative group">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-500 group-focus-within:text-[#FE7D2D] transition-colors">
                        <i data-lucide="lock" size="18"></i>
                    </div>
                    <input type="password" name="password" id="password" placeholder="••••••••" required
                           class="w-full pl-11 pr-4 py-3.5 rounded-2xl bg-white/5 border border-white/10 focus:border-[#FE7D2D]/50 focus:ring-4 focus:ring-[#FE7D2D]/10 focus:outline-none transition-all placeholder:text-slate-600">
                </div>
            </div>

            <div class="flex items-center space-x-3 ml-1">
                <div class="relative flex items-center">
                    <input type="checkbox" name="remember" id="remember" 
                           class="peer h-5 w-5 cursor-pointer appearance-none rounded-md border border-white/20 bg-white/5 checked:bg-[#FE7D2D] checked:border-[#FE7D2D] transition-all">
                    <i data-lucide="check" class="absolute left-0.5 text-white scale-0 peer-checked:scale-100 transition-transform pointer-events-none" size="14"></i>
                </div>
                <label for="remember" class="text-sm text-slate-400 cursor-pointer select-none">Remember this device</label>
            </div>

            <button type="submit"
                    class="w-full bg-[#FE7D2D] hover:bg-[#ff8e4a] text-white font-bold py-4 rounded-2xl transition-all duration-300 shadow-lg shadow-[#FE7D2D]/20 active:scale-[0.98]">
                Sign In
            </button>
        </form>

        <div class="mt-8 pt-8 border-t border-white/5 text-center">
            <p class="text-slate-400 text-sm">
                New to Chhenla? 
                <a href="{{ route('register') }}" class="text-[#FE7D2D] font-bold hover:underline ml-1">Create an account</a>
            </p>
        </div>
    </div>

    <footer class="mt-10 text-slate-600 text-xs">
        &copy; 2025 Chhenla Bank. Secure Encryption Active.
    </footer>

    <script>
        lucide.createIcons();
    </script>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Join Chhenla | Secure Banking</title>
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
        /* Custom Checkbox */
        .custom-check:checked {
            background-color: #FE7D2D;
            background-image: url("data:image/svg+xml,%3csvg viewBox='0 0 16 16' fill='white' xmlns='http://www.w3.org/2000/svg'%3e%3cpath d='M12.207 4.793a1 1 0 010 1.414l-5 5a1 1 0 01-1.414 0l-2-2a1 1 0 011.414-1.414L6.5 9.086l4.293-4.293a1 1 0 011.414 0z'/%3e%3c/svg%3e");
        }
    </style>
</head>
<body class="min-h-screen bg-[#0B0F13] text-white flex flex-col items-center justify-center p-6 selection:bg-[#FE7D2D]/30">

    <div class="fixed bottom-0 right-0 w-[500px] h-[500px] bg-[#FE7D2D]/5 blur-[120px] rounded-full -z-10"></div>
    <div class="fixed top-0 left-0 w-[400px] h-[400px] bg-blue-500/5 blur-[120px] rounded-full -z-10"></div>

    <a href="/" class="mb-8 text-2xl font-extrabold tracking-tighter">
        CHHENLA<span class="text-[#FE7D2D]">.</span>
    </a>

    <div class="w-full max-w-[500px] glass-card p-8 md:p-12 rounded-[2.5rem] shadow-2xl">
        <div class="mb-10 text-center">
            <h1 class="text-3xl font-bold tracking-tight mb-3">Create your account</h1>
            <p class="text-slate-400 text-sm">Join 10,000+ users managing wealth smarter.</p>
        </div>

        <form action="{{ route('register') }}" method="POST" class="space-y-5">
            @csrf

            <div class="space-y-2">
                <label class="text-xs font-bold uppercase tracking-widest text-slate-500 ml-1">Full Name</label>
                <div class="relative group">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-500 group-focus-within:text-[#FE7D2D] transition-colors">
                        <i data-lucide="user" size="18"></i>
                    </div>
                    <input type="text" name="name" placeholder="John Doe" value="{{ old('name') }}"
                        class="w-full pl-11 pr-4 py-3.5 rounded-2xl bg-white/5 border {{ $errors->has('name') ? 'border-red-500/50' : 'border-white/10' }} focus:border-[#FE7D2D]/50 focus:ring-4 focus:ring-[#FE7D2D]/10 focus:outline-none transition-all placeholder:text-slate-600">
                </div>
                @error('name') <p class="text-red-400 text-xs mt-1 ml-1">{{ $message }}</p> @enderror
            </div>

            <div class="space-y-2">
                <label class="text-xs font-bold uppercase tracking-widest text-slate-500 ml-1">Email Address</label>
                <div class="relative group">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-500 group-focus-within:text-[#FE7D2D] transition-colors">
                        <i data-lucide="mail" size="18"></i>
                    </div>
                    <input type="email" name="email" placeholder="john@example.com" value="{{ old('email') }}"
                        class="w-full pl-11 pr-4 py-3.5 rounded-2xl bg-white/5 border {{ $errors->has('email') ? 'border-red-500/50' : 'border-white/10' }} focus:border-[#FE7D2D]/50 focus:ring-4 focus:ring-[#FE7D2D]/10 focus:outline-none transition-all placeholder:text-slate-600">
                </div>
                @error('email') <p class="text-red-400 text-xs mt-1 ml-1">{{ $message }}</p> @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="space-y-2">
                    <label class="text-xs font-bold uppercase tracking-widest text-slate-500 ml-1">Password</label>
                    <div class="relative group">
                        <input type="password" name="password" placeholder="••••••••"
                            class="w-full px-4 py-3.5 rounded-2xl bg-white/5 border {{ $errors->has('password') ? 'border-red-500/50' : 'border-white/10' }} focus:border-[#FE7D2D]/50 focus:outline-none transition-all">
                    </div>
                </div>
                <div class="space-y-2">
                    <label class="text-xs font-bold uppercase tracking-widest text-slate-500 ml-1">Confirm</label>
                    <div class="relative group">
                        <input type="password" name="password_confirmation" placeholder="••••••••"
                            class="w-full px-4 py-3.5 rounded-2xl bg-white/5 border border-white/10 focus:border-[#FE7D2D]/50 focus:outline-none transition-all">
                    </div>
                </div>
            </div>
            @error('password') <p class="text-red-400 text-xs mt-1 ml-1">{{ $message }}</p> @enderror

            <div class="flex items-start space-x-3 py-2 ml-1">
                <input type="checkbox" id="terms" name="terms" required
                    class="custom-check mt-1 h-5 w-5 cursor-pointer appearance-none rounded-md border border-white/20 bg-white/5 transition-all">
                <label for="terms" class="text-sm text-slate-400 leading-tight">
                    I agree to the <a href="#" class="text-[#FE7D2D] hover:underline font-medium">Terms of Service</a> and <a href="#" class="text-[#FE7D2D] hover:underline font-medium">Privacy Policy</a>
                </label>
            </div>

            <button type="submit"
                    class="w-full bg-[#FE7D2D] hover:bg-[#ff8e4a] text-white font-bold py-4 rounded-2xl transition-all duration-300 shadow-lg shadow-[#FE7D2D]/20 active:scale-[0.98] mt-4">
                Create Account
            </button>
        </form>

        <div class="mt-8 pt-8 border-t border-white/5 text-center">
            <p class="text-slate-400 text-sm">
                Already have an account? 
                <a href="{{ route('login') }}" class="text-[#FE7D2D] font-bold hover:underline ml-1">Sign in instead</a>
            </p>
        </div>
    </div>

    <script>
        lucide.createIcons();
    </script>
</body>
</html>
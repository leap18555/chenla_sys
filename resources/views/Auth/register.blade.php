<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Join Chhenla | Secure Banking</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@500;700;800&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #F7F7F7;
            overflow-x: hidden;
        }

        /* Neo-brutalist solid offsets */
        .brutal-shadow {
            box-shadow: 6px 6px 0px 0px #000000;
        }
        
        .brutal-shadow-sm {
            box-shadow: 3px 3px 0px 0px #000000;
        }

        .brutal-btn-shadow {
            box-shadow: 4px 4px 0px 0px #000000;
        }

        /* --- Neo-Brutalist Animations --- */

        /* Entry Transitions */
        .animate-pop-in {
            animation: brutalPop 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275) forwards;
            opacity: 0;
        }

        .delay-100 { animation-delay: 0.1s; }
        .delay-200 { animation-delay: 0.2s; }

        @keyframes brutalPop {
            0% {
                transform: translate(4px, 4px) scale(0.95);
                opacity: 0;
            }
            100% {
                transform: translate(0, 0) scale(1);
                opacity: 1;
            }
        }

        /* Interactive Inputs */
        .brutal-input {
            transition: transform 0.15s ease, box-shadow 0.15s ease, background-color 0.15s ease;
        }

        .brutal-input:focus {
            background-color: #FFFFFF;
            transform: translate(-2px, -2px);
            box-shadow: 4px 4px 0px 0px #000000;
        }

        /* Spring Button Compression */
        .brutal-btn {
            transition: transform 0.1s cubic-bezier(0.19, 1, 0.22, 1), box-shadow 0.1s cubic-bezier(0.19, 1, 0.22, 1);
        }

        .brutal-btn:hover {
            transform: translate(-2px, -2px);
            box-shadow: 6px 6px 0px 0px #000000;
        }

        .brutal-btn:active {
            transform: translate(4px, 4px);
            box-shadow: 0px 0px 0px 0px #000000;
        }

        /* Marquee Badge Border Alert */
        .badge-pulse {
            animation: badgeAlert 1.5s steps(2, start) infinite;
        }

        @keyframes badgeAlert {
            0%, 100% { border-color: #000000; background-color: #E1FF26; }
            50% { border-color: #ED7E43; background-color: #FFFFFF; }
        }
    </style>
</head>

<body class="min-h-screen text-black flex flex-col items-center justify-center p-4 md:p-6 select-none bg-[#F7F7F7]">

    <!-- Top Badge Indicator -->
    <div class="mb-6 border-2 px-4 py-1.5 text-xs font-bold uppercase tracking-wider text-black brutal-shadow-sm flex items-center gap-2 badge-pulse animate-pop-in">
        <span class="inline-block w-2 h-2 bg-black animate-ping"></span>
        Secure Node // Registration Required
    </div>

    <!-- Logo Section -->
    <div class="mb-8 flex items-center justify-center gap-2 animate-pop-in delay-100">
        <div class="bg-black text-white px-3 py-1.5 font-extrabold text-xl tracking-tight uppercase hover:rotate-2 transition-transform cursor-pointer">
            CH
        </div>
        <span class="text-xl font-extrabold tracking-tight uppercase">
            CHHENLA<span class="text-[#ED7E43] inline-block hover:scale-155 transition-transform">.</span>
        </span>
    </div>

    <!-- Register Card -->
    <div class="w-full max-w-[520px] bg-white border-2 border-black p-8 md:p-10 brutal-shadow animate-pop-in delay-200">
        
        <div class="mb-6">
            <h1 class="text-3xl font-extrabold tracking-tight uppercase leading-none mb-2">
                Create Account
            </h1>
            <p class="text-gray-500 text-xs font-bold tracking-wide uppercase">
                Provide registration data to initialize system ledger.
            </p>
            <hr class="border-black border-t-2 mt-4">
        </div>

        <form action="{{ route('register') }}" method="POST" class="space-y-5">
            @csrf

            <!-- Full Name -->
            <div class="space-y-1.5">
                <label class="text-xs font-extrabold uppercase tracking-wider text-black">
                    Core Profile Name
                </label>
                <div class="relative group">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-black z-10">
                        <i data-lucide="user" size="18" stroke-width="2.5"></i>
                    </div>
                    <input
                        type="text"
                        name="name"
                        placeholder="JOHN DOE"
                        value="{{ old('name') }}"
                        class="brutal-input w-full pl-12 pr-4 py-3.5 border-2 border-black bg-[#EEF2F6] font-bold text-sm tracking-wide text-black outline-none placeholder:text-gray-400 uppercase relative z-0">
                </div>
                @error('name')
                    <p class="text-red-600 text-xs font-bold mt-1 uppercase animate-bounce">! {{ $message }}</p>
                @enderror
            </div>

            <!-- Email Address -->
            <div class="space-y-1.5">
                <label class="text-xs font-extrabold uppercase tracking-wider text-black">
                    Core Email Address
                </label>
                <div class="relative group">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-black z-10">
                        <i data-lucide="mail" size="18" stroke-width="2.5"></i>
                    </div>
                    <input
                        type="email"
                        name="email"
                        placeholder="NAME@DOMAIN.COM"
                        value="{{ old('email') }}"
                        class="brutal-input w-full pl-12 pr-4 py-3.5 border-2 border-black bg-[#EEF2F6] font-bold text-sm tracking-wide text-black outline-none placeholder:text-gray-400 uppercase relative z-0">
                </div>
                @error('email')
                    <p class="text-red-600 text-xs font-bold mt-1 uppercase animate-bounce">! {{ $message }}</p>
                @enderror
            </div>

            <!-- Passwords (Grid Layout) -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <!-- Password Field -->
                <div class="space-y-1.5">
                    <label class="text-xs font-extrabold uppercase tracking-wider text-black">
                        Access Key
                    </label>
                    <input
                        type="password"
                        name="password"
                        placeholder="••••••••"
                        class="brutal-input w-full px-4 py-3.5 border-2 border-black bg-[#EEF2F6] font-bold text-sm text-black outline-none">
                </div>

                <!-- Confirm Field -->
                <div class="space-y-1.5">
                    <label class="text-xs font-extrabold uppercase tracking-wider text-black">
                        Verify Key
                    </label>
                    <input
                        type="password"
                        name="password_confirmation"
                        placeholder="••••••••"
                        class="brutal-input w-full px-4 py-3.5 border-2 border-black bg-[#EEF2F6] font-bold text-sm text-black outline-none">
                </div>
            </div>
            @error('password')
                <p class="text-red-600 text-xs font-bold mt-1 uppercase animate-bounce">! {{ $message }}</p>
            @enderror

            <!-- Terms and Conditions Checkbox -->
            <div class="flex items-start gap-3 pt-2">
                <input
                    type="checkbox"
                    id="terms"
                    name="terms"
                    required
                    class="mt-0.5 h-5 w-5 min-w-[20px] rounded-none border-2 border-black bg-white accent-black cursor-pointer appearance-none checked:bg-black checked:before:content-['✓'] checked:before:text-white checked:before:text-xs checked:before:flex checked:before:justify-center checked:before:items-center transition-transform active:scale-90">

                <label for="terms" class="text-xs text-black font-bold uppercase tracking-wide leading-tight cursor-pointer select-none">
                    I authorize the processing of data under the 
                    <a href="#" class="underline decoration-2 hover:text-[#ED7E43] transition-colors">Terms of Service</a> 
                    &amp; 
                    <a href="#" class="underline decoration-2 hover:text-[#ED7E43] transition-colors">Privacy Policy</a>.
                </label>
            </div>

            <!-- Submit Button -->
            <button
                type="submit"
                class="brutal-btn w-full bg-[#ED7E43] border-2 border-black text-white font-extrabold py-4 uppercase text-sm tracking-widest brutal-btn-shadow block text-center mt-6 cursor-pointer select-none">
                Create Account Now
            </button>
        </form>

        <!-- Dynamic Redirection Link -->
        <div class="mt-6 pt-6 border-t-2 border-black text-center">
            <p class="text-black font-bold text-xs uppercase tracking-wider">
                Already registered? 
                <a href="{{ route('login') }}" class="underline decoration-2 hover:text-[#ED7E43] font-extrabold ml-1 transition-colors">
                    Sign In Instantly
                </a>
            </p>
        </div>
    </div>

    <!-- Footer System Data -->
    <div class="mt-8 text-center text-[10px] font-bold uppercase tracking-widest text-gray-500 animate-pop-in delay-200">
        © 2026 Chhenla Bank &nbsp;■&nbsp; Core // Crypto Live
    </div>

    <script>
        // Init Icons
        lucide.createIcons();
    </script>
</body>
</html>
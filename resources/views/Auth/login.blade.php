<!DOCTYPE html>
<html lang="km">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>ចូលប្រើប្រាស់ | ធនាគារ ចេនឡា</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Khmer Font (Kantumruy Pro) -->
    <link href="https://fonts.googleapis.com/css2?family=Kantumruy+Pro:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>

    <style>
        body {
            font-family: 'Kantumruy Pro', sans-serif;
            line-height: 1.6;
            background-color: #F4F7F9;
        }

        /* Subtle Traditional Khmer Kbach Lattice Pattern */
        .khmer-pattern-bg {
            background-image: url("data:image/svg+xml,%3Csvg width='56' height='56' viewBox='0 0 56 56' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' stroke='%230F4C5C' stroke-width='1' stroke-opacity='0.06'%3E%3Cpath d='M28 4 L52 28 L28 52 L4 28 Z'/%3E%3Cpath d='M28 14 L42 28 L28 42 L14 28 Z'/%3E%3Ccircle cx='28' cy='28' r='3' fill='%230F4C5C' fill-opacity='0.06'/%3E%3C/g%3E%3C/svg%3E");
        }
    </style>
</head>

<body class="khmer-pattern-bg text-slate-800 min-h-screen flex flex-col justify-center items-center p-4 relative overflow-x-hidden">

    <!-- =========================================
         KHMER CULTURE & ANGKOR WAT BACKGROUND
    ========================================== -->
    <div class="fixed inset-0 pointer-events-none z-0 flex flex-col justify-between overflow-hidden">

        <!-- Top Soft Ambient Glow -->
        <div class="w-full h-64 bg-gradient-to-b from-[#0F4C5C]/10 to-transparent"></div>

        <!-- Bottom Angkor Wat Temple & Khmer Heritage Silhouette -->
        <div class="w-full mt-auto">
            <svg class="w-full h-36 sm:h-52 md:h-64 text-[#0F4C5C]/10 fill-current" viewBox="0 0 1440 320" preserveAspectRatio="xMidYBottom slice" xmlns="http://www.w3.org/2000/svg">
                <!-- Distant Temple Layer -->
                <path opacity="0.5" d="M0,320 L0,285 L180,285 L200,265 L350,265 L370,245 L510,245 L525,210 L540,245 L900,245 L915,210 L930,245 L1070,245 L1090,265 L1240,265 L1260,285 L1440,285 L1440,320 Z"/>
                
                <!-- Main Angkor Wat 5-Tower Silhouette -->
                <path d="M0,320 L0,290 L230,290 L245,270 L330,270 L340,245 L355,215 L365,195 L375,215 L390,245 L400,270 L465,270 L475,235 L490,190 L505,150 L515,125 L525,150 L540,190 L555,235 L565,270 L635,270 L650,220 L670,165 L690,115 L708,75 L720,45 L732,75 L750,115 L770,165 L790,220 L805,270 L875,270 L885,235 L900,190 L915,150 L925,125 L935,150 L950,190 L965,235 L975,270 L1040,270 L1050,245 L1065,215 L1075,195 L1085,215 L1100,245 L1110,270 L1195,270 L1210,290 L1440,290 L1440,320 Z"/>
                
                <!-- Causeway / Naga Bridge Base Reflection -->
                <rect x="0" y="302" width="1440" height="18" class="text-[#0B2B40]/15 fill-current"/>
            </svg>
        </div>
    </div>


    <!-- =========================================
         MAIN LOGIN CONTENT
    ========================================== -->
    <main class="w-full max-w-md relative z-10">

        <!-- Header / Logo -->
        <div class="text-center mb-6">
            <a href="/" class="inline-flex items-center gap-3">
                <div class="w-11 h-11 rounded-lg bg-[#0F4C5C] text-white flex items-center justify-center font-bold text-lg shadow-sm">
                    CH
                </div>
                <div class="text-left">
                    <div class="text-lg font-bold text-[#0B2B40] leading-tight">
                        ធនាគារ ចេនឡា
                    </div>
                    <div class="text-xs text-slate-500">
                        Chhenla Bank PLC.
                    </div>
                </div>
            </a>
        </div>

        <!-- Clean Login Card -->
        <div class="bg-white/95 backdrop-blur-sm rounded-xl border border-slate-200 shadow-sm overflow-hidden">

            <!-- Subtle Khmer Heritage Top Accent Bar -->
            <div class="h-1.5 w-full bg-gradient-to-r from-[#0B2B40] via-[#0F4C5C] to-[#10B981]"></div>

            <div class="p-6 sm:p-8">
                <!-- Title -->
                <div class="mb-6">
                    <h1 class="text-xl font-bold text-[#0B2B40]">
                        ចូលប្រើប្រាស់គណនី
                    </h1>
                    <p class="mt-1 text-sm text-slate-500">
                        សូមបញ្ចូលអ៊ីមែល និងពាក្យសម្ងាត់របស់អ្នកដើម្បីបន្ត។
                    </p>
                </div>

                <!-- Error Alert -->
                @if(session('error'))
                    <div class="mb-5 rounded-lg bg-red-50 border border-red-200 p-3.5 flex items-center gap-2.5 text-sm text-red-700">
                        <i data-lucide="alert-circle" class="w-4 h-4 text-red-600 shrink-0"></i>
                        <span>{{ session('error') }}</span>
                    </div>
                @endif

                <!-- Login Form -->
                <form action="{{ route('login') }}" method="POST" class="space-y-4">
                    @csrf

                    <!-- Email -->
                    <div>
                        <label for="email" class="block mb-1.5 text-sm font-medium text-slate-700">
                            អាសយដ្ឋានអ៊ីមែល
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none">
                                <i data-lucide="mail" class="w-4 h-4 text-slate-400"></i>
                            </div>
                            <input
                                type="email"
                                name="email"
                                id="email"
                                placeholder="បញ្ចូលអ៊ីមែលរបស់អ្នក"
                                required
                                autocomplete="email"
                                class="w-full pl-10 pr-3.5 py-2.5 text-sm bg-white border border-slate-300 rounded-lg focus:outline-none focus:border-[#0F4C5C] focus:ring-2 focus:ring-[#0F4C5C]/15 transition">
                        </div>
                    </div>

                    <!-- Password -->
                    <div>
                        <div class="flex justify-between items-center mb-1.5">
                            <label for="password" class="text-sm font-medium text-slate-700">
                                ពាក្យសម្ងាត់
                            </label>
                            <a href="#" class="text-xs font-medium text-[#0F4C5C] hover:underline">
                                ភ្លេចពាក្យសម្ងាត់?
                            </a>
                        </div>

                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none">
                                <i data-lucide="lock" class="w-4 h-4 text-slate-400"></i>
                            </div>
                            <input
                                type="password"
                                name="password"
                                id="password"
                                placeholder="បញ្ចូលពាក្យសម្ងាត់របស់អ្នក"
                                required
                                autocomplete="current-password"
                                class="w-full pl-10 pr-10 py-2.5 text-sm bg-white border border-slate-300 rounded-lg focus:outline-none focus:border-[#0F4C5C] focus:ring-2 focus:ring-[#0F4C5C]/15 transition">

                            <button
                                type="button"
                                id="toggle-password"
                                class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-slate-400 hover:text-slate-600 focus:outline-none">
                                <i data-lucide="eye" id="toggle-icon" class="w-4 h-4"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Remember Me -->
                    <div class="flex items-center gap-2 pt-1">
                        <input
                            type="checkbox"
                            name="remember"
                            id="remember"
                            class="w-4 h-4 rounded border-slate-300 text-[#0F4C5C] focus:ring-[#0F4C5C]">
                        <label for="remember" class="text-sm text-slate-600 cursor-pointer select-none">
                            ចងចាំខ្ញុំនៅលើឧបករណ៍នេះ
                        </label>
                    </div>

                    <!-- Submit Button (Soft Green for Positive Action) -->
                    <div class="pt-2">
                        <button
                            type="submit"
                            class="w-full py-2.5 px-4 bg-[#10B981] hover:bg-[#059669] text-white font-semibold text-sm rounded-lg transition flex items-center justify-center gap-2">
                            <span>ចូលប្រើប្រាស់</span>
                            <i data-lucide="arrow-right" class="w-4 h-4"></i>
                        </button>
                    </div>
                </form>

                <!-- Register Link -->
                <div class="mt-6 pt-5 border-t border-slate-100 text-center">
                    <p class="text-sm text-slate-600">
                        មិនទាន់មានគណនីមែនទេ?
                        <a href="{{ route('register') }}" class="font-semibold text-[#0F4C5C] hover:underline ml-1">
                            បង្កើតគណនីថ្មី
                        </a>
                    </p>
                </div>
            </div>

        </div>

        <!-- Simple Footer -->
        <footer class="mt-6 text-center text-xs text-slate-600 flex items-center justify-center gap-1.5">
            <i data-lucide="shield-check" class="w-4 h-4 text-[#10B981]"></i>
            <span>© {{ date('Y') }} ធនាគារ ចេនឡា • ប្រព័ន្ធធនាគារមានសុវត្ថិភាព</span>
        </footer>

    </main>

    <script>
        lucide.createIcons();

        const passwordInput = document.getElementById('password');
        const toggleBtn = document.getElementById('toggle-password');
        const toggleIcon = document.getElementById('toggle-icon');

        toggleBtn.addEventListener('click', () => {
            const isPassword = passwordInput.type === 'password';
            passwordInput.type = isPassword ? 'text' : 'password';
            toggleIcon.setAttribute('data-lucide', isPassword ? 'eye-off' : 'eye');
            lucide.createIcons();
        });
    </script>

</body>
</html>
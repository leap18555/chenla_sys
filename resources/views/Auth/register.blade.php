<!DOCTYPE html>
<html lang="km">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>បង្កើតគណនី | ធនាគារ ចេនឡា</title>

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

        /* Password Strength Bar */
        .password-strength {
            height: 4px;
            border-radius: 10px;
            background: #E2E8F0;
            overflow: hidden;
        }

        .password-strength-bar {
            width: 0%;
            height: 100%;
            border-radius: 10px;
            background: #10B981;
            transition: width .3s ease;
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
         MAIN REGISTRATION CONTENT
    ========================================== -->
    <main class="w-full max-w-lg relative z-10 py-8">

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

        <!-- Clean Registration Card -->
        <div class="bg-white/95 backdrop-blur-sm rounded-xl border border-slate-200 shadow-sm overflow-hidden">

            <!-- Heritage Top Accent Bar -->
            <div class="h-1.5 w-full bg-gradient-to-r from-[#0B2B40] via-[#0F4C5C] to-[#10B981]"></div>

            <div class="p-6 sm:p-8">
                <!-- Title -->
                <div class="mb-6">
                    <h1 class="text-xl font-bold text-[#0B2B40]">
                        បង្កើតគណនីថ្មី
                    </h1>
                    <p class="mt-1 text-sm text-slate-500">
                        សូមបំពេញព័ត៌មានខាងក្រោមដើម្បីចាប់ផ្តើមប្រើប្រាស់ធនាគារឌីជីថល។
                    </p>
                </div>

                <!-- Registration Form -->
                <form action="{{ route('register') }}" method="POST" class="space-y-4">
                    @csrf

                    <!-- Full Name -->
                    <div>
                        <label for="name" class="block mb-1.5 text-sm font-medium text-slate-700">
                            ឈ្មោះពេញ
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none">
                                <i data-lucide="user" class="w-4 h-4 text-slate-400"></i>
                            </div>
                            <input
                                type="text"
                                name="name"
                                id="name"
                                placeholder="បញ្ចូលឈ្មោះពេញរបស់អ្នក"
                                value="{{ old('name') }}"
                                required
                                autocomplete="name"
                                class="w-full pl-10 pr-3.5 py-2.5 text-sm bg-white border border-slate-300 rounded-lg focus:outline-none focus:border-[#0F4C5C] focus:ring-2 focus:ring-[#0F4C5C]/15 transition">
                        </div>
                        @error('name')
                            <p class="mt-1 text-xs font-medium text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email Address -->
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
                                value="{{ old('email') }}"
                                required
                                autocomplete="email"
                                class="w-full pl-10 pr-3.5 py-2.5 text-sm bg-white border border-slate-300 rounded-lg focus:outline-none focus:border-[#0F4C5C] focus:ring-2 focus:ring-[#0F4C5C]/15 transition">
                        </div>
                        @error('email')
                            <p class="mt-1 text-xs font-medium text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password Grid -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <!-- Password -->
                        <div>
                            <label for="password" class="block mb-1.5 text-sm font-medium text-slate-700">
                                ពាក្យសម្ងាត់
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none">
                                    <i data-lucide="lock" class="w-4 h-4 text-slate-400"></i>
                                </div>
                                <input
                                    type="password"
                                    name="password"
                                    id="password"
                                    placeholder="ពាក្យសម្ងាត់"
                                    required
                                    autocomplete="new-password"
                                    class="w-full pl-10 pr-10 py-2.5 text-sm bg-white border border-slate-300 rounded-lg focus:outline-none focus:border-[#0F4C5C] focus:ring-2 focus:ring-[#0F4C5C]/15 transition">
                                <button
                                    type="button"
                                    id="toggle-password"
                                    aria-label="Toggle password visibility"
                                    class="absolute inset-y-0 right-0 pr-3 flex items-center text-slate-400 hover:text-slate-600 focus:outline-none">
                                    <i data-lucide="eye" id="password-icon" class="w-4 h-4"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Confirm Password -->
                        <div>
                            <label for="password_confirmation" class="block mb-1.5 text-sm font-medium text-slate-700">
                                បញ្ជាក់ពាក្យសម្ងាត់
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none">
                                    <i data-lucide="lock-keyhole" class="w-4 h-4 text-slate-400"></i>
                                </div>
                                <input
                                    type="password"
                                    name="password_confirmation"
                                    id="password_confirmation"
                                    placeholder="បញ្ជាក់ពាក្យសម្ងាត់"
                                    required
                                    autocomplete="new-password"
                                    class="w-full pl-10 pr-10 py-2.5 text-sm bg-white border border-slate-300 rounded-lg focus:outline-none focus:border-[#0F4C5C] focus:ring-2 focus:ring-[#0F4C5C]/15 transition">
                                <button
                                    type="button"
                                    id="toggle-confirm"
                                    aria-label="Toggle confirm password visibility"
                                    class="absolute inset-y-0 right-0 pr-3 flex items-center text-slate-400 hover:text-slate-600 focus:outline-none">
                                    <i data-lucide="eye" id="confirm-icon" class="w-4 h-4"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    @error('password')
                        <p class="text-xs font-medium text-red-500">{{ $message }}</p>
                    @enderror

                    <!-- Password Strength -->
                    <div>
                        <div class="flex justify-between items-center mb-1.5">
                            <span class="text-[11px] font-semibold uppercase tracking-wider text-slate-400">កម្រិតពាក្យសម្ងាត់</span>
                            <span id="strength-text" class="text-[11px] font-semibold text-slate-400">—</span>
                        </div>
                        <div class="password-strength">
                            <div id="strength-bar" class="password-strength-bar"></div>
                        </div>
                    </div>

                    <!-- Terms and Conditions -->
                    <div class="flex items-start gap-2.5 pt-1">
                        <input
                            type="checkbox"
                            id="terms"
                            name="terms"
                            required
                            class="w-4 h-4 mt-0.5 rounded border-slate-300 text-[#0F4C5C] focus:ring-[#0F4C5C]">
                        <label for="terms" class="text-xs leading-relaxed text-slate-600 cursor-pointer select-none">
                            ខ្ញុំយល់ព្រមតាម
                            <a href="#" class="font-semibold text-[#0F4C5C] hover:underline">លក្ខខណ្ឌសេវាកម្ម</a>
                            និង
                            <a href="#" class="font-semibold text-[#0F4C5C] hover:underline">គោលការណ៍ឯកជនភាព</a>។
                        </label>
                    </div>

                    <!-- Submit Button -->
                    <div class="pt-2">
                        <button
                            type="submit"
                            class="w-full py-2.5 px-4 bg-[#10B981] hover:bg-[#059669] text-white font-semibold text-sm rounded-lg transition flex items-center justify-center gap-2">
                            <span>បង្កើតគណនីឥឡូវនេះ</span>
                            <i data-lucide="arrow-right" class="w-4 h-4"></i>
                        </button>
                    </div>
                </form>

                <!-- Login Link -->
                <div class="mt-6 pt-5 border-t border-slate-100 text-center">
                    <p class="text-sm text-slate-600">
                        មានគណនីរួចហើយមែនទេ?
                        <a href="{{ route('login') }}" class="font-semibold text-[#0F4C5C] hover:underline ml-1">
                            ចូលប្រើប្រាស់
                        </a>
                    </p>
                </div>
            </div>

        </div>

        <!-- Footer -->
        <footer class="mt-6 text-center text-xs text-slate-600 flex items-center justify-center gap-1.5">
            <i data-lucide="shield-check" class="w-4 h-4 text-[#10B981]"></i>
            <span>© {{ date('Y') }} ធនាគារ ចេនឡា • ប្រព័ន្ធធនាគារមានសុវត្ថិភាព</span>
        </footer>

    </main>

    <!-- Scripts -->
    <script>
        lucide.createIcons();

        function setupPasswordToggle(inputId, buttonId, iconId) {
            const input = document.getElementById(inputId);
            const button = document.getElementById(buttonId);
            const icon = document.getElementById(iconId);

            if (!input || !button || !icon) return;

            button.addEventListener('click', () => {
                const isPassword = input.type === 'password';
                input.type = isPassword ? 'text' : 'password';
                icon.setAttribute('data-lucide', isPassword ? 'eye-off' : 'eye');
                lucide.createIcons();
            });
        }

        setupPasswordToggle('password', 'toggle-password', 'password-icon');
        setupPasswordToggle('password_confirmation', 'toggle-confirm', 'confirm-icon');

        /* Password Strength Checker */
        const password = document.getElementById('password');
        const strengthBar = document.getElementById('strength-bar');
        const strengthText = document.getElementById('strength-text');

        if (password) {
            password.addEventListener('input', () => {
                const value = password.value;
                let strength = 0;

                if (value.length >= 8) strength++;
                if (/[A-Z]/.test(value)) strength++;
                if (/[0-9]/.test(value)) strength++;
                if (/[^A-Za-z0-9]/.test(value)) strength++;

                const widths = ['0%', '25%', '50%', '75%', '100%'];
                const labels = ['—', 'ខ្សោយ', 'មធ្យម', 'ល្អ', 'ខ្លាំង'];

                strengthBar.style.width = widths[strength];
                strengthText.textContent = labels[strength];
            });
        }
    </script>

</body>
</html>
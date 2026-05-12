<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard | MyBank Sunset')</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body { 
            font-family: 'Plus Jakarta Sans', sans-serif;
            /* Updated to a soft, premium mesh-style background */
            background-color: #f8fafc;
            background-image: 
                radial-gradient(at 0% 0%, rgba(255, 95, 109, 0.05) 0px, transparent 50%),
                radial-gradient(at 100% 0%, rgba(255, 195, 113, 0.1) 0px, transparent 50%);
            background-attachment: fixed;
        }

        .sunset-gradient {
            background: linear-gradient(135deg, #FF5F6D 0%, #FFC371 100%);
        }

        .sunset-mesh {
            background-color: #fbda61;
            background-image: linear-gradient(45deg, #fbda61 0%, #ff5acd 100%);
        }

        .sidebar-item-active {
            background: linear-gradient(to right, rgba(255, 95, 109, 0.1), transparent);
            border-left: 4px solid #FF5F6D;
            color: #FF5F6D !important;
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.6);
            border-radius: 24px;
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-thumb { background: #FFC371; border-radius: 10px; }
    </style>
</head>

<body class="text-slate-800">

<div class="flex h-screen overflow-hidden">

    <aside class="w-72 bg-white/90 backdrop-blur-xl border-r border-orange-100/50 flex flex-col p-6 shadow-xl shadow-slate-200/50 z-10">
        <div class="flex items-center gap-3 mb-10 px-2">
            <div class="w-10 h-10 sunset-gradient rounded-2xl flex items-center justify-center shadow-lg shadow-orange-500/30">
                <i class="bi bi-brightness-high-fill text-white text-xl"></i>
            </div>
            <h1 class="text-xl font-bold tracking-tight text-slate-900">
                My<span class="text-[#FF5F6D]">Bank</span>
            </h1>
        </div>

        <nav class="flex-1">
            <p class="text-[11px] uppercase tracking-[0.2em] text-orange-400 font-bold mb-6 px-3">Menu</p>
            <ul class="space-y-2">
                <li>
                    <a href="#" class="sidebar-item-active flex items-center gap-3 py-3 px-4 rounded-xl font-semibold transition-all">
                        <i class="bi bi-grid-fill"></i> Dashboard
                    </a>
                </li>
                <li>
                    <a href="#" class="flex items-center gap-3 py-3 px-4 rounded-xl text-slate-400 hover:text-[#FF5F6D] hover:bg-orange-50 transition-all font-medium">
                        <i class="bi bi-person-heart"></i> Customers
                    </a>
                </li>
                <li>
                    <a href="#" class="flex items-center gap-3 py-3 px-4 rounded-xl text-slate-400 hover:text-[#FF5F6D] hover:bg-orange-50 transition-all font-medium">
                        <i class="bi bi-shield-lock"></i> Staff Space
                    </a>
                </li>
                <li>
                <a href="{{ route("dashboard") }}" class="flex items-center gap-3 py-3 px-4 rounded-xl text-slate-400 hover:text-[#FF5F6D] hover:bg-orange-50 transition-all font-medium">
                       <i class="bi bi-back"></i> Back To Dashboard
                    </a>
                </li>
            </ul>
        </nav>

        <div class="bg-slate-900 rounded-3xl p-5 text-white shadow-xl shadow-slate-300">
            <div class="flex items-center gap-3 mb-4">
                <div class="w-10 h-10 rounded-full sunset-mesh flex items-center justify-center font-bold text-slate-900 border-2 border-white/20">
                    AT
                </div>
                <div>
                    <p class="text-sm font-bold">Heng Bunleap</p>
                    <p class="text-[10px] text-slate-400 uppercase tracking-wider">Main Curator</p>
                </div>
            </div>
            <button class="w-full py-2.5 bg-white/10 hover:bg-white/20 rounded-xl text-xs font-bold transition-all border border-white/10">
                Sign Out
            </button>
        </div>
    </aside>

    <div class="flex-1 flex flex-col overflow-hidden">

        <header class="h-20 bg-white/40 backdrop-blur-md flex items-center justify-between px-10 border-b border-white/20">
            <div class="flex items-center gap-4">
                <div class="bg-gradient-to-r from-orange-100 to-orange-50 text-[#FF5F6D] px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-widest shadow-sm">
                    <span class="relative flex h-2 w-2 inline-block mr-2">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-red-500"></span>
                    </span>
                    Live Overview
                </div>
            </div>

            <div class="flex items-center gap-6">
                <div class="relative group">
                    <i class="bi bi-search absolute left-4 top-1/2 -translate-y-1/2 text-orange-300"></i>
                    <input type="text" placeholder="Search data..." 
                           class="pl-12 pr-6 py-2.5 bg-white/80 border border-orange-100 rounded-2xl text-sm focus:outline-none focus:ring-4 focus:ring-orange-500/10 w-64 transition-all">
                </div>

                <button class="w-11 h-11 flex items-center justify-center bg-white border border-orange-50 text-slate-400 hover:text-[#FF5F6D] rounded-2xl transition-all shadow-sm">
                    <i class="bi bi-bell-fill"></i>
                </button>
            </div>
        </header>

        <main class="flex-1 overflow-y-auto p-10">
            <div class="max-w-7xl mx-auto">
                @yield('content')
            </div>
        </main>

    </div>
</div>

</body>
</html>
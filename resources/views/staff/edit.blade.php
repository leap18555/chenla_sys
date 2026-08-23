<!DOCTYPE html>
<html lang="km">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Edit Staff | {{ $staff->name }} - PAWNDESK</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Bootstrap Icons -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css"
        rel="stylesheet"
    >

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,300..800;1,300..800&family=Noto+Sans+Khmer:wght@300;400;500;600;700&display=swap"
        rel="stylesheet"
    >

    <style>
        * {
            font-family: 'Plus Jakarta Sans', 'Noto Sans Khmer', sans-serif;
        }

        body {
            background-color: #f6f8fa;
        }

        .sidebar-link {
            transition: all 0.2s ease;
            color: #64748b;
        }

        .sidebar-link:hover {
            color: #1e293b;
            background-color: #f1f5f9;
        }

        .sidebar-active {
            background-color: #fef3c7 !important;
            color: #d97706 !important;
            font-weight: 700 !important;
        }

        .dashboard-card {
            background-color: #ffffff;
            border: 1px solid #f1f5f9;
            border-radius: 16px;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.02);
        }

        ::-webkit-scrollbar {
            width: 5px;
            height: 5px;
        }

        ::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 4px;
        }
    </style>
</head>

<body class="text-slate-800 antialiased overflow-hidden">

<div class="flex h-screen overflow-hidden p-3 gap-4">

    <!-- =========================================================
         MOBILE SIDEBAR BACKDROP
    ========================================================== -->
    <div
        id="sidebar-backdrop"
        onclick="toggleSidebar()"
        class="fixed inset-0 bg-slate-900/40 z-20 hidden md:hidden transition-opacity"
    ></div>


    <!-- =========================================================
         SIDEBAR
    ========================================================== -->
    <aside
        id="sidebar"
        class="fixed md:static inset-y-0 left-0 w-72 bg-white flex flex-col justify-between p-4 rounded-2xl border border-slate-100 shadow-sm z-30 transform -translate-x-full md:translate-x-0 transition-transform duration-200 ease-in-out"
    >

        <div class="overflow-y-auto pr-1">

            <!-- Brand -->
            <div class="flex items-center justify-between mb-6 p-2 rounded-xl bg-orange-50/50 border border-orange-100/60">

                <a href="{{ url('/') }}" class="flex items-center gap-3">

                    <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-amber-500 to-orange-400 flex items-center justify-center text-white shadow-sm">
                        <i class="bi bi-gem text-lg"></i>
                    </div>

                    <div>
                        <h1 class="text-sm font-black tracking-wider text-slate-800 uppercase leading-none">
                            PAWNDESK
                        </h1>

                        <p class="text-[10px] text-amber-600 font-semibold tracking-wider mt-0.5">
                            COLLATERAL CORE v2.0
                        </p>
                    </div>

                </a>

                <!-- Mobile Close -->
                <button
                    type="button"
                    onclick="toggleSidebar()"
                    class="md:hidden text-slate-400 hover:text-slate-600"
                >
                    <i class="bi bi-x-lg text-lg"></i>
                </button>

            </div>


            <!-- Navigation -->
            <nav class="space-y-1">

                <ul class="text-xs">

                    <!-- Dashboard -->
                    <li class="mb-1">
                        <a
                            href="{{ url('/') }}"
                            class="sidebar-link flex items-center gap-3 py-2.5 px-3.5 rounded-xl font-medium"
                        >
                            <i class="bi bi-grid-fill text-amber-500"></i>

                            <span>
                                ផ្ទាំងគ្រប់គ្រង
                                <span class="text-slate-400 text-[11px] font-normal">
                                    (Dashboard)
                                </span>
                            </span>
                        </a>
                    </li>


                    <!-- Customers -->
                    <li class="mb-1">
                        <a
                            href="{{ url('/customers') }}"
                            class="sidebar-link flex items-center gap-3 py-2.5 px-3.5 rounded-xl font-medium"
                        >
                            <i class="bi bi-people"></i>

                            <span>
                                អតិថិជន
                                <span class="text-slate-400 text-[11px] font-normal">
                                    (Borrowers)
                                </span>
                            </span>
                        </a>
                    </li>


                    <!-- Loans -->
                    <li class="mb-1">
                        <a
                            href="{{ url('/loans') }}"
                            class="sidebar-link flex items-center gap-3 py-2.5 px-3.5 rounded-xl font-medium"
                        >
                            <i class="bi bi-file-earmark-text"></i>

                            <span>
                                កិច្ចសន្យាបញ្ចាំ
                                <span class="text-slate-400 text-[11px] font-normal">
                                    (Pawn Loans)
                                </span>
                            </span>
                        </a>
                    </li>


                    <!-- Collateral -->
                    <li class="mb-1">
                        <a
                            href="{{ url('/collaterals') }}"
                            class="sidebar-link flex items-center gap-3 py-2.5 px-3.5 rounded-xl font-medium"
                        >
                            <i class="bi bi-box-seam"></i>

                            <span>
                                ទ្រព្យបញ្ចាំ / ឃ្លាំង
                                <span class="text-slate-400 text-[11px] font-normal">
                                    (Collateral Vault)
                                </span>
                            </span>
                        </a>
                    </li>


                    <!-- Repayments -->
                    <li class="mb-1">
                        <a
                            href="{{ url('/repayments') }}"
                            class="sidebar-link flex items-center gap-3 py-2.5 px-3.5 rounded-xl font-medium"
                        >
                            <i class="bi bi-wallet2"></i>

                            <span>
                                ការបង់ប្រាក់ / ការរំលស់
                                <span class="text-slate-400 text-[11px] font-normal">
                                    (Repayments)
                                </span>
                            </span>
                        </a>
                    </li>


                    <!-- Reports -->
                    <li class="mb-1">
                        <a
                            href="{{ url('/reports') }}"
                            class="sidebar-link flex items-center gap-3 py-2.5 px-3.5 rounded-xl font-medium"
                        >
                            <i class="bi bi-journal-richtext"></i>

                            <span>
                                របាយការណ៍ & បោះពុម្ព
                                <span class="text-slate-400 text-[11px] font-normal">
                                    (Reports)
                                </span>
                            </span>
                        </a>
                    </li>


                    <!-- System Logs -->
                    <li class="pt-3 pb-1">
                        <span class="px-3 text-[10px] uppercase font-bold text-slate-400 tracking-wider">
                            សកម្មភាពប្រព័ន្ធ
                        </span>
                    </li>


                    <!-- Audit Logs -->
                    <li class="mb-1">
                        <a
                            href="{{ url('/audit-logs') }}"
                            class="sidebar-link flex items-center gap-3 py-2 px-3.5 rounded-xl font-medium"
                        >
                            <i class="bi bi-card-list"></i>

                            <span>
                                កំណត់ត្រាហេតុ
                                <span class="text-slate-400 text-[11px] font-normal">
                                    (Audit Logs)
                                </span>
                            </span>
                        </a>
                    </li>


                    <!-- System -->
                    <li class="pt-3 pb-1">
                        <span class="px-3 text-[10px] uppercase font-bold text-slate-400 tracking-wider">
                            កំណត់ប្រព័ន្ធ
                        </span>
                    </li>


                    <!-- Staff -->
                    <li class="mb-1">
                        <a
                            href="{{ route('staff.index') }}"
                            class="sidebar-link sidebar-active flex items-center gap-3 py-2 px-3.5 rounded-xl font-medium"
                        >
                            <i class="bi bi-person"></i>

                            <span>
                                អ្នកប្រើប្រាស់
                                <span class="text-slate-400 text-[11px] font-normal">
                                    (Users)
                                </span>
                            </span>
                        </a>
                    </li>


                    <!-- Roles -->
                    <li class="mb-1">
                        <a
                            href="{{ url('/roles') }}"
                            class="sidebar-link flex items-center gap-3 py-2 px-3.5 rounded-xl font-medium"
                        >
                            <i class="bi bi-shield-check"></i>

                            <span>
                                តួនាទី
                                <span class="text-slate-400 text-[11px] font-normal">
                                    (Roles & Permissions)
                                </span>
                            </span>
                        </a>
                    </li>

                </ul>

            </nav>

        </div>


        <!-- =====================================================
             SIDEBAR FOOTER
        ====================================================== -->
        <div class="space-y-3 pt-3 border-t border-slate-100">

            <!-- Status -->
            <div class="flex items-center justify-between text-xs">

                <button
                    type="button"
                    onclick="window.location.reload()"
                    class="flex items-center gap-2 py-1.5 px-3 rounded-lg bg-slate-100 text-slate-600 hover:bg-slate-200 transition-colors font-medium"
                >
                    <i class="bi bi-arrow-clockwise"></i>
                    <span>ផ្ទុកឡើងវិញ</span>
                </button>

                <div class="flex items-center gap-1.5 py-1.5 px-2.5 rounded-lg bg-amber-100 text-amber-700 font-bold text-[11px]">

                    <span class="w-2 h-2 rounded-full bg-amber-500 animate-pulse"></span>

                    <span>VAULT ONLINE</span>

                </div>

            </div>


            <!-- Profile -->
            <div class="flex items-center justify-between p-2 rounded-xl bg-slate-50 border border-slate-100">

                <div class="flex items-center gap-2.5 overflow-hidden">

                    <div class="w-8 h-8 rounded-lg bg-amber-500 flex items-center justify-center font-bold text-xs text-white shrink-0">
                        {{ strtoupper(substr(Auth::user()->name ?? 'AM', 0, 2)) }}
                    </div>

                    <div class="truncate">

                        <h3 class="font-bold text-xs text-slate-800 leading-tight truncate">
                            {{ Auth::user()->name ?? 'Admin Manager' }}
                        </h3>

                        <p class="text-[10px] text-slate-400 truncate">
                            {{ Auth::user()->role ?? 'Super Administrator' }}
                        </p>

                    </div>

                </div>


                <!-- Logout -->
                <form
                    method="POST"
                    action="{{ route('logout') }}"
                    class="inline shrink-0"
                >
                    @csrf

                    <button
                        type="submit"
                        title="Sign Out"
                        class="text-slate-400 hover:text-rose-500 transition-colors p-1"
                    >
                        <i class="bi bi-box-arrow-right text-base"></i>
                    </button>

                </form>

            </div>

        </div>

    </aside>


    <!-- =========================================================
         MAIN WORKSPACE
    ========================================================== -->
    <div class="flex-1 flex flex-col overflow-hidden">


        <!-- =====================================================
             HEADER
        ====================================================== -->
        <header class="h-14 flex items-center justify-between z-10 mb-2 px-1">

            <div class="flex items-center gap-3">

                <!-- Mobile Menu -->
                <button
                    type="button"
                    onclick="toggleSidebar()"
                    class="md:hidden text-slate-600 hover:text-slate-900 p-1"
                >
                    <i class="bi bi-list text-2xl"></i>
                </button>


                <!-- Page Title -->
                <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-lg bg-amber-100/60 border border-amber-200/50 text-amber-800 font-bold text-xs tracking-wider uppercase">

                    <span>STAFF DIRECTORY</span>

                    <span class="text-amber-500">//</span>

                    <span class="font-normal text-slate-700">
                        កែប្រែព័ត៌មានបុគ្គលិក (Edit Staff)
                    </span>

                </div>

            </div>


            <!-- Header Right -->
            <div class="flex items-center gap-2">

                <!-- Search -->
                <div class="relative hidden sm:block">

                    <i class="bi bi-search absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>

                    <input
                        type="text"
                        placeholder="ស្វែងរកកិច្ចសន្យា, អតិថិជន..."
                        class="w-56 lg:w-72 pl-8 pr-4 py-1.5 rounded-xl bg-white border border-slate-200/80 focus:outline-none focus:border-amber-400 text-xs text-slate-800 placeholder:text-slate-400 transition-all shadow-sm"
                    >

                </div>


                <!-- Currency -->
                <div class="relative hidden sm:block">

                    <select
                        class="appearance-none bg-white border border-slate-200/80 text-xs font-semibold text-slate-700 py-1.5 pl-3 pr-7 rounded-xl focus:outline-none focus:border-amber-400 cursor-pointer shadow-sm"
                    >
                        <option value="USD">
                            USD ($)
                        </option>

                        <option value="KHR">
                            KHR (៛)
                        </option>
                    </select>

                    <i class="bi bi-chevron-down absolute right-2.5 top-1/2 -translate-y-1/2 text-[10px] text-slate-400 pointer-events-none"></i>

                </div>


                <!-- Theme -->
                <button
                    type="button"
                    title="Toggle Theme"
                    class="w-8 h-8 rounded-xl bg-white border border-slate-200/80 flex items-center justify-center text-slate-500 hover:bg-slate-50 shadow-sm transition-all"
                >
                    <i class="bi bi-moon text-xs"></i>
                </button>


                <!-- Language -->
                <button
                    type="button"
                    class="flex items-center gap-1 px-2.5 py-1.5 rounded-xl bg-white border border-slate-200/80 text-slate-700 font-semibold text-xs shadow-sm hover:bg-slate-50 transition-colors"
                >
                    <span class="text-[11px]">
                        EN
                    </span>
                </button>


                <!-- Security -->
                <button
                    type="button"
                    class="w-8 h-8 rounded-xl bg-amber-500 text-white flex items-center justify-center shadow-sm hover:bg-amber-600 transition-all"
                >
                    <i class="bi bi-shield-lock-fill text-xs"></i>
                </button>

            </div>

        </header>


        <!-- =====================================================
             CONTENT
        ====================================================== -->
        <main class="flex-1 overflow-y-auto pr-1 pb-6">

            <div class="w-full max-w-3xl mx-auto py-2 px-2 sm:px-4">


                <!-- BACK TO PROFILE -->
                <div class="mb-6">

                    <a
                        href="{{ route('staff.show', $staff->id) }}"
                        class="group inline-flex items-center gap-3 text-slate-500 hover:text-amber-600 transition-all"
                    >

                        <div class="flex items-center justify-center w-9 h-9 rounded-xl bg-white border border-slate-200 shadow-sm group-hover:shadow group-hover:border-amber-200 group-hover:bg-amber-50 transition-all">

                            <i class="bi bi-arrow-left transition-transform group-hover:-translate-x-0.5 text-slate-600 group-hover:text-amber-600"></i>

                        </div>


                        <div class="flex flex-col">

                            <span class="text-[10px] font-bold uppercase tracking-wider text-slate-400 group-hover:text-amber-500 transition-colors">
                                Return to
                            </span>

                            <span class="text-xs font-bold text-slate-700 group-hover:text-amber-600 transition-colors">
                                Staff Profile
                            </span>

                        </div>

                    </a>

                </div>


                <!-- =================================================
                     FORM CARD
                ================================================== -->
                <div class="dashboard-card overflow-hidden">


                    <!-- Form Header -->
                    <div class="p-6 sm:p-8 border-b border-slate-100 bg-white">

                        <div class="flex items-center gap-3.5 mb-1">

                            <div class="w-10 h-10 rounded-xl bg-amber-100/80 border border-amber-200/50 flex items-center justify-center text-amber-600 font-bold">
                                <i class="bi bi-pencil-square text-lg"></i>
                            </div>

                            <div>

                                <h2 class="text-xl sm:text-2xl font-extrabold text-slate-800 tracking-tight">
                                    Update Staff Details
                                </h2>

                                <p class="text-slate-500 text-xs sm:text-sm">

                                    Manage employment records for

                                    <span class="text-amber-600 font-bold">
                                        {{ $staff->name }}
                                    </span>

                                </p>

                            </div>

                        </div>

                    </div>


                    <!-- =================================================
                         EDIT FORM
                    ================================================== -->
                    <form
                        action="{{ route('staff.update', $staff->id) }}"
                        method="POST"
                        class="p-6 sm:p-8 space-y-6 bg-[#fbfcfd]"
                    >

                        @csrf
                        @method('PUT')


                        <!-- Validation Errors -->
                        @if ($errors->any())

                            <div class="p-4 bg-rose-50 border border-rose-200/80 rounded-xl">

                                <div class="flex items-center gap-2 text-rose-700 font-bold text-xs mb-1.5">

                                    <i class="bi bi-exclamation-triangle-fill"></i>

                                    <span>
                                        Please fix the following errors:
                                    </span>

                                </div>


                                <ul class="list-disc list-inside text-xs text-rose-600 font-medium space-y-1">

                                    @foreach ($errors->all() as $error)

                                        <li>
                                            {{ $error }}
                                        </li>

                                    @endforeach

                                </ul>

                            </div>

                        @endif


                        <!-- =================================================
                             NAME + EMAIL
                        ================================================== -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">


                            <!-- Full Name -->
                            <div class="space-y-1.5">

                                <label
                                    for="name"
                                    class="block text-[11px] font-bold uppercase tracking-wider text-slate-500"
                                >
                                    Full Name
                                </label>


                                <div class="relative">

                                    <i class="bi bi-person absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 text-sm"></i>

                                    <input
                                        type="text"
                                        name="name"
                                        id="name"
                                        value="{{ old('name', $staff->name) }}"
                                        required
                                        autocomplete="name"
                                        placeholder="Enter full name"
                                        class="w-full pl-10 pr-4 py-3 rounded-xl bg-white border border-slate-200/90 focus:bg-white focus:ring-2 focus:ring-amber-500/20 focus:border-amber-500 transition-all outline-none text-xs sm:text-sm font-semibold text-slate-800 placeholder-slate-400 shadow-sm"
                                    >

                                </div>


                                @error('name')

                                    <p class="text-rose-500 text-xs font-medium mt-1">
                                        {{ $message }}
                                    </p>

                                @enderror

                            </div>


                            <!-- Email -->
                            <div class="space-y-1.5">

                                <label
                                    for="email"
                                    class="block text-[11px] font-bold uppercase tracking-wider text-slate-500"
                                >
                                    Email Address
                                </label>


                                <div class="relative">

                                    <i class="bi bi-envelope absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 text-sm"></i>

                                    <input
                                        type="email"
                                        name="email"
                                        id="email"
                                        value="{{ old('email', $staff->email) }}"
                                        required
                                        autocomplete="email"
                                        placeholder="staff@example.com"
                                        class="w-full pl-10 pr-4 py-3 rounded-xl bg-white border border-slate-200/90 focus:bg-white focus:ring-2 focus:ring-amber-500/20 focus:border-amber-500 transition-all outline-none text-xs sm:text-sm font-semibold text-slate-800 placeholder-slate-400 shadow-sm"
                                    >

                                </div>


                                @error('email')

                                    <p class="text-rose-500 text-xs font-medium mt-1">
                                        {{ $message }}
                                    </p>

                                @enderror

                            </div>

                        </div>


                        <!-- =================================================
                             ROLE + STATUS
                        ================================================== -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">


                            <!-- Role -->
                            <div class="space-y-1.5">

                                <label
                                    for="role"
                                    class="block text-[11px] font-bold uppercase tracking-wider text-slate-500"
                                >
                                    User Role
                                </label>


                                <div class="relative">

                                    <i class="bi bi-shield-check absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 text-sm"></i>

                                    <select
                                        name="role"
                                        id="role"
                                        required
                                        class="w-full pl-10 pr-10 py-3 rounded-xl bg-white border border-slate-200/90 focus:bg-white focus:ring-2 focus:ring-amber-500/20 focus:border-amber-500 transition-all outline-none text-xs sm:text-sm font-semibold text-slate-800 appearance-none shadow-sm cursor-pointer"
                                    >

                                        <option value="">
                                            -- Select Role --
                                        </option>

                                        <option
                                            value="admin"
                                            {{ old('role', $staff->role) == 'admin' ? 'selected' : '' }}
                                        >
                                            Administrator
                                        </option>

                                        <option
                                            value="manager"
                                            {{ old('role', $staff->role) == 'manager' ? 'selected' : '' }}
                                        >
                                            Manager
                                        </option>

                                        <option
                                            value="staff"
                                            {{ old('role', $staff->role) == 'staff' ? 'selected' : '' }}
                                        >
                                            Staff
                                        </option>

                                        <option
                                            value="cashier"
                                            {{ old('role', $staff->role) == 'cashier' ? 'selected' : '' }}
                                        >
                                            Cashier
                                        </option>

                                    </select>


                                    <i class="bi bi-chevron-down absolute right-4 top-1/2 -translate-y-1/2 text-slate-400 pointer-events-none text-xs"></i>

                                </div>


                                @error('role')

                                    <p class="text-rose-500 text-xs font-medium mt-1">
                                        {{ $message }}
                                    </p>

                                @enderror

                            </div>


                            <!-- Status -->
                            <div class="space-y-1.5">

                                <label
                                    for="status"
                                    class="block text-[11px] font-bold uppercase tracking-wider text-slate-500"
                                >
                                    Account Status
                                </label>


                                <div class="relative">

                                    <i class="bi bi-toggle-on absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 text-sm"></i>

                                    <select
                                        name="status"
                                        id="status"
                                        required
                                        class="w-full pl-10 pr-10 py-3 rounded-xl bg-white border border-slate-200/90 focus:bg-white focus:ring-2 focus:ring-amber-500/20 focus:border-amber-500 transition-all outline-none text-xs sm:text-sm font-semibold text-slate-800 appearance-none shadow-sm cursor-pointer"
                                    >

                                        <option
                                            value="active"
                                            {{ old('status', $staff->status) == 'active' ? 'selected' : '' }}
                                        >
                                            Active
                                        </option>

                                        <option
                                            value="inactive"
                                            {{ old('status', $staff->status) == 'inactive' ? 'selected' : '' }}
                                        >
                                            Inactive
                                        </option>

                                    </select>


                                    <i class="bi bi-chevron-down absolute right-4 top-1/2 -translate-y-1/2 text-slate-400 pointer-events-none text-xs"></i>

                                </div>


                                @error('status')

                                    <p class="text-rose-500 text-xs font-medium mt-1">
                                        {{ $message }}
                                    </p>

                                @enderror

                            </div>

                        </div>


                        <!-- =================================================
                             POSITION + DEPARTMENT
                        ================================================== -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">


                            <!-- Position -->
                            <div class="space-y-1.5">

                                <label
                                    for="position"
                                    class="block text-[11px] font-bold uppercase tracking-wider text-slate-500"
                                >
                                    Job Title
                                </label>


                                <div class="relative">

                                    <i class="bi bi-briefcase absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 text-sm"></i>

                                    <input
                                        type="text"
                                        name="position"
                                        id="position"
                                        value="{{ old('position', $staff->position) }}"
                                        required
                                        placeholder="e.g. Loan Officer"
                                        class="w-full pl-10 pr-4 py-3 rounded-xl bg-white border border-slate-200/90 focus:bg-white focus:ring-2 focus:ring-amber-500/20 focus:border-amber-500 transition-all outline-none text-xs sm:text-sm font-semibold text-slate-800 placeholder-slate-400 shadow-sm"
                                    >

                                </div>


                                @error('position')

                                    <p class="text-rose-500 text-xs font-medium mt-1">
                                        {{ $message }}
                                    </p>

                                @enderror

                            </div>


                            <!-- Department -->
                            <div class="space-y-1.5">

                                <label
                                    for="department"
                                    class="block text-[11px] font-bold uppercase tracking-wider text-slate-500"
                                >
                                    Department
                                </label>


                                <div class="relative">

                                    <i class="bi bi-building absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 text-sm"></i>

                                    <input
                                        type="text"
                                        name="department"
                                        id="department"
                                        value="{{ old('department', $staff->department) }}"
                                        required
                                        placeholder="e.g. Loan Department"
                                        class="w-full pl-10 pr-4 py-3 rounded-xl bg-white border border-slate-200/90 focus:bg-white focus:ring-2 focus:ring-amber-500/20 focus:border-amber-500 transition-all outline-none text-xs sm:text-sm font-semibold text-slate-800 placeholder-slate-400 shadow-sm"
                                    >

                                </div>


                                @error('department')

                                    <p class="text-rose-500 text-xs font-medium mt-1">
                                        {{ $message }}
                                    </p>

                                @enderror

                            </div>

                        </div>


                        <!-- =================================================
                             CURRENT USER INFORMATION
                        ================================================== -->
                        <div class="p-4 rounded-xl bg-amber-50 border border-amber-100">

                            <div class="flex items-start gap-3">

                                <div class="w-9 h-9 rounded-lg bg-amber-100 flex items-center justify-center text-amber-600 shrink-0">

                                    <i class="bi bi-info-circle-fill"></i>

                                </div>


                                <div>

                                    <h4 class="text-xs font-bold text-amber-800">
                                        Staff Account Information
                                    </h4>

                                    <p class="text-[11px] text-amber-700 mt-1 leading-relaxed">

                                        Email and role are used for staff authentication
                                        and authorization within the PAWNDESK system.

                                    </p>

                                </div>

                            </div>

                        </div>


                        <!-- =================================================
                             FORM ACTIONS
                        ================================================== -->
                        <div class="flex flex-col sm:flex-row items-center justify-between gap-4 pt-6 border-t border-slate-200/70">


                            <!-- Cancel -->
                            <a
                                href="{{ route('staff.show', $staff->id) }}"
                                class="w-full sm:w-auto flex items-center justify-center gap-2 px-5 py-2.5 rounded-xl border border-slate-200 bg-white text-slate-600 font-bold text-xs hover:bg-slate-50 hover:text-slate-800 transition-all shadow-sm"
                            >

                                <i class="bi bi-arrow-left"></i>

                                Return without saving

                            </a>


                            <!-- Update -->
                            <button
                                type="submit"
                                id="updateButton"
                                class="w-full sm:w-auto px-8 py-2.5 bg-amber-500 hover:bg-amber-600 text-white rounded-xl font-bold text-xs shadow-sm transition-all active:scale-95 flex items-center justify-center gap-2"
                            >

                                <i class="bi bi-cloud-arrow-up-fill"></i>

                                Update Profile

                            </button>

                        </div>

                    </form>

                </div>


                <!-- Footer -->
                <p class="text-center mt-6 text-slate-400 text-xs font-medium">

                    PAWNDESK System Registry &bull; Authorization level required.

                </p>

            </div>

        </main>

    </div>

</div>


<!-- =============================================================
     JAVASCRIPT
============================================================= -->
<script>

    /* =========================================================
       Sidebar Active Route Highlighter
    ========================================================== */

    document.addEventListener("DOMContentLoaded", function () {

        const currentPath = window.location.pathname;

        const menuLinks =
            document.querySelectorAll("nav .sidebar-link");


        menuLinks.forEach(function (link) {

            link.classList.remove("sidebar-active");

            const linkHref =
                link.getAttribute("href");


            if (linkHref && linkHref !== "#") {

                try {

                    const linkPath =
                        new URL(
                            linkHref,
                            window.location.origin
                        ).pathname;


                    if (
                        currentPath === linkPath ||
                        (
                            linkPath !== "/" &&
                            currentPath.startsWith(linkPath)
                        )
                    ) {

                        link.classList.add("sidebar-active");

                    }

                } catch (error) {

                    if (currentPath === linkHref) {

                        link.classList.add("sidebar-active");

                    }

                }

            }

        });

    });


    /* =========================================================
       Mobile Sidebar Toggle
    ========================================================== */

    function toggleSidebar() {

        const sidebar =
            document.getElementById("sidebar");

        const backdrop =
            document.getElementById("sidebar-backdrop");


        sidebar.classList.toggle(
            "-translate-x-full"
        );

        backdrop.classList.toggle(
            "hidden"
        );

    }


    /* =========================================================
       Prevent Double Submit
    ========================================================== */

    const editForm =
        document.querySelector(
            'form[action*="/staff/"]'
        );


    if (editForm) {

        editForm.addEventListener(
            "submit",
            function () {

                const submitButton =
                    document.getElementById(
                        "updateButton"
                    );


                if (submitButton) {

                    submitButton.disabled = true;

                    submitButton.classList.add(
                        "opacity-70",
                        "cursor-not-allowed"
                    );


                    submitButton.innerHTML = `
                        <i class="bi bi-arrow-repeat animate-spin"></i>
                        Updating...
                    `;

                }

            }
        );

    }

</script>

</body>

</html>
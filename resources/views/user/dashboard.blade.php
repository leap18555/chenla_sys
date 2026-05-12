<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Adventure Bank | Modern Dashboard</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <script src="https://unpkg.com/lucide@latest"></script>
  <style>
    body { font-family: 'Inter', sans-serif; }
    .glass { background: rgba(255, 255, 255, 0.7); backdrop-filter: blur(10px); }
  </style>
</head>
<body class="bg-[#F8FAFC] text-slate-900 flex h-screen overflow-hidden">

  <aside class="w-72 bg-white border-r border-slate-200 flex flex-col hidden lg:flex">
    <div class="p-8">
      <div class="flex items-center gap-3 px-2">
        <div class="w-10 h-10 bg-indigo-600 rounded-xl flex items-center justify-center text-white shadow-indigo-200 shadow-lg">
          <i data-lucide="landmark"></i>
        </div>
        <h2 class="text-xl font-bold tracking-tight text-slate-800">Chhenla BANK<span class="text-indigo-600">.</span></h2>
      </div>
    </div>

    <nav class="flex-1 px-4 space-y-1">
      <p class="px-4 text-[10px] font-bold uppercase tracking-widest text-slate-400 mb-4">Main Menu</p>
      <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-xl bg-indigo-50 text-indigo-600 font-semibold transition-all">
        <i data-lucide="layout-dashboard" class="w-5 h-5"></i> Dashboard
      </a>
      <a href="{{ route('customers.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-500 hover:bg-slate-50 hover:text-slate-900 transition-all">
        <i data-lucide="users" class="w-5 h-5"></i> Customers
      </a>
      <a href="{{ route('loans.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-500 hover:bg-slate-50 hover:text-slate-900 transition-all">
        <i data-lucide="wallet" class="w-5 h-5"></i> Loans
      </a>
      <a href="{{ route("deposits.index") }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-500 hover:bg-slate-50 hover:text-slate-900 transition-all">
        <i data-lucide="piggy-bank" class="w-5 h-5"></i> Deposits
      </a>
      <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-500 hover:bg-slate-50 hover:text-slate-900 transition-all">
        <i data-lucide="repeat" class="w-5 h-5"></i> Transactions
      </a>
       <a href="{{ route('staff.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-500 hover:bg-slate-50 hover:text-slate-900 transition-all">
        <i data-lucide="user-cog" class="w-5 h-5"></i> Staff
      </a>
    </nav>

    <div class="p-4 mt-auto border-t border-slate-100">
      <button class="w-full flex items-center justify-center gap-2 bg-slate-900 text-white font-medium py-3 rounded-xl hover:bg-slate-800 transition-all shadow-md">
        <i data-lucide="log-out" class="w-4 h-4"></i> Logout
      </button>
    </div>
  </aside>

  <main class="flex-1 overflow-y-auto custom-scrollbar">
    
    <header class="sticky top-0 z-10 glass border-b border-slate-200 px-8 py-4 flex justify-between items-center">
      <div>
        <h1 class="text-2xl font-bold text-slate-900">Good Morning, Alex</h1>
        <p class="text-sm text-slate-500 font-medium">Here's what's happening today.</p>
      </div>
      
      <div class="flex items-center gap-4">
        <button class="p-2 text-slate-400 hover:bg-slate-100 rounded-full transition-all">
          <i data-lucide="bell" class="w-5 h-5"></i>
        </button>
        <div class="h-8 w-px bg-slate-200 mx-2"></div>
        <div class="flex items-center gap-3 pl-2">
          <div class="text-right hidden sm:block">
            <p class="text-sm font-bold text-slate-800 leading-none">{{ auth()->user()->name ?? 'Administrator' }}</p>
            <p class="text-xs text-slate-500 mt-1">Super Admin</p>
          </div>
          <div class="w-10 h-10 bg-slate-200 rounded-full border-2 border-white shadow-sm overflow-hidden">
            <img src="https://ui-avatars.com/api/?name=Admin&background=6366f1&color=fff" alt="Avatar">
          </div>
        </div>
      </div>
    </header>

    <div class="p-8 max-w-7xl mx-auto">
      
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
        
        <div class="bg-white p-6 rounded-3xl border border-slate-200 shadow-sm hover:shadow-md transition-all group">
          <div class="flex justify-between items-start mb-4">
            <div class="p-3 bg-indigo-50 text-indigo-600 rounded-2xl group-hover:bg-indigo-600 group-hover:text-white transition-colors">
              <i data-lucide="users" class="w-6 h-6"></i>
            </div>
            <span class="text-xs font-bold text-emerald-500 bg-emerald-50 px-2 py-1 rounded-lg">+12.5%</span>
          </div>
          <h3 class="text-slate-500 text-sm font-medium uppercase tracking-wider">Total Customers</h3>
          <p class="text-3xl font-bold text-slate-900 mt-1">{{ $totalCustomers ?? '2,450' }}</p>
        </div>

        <div class="bg-white p-6 rounded-3xl border border-slate-200 shadow-sm hover:shadow-md transition-all group">
          <div class="flex justify-between items-start mb-4">
            <div class="p-3 bg-emerald-50 text-emerald-600 rounded-2xl group-hover:bg-emerald-600 group-hover:text-white transition-colors">
              <i data-lucide="trending-up" class="w-6 h-6"></i>
            </div>
            <span class="text-xs font-bold text-emerald-500 bg-emerald-50 px-2 py-1 rounded-lg">+4.2%</span>
          </div>
          <h3 class="text-slate-500 text-sm font-medium uppercase tracking-wider">Active Loans</h3>
          <p class="text-3xl font-bold text-slate-900 mt-1">{{ $totalLoans ?? '152' }}</p>
        </div>

        <div class="bg-white p-6 rounded-3xl border border-slate-200 shadow-sm hover:shadow-md transition-all group">
          <div class="flex justify-between items-start mb-4">
            <div class="p-3 bg-amber-50 text-amber-600 rounded-2xl group-hover:bg-amber-600 group-hover:text-white transition-colors">
              <i data-lucide="pie-chart" class="w-6 h-6"></i>
            </div>
            <span class="text-xs font-bold text-rose-500 bg-rose-50 px-2 py-1 rounded-lg">-1.4%</span>
          </div>
          <h3 class="text-slate-500 text-sm font-medium uppercase tracking-wider">Total Deposits</h3>
          <p class="text-3xl font-bold text-slate-900 mt-1">${{ $totalDeposits ?? '1.2M' }}</p>
        </div>

        <div class="bg-white p-6 rounded-3xl border border-slate-200 shadow-sm hover:shadow-md transition-all group">
          <div class="flex justify-between items-start mb-4">
            <div class="p-3 bg-purple-50 text-purple-600 rounded-2xl group-hover:bg-purple-600 group-hover:text-white transition-colors">
              <i data-lucide="activity" class="w-6 h-6"></i>
            </div>
            <span class="text-xs font-bold text-emerald-500 bg-emerald-50 px-2 py-1 rounded-lg">+18%</span>
          </div>
          <h3 class="text-slate-500 text-sm font-medium uppercase tracking-wider">Transactions</h3>
          <p class="text-3xl font-bold text-slate-900 mt-1">{{ $totalTransactions ?? '842' }}</p>
        </div>

      </div>

      <h2 class="text-lg font-bold text-slate-800 mb-6 flex items-center gap-2">
        <i data-lucide="zap" class="w-5 h-5 text-amber-500"></i> Quick Actions
      </h2>
      <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
        <button class="flex flex-col items-center justify-center p-6 bg-white border border-slate-200 rounded-3xl hover:border-indigo-600 hover:text-indigo-600 transition-all shadow-sm group">
          <div class="w-12 h-12 bg-slate-50 rounded-full flex items-center justify-center mb-3 group-hover:bg-indigo-50 transition-colors">
            <i data-lucide="user-plus" class="w-6 h-6 text-slate-600 group-hover:text-indigo-600"></i>
          </div>
          <span class="font-semibold text-sm">Add Customer</span>
        </button>

        <button class="flex flex-col items-center justify-center p-6 bg-white border border-slate-200 rounded-3xl hover:border-emerald-600 hover:text-emerald-600 transition-all shadow-sm group">
          <div class="w-12 h-12 bg-slate-50 rounded-full flex items-center justify-center mb-3 group-hover:bg-emerald-50 transition-colors">
            <i data-lucide="file-text" class="w-6 h-6 text-slate-600 group-hover:text-emerald-600"></i>
          </div>
          <span class="font-semibold text-sm">New Loan</span>
        </button>

        <button class="flex flex-col items-center justify-center p-6 bg-white border border-slate-200 rounded-3xl hover:border-amber-600 hover:text-amber-600 transition-all shadow-sm group">
          <div class="w-12 h-12 bg-slate-50 rounded-full flex items-center justify-center mb-3 group-hover:bg-amber-50 transition-colors">
            <i data-lucide="download" class="w-6 h-6 text-slate-600 group-hover:text-amber-600"></i>
          </div>
          <span class="font-semibold text-sm">Deposit</span>
        </button>

        <button class="flex flex-col items-center justify-center p-6 bg-white border border-slate-200 rounded-3xl hover:border-purple-600 hover:text-purple-600 transition-all shadow-sm group">
          <div class="w-12 h-12 bg-slate-50 rounded-full flex items-center justify-center mb-3 group-hover:bg-purple-50 transition-colors">
            <i data-lucide="send" class="w-6 h-6 text-slate-600 group-hover:text-purple-600"></i>
          </div>
          <span class="font-semibold text-sm">Transfer</span>
        </button>
      </div>

    </div>
  </main>

  <script>
    // Initialize Lucide icons
    lucide.createIcons();
  </script>
</body>
</html>
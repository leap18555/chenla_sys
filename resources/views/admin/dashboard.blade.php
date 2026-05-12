<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Adventure Bank | Modern Dark Dashboard</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <script src="https://unpkg.com/lucide@latest"></script>
  <style>
    body { font-family: 'Plus Jakarta Sans', sans-serif; }
    .glass-dark { 
        background: rgba(9, 9, 11, 0.8); 
        backdrop-filter: blur(12px); 
        border-bottom: 1px solid rgba(39, 39, 42, 1);
    }
    .card-gradient {
        background: linear-gradient(145deg, #18181b 0%, #09090b 100%);
    }
    .accent-glow {
        box-shadow: 0 0 20px rgba(16, 185, 129, 0.1);
    }
  </style>
</head>
<body class="bg-[#09090B] text-zinc-400 flex h-screen overflow-hidden">

  <aside class="w-72 bg-[#09090B] border-r border-zinc-800 flex flex-col hidden lg:flex">
    <div class="p-8">
      <div class="flex items-center gap-3 px-2">
        <div class="w-10 h-10 bg-emerald-500 rounded-xl flex items-center justify-center text-black shadow-emerald-500/20 shadow-xl">
          <i data-lucide="landmark" class="w-6 h-6"></i>
        </div>
        <h2 class="text-xl font-bold tracking-tight text-white uppercase">Chhenla<span class="text-emerald-500">.</span></h2>
      </div>
    </div>

    <nav class="flex-1 px-4 space-y-2">
      <p class="px-4 text-[10px] font-bold uppercase tracking-[0.2em] text-zinc-500 mb-4">Core Systems</p>
      
      <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-xl bg-zinc-800/50 text-emerald-400 font-medium transition-all border border-zinc-700/50">
        <i data-lucide="layout-dashboard" class="w-5 h-5"></i> Dashboard
      </a>
      <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-xl text-zinc-400 hover:bg-zinc-800 hover:text-white transition-all">
        <i data-lucide="users" class="w-5 h-5"></i> Customers
      </a>
      <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-xl text-zinc-400 hover:bg-zinc-800 hover:text-white transition-all">
        <i data-lucide="wallet" class="w-5 h-5"></i> Loans
      </a>
      <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-xl text-zinc-400 hover:bg-zinc-800 hover:text-white transition-all">
        <i data-lucide="repeat" class="w-5 h-5"></i> Transactions
      </a>
    </nav>

    <div class="p-6 mt-auto border-t border-zinc-800">
      <button class="w-full flex items-center justify-center gap-2 bg-zinc-100 text-zinc-900 font-bold py-3 rounded-xl hover:bg-white transition-all">
        <i data-lucide="log-out" class="w-4 h-4"></i> Logout
      </button>
    </div>
  </aside>

  <main class="flex-1 overflow-y-auto bg-[#09090B]">
    
    <header class="sticky top-0 z-10 glass-dark px-8 py-5 flex justify-between items-center">
      <div>
        <h1 class="text-xl font-semibold text-white">System Overview</h1>
        <p class="text-xs text-zinc-500 mt-0.5">Real-time banking metrics</p>
      </div>
      
      <div class="flex items-center gap-4">
        <button class="relative p-2.5 text-zinc-400 bg-zinc-900 border border-zinc-800 rounded-xl hover:text-white transition-all">
          <i data-lucide="bell" class="w-5 h-5"></i>
          <span class="absolute top-2 right-2 w-2 h-2 bg-emerald-500 rounded-full border-2 border-zinc-900"></span>
        </button>
        <div class="flex items-center gap-3 pl-2">
          <div class="text-right hidden sm:block">
            <p class="text-sm font-bold text-white leading-none">Alex Rivera</p>
            <p class="text-[10px] text-emerald-500 font-bold uppercase mt-1 tracking-tighter">System Authority</p>
          </div>
          <div class="w-10 h-10 rounded-xl border border-zinc-700 p-0.5 bg-zinc-800">
            <img src="https://ui-avatars.com/api/?name=Alex&background=10b981&color=000" class="rounded-lg" alt="Avatar">
          </div>
        </div>
      </div>
    </header>

    <div class="p-8 max-w-7xl mx-auto">
      
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
        
        <div class="card-gradient p-6 rounded-3xl border border-zinc-800 hover:border-zinc-700 transition-all group accent-glow">
          <div class="flex justify-between items-start mb-4">
            <div class="p-3 bg-zinc-900 text-emerald-500 rounded-2xl border border-zinc-800">
              <i data-lucide="users" class="w-6 h-6"></i>
            </div>
            <span class="text-[10px] font-bold text-emerald-500 border border-emerald-500/20 bg-emerald-500/10 px-2 py-1 rounded-full">+12.5%</span>
          </div>
          <h3 class="text-zinc-500 text-xs font-bold uppercase tracking-widest">Total Customers</h3>
          <p class="text-3xl font-bold text-white mt-2">2,450</p>
        </div>

        <div class="card-gradient p-6 rounded-3xl border border-zinc-800 hover:border-zinc-700 transition-all group">
          <div class="flex justify-between items-start mb-4">
            <div class="p-3 bg-zinc-900 text-zinc-400 rounded-2xl border border-zinc-800">
              <i data-lucide="trending-up" class="w-6 h-6"></i>
            </div>
          </div>
          <h3 class="text-zinc-500 text-xs font-bold uppercase tracking-widest">Active Loans</h3>
          <p class="text-3xl font-bold text-white mt-2">152</p>
        </div>

        <div class="card-gradient p-6 rounded-3xl border border-zinc-800 hover:border-zinc-700 transition-all group">
          <div class="flex justify-between items-start mb-4">
            <div class="p-3 bg-zinc-900 text-zinc-400 rounded-2xl border border-zinc-800">
              <i data-lucide="pie-chart" class="w-6 h-6"></i>
            </div>
          </div>
          <h3 class="text-zinc-500 text-xs font-bold uppercase tracking-widest">Total Deposits</h3>
          <p class="text-3xl font-bold text-white mt-2">$1.2M</p>
        </div>

        <div class="card-gradient p-6 rounded-3xl border border-zinc-800 hover:border-zinc-700 transition-all group">
          <div class="flex justify-between items-start mb-4">
            <div class="p-3 bg-zinc-900 text-zinc-400 rounded-2xl border border-zinc-800">
              <i data-lucide="activity" class="w-6 h-6"></i>
            </div>
            <span class="text-[10px] font-bold text-emerald-500 border border-emerald-500/20 bg-emerald-500/10 px-2 py-1 rounded-full">Active</span>
          </div>
          <h3 class="text-zinc-500 text-xs font-bold uppercase tracking-widest">Transactions</h3>
          <p class="text-3xl font-bold text-white mt-2">842</p>
        </div>
      </div>

      <h2 class="text-sm font-bold text-zinc-200 mb-6 flex items-center gap-2 uppercase tracking-widest">
        <span class="w-2 h-2 bg-emerald-500 rounded-full animate-pulse"></span> Terminal Actions
      </h2>
      <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
        <button class="flex flex-col items-center justify-center p-6 bg-zinc-900 border border-zinc-800 rounded-3xl hover:border-emerald-500/50 hover:bg-zinc-800/50 transition-all group">
          <div class="w-12 h-12 bg-zinc-800 rounded-full flex items-center justify-center mb-3 group-hover:scale-110 transition-transform">
            <i data-lucide="user-plus" class="w-6 h-6 text-emerald-500"></i>
          </div>
          <span class="font-medium text-sm text-zinc-300">Add Customer</span>
        </button>

        <button class="flex flex-col items-center justify-center p-6 bg-zinc-900 border border-zinc-800 rounded-3xl hover:border-emerald-500/50 hover:bg-zinc-800/50 transition-all group">
          <div class="w-12 h-12 bg-zinc-800 rounded-full flex items-center justify-center mb-3 group-hover:scale-110 transition-transform">
            <i data-lucide="file-text" class="w-6 h-6 text-emerald-500"></i>
          </div>
          <span class="font-medium text-sm text-zinc-300">New Loan</span>
        </button>

        <button class="flex flex-col items-center justify-center p-6 bg-zinc-900 border border-zinc-800 rounded-3xl hover:border-emerald-500/50 hover:bg-zinc-800/50 transition-all group">
          <div class="w-12 h-12 bg-zinc-800 rounded-full flex items-center justify-center mb-3 group-hover:scale-110 transition-transform">
            <i data-lucide="download" class="w-6 h-6 text-emerald-500"></i>
          </div>
          <span class="font-medium text-sm text-zinc-300">Deposit</span>
        </button>

        <button class="flex flex-col items-center justify-center p-6 bg-zinc-900 border border-zinc-800 rounded-3xl hover:border-emerald-500/50 hover:bg-zinc-800/50 transition-all group">
          <div class="w-12 h-12 bg-zinc-800 rounded-full flex items-center justify-center mb-3 group-hover:scale-110 transition-transform">
            <i data-lucide="send" class="w-6 h-6 text-emerald-500"></i>
          </div>
          <span class="font-medium text-sm text-zinc-300">Transfer</span>
        </button>
      </div>

    </div>
  </main>

  <script>
    lucide.createIcons();
  </script>
</body>
</html>
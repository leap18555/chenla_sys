@extends('layouts.master')

@section('content')
<div class="space-y-10 animate-in fade-in duration-700">

    <div class="flex flex-col md:flex-row md:items-end justify-between gap-6">
        <div>
            <h1 class="text-4xl font-extrabold text-slate-900 tracking-tight">
                Customer Management
            </h1>
            <p class="text-slate-500 text-base mt-2">
                View, organize, and manage your customers efficiently.
            </p>
        </div>

        <div class="flex flex-wrap items-center gap-3">
            <a href="{{ route('dashboard') }}"
               class="inline-flex items-center gap-2 px-6 py-3
                      rounded-2xl bg-white border border-slate-200 text-slate-600 text-sm font-bold 
                      shadow-sm hover:bg-slate-50 hover:text-slate-900 transition-all active:scale-95">
               <i class="bi bi-arrow-bar-left"></i>
                Dashboard
            </a>

            <a href="{{ route('customers.create') }}"
               class="inline-flex items-center gap-2 px-6 py-3
                      rounded-2xl sunset-gradient text-white text-sm font-bold 
                      shadow-lg shadow-orange-500/30 hover:scale-105 transition-all active:scale-95">
                <i class="bi bi-person-plus-fill"></i>
                New Customer
            </a>
        </div>
    </div>

    <div class="max-w-xs">
        <div class="glass-card rounded-[2rem] p-6 shadow-sm border-orange-100">
            <div class="flex items-center gap-4">
                <div class="w-14 h-14 rounded-2xl sunset-gradient flex items-center justify-center text-white shadow-inner">
                    <i class="bi bi-people-fill text-2xl"></i>
                </div>
                <div>
                    <p class="text-[11px] text-orange-400 uppercase font-bold tracking-widest">
                        Total Customers
                    </p>
                    <h3 class="text-3xl font-black text-slate-900">
                        {{ count($customers) }}
                    </h3>
                </div>
            </div>
        </div>
    </div>

    <div class="rounded-[2.5rem] bg-white border border-orange-50 shadow-xl shadow-orange-900/5 overflow-hidden">
        <table class="w-full">
            <thead class="bg-orange-50/50 border-b border-orange-100">
                <tr>
                    <th class="px-8 py-5 text-left text-[11px] font-bold text-orange-400 uppercase tracking-[0.15em]">
                        Customer Info
                    </th>
                    <th class="px-8 py-5 text-left text-[11px] font-bold text-orange-400 uppercase tracking-[0.15em]">
                        Contact Details
                    </th>
                    <th class="px-8 py-5 text-left text-[11px] font-bold text-orange-400 uppercase tracking-[0.15em]">
                        Status
                    </th>
                    <th class="px-8 py-5 text-right text-[11px] font-bold text-orange-400 uppercase tracking-[0.15em]">
                        Actions
                    </th>
                </tr>
            </thead>

            <tbody class="divide-y divide-orange-50">
                @forelse($customers as $customer)
                <tr class="hover:bg-orange-50/30 transition-colors group">
                    <td class="px-8 py-6">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-2xl sunset-mesh
                                        flex items-center justify-center
                                        text-white font-bold text-base shadow-sm border-2 border-white">
                                {{ strtoupper(substr($customer->name, 0, 2)) }}
                            </div>
                            <div>
                                <p class="font-bold text-slate-800 text-lg">
                                    {{ $customer->name }}
                                </p>
                                <p class="text-xs text-slate-400 font-medium">
                                    UID: #{{ $customer->id }}
                                </p>
                            </div>
                        </div>
                    </td>

                    <td class="px-8 py-6">
                        <p class="text-sm font-semibold text-slate-600 flex items-center gap-2">
                            <i class="bi bi-envelope text-orange-300"></i> {{ $customer->email }}
                        </p>
                        <p class="text-xs text-slate-400 mt-1 flex items-center gap-2">
                            <i class="bi bi-telephone text-orange-300"></i> {{ $customer->phone }}
                        </p>
                    </td>

                    <td class="px-8 py-6">
                        <span class="inline-flex items-center px-4 py-1.5 rounded-xl
                                     text-[10px] font-black uppercase tracking-widest
                                     bg-emerald-50 text-emerald-600 border border-emerald-100">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 mr-2 animate-pulse"></span>
                            Active
                        </span>
                    </td>

                    <td class="px-8 py-6 text-right">
                        <div class="flex justify-end gap-3">
                            <a href="{{ route('customers.edit', $customer->id) }}"
                               class="w-10 h-10 flex items-center justify-center rounded-xl bg-slate-50 text-slate-400 hover:bg-[#FF5F6D] hover:text-white transition-all shadow-sm">
                                <i class="bi bi-pencil-square"></i>
                            </a>
                            <a href="{{ route('customers.show', $customer->id) }}"
                               class="w-10 h-10 flex items-center justify-center rounded-xl bg-slate-50 text-slate-400 hover:bg-[#FF5F6D] hover:text-white transition-all shadow-sm">
                              <i class="bi bi-person-vcard"></i>
                            </a>

                            <form method="POST" action="{{ route('customers.destroy', $customer->id) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        onclick="return confirm('Delete this customer?')"
                                        class="w-10 h-10 flex items-center justify-center rounded-xl bg-orange-50 text-[#FF5F6D] hover:bg-[#FF5F6D] hover:text-white transition-all shadow-sm">
                                    <i class="bi bi-trash3-fill"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="py-32 text-center">
                        <div class="flex flex-col items-center">
                            <div class="w-20 h-20 bg-orange-50 rounded-full flex items-center justify-center text-orange-200 mb-4">
                                <i class="bi bi-people text-4xl"></i>
                            </div>
                            <p class="text-slate-400 font-bold text-lg">No customers found</p>
                            <p class="text-slate-300 text-sm">Start by adding your first customer to the system.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
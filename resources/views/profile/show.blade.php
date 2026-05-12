@extends('layouts.master')

@section('content')
<div class="container mx-auto p-6">
    @if(session('success'))
        <div class="alert alert-success mb-4">{{ session('success') }}</div>
    @endif

    <div class="max-w-3xl mx-auto bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden">
        <div class="p-6 flex items-center gap-6">
            <div class="w-28 h-28 rounded-full overflow-hidden">
                <img src="{{ $user->avatar_url }}" alt="avatar" class="w-full h-full object-cover">
            </div>

            <div class="flex-1">
                <h2 class="text-2xl font-bold">{{ $user->name }}</h2>
                <p class="text-sm text-gray-500">{{ $user->email }}</p>
                <p class="mt-2">
                    <strong>Role:</strong>
                    @if($isAdmin)
                        <span class="inline-block bg-green-100 text-green-800 px-2 py-1 rounded">Admin</span>
                    @else
                        <span class="inline-block bg-blue-100 text-blue-800 px-2 py-1 rounded">User</span>
                    @endif
                </p>

                <p class="mt-2 text-sm text-gray-600">Member since: {{ $user->created_at->format('M d, Y') }}</p>

                <div class="mt-4 flex gap-3">
                <a href="{{ route('profile.edit') }}" 
                class="px-5 py-2.5 rounded-xl bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-semibold 
                        shadow-md hover:from-indigo-600 hover:to-blue-600 
                        transition-all duration-300 hover:scale-105">
                <i class="bi bi-pencil-square mr-2"></i>Edit Profile
                </a>

                <a href="{{ route('admin.dashboard') }}" 
                class="px-5 py-2.5 rounded-xl bg-gradient-to-r from-gray-700 to-gray-900 text-white font-semibold 
                        shadow-md hover:from-gray-900 hover:to-gray-700 
                        transition-all duration-300 hover:scale-105">
                <i class="bi bi-arrow-left-circle mr-2"></i>Back
                </a>
            </div>


                    @if($isAdmin)
                        <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary ml-2">Admin Dashboard</a>
                    @endif
                </div>
            </div>
        </div>

        {{-- optionally more admin-only info --}}
        @if($isAdmin)
        <div class="p-6 border-t">
            <h3 class="font-semibold">Admin Information</h3>
            <p class="text-sm text-gray-600">You can manage users, products, etc from admin dashboard.</p>
        </div>
        @endif
    </div>
</div>
@endsection

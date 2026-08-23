<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // 1. Gate::before - ផ្តល់សិទ្ធិពេញលេញឱ្យ Admin ឬ User ID 1 (មិនជាប់ 403 ទៀតទេ)
        Gate::before(function ($user, $ability) {
            if ($user->id === 1 || strtolower($user->role) === 'admin' || $user->role == 1) {
                return true;
            }
        });

        // 2. ប្រើ strtolower() ដើម្បីការពារបញ្ហាអក្សរតូច/ធំ (admin, Admin, ADMIN)
        Gate::define('view-roles', function (User $user) {
            return strtolower($user->role) === 'admin' || $user->role == 1;
        });

        Gate::define('view-borrowers', function (User $user) {
            $userRole = strtolower($user->role);
            return in_array($userRole, ['admin', 'manager']) || in_array($user->role, [1, 2]);
        });

        Gate::define('manage-loans', function (User $user) {
            $userRole = strtolower($user->role);
            return in_array($userRole, ['admin', 'manager', 'staff']) || in_array($user->role, [1, 2, 3]);
        });
    }
}
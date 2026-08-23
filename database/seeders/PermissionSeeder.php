<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Permission;
use Illuminate\Support\Str;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = [
            'View Roles',
            'Create Roles',
            'Edit Roles',
            'Delete Roles',
            'View Borrowers',
            'Create Borrowers',
            'Edit Borrowers',
            'Delete Borrowers',
            'Manage Loans',
            'View Reports',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate([
                'name' => $permission,
                'slug' => Str::slug($permission),
            ]);
        }
    }
}
<?php

namespace Database\Seeders;

use App\Models\RoleHierarchy;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminRole = Role::create(['name' => 'admin']);
        RoleHierarchy::create([
            'role_id' => $adminRole->id,
            'hierarchy' => 1,
        ]);

        $userRole = Role::create(['name' => 'user']);
        RoleHierarchy::create([
            'role_id' => $userRole->id,
            'hierarchy' => 2,
        ]);

        $guestRole = Role::create(['name' => 'guest']);
        RoleHierarchy::create([
            'role_id' => $guestRole->id,
            'hierarchy' => 3,
        ]);
    }
}

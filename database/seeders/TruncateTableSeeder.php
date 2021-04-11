<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class TruncateTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        DB::table('role_has_permissions')->delete();
//        DB::table('model_has_roles')->truncate();
        DB::table('roles')->delete();
        DB::table('users')->delete();
        DB::table('menus')->delete();
    }
}

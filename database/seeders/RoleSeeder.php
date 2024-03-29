<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Delete existing records from the table
        DB::table('roles')->truncate();

        // Seed new data
        $roles = [
            ['name' => 'Admin'],
            ['name' => 'User'],
        ];
        DB::table('roles')->insert($roles);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use Illuminate\Support\Facades\DB;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Role::query()->delete();
        DB::table('role_user')->delete();

        Role::create(['name' => 'Admin']);
        Role::create(['name' => 'Moderator']);

        Role::create(['name' => 'Basic']);
        Role::create(['name' => 'Silver']);
        Role::create(['name' => 'Gold']);
    }
}

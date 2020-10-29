<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Role;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::query()->delete();
        DB::table('role_user')->delete();

        $adminRole = Role::where('name','Admin')->first();
        $moderatorRole = Role::where('name','Moderator')->first();
        $userRole = Role::where('name','User')->first();

        $admin = User::create([
            'name' => 'Admin User',
            'phone' => '+375293164122',
            'password' => Hash::make('mypass')
        ]);

        $moderator = User::create([
            'name' => 'Moderator User',
            'phone' => '+375256061834',
            'password' => Hash::make('mypass')
        ]);

        $user = User::create([
            'name' => 'User',
            'phone' => '+375296895766',
            'password' => Hash::make('mypass')
        ]);

        $admin->roles()->attach($adminRole);
        $moderator->roles()->attach($moderatorRole);
        $user->roles()->attach($userRole);
    }
}

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
        $basicRole = Role::where('name','Basic')->first();
        $silverRole = Role::where('name','Silver')->first();
        $goldRole = Role::where('name','Gold')->first();


        $admin = User::create([
            'name' => 'Admin User',
            'phone' => '+375293164122',
            'password' => Hash::make('mypass'),
        ]);

        $moderator = User::create([
            'name' => 'Moderator User',
            'phone' => '+375256061834',
            'password' => Hash::make('mypass'),
        ]);

        $basicUser = User::create([
            'name' => 'Basic client',
            'phone' => '+37525111111',
            'password' => Hash::make('mypass'),
        ]);

        $silverUser = User::create([
            'name' => 'Sliver client',
            'phone' => '+37525111112',
            'password' => Hash::make('mypass'),
        ]);

        $goldUser = User::create([
            'name' => 'Gold client',
            'phone' => '+37525111113',
            'password' => Hash::make('mypass'),
        ]);


        $admin->roles()->attach($adminRole);
        $moderator->roles()->attach($moderatorRole);

        $basicUser->roles()->attach($basicRole);
        $silverUser->roles()->attach($silverRole);
        $goldUser->roles()->attach($goldRole);
    }
}

<?php

namespace Database\Seeders;

use App\Models\Setting;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::updateOrCreate([
            'email' => config('app.username_admin').'@example.com',
            'username' => config('app.username_admin'),
        ],[
            'name' =>config('app.username_admin'),
            'email' =>config('app.username_admin').'@example.com',
            'username' => config('app.username_admin'),
            'password' => Hash::make(config('app.password_admin')),
            'role_id' => Role::first()->id ?? null,
            'language_id' => 1,
        ]);
        $user->assignRole(Role::first()->name);
        Setting::updateOrCreate([
            'id'=>1,
        ],[
            'use_default_settings'=>0,
            'is_expired'=>0
        ]);
    }
}

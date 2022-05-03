<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
                         'name'=> 'Admin',
                         'user_role_id'=> 1,
                         'email'=> 'admin@admin.com',
                         'dob'=>1990,
                         'image'=> 'https://i.pinimg.com/originals/6c/67/8c/6c678c23d360432d5dad8c4aae4d48ca.gif',
                         'password'=> Hash::make('admin123456')
                     ]);

    }
}

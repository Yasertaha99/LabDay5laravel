<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\User; 



class UserSeeder extends Seeder
{
   
    public function run(): void
    {


        User::factory()->count(10)->create();

        // $users = [];
        // for ($i = 0; $i < 10; $i++) {
        //     $users[] = [
        //         'name' => Str::random(10),
        //         'email' => Str::random(10) . '@example.com',
        //         'password' => Hash::make('password'),
        //         'image' => 'http://127.0.0.1:8000/uploads/users/user.png', // Default image path
        //     ];
        // }

        // DB::table('users')->insert($users);
        

        
    }
}


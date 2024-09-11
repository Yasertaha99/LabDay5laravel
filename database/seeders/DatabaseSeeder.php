<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
// use Illuminate\Database\seeder\UserSeeder;

class DatabaseSeeder extends Seeder
{
    
    public function run(): void
    {
        $this->call(UserSeeder::class);
       
    }
}

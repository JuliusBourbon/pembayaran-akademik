<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Database\Seeders\MahasiswaSeeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;
   public function run()
    {
        $this->call([
            UserSeeder::class,      
            ProdiSeeder::class,   
            MahasiswaSeeder::class,
            JenisBiayaSeeder::class,
        ]);
    }
}

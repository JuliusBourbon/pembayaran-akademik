<?php

namespace Database\Seeders;

use App\Models\jenisbiaya as ModelsJenisbiaya;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JenisBiaya extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ModelsJenisbiaya::create([
            'id' => 1,
            'nama' => 'Biaya 1',
            'jumlah_biaya' => 1000000
        ]);
    }
}

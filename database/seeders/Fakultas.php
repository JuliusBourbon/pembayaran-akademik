<?php

namespace Database\Seeders;

use App\Models\fakultas as ModelsFakultas;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Fakultas extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ModelsFakultas::create([
            'id_fakultas' => 1,
            'nama_fakultas' => 'FTIK'
        ]);
    }
}

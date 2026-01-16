<?php

namespace Database\Seeders;

use App\Models\bendahara as ModelsBendahara;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Bendahara extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ModelsBendahara::create([
            'nip' => 1001,
            'nama' => 'Sri Murlyani',
            'alamat' => 'Jl. Dipatiukur',
            'telepon' => '081234567890',
            'email' => 'sri@dosen.unikom.ac.id',
        ]);
    }
}

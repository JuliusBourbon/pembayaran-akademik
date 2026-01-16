<?php

namespace Database\Seeders;

use App\Models\mahasiswa as ModelsMahasiswa;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Mahasiswa extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ModelsMahasiswa::create([
            'nim' => 1011,
            'nama' => 'Julius',
            'alamat' => 'Jl. Dago',
            'telepon' => '081234567891',
            'telepon_ortu' => '081234567892',
            'user' => '1011',
            'password' => '1234',
            'email' => 'Julius@mahasiswa.unikom.ac.id',
            'virtual_account' => '998877',
            'id_prodi' => 1,
            'id_fakultas' => 1,
        ]);
    }
}

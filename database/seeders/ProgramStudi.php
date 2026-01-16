<?php

namespace Database\Seeders;

use App\Models\programstudi as ModelsProgramstudi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProgramStudi extends Seeder
{
    public function run(): void
    {
        ModelsProgramstudi::create([
            'id_prodi' => 1,
            'nama_prodi' => 'Teknik Informatika'
        ]);
    }
}

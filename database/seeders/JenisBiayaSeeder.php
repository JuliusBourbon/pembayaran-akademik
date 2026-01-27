<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; 

class JenisBiayaSeeder extends Seeder
{
    public function run()
    {
        DB::table('jenis_biaya')->insert([
            ['id_jenis_biaya' => 'BPP', 'nama_biaya' => 'Biaya Pengembangan Pendidikan', 'nominal' => 8500000],
            ['id_jenis_biaya' => 'PNJ', 'nama_biaya' => 'Biaya Penunjang', 'nominal' => 2500000],
            ['id_jenis_biaya' => 'KUL', 'nama_biaya' => 'Biaya Kuliah', 'nominal' => 9000000], 
        ]);
    }
}
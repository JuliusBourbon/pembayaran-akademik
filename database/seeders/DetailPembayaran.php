<?php

namespace Database\Seeders;

use App\Models\detailpembayaran as ModelsDetailpembayaran;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DetailPembayaran extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ModelsDetailpembayaran::create([
            'noreg' => 1,
            'id' => 1,
            'jumlahbiaya' => 1000000
        ]);
    }
}

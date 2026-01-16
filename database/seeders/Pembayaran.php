<?php

namespace Database\Seeders;

use App\Models\pembayaran as ModelsPembayaran;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Pembayaran extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ModelsPembayaran::create([
            'id' => 1,
            'tgl_pembayaran' => now(),
            'jumlah_pembayaran' => 1000000,
            'nim' => 1011,
            'nip' => 1001,
        ]);
    }
}

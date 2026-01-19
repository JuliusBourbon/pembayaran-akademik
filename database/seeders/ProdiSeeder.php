<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProdiSeeder extends Seeder
{
    public function run()
    {
        DB::table('prodi')->insert([
            [
                'kode_prodi' => 'IF',
                'nama_prodi' => 'Teknik Informatika',
                'fakultas'   => 'Teknik dan Ilmu Komputer'
            ],
            [
                'kode_prodi' => 'DKV',
                'nama_prodi' => 'Desain Komunikasi Visual',
                'fakultas'   => 'Desain'
            ],
            [
                'kode_prodi' => 'TI',
                'nama_prodi' => 'Teknik Industri',
                'fakultas'   => 'Teknik dan Ilmu Komputer'
            ],
            [
                'kode_prodi' => 'SI',
                'nama_prodi' => 'Sistem Informasi',
                'fakultas'   => 'Teknik dan Ilmu Komputer'
            ],
            [
                'kode_prodi' => 'AK',
                'nama_prodi' => 'Akuntansi',
                'fakultas'   => 'Ekonomi dan Bisnis'
            ],
            [
                'kode_prodi' => 'MN',
                'nama_prodi' => 'Manajemen',
                'fakultas'   => 'Ekonomi dan Bisnis'
            ],
            [
                'kode_prodi' => 'HI',
                'nama_prodi' => 'Hubungan Internasional',
                'fakultas'   => 'Ilmu Sosial dan Politik'
            ],
            [
                'kode_prodi' => 'HK',
                'nama_prodi' => 'Ilmu Hukum',
                'fakultas'   => 'Hukum'
            ]
        ]);
    }
}
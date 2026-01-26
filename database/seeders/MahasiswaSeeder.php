<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash; 
use Faker\Factory as Faker;

class MahasiswaSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create('id_ID');

        $list_prodi = ['IF', 'DKV', 'TI', 'SI']; 
        
        for ($i = 1; $i <= 50; $i++) {

            $status_belum_bayar = rand(1, 100) <= 60; 

            $tahun = date('Y');
            $no_reg = 'REG-' . $tahun . '-' . str_pad($i, 4, '0', STR_PAD_LEFT);
            $kode_prodi = $faker->randomElement($list_prodi);

            $nim = null;
            $email_kampus = null;
            $username = $no_reg;
            $password = Hash::make('123456'); 

            if (!$status_belum_bayar) {

                $nomor_urut = str_pad(rand(1, 999), 3, '0', STR_PAD_LEFT);
                $angka_prodi = match($kode_prodi) {
                    'IF' => '10', 'DKV' => '20', 'TI' => '30', default => '99'
                };
                $nim = $angka_prodi . substr($tahun, 2, 2) . $nomor_urut;
                
         
                $nama_depan = strtolower(explode(' ', $faker->name)[0]);
                $nama_bersih = preg_replace('/[^a-z0-9]/', '', $nama_depan);
                $email_kampus = $nama_bersih . '.' . $nim . '@mahasiswa.unikom.ac.id'; 

                $username = mt_rand(100000, 999999); 
                $password = mt_rand(10000000, 99999999); 
            }

            DB::table('mahasiswa')->insert([
                'no_reg'        => $no_reg,
                'nim'           => $nim, 
                'nama_mhs'      => $faker->name,
                'alamat'        => $faker->address,
                'telepon'       => $faker->numerify('08##########'), 
                'tlp_ortu'      => $faker->numerify('08##########'), 
                'email_kampus'  => $email_kampus,
                'username'      => $username, 
                'password'      => $password, 
                'virtual_account' => '888' . $faker->numerify('##########'),
                'kode_prodi'    => $kode_prodi,
            ]);
        }
    }
}
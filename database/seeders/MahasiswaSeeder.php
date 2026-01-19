<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
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

            if ($status_belum_bayar) {
                $nim = null;
                $email_kampus = null;
                $password = hash('sha256', '123456'); 
            } else {
                $nomor_urut = str_pad(rand(1, 999), 3, '0', STR_PAD_LEFT);
                $angka_prodi = match($kode_prodi) {
                    'IF' => '10', 'DKV' => '20', 'TI' => '30', default => '99'
                };
                
                $nim = $angka_prodi . substr($tahun, 2, 2) . $nomor_urut;
                
                $nama_bersih = strtolower(str_replace(' ', '', $faker->firstName));
                $email_kampus = $nama_bersih . rand(1,99) . '@email.unikom.ac.id'; 
                $password = hash('sha256', 'mhs123'); 
            }

            DB::table('mahasiswa')->insert([
                'no_reg'        => $no_reg,
                'nim'           => $nim, 
                'nama_mhs'      => $faker->name,
                'alamat'        => $faker->address,
                'telepon'       => $faker->numerify('08##########'), 
                'tlp_ortu'      => $faker->numerify('08##########'), 
                'email_kampus'  => $email_kampus,
                'username'      => $no_reg, 
                'password'      => $password, 
                'virtual_account' => '888' . $faker->numerify('##########'),
                'kode_prodi'    => $kode_prodi,
            ]);
        }
    }
}
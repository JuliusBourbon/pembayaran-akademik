<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Models\Transaksi;
use App\Models\Mahasiswa;

class TransaksiController extends Controller
{
    public function create($no_reg)
    {
        if (!Session::has('is_logged_in')) return redirect('/login');

        $mahasiswa = DB::select("
            SELECT m.*, p.nama_prodi 
            FROM mahasiswa m 
            LEFT JOIN prodi p ON m.kode_prodi = p.kode_prodi
            WHERE m.no_reg = ?
        ", [$no_reg]);

        if (empty($mahasiswa)) return back()->with('error', 'Data mahasiswa tidak ditemukan.');
        $biaya = DB::table('jenis_biaya')->get();
        $riwayat_raw = DB::table('transaksi')
            ->join('transaksi_detail', 'transaksi.no_transaksi', '=', 'transaksi_detail.no_transaksi')
            ->where('transaksi.no_reg', $no_reg)
            ->select('transaksi_detail.jenis_biaya', 'transaksi_detail.nominal')
            ->get();

        $riwayat_jenis_biaya = $riwayat_raw->pluck('jenis_biaya')->toArray();

        $status_bayar = [
            'BPP' => false,
            'PNJ' => false,
            'KUL_FULL' => false 
        ];

        foreach ($biaya as $b) {
            if (in_array($b->nama_biaya, $riwayat_jenis_biaya)) {
                $status_bayar[$b->id_jenis_biaya] = true;
            }
        }

        $plan_angsuran = null; 
        $paid_angsuran = [];   

        $angsuran_found = $riwayat_raw->filter(function ($item) {
            return str_contains($item->jenis_biaya, 'Biaya Kuliah (Angsuran');
        });

        if ($angsuran_found->isNotEmpty()) {
            $sample_nominal = $angsuran_found->first()->nominal;
            if ($sample_nominal > 0) {
                $plan_angsuran = round(9000000 / $sample_nominal); 
            }
            foreach ($angsuran_found as $item) {
                if (preg_match('/Angsuran (\d+)/', $item->jenis_biaya, $matches)) {
                    $paid_angsuran[] = (int)$matches[1];
                }
            }
        }

        foreach ($riwayat_jenis_biaya as $item) {
            if (str_contains($item, 'Biaya Kuliah (Lunas)') || str_contains($item, 'Biaya Kuliah (Pelunasan Awal)')) {
                $status_bayar['KUL_FULL'] = true;
            }
        }

        $is_new_student = $riwayat_raw->isEmpty();

        return view('transaksi_input', [
            'mhs'            => $mahasiswa[0],
            'biaya'          => $biaya,
            'status_bayar'   => $status_bayar,
            'is_new_student' => $is_new_student,
            'plan_angsuran'  => $plan_angsuran,
            'paid_angsuran'  => $paid_angsuran
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'no_reg'       => 'required',
            'detail_bayar' => 'required|array', 
        ]);

        $no_reg = $request->input('no_reg');
        $petugas = Session::get('id_user');
        $items_dibayar = $request->input('detail_bayar'); 

        $total_transaksi = 0;
        $data_insert_detail = [];
        $no_transaksi = 'TRX-' . date('Ymd') . '-' . rand(1000, 9999);

        foreach ($items_dibayar as $item) {
            $parts = explode('|', $item);
            if(count($parts) < 2) continue; 
            $nama_biaya = $parts[0];
            $nominal    = (int)$parts[1];
            $total_transaksi += $nominal;
            $data_insert_detail[] = [
                'no_transaksi' => $no_transaksi,
                'jenis_biaya'  => $nama_biaya,
                'nominal'      => $nominal
            ];
        }

        if ($total_transaksi <= 0) return back()->with('error', 'Total pembayaran tidak boleh 0.');

        DB::beginTransaction();
        try {
            $id_petugas = Session::get('id_user');

            DB::table('transaksi')->insert([
                'no_transaksi' => $no_transaksi,
                'tgl_bayar'    => now(),
                'no_reg'       => $no_reg,
                'id_petugas'   => $petugas,
                'total_bayar'  => $total_transaksi
            ]);

           
            DB::table('transaksi_detail')->insert($data_insert_detail);
            $riwayat_biaya = DB::table('transaksi')
                ->join('transaksi_detail', 'transaksi.no_transaksi', '=', 'transaksi_detail.no_transaksi')
                ->where('transaksi.no_reg', $no_reg)
                ->pluck('transaksi_detail.jenis_biaya')
                ->toArray();
            $check_bpp = in_array('Biaya Pengembangan Pendidikan', $riwayat_biaya);
            $check_pnj = in_array('Biaya Penunjang', $riwayat_biaya);
            
            $check_kuliah = false;
            foreach ($riwayat_biaya as $item) {
                if (str_contains($item, 'Biaya Kuliah')) {
                    $check_kuliah = true;
                    break;
                }
            }

            $mhs = DB::table('mahasiswa')->where('no_reg', $no_reg)->first();
            $nim_baru = $mhs->nim;
            $pesan = "Pembayaran berhasil disimpan.";

            if ($nim_baru == null && $check_bpp && $check_pnj && $check_kuliah) {
                
                $kode_prodi = $mhs->kode_prodi;
                $angka_prodi = match($kode_prodi) { 'IF' => '10', 'DKV' => '20', 'TI' => '30', 'SI' => '40', default => '99' };
                $tahun = date('y'); 
                $prefix_nim = $angka_prodi . $tahun;
                
                $count = DB::table('mahasiswa')->where('nim', 'like', $prefix_nim . '%')->count();
                $urut = str_pad($count + 1, 3, '0', STR_PAD_LEFT);
                $nim_baru = $prefix_nim . $urut;

                $username_baru = rand(100000, 999999);
                $pass_raw      = rand(10000000, 99999999); 
                
                $nama_depan = strtolower(explode(' ', $mhs->nama_mhs)[0]);
                $nama_bersih = preg_replace('/[^a-z0-9]/', '', $nama_depan);
                $email_baru = $nama_bersih . '.' . $nim_baru . '@mahasiswa.unikom.ac.id';

                DB::table('mahasiswa')->where('no_reg', $no_reg)->update([
                    'nim'          => $nim_baru,
                    'username'     => $username_baru,
                    'password'     => $pass_raw, 
                    'email_kampus' => $email_baru
                ]);

                $pesan = "SELAMAT! Syarat terpenuhi. Mahasiswa Aktif dengan NIM: $nim_baru";
            }

            DB::commit(); 
            return redirect('/cari-mahasiswa?q='.$no_reg)->with('success', $pesan);

        } catch (\Exception $e) {
            DB::rollBack(); 
            return back()->with('error', 'Gagal memproses transaksi: ' . $e->getMessage());
        }
    }

    public function cetak($no_transaksi) {
        if (!Session::has('is_logged_in')) {
            return redirect('/login');
        }
        $dataUtama = DB::select("
            SELECT 
                t.no_transaksi, 
                t.tgl_bayar, 
                t.total_bayar, 
                t.no_reg,
                m.*,
                p.username as nama_petugas,
                pr.nama_prodi
                
            FROM transaksi t
            JOIN mahasiswa m ON t.no_reg = m.no_reg
            LEFT JOIN petugas p ON t.id_petugas = p.id
            LEFT JOIN prodi pr ON m.kode_prodi = pr.kode_prodi
            WHERE t.no_transaksi = :no_transaksi
            LIMIT 1
        ", ['no_transaksi' => $no_transaksi]);

        $trx = $dataUtama[0];

        $trx->details = DB::select("
            SELECT jenis_biaya, nominal 
            FROM transaksi_detail 
            WHERE no_transaksi = :no_transaksi
        ", ['no_transaksi' => $no_transaksi]);

        return view('struk_pembayaran', ['trx' => $trx]);
    }
}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class MahasiswaController extends Controller
{
    public function index(Request $request)
    {
        if (!Session::has('is_logged_in')) {
            return redirect('/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $keyword = $request->input('q');

        if ($keyword) {
            $mahasiswa = DB::select("
                SELECT * FROM mahasiswa 
                WHERE no_reg LIKE ? 
                OR nama_mhs LIKE ? 
                OR nim LIKE ?
                ORDER BY no_reg ASC
            ", ["%$keyword%", "%$keyword%", "%$keyword%"]);
        } else {
            $mahasiswa = []; 
        }

        return view('mahasiswa_cari', [
            'mahasiswa' => $mahasiswa,
            'keyword' => $keyword
        ]);
    }

    public function detail($no_reg) {
        if (!Session::has('is_logged_in')) {
            return redirect('/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $mahasiswa = DB::select("
            SELECT m.*, p.nama_prodi 
            FROM mahasiswa m 
            LEFT JOIN prodi p ON m.kode_prodi = p.kode_prodi
            WHERE m.no_reg = ?
        ", [$no_reg]);

        if (empty($mahasiswa)) {
            return back()->with('error', 'Data mahasiswa tidak ditemukan.');
        }

        // if ($mahasiswa[0]->nim != null) {
        //     return back()->with('error', 'Mahasiswa ini sudah lunas dan memiliki NIM.');
        // }

        return view('detail_mahasiswa', ['mahasiswa' => $mahasiswa[0]]);
    }

    public function getprodi(){
        $prodi = DB::select("Select * from prodi");

        return view('landing_page', ['prodi' => $prodi]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_mhs' => 'required',
            'alamat' => 'required',
            'telepon' => 'required',
            'tlp_ortu' => 'required',
            'alamat' => 'required',
            'username' => 'required',
            'password' => 'required',
            'kode_prodi' => 'required',

        ]);

        $no_reg = 'REG-' . date('Ym') . rand(1000, 9999);

        $password = Hash::make($request->password);
        $query = "
            INSERT INTO mahasiswa (
                no_reg, username, password, nama_mhs, 
                alamat, telepon, tlp_ortu, kode_prodi, 
                nim, virtual_account, email_kampus
            ) VALUES (
                :no_reg, :username, :password, :nama_mhs, 
                :alamat, :telepon, :tlp_ortu, :kode_prodi, 
                NULL, NULL, NULL
            )
        ";

        try {
            DB::insert($query, [
                'no_reg'     => $no_reg,
                'username'   => $request->username,
                'password'   => $password, 
                'nama_mhs'   => $request->nama_mhs,
                'alamat'     => $request->alamat,
                'telepon'    => $request->telepon,
                'tlp_ortu'   => $request->tlp_ortu,
                'kode_prodi' => $request->kode_prodi
            ]);

            return redirect('/unikom')->with('success');

        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage());
        }
    }
}
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

        // $no_reg = 'REG-' . date('Y') . '-' . rand(1000, 9999);
        // $virtualacc = "888" . date('md') . rand(10000, 999999);

        $password = Hash::make($request->password);
        try {
            DB::insert("
                INSERT INTO mahasiswa (
                    no_reg, username, password, nama_mhs, alamat, telepon, tlp_ortu, kode_prodi, nim, virtual_account, email_kampus
                ) VALUES (
                    CONCAT('REG-', YEAR(NOW()), '-', FLOOR(1000 + (RAND() * 9000))), 
                    :username, 
                    :password, 
                    :nama_mhs, 
                    :alamat, 
                    :telepon, 
                    :tlp_ortu, 
                    :kode_prodi, 
                    NULL, 
                    CONCAT('888', DATE_FORMAT(NOW(), '%m%d'), FLOOR(10000 + (RAND() * 900000))), 
                    NULL
                )
            ", [
                'username'   => $request->username,
                'password'   => $password, 
                'nama_mhs'   => $request->nama_mhs,
                'alamat'     => $request->alamat,
                'telepon'    => $request->telepon,
                'tlp_ortu'   => $request->tlp_ortu,
                'kode_prodi' => $request->kode_prodi,
            ]);

            return redirect('/unikom')->with('success');

        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage());
        }
    }

    public function updateview($no_reg) {
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

        return view('edit_mahasiswa', ['mhs' => $mahasiswa[0]]);
    }

    public function update(Request $request, $no_reg)
    {
        $request->validate([
            'username'   => 'required',
            'nama_mhs'   => 'required',
            'kode_prodi' => 'required',
            'alamat'     => 'required',
            'telepon'    => 'required|numeric',
            'tlp_ortu'   => 'required|numeric',
            'password'   => 'nullable|min:6', 
        ]);

        
        try {
            if ($request->filled('password')) {
                $passwordHash = Hash::make($request->password);
                DB::update("
                    UPDATE mahasiswa SET 
                        username = :username,
                        password = :password,
                        nama_mhs = :nama_mhs,
                        alamat = :alamat,
                        telepon = :telepon,
                        tlp_ortu = :tlp_ortu,
                        kode_prodi = :kode_prodi,
                        email_kampus = :email_kampus
                    WHERE no_reg = :no_reg
                ", [
                    'username'     => $request->username,
                    'password'     => $passwordHash,
                    'nama_mhs'     => $request->nama_mhs,
                    'alamat'       => $request->alamat,
                    'telepon'      => $request->telepon,
                    'tlp_ortu'     => $request->tlp_ortu,
                    'kode_prodi'   => $request->kode_prodi,
                    'email_kampus' => $request->email_kampus ?? null,
                    'no_reg'       => $no_reg
                ]);

            } else {
                DB::update("
                    UPDATE mahasiswa SET 
                        username = :username,
                        nama_mhs = :nama_mhs,
                        alamat = :alamat,
                        telepon = :telepon,
                        tlp_ortu = :tlp_ortu,
                        kode_prodi = :kode_prodi,
                        email_kampus = :email_kampus
                    WHERE no_reg = :no_reg
                ", [
                    'username'     => $request->username,
                    'nama_mhs'     => $request->nama_mhs,
                    'alamat'       => $request->alamat,
                    'telepon'      => $request->telepon,
                    'tlp_ortu'     => $request->tlp_ortu,
                    'kode_prodi'   => $request->kode_prodi,
                    'email_kampus' => $request->email_kampus ?? null,
                    'no_reg'       => $no_reg
                ]);
            }

            return redirect('/detail/' . $no_reg)->with('success', 'Data mahasiswa berhasil diperbarui.');

        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->errorInfo[1] == 1062) {
                return back()->withInput()->with('error', 'Gagal update: Username tersebut sudah digunakan oleh mahasiswa lain.');
            }

            return back()->withInput()->with('error', 'Terjadi kesalahan database: ' . $e->getMessage());
        }
    }
}
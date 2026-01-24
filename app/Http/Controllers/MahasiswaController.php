<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
}
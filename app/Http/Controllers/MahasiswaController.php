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
}
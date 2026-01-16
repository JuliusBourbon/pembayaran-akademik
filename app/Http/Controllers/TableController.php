<?php

namespace App\Http\Controllers;

use App\Models\bendahara;
use App\Models\detailpembayaran;
use App\Models\fakultas;
use App\Models\jenisbiaya;
use App\Models\mahasiswa;
use App\Models\pembayaran;
use App\Models\programstudi;
use Illuminate\Http\Request;

class TableController extends Controller
{
    public function read() {
        $programstudi = programstudi::all();
        $fakultas = fakultas::all();
        $mahasiswa = mahasiswa::all();
        $bendahara = bendahara::all();
        $jenisbiaya = jenisbiaya::all();
        $pembayaran = pembayaran::all();
        $detail = detailpembayaran::all();

        return view('table', [
            'dataprodi' => $programstudi,
            'datafakultas' => $fakultas,
            'datamahasiswa' => $mahasiswa,
            'databendahara' => $bendahara,
            'datajenisbiaya' => $jenisbiaya,
            'datapembayaran' => $pembayaran,
            'datadetail' => $detail,
            ]);
    }
}

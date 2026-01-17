<?php

namespace App\Http\Controllers;

use App\Models\bendahara;
use App\Models\mahasiswa;
use App\Models\pembayaran;
use Illuminate\Http\Request;

class PembayaranContoller extends Controller
{
    public function createView(){
        $mahasiswa = mahasiswa::all();
        $bendahara = bendahara::all();

        return view('addPby',
        [
            'mahasiswa' => $mahasiswa,
            'bendahara' => $bendahara
        ]);
    }

    public function store(Request $request) {
        $validatedData = $request->validate([
            'tgl_pembayaran' => 'required|date',
            'jumlah_pembayaran' => 'required|integer',
            'nim' => 'required|integer',
            'nip' => 'required|integer',
        ]);

        pembayaran::create($validatedData);

        return redirect('/table');
    }

    public function delete($id){
        $pembayaran = pembayaran::where('id', $id)->firstOrFail();
        $pembayaran->delete();

        return redirect('/table')->with('success', 'Data berhasil dihapus');
    }

    public function updateView($id){
        $pembayaran = pembayaran::where('id', $id)->firstOrFail();
        $mahasiswa = mahasiswa::all();
        $bendahara = bendahara::all();

        return view('editPby', 
        [
            'pembayaran' => $pembayaran,
            'mahasiswa' => $mahasiswa,
            'bendahara' => $bendahara
        ]);
    }

    public function update(Request $request, $id){
        $pembayaran = pembayaran::where('id', $id)->firstOrFail();

        $validatedData = $request->validate([
            'tgl_pembayaran' => 'required|date',
            'jumlah_pembayaran' => 'required|integer',
            'nim' => 'required|integer',
            'nip' => 'required|integer',
        ]);

        $pembayaran->update($validatedData);

        return redirect('/table')->with('success', 'Data berhasil diedit');
    }
}

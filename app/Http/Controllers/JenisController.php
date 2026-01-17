<?php

namespace App\Http\Controllers;

use App\Models\jenisbiaya;
use Illuminate\Http\Request;

class JenisController extends Controller
{
    public function createView(){
        return view('addJenis');
    }

    public function updateView($id){
        $jenisbiaya = jenisbiaya::where('id', $id)->firstOrFail();

        return view('editJenis', ['jenisbiaya' => $jenisbiaya]);
    }

    public function store(Request $request) {
        $validatedData = $request->validate([
            'nama' => 'required|string|max:20',
            'jumlah_biaya' => 'required|integer'
        ]);

        jenisbiaya::create($validatedData);

        return redirect('/table');
    }

    public function delete($id){
        $jenisbiaya = jenisbiaya::where('id', $id)->firstOrFail();
        $jenisbiaya->delete();

        return redirect('/table')->with('success', 'Data berhasil dihapus');
    }

    public function update(Request $request, $id){
        $jenisbiaya = jenisbiaya::where('id', $id)->firstOrFail();

        $validatedData = $request->validate([
            'nama' => 'required|string|max:20',
            'jumlah_biaya' => 'required|integer'
        ]);

        $jenisbiaya->update($validatedData);

        return redirect('/table')->with('success', 'Data berhasil diedit');
    }
}

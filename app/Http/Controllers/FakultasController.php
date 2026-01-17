<?php

namespace App\Http\Controllers;

use App\Models\fakultas;
use Illuminate\Http\Request;

class FakultasController extends Controller
{
    public function addView(){
        return view('addFakul');
    }

    public function editView($id){
        $fakultas = fakultas::where('id_fakultas', $id)->firstOrFail();

        return view('editFakul', ['datafakul' => $fakultas]);
    }

    public function storeFakul(Request $request) {
        $validatedData = $request->validate([
            'nama_fakultas' => 'required|string|max:20'
        ]);

        fakultas::create($validatedData);

        return redirect('/table');
    }

    public function deleteFakul($id){
        $fakultas = fakultas::where('id_fakultas', $id)->firstOrFail();
        $fakultas->delete();

        return redirect('/table')->with('success', 'Data berhasil dihapus');
    }

    public function editFakul(Request $request, $id){
        $fakultas = fakultas::where('id_fakultas', $id)->firstOrFail();

        $validatedData = $request->validate([
            'nama_fakultas' => 'required|string|max:20'
        ]);

        $fakultas->update($validatedData);

        return redirect('/table')->with('success', 'Data berhasil diedit');
    }
}

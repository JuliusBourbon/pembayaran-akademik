<?php

namespace App\Http\Controllers;

use App\Models\programstudi;
use Illuminate\Http\Request;

class ProdiController extends Controller
{
    public function addView(){
        return view('addProdi');
    }

    public function editView($id){
        $prodi = ProgramStudi::where('id_prodi', $id)->firstOrFail();

        return view('editProdi', ['dataprodi' => $prodi]);
    }

    public function storeProdi(Request $request) {
        $validatedData = $request->validate([
            'nama_prodi' => 'required|string|max:20'
        ]);

        programstudi::create($validatedData);

        return redirect('/table');
    }

    public function deleteProdi($id){
        $prodi = programstudi::where('id_prodi', $id)->firstOrFail();
        $prodi->delete();

        return redirect('/table')->with('success', 'Data berhasil dihapus');
    }

    public function editProdi(Request $request, $id){
        $prodi = programstudi::where('id_prodi', $id)->firstOrFail();

        $validatedData = $request->validate([
            'nama_prodi' => 'required|string|max:20'
        ]);

        $prodi->update($validatedData);

        return redirect('/table')->with('success', 'Data berhasil diedit');
    }
}

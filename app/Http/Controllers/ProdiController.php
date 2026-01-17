<?php

namespace App\Http\Controllers;

use App\Models\programstudi;
use Illuminate\Http\Request;

class ProdiController extends Controller
{
    public function createView(){
        return view('addProdi');
    }

    public function updateView($id){
        $prodi = ProgramStudi::where('id_prodi', $id)->firstOrFail();

        return view('editProdi', ['dataprodi' => $prodi]);
    }

    public function store(Request $request) {
        $validatedData = $request->validate([
            'nama_prodi' => 'required|string|max:20'
        ]);

        programstudi::create($validatedData);

        return redirect('/table');
    }

    public function delete($id){
        $prodi = programstudi::where('id_prodi', $id)->firstOrFail();
        $prodi->delete();

        return redirect('/table')->with('success', 'Data berhasil dihapus');
    }

    public function update(Request $request, $id){
        $prodi = programstudi::where('id_prodi', $id)->firstOrFail();

        $validatedData = $request->validate([
            'nama_prodi' => 'required|string|max:20'
        ]);

        $prodi->update($validatedData);

        return redirect('/table')->with('success', 'Data berhasil diedit');
    }
}

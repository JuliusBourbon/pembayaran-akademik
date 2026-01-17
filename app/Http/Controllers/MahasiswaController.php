<?php

namespace App\Http\Controllers;

use App\Models\fakultas;
use App\Models\mahasiswa;
use App\Models\programstudi;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    public function createView(){
        $dataprodi = programstudi::all();
        $datafakultas = fakultas::all();

        return view('addMhs', 
        [
            'dataprodi' => $dataprodi,
            'datafakultas' => $datafakultas
        ]);
    }

    public function updateView($id){
        $dataprodi = programstudi::all();
        $datafakultas = fakultas::all();
        $mahasiswa = mahasiswa::where('nim', $id)->firstOrFail();

        return view('editMhs', 
        [
            'mahasiswa' => $mahasiswa,
            'dataprodi' => $dataprodi,
            'datafakultas' => $datafakultas
        ]);
    }

    public function store(Request $request) {
        $validatedData = $request->validate([
            'nama' => 'required|string|max:50',
            'alamat' => 'required|string|max:20',
            'telepon' => 'required|string|max:15',
            'telepon_ortu' => 'required|string|max:15',
            'user' => 'required|string|max:8',
            'password' => 'required|string|max:8',
            'email' => 'required|string|max:50',
            'virtual_account' => 'required|string|max:20',
            'id_prodi' => 'required|integer|max:20',
            'id_fakultas' => 'required|integer|max:20',
        ]);

        mahasiswa::create($validatedData);

        return redirect('/table');
    }

    public function delete($id){
        $mahasiswa = mahasiswa::where('nim', $id)->firstOrFail();
        $mahasiswa->delete();

        return redirect('/table')->with('success', 'Data berhasil dihapus');
    }

    public function update(Request $request, $id){
        $mahasiswa = mahasiswa::where('nim', $id)->firstOrFail();

        $validatedData = $request->validate([
            'nama' => 'required|string|max:50',
            'alamat' => 'required|string|max:20',
            'telepon' => 'required|string|max:15',
            'telepon_ortu' => 'required|string|max:15',
            'user' => 'required|string|max:8',
            'password' => 'required|string|max:8',
            'email' => 'required|string|max:50',
            'virtual_account' => 'required|string|max:20',
            'id_prodi' => 'required|integer|max:20',
            'id_fakultas' => 'required|integer|max:20',
        ]);

        $mahasiswa->update($validatedData);

        return redirect('/table')->with('success', 'Data berhasil diedit');
    }
}

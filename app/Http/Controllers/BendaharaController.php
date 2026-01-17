<?php

namespace App\Http\Controllers;

use App\Models\bendahara;
use Illuminate\Http\Request;

class BendaharaController extends Controller
{
    public function createView(){
        return view('addBdh');
    }

    public function store(Request $request) {
        $validatedData = $request->validate([
            'nama' => 'required|string|max:20',
            'alamat' => 'required|string|max:50',
            'telepon' => 'required|string|max:15',
            'email' => 'required|string|max:64',
        ]);

        bendahara::create($validatedData);

        return redirect('/table');
    }

    public function delete($id){
        $bendahara = bendahara::where('nip', $id)->firstOrFail();
        $bendahara->delete();

        return redirect('/table')->with('success', 'Data berhasil dihapus');
    }

    public function updateView($id){
        $bendahara = bendahara::where('nip', $id)->firstOrFail();

        return view('editBdh', ['bendahara' => $bendahara]);
    }

    public function update(Request $request, $id){
        $bendahara = bendahara::where('nip', $id)->firstOrFail();

        $validatedData = $request->validate([
            'nama' => 'required|string|max:20',
            'alamat' => 'required|string|max:50',
            'telepon' => 'required|string|max:15',
            'email' => 'required|string|max:64',
        ]);

        $bendahara->update($validatedData);

        return redirect('/table')->with('success', 'Data berhasil diedit');
    }
}

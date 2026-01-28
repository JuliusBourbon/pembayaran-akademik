<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function loginView(){

        if (Session::has('id_user')) {
            return redirect('/dashboard');
        }
        return view('login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        $username = $request->input('username');
        $password = $request->input('password');

        $users = DB::select('SELECT * FROM petugas WHERE username = ? LIMIT 1', [$username]);

        if (count($users) > 0) {
            $user = $users[0];

            if (Hash::check($password, $user->password)) {
                Session::put('id_user', $user->id);
                Session::put('username', $user->username);
                Session::put('role', $user->role);
                Session::put('is_logged_in', true);

                return redirect('/dashboard')->with('success', 'Berhasil Login!');
            }
        }
        return back()->with('error', 'Username atau Password salah.');
    }

    public function dashboard()
    {
        if (!Session::has('is_logged_in')) {
            return redirect('/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        return view('dashboard');
    }

    public function logout()
    {
        Session::flush();
        return redirect('/login')->with('success', 'Berhasil Logout.');
    }

    public function loginMahasiswaForm()
    {
        return view('login_mahasiswa');
    }

    public function loginMahasiswa(Request $request)
    {
        $request->validate([
            'no_reg' => 'required',
            'password' => 'required'
        ]);

        $mhs = \App\Models\Mahasiswa::where('no_reg', $request->no_reg)->first();

        if (!$mhs) {
            return back()->with('error', 'No Registrasi tidak ditemukan.');
        }

        $loginSuccess = false;
        if ($mhs->nim != null) {
            if ($mhs->password === $request->password) {
                $loginSuccess = true;
            }
        } 
        else {
            if ($request->password === $mhs->no_reg) {
                $loginSuccess = true;
            }
        }
        
        if ($loginSuccess) {
            Session::put('mhs_logged_in', true);
            Session::put('mhs_no_reg', $mhs->no_reg);
            Session::put('mhs_nama', $mhs->nama_mhs);
            
            return redirect('/mahasiswa/dashboard');
        }

        return back()->with('error', 'Password salah. Gunakan No. Registrasi sebagai password jika belum lunas.');
    }

    public function logoutMahasiswa()
    {
        Session::forget(['mhs_logged_in', 'mhs_no_reg', 'mhs_nama']);
        return redirect('/');
    }
}

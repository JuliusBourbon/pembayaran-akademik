<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
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

    public function loginMahasiswa(Request $request){
        $request->validate([
            'identity' => 'required', 
            'password' => 'required'
        ]);

        $inputIdentity = $request->input('identity');
        $inputPassword = $request->input('password');
        $users = DB::select("
            SELECT * FROM mahasiswa 
            WHERE no_reg = :reg OR username = :user 
            LIMIT 1
        ", [
            'reg'  => $inputIdentity,
            'user' => $inputIdentity
        ]);
        $mhs = $users[0];

        $trx = DB::select("
            SELECT SUM(total_bayar) as total 
            FROM transaksi 
            WHERE no_reg = :no_reg
        ", ['no_reg' => $mhs->no_reg]);

        $totalBayar = $trx[0]->total ?? 0;
        $isLunas = $totalBayar >= 19500000;
        $loginSuccess = false;

        if ($isLunas) {
            if ($inputIdentity !== $mhs->username) {
                return back()->with('error', 'Status pembayaran LUNAS. Silakan login menggunakan USERNAME Anda (bukan No. Reg).');
            }

            if ($inputPassword === $mhs->password) {
                $loginSuccess = true;
            } else {
                return back()->with('error', 'Password salah.');
            }

        } else {
            if ($inputIdentity !== $mhs->no_reg) {
                return back()->with('error', 'Status pembayaran BELUM LUNAS. Silakan login menggunakan NO. REGISTRASI.');
            }

            if ($inputPassword === $mhs->no_reg || $inputPassword === $mhs->password) {
                $loginSuccess = true;
            } else {
                return back()->with('error', 'Password salah. Gunakan No. Registrasi sebagai password.');
            }
        }

        if ($loginSuccess) {
            Session::put('mhs_logged_in', true);
            Session::put('mhs_no_reg', $mhs->no_reg);
            Session::put('mhs_nama', $mhs->nama_mhs);
            
            return redirect('/mahasiswa/dashboard');
        }

        return back()->with('error', 'Login gagal.');
    }

    public function logoutMahasiswa()
    {
        Session::forget(['mhs_logged_in', 'mhs_no_reg', 'mhs_nama']);
        return redirect('/');
    }
}

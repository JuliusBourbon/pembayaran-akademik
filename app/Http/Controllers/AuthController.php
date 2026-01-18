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

        $users = DB::select('SELECT * FROM users WHERE username = ? LIMIT 1', [$username]);

        if (count($users) > 0) {
            $user = $users[0];

            if (Hash::check($password, $user->password)) {
                Session::put('id_user', $user->id_user);
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
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    /**
     * Menampilkan halaman login.
     */
    public function index()
    {
        return view('auth.login');
    }

    /**
     * Menangani permintaan otentikasi.
     */
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $user = User::where('email', $request->email)->first();

        // return $user;

        if ($user->role_id == 1) {
            $redirectTo = 'superadmin/';
        } elseif ($user->role_id == 4) {
            $redirectTo = 'scoring/juri/' . $user->id;
        } else if ($user->role_id == 5) {
            $redirectTo = 'arena/dewan/' . $user->id;
        } else if ($user->role_id == 6) {
            $redirectTo = 'arena/operator/' . $user->id;
        } else {
            $redirectTo = '/login'; // Atau halaman lain jika peran tidak dikenali
        }

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended($redirectTo); // Redirect ke halaman setelah login berhasil
        }

        return back()->withErrors([
            'email' => 'Email atau Password yang Anda masukkan salah.',
        ])->onlyInput('email');
    }
}
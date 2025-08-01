<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ProfilSekolah;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        $profil = ProfilSekolah::first(); 
        return view('auth.login', compact('profil'));
    }

    public function login(Request $request)
    {
        // --- BAGIAN YANG DIPERBARUI ---
        $credentials = $request->validate([
            'username' => ['required', 'string'], 
            'password' => ['required'],
        ]);

        // Coba login menggunakan username dan password
        if (Auth::attempt(['username' => $credentials['username'], 'password' => $credentials['password']])) {
            $request->session()->regenerate();
            
            return redirect()->intended('/admin/dashboard')
                             ->with('success', 'Login berhasil! Selamat datang kembali.');
        }

        // Pesan error jika gagal
        return back()->with('error', 'Username atau Password yang Anda masukkan salah.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect('/login')->with('success', 'Anda telah berhasil logout.');
    }
}

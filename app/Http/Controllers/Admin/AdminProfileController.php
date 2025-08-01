<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class AdminProfileController extends Controller
{
    public function index()
    {
        $admin = Auth::user();
        return view('admin.profil_admin.index', compact('admin'));
    }

    public function update(Request $request)
    {
        // Mendapatkan data admin yang sedang login
        $admin = Auth::user();

        // Validasi semua input dari form
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => ['required', 'string', 'max:255', Rule::unique('users')->ignore($admin->id)],
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        // Memperbarui data admin
        $admin->name = $request->name;
        $admin->username = $request->username;

        // Memperbarui password jika diisi
        if ($request->filled('password')) {
            $admin->password = Hash::make($request->password);
        }

        // Memperbarui foto jika ada file baru yang diupload
        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($admin->foto) {
                Storage::disk('public')->delete($admin->foto);
            }
            // Simpan foto baru
            $admin->foto = $request->file('foto')->store('admin_photos', 'public');
        }

        // Menyimpan semua perubahan ke database
        $admin->save();

        return redirect()->route('admin.profil_admin.index')->with('success', 'Profil berhasil diperbarui.');
    }
}

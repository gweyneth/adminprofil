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

    /**
     * Memperbarui data profil admin (nama, username, foto).
     */
    public function updateProfile(Request $request)
    {
        $admin = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'username' => ['required', 'string', 'max:255', Rule::unique('users')->ignore($admin->id)],
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $admin->name = $request->name;
        $admin->username = $request->username;

        if ($request->hasFile('foto')) {
            if ($admin->foto) {
                Storage::disk('public')->delete($admin->foto);
            }
            $admin->foto = $request->file('foto')->store('admin_photos', 'public');
        }

        $admin->save();

        return redirect()->route('admin.profil_admin.index')->with('success_profile', 'Profil berhasil diperbarui.');
    }

    /**
     * Memperbarui password admin.
     */
    public function updatePassword(Request $request)
    {
        $admin = Auth::user();

        $request->validate([
            'current_password' => 'required',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Cek apakah password saat ini cocok
        if (!Hash::check($request->current_password, $admin->password)) {
            return back()->with('error_password', 'Password saat ini tidak cocok.');
        }

        $admin->password = Hash::make($request->password);
        $admin->save();

        return redirect()->route('admin.profil_admin.index')->with('success_password', 'Password berhasil diubah.');
    }
}

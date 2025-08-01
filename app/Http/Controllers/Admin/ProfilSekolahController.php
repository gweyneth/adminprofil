<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProfilSekolah;
use Illuminate\Support\Facades\Storage;

class ProfilSekolahController extends Controller
{
    /**
     * Menampilkan form untuk mengedit atau membuat profil sekolah.
     */
    public function index()
    {
        // Ambil data profil pertama, atau buat instance baru jika tidak ada
        $profil = ProfilSekolah::firstOrNew([]);
        return view('admin.profil.index', compact('profil'));
    }

    /**
     * Menyimpan data profil sekolah (baik membuat baru atau update).
     */
    public function storeOrUpdate(Request $request)
    {
        $request->validate([
            'nama_sekolah' => 'required|string|max:100',
            'npsn' => 'nullable|string|max:20',
            'alamat' => 'required|string',
            'no_telp' => 'required|string|max:20',
            'email' => 'required|email|max:100',
            'sejarah' => 'required|string',
            'visi' => 'required|string',
            'misi' => 'required|string',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'maps' => 'nullable|string',
            'facebook_url' => 'nullable|url',
            'instagram_url' => 'nullable|url',
            'youtube_url' => 'nullable|url',
        ]);

        // Cari data profil, atau buat instance baru
        $profil = ProfilSekolah::firstOrNew(['id' => 1]);
        
        // Ambil semua data kecuali logo
        $data = $request->except('logo');

        // Proses upload logo jika ada file baru
        if ($request->hasFile('logo')) {
            // Hapus logo lama jika ada
            if ($profil->logo && Storage::disk('public')->exists($profil->logo)) {
                Storage::disk('public')->delete($profil->logo);
            }
            // Simpan logo baru dan dapatkan path-nya
            $data['logo'] = $request->file('logo')->store('logos', 'public');
        }
        
        // Isi data dan simpan
        $profil->fill($data)->save();

        return redirect()->route('admin.profil.index')
                         ->with('success', 'Profil Sekolah berhasil diperbarui.');
    }
}

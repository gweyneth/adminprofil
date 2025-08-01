<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Organigram;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class OrganigramController extends Controller
{
    /**
     * Menampilkan halaman form organigram.
     */
    public function index()
    {
        // Ambil data organigram pertama, atau null jika tidak ada
        $organigram = Organigram::first();
        return view('admin.organigram.index', compact('organigram'));
    }

    /**
     * Menyimpan atau memperbarui data organigram.
     */
    public function storeOrUpdate(Request $request)
    {
        $request->validate([
            'deskripsi' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:4096', // Max 4MB
        ]);

        // Cari data organigram, atau buat instance baru jika belum ada
        $organigram = Organigram::firstOrNew(['id' => 1]);

        // Proses upload gambar jika ada file baru
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($organigram->gambar && Storage::disk('public')->exists($organigram->gambar)) {
                Storage::disk('public')->delete($organigram->gambar);
            }
            // Simpan gambar baru dan dapatkan path-nya
            $organigram->gambar = $request->file('gambar')->store('organigram', 'public');
        }
        
        // Isi deskripsi dan simpan
        $organigram->deskripsi = $request->deskripsi;
        $organigram->save();

        return redirect()->route('admin.organigram.index')
                         ->with('success', 'Organigram Sekolah berhasil diperbarui.');
    }

    /**
     * Menghapus gambar organigram yang ada.
     */
    public function destroyImage()
    {
        $organigram = Organigram::first();

        if ($organigram && $organigram->gambar) {
            Storage::disk('public')->delete($organigram->gambar);
            $organigram->gambar = null;
            $organigram->save();
            return redirect()->route('admin.organigram.index')->with('success', 'Gambar organigram berhasil dihapus.');
        }

        return redirect()->route('admin.organigram.index')->with('error', 'Tidak ada gambar untuk dihapus.');
    }
}

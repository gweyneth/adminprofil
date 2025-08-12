<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Background;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BackgroundController extends Controller
{
    public function index()
    {
        // Ambil semua data background, gunakan 'halaman' sebagai key untuk akses mudah di view
        $backgrounds = Background::all()->keyBy('halaman');
        
        // Definisikan semua halaman yang membutuhkan background
        $halamanList = [
            'beranda_1' => 'Beranda (Slider 1)',
            'beranda_2' => 'Beranda (Slider 2)',
            'visi_misi' => 'Visi & Misi',
            'organigram' => 'Organigram',
            'jurusan' => 'Jurusan',
            'guru' => 'Guru & Staf',
            'prestasi' => 'Prestasi',
            'sarana' => 'Sarana & Prasarana',
            'konten' => 'Berita, Artikel, Pengumuman, Agenda',
            'galeri' => 'Galeri',
            'ekstrakurikuler' => 'Ekstrakurikuler',
            'testimoni' => 'Testimoni',
            'kontak' => 'Kontak',
        ];

        return view('admin.background.index', compact('backgrounds', 'halamanList'));
    }

    public function store(Request $request)
    {
        // Validasi semua input file
        $request->validate([
            'backgrounds.*' => 'nullable|image|mimes:jpg,png,jpeg|max:2048', // Maks 2MB
        ]);

        if ($request->hasFile('backgrounds')) {
            foreach ($request->file('backgrounds') as $halaman => $file) {
                // Cari data background yang ada, atau buat instance baru
                $background = Background::firstOrNew(['halaman' => $halaman]);

                // Hapus gambar lama jika ada
                if ($background->gambar && Storage::disk('public')->exists($background->gambar)) {
                    Storage::disk('public')->delete($background->gambar);
                }

                // Simpan gambar baru dan update path di database
                $path = $file->store('backgrounds', 'public');
                $background->gambar = $path;
                $background->save();
            }
        }

        return redirect()->route('admin.background.index')->with('success', 'Gambar background berhasil diperbarui.');
    }
}

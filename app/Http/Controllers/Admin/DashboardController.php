<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Jurusan;
use App\Models\Guru;
use App\Models\Konten;
use App\Models\Galeri;
use App\Models\Prestasi;
use App\Models\Ekstrakurikuler;
use App\Models\Testimoni; // <-- Import Testimoni

class DashboardController extends Controller
{
    public function index()
    {
        // Menghitung jumlah data dari setiap model
        $jumlahJurusan = Jurusan::count();
        $jumlahGuru = Guru::count();
        $jumlahKonten = Konten::count();
        $jumlahGaleri = Galeri::count();
        $jumlahPrestasi = Prestasi::count();
        $jumlahEskul = Ekstrakurikuler::count();

        // --- BAGIAN BARU: Mengambil data untuk feed aktivitas ---
        // Ambil 5 testimoni terbaru yang belum dipublikasikan
        $testimonisBaru = Testimoni::where('is_published', false)->latest()->take(5)->get();
        // Ambil 5 konten terbaru
        $kontenTerbaru = Konten::latest()->take(5)->get();
        
        // Gabungkan semua aktivitas menjadi satu koleksi dan urutkan berdasarkan tanggal dibuat
        $aktivitasTerbaru = collect($testimonisBaru)->merge($kontenTerbaru)->sortByDesc('created_at');

        // Mengirim semua data ke view
        return view('admin.dashboard', compact(
            'jumlahJurusan',
            'jumlahGuru',
            'jumlahKonten',
            'jumlahGaleri',
            'jumlahPrestasi',
            'jumlahEskul',
            'aktivitasTerbaru' // <-- Kirim data aktivitas
        ));
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimoni;
use Illuminate\Http\Request;

class TestimoniController extends Controller
{
    /**
     * Menampilkan halaman daftar testimoni untuk moderasi.
     */
    public function index()
    {
        $testimonis = Testimoni::latest()->paginate(10);
        return view('admin.testimoni.index', compact('testimonis'));
    }

    /**
     * Menghapus data testimoni.
     */
    public function destroy(Testimoni $testimoni)
    {
        if ($testimoni->foto) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($testimoni->foto);
        }
        $testimoni->delete();

        return redirect()->route('admin.testimoni.index')->with('success', 'Testimoni berhasil dihapus.');
    }

    /**
     * Mengubah status publikasi (published/draft).
     */
    public function toggleStatus(Testimoni $testimoni)
    {
        $testimoni->is_published = !$testimoni->is_published;
        $testimoni->save();

        return response()->json(['status' => 'success', 'is_published' => $testimoni->is_published]);
    }
}

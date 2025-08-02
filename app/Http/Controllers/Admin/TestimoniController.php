<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimoni;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TestimoniController extends Controller
{
    public function index()
    {
        $testimonis = Testimoni::latest()->paginate(9); // Diubah ke 9 agar pas dengan layout 3 kolom
        return view('admin.testimoni.index', compact('testimonis'));
    }

    // --- FUNGSI BARU UNTUK MODAL ---
    public function show(Testimoni $testimoni)
    {
        // Siapkan URL foto untuk dikirim sebagai JSON
        $testimoni->foto_url = $testimoni->foto 
            ? Storage::url($testimoni->foto) 
            : 'https://ui-avatars.com/api/?name='.urlencode($testimoni->nama_pemberi).'&background=random';
        
        return response()->json($testimoni);
    }

    public function destroy(Testimoni $testimoni)
    {
        if ($testimoni->foto) {
            Storage::disk('public')->delete($testimoni->foto);
        }
        $testimoni->delete();

        return redirect()->route('admin.testimoni.index')->with('success', 'Testimoni berhasil dihapus.');
    }

    public function toggleStatus(Testimoni $testimoni)
    {
        $testimoni->is_published = !$testimoni->is_published;
        $testimoni->save();

        return response()->json(['status' => 'success', 'is_published' => $testimoni->is_published]);
    }
}

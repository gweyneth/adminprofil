<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Konten;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class KontenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Menghapus with('user') karena relasi sudah tidak ada
        $konten = Konten::latest()->paginate(10);
        return view('admin.konten.index', compact('konten'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.konten.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'jenis' => 'required|in:berita,artikel,pengumuman,agenda',
            'tgl_publikasi' => 'required|date',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->judul, '-');
        
        // Logika untuk user_id dihapus
        // $data['user_id'] = auth()->id(); 

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('konten', 'public');
        }

        Konten::create($data);

        return redirect()->route('admin.konten.index')->with('success', 'Konten berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     * * Catatan: Metode show() tidak digunakan dalam alur CRUD ini, 
     * tapi dibiarkan kosong untuk kelengkapan resource controller.
     */
    public function show(Konten $konten)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Konten $konten)
    {
        return view('admin.konten.edit', compact('konten'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Konten $konten)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'jenis' => 'required|in:berita,artikel,pengumuman,agenda',
            'tgl_publikasi' => 'required|date',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->judul, '-');

        if ($request->hasFile('gambar')) {
            if ($konten->gambar) {
                Storage::disk('public')->delete($konten->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('konten', 'public');
        }

        $konten->update($data);

        return redirect()->route('admin.konten.index')->with('success', 'Konten berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Konten $konten)
    {
        if ($konten->gambar) {
            Storage::disk('public')->delete($konten->gambar);
        }
        $konten->delete();

        return redirect()->route('admin.konten.index')->with('success', 'Konten berhasil dihapus.');
    }
}

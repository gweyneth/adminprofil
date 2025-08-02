<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Konten;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class KontenController extends Controller
{
    public function index(Request $request)
    {
        $all_jenis_for_filter = Konten::select('jenis')->distinct()->get();
        $query = Konten::query();

        if ($request->filled('search')) {
            $query->where('judul', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('filter_jenis')) {
            $query->where('jenis', $request->filter_jenis);
        }

        $konten = $query->latest()->paginate(12);

        return view('admin.konten.index', compact('konten', 'all_jenis_for_filter'));
    }

    // --- FUNGSI BARU UNTUK MODAL ---
    public function show(Konten $konten)
    {
        // Siapkan URL gambar untuk dikirim sebagai JSON
        $konten->gambar_url = $konten->gambar 
            ? Storage::url($konten->gambar) 
            : 'https://placehold.co/600x400/e2e8f0/e2e8f0?text=.';
        
        return response()->json($konten);
    }

    public function create()
    {
        return view('admin.konten.create');
    }

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

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('konten', 'public');
        }

        Konten::create($data);

        return redirect()->route('admin.konten.index')->with('success', 'Konten berhasil ditambahkan.');
    }

    public function edit(Konten $konten)
    {
        return view('admin.konten.edit', compact('konten'));
    }

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

    public function destroy(Konten $konten)
    {
        if ($konten->gambar) {
            Storage::disk('public')->delete($konten->gambar);
        }
        $konten->delete();

        return redirect()->route('admin.konten.index')->with('success', 'Konten berhasil dihapus.');
    }
}

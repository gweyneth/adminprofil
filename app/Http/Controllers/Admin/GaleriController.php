<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Galeri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GaleriController extends Controller
{
    public function index(Request $request)
    {
        $query = Galeri::query();

        // Logika untuk input pencarian
        if ($request->filled('search')) {
            $query->where('judul', 'like', '%' . $request->search . '%');
        }

        // Logika untuk filter dropdown
        if ($request->filled('filter_tipe')) {
            $query->where('tipe', $request->filter_tipe);
        }

        $galeris = $query->latest()->paginate(12);
        return view('admin.galeri.index', compact('galeris'));
    }

    public function create()
    {
        return view('admin.galeri.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'tipe' => 'required|in:foto,video',
            'file_foto' => 'required_if:tipe,foto|image|mimes:jpeg,png,jpg,gif|max:2048',
            'file_video' => 'required_if:tipe,video|nullable|url',
        ]);

        $data = $request->only('judul', 'tipe');

        if ($request->tipe == 'foto') {
            $data['file'] = $request->file('file_foto')->store('galeri', 'public');
        } else {
            $data['file'] = $request->file_video;
        }

        Galeri::create($data);

        return redirect()->route('admin.galeri.index')->with('success', 'Item galeri berhasil ditambahkan.');
    }

    public function edit(Galeri $galeri)
    {
        return view('admin.galeri.edit', compact('galeri'));
    }

    public function update(Request $request, Galeri $galeri)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
        ]);

        $galeri->update($request->only('judul'));

        return redirect()->route('admin.galeri.index')->with('success', 'Judul item galeri berhasil diperbarui.');
    }

    public function destroy(Galeri $galeri)
    {
        if ($galeri->tipe == 'foto' && $galeri->file) {
            Storage::disk('public')->delete($galeri->file);
        }
        $galeri->delete();

        return redirect()->route('admin.galeri.index')->with('success', 'Item galeri berhasil dihapus.');
    }
}

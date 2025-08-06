<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Organigram;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class OrganigramController extends Controller
{
    public function index(Request $request)
    {
        $all_organigrams_for_filter = Organigram::select('nama_organigram')->distinct()->get();
        $query = Organigram::query();

        if ($request->filled('filter_nama')) {
            $query->where('nama_organigram', $request->filter_nama);
        }

        $organigrams = $query->latest()->paginate(12);
        return view('admin.organigram.index', compact('organigrams', 'all_organigrams_for_filter'));
    }

    public function create()
    {
        return view('admin.organigram.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_organigram' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,svg|max:4096',
        ]);

        $data = $request->all();

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('organigram', 'public');
        }

        Organigram::create($data);

        return redirect()->route('admin.organigram.index')->with('success', 'Organigram berhasil ditambahkan.');
    }

    public function show(Organigram $organigram)
    {
        $organigram->gambar_url = $organigram->gambar ? Storage::url($organigram->gambar) : 'https://placehold.co/600x400/e2e8f0/e2e8f0?text=.';
        return response()->json($organigram);
    }

    public function edit(Organigram $organigram)
    {
        return view('admin.organigram.edit', compact('organigram'));
    }

    public function update(Request $request, Organigram $organigram)
    {
        $request->validate([
            'nama_organigram' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:4096',
        ]);

        $data = $request->all();

        if ($request->hasFile('gambar')) {
            if ($organigram->gambar) {
                Storage::disk('public')->delete($organigram->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('organigram', 'public');
        }

        $organigram->update($data);

        return redirect()->route('admin.organigram.index')->with('success', 'Organigram berhasil diperbarui.');
    }

    public function destroy(Organigram $organigram)
    {
        if ($organigram->gambar) {
            Storage::disk('public')->delete($organigram->gambar);
        }
        $organigram->delete();

        return redirect()->route('admin.organigram.index')->with('success', 'Organigram berhasil dihapus.');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Guru;
use App\Models\Jurusan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GuruController extends Controller
{
    public function index(Request $request)
    {
        $jurusans = Jurusan::all();
        $query = Guru::with('jurusan');

        if ($request->filled('search')) {
            $query->where('nama', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('filter_jurusan')) {
            $query->where('jurusan_id', $request->filter_jurusan);
        }

        $guru = $query->latest()->paginate(12);
        return view('admin.guru.index', compact('guru', 'jurusans'));
    }

    // --- FUNGSI BARU UNTUK MODAL ---
    public function show(Guru $guru)
    {
        // Load relasi jurusan
        $guru->load('jurusan');

        // Siapkan URL foto
        $guru->foto_url = $guru->foto
            ? Storage::url($guru->foto)
            : 'https://ui-avatars.com/api/?name='.urlencode($guru->nama).'&background=random&color=fff';

        // Siapkan nama jurusan
        $guru->jurusan_nama = $guru->jurusan->nama_jurusan ?? 'Umum / Staf';

        return response()->json($guru);
    }

    public function create()
    {
        $jurusans = Jurusan::all();
        return view('admin.guru.create', compact('jurusans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:100',
            'nuptk' => 'nullable|string|max:30|unique:gurus,nuptk',
            'jabatan' => 'required|string|max:100',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'jurusan_id' => 'nullable|exists:jurusans,id',
            'instagram_url' => 'nullable|url',
        ]);

        $data = $request->all();

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('guru', 'public');
        }

        Guru::create($data);

        return redirect()->route('admin.guru.index')->with('success', 'Data Guru/Staf berhasil ditambahkan.');
    }

    public function edit(Guru $guru)
    {
        $jurusans = Jurusan::all();
        return view('admin.guru.edit', compact('guru', 'jurusans'));
    }

    public function update(Request $request, Guru $guru)
    {
        $request->validate([
            'nama' => 'required|string|max:100',
            'nuptk' => 'nullable|string|max:30|unique:gurus,nuptk,' . $guru->id,
            'jabatan' => 'required|string|max:100',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'jurusan_id' => 'nullable|exists:jurusans,id',
            'instagram_url' => 'nullable|url',
        ]);

        $data = $request->all();

        if ($request->hasFile('foto')) {
            if ($guru->foto) {
                Storage::disk('public')->delete($guru->foto);
            }
            $data['foto'] = $request->file('foto')->store('guru', 'public');
        }

        $guru->update($data);

        return redirect()->route('admin.guru.index')->with('success', 'Data Guru/Staf berhasil diperbarui.');
    }

    public function destroy(Guru $guru)
    {
        if ($guru->foto) {
            Storage::disk('public')->delete($guru->foto);
        }
        $guru->delete();

        return redirect()->route('admin.guru.index')->with('success', 'Data Guru/Staf berhasil dihapus.');
    }
}

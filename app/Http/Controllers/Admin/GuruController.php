<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Guru;
use App\Models\Jurusan; // <-- Import model Jurusan
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GuruController extends Controller
{
    public function index()
    {
        // Gunakan with('jurusan') untuk eager loading agar lebih efisien
        $guru = Guru::with('jurusan')->latest()->paginate(10);
        return view('admin.guru.index', compact('guru'));
    }

    public function create()
    {
        // Ambil semua data jurusan untuk ditampilkan di dropdown form
        $jurusans = Jurusan::all();
        return view('admin.guru.create', compact('jurusans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:100',
            'nip' => 'nullable|string|max:30|unique:gurus,nip',
            'jabatan' => 'required|string|max:100',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'jurusan_id' => 'nullable|exists:jurusans,id', // Validasi relasi
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
            'nip' => 'nullable|string|max:30|unique:gurus,nip,' . $guru->id,
            'jabatan' => 'required|string|max:100',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'jurusan_id' => 'nullable|exists:jurusans,id',
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

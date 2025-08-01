<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sarana;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SaranaController extends Controller
{
    public function index()
    {
        $saranas = Sarana::latest()->paginate(10);
        return view('admin.sarana.index', compact('saranas'));
    }

    public function create()
    {
        return view('admin.sarana.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_sarana' => 'required|string|max:100',
            'deskripsi' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('sarana', 'public');
        }

        Sarana::create($data);

        return redirect()->route('admin.sarana.index')->with('success', 'Data Sarana berhasil ditambahkan.');
    }

    public function edit(Sarana $sarana)
    {
        return view('admin.sarana.edit', compact('sarana'));
    }

    public function update(Request $request, Sarana $sarana)
    {
        $request->validate([
            'nama_sarana' => 'required|string|max:100',
            'deskripsi' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('gambar')) {
            if ($sarana->gambar) {
                Storage::disk('public')->delete($sarana->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('sarana', 'public');
        }

        $sarana->update($data);

        return redirect()->route('admin.sarana.index')->with('success', 'Data Sarana berhasil diperbarui.');
    }

    public function destroy(Sarana $sarana)
    {
        if ($sarana->gambar) {
            Storage::disk('public')->delete($sarana->gambar);
        }
        $sarana->delete();

        return redirect()->route('admin.sarana.index')->with('success', 'Data Sarana berhasil dihapus.');
    }
}

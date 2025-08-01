<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PostEkstrakurikuler;
use App\Models\Ekstrakurikuler; // <-- Import model Ekstrakurikuler
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostEkstrakurikulerController extends Controller
{
    public function index()
    {
        $posts = PostEkstrakurikuler::with('ekstrakurikuler')->latest()->paginate(10);
        return view('admin.post_ekstrakurikuler.index', compact('posts'));
    }

    public function create()
    {
        $eskuls = Ekstrakurikuler::all();
        return view('admin.post_ekstrakurikuler.create', compact('eskuls'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kegiatan' => 'required|string|max:255',
            'ekstrakurikuler_id' => 'required|exists:ekstrakurikulers,id',
            'deskripsi' => 'required|string',
            'foto_kegiatan' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('foto_kegiatan')) {
            $data['foto_kegiatan'] = $request->file('foto_kegiatan')->store('post-ekstrakurikuler', 'public');
        }

        PostEkstrakurikuler::create($data);

        return redirect()->route('admin.post-ekstrakurikuler.index')->with('success', 'Postingan kegiatan berhasil ditambahkan.');
    }

    public function edit(PostEkstrakurikuler $postEkstrakurikuler)
    {
        $eskuls = Ekstrakurikuler::all();
        return view('admin.post_ekstrakurikuler.edit', compact('postEkstrakurikuler', 'eskuls'));
    }

    public function update(Request $request, PostEkstrakurikuler $postEkstrakurikuler)
    {
        $request->validate([
            'nama_kegiatan' => 'required|string|max:255',
            'ekstrakurikuler_id' => 'required|exists:ekstrakurikulers,id',
            'deskripsi' => 'required|string',
            'foto_kegiatan' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('foto_kegiatan')) {
            if ($postEkstrakurikuler->foto_kegiatan) {
                Storage::disk('public')->delete($postEkstrakurikuler->foto_kegiatan);
            }
            $data['foto_kegiatan'] = $request->file('foto_kegiatan')->store('post-ekstrakurikuler', 'public');
        }

        $postEkstrakurikuler->update($data);

        return redirect()->route('admin.post-ekstrakurikuler.index')->with('success', 'Postingan kegiatan berhasil diperbarui.');
    }

    public function destroy(PostEkstrakurikuler $postEkstrakurikuler)
    {
        if ($postEkstrakurikuler->foto_kegiatan) {
            Storage::disk('public')->delete($postEkstrakurikuler->foto_kegiatan);
        }
        $postEkstrakurikuler->delete();

        return redirect()->route('admin.post-ekstrakurikuler.index')->with('success', 'Postingan kegiatan berhasil dihapus.');
    }
}

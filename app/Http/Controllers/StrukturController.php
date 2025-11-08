<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StrukturOrganisasi;


class StrukturController extends Controller
{
    // Menampilkan halaman admin Struktur Organisasi
    public function index()
    {
        $struktur = StrukturOrganisasi::all();
        return view('admin.struktur', compact('struktur'));
    }

    // **Method untuk menambah anggota baru**
    public function store(Request $request)
    {
        $request->validate([
            'jabatan' => 'required|string|max:255',
            'nama' => 'required|string|max:255'
        ]);

        StrukturOrganisasi::create([
            'jabatan' => $request->jabatan,
            'nama' => $request->nama
        ]);

        return redirect()->back()->with('success', 'Anggota struktur organisasi berhasil ditambahkan!');
    }

    // Method update jika ingin edit anggota
    public function update(Request $request)
    {
        $request->validate([
            'jabatan.*' => 'required|string',
            'nama.*' => 'required|string',
            'id.*' => 'required|integer'
        ]);

        foreach ($request->id as $index => $id) {
            StrukturOrganisasi::where('id', $id)->update([
                'jabatan' => $request->jabatan[$index],
                'nama' => $request->nama[$index]
            ]);
        }

        return redirect()->back()->with('success', 'Struktur organisasi berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $anggota = StrukturOrganisasi::findOrFail($id);
        $anggota->delete();

        return redirect()->back()->with('success', 'Anggota struktur organisasi berhasil dihapus!');
    }

}

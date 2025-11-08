<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Promo;

class PromoController extends Controller
{
    public function index()
    {
        $promos = Promo::latest()->get();
        return view('admin.promos.index', compact('promos'));
    }

    public function create()
    {
        return view('admin.promos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'nullable',
            'diskon' => 'required|integer|min:0|max:100',
            'image' => 'nullable|image'
        ]);

        $image = $request->image
            ? $request->image->store('promo', 'public')
            : null;

        Promo::create([
            'title' => $request->title,
            'description' => $request->description,
            'diskon' => $request->diskon,
            'image' => $image
        ]);

        return redirect('/admin/promos')->with('success', 'Promo berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $promo = Promo::findOrFail($id);
        return view('admin.promos.edit', compact('promo'));
    }

    public function update(Request $request, $id)
    {
        $promo = Promo::findOrFail($id);

        $request->validate([
            'title' => 'required',
            'description' => 'nullable',
            'diskon' => 'required|integer|min:0|max:100',
            'image' => 'nullable|image'
        ]);

        if ($request->image) {
            $promo->image = $request->image->store('promo', 'public');
        }

        $promo->title = $request->title;
        $promo->description = $request->description;
        $promo->diskon = $request->diskon;

        $promo->save();

        return redirect('/admin/promos')->with('success', 'Promo berhasil diupdate!');
    }

    public function destroy($id)
    {
        Promo::findOrFail($id)->delete();
        return back()->with('success', 'Promo berhasil dihapus!');
    }
}

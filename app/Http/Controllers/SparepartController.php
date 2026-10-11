<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSparepartRequest;
use App\Http\Requests\UpdateSparepartRequest;
use App\Models\Kategori;
use App\Models\Sparepart;

class SparepartController extends Controller
{
    public function index()
    {
        $spareparts = Sparepart::with('kategori')
            ->latest()
            ->get();

        return view('spareparts.index', compact('spareparts'));
    }

    public function create()
    {
        $kategoris = Kategori::all();

        return view('spareparts.create', compact('kategoris'));
    }

    public function store(StoreSparepartRequest $request)
    {
        Sparepart::create($request->validated());

        return redirect()
            ->route('spareparts.index')
            ->with('success', 'Sparepart berhasil ditambahkan.');
    }

    public function show(Sparepart $sparepart)
    {
        return redirect()->route('spareparts.index');
    }

    public function edit(Sparepart $sparepart)
    {
        $kategoris = Kategori::all();

        return view(
            'spareparts.edit',
            compact('sparepart', 'kategoris')
        );
    }

    public function update(
        UpdateSparepartRequest $request,
        Sparepart $sparepart
    ) {
        $sparepart->update($request->validated());

        return redirect()
            ->route('spareparts.index')
            ->with('success', 'Sparepart berhasil diperbarui.');
    }

    public function destroy(Sparepart $sparepart)
    {
        $sparepart->delete();

        return redirect()
            ->route('spareparts.index')
            ->with('success', 'Sparepart berhasil dihapus.');
    }
}
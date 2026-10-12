<?php

namespace App\Http\Controllers;

use App\Models\Sparepart;
use App\Models\Supplier;
use App\Models\TransaksiKeluar;
use App\Models\TransaksiMasuk;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class TransaksiStokController extends Controller
{
    public function dashboard()
    {
        if (! Schema::hasTable('spareparts')) {
            return view('transaksi.dashboard', [
                'totalSparepart' => 0,
                'totalStok' => 0,
                'stokMasukBulanIni' => 0,
                'stokKeluarBulanIni' => 0,
            ]);
        }

        $totalSparepart = Sparepart::count();
        $totalStok = Sparepart::sum('stok');
        $stokMasukBulanIni = TransaksiMasuk::whereMonth('tanggal', now()->month)->sum('jumlah');
        $stokKeluarBulanIni = TransaksiKeluar::whereMonth('tanggal', now()->month)->sum('jumlah');

        return view('transaksi.dashboard', compact(
            'totalSparepart',
            'totalStok',
            'stokMasukBulanIni',
            'stokKeluarBulanIni'
        ));
    }

    public function indexMasuk()
    {
        $spareparts = Sparepart::with('kategori')->orderBy('nama_sparepart')->get();
        $suppliers = Supplier::orderBy('nama_supplier')->get();
        $transaksi = TransaksiMasuk::with(['sparepart.kategori', 'supplier'])->latest()->get();

        return view('transaksi.masuk', compact('spareparts', 'suppliers', 'transaksi'));
    }

    public function storeMasuk(Request $request)
    {
        $validated = $request->validate([
            'id_sparepart' => ['required', 'exists:spareparts,id_sparepart'],
            'id_supplier' => ['required', 'exists:suppliers,id_supplier'],
            'jumlah' => ['required', 'integer', 'min:1'],
            'tanggal' => ['required', 'date'],
            'keterangan' => ['nullable', 'string', 'max:255'],
        ]);

        $sparepart = Sparepart::findOrFail($validated['id_sparepart']);
        $user = $this->resolveUser();

        TransaksiMasuk::create([
            'id_sparepart' => $sparepart->id_sparepart,
            'id_supplier' => $validated['id_supplier'],
            'id_user' => $user->id_user,
            'jumlah' => $validated['jumlah'],
            'tanggal' => $validated['tanggal'],
            'keterangan' => $validated['keterangan'] ?? null,
        ]);

        $sparepart->increment('stok', $validated['jumlah']);

        return redirect()->route('transaksi.masuk')->with('success', 'Transaksi stok masuk berhasil disimpan.');
    }

    public function indexKeluar()
    {
        $spareparts = Sparepart::with('kategori')->orderBy('nama_sparepart')->get();
        $transaksi = TransaksiKeluar::with(['sparepart.kategori'])->latest()->get();

        return view('transaksi.keluar', compact('spareparts', 'transaksi'));
    }

    public function storeKeluar(Request $request)
    {
        $validated = $request->validate([
            'id_sparepart' => ['required', 'exists:spareparts,id_sparepart'],
            'jumlah' => ['required', 'integer', 'min:1'],
            'tanggal' => ['required', 'date'],
            'keterangan' => ['nullable', 'string', 'max:255'],
        ]);

        $sparepart = Sparepart::findOrFail($validated['id_sparepart']);

        if ($sparepart->stok < $validated['jumlah']) {
            return back()->withErrors([
                'jumlah' => 'Jumlah stok keluar melebihi stok yang tersedia.',
            ])->withInput();
        }

        $user = $this->resolveUser();

        TransaksiKeluar::create([
            'id_sparepart' => $sparepart->id_sparepart,
            'id_user' => $user->id_user,
            'jumlah' => $validated['jumlah'],
            'tanggal' => $validated['tanggal'],
            'keterangan' => $validated['keterangan'] ?? null,
        ]);

        $sparepart->decrement('stok', $validated['jumlah']);

        return redirect()->route('transaksi.keluar')->with('success', 'Transaksi stok keluar berhasil disimpan.');
    }

    protected function resolveUser(): User
    {
        $user = User::first();

        if ($user) {
            return $user;
        }

        return User::create([
            'nama' => 'Admin Bengkel',
            'username' => 'adminbengkel',
            'password' => bcrypt('admin123'),
            'role' => 'admin',
        ]);
    }
}

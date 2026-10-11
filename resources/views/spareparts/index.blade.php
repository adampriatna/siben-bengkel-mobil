<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Manajemen Stok Sparepart</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f4f6f9; padding: 25px; }
        .container { max-width: 1100px; margin: auto; background: white; padding: 24px; border-radius: 10px; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th, td { border: 1px solid #ddd; padding: 10px; text-align: left; }
        th { background: #212529; color: white; }
        .btn { display: inline-block; padding: 8px 12px; border-radius: 5px; color: white; text-decoration: none; border: 0; cursor: pointer; }
        .add { background: #198754; margin-bottom: 12px; }
        .edit { background: #0d6efd; }
        .delete { background: #dc3545; }
        .alert { padding: 10px; background: #d1e7dd; margin-bottom: 15px; }
        form { display: inline; }
    </style>
</head>
<body>
<div class="container">
    <h1>Manajemen Stok Sparepart</h1>
    <p>Kelola data sparepart bengkel.</p>

    @if (session('success'))
        <div class="alert">{{ session('success') }}</div>
    @endif

    @if ($errors->any())
        <div class="alert">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <a class="btn add" href="{{ route('spareparts.create') }}">+ Tambah Sparepart</a>

    <table>
        <thead>
        <tr>
            <th>No.</th>
            <th>Kode</th>
            <th>Nama</th>
            <th>Kategori</th>
            <th>Harga</th>
            <th>Stok</th>
            <th>Aksi</th>
        </tr>
        </thead>
        <tbody>
        @forelse ($spareparts as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->kode_sparepart }}</td>
                <td>{{ $item->nama_sparepart }}</td>
                <td>{{ $item->kategori->nama_kategori ?? '-' }}</td>
                <td>Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
                <td>{{ $item->stok }}</td>
                <td>
                    <a class="btn edit" href="{{ route('spareparts.edit', $item) }}">Edit</a>
                    <form action="{{ route('spareparts.destroy', $item) }}" method="POST"
                          onsubmit="return confirm('Yakin ingin menghapus sparepart ini?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn delete" type="submit">Hapus</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr><td colspan="7">Belum ada data sparepart.</td></tr>
        @endforelse
        </tbody>
    </table>

    <p><a href="{{ route('admin.dashboard') }}">Kembali ke Dashboard</a></p>
</div>
</body>
</html>
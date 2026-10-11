<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Sparepart</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f4f6f9; padding: 25px; }
        .container { max-width: 650px; margin: auto; background: white; padding: 25px; border-radius: 10px; }
        label { display: block; margin-top: 14px; font-weight: bold; }
        input, select { width: 100%; padding: 10px; margin-top: 6px; box-sizing: border-box; }
        button, .back { display: inline-block; padding: 10px 15px; margin-top: 18px; border: 0; border-radius: 5px; cursor: pointer; text-decoration: none; }
        button { background: #0d6efd; color: white; }
        .back { background: #6c757d; color: white; }
        .errors { background: #f8d7da; padding: 10px; }
    </style>
</head>
<body>
<div class="container">
    <h1>Edit Sparepart</h1>

    @if ($errors->any())
        <div class="errors">
            <strong>Periksa kembali:</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('spareparts.update', $sparepart) }}" method="POST">
        @csrf
        @method('PUT')

        <label>Kode Sparepart</label>
        <input type="text" name="kode_sparepart"
               value="{{ old('kode_sparepart', $sparepart->kode_sparepart) }}" required>

        <label>Nama Sparepart</label>
        <input type="text" name="nama_sparepart"
               value="{{ old('nama_sparepart', $sparepart->nama_sparepart) }}" required>

        <label>Kategori</label>
        <select name="id_kategori" required>
            <option value="">-- Pilih Kategori --</option>
            @foreach ($kategoris as $kategori)
                <option value="{{ $kategori->id_kategori }}"
                    @selected(old('id_kategori', $sparepart->id_kategori) == $kategori->id_kategori)>
                    {{ $kategori->nama_kategori }}
                </option>
            @endforeach
        </select>

        <label>Harga</label>
        <input type="number" name="harga" min="0" step="0.01"
               value="{{ old('harga', $sparepart->harga) }}" required>

        <label>Stok</label>
        <input type="number" name="stok" min="0" step="1"
               value="{{ old('stok', $sparepart->stok) }}" required>

        <button type="submit">Simpan Perubahan</button>
        <a class="back" href="{{ route('spareparts.index') }}">Kembali</a>
    </form>
</div>
</body>
</html>
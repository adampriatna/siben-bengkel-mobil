<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaksi Stok Keluar</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * { box-sizing: border-box; }
        body { margin: 0; font-family: 'Inter', sans-serif; background: #f8fafc; color: #0f172a; }
        .container { max-width: 1180px; margin: 0 auto; padding: 32px 20px 60px; }
        .header { display: flex; justify-content: space-between; align-items: center; gap: 16px; margin-bottom: 24px; }
        h1 { margin: 0; }
        .nav { display: flex; gap: 10px; flex-wrap: wrap; }
        a { text-decoration: none; }
        .btn { display: inline-block; border-radius: 10px; padding: 10px 16px; font-weight: 600; }
        .btn-primary { background: #dc2626; color: white; }
        .btn-secondary { background: #e2e8f0; color: #0f172a; }
        .panel { background: white; border-radius: 18px; box-shadow: 0 10px 30px rgba(15, 23, 42, 0.06); padding: 24px; }
        .grid { display: grid; grid-template-columns: 1.1fr 1.5fr; gap: 24px; }
        .field { margin-bottom: 16px; }
        label { display: block; margin-bottom: 8px; font-weight: 600; }
        input, select, textarea { width: 100%; padding: 12px 14px; border: 1px solid #cbd5e1; border-radius: 10px; font: inherit; }
        .alert { padding: 12px 16px; border-radius: 10px; margin-bottom: 18px; }
        .alert-success { background: #dcfce7; color: #166534; }
        .alert-error { background: #fee2e2; color: #991b1b; }
        .error-list { margin: 0; padding-left: 18px; }
        table { width: 100%; border-collapse: collapse; margin-top: 18px; }
        th, td { padding: 12px 10px; border-bottom: 1px solid #e2e8f0; text-align: left; }
        th { font-size: 0.8rem; text-transform: uppercase; letter-spacing: 0.04em; color: #64748b; }
        .badge { padding: 6px 8px; border-radius: 999px; background: #fee2e2; color: #b91c1c; font-size: 0.8rem; }
        @media (max-width: 900px) { .grid { grid-template-columns: 1fr; } .header { flex-direction: column; align-items: flex-start; } }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Transaksi Stok Keluar</h1>
            <div class="nav">
                <a href="{{ route('dashboard') }}" class="btn btn-secondary">Dashboard</a>
                <a href="{{ route('transaksi.masuk') }}" class="btn btn-primary">Transaksi Masuk</a>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if($errors->any())
            <div class="alert alert-error">
                <ul class="error-list">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="grid">
            <div class="panel">
                <h2>Form Stok Keluar</h2>
                <form method="POST" action="{{ route('transaksi.keluar.store') }}">
                    @csrf
                    <div class="field">
                        <label for="id_sparepart">Sparepart</label>
                        <select name="id_sparepart" id="id_sparepart" required>
                            <option value="">Pilih sparepart</option>
                            @foreach($spareparts as $sparepart)
                                <option value="{{ $sparepart->id_sparepart }}" {{ old('id_sparepart') == $sparepart->id_sparepart ? 'selected' : '' }}>
                                    {{ $sparepart->kode_sparepart }} - {{ $sparepart->nama_sparepart }} ({{ $sparepart->stok }} stok)
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="field">
                        <label for="jumlah">Jumlah</label>
                        <input type="number" id="jumlah" name="jumlah" min="1" value="{{ old('jumlah') }}" required>
                    </div>
                    <div class="field">
                        <label for="tanggal">Tanggal</label>
                        <input type="date" id="tanggal" name="tanggal" value="{{ old('tanggal', now()->toDateString()) }}" required>
                    </div>
                    <div class="field">
                        <label for="keterangan">Keterangan</label>
                        <textarea id="keterangan" name="keterangan" rows="3">{{ old('keterangan') }}</textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan Transaksi</button>
                </form>
            </div>

            <div class="panel">
                <h2>Daftar Transaksi Keluar</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Sparepart</th>
                            <th>Jumlah</th>
                            <th>Tanggal</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($transaksi as $item)
                            <tr>
                                <td>{{ $item->sparepart->nama_sparepart ?? '-' }}</td>
                                <td><span class="badge">-{{ $item->jumlah }}</span></td>
                                <td>{{ \Carbon\Carbon::parse($item->tanggal)->format('d-m-Y') }}</td>
                                <td>{{ $item->keterangan ?? '-' }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4">Belum ada transaksi keluar.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>

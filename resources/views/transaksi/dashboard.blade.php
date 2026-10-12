<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Stok Bengkel</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * { box-sizing: border-box; }
        body {
            margin: 0;
            font-family: 'Inter', sans-serif;
            background: #f4f7fb;
            color: #1f2937;
        }
        .container { max-width: 1100px; margin: 0 auto; padding: 32px 20px 48px; }
        .topbar {
            display: flex; justify-content: space-between; align-items: center;
            margin-bottom: 28px;
        }
        .title {
            font-size: 2rem;
            margin: 0;
        }
        .nav {
            display: flex; gap: 12px; flex-wrap: wrap;
        }
        .btn {
            display: inline-block;
            padding: 10px 16px; border-radius: 10px;
            text-decoration: none; font-weight: 600;
            transition: 0.2s ease;
        }
        .btn-primary { background: #2563eb; color: white; }
        .btn-secondary { background: #e2e8f0; color: #0f172a; }
        .grid {
            display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 18px; margin-bottom: 24px;
        }
        .card {
            background: #fff; border-radius: 16px; padding: 22px; box-shadow: 0 10px 30px rgba(15, 23, 42, 0.06);
        }
        .label { font-size: 0.8rem; color: #6b7280; text-transform: uppercase; letter-spacing: 0.04em; }
        .value { font-size: 2rem; font-weight: 700; margin-top: 8px; }
        .mini { font-size: 0.92rem; color: #475569; margin-top: 8px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="topbar">
            <h1 class="title">Dashboard Stok Bengkel</h1>
            <div class="nav">
                <a href="{{ route('transaksi.masuk') }}" class="btn btn-primary">Transaksi Masuk</a>
                <a href="{{ route('transaksi.keluar') }}" class="btn btn-secondary">Transaksi Keluar</a>
            </div>
        </div>

        <div class="grid">
            <div class="card">
                <div class="label">Total Sparepart</div>
                <div class="value">{{ $totalSparepart }}</div>
                <div class="mini">Jumlah item sparepart</div>
            </div>
            <div class="card">
                <div class="label">Total Stok</div>
                <div class="value">{{ $totalStok }}</div>
                <div class="mini">Ketersediaan saat ini</div>
            </div>
            <div class="card">
                <div class="label">Stok Masuk</div>
                <div class="value">{{ $stokMasukBulanIni }}</div>
                <div class="mini">Bulan ini</div>
            </div>
            <div class="card">
                <div class="label">Stok Keluar</div>
                <div class="value">{{ $stokKeluarBulanIni }}</div>
                <div class="mini">Bulan ini</div>
            </div>
        </div>
    </div>
</body>
</html>

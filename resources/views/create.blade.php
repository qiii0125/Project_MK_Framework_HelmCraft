<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>HelmCraft - Tambah Order</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('stylein.css') }}">
</head>
<body>
    <nav class="navbar topbar px-4 py-3 mb-4 sticky-top d-flex justify-content-between align-items-center">
        <div class="d-flex flex-column">
            <h1 class="logo-title m-0">HELMCRAFT</h1>
            <small class="fw-bold" style="letter-spacing: 2px;">ORDER MANAGEMENT</small>
        </div>
        <div class="d-flex align-items-center gap-4">
            <div class="text-end d-none d-sm-block">
                <small class="fw-bold text-dark d-block" style="font-size: 10px; letter-spacing: 1px;">TOTAL PENDAPATAN</small>
                <span class="badge bg-dark rounded-pill fs-6 px-3 py-2 shadow-sm">
                    Rp {{ number_format($pendapatan, 0, ',', '.') }}
                </span>
            </div>
            <a href="/helmcraft" class="btn btn-outline-dark rounded-pill px-4">Kembali</a>
        </div>
    </nav>

    <div class="container mt-5" style="max-width: 700px;">
        <div class="card card-custom p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h3 class="fw-bold m-0">Tambah Order</h3>
            </div>
            
            <!-- Tambahan Action dan CSRF -->
            <form action="/helmcraft" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold small text-uppercase">Nama Pelanggan</label>
                        <input type="text" class="form-control" name="nama_pelanggan" maxlength="100" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold small text-uppercase">Nomor HP</label>
                        <input type="number" class="form-control" name="no_hp" required>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold small text-uppercase">Merk Helm</label>
                    <input type="text" class="form-control" name="merk_helm" required>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold small text-uppercase">Layanan / Request</label>
                    <textarea class="form-control" name="request_warna" rows="3" required></textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold small text-uppercase">Foto Kondisi Helm (Opsional)</label>
                    <input type="file" class="form-control" name="foto_helm" accept=".jpg,.jpeg,.png">
                    <small class="text-muted">Format: JPG/PNG, Maks: 2MB.</small>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-4">
                        <label class="form-label fw-bold small text-uppercase">Biaya (Rp)</label>
                        <input type="number" class="form-control" name="biaya" required>
                    </div>
                    <div class="col-md-6 mb-4">
                        <label class="form-label fw-bold small text-uppercase">Tanggal Masuk</label>
                        <input type="date" class="form-control" name="tanggal_masuk" value="{{ date('Y-m-d') }}" required>
                    </div>
                </div>
                <button type="submit" class="btn btn-pink w-100 rounded-pill py-2">Simpan Order</button>
            </form>
        </div>
    </div>
</body>
</html>
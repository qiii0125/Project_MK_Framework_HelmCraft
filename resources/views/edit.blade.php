<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>HelmCraft - Edit Order</title>
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

    <div class="container mt-5" style="max-width: 600px;">
        <div class="card card-custom p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h3 class="fw-bold m-0">Edit Order</h3>
            </div>
            
            <form action="/helmcraft/{{ $d->id_pesanan }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="mb-3">
                    <label class="form-label fw-bold small text-uppercase">Pelanggan</label>
                    <input type="text" class="form-control" value="{{ $d->nama_pelanggan }}" disabled>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold small text-uppercase">Layanan / Request</label>
                    <textarea class="form-control" name="request" rows="3" required>{{ $d->request_warna }}</textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold small text-uppercase">Update Foto (Kosongkan jika tidak diganti)</label>
                    @if($d->foto_helm != "")
                        <div class="mb-2"><img src="{{ asset('uploads/'.$d->foto_helm) }}" width="100" class="rounded"></div>
                    @endif
                    <input type="file" class="form-control" name="foto_helm" accept=".jpg,.jpeg,.png">
                </div>
                <div class="row">
                    <div class="col-md-6 mb-4">
                        <label class="form-label fw-bold small text-uppercase">Biaya (Rp)</label>
                        <input type="number" class="form-control" name="biaya" value="{{ $d->biaya }}" required>
                    </div>
                    <div class="col-md-6 mb-4">
                        <label class="form-label fw-bold small text-uppercase">Status</label>
                        <select class="form-select" name="status">
                            <option value="Antri" {{ $d->status_pengerjaan == 'Antri' ? 'selected' : '' }}>Antri</option>
                            <option value="Prepping" {{ $d->status_pengerjaan == 'Prepping' ? 'selected' : '' }}>Prepping</option>
                            <option value="Pengecatan" {{ $d->status_pengerjaan == 'Pengecatan' ? 'selected' : '' }}>Pengecatan</option>
                            <option value="Clear Coat" {{ $d->status_pengerjaan == 'Clear Coat' ? 'selected' : '' }}>Clear Coat</option>
                            <option value="Selesai" {{ $d->status_pengerjaan == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                        </select>
                    </div>
                </div>
                <button type="submit" class="btn btn-light w-100 rounded-pill py-2">Update Data</button>
            </form>
        </div>
    </div>
</body>
</html>
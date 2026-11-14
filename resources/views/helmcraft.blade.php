<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>HelmCraft - Dashboard UAS</title>
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
            <!-- Link diubah mengarah ke URL route -->
            <a href="/helmcraft/create" class="btn btn-pink rounded-pill px-4">+ Tambah Order</a>
        </div>
    </nav>

    <div class="container">
        <div class="card card-custom p-4 mb-4">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h3 class="m-0 fw-bold">Order Terbaru</h3>
                
                <!-- Form action diubah mengarah ke root /helmcraft -->
                <form method="GET" action="/helmcraft" class="d-flex w-50">
                    <input type="text" name="cari" class="form-control rounded-pill me-2" placeholder="Cari nama, merk, atau layanan..." value="{{ request('cari') }}">
                    <button class="btn btn-light rounded-pill px-4" type="submit">Cari</button>
                    @if(request('cari'))
                        <a href="/helmcraft" class="btn btn-outline-danger rounded-pill ms-2">Reset</a>
                    @endif
                </form>
            </div>

            <div class="table-responsive">
                <table class="table table-custom align-middle">
                    <thead>
                        <tr>
                            <th>No. Order</th>
                            <th>Foto</th>
                            <th>Pelanggan</th>
                            <th>Layanan</th>
                            <th>Tgl Masuk</th>
                            <th>Biaya</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Looping data pakai foreach bawaan Blade -->
                        @foreach($pesanan as $row)
                        @php $kode = "HC-" . str_pad($row->id_pesanan, 4, "0", STR_PAD_LEFT); @endphp
                        <tr>
                            <td class="fw-bold text-danger">{{ $kode }}</td>
                            <td>
                                @if($row->foto_helm != "")
                                    <img src="{{ asset('uploads/'.$row->foto_helm) }}" width="60" class="rounded shadow-sm">
                                @else
                                    <span class="text-muted small">Tanpa Foto</span>
                                @endif
                            </td>
                            <td><strong>{{ $row->nama_pelanggan }}</strong><br><small>{{ $row->no_hp }} | {{ $row->merk_helm }}</small></td>
                            <td>{{ $row->request_warna }}</td>
                            <td>{{ $row->tanggal_masuk }}</td>
                            <td class="fw-bold">Rp {{ number_format($row->biaya, 0, ',', '.') }}</td>
                            <td><span class="badge badge-custom rounded-pill px-3 py-2">{{ $row->status_pengerjaan }}</span></td>
                            <td>
                                <!-- Tombol Aksi Dirombak Total -->
                                <a href="/helmcraft/{{ $row->id_pesanan }}/edit" class="btn btn-sm btn-dark rounded-pill px-3">Edit</a>
                                
                                <form action="/helmcraft/{{ $row->id_pesanan }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill px-3" onclick="return confirm('Yakin hapus data ini?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination Laravel Jauh Lebih Simpel -->
            <nav class="mt-3 d-flex justify-content-center">
                {{ $pesanan->links() }} 
            </nav>
        </div>
    </div>
</body>
</html>
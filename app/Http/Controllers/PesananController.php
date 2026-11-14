<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;   
use Illuminate\Support\Facades\File; 

class PesananController extends Controller
{

    private function getPendapatan() {
        return DB::table('pesanan_helm')
                 ->where('status_pengerjaan', 'Selesai')
                 ->sum('biaya'); 
    }

    // 1. PENGGANTI INDEX.PHP (Nampilin Data, Search, & Pagination)
    public function index(Request $request)
    {
        $cari = $request->input('cari');
        $pendapatan = $this->getPendapatan();

        // Tarik data tabel (Pengganti SELECT * FROM)
        $query = DB::table('pesanan_helm')->orderBy('id_pesanan', 'desc');

        // Logika Pencarian
        if ($cari) {
            $query->where('nama_pelanggan', 'LIKE', "%{$cari}%")
                  ->orWhere('merk_helm', 'LIKE', "%{$cari}%")
                  ->orWhere('request_warna', 'LIKE', "%{$cari}%");
        }

        // Pagination otomatis (pengganti kodingan hitung total halaman yang panjang)
        $pesanan = $query->paginate(5);

        return view('helmcraft', compact('pesanan', 'pendapatan', 'cari'));
    }

    // 2. Nampilin Halaman Tambah (create.blade.php)
    public function create()
    {
        $pendapatan = $this->getPendapatan();
        return view('create', compact('pendapatan'));
    }

    // 3. PENGGANTI TAMBAH.PHP (Proses Simpan Data & Upload)
    public function store(Request $request)
    {
        $data = [
            'nama_pelanggan' => $request->nama_pelanggan,
            'no_hp' => $request->no_hp,
            'merk_helm' => $request->merk_helm,
            'request_warna' => $request->request_warna,
            'biaya' => $request->biaya,
            'tanggal_masuk' => $request->tanggal_masuk,
            'status_pengerjaan' => 'Antri'
        ];

        // Script Upload File versi Laravel (Jauh lebih gampang!)
        if ($request->hasFile('foto_helm')) {
            $file = $request->file('foto_helm');
            $nama_file = time() . "-" . $file->getClientOriginalName();
            
            // Pindahin ke folder public/uploads
            $file->move(public_path('uploads'), $nama_file);
            $data['foto_helm'] = $nama_file;
        }

        // Insert ke database
        DB::table('pesanan_helm')->insert($data);

        return redirect('/helmcraft');
    }

    // 4. Nampilin Halaman Edit (edit.blade.php)
    public function edit($id)
    {
        $pendapatan = $this->getPendapatan();
        
        // Tarik 1 baris data (Pengganti mysqli_fetch_assoc)
        $d = DB::table('pesanan_helm')->where('id_pesanan', $id)->first();
        
        return view('edit', compact('d', 'pendapatan'));
    }

    // 5. PENGGANTI EDIT.PHP (Proses Update & Ganti Foto)
    public function update(Request $request, $id)
    {
        $data = [
            'request_warna' => $request->input('request'), // name di form lu "request"
            'biaya' => $request->biaya,
            'status_pengerjaan' => $request->status
        ];
        

        if ($request->hasFile('foto_helm')) {
            // Cari data lama buat hapus foto fisiknya
            $lama = DB::table('pesanan_helm')->where('id_pesanan', $id)->first();
            
            if ($lama->foto_helm && File::exists(public_path('uploads/'.$lama->foto_helm))) {
                File::delete(public_path('uploads/'.$lama->foto_helm));
            }

            // Upload foto baru
            $file = $request->file('foto_helm');
            $nama_file = time() . "-" . $file->getClientOriginalName();
            $file->move(public_path('uploads'), $nama_file);
            $data['foto_helm'] = $nama_file;
        }

        // Update database
        DB::table('pesanan_helm')->where('id_pesanan', $id)->update($data);

        return redirect('/helmcraft');
    }

    // 6. PENGGANTI HAPUS.PHP
    public function destroy($id)
    {
        $lama = DB::table('pesanan_helm')->where('id_pesanan', $id)->first();
        
        // Hapus file fisik fotonya dulu dari folder uploads
        if ($lama->foto_helm && File::exists(public_path('uploads/'.$lama->foto_helm))) {
            File::delete(public_path('uploads/'.$lama->foto_helm));
        }

        // Hapus dari database
        DB::table('pesanan_helm')->where('id_pesanan', $id)->delete();

        return redirect('/helmcraft');
    }
}
<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    use HasFactory;
    protected $table = 'pesanan_helm';
    protected $primaryKey = 'id_pesanan';
    protected $fillable = [
        'nama_pelanggan',
        'no_hp',
        'merk_helm',
        'request_warna',
        'biaya',
        'tanggal_masuk',
        'status_pengerjaan',
        'foto_helm'
    ];
}
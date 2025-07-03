<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $table = 'transaksi';

    protected $fillable = [
        'id',
        'user_id', 
        'sampah_id',
        'berat',
        'total_harga',
        'jenis_transaksi',
        'jumlah_tarik',
        'tanggal_transaksi'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function sampah() {
        return $this->belongsTo(Sampah::class);
    }
}

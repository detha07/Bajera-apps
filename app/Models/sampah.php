<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sampah extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_sampah', 'jenis_sampah', 'harga_sampah', 'keterangan','foto_sampah' 
    ];
    protected $table = 'sampah';
}

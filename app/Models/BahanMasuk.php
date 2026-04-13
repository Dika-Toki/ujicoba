<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BahanMasuk extends Model
{
    protected $table = 'bahan_masuks';
    protected $fillable = [
        'kode_bahan',
        'nama_bahan',
        'jumlah',
        'tanggal_masuk',
        'metode_pembayaran',
        'jatuh_tempo',
    ];
    public function bahan()
    {
        return $this->belongsTo(Bahan::class, 'kode_bahan', 'kode_bahan');
    }
    //
}

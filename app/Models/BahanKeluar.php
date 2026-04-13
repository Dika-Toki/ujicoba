<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BahanKeluar extends Model
{
    //
    protected $table = 'bahan_keluars';
    protected $fillable = [
        'kode_bahan',
        'nama_bahan',
        'jumlah_keluar',
        'tanggal_keluar',
    ];
    public function bahan()
    {
        return $this->belongsTo(Bahan::class, 'kode_bahan', 'kode_bahan');
    }  
}

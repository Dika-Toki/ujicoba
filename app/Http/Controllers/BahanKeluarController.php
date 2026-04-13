<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bahan; // Import model Bahan
use App\Models\BahanKeluar; // Import model BahanKeluar
use Illuminate\Support\Facades\DB; // Import DB facade untuk transaksi database

class BahanKeluarController extends Controller
{
    //
    public function index()
    {
        $semua_bahan_keluar = BahanKeluar::with('bahan')
                                        ->orderBy('tanggal_keluar', 'desc')
                                        ->get();

        return view('bahan_keluar.index', compact('semua_bahan_keluar'));
    }

    public function store(Request $request)
    {
        // 1. Ambil data bahan untuk cek stok
        $bahan = Bahan::Where('kode_bahan', $request->kode_bahan)->firstOrFail();

        // 2. Validasi: Apakah jumlah keluar melebihi stok yang ada?
        if ($request->jumlah_keluar > $bahan->stok) {
            // Kembali ke halaman sebelumnya dengan pesan error (Pengganti alert JS)
            return back()->with('error', "GAGAL! Stok {$bahan->nama_bahan} tidak mencukupi. Sisa stok: {$bahan->stok}");
        }

        // 3. Eksekusi Transaksi
        DB::transaction(function () use ($request, $bahan) {
            
            // A. Catat Riwayat ke tabel bahan_keluar
            BahanKeluar::create([
                'kode_bahan' => $bahan->kode_bahan,
                'nama_bahan' => $bahan->nama_bahan,
                'jumlah_keluar' => $request->jumlah_keluar,
                'tanggal_keluar' => now(),
            ]);

            // B. Kurangi stok di tabel bahan (Logika: stok - jumlah_keluar)
            $bahan->decrement('stok', $request->jumlah_keluar);
        });

        // 4. Redirect Sukses
        return redirect()->route('bahan_keluar.index')->with('success', 'Data bahan keluar berhasil dicatat!');
    }
}

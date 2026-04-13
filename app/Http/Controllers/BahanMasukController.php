<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bahan; // Import model Bahan
use App\Models\BahanMasuk; // Import model BahanMasuk

class BahanMasukController extends Controller
{
    public function index()
    {
        $semua_bahan_masuk = BahanMasuk::with('bahan')
                                        ->orderBy('tanggal_masuk', 'desc')
                                        ->get();

        return view('bahan_masuk.index', compact('semua_bahan_masuk'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'kode_bahan' => 'required' . '|exists:bahans,kode_bahan',
            'nama_bahan' => 'required',
            'jumlah' => 'required|numeric|min:1',
            'tanggal_masuk' => 'required|date',
            'metode_pembayaran' => 'required',
            'jatuh_tempo' => 'nullable|date',
        ]);
        \App\Models\BahanMasuk::create([
            'kode_bahan' => $request->kode_bahan,
            'nama_bahan' => $request->nama_bahan,
            'jumlah' => $request->jumlah,
            'tanggal_masuk' => $request->tanggal_masuk,
            'metode_pembayaran' => $request->metode_pembayaran,
            'jatuh_tempo' => $request->jatuh_tempo,
        ]);
        $bahan = Bahan::where('kode_bahan', $request->kode_bahan)->first();
        if ($bahan) {
            // Jika bahan ditemukan, baru update stoknya
            $bahan->stok = $bahan->stok + $request->jumlah;
            $bahan->save();
        } else {
            // Jika tidak ditemukan, kembalikan dengan pesan error
            return redirect()->back()->with('error', 'Kode Bahan tidak terdaftar di sistem!');
        }
        $bahan->save();

        return redirect()->route('bahan_masuk.index')->with('success', 'Bahan masuk berhasil ditambahkan.');

        BahanMasuk::create($request->all());

        return redirect()->route('bahan_masuk.index')->with('success', 'Bahan masuk berhasil ditambahkan.');
    }
    //
}

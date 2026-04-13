<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bahan; // Import model Bahan


class BahanController extends Controller
{
    public function index()
    {
        $semua_bahan =Bahan::all();

        return view('bahan.index', compact('semua_bahan'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'kode_bahan' => 'required|unique:bahans',
            'nama_bahan' => 'required',
            'stok' => 'required|integer',
            'satuan' => 'required',
        ]);

        Bahan::create($request->all());

        return redirect()->route('bahan.index')->with('success', 'Bahan berhasil ditambahkan.');
    }
    //
}

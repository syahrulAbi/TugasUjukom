<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\barang;
use App\Models\Category;

class barangController extends Controller
{
    //
    public function index()
    {
        $barang = barang::all();
        $categories = Category::all();
        return view('data_barang', compact('barang','categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kategori_barang' => 'required|max:255',
            'nama_barang' => 'required|string|max:255',
            'stok' => 'required|string|max:255',
            'harga' => 'required|max:255',
        ]);

        barang::create([
            'kategori_barang' => $request->kategori_barang,
            'nama_barang' => $request->nama_barang,
            'stok' => $request->stok,
            'harga' => $request->harga,
        ]);

        return redirect()->route('barang.index')->with('success', 'berhasil.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'kategori_barang' => 'required|max:255' . $id,
            'nama_barang' => 'required|string|max:255'. $id,
            'stok' => 'required|string|max:255'. $id,
            'harga' => 'required|max:255'. $id,
        ]);

        $barang = barang::find($id);
        $barang->kategori_barang = $request->kategori_barang;
        $barang->nama_barang = $request->nama_barang;
        $barang->stok = $request->stok;
        $barang->harga = $request->harga;
        $barang->save();

        return redirect()->route('barang.index')->with('success', 'berhasil.');
    }

    public function destroy($id)
    {
        $barang = barang::find($id);
        $barang->delete();

        return redirect()->route('barang.index')->with('success', 'berhasil.');
    }
}

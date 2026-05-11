<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Kategori;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    // 📌 Dashboard / list barang + search + filter
    public function index(Request $request)
    {
        $query = Barang::with('kategori');

        // 🔍 search nama barang
        if ($request->search) {
            $query->where('nama_barang', 'like', '%' . $request->search . '%');
        }

        // 🧩 filter kategori
        if ($request->kategori_id === 'null') {
            $query->whereNull('kategori_id'); // 🔥 tidak berkategori
        } elseif ($request->kategori_id) {
            $query->where('kategori_id', $request->kategori_id);
        }

        $barang = $query->latest()->paginate(5)->withQueryString();
        $kategori = Kategori::all();

        $tidakBerkategori = Barang::whereNull('kategori_id')->exists();

        // 📊 card
        $stokMenipis = Barang::stokMenipis()->count();

        $stokHabis = Barang::where('stok', 0)->count();

        return view('barang.index', compact(
            'barang',
            'kategori',
            'tidakBerkategori',
            'stokMenipis',
            'stokHabis'
        ));
    }

    // 📌 Form tambah
    public function create()
    {
        $kategori = Kategori::all();
        return view('barang.create', compact('kategori'));
    }

    // 📌 Simpan data
    public function store(Request $request)
    {
        if ($request->harga_jual) {
            $request->merge([
                'harga_jual' => str_replace('.', '', $request->harga_jual)
            ]);
        }

        if ($request->harga_beli) {
            $request->merge([
                'harga_beli' => str_replace('.', '', $request->harga_beli)
            ]);
        }

        $request->validate(
            [
                'nama_barang' => 'required',
                'kategori_id' => 'required',
                'stok' => 'required|integer|min:0',
                'satuan' => 'required',

                'harga_jual' => 'nullable|numeric',
                'stok_minimum' => 'nullable|integer|min:0',
                'harga_beli' => 'nullable|numeric',
                'berat_atau_ukuran' => 'nullable|string|max:100',
                'lokasi_simpan' => 'nullable|string|max:100',
                'deskripsi' => 'nullable|string',
                'foto' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048'
            ],
            [
                'nama_barang.required' => 'Nama barang wajib diisi!',
                'kategori_id.required' => 'Kategori wajib dipilih!',
                'stok.required' => 'Stok wajib diisi!',
                'stok.min' => 'Stok tidak boleh kurang dari 0!',
                'satuan.required' => 'Satuan wajib diisi!',
                'stok_minimum.min' => 'Stok Minimum tidak boleh kurang dari 0!',
                'foto.image' => 'File harus berupa gambar!',
                'foto.mimes' => 'Format harus JPG, JPEG, PNG, atau WEBP!',
                'foto.max' => 'Ukuran maksimal 2MB!',
            ]
        );

        $data = $request->all();

        // 📸 upload foto
        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('barang', 'public');
        }

        Barang::create($data);

        return redirect()->route('dashboard')
            ->with('success', 'Barang berhasil ditambahkan');
    }

    // 📌 Detail barang
    public function show($id)
    {
        $barang = Barang::with('kategori')->findOrFail($id);
        return view('barang.show', compact('barang'));
    }

    // 📌 Form edit
    public function edit($id)
    {
        $barang = Barang::findOrFail($id);
        $kategori = Kategori::all();

        return view('barang.edit', compact('barang', 'kategori'));
    }

    // 📌 Update
    public function update(Request $request, $id)
    {
        if ($request->harga_jual) {
            $request->merge([
                'harga_jual' => str_replace('.', '', $request->harga_jual)
            ]);
        }

        if ($request->harga_beli) {
            $request->merge([
                'harga_beli' => str_replace('.', '', $request->harga_beli)
            ]);
        }

        $request->validate(
            [
                'nama_barang' => 'required',
                'kategori_id' => 'required',
                'stok' => 'required|integer|min:0',
                'satuan' => 'required',

                'harga_jual' => 'nullable|numeric',
                'stok_minimum' => 'nullable|integer|min:0',
                'harga_beli' => 'nullable|numeric',
                'berat_atau_ukuran' => 'nullable|string|max:100',
                'lokasi_simpan' => 'nullable|string|max:100',
                'deskripsi' => 'nullable|string',
                'foto' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048'
            ],
            [
                'nama_barang.required' => 'Nama barang wajib diisi!',
                'kategori_id.required' => 'Kategori wajib dipilih!',
                'stok.required' => 'Stok wajib diisi!',
                'stok.min' => 'Stok tidak boleh kurang dari 0!',
                'satuan.required' => 'Satuan wajib diisi!',
                'stok_minimum.min' => 'Stok Minimum tidak boleh kurang dari 0!',
                'foto.image' => 'File harus berupa gambar!',
                'foto.mimes' => 'Format harus JPG, JPEG, PNG, atau WEBP!',
                'foto.max' => 'Ukuran maksimal 2MB!',
            ]
        );

        $barang = Barang::findOrFail($id);
        $data = $request->all();

        // 📸 upload foto baru
        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('barang', 'public');
        }

        $barang->update($data);

        return redirect()->route('dashboard')
            ->with('success', 'Barang berhasil diupdate');
    }

    // 📌 Hapus
    public function destroy($id)
    {
        $barang = Barang::findOrFail($id);
        $barang->delete();

        return redirect()->route('dashboard')
            ->with('success', 'Barang berhasil dihapus');
    }
}

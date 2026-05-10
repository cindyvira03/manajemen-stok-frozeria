@extends('layouts.app')

@section('title', 'Tambah Barang')

@push('styles')
<style>

.preview-wrapper {
    display: none;
    align-items: center;
    gap: 10px;
    margin-top: 10px;
    background: #f8fafc;
    padding: 8px;
    border-radius: 10px;
}
</style>
@endpush

@section('content')

<div class="page-top">
    <div class="page-title">
        <h1>Tambah Barang</h1>
        <p>Tambahkan data barang baru ke sistem</p>
    </div>

    <x-button type="kembali" :href="route('dashboard')">
        ← Kembali
    </x-button>
</div>

@if ($errors->any())
    <x-alert type="error">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </x-alert>
@endif

<form action="{{ route('barang.store') }}" method="POST" enctype="multipart/form-data">
@csrf

<div class="form-grid">

    <!-- FOTO -->
    <div class="card">
        <h3>Foto Barang</h3>

        <label class="upload-box">
            <input type="file" name="foto" id="fotoInput">

            <div id="uploadContent">
                <i class="bi bi-image"></i>
                <p>Klik atau drag foto ke sini</p>
                <span>JPG, JPEG, PNG, WEBP (Max 2MB)</span>
            </div>

            <!-- PREVIEW KECIL -->
            <div id="previewWrapper" class="preview-wrapper">
                <img id="previewImage">
                <div class="preview-info">
                    <span id="fileName"></span>
                    <span class="success-text">✔ Berhasil diupload</span>
                </div>
            </div>

            <!-- ERROR -->
            <p id="uploadError" class="error-text"></p>
        </label>
    </div>

    <!-- INFORMASI UTAMA -->
    <div class="card">
        <h3>Informasi Utama</h3>

        <div class="grid-2">
            <div class="form-group">
                <label>Nama Barang <span class="required">*</span></label>
                <input type="text" name="nama_barang" placeholder="Contoh: Nugget Ayam" value="{{ old('nama_barang') }}" required>
            </div>

            <div class="form-group">
                <label>Kategori <span class="required">*</span></label>
                <select name="kategori_id" required>
                    <option value="">Pilih kategori</option>
                   @foreach($kategori as $k)
                        <option 
                            value="{{ $k->id }}"
                            {{ old('kategori_id') == $k->id ? 'selected' : '' }}
                        >
                            {{ $k->nama_kategori }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Stok <span class="required">*</span></label>
                <input type="number" min="0" name="stok" placeholder="0" value="{{ old('stok') }}" required>
            </div>

            <div class="form-group">
                <label>Satuan <span class="required">*</span></label>
                <input type="text" name="satuan" placeholder="Contoh: pcs / box / pack dll.." value="{{ old('satuan') }}" required>
            </div>
        </div>
    </div>

    <!-- DETAIL -->
    <div class="card">
        <h3>Detail Tambahan</h3>

        <!-- BARIS 1 (2 KOLOM) -->
        <div class="grid-2">
            <div class="form-group">
                <label>Harga Jual</label>
                <div class="input-group">
                    <span class="input-group-text">Rp</span>
                    <input 
                        type="text" 
                        class="form-control" 
                        name="harga_jual" 
                        id="hargaJual"
                        placeholder="0"
                        value="{{ old('harga_jual') }}"
                    >
                </div>
            </div>

            <div class="form-group">
                <label>Harga Beli</label>
                <div class="input-group">
                    <span class="input-group-text">Rp</span>
                    <input 
                        type="text" 
                        class="form-control" 
                        name="harga_beli" 
                        id="hargaBeli"
                        placeholder="0"
                        value="{{ old('harga_beli') }}"
                    >
                </div>
            </div>
        </div>

        <!-- BARIS 2 (3 KOLOM) -->
        <div class="grid-3" style="margin-top:14px;">
            <div class="form-group">
                <label>Stok Minimum</label>
                <input type="number"  min="0" name="stok_minimum" placeholder="0" value="{{ old('stok_minimum') }}">
            </div>

            <div class="form-group">
                <label>Berat / Ukuran</label>
                <input type="text" name="berat_atau_ukuran" placeholder="Contoh: gram / liter dll.." value="{{ old('berat_atau_ukuran') }}">
            </div>

            <div class="form-group">
                <label>Lokasi Simpan</label>
                <input type="text" name="lokasi_simpan" placeholder="Contoh: Rak / Freezer dll.." value="{{ old('lokasi_simpan') }}">
            </div>
        </div>
    </div>

    <!-- DESKRIPSI -->
    <div class="card">
        <h3>Deskripsi</h3>
        <textarea name="deskripsi" rows="4" placeholder="Tambahkan deskripsi barang (opsional)" value="{{ old('deskripsi') }}"></textarea>
    </div>

</div>

<!-- ACTION -->
<div class="form-action">
    <x-button type="batal" :href="route('dashboard')">
        Batal
    </x-button>
    <x-button type="submit" submit>
        Simpan Barang
    </x-button>
</div>

</form>

@endsection

@push('scripts')
<script>
document.getElementById('fotoInput').addEventListener('change', function(e) {

    const file = e.target.files[0];

    const preview = document.getElementById('previewImage');
    const wrapper = document.getElementById('previewWrapper');
    const content = document.getElementById('uploadContent');
    const errorText = document.getElementById('uploadError');
    const fileName = document.getElementById('fileName');

    // ❗ kalau user batal pilih file → JANGAN APA-APA
    if (!file) return;

    // reset hanya kalau ada file baru
    errorText.textContent = '';

    // 🔥 VALIDASI
    const allowedTypes = ['image/jpg', 'image/jpeg', 'image/png', 'image/webp'];
    const maxSize = 2 * 1024 * 1024;

    if (!allowedTypes.includes(file.type)) {
        errorText.textContent = 'Format harus JPG, PNG, atau WEBP!';
        return;
    }

    if (file.size > maxSize) {
        errorText.textContent = 'Ukuran maksimal 2MB!';
        return;
    }

    // ✅ PREVIEW
    const reader = new FileReader();

    reader.onload = function(e) {
        preview.src = e.target.result;
        fileName.textContent = file.name;

        wrapper.style.display = 'flex';
        content.style.display = 'none';
    }

    reader.readAsDataURL(file);
});
</script>
@endpush
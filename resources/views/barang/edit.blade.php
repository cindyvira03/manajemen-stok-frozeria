@extends('layouts.app')

@section('title', 'Edit Barang')

@push('styles')
<style>
/* wrapper utama */
.preview-wrapper {
    display: flex;
    align-items: center;
    justify-content: space-between; /* 🔥 dorong kanan */
    gap: 10px;
    margin-top: 10px;
    background: #f8fafc;
    padding: 10px;
    border-radius: 10px;
}

/* kiri (gambar + teks) */
.preview-left {
    display: flex;
    align-items: center;
    gap: 10px;
}

/* kanan (action buttons) */
.preview-actions {
    display: flex;
    gap: 6px;
}

/* tombol hapus */
.btn-remove {
    background: #fee2e2;
    color: #ef4444;
    border: none;
    padding: 6px 12px;
    border-radius: 8px;
    font-size: 12px;
    cursor: pointer;
    transition: 0.2s;
}

.btn-remove:hover {
    background: #ef4444;
    color: #fff;
}
</style>
@endpush

@section('content')

<div class="page-top">
    <div class="page-title">
        <h1>Edit Barang</h1>
        <p>Perbarui data barang</p>
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

<form action="{{ route('barang.update', $barang->id) }}" method="POST" enctype="multipart/form-data">
@csrf
@method('PUT')

<div class="form-grid">

    <!-- FOTO -->
    <div class="card">
        <h3>Foto Barang</h3>

        <label class="upload-box">
            <input type="file" name="foto" id="fotoInput">

            <div id="uploadContent" style="{{ $barang->foto ? 'display:none;' : '' }}">
                <i class="bi bi-image"></i>
                <p>Klik atau ganti foto</p>
                <span>JPG, JPEG, PNG, WEBP (Max 2MB)</span>
            </div>

            <!-- PREVIEW -->
            <div id="previewWrapper" class="preview-wrapper"
                style="{{ $barang->foto ? 'display:flex;' : 'display:none;' }}">

                <!-- KIRI -->
                <div class="preview-left">
                    <img id="previewImage"
                        src="{{ $barang->foto ? asset('storage/'.$barang->foto) : '' }}">

                    <div class="preview-info">
                        <span id="fileName">
                            {{ $barang->foto ? 'Foto saat ini' : '' }}
                        </span>
                        <span id="statusText" class="success-text">✔ Tersimpan</span>
                    </div>
                </div>

                <!-- KANAN -->
                <div class="preview-actions">
                    {{-- <button type="button" class="btn-ganti" onclick="triggerUpload()">
                        Ganti
                    </button> --}}

                    <button type="button" class="btn-remove" onclick="removeImage()">
                        Hapus
                    </button>
                </div>

            </div>

            <p id="uploadError" class="error-text"></p>
        </label>
    </div>

    <!-- INFORMASI -->
    <div class="card">
        <h3>Informasi Utama</h3>

        <div class="grid-2">
            <div class="form-group">
                <label>Nama Barang <span class="required">*</span></label>
                <input type="text" name="nama_barang"
                    value="{{ old('nama_barang', $barang->nama_barang) }}">
            </div>

            <div class="form-group">
                <label>Kategori <span class="required">*</span></label>
                <select name="kategori_id">
                    @foreach($kategori as $k)
                        <option value="{{ $k->id }}"
                            {{ $barang->kategori_id == $k->id ? 'selected' : '' }}>
                            {{ $k->nama_kategori }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Stok <span class="required">*</span></label>
                <input type="number" min="0"  name="stok"
                    value="{{ old('stok', $barang->stok) }}">
            </div>

            <div class="form-group">
                <label>Satuan <span class="required">*</span></label>
                <input type="text" name="satuan"
                    value="{{ old('satuan', $barang->satuan) }}">
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
                        value="{{ old('harga_jual', number_format($barang->harga_jual, 0, ',', '.')) }}"
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
                        value="{{ old('harga_beli', number_format($barang->harga_beli, 0, ',', '.')) }}"
                    >
                </div>
            </div>
        </div>

        <!-- BARIS 2 (3 KOLOM) -->
        <div class="grid-3" style="margin-top:14px;">
            <div class="form-group">
                <label>Stok Minimum</label>
                <input type="number"  min="0" name="stok_minimum"  value="{{ old('satuan', $barang->stok_minimum) }}">
            </div>

            <div class="form-group">
                <label>Berat / Ukuran</label>
                <input type="text" name="berat_atau_ukuran"  value="{{ old('satuan', $barang->berat_atau_ukuran) }}">
            </div>

            <div class="form-group">
                <label>Lokasi Simpan</label>
                <input type="text" name="lokasi_simpan"  value="{{ old('satuan', $barang->lokasi_simpan) }}">
            </div>
        </div>
    </div>

    <!-- DESKRIPSI -->
    <div class="card">
        <h3>Deskripsi</h3>
        <textarea name="deskripsi">{{ old('deskripsi', $barang->deskripsi) }}</textarea>
    </div>

</div>

<div class="form-action">
    <x-button type="batal" :href="route('dashboard')">
        Batal
    </x-button>
    <x-button type="submit" submit>
        Update Barang
    </x-button>
</div>

</form>

@endsection

@push('scripts')
<script>
const input = document.getElementById('fotoInput');

input.addEventListener('change', function(e) {
    const file = e.target.files[0];

    const preview = document.getElementById('previewImage');
    const wrapper = document.getElementById('previewWrapper');
    const content = document.getElementById('uploadContent');
    const fileName = document.getElementById('fileName');
    const statusText = document.getElementById('statusText'); // 🔥 tambahan

    if (!file) return;

    const reader = new FileReader();

    reader.onload = function(e) {
        preview.src = e.target.result;
        fileName.textContent = file.name;

        // 🔥 UBAH STATUS JADI BELUM DISIMPAN
        if (statusText) {
            statusText.textContent = '⚠ Perubahan belum disimpan';
            statusText.classList.remove('success-text');
            statusText.style.color = '#f59e0b';
        }

        wrapper.style.display = 'flex';
        content.style.display = 'none';
    }

    reader.readAsDataURL(file);
});

// ❌ hapus preview
function removeImage() {
    document.getElementById('previewWrapper').style.display = 'none';
    document.getElementById('uploadContent').style.display = 'block';
    document.getElementById('fotoInput').value = '';

    const statusText = document.getElementById('statusText');

    // 🔥 reset status
    if (statusText) {
        statusText.textContent = '';
    }
}

function triggerUpload() {
    document.getElementById('fotoInput').click();
}
</script>
@endpush
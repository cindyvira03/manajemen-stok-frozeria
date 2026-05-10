@extends('layouts.app')

@section('title', 'Bantuan')

@push('styles')
<style>
    .help-container {
    display: grid;
    gap: 16px;
}

/* CARD */
.help-card {
    background: var(--card-bg);
    border: 1px solid var(--border);
    border-radius: 16px;
    padding: 18px;
    box-shadow: var(--shadow-sm);
}

.help-card:hover {
    transform: translateY(-2px);
    box-shadow: var(--shadow-md);
}

.help-card h3 {
    font-size: 15px;
    margin-bottom: 12px;
    display: flex;
    align-items: center;
    gap: 8px;
}

/* STEP LIST */
.step-list {
    list-style: none;
    padding: 0;
    margin: 0;
}

.step-list li {
    position: relative;
    padding-left: 28px;
    margin-bottom: 10px;
    font-size: 13.5px;
}

/* nomor bulat */
.step-list li::before {
    content: counter(step);
    counter-increment: step;
    position: absolute;
    left: 0;
    top: 0;
    width: 20px;
    height: 20px;
    background: var(--primary);
    color: white;
    border-radius: 6px;
    font-size: 11px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.step-list {
    counter-reset: step;
}

/* NOTE */
.help-note {
    background: var(--primary-light);
    color: var(--primary-dark);
    padding: 12px 14px;
    border-radius: 10px;
    font-size: 13px;
    display: flex;
    align-items: center;
    gap: 8px;
}

/* PROFILE */
.help-profile {
    background: #fff;
    border: 1px dashed var(--border);
    border-radius: 14px;
    padding: 16px;
}

.help-profile h3 {
    margin-bottom: 10px;
    font-size: 15px;
}

.help-profile p {
    margin: 4px 0;
    font-size: 13px;
}
</style>
@endpush

@section('content')

<div class="page-top">
    <div>
        <h1>Bantuan</h1>
        <p>Panduan penggunaan sistem Frozeria Stok</p>
    </div>
</div>

<div class="help-container">

    <!-- CARD 1 -->
    <div class="help-card">
        <h3><i class="bi bi-box-seam"></i> Cara menambah barang baru</h3>

        <ul class="step-list">
            <li>Buka halaman <b>Dashboard</b>, klik tombol <b>+ Tambah Barang</b> di kanan atas.</li>
            <li>Unggah foto barang (opsional), lalu isi formulir: nama, kategori, satuan, jumlah stok, harga, dan lainnya.</li>
            <li>Klik <b>Simpan Barang</b>. Barang akan muncul di daftar dashboard.</li>
        </ul>
    </div>

    <!-- CARD 2 -->
    <div class="help-card">
        <h3><i class="bi bi-arrow-repeat"></i> Cara update stok barang masuk</h3>

        <ul class="step-list">
            <li>Temukan barang di dashboard menggunakan kolom pencarian atau filter kategori.</li>
            <li>Klik tombol <b>Edit</b> pada baris barang tersebut.</li>
            <li>Ubah nilai <b>Jumlah stok</b> sesuai kondisi saat ini, lalu klik <b>Simpan Barang</b>.</li>
        </ul>
    </div>

    <!-- CARD 3 -->
    <div class="help-card">
        <h3><i class="bi bi-tags"></i> Cara mengelola kategori</h3>

        <ul class="step-list">
            <li>Buka halaman <b>Kategori</b> dari navigasi atas.</li>
            <li>Tambah, edit, atau hapus kategori sesuai kebutuhan toko.</li>
            <li>Menghapus kategori tidak akan menghapus barang — barang akan menjadi tidak berkategori.</li>
        </ul>
    </div>

    <!-- NOTE -->
    <div class="help-note">
        <i class="bi bi-info-circle"></i>
        Satuan barang diisi bebas sesuai kebutuhan — misalnya: pcs, pack, box, kg, liter, dan lain-lain.
    </div>

    <!-- IDENTITAS -->
    <div class="help-profile">
        <h3>Informasi Pengembang</h3>
        <p><b>Nama:</b> Cindy Vira Safitri</p>
        <p><b>NIM:</b> 2241720046</p>
        <p><b>Kelas:</b> TI-4G</p>
        <p><b>Alamat:</b> Jl Senggani No 36</p>
        <p><b>Email:</b> cindyvira929@gmail.com</p>
        <p><b>No. Telepon:</b> 081515617898</p>
    </div>

</div>

@endsection
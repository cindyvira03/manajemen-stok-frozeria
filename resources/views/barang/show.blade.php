@extends('layouts.app')

@section('title', 'Detail Barang')

@push('styles')
<style>

.detail-container {
    display: grid;
    gap: 16px;
}

/* HEADER */
.header-card {
    display: flex;
    flex-direction: column;   /* 🔥 jadi ke bawah */
    align-items: center;      /* 🔥 center horizontal */
    text-align: center;       /* 🔥 text ikut tengah */
    gap: 10px;
}

.header-card img {
    width: 90px;
    height: 90px;
    object-fit: cover;
    border-radius: 12px;
    border: 1px solid var(--border);
}

.header-card h2 {
    margin: 0;
    font-size: 20px;
}

.badge-kategori {
    background: var(--primary-light);
    color: var(--primary-dark);
    padding: 4px 10px;
    border-radius: 8px;
    font-size: 12px;
}

/* GRID */
.detail-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 14px;
}

.show-card {
    background: var(--card-bg);
    border: 1px solid var(--border);
    border-radius: 16px;
    padding: 16px;
    box-shadow: var(--shadow-sm);
}

.info-card p {
    font-size: 12px;
    color: var(--text-muted);
}

.info-card h3 {
    margin-top: 6px;
    font-size: 16px;
}

.top-actions {
    display: flex;
    gap: 6px;
    align-items: center;
}

.badge-danger {
    font-size: 12px;
    font-weight: 500;
    font-style: italic;
    margin-top: 6px;
    color: var(--danger);
}

.badge-warning {
    font-size: 12px;
    font-weight: 500;
    font-style: italic;
    margin-top: 6px;
    color: var(--warning);
}

.badge-primary {
    font-size: 12px;
    font-weight: 500;
    font-style: italic;
    margin-top: 6px;
    color: var(--primary);
}

.text-hint {
    font-size: 11px;
    font-style: italic;
    color: var(--primary);
    display: inline-flex;
    opacity: 0.8;
    gap: 2px;
}

/* RESPONSIVE */
@media (max-width: 768px) {
    .detail-grid {
        grid-template-columns: 1fr;
    }

    .header-card {
        flex-direction: column;
        align-items: flex-start;
    }
}
</style>
@endpush

@section('content')

<div class="page-top">
    <div class="page-title">
        <h1>Detail Barang</h1>
        <p>Informasi lengkap barang</p>
        <x-button type="kembali" :href="route('dashboard')">
            ← Kembali
        </x-button>
    </div>

    <div class="top-actions">
        <x-button type="edit" :href="route('barang.edit', $barang->id)">
            Edit
        </x-button>

        <x-button 
            type="hapus"
            onclick="openDeleteModal('{{ route('barang.destroy', $barang->id) }}', '{{ $barang->nama_barang }}')">
            Hapus
        </x-button>
    </div>
</div>

<div class="detail-container">

    <!-- HEADER (FOTO + NAMA) -->
    <div class="show-card header-card">
        @if($barang->foto)
            <img src="{{ asset('storage/' . $barang->foto) }}">
        @else
            <img src="https://placehold.co/38x38/e8f9f9/2EC4C4?text={{ substr($barang->nama_barang, 0, 1) }}" class="product-img" alt="{{ $barang->nama_barang }}">
        @endif

        <h2>{{ $barang->nama_barang }}</h2>
        <span class="badge-kategori">{{ $barang->kategori->nama_kategori ?? 'Tidak Berkategori' }}</span>
    </div>

    <!-- GRID INFO -->
    <div class="detail-grid">

        <div class="show-card info-card">
            <p>Jumlah Stok</p>
            <h3>{{ $barang->stok }} {{ $barang->satuan }}</h3>
             @if($barang->stok_status_class == 'stok-habis')
                <span class="badge-danger">Stok Habis</span>

            @elseif($barang->stok_status_class == 'stok-tipis')
                <span class="badge-warning">Stok Menipis</span>

            @else
                <span class="badge-primary">Stok Aman</span>
            @endif
        </div>

        <div class="show-card info-card">
            <p>Stok Minimum</p>
            <h3>
                {{ $barang->stok_minimum_fix }} {{ $barang->satuan }}
            </h3>

            @if(is_null($barang->stok_minimum))
                <span class="text-hint">
                    <i class="bi bi-info-circle"></i>
                    Stok minimum belum diisi, stok di atas merupakan default sistem (20)
                </span>
            @endif
        </div>

        <div class="show-card info-card">
            <p>Harga Jual</p>
            <h3>Rp {{ number_format($barang->harga_jual ?? 0, 0, ',', '.') }}</h3>
        </div>

        <div class="show-card info-card">
            <p>Harga Beli</p>
            <h3>Rp {{ number_format($barang->harga_beli ?? 0, 0, ',', '.') }}</h3>
        </div>

        <div class="show-card info-card">
            <p>Berat / Ukuran</p>
            <h3>{{ $barang->berat_atau_ukuran ?? '-' }}</h3>
        </div>

        <div class="show-card info-card">
            <p>Lokasi Simpan</p>
            <h3>{{ $barang->lokasi_simpan ?? '-' }}</h3>
        </div>

    </div>

    <!-- DESKRIPSI -->
    <div class="show-card info-card">
        <p>Deskripsi</p>
        <h3>{{ $barang->deskripsi ?? '-' }}</h3>
    </div>

</div>

<x-modal-delete />

@endsection

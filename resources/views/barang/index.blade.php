{{-- resources/views/barang/index.blade.php --}}

@extends('layouts.app')

@section('title', 'Dashboard')

@push('styles')
<style>

/* ===== STAT CARDS ===== */
.stats-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 16px;
    margin-bottom: 24px;
}

.stat-card {
    background: var(--card-bg);
    border-radius: 14px;
    padding: 20px;
    display: flex;
    align-items: center;
    gap: 14px;
    border: 1px solid var(--border);
    /* SHADOW DEFAULT */
    box-shadow: 0 4px 8px rgba(0,0,0,0.04);

    transition: all 0.25s ease;
    cursor: pointer;
}

.stat-card:hover {
    transform: translateY(-2px);

    /* SHADOW + GLOW BIRU */
    box-shadow: 0 6px 18px rgba(46,196,196,0.45);
}

.stat-icon {
    width: 46px;
    height: 46px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 20px;
    flex-shrink: 0;
}

.stat-icon.blue   { background: #e0f5ff; color: #0ea5e9; }
.stat-icon.orange { background: #fff4e0; color: #f97316; }
.stat-icon.yellow { background: #fffbe0; color: #f59e0b; }
.stat-icon.red    { background: #fee2e2; color: #ef4444; }

.stat-body {}

.stat-number {
    font-size: 28px;
    font-weight: 700;
    color: var(--text-dark);
    line-height: 1;
    margin-bottom: 4px;
}

.stat-label {
    font-size: 12px;
    color: var(--text-muted);
    font-weight: 500;
}

.stat-sublabel {
    display: block;
    font-size: 11px;
    margin-top: 5px;
    font-weight: 500;
}

.stat-sublabel.blue   { color: #0ea5e9; }
.stat-sublabel.orange { color: #f97316; }
.stat-sublabel.yellow { color: #f59e0b; }
.stat-sublabel.red    { color: #ef4444; }

/* Product name cell */
.product-cell {
    display: flex;
    align-items: center;
    gap: 11px;
}

.product-img {
    width: 38px;
    height: 38px;
    border-radius: 10px;
    object-fit: cover;
    border: 1px solid var(--border);
    flex-shrink: 0;
}

.product-name {
    font-weight: 500;
    color: var(--text-dark);
}

/* Stock color */
.stok-habis  { color: var(--danger); font-weight: 600; }
.stok-tipis  { color: var(--warning); font-weight: 600; }
.stok-normal { color: var(--primary); font-weight: 600; }


/* Pagination */
.table-footer {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 14px 20px;
    border-top: 1px solid var(--border);
    flex-wrap: wrap;
    gap: 10px;
}

.table-info {
    font-size: 12.5px;
    color: var(--text-muted);
}

.pagination {
    display: flex;
    align-items: center;
    gap: 4px;
}

.page-btn {
    min-width: 32px;
    height: 32px;
    border-radius: 8px;
    border: 1px solid var(--border);
    background: var(--card-bg);
    color: var(--text-dark);
    font-size: 13px;
    font-weight: 500;
    font-family: inherit;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    padding: 0 8px;
    transition: all 0.15s;
    text-decoration: none;
}

.page-btn:hover:not(:disabled):not(.active) {
    background: var(--body-bg);
    border-color: var(--primary);
    color: var(--primary);
}

.page-btn.active {
    background: var(--primary);
    border-color: var(--primary);
    color: #fff;
    box-shadow: 0 2px 8px rgba(46,196,196,0.3);
}

.page-btn:disabled {
    opacity: 0.4;
    cursor: not-allowed;
}

.page-dots {
    font-size: 13px;
    color: var(--text-muted);
    padding: 0 4px;
}

/* Responsive */
@media (max-width: 900px) {
    .stats-grid { grid-template-columns: repeat(2, 1fr); }
}

@media (max-width: 600px) {
    .stats-grid { grid-template-columns: 1fr 1fr; }
    .app-content { padding: 16px; }
    .btn-tambah span { display: none; }
}
</style>
@endpush

@section('content')

{{-- Page Top --}}
<div class="page-top">
    <div class="page-title">
        <h1>Dashboard</h1>
        <p>Ringkasan informasi stok barang</p>
    </div>
    <x-button type="tambah" :href="route('barang.create')">
        <i class="bi bi-plus-lg"></i>
        <span>Tambah Barang</span>
    </x-button>
</div>

@if(session('success'))
    <x-alert type="success">
        {{ session('success') }}
    </x-alert>
@endif

{{-- Stats Cards --}}
<div class="stats-grid">
    {{-- Total Barang --}}
    <div class="stat-card">
        <div class="stat-icon blue">
            <i class="bi bi-box-seam"></i>
        </div>
        <div class="stat-body">
            <div class="stat-label">Total Barang</div>
            <div class="stat-number">{{ $barang->total() }}</div>
            <span class="stat-sublabel blue">Semua barang terdaftar</span>
        </div>
    </div>

    {{-- Total Kategori --}}
    <div class="stat-card">
        <div class="stat-icon orange">
            <i class="bi bi-tag"></i>
        </div>
        <div class="stat-body">
            <div class="stat-label">Total Kategori</div>
            <div class="stat-number">{{ $kategori->count() }}</div>
            <span class="stat-sublabel orange">Kategori barang</span>
        </div>
    </div>

    {{-- Stok Menipis --}}
    <div class="stat-card">
        <div class="stat-icon yellow">
            <i class="bi bi-exclamation-triangle"></i>
        </div>
        <div class="stat-body">
            <div class="stat-label">Stok Menipis</div>
            <div class="stat-number">{{ $stokMenipis }}</div>
            <span class="stat-sublabel yellow">Stok di bawah minimum</span>
        </div>
    </div>

    {{-- Stok Habis --}}
    <div class="stat-card">
        <div class="stat-icon red">
            <i class="bi bi-x-circle"></i>
        </div>
        <div class="stat-body">
            <div class="stat-label">Stok Habis</div>
            <div class="stat-number">{{ $stokHabis }}</div>
            <span class="stat-sublabel red">Stok sudah habis</span>
        </div>
    </div>
</div>

{{-- Table Card --}}
<x-table-card>

    {{-- TOOLBAR --}}
    <x-slot name="toolbar">
        <div class="search-box">
            <input
                type="text"
                id="searchInput"
                placeholder="Cari nama barang..."
                value="{{ request('search') }}"
            >
            <button class="btn-search" onclick="filterTable()">
                <i class="bi bi-search"></i>
            </button>
        </div>

        <select id="filterKategori" class="filter-select" onchange="filterTable()">
            <option value="">Semua Kategori</option>

            @if($tidakBerkategori)
                <option value="null"
                    {{ request('kategori_id') === 'null' ? 'selected' : '' }}>
                    Tidak Berkategori
                </option>
            @endif

            @foreach($kategori as $kat)
                <option value="{{ $kat->id }}"
                    {{ request('kategori_id') == $kat->id ? 'selected' : '' }}>
                    {{ $kat->nama_kategori }}
                </option>
            @endforeach
        </select>
    </x-slot>

    {{-- HEADER --}}
    <x-slot name="head">
        <tr>
            <th>Nama Barang</th>
            <th>Kategori</th>
            <th>Stok</th>
            <th>Satuan</th>
            <th>Harga Jual</th>
            <th>Aksi</th>
        </tr>
    </x-slot>

    {{-- BODY --}}
    @forelse($barang as $b)
        <tr>
            <td>
                <div class="product-cell">
                    @if($b->foto)
                        <img src="{{ asset('storage/' . $b->foto) }}" class="product-img">
                    @else
                        <img src="https://placehold.co/38x38/e8f9f9/2EC4C4?text={{ substr($b->nama_barang, 0, 1) }}" class="product-img" alt="{{ $b->nama_barang }}">
                    @endif
                        <span class="product-name">{{ $b->nama_barang }}</span>
                </div>
            </td>
            <td>{{ $b->kategori->nama_kategori ?? 'Tidak Berkategori' }}</td>
            <td>
                <span class="{{ $b->stok_status_class }}">
                    {{ $b->stok }}
                </span>
            </td>
            <td>{{ $b->satuan }}</td>
            <td>Rp {{ number_format($b->harga_jual, 0, ',', '.') }}</td>
            <td>
                 <x-button type="detail" :href="route('barang.show', $b->id)">
                    Detail
                </x-button>
                 <x-button type="edit" :href="route('barang.edit', $b->id)">
                    Edit
                </x-button>
                <x-button 
                    type="hapus"
                    onclick="openDeleteModal('{{ route('barang.destroy', $b->id) }}', '{{ $b->nama_barang }}')">
                    Hapus
                </x-button>
            </td>
        </tr>
    @empty
        <tr>
             <td colspan="6" style="text-align:center; padding:40px 20px;">
                        
                <div style="display:flex; flex-direction:column; align-items:center; gap:10px;">

                    <i class="bi bi-box-seam" style="font-size:40px; color:#cbd5e1;"></i>

                    <span style="font-size:14px; font-weight:500; color:var(--text-muted);">
                        Belum ada data barang yang ditambahkan
                    </span>

                            {{-- <a href="{{ route('barang.create') }}" class="btn-tambah" style="margin-top:10px;">
                                <i class="bi bi-plus-lg"></i>
                                <span>Tambah Barang</span>
                            </a> --}}

                </div>

            </td>
        </tr>
    @endforelse

    {{-- FOOTER --}}
    <x-slot name="footer">
        <div class="table-info">
            @if($barang->count())
                Menampilkan {{ $barang->firstItem() }}–{{ $barang->lastItem() }} dari {{ $barang->total() }} barang
            @else
                Tidak ada data barang
            @endif
        </div>

        <div class="pagination">
            {{-- Prev --}}
            @if($barang->onFirstPage())
                <button class="page-btn" disabled>
                    <i class="bi bi-chevron-left"></i> Prev
                </button>
            @else
                <a href="{{ $barang->previousPageUrl() }}" class="page-btn">
                    <i class="bi bi-chevron-left"></i> Prev
                </a>
            @endif

            {{-- Page Numbers --}}
            @if($barang->lastPage() > 1)
                @for($i = 1; $i <= $barang->lastPage(); $i++)
                    @if($i == 1 || $i == $barang->lastPage() || abs($i - $barang->currentPage()) <= 1)
                        <a href="{{ $barang->url($i) }}"
                        class="page-btn {{ $barang->currentPage() == $i ? 'active' : '' }}">
                            {{ $i }}
                        </a>
                    @elseif($i == 2 || $i == $barang->lastPage() - 1)
                        <span class="page-dots">...</span>
                    @endif
                @endfor
            @endif

            {{-- Next --}}
            @if($barang->hasMorePages())
                <a href="{{ $barang->nextPageUrl() }}" class="page-btn">
                    Next <i class="bi bi-chevron-right"></i>
                </a>
            @else
                <button class="page-btn" disabled>
                    Next <i class="bi bi-chevron-right"></i>
                </button>
            @endif
        </div>
    </x-slot>

</x-table-card>

<x-modal-delete />

@endsection

@extends('layouts.app')

@section('title', 'Kategori')

@section('content')

{{-- HEADER --}}
<div class="page-top">
    <div class="page-title">
        <h1>Kategori</h1>
        <p>Kelola data kategori barang</p>
    </div>

    <x-button type="tambah" :href="route('kategori.create')">
        <i class="bi bi-plus-lg"></i>
        <span>Tambah Kategori</span>
    </x-button>
</div>

{{-- ALERT --}}
@if(session('success'))
    <x-alert type="success">
        {{ session('success') }}
    </x-alert>
@endif

{{-- TABLE CARD --}}
<x-table-card>

    <x-slot name="toolbar">
        <div class="search-box">
            <input type="text" id="searchInput" placeholder="Cari kategori..." value="{{ request('search') }}">
            <button class="btn-search" onclick="filterTable()">
                <i class="bi bi-search"></i>
            </button>
        </div>
    </x-slot>

    <x-slot name="head">
        <tr>
            <th>Nama Kategori</th>
            <th>Jumlah Barang</th>
            <th>Dibuat</th>
            <th>Aksi</th>
        </tr>
    </x-slot>

    @forelse($kategori as $k)
        <tr>
            <td>
                <strong>{{ $k->nama_kategori }}</strong>
            </td>

            <td>
                {{ $k->barang_count ?? 0 }} barang
            </td>

            <td>
                {{ \Carbon\Carbon::parse($k->created_at)->format('d M Y') }}
            </td>

            <td>
                <x-button type="edit" :href="route('kategori.edit', $k->id)">
                    Edit
                </x-button>

                <form action="{{ route('kategori.destroy', $k->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <x-button 
                        type="hapus"
                        onclick="openDeleteModal('{{ route('kategori.destroy', $k->id) }}', '{{ $k->nama_kategori }}')">
                        Hapus
                    </x-button>
                </form>
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="4" style="text-align:center; padding:40px;">
                <i class="bi bi-tag" style="font-size:40px; color:#cbd5e1;"></i>
                <p style="font-size:14px; font-weight:500; color:var(--text-muted);">
                    Belum ada data kategori yang ditambahkan
                </p>
            </td>
        </tr>
    @endforelse

</x-table-card>

<x-modal-delete />

@endsection

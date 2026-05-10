@extends('layouts.app')

@section('title', 'Edit Kategori')


@section('content')

{{-- HEADER --}}
<div class="page-top">
    <div class="page-title">
        <h1>Edit Kategori</h1>
        <p>Perbarui data kategori</p>
    </div>

    <x-button type="kembali" :href="route('kategori.index')">
        ← Kembali
    </x-button>
</div>

{{-- ALERT ERROR --}}
@if ($errors->any())
    <x-alert type="error">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </x-alert>
@endif

<form action="{{ route('kategori.update', $kategori->id) }}" method="POST">
@csrf
@method('PUT')

<div class="form-grid">

    <!-- INFORMASI -->
    <div class="card">
        <h3>Informasi Kategori</h3>

        <div class="form-group">
            <label>Nama Kategori <span class="required">*</span></label>
            <input type="text" name="nama_kategori"
                value="{{ old('nama_kategori', $kategori->nama_kategori) }}">
        </div>
    </div>

    <!-- DESKRIPSI -->
    <div class="card">
        <h3>Deskripsi</h3>

        <div class="form-group">
            <textarea name="deskripsi" rows="4" placeholder="Opsional...">{{ old('deskripsi', $kategori->deskripsi) }}</textarea>
        </div>
    </div>

</div>

<!-- ACTION -->
<div class="form-action">
    <x-button type="batal" :href="route('kategori.index')">
        Batal
    </x-button>

    <x-button type="submit" submit>
        Update Kategori
    </x-button>
</div>

</form>

@endsection
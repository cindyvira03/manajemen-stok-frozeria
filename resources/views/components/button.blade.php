@props([
    'type' => 'action', // tambah | detail | edit | hapus | batal | kembali | submit
    'href' => null,
    'submit' => false
])

@php
    $classes = match($type) {
        'tambah'   => 'btn-tambah',
        'detail'   => 'btn-action btn-detail',
        'edit'     => 'btn-action btn-edit',
        'hapus'    => 'btn-action btn-hapus',
        'batal'    => 'btn-batal',
        'kembali'  => 'btn-kembali',
        'submit'   => 'btn-primary',
        default    => 'btn-action',
    };
    $buttonType = $submit ? 'submit' : 'button';
@endphp

@if($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}
    </a>
@else
    <button type="{{ $buttonType }}" {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}
    </button>
@endif
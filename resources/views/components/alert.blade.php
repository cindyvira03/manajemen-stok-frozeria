@props([
    'type' => 'success', // success | error
])

@php
    $classes = match($type) {
        'success' => 'alert alert-success',
        'error'   => 'alert alert-danger',
        default   => 'alert',
    };

    $icon = match($type) {
        'success' => 'bi bi-check-circle',
        'error'   => 'bi bi-exclamation-circle',
        default   => 'bi bi-info-circle',
    };
@endphp

<div {{ $attributes->merge(['class' => $classes]) }} id="alertBox">

    <i class="{{ $icon }}"></i>

    <div class="alert-content">
        {{ $slot }}
    </div>

    <button type="button" class="alert-close" onclick="closeAlert(this)">
        &times;
    </button>

</div>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Frozeria Stok - @yield('title', 'Dashboard')</title>

    <link rel="icon" href="{{ asset('favicon.png') }}" type="image/png">

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    {{-- Google Fonts --}}
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    {{-- Bootstrap Icons --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    @stack('styles')
</head>
<body>

    {{-- NAVBAR --}}
    @include('components.navbar')


    <div class="app-main">

        {{-- Page Content --}}
        <main class="app-content">
            @yield('content')
        </main>

        {{-- Footer --}}
        @include('components.footer')

    </div>

    @stack('scripts')

    <script src="{{ asset('js/app.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
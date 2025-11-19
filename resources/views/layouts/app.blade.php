<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>@yield('title', config('app.name'))</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- estilos globais --}}
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
   
    @vite(['resources/js/app.js'])
    @stack('styles')
</head>
<body>
    <main role="main">
        @yield('content')
    </main>

    {{-- scripts globais --}}
    <script>
        // variáveis JS globais
        window.Laravel = {!! json_encode(['csrfToken' => csrf_token()]) !!};
    </script>

    @stack('scripts')
</body>
</html>
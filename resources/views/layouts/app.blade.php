<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>@yield('title', config('app.name'))</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- estilos globais --}}
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        :root{ --brand:#04488c; --muted:#6b7280; }
        body{ font-family:'Inter',system-ui,Arial; margin:0; background:#f4f4f9; color:#0b1730; }
        /* ...coloque aqui estilos compartilhados (ou importe CSS separado) ... */
    </style>

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
<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    {{-- Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inria+Serif:ital,wght@0,300;0,400;0,700;1,300;1,400;1,700&family=Inter:wght@100..900&family=Noto+Serif:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    {{-- Feather Icon --}}
    <script src="https://unpkg.com/feather-icons"></script>
</head>

<body>
    {{-- Navbar Comopnent --}}
    @include('Components.navbar')

    {{-- Main Content --}}
    @yield('content')

    {{-- Footer Comopnent --}}
    @include('Components.footer')

    <script>
        feather.replace();
    </script>
</body>

</html>

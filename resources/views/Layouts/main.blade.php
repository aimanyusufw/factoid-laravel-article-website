<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- SEO --}}
    {!! SEO::generate() !!}

    {{-- Tailwindcss --}}
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

        const navbar = document.getElementById("navbar");
        const hamburgerButton = document.getElementById("hamburger-toggle");
        const responsiveSideBar = document.getElementById("sidebar-responsive");

        hamburgerButton.addEventListener("click", () => {
            responsiveSideBar.classList.toggle("transform-none");
            document.body.classList.toggle("overflow-hidden");
            responsiveSideBar.classList.toggle("-translate-x-full");

            let sidebarBackDrop = document.getElementById("backdrop");

            if (!sidebarBackDrop) {
                var backdrop = document.createElement("div");
                backdrop.className = "bg-black bg-opacity-40 fixed inset-0 z-30";
                backdrop.id = "backdrop";
                document.body.appendChild(backdrop);

                backdrop.addEventListener("click", () => {
                    responsiveSideBar.classList.toggle("transform-none");
                    document.body.classList.toggle("overflow-hidden");
                    responsiveSideBar.classList.toggle("-translate-x-full");
                    backdrop.remove();
                });
            } else {
                sidebarBackDrop.remove();
            }
        });


        window.addEventListener("scroll", () => {
            const windowPost = window.scrollY > 0;
            navbar.classList.toggle("navbar-fixed", windowPost);
        });
    </script>
</body>

</html>

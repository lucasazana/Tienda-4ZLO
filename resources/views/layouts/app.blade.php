<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=5">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', '4ZLO | Ropa vintage, streetwear y prendas únicas en Perú')</title>
    <meta name="description" content="@yield('meta_description', 'Descubre 4ZLO: tu tienda online de ropa vintage, streetwear y prendas originales de los 90s. Envíos a todo el Perú. Renueva tu estilo con piezas únicas, auténticas y en tendencia. ¡Exprésate con moda retro y urbana!')">
    <meta name="keywords" content="ropa vintage, streetwear, 90s, tienda online, americana, moda retro, 4zlo, peru, ropa ancha, y2k, xeya, prendas únicas, moda urbana, tendencia, originales, retro, oversize, sudaderas, cortavientos, casacas, polos, moda joven, moda alternativa">
    <link rel="canonical" href="{{ url()->current() }}" />
    <!-- Open Graph -->
    <meta property="og:title" content="@yield('og_title', '4ZLO | Ropa vintage, streetwear y prendas únicas en Perú')" />
    <meta property="og:description" content="@yield('og_description', 'Descubre la mejor selección de ropa vintage y streetwear en 4ZLO. Prendas originales, únicas y en tendencia para destacar tu estilo en Perú.')" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta property="og:image" content="@yield('og_image', asset('img/logo.webp'))" />
    <link rel="icon" type="image/x-icon" href="{{ asset('img/icon.ico') }}" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preload" as="style" href="https://fonts.googleapis.com/css2?family=Alegreya+SC:ital,wght@0,400;0,500;0,700;0,800;0,900;1,400;1,500;1,700;1,800;1,900&family=Rajdhani:wght@300;400;500;600;700&display=swap">
    <link href="https://fonts.googleapis.com/css2?family=Alegreya+SC:ital,wght@0,400;0,500;0,700;0,800;0,900;1,400;1,500;1,700;1,800;1,900&family=Rajdhani:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" media="all" />
    @vite(['resources/css/app.css'])
    @livewireStyles
</head>

{{-- fondo negro y fuente definida --}}
<body class="antialiased bg-black flex flex-col min-h-screen font-rajdhani">

    {{-- navbar fijo con fondo borroso --}}
    <nav id="main-navbar" class="sticky top-0 z-50 bg-black/70 backdrop-blur-x1 shadow mt-10">
        <div class="max-w-7xl mx-auto px-8 py-5 flex justify-between items-center rounded-xl bg-black/70 shadow-lg border border-softgreen-700">
            <a href="{{ url('/') }}" class="flex items-center">
                <img src="{{ asset('img/logo.webp') }}" alt="logo de 4zlo tienda vintage y streetwear" class="h-16 w-auto filter grayscale-0 contrast-200 brightness-110 drop-shadow-md" loading="lazy">
            </a>
            <nav class="flex items-center space-x-10">
                <a href="{{ url('/') }}" class="navbar-link-blanco relative after:content-[''] after:block after:h-0.5 after:bg-white after:scale-x-0 hover:after:scale-x-100 after:transition-transform after:duration-300 after:origin-left">Inicio</a>

                <a href="{{ url('/productos') }}" class="navbar-link-blanco relative after:content-[''] after:block after:h-0.5 after:bg-white after:scale-x-0 hover:after:scale-x-100 after:transition-transform after:duration-300 after:origin-left">Productos</a>
                @auth
                    @if(auth()->user() && auth()->user()->name === '4zlo')
                        <a href="{{ route('dashboard') }}" class="navbar-link-blanco relative after:content-[''] after:block after:h-0.5 after:bg-white after:scale-x-0 hover:after:scale-x-100 after:transition-transform after:duration-300 after:origin-left">Nuevo producto</a>

                        <a href="{{ route('admin.productos.panel') }}" class="navbar-link-blanco relative after:content-[''] after:block after:h-0.5 after:bg-white after:scale-x-0 hover:after:scale-x-100 after:transition-transform after:duration-300 after:origin-left">Editar productos</a>
                    @endif
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="navbar-link-blanco relative after:content-[''] after:block after:h-0.5 after:bg-white after:scale-x-0 hover:after:scale-x-100 after:transition-transform after:duration-300 after:origin-left">Cerrar sesión</button>
                    </form>
                @endauth
            </nav>
        </div>
    </nav>


    {{-- contenido de cada pagina --}}
    <main class="flex-1">
        @yield('content')
    </main>

    {{-- footer --}}
    <footer class="bg-black mt-24 border-t border-softgreen-700 shadow-inner">
        <div class="max-w-7xl mx-auto px-6 py-10 flex flex-col items-center">
            <div class="flex space-x-7 mb-6">
                <a href="https://wa.me/51934329514" target="_blank" class="group text-softgreen-400 hover:text-softgreen-300 text-2xl transition-all duration-200" aria-label="WhatsApp">
                    <span class="inline-block bg-softgreen-900/60 rounded-full p-3 group-hover:bg-softgreen-400/20 transition-all duration-200">
                        <i class="fab fa-whatsapp"></i>
                    </span>
                </a>
                <a href="https://www.instagram.com/4zlo.pe/" target="_blank" class="group text-softgreen-400 hover:text-softgreen-300 text-2xl transition-all duration-200" aria-label="Instagram">
                    <span class="inline-block bg-softgreen-900/60 rounded-full p-3 group-hover:bg-softgreen-400/20 transition-all duration-200">
                        <i class="fab fa-instagram"></i>
                    </span>
                </a>
                <a href="https://www.tiktok.com/@4zlo.pe" target="_blank" class="group text-softgreen-400 hover:text-softgreen-300 text-2xl transition-all duration-200" aria-label="TikTok">
                    <span class="inline-block bg-softgreen-900/60 rounded-full p-3 group-hover:bg-softgreen-400/20 transition-all duration-200">
                        <i class="fa-brands fa-tiktok"></i>
                    </span>
                </a>
            </div>
            <div class="w-full h-px bg-gradient-to-r from-transparent via-softgreen-800 to-transparent mb-6"></div>
            <div class="text-softgreen-400 text-xs text-center tracking-wider select-none">
                &copy; 2025 4ZLO
                <span class="mx-1 text-softgreen-700">|</span>
                <span class="inline-block font-bold text-softgreen-500 hover:underline cursor-pointer transition" title="ver portafolio" onclick="window.open('#', '_blank')">Xeya</span>
                <span class="mx-1 text-softgreen-700">·</span>
                Todos los derechos reservados.
            </div>
        </div>
    </footer>

    {{-- scripts de livewire y cierre --}}
    @vite(['resources/js/app.js'], true)
    @livewireScripts

    {{-- JS centralizado en resources/js/app.js --}}
</body>
</html>

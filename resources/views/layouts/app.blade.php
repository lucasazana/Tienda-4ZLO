{{-- layout base de la app aqui se arma toda la estructura comun(head, navbar, footer y scripts) --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>

    {{-- head con meta tags, fuentes, og, favicon y estilos principales --}}
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=5">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', '4ZLO | Ropa vintage, streetwear y prendas únicas en Perú')</title>
    <meta name="description" content="@yield('meta_description', 'Descubre 4ZLO: tu tienda online de ropa vintage, streetwear y prendas originales de los 90s. Envíos a todo el Perú. Renueva tu estilo con piezas únicas, auténticas y en tendencia. ¡Exprésate con moda retro y urbana!')">
    <meta name="keywords" content="ropa vintage, streetwear, 90s, tienda online, americana, moda retro, 4zlo, peru, ropa ancha, y2k, xeya, prendas únicas, moda urbana, tendencia, originales, retro, oversize, sudaderas, cortavientos, casacas, polos, moda joven, moda alternativa">
    <link rel="canonical" href="{{ url()->current() }}" />

    <!-- open graph --> {{-- para compartir bonito en redes sociales --}}
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
    {{-- fin de los estilos y dependencias del head --}}
</head>

{{-- fondo negro y fuente definida para toda la app --}}
<body class="antialiased bg-black flex flex-col min-h-screen font-rajdhani">

    {{-- navbar principal, incluye logo y menu responsive --}}
    <nav class="sticky top-0 z-50 shadow mt-10" x-data="{ open: false }">
        <div :class="open ? 'backdrop-blur-2xl bg-black/80' : 'bg-black/70 backdrop-blur'" class="max-w-7xl mx-auto px-4 sm:px-8 py-4 flex items-center justify-between rounded-xl shadow-lg border border-softgreen-700 transition-all duration-300">

            <!-- logo -->
            <a href="{{ url('/') }}" class="flex items-center">
                <img src="{{ asset('img/logo.webp') }}" alt="logo de 4zlo tienda vintage y streetwear" class="h-12 w-auto md:h-16 filter grayscale-0 contrast-200 brightness-110 drop-shadow-md" loading="lazy">
            </a>

            <!-- boton hamburguesa (solo en mobile/tablet) -->
            <div class="sm:hidden">
                <button @click="open = !open" :aria-expanded="open ? 'true' : 'false'" aria-controls="main-menu" aria-label="Abrir menú" class="flex flex-col justify-center items-center w-10 h-10 rounded focus:outline-none focus:ring-2 focus:ring-softgreen-400 transition group">
                    <span aria-hidden="true" class="block w-7 h-0.5 bg-softgreen-400 rounded transition-all duration-300" :class="open ? 'rotate-45 translate-y-2' : ''"></span>
                    <span aria-hidden="true" class="block w-7 h-0.5 bg-softgreen-400 rounded mt-1.5 transition-all duration-300" :class="open ? 'opacity-0' : ''"></span>
                    <span aria-hidden="true" class="block w-7 h-0.5 bg-softgreen-400 rounded mt-1.5 transition-all duration-300" :class="open ? '-rotate-45 -translate-y-2' : ''"></span>
                </button>

                <!-- menu mobile -->
                <div x-show="open" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 -translate-y-4" x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 -translate-y-4" class="absolute left-0 top-0 w-full min-h-screen bg-black/95 z-50 flex flex-col items-center justify-center gap-8 text-xl px-4 py-10">

                    <!-- boton cerrar  -->
                    <button @click="open = false" aria-label="Cerrar menú" class="absolute top-4 right-4 text-5xl md:text-6xl text-softgreen-400 hover:text-red-500 focus:text-red-500 focus:outline-none focus:ring-2 focus:ring-softgreen-400 transition z-50">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <ul class="flex flex-col items-center gap-8 w-full mt-8" id="main-menu">
                        @include('layouts.partials.navbar-items')
                    </ul>
                </div>
            </div>

            <!-- menu desktop -->
            <ul class="hidden sm:flex flex-row items-center justify-end gap-6 md:gap-10 text-base font-bold">
                @include('layouts.partials.navbar-items')
            </ul>
        </div>
    </nav>


    {{-- aqui va el contenido de cada pagina --}}
    <main class="flex-1">
        @yield('content')
    </main>

    {{-- footer --}}
    <footer class="bg-black mt-24 border-t border-softgreen-700 shadow-inner">
        <div class="max-w-7xl mx-auto px-6 py-10 flex flex-col items-center">
            <div class="flex space-x-7 mb-6">
                <a href="https://wa.me/5199999999" target="_blank" class="group text-softgreen-400 hover:text-softgreen-300 text-2xl transition-all duration-200" aria-label="WhatsApp">
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
</body>
</html>

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=5">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }} | Ropa vintage 90s y streetwear</title>
    <meta name="description" content="Tienda online de ropa americana vintage y streetwear. Encuentra prendas únicas de los 90's, originales y en tendencia.">
    <meta name="keywords" content="ropa vintage, streetwear, 90s, tienda online, americana, moda retro, 4zlo, peru, ropa ancha, y2k, xeya">
    <link rel="canonical" href="{{ url()->current() }}" />
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
<body class="antialiased bg-black flex flex-col min-h-screen" style="font-family: 'Rajdhani', sans-serif;">

    {{-- navbar, logo y links --}}
    <nav class="bg-black shadow mb-8 mt-8">
        <div class="max-w-7xl mx-auto px-8 py-5 flex justify-between items-center mt-4 rounded-xl bg-black/95 shadow-lg border border-gray-900">
            <a href="{{ url('/') }}" class="flex items-center">
                <img src="{{ asset('img/logo.webp') }}" alt="logo de 4zlo tienda vintage y streetwear" class="h-16 w-auto filter grayscale-0 contrast-200 brightness-110 drop-shadow-md" loading="lazy">
            </a>
            <nav class="flex items-center space-x-10">
                <a href="{{ url('/') }}" class="text-xl font-bold text-white px-4 py-2 transition relative after:content-[''] after:block after:h-0.5 after:bg-white after:scale-x-0 hover:after:scale-x-100 after:transition-transform after:duration-300 after:origin-left uppercase tracking-wide">Inicio</a>

                <a href="{{ url('/productos') }}" class="text-xl font-semibold text-gray-200 px-4 py-2 transition relative after:content-[''] after:block after:h-0.5 after:bg-gray-400 after:scale-x-0 hover:after:scale-x-100 after:transition-transform after:duration-300 after:origin-left hover:text-white uppercase tracking-wide">Productos</a>
                @auth
                    @if(auth()->user() && auth()->user()->name === '4zlo')
                        <a href="{{ route('dashboard') }}" class="text-xl font-semibold text-green-400 hover:text-white px-4 py-2 transition uppercase tracking-wide bg-transparent border-none focus:outline-none">Nuevo producto</a>
                    @endif
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="text-xl font-semibold text-red-400 hover:text-white px-4 py-2 transition uppercase tracking-wide bg-transparent border-none focus:outline-none">Cerrar sesión</button>
                    </form>
                @endauth
            </nav>
        </div>
    </nav>


    {{-- contenido de cada pagina --}}
    <main class="flex-1">
        @yield('content')
    </main>

    {{-- footer profesional y minimalista --}}
    <footer class="bg-black mt-24 border-t border-gray-800/80 shadow-inner">
        <div class="max-w-7xl mx-auto px-6 py-10 flex flex-col items-center">
            <div class="flex space-x-7 mb-6">
                <a href="https://wa.me/51936137641" target="_blank" class="group text-gray-400 hover:text-green-400 text-2xl transition-all duration-200" aria-label="WhatsApp">
                    <span class="inline-block bg-gray-900/60 rounded-full p-3 group-hover:bg-green-400/10 transition-all duration-200">
                        <i class="fab fa-whatsapp"></i>
                    </span>
                </a>
                <a href="https://www.instagram.com/4zlo.pe/" target="_blank" class="group text-gray-400 hover:text-pink-400 text-2xl transition-all duration-200" aria-label="Instagram">
                    <span class="inline-block bg-gray-900/60 rounded-full p-3 group-hover:bg-pink-400/10 transition-all duration-200">
                        <i class="fab fa-instagram"></i>
                    </span>
                </a>
                <a href="https://www.tiktok.com/@4zlo.pe" target="_blank" class="group text-gray-400 hover:text-white text-2xl transition-all duration-200" aria-label="TikTok">
                    <span class="inline-block bg-gray-900/60 rounded-full p-3 group-hover:bg-white/10 transition-all duration-200">
                        <i class="fa-brands fa-tiktok"></i>
                    </span>
                </a>
            </div>
            <div class="w-full h-px bg-gradient-to-r from-transparent via-gray-800 to-transparent mb-6"></div>
            <div class="text-gray-500 text-xs text-center tracking-wider select-none">
                &copy; {{ date('Y') }} <span class="font-bold tracking-widest">4ZLO</span>
                <span class="mx-1">|</span>
                <span class="inline-block font-semibold text-white hover:underline cursor-pointer transition" title="ver portafolio" onclick="window.open('#', '_blank')">Xeya</span>
                <span class="mx-1">·</span>
                Todos los derechos reservados.
            </div>
        </div>
    </footer>

    {{-- scripts de livewire y cierre --}}
    @vite(['resources/js/app.js'])
    @livewireScripts

    <script>
    document.querySelectorAll('.product-tilt-card').forEach(card => {
        const tooltip = card.querySelector('.tooltip-product-card');
        const img = card.querySelector('img');
        card.addEventListener('mousemove', (e) => {
            const rect = card.getBoundingClientRect();
            const x = e.clientX - rect.left - rect.width / 2;
            const y = e.clientY - rect.top - rect.height / 2;
            const rotateX = (-y / (rect.height / 2)) * 10;
            const rotateY = (x / (rect.width / 2)) * 10;
            card.style.transform = `perspective(800px) rotateX(${rotateX}deg) rotateY(${rotateY}deg) scale(1.04)`;
            // Tooltip
            if (tooltip && e.target === img) {
                tooltip.style.opacity = 1;
                tooltip.style.left = (e.clientX - rect.left) + 'px';
                tooltip.style.top = (e.clientY - rect.top - 40) + 'px';
            } else if (tooltip) {
                tooltip.style.opacity = 0;
            }
        });
        card.addEventListener('mouseleave', () => {
            card.style.transform = 'perspective(800px) rotateX(0deg) rotateY(0deg) scale(1)';
            if (tooltip) tooltip.style.opacity = 0;
        });
        card.addEventListener('mouseenter', () => {
            card.style.transition = 'transform 0.2s cubic-bezier(.25,.8,.25,1)';
        });
    });
    </script>
</body>
</html>

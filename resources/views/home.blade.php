
@section('title', '4ZLO | Tienda online de ropa vintage y streetwear en Perú')
@section('meta_description', 'Bienvenido a 4ZLO, tu destino para encontrar ropa vintage, streetwear y prendas originales de los 90s. Descubre colecciones únicas, moda urbana y retro, con envíos a todo el Perú.')
@section('og_title', '4ZLO | Ropa vintage y streetwear en Perú')
@section('og_description', 'Explora la tienda online 4ZLO y encuentra prendas auténticas, oversize y en tendencia. ¡Exprésate con estilo propio!')
@section('og_image', asset('img/logo.webp'))
@extends('layouts.app')

@section('content')
<div class="w-full flex flex-col items-center pt-2 pb-8">
    <div class="w-full max-w-7xl px-2 md:px-8 flex flex-col items-center justify-center mt-12 mb-10">
        <h1 class="text-4xl md:text-5xl font-black text-white tracking-tight leading-tight mb-6 font-rajdhani tracking-tightest">
            4ZLO
        </h1>
        <div class="flex flex-col md:flex-row md:items-center gap-2 md:gap-4 mb-8 md:ml-20">
            <span class="text-sm md:text-base text-softgreen-400 font-medium uppercase">Envíos a todo el Perú</span>
            <span class="hidden md:inline text-softgreen-700 text-lg">|</span>
            <span class="text-sm md:text-base text-softgreen-400 font-medium uppercase">Nuevos ingresos cada semana</span>
        </div>
        <div class="w-full max-w-xs md:max-w-4xl h-px bg-gradient-to-r from-transparent via-softgreen-800 to-transparent mb-8"></div>
        <p class="text-base md:text-lg text-gray-300 font-medium max-w-xl mb-4">
            <span class="font-bold text-white">Tienda online</span> de ropa americana vintage &amp; streetwear.<br>
            <span class="text-softgreen-400 text-sm font-normal md:ml-24">Prendas únicas, originales y en tendencia.</span>
        </p>
        <p class="text-base md:text-lg font-bold text-softgreen-500 uppercase tracking-wide mt-6 mb-4">
            Mira lo que tenemos de nuevo
        </p>
    </div>
    <div class="w-full max-w-7xl mx-auto mb-8">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 mx-auto">
            @foreach($productos->take(8) as $producto)
                <x-product-card :producto="$producto" />
            @endforeach
        </div>
    </div>
    <a href="{{ route('productos.index') }}" class="inline-block mt-6 bg-black/90 border border-softgreen-700 text-softgreen-400 font-extrabold py-3 px-8 rounded-2xl shadow-lg hover:bg-softgreen-500 hover:text-black hover:border-softgreen-400 transition-all duration-200 tracking-widest uppercase text-base focus:outline-none focus:ring-2 focus:ring-softgreen-300">
        Ver más productos
    </a>
</div>
@endsection

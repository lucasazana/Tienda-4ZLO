@extends('layouts.app')

@section('content')
<div class="w-full max-w-7xl mx-auto px-2 md:px-8 pt-2 pb-8 text-center flex flex-col items-center">
    <h1 class="text-5xl md:text-6xl font-black mb-7 text-white tracking-tight leading-tight" style="font-family: 'Rajdhani', sans-serif; letter-spacing: 0.03em;">
        BIENVENIDO A LOS 90'S
    </h1>
    <p class="text-lg md:text-xl text-gray-300 mb-10 font-medium max-w-xl">
        <span class="font-bold text-white">Tienda online</span> de ropa americana vintage &amp; streetwear.<br>
        <span class="text-gray-500 text-base font-normal">Prendas únicas, originales y en tendencia.</span>
    </p>
    <div class="w-full mb-8">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-4 gap-x-10 gap-y-12 justify-center">
            @foreach($productos->take(8) as $producto)
                <x-product-card :producto="$producto" />
            @endforeach
        </div>
    </div>
    <a href="{{ route('productos.index') }}" class="inline-block mt-6 bg-white/5 border border-gray-800 text-white font-semibold py-3 px-8 rounded-full shadow hover:bg-white/10 hover:border-white transition-all duration-200 tracking-widest uppercase text-base focus:outline-none focus:ring-2 focus:ring-white/30">
        Ver más productos
    </a>
</div>
@endsection

@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto py-24 text-center flex flex-col items-center">
    <h1 class="text-5xl md:text-6xl font-black mb-7 text-white tracking-tight leading-tight" style="font-family: 'Rajdhani', sans-serif; letter-spacing: 0.03em;">
        BIENVENIDO A LOS 90'S
    </h1>
    <p class="text-lg md:text-xl text-gray-300 mb-10 font-medium max-w-xl">
        <span class="font-bold text-white">Tienda online</span> de ropa americana vintage &amp; streetwear.<br>
        <span class="text-gray-500 text-base font-normal">Prendas únicas, originales y en tendencia.</span>
    </p>
    <a href="{{ route('productos.index') }}" class="inline-block bg-white/5 border border-gray-800 text-white font-semibold py-3 px-8 rounded-full shadow hover:bg-white/10 hover:border-white transition-all duration-200 tracking-widest uppercase text-base focus:outline-none focus:ring-2 focus:ring-white/30">
        Ver más productos
    </a>
</div>
@endsection

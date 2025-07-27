@extends('layouts.app')

@section('content')
<div class="w-full flex justify-center items-center py-12 px-2 md:px-0 min-h-[70vh] bg-black">
    <div class="w-full max-w-4xl h-[600px] bg-black border border-softgreen-700 rounded-2xl shadow-lg flex flex-col md:flex-row overflow-hidden">

        <!-- Carrusel de imágenes -->
        <div class="md:w-1/2 w-full flex flex-col items-center justify-center border-r border-softgreen-900">
            <div id="carousel-producto" class="w-full flex flex-col items-center py-8 pb-8">
                @php $imagenes = $producto->imagenes ?? collect(); @endphp
                @if($imagenes->count())
                    <div class="img-main-container">
                        <img id="main-img" src="{{ $imagenes->first()->url }}" alt="{{ $producto->nombre }}"
                            class="img-producto-main">
                    </div>
                    @if($imagenes->count() > 1)
                        <div class="flex gap-3 mt-2 mb-4 justify-center px-6 md:px-10">
                            @foreach($imagenes as $img)
                                <img src="{{ $img->url }}" alt="{{ $producto->nombre }}"
                                    class="w-20 h-20 object-cover rounded-lg cursor-pointer thumb-img transition-all duration-200"
                                    onclick="document.getElementById('main-img').src='{{ $img->url }}'">
                            @endforeach
                        </div>
                    @endif
                @else
                    <div class="img-main-container">
                        <img src="{{ $producto->imagen_url }}" alt="{{ $producto->nombre }}"
                            class="img-producto-main">
                    </div>
                @endif
            </div>
        </div>

        <!-- Información del producto -->
        <div class="md:w-1/2 w-full flex flex-col justify-center p-8 gap-4">
            <h1 class="titulo-producto text-4xl md:text-5xl font-extrabold mb-4 text-softgreen-100 drop-shadow-lg">
                {{ $producto->nombre }}
            </h1>
            <div class="flex flex-wrap gap-4 mb-4">
                <span class="talla-producto-valor px-4 py-2 rounded-lg bg-softgreen-500 text-black font-bold uppercase tracking-wider shadow">Talla: {{ $producto->talla }}</span>
                <span class="talla-producto-valor px-4 py-2 rounded-lg bg-softgreen-500 text-black font-bold uppercase tracking-wider shadow">Medida: {{ $producto->medida }}</span>
                <span class="talla-producto-valor px-4 py-2 rounded-lg bg-softgreen-500 text-black font-bold uppercase tracking-wider shadow">Estado: {{ $producto->estado_ropa }}</span>
            </div>
            <div class="precio-producto text-3xl md:text-4xl mb-6 font-bold text-softgreen-400 drop-shadow">S/ {{ number_format($producto->precio, 2) }}</div>
            <div class="text-softgreen-200 text-lg mb-8 leading-relaxed">{{ $producto->descripcion }}</div>
            <a href="https://api.whatsapp.com/send?phone=51936137641&text={{ urlencode('Hola, quisiera reservar este producto: *' . $producto->nombre . '* ' . url()->current()) }}" target="_blank" class="btn-primary flex items-center justify-center gap-2 w-full max-w-xs mx-auto text-lg py-3 shadow-lg">
                <i class="fab fa-whatsapp text-2xl"></i>
                <span class="font-bold text-base">Reserva aquí</span>
            </a>
        </div>
    </div>
</div>
    @include('productos._random')
@endsection

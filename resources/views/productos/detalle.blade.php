@section('title', $producto->nombre . ' | 4ZLO')
@section('meta_description', 'Compra ' . $producto->nombre . ' en 4ZLO. ' . Str::limit(strip_tags($producto->descripcion), 120) . ' Talla: ' . $producto->talla . '. ¡Original, vintage y en tendencia!')
@section('og_title', $producto->nombre . ' | 4ZLO')
@section('og_description', 'Consigue ' . $producto->nombre . ' en 4ZLO. Prenda única, auténtica y lista para envío a todo el Perú.')
@section('og_image', $producto->imagen_url ?? asset('img/logo.webp'))
@extends('layouts.app')

@section('content')
<div class="w-full flex justify-center items-center py-6 sm:py-10 px-2 min-h-[70vh] bg-black">
    <div class="w-full max-w-4xl bg-black border border-softgreen-700 rounded-2xl shadow-lg flex flex-col md:flex-row overflow-hidden">

        <!-- carrusel de imagenes -->
        <div class="w-full md:w-1/2 flex flex-col items-center justify-center border-b md:border-b-0 md:border-r border-softgreen-900">
            <div id="carousel-producto" class="w-full flex flex-col items-center py-6 sm:py-8 pb-6 sm:pb-8">
                @php $imagenes = $producto->imagenes ?? collect(); @endphp
                @if($imagenes->count())
                    <div class="img-main-container">
                        <img id="main-img" src="{{ $imagenes->first()->url }}" alt="{{ $producto->nombre }}"
                            class="img-producto-main max-w-[70vw] max-h-[32vw] sm:max-w-[220px] sm:max-h-[220px] md:max-w-[300px] md:max-h-[300px]">
                    </div>
                    @if($imagenes->count() > 1)
                        <div class="flex items-center w-full mt-2 mb-4 justify-center gap-2 relative">
                            <button type="button" class="flex items-center justify-center bg-black/70 hover:bg-softgreen-700 text-white rounded-full w-10 h-10 shadow transition-all duration-200 z-10" id="carousel-left" aria-label="Anterior">
                                <i class="fas fa-chevron-left"></i>
                            </button>
                            <div class="flex gap-2 scrollbar-none px-2 max-w-[320px] sm:max-w-[360px] md:max-w-[400px] lg:max-w-[420px]" id="carousel-thumbs" style="scroll-snap-type: x mandatory;">
                                @foreach($imagenes as $img)
                                    <img src="{{ $img->url }}" alt="{{ $producto->nombre }}"
                                        class="w-20 h-20 object-cover rounded-lg cursor-pointer thumb-img transition-all duration-200 flex-shrink-0 scroll-snap-align-start"
                                        onclick="document.getElementById('main-img').src='{{ $img->url }}'">
                                @endforeach
                            </div>
                            <button type="button" class="flex items-center justify-center bg-black/70 hover:bg-softgreen-700 text-white rounded-full w-10 h-10 shadow transition-all duration-200 z-10" id="carousel-right" aria-label="Siguiente">
                                <i class="fas fa-chevron-right"></i>
                            </button>
                        </div>
                    @endif
                @else
                    <div class="img-main-container">
                        <img src="{{ $producto->imagen_url }}" alt="{{ $producto->nombre }}"
                            class="img-producto-main max-w-[70vw] max-h-[32vw] sm:max-w-[220px] sm:max-h-[220px] md:max-w-[300px] md:max-h-[300px]">
                    </div>
                @endif
            </div>
        </div>

        <!-- informacion del producto -->
        <div class="w-full md:w-1/2 flex flex-col justify-center p-4 sm:p-6 md:p-8 gap-4">
            <h1 class="titulo-producto text-3xl sm:text-4xl md:text-5xl font-extrabold mb-4 text-softgreen-100 drop-shadow-lg text-center md:text-left">
                {{ $producto->nombre }}
            </h1>
            <div class="flex flex-wrap gap-2 sm:gap-4 mb-4 justify-center md:justify-start">
                <span class="talla-producto-valor px-4 py-2 rounded-lg bg-softgreen-500 text-black font-bold uppercase tracking-wider shadow">Talla: {{ $producto->talla }}</span>
                <span class="talla-producto-valor px-4 py-2 rounded-lg bg-softgreen-500 text-black font-bold uppercase tracking-wider shadow">Medida: {{ $producto->medida }}</span>
                <span class="talla-producto-valor px-4 py-2 rounded-lg bg-softgreen-500 text-black font-bold uppercase tracking-wider shadow">Estado: {{ $producto->estado_ropa }}</span>
            </div>
            <div class="precio-producto text-2xl sm:text-3xl md:text-4xl mb-6 font-bold text-softgreen-400 drop-shadow text-center md:text-left">S/ {{ number_format($producto->precio, 2) }}</div>
            <div class="text-softgreen-200 text-base sm:text-lg mb-8 leading-relaxed text-center md:text-left">{{ $producto->descripcion }}</div>
                <a href="https://api.whatsapp.com/send?phone=519999999999d&text={{ urlencode('Hola, quisiera reservar este producto: *' . $producto->nombre . '* ' . url()->current()) }}" target="_blank" class="flex items-center justify-center gap-2 w-full max-w-xs mx-auto text-base sm:text-lg py-3 shadow-lg bg-softgreen-500 hover:bg-softgreen-400 text-black font-bold border-2 border-softgreen-400 transition-colors duration-200 rounded-full">
                    <i class="fab fa-whatsapp text-2xl"></i>
                    <span class="font-bold text-base">Reserva aquí</span>
                </a>
            </a>
        </div>
    </div>
</div>
    @include('productos._random')
@endsection

{{-- lightbox para las imagenes de un producto (zoom)--}}
<div id="lightbox-modal" class="fixed inset-0 z-50 items-center justify-center bg-black/80 hidden">
    <div class="relative bg-black rounded-2xl shadow-2xl flex flex-col md:flex-row max-w-5xl w-full max-h-[90vh] overflow-hidden">
        <button id="lightbox-close" class="absolute top-2 right-2 text-white bg-black/60 hover:bg-softgreen-700 rounded-full w-10 h-10 flex items-center justify-center z-20">
            <i class="fas fa-times text-2xl"></i>
        </button>
        <div class="flex-1 flex items-center justify-center p-4">
            <img id="lightbox-img" src="" alt="Imagen ampliada" class="max-h-[70vh] max-w-full rounded-xl shadow-xl bg-black object-contain">
        </div>
        <div class="flex flex-col md:w-32 w-full md:h-auto h-32 md:overflow-y-auto overflow-x-auto gap-2 p-4 bg-black/80">
            <div id="lightbox-thumbs" class="md:flex-col flex-row gap-2 w-full h-full items-center justify-center"></div>
        </div>
    </div>
</div>

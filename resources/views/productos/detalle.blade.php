@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8">
    <div class="max-w-2xl mx-auto bg-black/90 rounded-lg shadow-lg overflow-hidden border border-green-900">
        <img src="{{ $producto->imagen_url }}" alt="{{ $producto->nombre }}" class="w-full h-64 object-cover border-b border-green-900">
        <div class="p-6">
            <h1 class="text-3xl font-bold mb-4 text-green-400">{{ $producto->nombre }}</h1>
            <p class="text-green-200 mb-4">{{ $producto->descripcion }}</p>
            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <span class="font-semibold text-green-300">Talla:</span>
                    <span class="text-green-100">{{ $producto->talla }}</span>
                </div>
                <div>
                    <span class="font-semibold text-green-300">Medida:</span>
                    <span class="text-green-100">{{ $producto->medida }}</span>
                </div>
                <div>
                    <span class="font-semibold text-green-300">Estado:</span>
                    <span class="text-green-100">{{ $producto->estado_ropa }}</span>
                </div>
                <div>
                    <span class="font-semibold text-green-300">Precio:</span>
                    <span class="text-green-400 font-bold text-lg">S/ {{ number_format($producto->precio, 2) }}</span>
                </div>
            </div>
            <a href="https://wa.me/51936137641?text={{ urlencode('Hola, quiero reservar el producto: ' . $producto->nombre) }}" target="_blank" class="inline-block bg-green-500 hover:bg-green-600 text-black font-bold py-2 px-4 rounded transition border border-green-400">Reservar por WhatsApp</a>
        </div>
    </div>
</div>
@endsection

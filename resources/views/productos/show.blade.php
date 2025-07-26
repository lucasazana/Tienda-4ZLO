@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8">
    <div class="max-w-2xl mx-auto bg-white rounded-lg shadow-md overflow-hidden">
        <img src="{{ $producto->imagen_url }}" alt="{{ $producto->nombre }}" class="w-full h-64 object-cover">
        <div class="p-6">
            <h1 class="text-3xl font-bold mb-4 text-white">{{ $producto->nombre }}</h1>
            <p class="text-gray-700 mb-4">{{ $producto->descripcion }}</p>
            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <span class="font-semibold text-gray-600">Medida:</span>
                    <span class="text-gray-800">{{ $producto->medida }}</span>
                </div>
                <div>
                    <span class="font-semibold text-gray-600">Talla:</span>
                    <span class="text-gray-800">{{ $producto->talla }}</span>
                </div>
                <div>
                    <span class="font-semibold text-gray-600">Estado de la ropa:</span>
                    <span class="text-gray-800">{{ $producto->estado_ropa }}</span>
                </div>
                <div>
                    <span class="font-semibold text-gray-600">Precio:</span>
                    <span class="text-indigo-600 font-bold text-lg">${{ number_format($producto->precio, 2) }}</span>
                </div>
            </div>
            <a href="https://wa.me/?text={{ urlencode('Hola, quiero reservar el producto: ' . $producto->nombre) }}" target="_blank" class="inline-block bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded transition">Reservar por WhatsApp</a>
        </div>
    </div>
</div>
@endsection

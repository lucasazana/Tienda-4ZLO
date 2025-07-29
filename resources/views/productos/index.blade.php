@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8">
    <h1 class="text-3xl font-bold mb-8 text-center">Productos</h1>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
        @foreach($productos as $producto)
            <div class="bg-white rounded-lg shadow-md overflow-hidden flex flex-col">
                <a href="{{ route('productos.show', $producto->id) }}">
                    <img src="{{ $producto->imagen_url }}" alt="{{ $producto->nombre }}" class="h-48 w-full object-cover">
                </a>
                <div class="p-4 flex-1 flex flex-col justify-between">
                    <div>
                        <h2 class="text-xl font-semibold mb-2">{{ $producto->nombre }}</h2>
                        <p class="text-gray-600 mb-2">Talla: <span class="font-medium">{{ $producto->talla }}</span></p>
                    </div>
                    <div class="mt-4">
                        <span class="text-lg font-bold text-indigo-600">${{ number_format($producto->precio, 2) }}</span>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection

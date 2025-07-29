{{-- ver y editar los productos (solo admin) --}}
@section('head')
    <meta name="robots" content="noindex, nofollow">
@endsection

@section('title', 'Panel de administración | 4ZLO')
@section('meta_description', 'Administra el catálogo de productos de 4ZLO: agrega, edita o elimina prendas vintage y streetwear de manera segura y eficiente.')
@section('og_title', 'Panel de administración | 4ZLO')
@section('og_description', 'Panel privado para la gestión de productos en 4ZLO. Solo para administradores.')
@section('og_image', asset('img/logo.webp'))
@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-2 md:px-8 pt-12 pb-8">
    <h2 class="text-2xl font-bold mb-6 text-white">Editar productos</h2>
    <div class="rounded-xl border border-green-900 bg-black/90 shadow-lg">

        <!-- vista en desktop -->
        <table class="hidden md:table min-w-full divide-y divide-green-900">
            <thead class="bg-green-950">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-bold text-green-300 uppercase tracking-wider">Imagen</th>
                    <th class="px-6 py-3 text-left text-xs font-bold text-green-300 uppercase tracking-wider">Nombre</th>
                    <th class="px-6 py-3 text-left text-xs font-bold text-green-300 uppercase tracking-wider">Talla</th>
                    <th class="px-6 py-3 text-left text-xs font-bold text-green-300 uppercase tracking-wider">Estado</th>
                    <th class="px-6 py-3 text-left text-xs font-bold text-green-300 uppercase tracking-wider">Acciones</th>
                </tr>
            </thead>
            <tbody class="bg-black divide-y divide-green-900">
                @foreach($productos as $producto)
                    <tr>
                        <td>
                            <img src="{{ $producto->imagen_url }}" alt="{{ $producto->nombre }}" class="h-16 w-16 object-cover rounded-lg border border-gray-700">
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-green-400 font-semibold">{{ $producto->nombre }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-green-300 font-bold">{{ $producto->talla }}</td>
                        <td>
                            @if($producto->estado)
                                <span class="inline-block px-3 py-1 text-xs font-bold rounded-full bg-green-500 text-black border border-green-400">Disponible</span>
                            @else
                                <span class="inline-block px-3 py-1 text-xs font-bold rounded-full bg-red-500 text-black border border-red-400">No disponible</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.productos.edit', $producto->id) }}" class="inline-block bg-green-500 hover:bg-green-600 text-black font-bold py-2 px-4 rounded transition-all duration-200 text-xs">Editar</a>
                            <form action="{{ route('admin.productos.destroy', $producto->id) }}" method="POST" class="form-eliminar-producto inline-block ml-2">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="bg-red-600 hover:bg-red-700 text-black font-bold py-2 px-4 rounded transition-all duration-200 text-xs btn-eliminar ml-0">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- vista en mobile -->
        <div class="md:hidden flex flex-col gap-4 p-2">
            @foreach($productos as $producto)
            <div class="bg-black border border-green-900 rounded-xl shadow p-4 flex flex-col gap-2">
                <div class="flex items-center gap-4">
                    <img src="{{ $producto->imagen_url }}" alt="{{ $producto->nombre }}" class="h-16 w-16 object-cover rounded-lg border border-gray-700 flex-shrink-0">
                    <div>
                        <div class="text-green-400 font-semibold text-lg leading-tight">{{ $producto->nombre }}</div>
                        <div class="text-green-300 font-bold text-base">Talla: {{ $producto->talla }}</div>
                        <div class="mt-1">
                            @if($producto->estado)
                                <span class="inline-block px-3 py-1 text-xs font-bold rounded-full bg-green-500 text-black border border-green-400">Disponible</span>
                            @else
                                <span class="inline-block px-3 py-1 text-xs font-bold rounded-full bg-red-500 text-black border border-red-400">No disponible</span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="flex gap-2 mt-2">
                    <a href="{{ route('admin.productos.edit', $producto->id) }}" class="flex-1 bg-green-500 hover:bg-green-600 text-black font-bold py-2 px-4 rounded transition-all duration-200 text-xs text-center">Editar</a>
                    <form action="{{ route('admin.productos.destroy', $producto->id) }}" method="POST" class="form-eliminar-producto flex-1">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="w-full bg-red-600 hover:bg-red-700 text-black font-bold py-2 px-4 rounded transition-all duration-200 text-xs btn-eliminar">Eliminar</button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    <div class="mt-6 flex justify-center">
        {{ $productos->onEachSide(1)->links('vendor.pagination.custom-dark') }}
    </div>
</div>
@endsection

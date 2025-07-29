{{-- panel para registrar un nuevo producto (solo admin) --}}
@section('head')
    <meta name="robots" content="noindex, nofollow">
@endsection
@extends('layouts.app')

@section('content')

<div class="w-full max-w-xl md:max-w-2xl lg:max-w-3xl mx-auto py-6 sm:py-10 px-2 sm:px-6 md:px-8">
    @if(session('success'))
        <div class="mb-6 p-4 bg-green-500 text-black rounded shadow text-center font-bold border border-green-400">
            {{ session('success') }}
        </div>
    @endif
    <h2 class="text-2xl font-bold mb-8 text-green-400">Agregar nuevo producto</h2>
    <div id="success-message" class="mb-6 p-4 bg-green-500 text-black rounded shadow text-center font-bold border border-green-400 hidden"></div>
    <div id="error-message" class="mb-6 p-4 bg-red-500 text-black rounded shadow text-center font-bold border border-red-400 hidden"></div>
    <form id="producto-form" action="{{ route('admin.productos.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6 bg-black/90 p-4 sm:p-6 md:p-8 rounded-xl border border-green-900 shadow-lg">
        @csrf

        <div>
            <label for="nombre" class="block text-green-300 font-semibold mb-1">Nombre</label>
            <input type="text" name="nombre" id="nombre" class="w-full bg-gray-900 text-green-200 border border-green-700 rounded px-4 py-2 focus:outline-none focus:border-green-400" required>
        </div>

        <div>
            <label for="descripcion" class="block text-green-300 font-semibold mb-1">Descripción</label>
            <textarea name="descripcion" id="descripcion" rows="3" class="w-full bg-gray-900 text-green-200 border border-green-700 rounded px-4 py-2 focus:outline-none focus:border-green-400" required></textarea>
        </div>

        <div>
            <label for="medida" class="block text-green-300 font-semibold mb-1">Medidas</label>
            <input type="text" name="medida" id="medida" class="w-full bg-gray-900 text-green-200 border border-green-700 rounded px-4 py-2 focus:outline-none focus:border-green-400" required>
        </div>

        <div>
            <label for="talla" class="block text-green-300 font-semibold mb-1">Talla</label>
            <select name="talla" id="talla" class="w-full bg-gray-900 text-green-200 border border-green-700 rounded px-4 py-2 focus:outline-none focus:border-green-400" required>
                <option value="">Selecciona una talla</option>
                <option value="XS">XS</option>
                <option value="S">S</option>
                <option value="M">M</option>
                <option value="L">L</option>
                <option value="XL">XL</option>
                <option value="XXL">XXL</option>
                <option value="UNICA">ÚNICA</option>
            </select>
        </div>

        <div>
            <label for="categoria" class="block text-green-300 font-semibold mb-1">Categoría</label>
            <select name="categoria" id="categoria" class="w-full bg-gray-900 text-green-200 border border-green-700 rounded px-4 py-2 focus:outline-none focus:border-green-400" required>
                <option value="">Selecciona una categoría</option>
                <option value="Pantalón">Pantalón</option>
                <option value="Casacas">Casacas</option>
                <option value="Polos">Polos</option>
            </select>
        </div>

        <div>
            <label for="estado_ropa" class="block text-green-300 font-semibold mb-1">Estado de la prenda</label>
            <input type="text" name="estado_ropa" id="estado_ropa" placeholder="Ej: 9/10" class="w-full bg-gray-900 text-green-200 border border-green-700 rounded px-4 py-2 focus:outline-none focus:border-green-400" required>
        </div>

        <div>
            <label for="precio" class="block text-green-300 font-semibold mb-1">Precio (S/)</label>
            <input type="number" step="0.01" name="precio" id="precio" class="w-full bg-gray-900 text-green-200 border border-green-700 rounded px-4 py-2 focus:outline-none focus:border-green-400" required>
        </div>

        <div>
            <label for="estado" class="block text-green-300 font-semibold mb-1">Estado</label>
            <select name="estado" id="estado" class="w-full bg-gray-900 text-green-200 border border-green-700 rounded px-4 py-2 focus:outline-none focus:border-green-400" required>
                <option value="1">Disponible</option>
                <option value="0">No disponible</option>
            </select>
        </div>

        <div>
            <label for="imagenes" class="block text-green-300 font-semibold mb-1">Imágenes</label>
            <input type="file" name="imagenes[]" id="imagenes" accept="image/*" class="w-full text-green-200" multiple required>
            <small class="text-green-500">Puedes seleccionar varias imagenes. La primera sera la principal.</small>
        </div>

        <div class="pt-4">
            <button type="submit" class="w-full bg-green-500 hover:bg-green-600 text-black font-bold py-3 px-6 rounded transition-all duration-200 uppercase tracking-widest border border-green-400 text-base sm:text-lg">Publicar producto</button>
        </div>
    </form>

</div>
@endsection

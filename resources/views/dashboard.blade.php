@extends('layouts.app')

@section('content')

<div class="max-w-xl mx-auto py-12">
    <h2 class="text-2xl font-bold mb-8 text-white">Agregar nuevo producto</h2>
    <form action="{{ route('admin.productos.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6 bg-black/80 p-8 rounded-xl border border-gray-800 shadow-lg">
        @csrf

        <div>
            <label for="nombre" class="block text-gray-300 font-semibold mb-1">Nombre</label>
            <input type="text" name="nombre" id="nombre" class="w-full bg-gray-900 text-white border border-gray-700 rounded px-4 py-2 focus:outline-none focus:border-white" required>
        </div>

        <div>
            <label for="descripcion" class="block text-gray-300 font-semibold mb-1">Descripción</label>
            <textarea name="descripcion" id="descripcion" rows="3" class="w-full bg-gray-900 text-white border border-gray-700 rounded px-4 py-2 focus:outline-none focus:border-white" required></textarea>
        </div>

        <div>
            <label for="medidas" class="block text-gray-300 font-semibold mb-1">Medidas</label>
            <input type="text" name="medidas" id="medidas" class="w-full bg-gray-900 text-white border border-gray-700 rounded px-4 py-2 focus:outline-none focus:border-white" required>
        </div>

        <div>
            <label for="talla" class="block text-gray-300 font-semibold mb-1">Talla</label>
            <select name="talla" id="talla" class="w-full bg-gray-900 text-white border border-gray-700 rounded px-4 py-2 focus:outline-none focus:border-white" required>
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
            <label for="estado_ropa" class="block text-gray-300 font-semibold mb-1">Estado de la prenda</label>
            <input type="text" name="estado_ropa" id="estado_ropa" placeholder="Ej: 9/10" class="w-full bg-gray-900 text-white border border-gray-700 rounded px-4 py-2 focus:outline-none focus:border-white" required>
        </div>

        <div>
            <label for="precio" class="block text-gray-300 font-semibold mb-1">Precio (S/)</label>
            <input type="number" step="0.01" name="precio" id="precio" class="w-full bg-gray-900 text-white border border-gray-700 rounded px-4 py-2 focus:outline-none focus:border-white" required>
        </div>

        <div>
            <label for="estado" class="block text-gray-300 font-semibold mb-1">Estado</label>
            <select name="estado" id="estado" class="w-full bg-gray-900 text-white border border-gray-700 rounded px-4 py-2 focus:outline-none focus:border-white" required>
                <option value="disponible">Disponible</option>
                <option value="no">No disponible</option>
            </select>
        </div>

        <div>
            <label for="imagen" class="block text-gray-300 font-semibold mb-1">Imagen</label>
            <input type="file" name="imagen" id="imagen" accept="image/*" class="w-full text-gray-300" required>
        </div>

        <div class="pt-4">
            <button type="submit" class="w-full bg-white/10 hover:bg-white/20 text-white font-bold py-3 px-6 rounded transition-all duration-200 uppercase tracking-widest">Publicar producto</button>
        </div>
    </form>
</div>
@endsection

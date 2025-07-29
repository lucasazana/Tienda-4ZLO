{{-- editar los datos de un producto (funcion solo para el admin) --}}
@section('head')
    <meta name="robots" content="noindex, nofollow">
@endsection
@extends('layouts.app')

@section('content')
<div class="w-full max-w-xl md:max-w-2xl lg:max-w-3xl mx-auto py-6 sm:py-10 px-2 sm:px-6 md:px-8">
    <h2 class="text-2xl font-bold mb-8 text-green-400 text-center">Editar producto</h2>
    <form action="{{ route('admin.productos.update', $producto->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6 bg-black/90 p-4 sm:p-6 md:p-8 rounded-xl border border-green-900 shadow-lg">
        @csrf
        @method('PUT')

        <div>
            <label for="nombre" class="block text-green-300 font-semibold mb-1">Nombre</label>
            <input type="text" name="nombre" id="nombre" value="{{ old('nombre', $producto->nombre) }}" class="w-full bg-gray-900 text-green-200 border border-green-700 rounded px-4 py-2 focus:outline-none focus:border-green-400" required>
        </div>

        <div>
            <label for="descripcion" class="block text-green-300 font-semibold mb-1">Descripción</label>
            <textarea name="descripcion" id="descripcion" rows="3" class="w-full bg-gray-900 text-green-200 border border-green-700 rounded px-4 py-2 focus:outline-none focus:border-green-400" required>{{ old('descripcion', $producto->descripcion) }}</textarea>
        </div>

        <div>
            <label for="medida" class="block text-green-300 font-semibold mb-1">Medidas</label>
            <input type="text" name="medida" id="medida" value="{{ old('medida', $producto->medida) }}" class="w-full bg-gray-900 text-green-200 border border-green-700 rounded px-4 py-2 focus:outline-none focus:border-green-400" required>
        </div>

        <div>
            <label for="talla" class="block text-green-300 font-semibold mb-1">Talla</label>
            <select name="talla" id="talla" class="w-full bg-gray-900 text-green-200 border border-green-700 rounded px-4 py-2 focus:outline-none focus:border-green-400" required>
                <option value="">Selecciona una talla</option>
                @foreach(['XS','S','M','L','XL','XXL','UNICA'] as $talla)
                    <option value="{{ $talla }}" @if(old('talla', $producto->talla) == $talla) selected @endif>{{ $talla }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="categoria" class="block text-green-300 font-semibold mb-1">Categoría</label>
            <select name="categoria" id="categoria" class="w-full bg-gray-900 text-green-200 border border-green-700 rounded px-4 py-2 focus:outline-none focus:border-green-400" required>
                <option value="">Selecciona una categoría</option>
                @foreach(['Pantalón','Casacas','Polos'] as $categoria)
                    <option value="{{ $categoria }}" @if(old('categoria', $producto->categoria) == $categoria) selected @endif>{{ $categoria }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="estado_ropa" class="block text-green-300 font-semibold mb-1">Estado de la prenda</label>
            <input type="text" name="estado_ropa" id="estado_ropa" value="{{ old('estado_ropa', $producto->estado_ropa) }}" class="w-full bg-gray-900 text-green-200 border border-green-700 rounded px-4 py-2 focus:outline-none focus:border-green-400" required>
        </div>

        <div>
            <label for="precio" class="block text-green-300 font-semibold mb-1">Precio (S/)</label>
            <input type="number" step="0.01" name="precio" id="precio" value="{{ old('precio', $producto->precio) }}" class="w-full bg-gray-900 text-green-200 border border-green-700 rounded px-4 py-2 focus:outline-none focus:border-green-400" required>
        </div>

        <div>
            <label for="estado" class="block text-green-300 font-semibold mb-1">Estado</label>
            <select name="estado" id="estado" class="w-full bg-gray-900 text-green-200 border border-green-700 rounded px-4 py-2 focus:outline-none focus:border-green-400" required>
                <option value="1" @if(old('estado', $producto->estado)) selected @endif>Disponible</option>
                <option value="0" @if(!old('estado', $producto->estado)) selected @endif>No disponible</option>
            </select>
        </div>

        <div>
            <label for="imagen" class="block text-green-300 font-semibold mb-1">Imagen (opcional)</label>
            <input type="file" name="imagen" id="imagen" accept="image/*" class="w-full text-green-200">
            @if($producto->imagen_url)
                <img src="{{ $producto->imagen_url }}" alt="Imagen actual" class="mt-2 h-24 w-24 object-cover rounded border border-green-700">
            @endif
        </div>

        <div class="pt-4 flex flex-col gap-3">
            <button type="submit" class="w-full bg-green-500 hover:bg-green-600 text-black font-bold py-3 px-6 rounded transition-all duration-200 uppercase tracking-widest border border-green-400 text-base sm:text-lg">Actualizar producto</button>
            <button type="button" onclick="window.history.back()" class="w-full bg-red-600 hover:bg-red-700 text-white font-bold py-3 px-6 rounded transition-all duration-200 uppercase tracking-widest border border-red-400 text-base sm:text-lg">Volver</button>
        </div>
    </form>
</div>
@endsection

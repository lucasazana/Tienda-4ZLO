
@section('title', 'Panel de administración | 4ZLO')
@section('meta_description', 'Administra el catálogo de productos de 4ZLO: agrega, edita o elimina prendas vintage y streetwear de manera segura y eficiente.')
@section('og_title', 'Panel de administración | 4ZLO')
@section('og_description', 'Panel privado para la gestión de productos en 4ZLO. Solo para administradores.')
@section('og_image', asset('img/logo.webp'))
@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-2 md:px-8 pt-12 pb-8">
    <h2 class="text-2xl font-bold mb-6 text-white">Editar productos</h2>
    <div class="overflow-x-auto rounded-xl border border-green-900 bg-black/90 shadow-lg">
        <table class="admin-productos-table">
            <thead class="admin-productos-thead">
                <tr>
                    <th class="admin-productos-th">Imagen</th>
                    <th class="admin-productos-th">Nombre</th>
                    <th class="admin-productos-th">Talla</th>
                    <th class="admin-productos-th">Estado</th>
                    <th class="admin-productos-th">Acciones</th>
                </tr>
            </thead>
            <tbody class="admin-productos-row">
                @foreach($productos as $producto)
                    <tr>
                        <td>
                            <img src="{{ $producto->imagen_url }}" alt="{{ $producto->nombre }}" class="admin-productos-img">
                        </td>
                        <td class="admin-productos-nombre">{{ $producto->nombre }}</td>
                        <td class="admin-productos-talla">{{ $producto->talla }}</td>
                        <td>
                            @if($producto->estado)
                                <span class="admin-productos-estado admin-productos-estado-disponible">Disponible</span>
                            @else
                                <span class="admin-productos-estado admin-productos-estado-no">No disponible</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.productos.edit', $producto->id) }}" class="admin-productos-acciones">Editar</a>
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
    </div>
    <div class="admin-productos-paginacion">
        {{ $productos->onEachSide(1)->links('vendor.pagination.custom-dark') }}
    </div>
</div>
@endsection

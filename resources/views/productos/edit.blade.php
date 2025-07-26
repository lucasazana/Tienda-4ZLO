@extends('layouts.app')

@section('content')
<div class="form-editar-container">
    <h2 class="form-editar-title">Editar producto</h2>
    <form action="{{ route('admin.productos.update', $producto->id) }}" method="POST" enctype="multipart/form-data" class="form-editar-producto">
        @csrf
        @method('PUT')

        <div>
            <label for="nombre" class="form-editar-label">Nombre</label>
            <input type="text" name="nombre" id="nombre" value="{{ old('nombre', $producto->nombre) }}" class="form-editar-input" required>
        </div>

        <div>
            <label for="descripcion" class="form-editar-label">Descripción</label>
            <textarea name="descripcion" id="descripcion" rows="3" class="form-editar-textarea" required>{{ old('descripcion', $producto->descripcion) }}</textarea>
        </div>

        <div>
            <label for="medida" class="form-editar-label">Medidas</label>
            <input type="text" name="medida" id="medida" value="{{ old('medida', $producto->medida) }}" class="form-editar-input" required>
        </div>

        <div>
            <label for="talla" class="form-editar-label">Talla</label>
            <select name="talla" id="talla" class="form-editar-select" required>
                <option value="">Selecciona una talla</option>
                @foreach(['XS','S','M','L','XL','XXL','UNICA'] as $talla)
                    <option value="{{ $talla }}" @if(old('talla', $producto->talla) == $talla) selected @endif>{{ $talla }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="categoria" class="form-editar-label">Categoría</label>
            <select name="categoria" id="categoria" class="form-editar-select" required>
                <option value="">Selecciona una categoría</option>
                @foreach(['Pantalón','Casacas','Polos'] as $categoria)
                    <option value="{{ $categoria }}" @if(old('categoria', $producto->categoria) == $categoria) selected @endif>{{ $categoria }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="estado_ropa" class="form-editar-label">Estado de la prenda</label>
            <input type="text" name="estado_ropa" id="estado_ropa" value="{{ old('estado_ropa', $producto->estado_ropa) }}" class="form-editar-input" required>
        </div>

        <div>
            <label for="precio" class="form-editar-label">Precio (S/)</label>
            <input type="number" step="0.01" name="precio" id="precio" value="{{ old('precio', $producto->precio) }}" class="form-editar-input" required>
        </div>

        <div>
            <label for="estado" class="form-editar-label">Estado</label>
            <select name="estado" id="estado" class="form-editar-select" required>
                <option value="1" @if(old('estado', $producto->estado)) selected @endif>Disponible</option>
                <option value="0" @if(!old('estado', $producto->estado)) selected @endif>No disponible</option>
            </select>
        </div>

        <div>
            <label for="imagen" class="form-editar-label">Imagen (opcional)</label>
            <input type="file" name="imagen" id="imagen" accept="image/*" class="form-editar-file">
            @if($producto->imagen_url)
                <img src="{{ $producto->imagen_url }}" alt="Imagen actual" class="form-editar-img-preview">
            @endif
        </div>

        <div class="pt-4">
            <button type="submit" class="form-editar-btn">Actualizar producto</button>
        </div>
    </form>
</div>
@endsection

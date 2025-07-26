@extends('layouts.app')

@section('content')
<div class="contenedor-productos">
    <div class="productos-grid">
        @foreach($productos as $producto)
            <x-product-card :producto="$producto" />
        @endforeach
    </div>
    @if(method_exists($productos, 'links'))
    <div class="paginacion-productos">
        {{ $productos->links('vendor.pagination.custom-dark') }}
    </div>
    @endif
</div>
@endsection

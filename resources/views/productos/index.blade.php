
@section('title', 'Catálogo de productos | 4ZLO')
@section('meta_description', 'Explora el catálogo de 4ZLO: ropa vintage, streetwear, cortavientos, casacas, polos y más. Prendas únicas y originales listas para ti. ¡Renueva tu clóset con estilo!')
@section('og_title', 'Catálogo de productos | 4ZLO')
@section('og_description', 'Descubre la mejor selección de ropa vintage y streetwear en nuestro catálogo. Prendas auténticas, originales y en tendencia para destacar tu look.')
@section('og_image', asset('img/logo.webp'))
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

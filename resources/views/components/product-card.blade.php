<div class="product-tilt-card card-producto group relative @if(!$producto->estado) opacity-50 pointer-events-none @endif">
    @if(!$producto->estado)
        <div class="absolute inset-0 flex items-center justify-center z-10">
            <span class="animate-pulse text-4xl font-black text-white/80 bg-black/60 px-8 py-2 rounded-lg uppercase tracking-widest">sold out</span>
        </div>
    @endif
    <div class="relative">
        <a href="{{ route('productos.show', $producto->id) }}" class="block">
            <img src="{{ $producto->imagen_url }}" alt="{{ $producto->nombre }}" class="img-producto group-hover:scale-105">
        </a>
    </div>
    <div class="p-6 flex-1 flex flex-col justify-between">
        <div class="mb-4">
            <h2 class="titulo-producto">{{ $producto->nombre }}</h2>
            <div class="mb-2">
                <span class="talla-producto">Talla: <span class="talla-producto-valor">{{ $producto->talla }}</span></span>
            </div>
            <span class="precio-producto">S/.{{ number_format($producto->precio, 2) }}</span>
        </div>
        <a href="{{ route('productos.show', $producto->id) }}" class="mt-auto btn-primary">
            Ver detalles
        </a>
    </div>
</div>

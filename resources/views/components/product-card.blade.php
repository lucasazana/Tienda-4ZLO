{{-- tarjeta de producto para mostrar en el catalogo con efecto tilt y estilos responsivos --}}
<div class="product-tilt-card card-producto group relative bg-black/90 border border-softgreen-700 rounded-2xl shadow-lg overflow-hidden flex flex-col transition-all duration-200 hover:border-softgreen-400 hover:shadow-card-hover will-change-transform min-w-[270px] max-w-[340px] mx-auto @if(!$producto->estado) opacity-50 pointer-events-none @endif">

    {{-- si el producto no esta disponible muestra el cartel de sold out y desactiva la tarjeta --}}
    @if(!$producto->estado)
        <div class="absolute inset-0 flex items-center justify-center z-10">
            <span class="animate-pulse text-4xl font-black text-white/80 bg-black/60 px-8 py-2 rounded-lg uppercase tracking-widest">sold out</span>
        </div>
    @endif
    <div class="relative">

        {{-- imagen del producto con efecto hover para agrandar --}}
        <a href="{{ route('productos.show', $producto->id) }}" class="block">
            <img src="{{ $producto->imagen_url }}" alt="{{ $producto->nombre }}" class="img-producto group-hover:scale-105 h-48 sm:h-56 md:h-60 w-full object-cover border-b border-softgreen-900 transition-transform duration-300 bg-gray-900">
        </a>
    </div>
    <div class="p-4 sm:p-5 md:p-6 flex-1 flex flex-col justify-between">

        {{-- info del producto (nombre, talla y precio) --}}
        <div class="mb-4">
            <h2 class="text-2xl font-black text-softgreen-400 mb-1 tracking-tight leading-tight font-rajdhani">{{ $producto->nombre }}</h2>
            <div class="mb-2">
                <span class="text-xs text-softgreen-300">Talla: <span class="text-sm font-semibold text-softgreen-400">{{ $producto->talla }}</span></span>
            </div>
            <span class="block text-xl font-extrabold text-softgreen-400 tracking-tight">S/.{{ number_format($producto->precio, 2) }}</span>
        </div>

        {{-- boton para ver detalles del producto --}}
        <a href="{{ route('productos.show', $producto->id) }}" class="mt-auto w-full text-center bg-softgreen-500 text-black font-semibold py-2 rounded-lg transition-colors duration-200 shadow focus:outline-none focus:ring-2 focus:ring-softgreen-300 text-sm uppercase tracking-wider border border-transparent hover:bg-black hover:text-white hover:border-softgreen-900">
            Ver detalles
        </a>
    </div>
</div>

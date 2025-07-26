<div class="product-tilt-card bg-black/90 border border-gray-800 rounded-2xl shadow-lg overflow-hidden flex flex-col transition-all duration-200 hover:shadow-2xl group hover:border-indigo-400 hover:shadow-[0_0_16px_2px_rgba(99,102,241,0.5)]" style="will-change: transform; min-width: 270px; max-width: 340px;">
    <div class="relative">
        <a href="{{ route('productos.show', $producto->id) }}" class="block">
            <img src="{{ $producto->imagen_url }}" alt="{{ $producto->nombre }}" class="h-60 w-full object-cover border-b border-gray-800 group-hover:scale-105 transition-transform duration-300 bg-gray-900">
        </a>
    </div>
    <div class="p-6 flex-1 flex flex-col justify-between">
        <div class="mb-4">
            <h2 class="text-2xl font-black text-white mb-1 tracking-tight leading-tight" style="font-family: 'Rajdhani', sans-serif;">{{ $producto->nombre }}</h2>
            <div class="mb-2">
                <span class="text-xs text-gray-400">Talla: <span class="text-sm font-semibold text-indigo-300">{{ $producto->talla }}</span></span>
            </div>
            <span class="block text-xl font-extrabold text-indigo-400 tracking-tight">${{ number_format($producto->precio, 2) }}</span>
        </div>
        <a href="{{ route('productos.show', $producto->id) }}" class="mt-auto inline-block w-full text-center bg-indigo-500 hover:bg-indigo-600 text-white font-semibold py-2 rounded-lg transition-colors duration-200 shadow focus:outline-none focus:ring-2 focus:ring-indigo-300 text-sm uppercase tracking-wider">Ver detalles</a>
    </div>
</div>

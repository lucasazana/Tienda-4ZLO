<div>
    <div class="mb-4">
        <label for="talla" class="block text-sm font-medium text-gray-700">Filtrar por talla:</label>
        <select wire:model="tallaSeleccionada" id="talla" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
            <option value="">Todas</option>
            @foreach($tallas as $talla)
                <option value="{{ $talla }}">{{ $talla }}</option>
            @endforeach
        </select>
    </div>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
        @foreach($productos as $producto)
            <div class="bg-white rounded-lg shadow-md overflow-hidden flex flex-col">
                <a href="{{ route('productos.show', $producto->id) }}">
                    <img src="{{ $producto->imagen_url }}" alt="{{ $producto->nombre }}" class="h-48 w-full object-cover">
                </a>
                <div class="p-4 flex-1 flex flex-col justify-between">
                    <div>
                        <h2 class="text-xl font-semibold mb-2">{{ $producto->nombre }}</h2>
                        <p class="text-gray-600 mb-2">Talla: <span class="font-medium">{{ $producto->talla }}</span></p>
                    </div>
                    <div class="mt-4">
                        <span class="text-lg font-bold text-indigo-600">${{ number_format($producto->precio, 2) }}</span>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

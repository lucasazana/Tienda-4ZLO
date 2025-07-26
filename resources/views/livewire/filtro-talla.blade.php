<div>
    <div class="mb-4">
        <label for="talla" class="block text-sm font-medium text-gray-700">Filtrar por talla:</label>
        <select wire:model="tallaSeleccionada" id="talla" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm mb-2">
            <option value="">Todas</option>
            @foreach($tallas as $talla)
                <option value="{{ $talla }}">{{ $talla }}</option>
            @endforeach
        </select>

        <label for="categoria" class="block text-sm font-medium text-gray-700 mt-2">Filtrar por categoría:</label>
        <select wire:model="categoriaSeleccionada" id="categoria" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm mb-2">
            <option value="">Todas</option>
            @foreach($categorias as $categoria)
                <option value="{{ $categoria }}">{{ $categoria }}</option>
            @endforeach
        </select>

        <label for="ordenPrecio" class="block text-sm font-medium text-gray-700 mt-2">Ordenar por precio:</label>
        <select wire:model="ordenPrecio" id="ordenPrecio" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
            <option value="">Sin orden</option>
            <option value="asc">Menor a mayor</option>
            <option value="desc">Mayor a menor</option>
        </select>
    </div>
    <div class="w-full mb-8">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-4 gap-x-10 gap-y-12 justify-center">
            @forelse($productos as $producto)
                <x-product-card :producto="$producto" />
            @empty
                <div class="col-span-4 text-center text-gray-500 py-8 font-semibold text-lg">¡Ups! Nos quedamos sin stock, pero pronto traeremos nuevas prendas únicas.</div>
            @endforelse
        </div>
    </div>
</div>

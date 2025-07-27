<div class="mb-8">
    <form wire:submit.prevent>
        <div class="flex flex-wrap items-end gap-6 mb-4">
            <div>
                <span class="block font-bold text-softgreen-500 mb-2">Tallas</span>
                @foreach($tallasDisponibles as $talla)
                    <label class="inline-flex items-center mr-3 mb-1">
                        <input type="checkbox" wire:model="tallas" value="{{ $talla }}" class="accent-softgreen-500 mr-1">
                        <span class="text-white text-sm">{{ $talla }}</span>
                    </label>
                @endforeach
            </div>
            <div>
                <span class="block font-bold text-softgreen-500 mb-2">Categorías</span>
                @foreach($categoriasDisponibles as $categoria)
                    <label class="inline-flex items-center mr-3 mb-1">
                        <input type="checkbox" wire:model="categorias" value="{{ $categoria }}" class="accent-softgreen-500 mr-1">
                        <span class="text-white text-sm">{{ $categoria }}</span>
                    </label>
                @endforeach
            </div>
            <div>
                <span class="block font-bold text-softgreen-500 mb-2">Precio</span>
                <label class="inline-flex items-center mr-2">
                    <input type="radio" wire:model="precio_orden" value="asc" class="accent-softgreen-500 mr-1">
                    <span class="text-white text-sm">Menor a mayor</span>
                </label>
                <label class="inline-flex items-center">
                    <input type="radio" wire:model="precio_orden" value="desc" class="accent-softgreen-500 mr-1">
                    <span class="text-white text-sm">Mayor a menor</span>
                </label>
            </div>
            <div class="ml-auto">
                <input type="text" wire:model.debounce.500ms="buscar" placeholder="Buscar producto..." class="w-48 px-3 py-2 rounded bg-gray-800 text-white border border-softgreen-500 focus:outline-none focus:ring-2 focus:ring-softgreen-500" />
            </div>
        </div>
    </form>
</div>

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

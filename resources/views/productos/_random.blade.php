@if($randomProductos->count())
<div class="w-full mt-6">
    <div class="max-w-screen-xl mx-auto">
    <h2 class="text-2xl font-bold mb-6 text-softgreen-100 text-center">También te puede interesar</h2>
<div class="productos-grid">
        @foreach($randomProductos as $producto)
            <x-product-card :producto="$producto" />
        @endforeach
    </div>
    </div>
</div>
@endif

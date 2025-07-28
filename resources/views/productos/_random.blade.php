@if($randomProductos->count())
<div class="w-full mt-6">
<div class="w-full max-w-7xl mx-auto px-2 md:px-8 pt-12 pb-8 text-center flex flex-col items-center">
    <div class="max-w-screen-xl mx-auto">
    <h2 class="text-2xl font-bold mb-6 text-softgreen-100 text-center">También te puede interesar</h2>
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
        @foreach($randomProductos as $producto)
            <x-product-card :producto="$producto" />
        @endforeach
    </div>
    </div>
</div>
@endif

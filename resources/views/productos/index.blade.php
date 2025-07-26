@extends('layouts.app')

@section('content')
<div class="w-full max-w-7xl mx-auto px-2 md:px-8 pt-2 pb-8 text-center flex flex-col items-center">
    <h1 class="text-5xl md:text-6xl font-black mb-7 text-white tracking-tight leading-tight" style="font-family: 'Rajdhani', sans-serif; letter-spacing: 0.03em;">Productos</h1>
    <div class="w-full mb-8">
        @livewire('filtro-talla')
    </div>
</div>
@endsection

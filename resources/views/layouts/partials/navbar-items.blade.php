{{-- Enlaces principales del navbar que se usan tanto en móvil como en escritorio --}}
<li><a href="{{ url('/') }}" class="text-white hover:text-white transition px-4 py-2 text-xl font-semibold uppercase tracking-wide bg-transparent border-none focus:outline-none">Inicio</a></li>
<li><a href="{{ url('/productos') }}" class="text-white hover:text-white transition px-4 py-2 text-xl font-semibold uppercase tracking-wide bg-transparent border-none focus:outline-none">Productos</a></li>

{{-- Sección solo visible para el admin --}}
@auth
    @if(auth()->user() && auth()->user()->name === '4zlo')
        <li><a href="{{ route('dashboard') }}" class="text-white hover:text-white transition px-4 py-2 text-xl font-semibold uppercase tracking-wide bg-transparent border-none focus:outline-none">Nuevo producto</a></li>
        <li><a href="{{ route('admin.productos.panel') }}" class="text-white hover:text-white transition px-4 py-2 text-xl font-semibold uppercase tracking-wide bg-transparent border-none focus:outline-none">Editar productos</a></li>
    @endif
    <li>
        <form method="POST" action="{{ route('logout') }}" class="inline">
            @csrf
            <button type="submit" class="text-white hover:text-white transition px-4 py-2 text-xl font-semibold uppercase tracking-wide bg-transparent border-none focus:outline-none">Cerrar sesión</button>
        </form>
    </li>
@endauth

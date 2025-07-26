@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Paginación" class="inline-flex rounded-lg overflow-hidden shadow border border-green-900 bg-black/90">
        <ul class="flex text-base items-stretch divide-x divide-green-900">
            {{-- link para la pagina previa --}}
            @if ($paginator->onFirstPage())
                <li class="w-12 h-12 flex items-center justify-center text-green-900 cursor-not-allowed select-none">&laquo;</li>
            @else
                <li>
                    <a href="{{ $paginator->previousPageUrl() }}" class="w-12 h-12 flex items-center justify-center text-green-400 hover:text-black hover:bg-green-400 transition font-bold">&laquo;</a>
                </li>
            @endif

            {{-- paginacion de elemetos --}}
            @foreach ($elements as $element)
                @if (is_string($element))
                    <li class="w-12 h-12 flex items-center justify-center text-green-900 select-none">{{ $element }}</li>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="w-12 h-12 flex items-center justify-center bg-green-500 text-black font-bold select-none">{{ $page }}</li>
                        @else
                            <li>
                                <a href="{{ $url }}" class="w-12 h-12 flex items-center justify-center text-green-400 hover:text-black hover:bg-green-400 transition font-bold">{{ $page }}</a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- link de la pagina siguiente --}}
            @if ($paginator->hasMorePages())
                <li>
                    <a href="{{ $paginator->nextPageUrl() }}" class="w-12 h-12 flex items-center justify-center text-green-400 hover:text-black hover:bg-green-400 transition font-bold">&raquo;</a>
                </li>
            @else
                <li class="w-12 h-12 flex items-center justify-center text-green-900 cursor-not-allowed select-none">&raquo;</li>
            @endif
        </ul>
    </nav>
@endif

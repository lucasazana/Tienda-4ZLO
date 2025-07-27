@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Paginación" class="inline-flex rounded-2xl overflow-hidden shadow-lg border border-softgreen-700 bg-black/90 mt-8">
        <ul class="flex text-base items-stretch divide-x divide-softgreen-700">
            {{-- link para la pagina previa --}}
            @if ($paginator->onFirstPage())
                <li class="w-12 h-12 flex items-center justify-center text-softgreen-700 cursor-not-allowed select-none">&laquo;</li>
            @else
                <li>
                    <a href="{{ $paginator->previousPageUrl() }}" class="w-12 h-12 flex items-center justify-center text-softgreen-400 hover:text-black hover:bg-softgreen-500 transition font-bold">&laquo;</a>
                </li>
            @endif

            {{-- paginacion de elemetos --}}
            @foreach ($elements as $element)
                @if (is_string($element))
                    <li class="w-12 h-12 flex items-center justify-center text-softgreen-700 select-none">{{ $element }}</li>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="w-12 h-12 flex items-center justify-center bg-softgreen-500 text-black font-extrabold select-none border border-softgreen-700">{{ $page }}</li>
                        @else
                            <li>
                                <a href="{{ $url }}" class="w-12 h-12 flex items-center justify-center text-softgreen-400 hover:text-black hover:bg-softgreen-500 transition font-bold">{{ $page }}</a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- link de la pagina siguiente --}}
            @if ($paginator->hasMorePages())
                <li>
                    <a href="{{ $paginator->nextPageUrl() }}" class="w-12 h-12 flex items-center justify-center text-softgreen-400 hover:text-black hover:bg-softgreen-500 transition font-bold">&raquo;</a>
                </li>
            @else
                <li class="w-12 h-12 flex items-center justify-center text-softgreen-700 cursor-not-allowed select-none">&raquo;</li>
            @endif
        </ul>
    </nav>
@endif

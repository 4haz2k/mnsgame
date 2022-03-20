@if ($paginator->hasPages())
    <nav role="navigation" aria-label="{{ __('Pagination Navigation') }}" class="flex items-center justify-center lg:justify-between mt-12 mb-4">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <span class="items-center font-medium hidden text-gray-500 lg:inline">
                <svg class="mt-px mr-2 h-3 w-3 shrink-0 inline" viewBox="0 0 12 12" xmlns="http://www.w3.org/2000/svg"> <path class="fill-current" d="M5.091 11L0 5.909 5.091.818l.875.875-3.602 3.591h9.329v1.25H2.364l3.602 3.602z"></path> </svg>
                <span class="align-middle">Назад</span>
            </span>
        @else
            <a class="items-center font-medium hidden text-gray-500 lg:inline" href="{{ $paginator->previousPageUrl() }}">
                <svg class="mt-px mr-2 h-3 w-3 shrink-0 inline" viewBox="0 0 12 12" xmlns="http://www.w3.org/2000/svg"> <path class="fill-current" d="M5.091 11L0 5.909 5.091.818l.875.875-3.602 3.591h9.329v1.25H2.364l3.602 3.602z"></path> </svg>
                <span class="align-middle">Назад</span>
            </a>
        @endif

        {{-- Pagination Elements --}}
        <ul class="flex">
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="mx-1">
                        <span class="inline px-1 text-gray-500 transition">{{ $element }}</span>
                    </li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="mx-1">
                                <span class="inline border-b border-indigo-500 px-1 text-indigo-500 transition">{{ $page }}</span>
                            </li>
                        @else
                            <li class="mx-1">
                                <a href="{{ $url }}" class="inline px-1 text-gray-500 transition">{{ $page }}</a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach
        </ul>

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" class="items-center font-medium hidden text-gray-500 lg:inline">
                <span>Вперед</span>
                <svg class="mt-px ml-2 h-3 w-3 shrink-0 inline" viewBox="0 0 12 12" xmlns="http://www.w3.org/2000/svg"> <path class="fill-current" d="M6.602 11l-.875-.864L9.33 6.534H0v-1.25h9.33L5.727 1.693l.875-.875 5.091 5.091z"></path> </svg>
            </a>
        @else
            <span class="items-center font-medium hidden text-gray-500 lg:inline">
                <span>Вперед</span>
                <svg class="mt-px ml-2 h-3 w-3 shrink-0 inline" viewBox="0 0 12 12" xmlns="http://www.w3.org/2000/svg"> <path class="fill-current" d="M6.602 11l-.875-.864L9.33 6.534H0v-1.25h9.33L5.727 1.693l.875-.875 5.091 5.091z"></path> </svg>
            </span>
        @endif
    </nav>
@else
    <div class="mt-12 mb-4"></div>
@endif

@if ($paginator->hasPages())
    <div class="flex justify-center md:items-center gap-2 md:flex-row flex-col">
        <div class="flex items-center gap-4">
            @if (!$paginator->onFirstPage())
                {{-- First Page Link --}}
                <button wire:click="gotoPage(1)"
                    class="flex items-center gap-2 px-6 py-3 text-xs font-semibold text-center text-primary uppercase align-middle transition-all rounded-lg select-none hover:bg-gray-900/10 active:bg-gray-900/20 disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                    type="button" data-ripple-dark="true">
                    <span class="md:block ">
                        << </span>
                </button>

                @if ($paginator->currentPage() > 2)
                    {{-- Previous Page Link --}}
                    <button wire:click="previousPage"
                        class="flex items-center gap-2 px-6 py-3 text-xs font-semibold text-center text-primary uppercase align-middle transition-all rounded-lg select-none hover:bg-gray-900/10 active:bg-gray-900/20 disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                        type="button" data-ripple-dark="true">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                            stroke="currentColor" aria-hidden="true" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18"></path>
                        </svg>
                        <span class="md:block hidden">Previous</span>
                    </button>
                @endif
            @endif

            <!-- Pagination Elements -->
            @foreach ($elements as $element)
                <!-- Array Of Links -->
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        <!--  Use three dots when current page is greater than 3.  -->
                        @if ($paginator->currentPage() > 3 && $page === 2)
                            <div class="text-gray-900 mx-1">
                                <span class="font-medium">.</span>
                                <span class="font-medium">.</span>
                                <span class="font-medium">.</span>
                            </div>
                        @endif

                        <!--  Show active page two pages before and after it.  -->
                        @if ($page == $paginator->currentPage())
                            <button
                                class="relative h-10 max-h-[40px] w-10 max-w-[40px] select-none rounded-lg bg-primary text-center align-middle text-xs font-medium uppercase text-black shadow-md shadow-gray-900/10 transition-all hover:shadow-lg hover:shadow-gray-900/20 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                                type="button" data-ripple-dark="true">
                                <span class="absolute transform -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2">
                                    {{ $page }}
                                </span>
                            </button>
                        @elseif (
                            $page === $paginator->currentPage() + 1 ||
                                $page === $paginator->currentPage() + 2 ||
                                $page === $paginator->currentPage() - 1 ||
                                $page === $paginator->currentPage() - 2)
                            <button wire:click="gotoPage({{ $page }})"
                                class="relative h-10 max-h-[40px] w-10 max-w-[40px] select-none rounded-lg text-center align-middle text-xs font-medium uppercase text-gray-900 transition-all hover:bg-gray-900/10 active:bg-gray-900/20 disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                                type="button" data-ripple-dark="true">
                                <span class="absolute transform -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2">
                                    {{ $page }}
                                </span>
                            </button>
                        @endif

                        <!--  Use three dots when current page is away from end.  -->
                        @if ($paginator->currentPage() < $paginator->lastPage() - 2 && $page === $paginator->lastPage() - 1)
                            <div class="text-blue-800 mx-1">
                                <span class="font-bold">.</span>
                                <span class="font-bold">.</span>
                                <span class="font-bold">.</span>
                            </div>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                @if ($paginator->lastPage() - $paginator->currentPage() >= 2)
                    <button wire:click="nextPage"
                        class="flex items-center gap-2 px-6 py-3 text-xs font-semibold text-center text-primary uppercase align-middle transition-all rounded-lg select-none hover:bg-gray-900/10 active:bg-gray-900/20 disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                        type="button" data-ripple-dark="true">
                        <span class="md:block hidden">Next</span>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                            stroke="currentColor" aria-hidden="true" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"></path>
                        </svg>
                    </button>
                @endif

                <button wire:click="gotoPage({{ $paginator->lastPage() }})"
                    class="flex items-center gap-2 px-6 py-3 text-xs font-semibold text-center text-primary uppercase align-middle transition-all rounded-lg select-none hover:bg-gray-900/10 active:bg-gray-900/20 disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                    type="button" data-ripple-dark="true">
                    <span class="md:block ">>></span>
                    
                </button>
            @endif
        </div>
    </div>
    <p class="text-end">{{ $paginator->firstItem() }}-{{ $paginator->lastItem() }} of {{ $paginator->total() }} results</p>
@endif

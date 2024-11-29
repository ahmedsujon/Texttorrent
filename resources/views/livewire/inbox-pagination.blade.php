@if ($paginator->hasPages())
    <div class="pagination_area inbox_pagination_area">
        <ul class="number_list d-flex align-items-center justify-content-center flex-wrap">
            @if ($paginator->onFirstPage())
                <li class="disabled">
                    <button type="button">
                        <img src="{{ asset('assets/app/icons/double_arrow_left.svg') }}" alt="Previous">
                    </button>
                </li>
            @else
                <li>
                    <button type="button" wire:click="previousPage">
                        <img src="{{ asset('assets/app/icons/double_arrow_left.svg') }}" alt="Previous">
                    </button>
                </li>
            @endif

            @foreach ($elements as $element)
                @if (is_string($element))
                    <li><a href="javascript:void()" class="pagination_active">{{ $element }}</a></li>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($paginator->currentPage() > 3 && $paginator->currentPage() < 8 && $page == 2)
                            <li><a href="javascript:void()" class="pagination_active">...</a></li>
                        @endif

                        @if ($page == $paginator->currentPage())
                            <li wire:key="paginator-page-{{ $page }}">
                                <a href="javascript:void()" class="pagination_active">{{ $page }}</a>
                            </li>
                        @elseif (
                            $page === $paginator->currentPage() + 1 ||
                                $page === $paginator->currentPage() - 1 ||
                                $page === $paginator->lastPage() ||
                                $page === 1)
                            <li wire:key="paginator-page-{{ $page }}">
                                <a href="javascript:void()"
                                    wire:click.prevent="gotoPage({{ $page }})">{{ $page }}</a>
                            </li>
                        @endif

                        @if ($paginator->currentPage() <= $paginator->lastPage() - 3 && $paginator->currentPage() > $paginator->lastPage() - 7 && $page === $paginator->lastPage() - 1)
                            <li><a href="javascript:void()" class="pagination_active">...</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li>
                    <button type="button" wire:click="nextPage">
                        <img src="{{ asset('assets/app/icons/double_arrow_right.svg') }}" alt="Next">
                    </button>
                </li>
            @else
                <li class="disabled">
                    <button type="button">
                        <img src="{{ asset('assets/app/icons/double_arrow_right.svg') }}" alt="Next">
                    </button>
                </li>
            @endif
        </ul>
    </div>
@endif

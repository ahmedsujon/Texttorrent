@if ($paginator->hasPages())
<style>
    .pagination_active {
        padding-left: 0px !important;
        padding-right: 0px !important;
    }
</style>
<ul class="number_list d-flex align-items-center justify-content-center flex-wrap">
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
                    $page === $paginator->lastPage()-2 || $page === $paginator->lastPage() ||
                    $page === 1)
                    <li wire:key="paginator-page-{{ $page }}">
                        <a href="javascript:void()" wire:click.prevent="gotoPage({{ $page }})">{{ $page }}</a>
                    </li>
                @endif

                @if ($paginator->currentPage() > $paginator->lastPage() - 7 && $page === $paginator->lastPage() - 1)
                    <li><a href="javascript:void()" class="pagination_active">...</a></li>
                @endif
            @endforeach
        @endif
    @endforeach
</ul>

<div class="pagination_action_list d-flex align-items-center justify-content-end flex-wrap g-sm">
    @if ($paginator->onFirstPage())
        <a href="javascript:void()">
            <img src="{{ asset('assets/app/icons/back-arrow-black.svg') }}" alt="back arrow" />
            <span>Previous</span>
        </a>
    @else
        <a href="javascript:void()" wire:click.prevent="previousPage">
            <img src="{{ asset('assets/app/icons/back-arrow-black.svg') }}" alt="back arrow" />
            <span>Previous</span>
        </a>
    @endif

    @if ($paginator->hasMorePages())
        <a href="javascript:void()" wire:click.prevent="nextPage">
            <span>Next</span>
            <img src="{{ asset('assets/app/icons/right-arrow-black.svg') }}" alt="right arrow" />
        </a>
    @else
        <a href="javascript:void()">
            <span>Next</span>
            <img src="{{ asset('assets/app/icons/right-arrow-black.svg') }}" alt="right arrow" />
        </a>
    @endif
</div>
@endif

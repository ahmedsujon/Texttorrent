<style>
    .pagination {
        display: flex;
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .pagination .page-item {
        margin: 0 5px;
    }

    .pagination .page-link {
        border: 1px solid #dee2e6;
        padding: 6px 12px;
        text-decoration: none;
        color: #007bff;
        background-color: #fff;
        border-radius: 4px;
        cursor: pointer;
    }

    .pagination .page-item.active .page-link {
        background-color: #007bff;
        color: #fff;
        border-color: #007bff;
    }

    .pagination .page-item.disabled .page-link {
        color: #6c757d;
        pointer-events: none;
        background-color: #f8f9fa;
        border-color: #dee2e6;
    }
</style>

@if ($paginator->hasPages())
    <nav aria-label="Pagination Navigation" class="d-flex justify-content-center">
        <ul class="pagination">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="page-item disabled" aria-disabled="true">
                    <span class="page-link">&lt;</span>
                </li>
            @else
                <li class="page-item">
                    <button type="button" wire:click="previousPage" class="page-link" rel="prev">&lt;</button>
                </li>
            @endif

            {{-- First Page Link --}}
            <li class="page-item {{ $paginator->currentPage() == 1 ? 'active' : '' }}">
                <button type="button" wire:click="gotoPage(1)" class="page-link">1</button>
            </li>

            {{-- Dots Before Current Page --}}
            @if ($paginator->currentPage() > 3)
                <li class="page-item disabled" aria-disabled="true">
                    <span class="page-link">...</span>
                </li>
            @endif

            {{-- Current Page --}}
            @if ($paginator->currentPage() > 1 && $paginator->currentPage() < $paginator->lastPage())
                <li class="page-item active" aria-current="page">
                    <span class="page-link">{{ $paginator->currentPage() }}</span>
                </li>
            @endif

            {{-- Dots After Current Page --}}
            @if ($paginator->currentPage() < $paginator->lastPage() - 2)
                <li class="page-item disabled" aria-disabled="true">
                    <span class="page-link">...</span>
                </li>
            @endif

            {{-- Last Page Link --}}
            @if ($paginator->lastPage() > 1)
                <li class="page-item {{ $paginator->currentPage() == $paginator->lastPage() ? 'active' : '' }}">
                    <button type="button" wire:click="gotoPage({{ $paginator->lastPage() }})" class="page-link">
                        {{ $paginator->lastPage() }}
                    </button>
                </li>
            @endif

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <button type="button" wire:click="nextPage" class="page-link" rel="next">&gt;</button>
                </li>
            @else
                <li class="page-item disabled" aria-disabled="true">
                    <span class="page-link">&gt;</span>
                </li>
            @endif
        </ul>
    </nav>
@endif

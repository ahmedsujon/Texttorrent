<th class="align-middle" wire:click.live="setSortBy('{{ $id }}')">
    {{ $thDisplayName }}
    @if ($sortBy !== $id)
        <svg style="float:right" width="15" float="right"
            height="15" viewBox="0 0 24 24" fill="none"
            xmlns="http://www.w3.org/2000/svg">
            <path d="M6 16L12 22L18 16" stroke="#969696" stroke-width="2"
                stroke-linecap="round" stroke-linejoin="round" />
            <path d="M18 8L12 2L6 8" stroke="#969696" stroke-width="2"
                stroke-linecap="round" stroke-linejoin="round" />
        </svg>
    @elseif($sortDirection === 'ASC')
        <svg style="float:right" width="15" height="15"
            viewBox="0 0 24 24" fill="none"
            xmlns="http://www.w3.org/2000/svg">
            <path d="M6 16L12 22L18 16" stroke="black" stroke-width="2"
                stroke-linecap="round" stroke-linejoin="round" />
            <path d="M18 8L12 2L6 8" stroke="#969696" stroke-width="2"
                stroke-linecap="round" stroke-linejoin="round" />
        </svg>
    @else
        <svg style="float:right" width="15" height="15"
            viewBox="0 0 24 24" fill="none"
            xmlns="http://www.w3.org/2000/svg">
            <path d="M6 16L12 22L18 16" stroke="#969696" stroke-width="2"
                stroke-linecap="round" stroke-linejoin="round" />
            <path d="M18 8L12 2L6 8" stroke="black" stroke-width="2"
                stroke-linecap="round" stroke-linejoin="round" />
        </svg>
    @endif
</th>

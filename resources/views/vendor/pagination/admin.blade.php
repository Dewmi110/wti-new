@if ($paginator->hasPages())
<nav class="wti-pagination" aria-label="Pagination">
    @if ($paginator->onFirstPage())
        <span class="btn btn-outline btn-sm disabled"><i class="fas fa-chevron-left"></i></span>
    @else
        <a href="{{ $paginator->previousPageUrl() }}" class="btn btn-outline btn-sm"><i class="fas fa-chevron-left"></i></a>
    @endif

    <span class="pagination-pages">
        @foreach ($elements as $element)
            @if (is_string($element))
                <span class="pagination-dots">{{ $element }}</span>
            @endif

            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span class="pagination-page active">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}" class="pagination-page">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach
    </span>

    @if ($paginator->hasMorePages())
        <a href="{{ $paginator->nextPageUrl() }}" class="btn btn-outline btn-sm"><i class="fas fa-chevron-right"></i></a>
    @else
        <span class="btn btn-outline btn-sm disabled"><i class="fas fa-chevron-right"></i></span>
    @endif
</nav>
@endif
<style>
    .pagination-dark .page-link {
        background-color: #f9f9f9; /* Dark background */
        color: #fff; /* White text */
        border: 1px solid #444; /* Border for buttons */
    }

    .pagination-dark .page-item.active .page-link {
        color: #444;
    }
    .pagination-dark .page-item.active .page-link {
        background-color: #ffffff; /* Active page background */
        border-color: #000; /* Active page border */
        color: #000;
    }

    .pagination-dark .page-link:hover {
        background-color: #000000; /* Hover state */
    }

    .pagination-dark .page-item.disabled .page-link {
        background-color: #ffffff; /* Disabled state background */
        border-color: #fbfbfb; /* Disabled state border */
    }
</style>










@if ($paginator->hasPages())
    <ul class="pagination justify-content-center pagination-dark">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li class="page-item disabled"><span class="page-link">Previous</span></li>
        @else
            <li class="page-item"><a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev">Previous</a></li>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <li class="page-item disabled"><span class="page-link">{{ $element }}</span></li>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="page-item active"><span class="page-link">{{ $page }}</span></li>
                    @else
                        <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li class="page-item"><a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next">Next</a></li>
        @else
            <li class="page-item disabled"><span class="page-link">Next</span></li>
        @endif
    </ul>
@endif

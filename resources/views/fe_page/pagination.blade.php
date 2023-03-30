
@if ($paginator->hasPages())
<div class="pagination_fg">
    @if ($paginator->onFirstPage())
    <a>«</a>
    @else
    <a href="{{ $paginator->previousPageUrl() }}">«</a>
    @endif

    @foreach ($elements as $element)

        @if (is_string($element))
            <a class="disabled"><span>{{ $element }}</span></a>
        @endif
        @if (is_array($element))
            @foreach ($element as $page => $url)
                @if ($page == $paginator->currentPage())
                    <a class="active">{{ $page }}</a>
                @else
                    <a href="{{ $url }}">{{ $page }}</a>
                @endif
            @endforeach
        @endif
    @endforeach

    @if ($paginator->hasMorePages())
        <a href="{{ $paginator->nextPageUrl() }}">»</a>
    @else
        <a>»</a>
    @endif
</div>
@endif

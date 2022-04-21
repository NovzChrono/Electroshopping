@if ($paginator -> hasPages())
    <ul class="pagination">
        @if ($paginator -> onFirstPage())
            <li class="page-item disabled"><a class="page-link" style="color: rgb(175, 175, 175)"><span>&laquo;</span></a></li>
        @else
            <li class="page-item"><a class="page-link" style="color: black" href="{{ $paginator->previousPageUrl() }}"><span>&laquo;</span></a></li>
        @endif

        @foreach ($elements as $element)
            
            @if (is_string($element))
                <li class="page-item disabled"><a class="page-link" style="color: rgb(0, 0, 0)"><span>{{ $element }}</span></a></li>
            @endif

            @if (is_array($element))
                @foreach ($element as $page=>$url)
                    @if ($page == $paginator -> currentPage())
                        <li class="page-item active"><a class="page-link border-warning text-warning bg-white"  style="color: black"><span>{{ $page }}</span></a></li>
                    @else
                        <li class="page-item"><a class="page-link" style="color: black" href="{{ $url }}"><span>{{ $page }}</span></a></li>
                    @endif
                @endforeach
            @endif

        @endforeach

        @if ($paginator -> hasMorePages())
            <li class="page-item"><a class="page-link" style="color: black" href="{{ $paginator->NextPageUrl() }}"><span>&raquo;</span></a></li>
        @else
            <li class="page-item disabled"><a class="page-link" style="color: rgb(175, 175, 175)"><span>&raquo;</span></a></li>
        @endif
    </ul>
@endif
@if ($paginator->hasPages())
    <nav aria-label="Page navigation" class="pagination-main">
        <ul class="pagination">

            <li class="page-item arrow-item double-arrow">
                <a class="page-link" href="{{ $paginator->previousPageUrl() }}">
                    <i class="fa-chevron-right fas"></i>
                    <i class="fa-chevron-right fas"></i>
                </a>
            </li>

            <li class="page-item arrow-item"><a class="page-link" href="{{ $paginator->previousPageUrl() }}">
                    <i class="fa-chevron-right fas"></i></a>
            </li>
            <div class="page-number-box">
                {{-- Pagination Elements --}}
                @foreach ($elements as $element)
                    {{-- "Three Dots" Separator --}}
                    @if (is_string($element))
                        <li class="page-item"><a class="page-link" href="javascript:void(0)">{{ $element }}</a></li>
                    @endif
                    {{-- Array Of Links --}}
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <li class="page-item active"><a class="page-link" href="javascript:void(0)">{{ $page }}</a></li>
                            @else
                                <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                            @endif
                        @endforeach
                    @endif
                @endforeach
            </div>

            <li class="page-item arrow-item"><a class="page-link" href="{{ $paginator->nextPageUrl() }}">
                    <i class="fa-chevron-left fas"></i></a>
            </li>
            <li class="page-item arrow-item double-arrow">
                <a class="page-link" href="{{ $paginator->nextPageUrl() }}">
                    <i class="fa-chevron-left fas"></i>
                    <i class="fa-chevron-left fas"></i>
                </a>
            </li>
        </ul>
    </nav>
@endif

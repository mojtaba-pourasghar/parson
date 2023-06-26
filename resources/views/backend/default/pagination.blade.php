@if ($paginator->hasPages())
    <div class="dataTables_paginate paging_simple_numbers "
         id="DataTables_Table_0_paginate">
        <ul class="pagination ">
            @if ($paginator->onFirstPage())
            <li class="paginate_button previous disabled " aria-controls="DataTables_Table_0" tabindex="0" id="DataTables_Table_0_previous">
                <a > @lang('message.previous')</a>
            </li>
            @else
                <li class="paginate_button previous " aria-controls="DataTables_Table_0" tabindex="0" id="DataTables_Table_0_previous">
                <a href="{{ $paginator->previousPageUrl() }}"> @lang('message.previous')</a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="paginate_button " aria-controls="DataTables_Table_0" tabindex="0">
                        <span>{{ $element }}</span>
                    </li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="paginate_button  active" aria-controls="DataTables_Table_0" tabindex="0">
                                <a >{{ $page }}</a>
                            </li>
                        @else
                            <li class="paginate_button " aria-controls="DataTables_Table_0" tabindex="0">
                                <a href="{{ $url }}">{{ $page }}</a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach
            @if ($paginator->hasMorePages())
            <li class="paginate_button next " aria-controls="DataTables_Table_0" tabindex="0" id="DataTables_Table_0_next">
                <a href="{{ $paginator->nextPageUrl() }}">@lang('message.next')</a>
            </li>
            @else
                <li class="paginate_button next disabled" aria-controls="DataTables_Table_0" tabindex="0" id="DataTables_Table_0_next">
                    <a >@lang('message.next')</a>
                </li>
            @endif
        </ul>
    </div>

@endif

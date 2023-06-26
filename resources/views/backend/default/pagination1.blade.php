<div class="dataTables_paginate paging_simple_numbers "
     id="DataTables_Table_0_paginate">
    <ul class="pagination ">
        <li class="paginate_button previous {{ ($paginator->currentPage() == 1) ? ' disabled' : '' }}" aria-controls="DataTables_Table_0" tabindex="0" id="DataTables_Table_0_previous"><a href="{{ $paginator->url(1) }}"> @lang('message.previous')</a></li>
        @for ($i = 1; $i <= $paginator->lastPage(); $i++)
            <li class="paginate_button {{ ($paginator->currentPage() == $i) ? ' active' : '' }}" aria-controls="DataTables_Table_0"tabindex="0"><a href="{{ $paginator->url($i) }}">{{ $i }}</a></li>
        @endfor
        <li class="paginate_button next {{ ($paginator->currentPage() == $paginator->lastPage()) ? ' disabled' : '' }}" aria-controls="DataTables_Table_0" tabindex="0" id="DataTables_Table_0_next"><a href="{{ $paginator->url($paginator->currentPage()+1) }}">@lang('message.next')</a></li>
    </ul>
</div>

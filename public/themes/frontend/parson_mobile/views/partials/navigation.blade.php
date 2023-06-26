@foreach($pages as $page)

    <li class="{{ Request::is($page->present()->uriWildcard) ? 'active' : '' }} {{ count($page->children) ? ((count($page->children) > 0) ? 'nav-item dropdown' : 'nav-item') : '' }}  ">

        <a href="{{ url($page->slug) }}" class="nav-link">

            {{ $page->title }}
            @if(count($page->children))
                <span class="caret  {{ (count($page->children) > 0) ? 'right' : '' }}"></span>
            @endif
        </a>
        @if(count($page->children))
            <ul class="dropdoen-menu">
                @include('partials.navigation',['pages'=>$page->children])
            </ul>
        @endif
    </li>
@endforeach

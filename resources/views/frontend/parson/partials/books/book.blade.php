<div class="library-carousel-item">
    <div class="book-image-box">
        <a href="{{ getBookLink($book->id,$book->slug) }}"><img src="{{  getBookImagePath($book->thumbnail) }}" alt="{{ $book->title }}"></a>
    </div>
    <div class="book-info-box">
        <h2 class="book-title"><a href="{{ getBookLink($book->id,$book->slug) }}">{{ $book->title }}</a></h2>
        <h2 class="book-writer"><span style="font-size: 13px">
                @lang('person.writer'): {{ !empty($book->persons[0]->title) ? $book->persons[0]->title : '' }}</span>
        </h2>
        <div class="similar-book-star">
            @for($i=1;$i<=5;$i++)
                @if ($i<=$book->rate)
                    <span class="book-star-icon-orange"><i class="fas fa-star "></i></span>
                @else
                    <span class="book-star-icon-defualt"><i class="fas fa-star "></i></span>
                @endif
            @endfor
        </div>
        @if (Auth::check())
            <div class="study-box">
                @php
                    $bookshelfstatus =  getReadBookStatus($book->id);
                @endphp

                <button
                    onclick="popUp('studyModal', '{{ route('shelve.modal',$book->id) }}');"
                    id="btn_showstudy_{{ $book->id }}"
                    class="btn
                 @switch($bookshelfstatus)
                    @case(1)
                        book-want-study
                        @break
                    @case(2)
                        book-study
                        @break
                    @case(3)
                        book-studing
                        @break
                    @default
                        btn-danger book-study-default
                 @endswitch
                        more-button btn_showstudy" data-whatever="{{ $book->title }}">
                    <span class="more-button-text" id="self_status_{{ $book->id }}">
                        @switch($bookshelfstatus)
                            @case(1)
                            @lang('book.i_want_to_read')
                            @break
                            @case(2)
                            @lang('book.i_study')
                            @break
                            @case(3)
                            @lang('book.i_studing')
                            @break
                            @default
                            @lang('book.i_want_to_read')
                        @endswitch
                    </span>
                    <span class="more-button-icon"><i class="fa-chevron-down fas"></i></span>
                </button>
            </div>
        @else
            <div class="study-box">
                <a class="btn btn-danger more-button"  href="{{ route('login') }}">
                    <span class="more-button-text">  @lang('book.i_want_to_read')</span>
                    <span class="more-button-icon">
                              <i class="fa-chevron-down fas"></i>
                            </span>
                </a>
            </div>
        @endif
    </div>
</div>



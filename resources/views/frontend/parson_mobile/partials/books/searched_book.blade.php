<!-- category books col  -->
<div class="category-books-col col-lg-6 col-md-8 col-6">
    <div class="books-col-image col-lg-4 col-md-4">
        <img src="{{  getBookImagePath($book->thumbnail) }}" alt="{{ $book->title }}">
    </div>
    <div class="book-info-box col-lg-8 col-md-8">
        <h2 class="book-title"><a href="{{ getBookLink($book->id,$book->slug) }}">{{ $book->title }}</a></h2>
        <h2 class="book-title">
            @foreach($book->persons as $person)
                @if(!empty($person->personRole))
                    @if($person->personRole->id == getConstant('person_role.writer'))
                        <a href="{{ route('book.view',[$book->id,$book->slug]) }}">
                            {{ $person->title  }}</a>
                    @endif
                @endif
            @endforeach
        </h2>
        <h2 class="book-title">
            @php $count=1 @endphp

            @foreach($book->organizations as $organization)
                @php $count++ @endphp
                <a href="{{ route('organization.view',[$organization->id,$organization->slug]) }}">{{ $organization->title }}</a>
                @if(count($book->organizations )==$count)
                    {{ '|' }}
                @endif
            @endforeach
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
        @endif

    </div>
    <!-- category books end -->
</div>
<!-- category books col  -->




@extends('layouts.frontend')
@section('title',$book->title)
@section('keywords','')
@section('description','')
@section('open_graph')
    <meta property='og:site_name' content='دکتر اينجاست'>
    <meta property='og:type' content='website'>
    <meta property='og:title' content='دکتر اينجاست'>
    <meta property='og:description' content='پزشک'>
    <meta property='og:image' content='http://localhost/drinjast/img/logo-menu-fix.png'>
    <meta property='og:image:alt' content='دکتر اينجاست'>
    <meta property='og:url' content='https://www.localhost/drinjast/'>
    <meta property='og:locale' content='fa_IR'>
    <meta name='twitter:title' content='دکتر اينجاست'>
    <meta name='twitter:description' content='پزشک'>
    <meta name='twitter:image' content='http://localhost/drinjast/img/logo-menu-fix.png'>
    <meta name='twitter:card' content='summary'>
    <meta name='twitter:site' content='@drinjast'>
    <meta property='twitter:creator' content='دکتر اينجاست'>
@endsection
@section('content')
    <link rel="stylesheet" href="{{ frontendTheme('css/light.min.css') }}">
    <link rel="stylesheet" href="{{ frontendTheme('js/rateyo/jquery.rateyo.min.css') }}">
    <link rel="stylesheet" href="{{ frontendTheme('js/custom-scroll/jquery-scrollbar.css') }}">

    <main>
        <section>
            <!-- book detail container -->
            <div
                class="container book-container justify-content-lg-start justify-content-md-end justify-content-center">
                <div class="col-lg-3 col-md-4 col-sm-8 col-10 book-column">
                    <div class="col-12 book-image-box"><img src="{{ getBookImagePath($book->thumbnail) }}"
                                                            alt="book-sleep-bed">
                    </div>
                    @if (Auth::check())

                        <div class="study-box">
                            <button class="btn
                            @switch($shelfStatus)
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
                                more-button btn_showstudy" id="btn_showstudy_{{ $book->id }}"
                                    onclick="popUp('studyModal', '{{ route('shelve.modal',$book->id) }}');"
                                    data-whatever="{{ $book->title }}">
                                <span class="more-button-text" id="self_status_{{ $book->id }}">
                                    @switch($shelfStatus)
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
                                <span class="more-button-icon">
                              <i class="fa-chevron-down fas"></i>
                          </span>
                            </button>
                        </div>
                    @else
                        <div class="study-box">
                            <a class="btn btn-danger more-button" href="{{ route('login') }}">
                                <span class="more-button-text">  @lang('book.i_want_to_read')</span>
                                <span class="more-button-icon">
                              <i class="fa-chevron-down fas"></i>
                            </span>
                            </a>
                        </div>
                    @endif
                </div>
                <div class="col-lg-6 col-md-8 col-12 book-description-column">
                    <div class="book-detail-box">
                        <div class="book-description col-12">
                            <div class="book-title-box col-lg-8 col-12">
                                <h1 class="book-title">{{ $book->title }}</h1>
                                <h3 class="book-sub_title">{{ $book->sub_title }}</h3>
                            </div>
                            <div class="book-rate-box col-lg-4 col-12">
                                <div class="rate-icon rating-icon">
                                    <img src="{{ frontendTheme('images/icon/star-empty.png') }}" alt="">
                                    <p class="r-empty-text">امتیاز بده</p>
                                </div>
                                <div class="rate-icon">
                                    <img src="{{ frontendTheme('images/icon/star-full.png') }}" alt="">
                                    <p class="r-full-rate-text"> {{ $rate }} - 5</p>
                                    <p class="r-full-count">{{ $rateCount }}</p>
                                </div>
                            </div>
                            <div class="book-title-box col-12">
                                <h1 class="book-title-english">
                                    {{ $book->original_title.' : '.$book->original_sub_title }}
                                </h1>
                            </div>
                        </div>
                        <div class="book-info-author col-12">
                            @foreach($book->persons as $key=>$person)
                                @if($key==2 )
                                    <div class="person-content"></div>
                                @endif
                                <div class="info-author-label">

                                    <h3 class="info-author-title">{{ !empty($person->personRoles[0]->title) ? $person->personRoles[0]->title : '' }}
                                        :</h3>
                                    <h3 class="info-author-name">

                                        @if(getConstant('person_role.writer')==$person->personRoles[0]->id)
                                            <a href="{{ route('writer.view',[$person->id,$person->slug]) }}">{{ $person->title }}</a>
                                        @else
                                            <a href="{{ route('translator.view',[$person->id,$person->slug]) }}">{{ $person->title }}</a>
                                        @endif

                                    </h3>

                                </div>
                                @if($key==count($book->persons))
                        </div>
                        @endif
                        @endforeach
                    </div>
                    <div class="book-summary-box col-12">
                        <h2 class="summary-title">@lang('book.description')</h2>
                        <div class="summary-content show-more-content">
                            {!! $book->present()->descriptionHtml  !!}
                        </div>
                        <span class="expand-bar">
                      <span class="expand-fade"></span>
                    </span>
                        <span class="expand-bar-icon">
                         <span href="" class="expand-icon show-more-content">
                        <i class="fa-chevron-down fas"></i>
                         </span>
                    </span>
                    </div>

                </div>
                <div class="book-label-box col-12">
                    <div class="info-label-top-row">
                        <div class="info-label-top-column col-md-6 col-12">
                            <div class="book-info-label">
                                <h3 class="info-h-title">@lang('book.organization'):</h3>
                                <h3 class="info-s-title">
                                    @php $counter = 1 @endphp
                                    @foreach($book->organizations as $organization)
                                        {{ $organization->title }}
                                        @if (count($book->organizations) != $counter)
                                            {{','}}
                                        @endif
                                        @php $counter++ @endphp
                                    @endforeach
                                </h3>
                            </div>
                            <div class="book-info-label">
                                <h3 class="info-h-title">@lang('book.pages'):</h3>
                                <h3 class="info-s-title">{{ $book->pages }} </h3>
                            </div>
                            <div class="book-info-label">
                                <h3 class="info-h-title">@lang('book.price'):</h3>
                                <h3 class="info-s-title">
                                    @foreach($book->prints as $print)
                                        {{ number_format($print->price) }}
                                        @break
                                    @endforeach

                                    ریال</h3>
                            </div>
                            <div class="book-info-label">
                                <h3 class="info-h-title">@lang('book.cover_size'):</h3>
                                <h3 class="info-s-title">
                                    @php $counter = 1 @endphp
                                    @foreach($book->cover_sizes as $cover_size)
                                        {{ $cover_size->title }}
                                        @if (count($book->cover_sizes) != $counter)
                                            {{','}}
                                        @endif
                                        @php $counter++ @endphp
                                    @endforeach
                                </h3>
                            </div>
                        </div>
                        <div class="info-label-top-column col-md-6 col-12">
                            <div class="book-info-label">
                                <h3 class="info-h-title">@lang('book.cover_type'):</h3>
                                <h3 class="info-s-title">
                                    @php $counter = 1 @endphp
                                    @foreach($book->cover_types as $cover_type)
                                        {{ $cover_type->title }}
                                        @if (count($book->cover_types) != $counter)
                                            {{','}}
                                        @endif
                                        @php $counter++ @endphp
                                    @endforeach
                                </h3>
                            </div>
                            <div class="book-info-label">
                                <h3 class="info-h-title">@lang('book.isbn'):</h3>
                                <h3 class="info-s-title">
                                    @php
                                        $isbns = explode(';',$book->isbn);
                                    foreach ($isbns as $isbn){
                                        echo removeFirstDash($isbn).'<br>';
                                    }
                                    @endphp
                                </h3>
                            </div>
                            <div class="book-info-label">
                                <h3 class="info-h-title">@lang('book.publish_date'):
                                </h3>
                                <h3 class="info-s-title">{{ $book->present()->publishDate }}</h3>
                            </div>
                            <div class="book-info-label">
                                <h3 class="info-h-title">@lang('book.category'):
                                </h3>
                                <h3 class="info-s-title">
                                    @php $counter = 1 @endphp
                                    @foreach($book->categories as $category)
                                        <a href="{{ route('category.view',[$category->id,$category->slug]) }}">{{ $category->title }}</a>
                                        @if (count($book->categories) != $counter)
                                            {{','}}
                                        @endif
                                        @php $counter++ @endphp
                                    @endforeach

                                </h3>
                            </div>
                        </div>
                    </div>
                    @if(!empty($book->extra_data))
                        <div class="info-label-bottom-row">
                            <div class="book-info-label col-md-8 col-12">
                                <h3 class="info-comment-title">@lang('book.extra_data')
                                </h3>
                                <p class="info-comment">
                                    {{ $book->extra_data }}
                                </p>
                            </div>
                        </div>
                    @endif
                </div>

            </div>
            <div class="col-lg-3 col-md-8 col-12 book-detail-column">
                <div class=" col-12">
                    @if (!empty($otherBook))
                        <div class="book-version-box">
                            <div class="version-book-text col-lg-10  col-12">
                                <a href="{{ route('book.view',[$otherBook->id,$otherBook->title]) }}">
                                    <h3 class="v-book-title">
                                        @lang('book.see_another_book_version')
                                    </h3>
                                    <span class="v-icon-box"><i class="fa-chevron-left fas"></i></span>
                                </a>
                            </div>
                        </div>
                    @endif
                    <div class="book-awards-main">
                        <!-- book awards heading -->
                        <div class="book-awards-heading">
                            <div class="awards-icon">
                                <img src="{{ frontendTheme('images/icon/quality.png')}}" alt="medal">
                            </div>
                            <h3 class="awards-title">جوایز</h3>
                        </div>
                        <!-- end book awards heading -->
                        <div class="book-awards-box col-12">
                            @if(count($book->awards))
                                @foreach ($book->awards as $award)
                                    <div class="book-awards-image">
                                        <img src="{{ getAwardImagePath($award->award->logo) }}"
                                             alt="{{ $award->award->title }}">
                                    </div>
                                @endforeach
                            @else
                                <div class="d-book-title">
                                    <h3 class="d-title">@lang('book.not_register_yet')</h3>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="book-type-container">
                    <div class="book-type-main">
                        <div class="book-type-box col-12">
                            <a class="col-6 book-type-column active" href="#e-book">
                                <span class="book-type-icon ebook-icon"></span>
                                <h3 class="book-type-title">کتاب الکترونیک</h3>
                            </a>
                            <a class="col-6 book-type-column " href="#audio-book">
                                <span class="book-type-icon audio-icon"></span>
                                <h3 class="book-type-title">کتاب صوتی</h3>
                            </a>
                        </div>
                        <!-- d book info box -->
                        <div class="d-book-info-box col-12" id="e-book">
                            <div class="d-book-info col-12">
                                <div class="d-book-icon">
                                    <img src="{{ frontendTheme('images/icon/microphone.png')}}" alt="microphone">
                                </div>
                                <div class="d-book-title-box">
                                    <div class="d-book-title">
                                        <h3 class="d-title">@lang('book.organization')</h3>
                                    </div>
                                    <div class="d-book-title">
                                        @if(count($book->audios) > 0)
                                            @foreach ($book->electronics as $electronic)
                                                <h3 class="d-title">
                                                    <a href="javascript:void(0);">{{ $electronic->organization->title }}</a>
                                                </h3>
                                            @endforeach
                                        @else
                                            <h3 class="d-title">
                                                @lang('book.not_register_yet')
                                            </h3>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-book-info-box col-12" id="audio-book">
                            <div class="d-book-info col-12">
                                <div class="d-book-icon">
                                    <img src="{{ frontendTheme('images/icon/microphone.png')}}" alt="microphone">
                                </div>
                                <div class="d-book-title-box">
                                    <div class="d-book-title">
                                        <h3 class="d-title">ناشر</h3>
                                    </div>
                                    <div class="d-book-title">
                                        @if(count($book->audios)>0)
                                            @foreach ($book->audios as $audio)
                                                <h3 class="d-title">
                                                    <a href="javascript:void(0);" class="audio"
                                                       audio_id="{{ $audio->id }}">{{ $audio->organization->title }}</a>
                                                </h3>
                                            @endforeach
                                        @else
                                            <h3 class="d-title">
                                                @lang('book.not_register_yet')
                                            </h3>
                                        @endif
                                    </div>
                                </div>

                            </div>
                            <div id="audio_book_detail">
                                @if(count($book->audios)==0)
                                    <div class="d-book-info col-12">
                                        <div class="d-book-icon">
                                            <img src="{{ frontendTheme('images/icon/avatar.png')}}"
                                                 alt="avatar">
                                        </div>
                                        <div class="d-book-title-box">
                                            <div class="d-book-title">
                                                <h3 class="d-title">گوینده</h3>
                                            </div>
                                            <div class="d-book-title">
                                                <h3 class="d-title">@lang('book.not_register_yet')</h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-book-info col-12">
                                        <div class="d-book-icon">
                                            <img src="{{ frontendTheme('images/icon/clock.png')}}" alt="clock">
                                        </div>
                                        <div class="d-book-title-box">
                                            <div class="d-book-title">
                                                <h3 class="d-title">مدت زمان</h3>
                                            </div>
                                            <div class="d-book-title">
                                                <h3 class="d-title">@lang('book.not_register_yet')</h3>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <!-- d book info box end -->
                    </div>
                </div>

            </div>
            </div>
            <!-- end book detail container -->

            <!-- book review container -->
            <div class="book-review-container container">
                <div class="book-review-sidebar col-lg-3 col-md-7 col-sm-8 col-10">
                    <div class="image-box">
                        <img src="{{ frontendTheme('images/filter-image.png')}}" alt="">
                    </div>
                    <div class="review-box">
                        <div class="review-title-box col-12">
                            <h3 class="review-title-text col-12">@lang('quotation.quotations')</h3>
                        </div>
                        <div class="review-carousel owl-carousel col-12">
                            @foreach ($book->quotations as $quotation)
                                <div class="review-carousel-slide col-12">
                                    <div class="carousel-slide-content">
                                        <p class="slide-content-text">
                                            {{ $quotation->description }}
                                        </p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <h3 class="review-more">
                            <a href="#">
                                <span class="more-icon fas fa-plus"></span>
                                بیشتر
                            </a>
                        </h3>
                    </div>
                    <!-- start about author -->
                    <div class="review-box">
                        <div class="review-about-heading col-12">
                            <h3 class="review-about-title">درباره نویسنده</h3>
                        </div>
                        <div class="review-author-box">
                            <div class="review-author-avatar">
                                <img src="{{ frontendTheme('images/icon/girl-avatar.png')}}" alt="girl-avatar">
                            </div>
                            <div class="review-author-header">
                                <h3 class="review-author-text">شهلا مجاهد</h3>
                            </div>
                            <div class="review-author-detail">
                                <div class="review-author-field">
                                    <h3 class="author-field-title">نویسنده، مترجم، نقاش، شاعر</h3>
                                </div>
                                <div class="review-author-info">
                                    <h3 class="review-info-text col-6">تولد 1369</h3>
                                    <h3 class="review-info-text col-6">وفات 1399</h3>
                                    <h3 class="review-info-text col-6">کشور: آمریکا</h3>
                                    <h3 class="review-info-text col-6">تعداد آثار: 50</h3>
                                </div>
                            </div>
                        </div>
                        <h3 class="review-more">
                            <a href="#">
                                <span class="more-icon fas fa-plus"></span>
                                بیشتر
                            </a>
                        </h3>
                    </div>

                </div>

                <div class="book-review-main col-lg-9 col-12">

                    <!-- book comment start -->
                    <div class="book-container col-12">
                        <div class="nav-tab">
                            <ul>
                                <li class="col-6"><a href="#naghd_tab" class="active">@lang('bookcomment.review')</a>
                                </li>
                                <li class="col-6"><a href="#question_tab">@lang('bookcomment.question')</a></li>
                            </ul>
                        </div>
                        <div class="book-comment-content" id="naghd_tab">
                            <!-- start naghd user box -->
                            @if (Auth::check())
                                {!! Form::model(null, ['route' => ['bookcomment.add',$book->id] ,'method' => 'post' ,'class' => 'col-12','id'=>'comment_form'] ) !!}
                                <input type="hidden" name="_token" id="comment_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="is_question" value="0">
                                <div class="naghd-review-text-box">
                                    <div class="form-group col-12">
                                            <textarea class="form-control review-comment" rows="8" id="comment"
                                                      placeholder="@lang('bookcomment.comment_holder')"
                                                      name="comment"></textarea>
                                        <input type="hidden" name="reply_to" class="reply_to" value="0">
                                    </div>
                                </div>
                                <div class="naghd-review-down-row col-12">
                                    <div class="col-8 naghd-review-down-column">
                                        <label class="study-check-main">
                                            <input type="checkbox" class="study-check-input" name="reveal_status">
                                            <span class="checkmark"></span>
                                            @lang('bookcomment.possibility_of_revealing_the_story')
                                        </label>
                                    </div>
                                    <div
                                        class="col-4 justify-content-md-end justify-content-end naghd-review-down-column review-down-btn">
                                        <button class="btn btn-danger" type="submit">@lang('message.send')</button>
                                    </div>
                                </div>
                                {!! Form::close() !!}
                            @else
                                <div class="alert-message warning-alert">
                                   <span class="alert-icon">
                                    <i class="fas fa-exclamation-triangle"></i>
                                   </span>
                                    <h3 class="alert-text col-10">
                                        برای ارسال نقد و بررسی و پاسخ به حساب کاربری خود <a href="{{ route('login') }}">وارد</a>
                                        شوید یا یک حساب <a href="{{ route('register') }}">ایجاد</a> کنید
                                    </h3>
                                </div>
                            @endif
                            <div id="comment_place"></div>
                        </div>
                        <div class="book-comment-content" id="question_tab">
                            <!-- start naghd user box -->
                            @if (Auth::check())
                                {!! Form::model(null, ['route' => ['bookcomment.add',$book->id] ,'method' => 'post' ,'class' => 'col-12','id'=>'question_form'] ) !!}
                                <input type="hidden" name="_token" id="question_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="is_question" value="1">
                                <div class="naghd-review-text-box">
                                    <div class="form-group col-12">
                                            <textarea class="form-control review-comment" rows="8" id="question"
                                                      placeholder="@lang('bookcomment.question_holder')"
                                                      name="comment"></textarea>
                                        <input type="hidden" name="reply_to" class="reply_to" value="0">
                                    </div>
                                </div>
                                <div class="naghd-review-down-row col-12">
                                    <div class="col-8 naghd-review-down-column">
                                        <label class="study-check-main">
                                            <input type="checkbox" class="study-check-input" name="reveal_status">
                                            <span class="checkmark"></span>
                                            @lang('bookcomment.possibility_of_revealing_the_story')
                                        </label>
                                    </div>
                                    <div
                                        class="col-4 justify-content-md-end justify-content-end naghd-review-down-column review-down-btn">
                                        <button class="btn btn-danger" type="submit">@lang('message.send')</button>
                                    </div>
                                </div>
                                {!! Form::close() !!}
                            @else
                                <div class="alert-message warning-alert">
                                   <span class="alert-icon">
                                    <i class="fas fa-exclamation-triangle"></i>
                                   </span>
                                    <h3 class="alert-text col-10">
                                        برای ارسال نقد و بررسی و پاسخ به حساب کاربری خود <a href="{{ route('login') }}">وارد</a>
                                        شوید یا یک حساب <a href="{{ route('register') }}">ایجاد</a> کنید
                                    </h3>
                                </div>
                            @endif
                            <div id="question_place"></div>
                            <!-- end naghd user box -->
                            <!-- pagination -->
                        </div>
                    </div>
                    <!-- book comment end -->
                </div>
            </div>
            <!-- end book review container -->
            <!-- book library carouse start -->
            <div class="kethab-library-container container">
                <div class="library-row col-12">
                    <div class="library-row-title col-12">
                        <h2 class="library-title">کتاب های مشابه</h2>
                        <h2 class="library-more">
                            <a href="#">
                                <span class="more-icon fas fa-plus"></span>
                                بیشتر

                            </a>
                        </h2>
                    </div>
                    <div class="kethab-library-carousel owl-carousel col-12">
                        @foreach ($relatedBooks as $relatedBook)
                            @include(currentFrontView('partials.books.book'),['book',$relatedBook])
                        @endforeach
                    </div>

                </div>
            </div>
            <!-- book library carouse end -->
        </section>


    </main>
    <script>
        var tab_comments = 'tab_comments';
        var tab_questions = 'tab_questions';

        function getComments(page, tab) {
            openLoading();
            var book_id = "{{ $book->id }}";
            var is_question = 0;
            if (tab == tab_questions) is_question = 1;
            var url = '{{ route("bookcomment.get", [":book_id",":is_question"]) }}';
            url = url.replace(':book_id', book_id);
            url = url.replace(':is_question', is_question);
            $.ajax({
                headers: {headers: {'csrftoken': '{{ csrf_token() }}'}},
                url: url + '?page=' + page,
                type: 'get',
                cache: false,
                data: ''/*{ 'userid': name}*/, //see the $_token
                datatype: 'html',
                beforeSend: function () {
                },
                success: function (data) {
                    if (tab == tab_comments) {
                        activaTab('naghd_tab');
                        $('#comment_place').html(data.html);
                    } else {
                        activaTab('question_tab');
                        $('#question_place').html(data.html);
                    }
                    location.hash = tab + '/&' + 'page=' + page;
                    $('.expose-more-button-box .btn').click(function () {
                        $(this).closest('.expose-box').find('.user-content-expose').slideUp();
                        $(this).closest('.expose-box').find('.user-bottom-content').slideDown();
                    });
                    closeloading();
                },
                error: function (xhr, textStatus, thrownError) {
                    $('#comment_place').html('');
                    closeloading();
                }
            });
        }
    </script>
    <script src="{{ frontendTheme('js/lib/book-page.js') }}"></script>
    <script>
        $('.audio').click(function () {
            var audio_id = $(this).attr('audio_id');
            var url = '{{ route("audiobook.get", ":audio_id") }}';
            url = url.replace(':audio_id', audio_id);
            getAudioBook(audio_id, url, '{{ csrf_token() }}');
        });


        $('.rate-icon').click(function () {
            @if (Auth::check())
            popUp('rateModal', "{{ route('rate.modal',$book->id) }}");
            @else
            //toastr.error("{{ __('message.please_login_in_your_account_or_register') }}");
            window.location.href = "{{ route('auth.login') }}";
            @endif
        });
    </script>
    @foreach ($book->audios as $audio)
        <script>
            var audio_id = "{{ $audio->id }}";
            var url = '{{ route("audiobook.get", ":audio_id") }}';
            url = url.replace(':audio_id', audio_id);
            getAudioBook(audio_id, url, '{{ csrf_token() }}');
        </script>
        @break
    @endforeach

    <script src="{{ frontendTheme('js/lib/book-type-tab.js') }}"></script>
    <script src="{{ frontendTheme('js/lib/comments-tab.js') }}"></script>
    <script src="{{ frontendTheme('js/custom-scroll/jquery-scrollbar.min.js') }}"></script>

    <script src="{{ frontendTheme('js/lib/review-carousel.js') }}"></script>
    <script src="{{ frontendTheme('js/jquery-rate-picker.js') }}"></script>

    <script>
        $('.summary-content *').removeAttr('style');
    </script>

@endsection

@extends('layouts.frontend')
@section('title',$person->title)
@section('keywords','')
@section('description','')
@section('open_graph')
    <meta property='og:site_name' content='{{ $person->title }}'>
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
    <link rel="stylesheet" href="{{ frontendTheme('js/custom-scroll/jquery-scrollbar.css') }}">
    <link rel="stylesheet" href="{{ frontendTheme('js/rateyo/jquery.rateyo.min.css') }}">
    <main>
        <section>

            <!-- kethab category container start -->
            <div class="kethab-category-container container">
                <h2 class="category-small-title">
                    <a href="{{ route("home") }}">کتهاب</a>
                    /
                    @switch ($person_role)
                        @case(getConstant('person_role.writer'))
                        {{ __('person.writer') }}
                        @break
                        @case(getConstant('person_role.translator'))
                        {{ __('person.translator') }}
                        @break
                    @endswitch
                    / {{ $person->title }}
                </h2>
                <!-- category section -->
                <div class="kethab-category-box col-12 justify-content-md-start justify-content-center">
                    <div
                        class="kethab-category-content col-lg-8 col-md-6 col-12 align-items-md-start align-items-center">
                        <h1 class="category-main-title">{{ $person->title }}</h1>
                        <div class="writer-information-box">
                            <div class="writer-information-col col-lg-4 col-12">
                                <h2 class="information-col-title">تاریخ
                                    ثبت: {{ $person->present()->registrationDate }}</h2>
                            </div>
                            <div class="writer-information-col col-lg-4 col-12">
                                <h2 class="information-col-title">تعداد آثار: {{ $book_count }}</h2>
                            </div>

                        </div>
                        <div class="category-content-box">
                            <p class="category-content-text show-more-content">
                                {!! $person->present()->descriptionHtml  !!}
                            </p>
                            <span class="expand-bar">
                    <span class="expand-fade"></span>
                   </span>
                            <span class="expand-bar-icon">
                     <span href="" class="expand-icon">
                    <i class="fa-chevron-down fas"></i>
                     </span>
                   </span>
                        </div>
                        @if(auth()->check())
                            <div class="category-follow-box">
                                @if(!empty($folow))
                                    @if($folow->person_id>0)
                                        <button
                                            class="btn btn-danger btn-follow btn_followed">@lang('follow.followed')</button>
                                    @else
                                        <button
                                            class="btn btn-danger btn-follow">@lang('follow.follow')</button>
                                    @endif
                                @else
                                    <button
                                        class="btn btn-danger btn-follow">@lang('follow.follow')</button>
                                @endif
                            </div>
                        @endif
                    </div>

                    <div class="kethab-category-image col-lg-4 col-md-6 col-sm-8 col-10 ">
                        <div class="category-image-box">
                            <img src="{{ getPersonImagePath($person->thumbnail) }}"
                                 alt="{{ $person->title }}">
                            <div class="half-circle-background"></div>
                            <div class="half-circle">
                         <span class="half-icon-box">
                           <a href="#" class="icon-box-link">
                             <img src="  {{ frontendTheme('images/icon/instagram.png') }}" alt="instagram">
                           </a>
                         </span>
                                <span class="half-icon-box">
                           <a href="#" class="icon-box-link">
                             <img src=" {{ frontendTheme('images/icon/facebook.png') }}" alt="facebook">
                           </a>
                         </span>
                                <span class="half-icon-box">
                           <a href="#" class="icon-box-link">
                             <img src=" {{ frontendTheme('images/icon/twitter.png') }}" alt="twitter">
                           </a>
                         </span>
                                <span class="half-icon-box">
                           <a href="#" class="icon-box-link">
                             <img src=" {{ frontendTheme('images/icon/telegram.png') }}" alt="telegram">
                           </a>
                         </span>
                                <span class="half-icon-box">
                           <a href="#" class="icon-box-link">

                             <img src=" {{ frontendTheme('images/icon/worldwide.png') }}" alt=" worldwide">
                           </a>
                         </span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- category section -->
                <div class="awards-box col-12">
                    <h3 class="awards-title">جوایز</h3>
                    @foreach($awards as $award)
                        <a href="{{ route('award.view',[$award->id,$award->slug]) }}">
                            <div class="awards-item-box">
                                <img src="{{ getAwardImagePath($award->logo) }}" alt="{{ $award->title }}">
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
            <!-- kethab category container end -->
            <div class="kethab-category-container container">
                <!-- filter panels -->
                <div class=" advertising-box">
                    <img src="{{ frontendTheme('images/filter-image.png') }}" alt="">
                </div>
                <div class="mobile-filter-button-box">
                    <button class="btn btn-danger btn-filter">
                        <i class="fas fa-bars"></i>
                        جستجوی پیشرفته
                    </button>
                </div>
                <div class="filter-panels col-md-3">
                    <div class="filter-panels-main">
                        <div class="filter-image-box">
                            <img src="{{ frontendTheme('images/filter-image.png') }}" alt="">
                        </div>
                        <div class="col-12">
                            <div class="filter-panel-box">
                                <div class="filter-panel-title">
                                    <h3 class="filter-title-text">موضوعات</h3>
                                </div>
                                <div class="filter-search-box">
                                    <input type="text" class="form-control search-control-filter" value="جستجو">
                                </div>
                                <div class="filter-option-box filter-option-scroll scrollbar-inner"
                                     id="category_checks">
                                    <div class="filter-option-main" id="category_checks_main">
                                    </div>
                                    <div class="filter-option-more" id="category_checks_more">
                                    </div>
                                    <div class="more-filter-box">
                                        <div class="toggle-more-box">
                                            <span class="more-toggle-button">
                                              <i class="fa-chevron-down fas"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="filter-panel-box">
                                <div class="filter-panel-title">
                                    <h3 class="filter-title-text">ناشر</h3>
                                </div>
                                <div class="filter-search-box">
                                    <input type="text" class="form-control search-control-filter" value="جستجو">
                                </div>
                                <div class="filter-option-box filter-option-scroll scrollbar-inner"
                                     id="organization_checks">
                                    <div class="filter-option-main" id="organization_checks_main">
                                    </div>
                                    <div class="filter-option-more" id="organization_checks_more">
                                    </div>
                                    <div class="more-filter-box">
                                        <div class="toggle-more-box">
                                            <span class="more-toggle-button">
                                              <i class="fa-chevron-down fas"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @if(getConstant('person_role.translator') == $person_role)
                                <div class="filter-panel-box">
                                    <div class="filter-panel-title">
                                        <h3 class="filter-title-text">نویسنده</h3>
                                    </div>
                                    <div class="filter-search-box">
                                        <input type="text" class="form-control search-control-filter" value="جستجو">
                                    </div>
                                    <div class="filter-option-box filter-option-scroll scrollbar-inner"
                                         id="writer_checks">
                                        <div class="filter-option-main" id="writer_checks_main">
                                        </div>
                                        <div class="filter-option-more" id="writer_checks_more">
                                        </div>
                                        <div class="more-filter-box">
                                            <div class="toggle-more-box">

                              <span class="more-toggle-button">
                                <i class="fa-chevron-down fas"></i>
                              </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @if(getConstant('person_role.writer') == $person_role)
                                <div class="filter-panel-box">
                                    <div class="filter-panel-title">
                                        <h3 class="filter-title-text">مترجم</h3>
                                    </div>
                                    <div class="filter-search-box">
                                        <input type="text" class="form-control search-control-filter" value="جستجو">
                                    </div>
                                    <div class="filter-option-box filter-option-scroll scrollbar-inner"
                                         id="translator_checks">
                                        <div class="filter-option-main" id="translator_checks_main">
                                        </div>
                                        <div class="filter-option-more" id="translator_checks_more">
                                        </div>
                                        <div class="more-filter-box">
                                            <div class="toggle-more-box">

                            <span class="more-toggle-button">
                              <i class="fa-chevron-down fas"></i>
                            </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            <div class="filter-panel-box">
                                <div class="filter-panel-title">
                                    <h3 class="filter-title-text">امتیاز</h3>
                                </div>
                                <div class="filter-option-box">
                                    <div class="filter-option-main filter-option-hide" id="rate_checks">
                                        <label class="filter-check-row">
                                            <input type="checkbox" class="filter-check-input" data-id="1">
                                            <span class="checkmark"></span>
                                            <div class="similar-book-star">
                                                <span class="book-star-icon-orange"><i class="fas fa-star "></i></span>
                                                <span class="book-star-icon-defualt"><i class="fas fa-star "></i></span>
                                                <span class="book-star-icon-defualt"><i class="fas fa-star "></i></span>
                                                <span class="book-star-icon-defualt"><i class="fas fa-star "></i></span>
                                                <span class="book-star-icon-defualt"><i class="fas fa-star "></i></span>
                                            </div>
                                        </label>
                                        <label class="filter-check-row">
                                            <input type="checkbox" class="filter-check-input" data-id="2">
                                            <span class="checkmark"></span>
                                            <div class="similar-book-star">
                                                <span class="book-star-icon-orange"><i class="fas fa-star "></i></span>
                                                <span class="book-star-icon-orange"><i class="fas fa-star "></i></span>
                                                <span class="book-star-icon-defualt"><i class="fas fa-star "></i></span>
                                                <span class="book-star-icon-defualt"><i class="fas fa-star "></i></span>
                                                <span class="book-star-icon-defualt"><i class="fas fa-star "></i></span>
                                            </div>
                                        </label>
                                        <label class="filter-check-row">
                                            <input type="checkbox" class="filter-check-input" data-id="3">
                                            <span class="checkmark"></span>
                                            <div class="similar-book-star">
                                                <span class="book-star-icon-orange"><i class="fas fa-star "></i></span>
                                                <span class="book-star-icon-orange"><i class="fas fa-star "></i></span>
                                                <span class="book-star-icon-orange"><i class="fas fa-star "></i></span>
                                                <span class="book-star-icon-defualt"><i class="fas fa-star "></i></span>
                                                <span class="book-star-icon-defualt"><i class="fas fa-star "></i></span>
                                            </div>
                                        </label>
                                        <label class="filter-check-row">
                                            <input type="checkbox" class="filter-check-input" data-id="4">
                                            <span class="checkmark"></span>
                                            <div class="similar-book-star">
                                                <span class="book-star-icon-orange"><i class="fas fa-star "></i></span>
                                                <span class="book-star-icon-orange"><i class="fas fa-star "></i></span>
                                                <span class="book-star-icon-orange"><i class="fas fa-star "></i></span>
                                                <span class="book-star-icon-orange"><i class="fas fa-star "></i></span>
                                                <span class="book-star-icon-defualt"><i class="fas fa-star "></i></span>
                                            </div>
                                        </label>
                                        <label class="filter-check-row">
                                            <input type="checkbox" class="filter-check-input" data-id="5">
                                            <span class="checkmark"></span>
                                            <div class="similar-book-star">
                                                <span class="book-star-icon-orange"><i class="fas fa-star "></i></span>
                                                <span class="book-star-icon-orange"><i class="fas fa-star "></i></span>
                                                <span class="book-star-icon-orange"><i class="fas fa-star "></i></span>
                                                <span class="book-star-icon-orange"><i class="fas fa-star "></i></span>
                                                <span class="book-star-icon-orange"><i class="fas fa-star "></i></span>
                                            </div>
                                        </label>
                                    </div>

                                    <div class="hide-filter-box">
                                        <div class="toggle-hide-box">

                              <span class="hide-toggle-button">
                                <i class="fa-chevron-down fas"></i>
                              </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="filter-panel-box">
                                <div class="filter-panel-title">
                                    <h3 class="filter-title-text">تعداد صفحات</h3>
                                </div>
                                <div class="filter-option-box">
                                    <div class="filter-option-main filter-option-hide">
                                        <input type="text" class="filter-option-input col-5" id="from_page_input">
                                        <label class="option-label-text">تا</label>
                                        <input type="text" class=" filter-option-input col-5" id="to_page_input">
                                        <div class="filter-search-row">
                                            <span class="filter-search-icon" id="page_serach_btn">
                                                <i class="fal fa-search"></i>
                                            </span>
                                        </div>
                                    </div>

                                    <div class="hide-filter-box">
                                        <div class="toggle-hide-box">

                              <span class="hide-toggle-button">
                                <i class="fa-chevron-down fas"></i>
                              </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="filter-panel-box">
                                <div class="filter-panel-title">
                                    <h3 class="filter-title-text">نوع کتاب</h3>
                                </div>
                                <div class="filter-option-box">
                                    <div class="filter-option-main filter-option-hide" id="book_type_checks">

                                        <label class="filter-check-row">
                                            <input type="checkbox" class="filter-check-input" data-id="BOOK">
                                            <span class="checkmark"></span>
                                            <span class="filter-check-text">کتاب</span>
                                        </label>
                                        <label class="filter-check-row">
                                            <input type="checkbox" class="filter-check-input" data-id="MAGAZINE">
                                            <span class="checkmark"></span>
                                            <span class="filter-check-text">مجله</span>
                                        </label>
                                        <label class="filter-check-row">
                                            <input type="checkbox" class="filter-check-input" data-id="OTHER">
                                            <span class="checkmark"></span>
                                            <span class="filter-check-text">سایر</span>
                                        </label>
                                    </div>

                                    <div class="hide-filter-box">
                                        <div class="toggle-hide-box">

                              <span class="hide-toggle-button">
                                <i class="fa-chevron-down fas"></i>
                              </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--<div class="filter-panel-box">
                                <div class="filter-panel-title">
                                    <h3 class="filter-title-text">نوع انتشار</h3>
                                </div>
                                <div class="filter-option-box">
                                    <div class="filter-option-main filter-option-hide">

                                        <label class="filter-check-row">
                                            <input type="checkbox" class="filter-check-input">
                                            <span class="checkmark"></span>
                                            <span class="filter-check-text">چاپی</span>
                                        </label>
                                        <label class="filter-check-row">
                                            <input type="checkbox" class="filter-check-input">
                                            <span class="checkmark"></span>
                                            <span class="filter-check-text">الکترونیک</span>
                                        </label>
                                        <label class="filter-check-row">
                                            <input type="checkbox" class="filter-check-input">
                                            <span class="checkmark"></span>
                                            <span class="filter-check-text">صوتی</span>
                                        </label>
                                    </div>
                                    <div class="hide-filter-box">
                                        <div class="toggle-hide-box">
                              <span class="hide-toggle-button">
                                <i class="fas fa-chevron-down "></i>
                              </span>
                                        </div>
                                    </div>
                                </div>
                            </div>-->
                            <div class="filter-panel-box">
                                <div class="filter-panel-title">
                                    <h3 class="filter-title-text">سال انتشار</h3>
                                </div>
                                <div class="filter-option-box">
                                    <div class="filter-option-main filter-option-hide">
                                        <input type="text" class="filter-option-input col-5" id="from_year_input">
                                        <label class="option-label-text">تا</label>
                                        <input type="text" class=" filter-option-input col-5" id="to_year_input">
                                        <div class="filter-search-row">
                                            <span class="filter-search-icon" id="year_serach_btn">
                                                <i class="fal fa-search"></i>
                                            </span>
                                        </div>
                                    </div>

                                    <div class="hide-filter-box">
                                        <div class="toggle-hide-box">
                                          <span class="hide-toggle-button">
                                            <i class="fa-chevron-down fas"></i>
                                          </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- filter panels -->
                </div>
                <!-- filter panels -->
                <!-- category books main start -->
                <div class="category-books-main col-md-9 col-12">

                    <!-- category books header -->
                    <div class="category-books-header filter-book-header">
                        <h3 class="category-books-title">کتاب های دسته بندی دین</h3>
                        <div class="according-for-box">
                            <div class="according-for-toggle">
                                <h3 class="more-filter-text">فیلتر ها</h3>
                                <span class="according-toggle-button">
                          <i class="fa-chevron-down fas"></i>
                        </span>
                            </div>
                            <div class="according-for-item">
                    <span class="according-for-list">
                      <label class="filter-check-row">
                        <input type="radio" class="filter-check-input" name="according-for" value="a"
                               id="sort_new_books">
                        <span class="checkmark"></span>
                        <span class="filter-check-text">جدید ترین</span>
                      </label>
                    </span>
                                <span class="according-for-list">
                      <label class="filter-check-row">
                        <input type="radio" class="filter-check-input" name="according-for" value="b"
                               id="sort_old_books">
                        <span class="checkmark"></span>
                        <span class="filter-check-text">قدیمیترین</span>
                      </label>
                    </span>
                                <span class="according-for-list">
                      <label class="filter-check-row">
                        <input type="radio" class="filter-check-input" name="according-for" value="c"
                               id="sort_most_comment">
                        <span class="checkmark"></span>
                        <span class="filter-check-text">بیشترین نقد</span>
                      </label>
                    </span>
                                <span class="according-for-list">
                      <label class="filter-check-row">
                        <input type="radio" class="filter-check-input" name="according-for" value="d"
                               id="sort_most_rate">
                        <span class="checkmark"></span>
                        <span class="filter-check-text">بیشترین امتیاز</span>
                      </label>
                    </span>
                                <span class="according-for-list">
                      <label class="filter-check-row">
                        <input type="radio" class="filter-check-input" name="according-for" value="e"
                               id="sort_up_alphabet">
                        <span class="checkmark"></span>
                        <span class="filter-check-text">از الف تا ی</span>
                      </label>
                    </span>
                                <span class="according-for-list">
                      <label class="filter-check-row">
                        <input type="radio" class="filter-check-input" name="according-for" value="f"
                               id="sort_down_alphabet">
                        <span class="checkmark"></span>
                        <span class="filter-check-text">از ی تا الف</span>
                      </label>
                    </span>
                            </div>
                        </div>
                    </div>
                    <!-- category-books-header end -->


                    <!-- category-books-section -->
                    <div
                        class="category-books-section books-section-filter justify-content-md-start justify-content-center"
                        id="books_place">

                    </div>


                </div>
                <!-- category books main -->

                <div class="review-box writer-review">

                    <div class="review-title-box col-12">
                        <h3 class="review-title-text col-12">نقل قول ها</h3>

                    </div>
                    <div class="review-title-box col-12">
                        <h3 class="review-title-name col-12"><a href="#">{{ $person->title }}</a></h3>
                    </div>
                    <div class="review-carousel owl-carousel col-12">
                        @foreach($quotations as $quotation)
                            <div class="review-carousel-slide col-12">

                                <div class="carousel-slide-content">
                                    <p class="slide-content-text">
                                        {{ $quotation->description }}
                                    </p>

                                </div>
                                <!--<h3 class="review-source-title"><a href="#">کلیدر جلد دوم صفحه 536</a></h3>
                                <button class="like-review" type="button">پسندیدم</button>-->
                                <h3 class="review-more">
                                    <a href="#">
                                        <span class="more-icon fas fa-plus"></span>
                                        بیشتر
                                    </a>
                                </h3>


                            </div>
                        @endforeach
                    </div>

                </div>

                <!-- kethab last news container -->
                <div class="container kethab-last-news-container ">
                    <div class="library-row-title col-12">
                        <h2 class="library-title">اخبار {{ $person->title }}</h2>
                        <h2 class="library-more">
                            <a href="#">
                                <span class="more-icon fas fa-plus"></span>
                                بیشتر

                            </a>
                        </h2>
                    </div>
                    <div class="last-news-box owl-carousel">
                        @foreach($blogs as $blog)
                            <div class="col-12">
                                <div class="column-last-news">
                                    <div class="last-news-image-box col-12">
                                        <img src="{{ getBlogImagePath($blog->thumbnail) }}" alt="{{ $blog->title }}">
                                    </div>
                                    <div class="last-news-title-box col-12">
                                        <h2 class="last-news-title"><a href="#">{{ $blog->title }}</a></h2>
                                    </div>
                                    <div class="last-news-content col-12">
                                        <p>
                                            {!! $blog->present()->descriptionHtml  !!}
                                        </p>
                                    </div>

                                    <div class="last-news-more-box col-12">
                                        <h2 class="last-news-more"><a href="#">
                                                <span class="more-icon fas fa-plus"></span>
                                                بیشتر</a></h2>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                </div>
                <!--End kethab last news container -->
            </div>


        </section>
    </main>

    <script src="{{ frontendTheme('js/custom-scroll/jquery-scrollbar.min.js') }}"></script>
    <script src="{{ frontendTheme('js/lib/review-carousel.js') }}"></script>
    <script>
        $('.btn-follow').click(function () {
            follow('{{ route("follower.follow") }}', "{{ csrf_token() }}", '{{ $person->id }}', 0, 0, 0);
        });

        function getFilterBooks() {
            var url = '{{ route("person.getbooks", [":person_id"]) }}';
            url = url.replace(':person_id', '{{ $person->id }}');
            openLoading();
            $.ajax({
                url: url + '?' + getAllParameter(),
                type: 'get',
                cache: false,
                data: {
                    // "report": $('#report_comment').val(),
                    //'report_type': report_type,
                },
                datatype: 'html',
                beforeSend: function () {
                },
                success: function (data) {
                    //activaTab('question_tab');
                    $('#books_place').html(data.html);
                    location.hash = '/&' + getAllParameter();
                    closeloading();
                },
                error: function (xhr, textStatus, thrownError) {
                    $('#books_place').html('');
                    toastr.error(__the_operation_failed);
                    closeloading();
                }
            });
        }


    </script>
    <script src="{{ frontendTheme('js/lib/filter-functions.js') }}"></script>
    <script>
        var category_url = '{{ route("person.getcategories", [":person_id"]) }}';
        category_url = category_url.replace(':person_id', '{{ $person->id }}');
        getCategories(category_url);
        $('#category_checks .more-toggle-button i').click(function () {
            getCategories(category_url);
            $(this).closest('.filter-option-box').find('.filter-option-more').slideToggle();
        });

        var organization_url = '{{ route("person.getorganizations", [":person_id"]) }}';
        organization_url = organization_url.replace(':person_id', '{{ $person->id }}');
        getOrganizations(organization_url);
        $('#organization_checks .more-toggle-button i').click(function () {
            getOrganizations(organization_url);
            $(this).closest('.filter-option-box').find('.filter-option-more').slideToggle();
        });

        if ('{{ getConstant('person_role.translator') }}' == '{{ $person_role }}') {
            var writer_url = '{{ route("person.getpersons", [":person_id",":person_role_id"]) }}';
            writer_url = writer_url.replace(':person_id', '{{ $person->id }}');
            writer_url = writer_url.replace(':person_role_id', '{{ getConstant('person_role.writer') }}');
            getWriters(writer_url);
            $('#writer_checks .more-toggle-button i').click(function () {
                getWriters(writer_url);
                $(this).closest('.filter-option-box').find('.filter-option-more').slideToggle();
            });
        }
        if ('{{ getConstant('person_role.writer') }}' == '{{ $person_role }}') {
            var translator_url = '{{ route("person.getpersons", [":person_id",":person_role_id"]) }}';
            translator_url = translator_url.replace(':person_id', '{{ $person->id }}');
            translator_url = translator_url.replace(':person_role_id', '{{ getConstant('person_role.translator') }}');
            getTranslators(translator_url);
            $('#translator_checks .more-toggle-button i').click(function () {
                getTranslators(translator_url);
                $(this).closest('.filter-option-box').find('.filter-option-more').slideToggle();
            });
        }
        <script src="{{ frontendTheme('js/lib/category-page-main.js') }}"></script>
    </script>
@endsection

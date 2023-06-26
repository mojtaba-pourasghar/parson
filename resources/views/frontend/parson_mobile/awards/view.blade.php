@extends('layouts.frontend')
@section('title',$award->title)
@section('keywords','')
@section('description','')
@section('open_graph')
    <meta property='og:site_name' content='{{ $award->title }}'>
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
                    کتهاب/ دسته بندی ها/ نشر چشمه
                </h2>
                <!-- category section -->
                <div class="kethab-category-box col-12 justify-content-md-start justify-content-center">
                    <div
                        class="kethab-category-content col-lg-8 col-md-6 col-12 align-items-md-start align-items-center">
                        <h1 class="category-main-title">{{ $award->title }}</h1>
                        <div class="writer-information-box">
                            <div class="writer-information-col col-lg-4 col-12">
                                <h2 class="information-col-title">تاریخ
                                    ثبت: {{ $award->present()->registrationDate }}</h2>
                            </div>
                            <div class="writer-information-col col-lg-4 col-12">
                                <h2 class="information-col-title">تعداد آثار: {{ $book_count }}</h2>
                            </div>

                        </div>
                        <div class="category-content-box">
                            <p class="category-content-text show-more-content">
                                {!! $award->present()->descriptionHtml  !!}
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
                                    @if($folow->award_id>0)
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
                            <img src="{{ getAwardImagePath($award->logo) }}"
                                 alt="{{ $award->title }}">
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
                                    <h3 class="filter-title-text">سال جایزه</h3>
                                </div>
                                <div class="filter-search-box">
                                    <input type="text" class="form-control search-control-filter" value="جستجو">
                                </div>
                                <div class="filter-option-box filter-option-scroll scrollbar-inner" id="awardbook_year_checks">
                                    <div class="filter-option-main" id="awardbook_year_checks_main">
                                    </div>
                                    <div class="filter-option-more" id="awardbook_year_checks_more">
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
                                    <h3 class="filter-title-text">موضوعات</h3>
                                </div>
                                <div class="filter-search-box">
                                    <input type="text" class="form-control search-control-filter" value="جستجو">
                                </div>
                                <div class="filter-option-box filter-option-scroll scrollbar-inner" id="category_checks">
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
                                        <div class="filter-search-row" >
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
                <!-- kethab last news container -->
                <!--<div class="container kethab-last-news-container ">
                    <div class="library-row-title col-12">
                        <h2 class="library-title">اخبار {{ $award->title }}</h2>
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

                </div>-->
                <!--End kethab last news container -->
            </div>

        </section>
    </main>

    <script src="{{ frontendTheme('js/custom-scroll/jquery-scrollbar.min.js') }}"></script>
    <script>
        $('.btn-follow').click(function () {
            follow('{{ route("follower.follow") }}', "{{ csrf_token() }}", 0, 0, 0, '{{ $award->id }}');
        });

        function getFilterBooks() {
            var url = '{{ route("award.getbooks", [":award_id"]) }}';
            url = url.replace(':award_id', '{{ $award->id }}');
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
        var category_url = '{{ route("award.getcategories", [":award_id"]) }}';
        category_url = category_url.replace(':award_id', '{{ $award->id }}');
        getCategories(category_url);
        $('#category_checks .more-toggle-button i').click(function () {
            getCategories(category_url);
            $(this).closest('.filter-option-box').find('.filter-option-more').slideToggle();
        });


        var organization_url = '{{ route("award.getorganizations", [":award_id"]) }}';
        organization_url = organization_url.replace(':award_id', '{{ $award->id }}');
        getOrganizations(organization_url);
        $('#organization_checks .more-toggle-button i').click(function () {
            getOrganizations(organization_url);
            $(this).closest('.filter-option-box').find('.filter-option-more').slideToggle();
        });

        var awardbook_url = '{{ route("award.getawardbooks", [":award_id"]) }}';
        awardbook_url = awardbook_url.replace(':award_id', '{{ $award->id }}');
        getAwardBookYears(awardbook_url);
        $('#awardbook_year_checks .more-toggle-button i').click(function () {
            getAwardBookYears(awardbook_url);
            $(this).closest('.filter-option-box').find('.filter-option-more').slideToggle();
        });
        <script src="{{ frontendTheme('js/lib/category-page-main.js') }}"></script>
    </script>
@endsection

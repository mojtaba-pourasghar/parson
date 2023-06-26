@extends('layouts.frontend')
@section('title',__('blog.news'))
@section('keywords','')
@section('description','')
@section('open_graph')
    <meta property='og:site_name' content='{{ __('blog.news') }}'>
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
    <link rel="stylesheet" href="{{ frontendTheme('css/animate.css') }}">
    <link rel="stylesheet" href="{{ frontendTheme('js/rateyo/jquery.rateyo.min.css') }}">

    <main>
        <section>

            <!-- kethab category container start -->
            <div class="kethab-category-container container">
                <h2 class="category-small-title">
                    کتهاب/ وبلاگ
                </h2>
            </div>
            <!-- start kethab search -->
            <div class="kethab-search-container container">

                <div class="search-box col-12">
                    <form action="#" method="get">

                        <div class="search-box-control">
                            <input type="search" class="form-control search-control" placeholder="عقاید یک دلقک">
                            <button type="submit" class="btn btn-danger btn-search-box">جستجو</button>
                        </div>

                    </form>

                </div>

            </div>
            <!-- end kethab search   -->


            <div class="kethab-category-container container">
                <!-- category books header -->
                <div class="category-books-header filter-book-header">
                    <h3 class="category-books-title">جدید ترین اخبار</h3>
                </div>
                <!-- category-books-header end -->
                <!-- filter panels -->
                <div class=" advertising-box">
                    <img src="{{ frontendTheme('images/filter-image.png') }}" alt="">
                </div>

                <div class="filter-panels col-md-3">
                    <div class="filter-panels-main">
                        <div class="filter-image-box">
                            <img src="{{ frontendTheme('images/filter-image.png') }}" alt="">
                        </div>

                    </div>
                    <!-- filter panels -->
                </div>

                <!-- category books main start -->
                <div class="category-books-main col-md-9 col-12">

                    <!-- category-books-section -->
                    <div class="category-books-section blog-news-section justify-content-md-start justify-content-center">
                        <!-- blog news row  -->
                        @foreach($blogs as $blog)
                        <div class="blog-news-row justify-content-center">
                            <div class="news-image-box col-lg-5 col-md-8 col-10">

                                <img src="{{ getBlogImagePath($blog->thumbnail) }}"
                                     alt="{{ $blog->title }}">
                            </div>
                            <div class="news-content-box col-lg-7 col-12">
                                <h2 class="news-content-title">
                                    <a href="{{ route('blog.view',[$blog->id,$blog->slug]) }}">{!! $blog->title !!}</a>
                                </h2>
                                <div class="news-content">
                                    <div class="news-content-text">
                                        {!! $blog->present()->excerptHtml  !!}
                                    </div>
                                    <div class="news-more-box">
                                        <a href="{{ route('blog.view',[$blog->id,$blog->slug]) }}">
                                            <span class="more-icon fas fa-plus"></span>
                                            بیشتر
                                        </a>
                                    </div>
                                </div>
                                <div class="news-bar-section"></div>
                                <div class="news-detail-box">
                                    <div class="news-detail-right col-sm-6 col-12">
	             				<span class="news-detail-icon">
	             					<img src="{{ frontendTheme('images/icon/clock.png') }}">
	             				</span>
                                        <span class="news-detail-text">مدت زمان مطالعه: {{ $blog->study_time }} دقیقه</span>
                                    </div>
                                    <div class="news-detail-left col-sm-6 col-12">
	             				<span class="news-detail-icon">
	             					<img src="{{ frontendTheme('images/icon/calendar.jpg') }}">
	             				</span>
                                        <span class="news-detail-text">تاریخ نشر: {{ $blog->present()->publishedDate }} </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        <!-- blog news row  -->
                    </div>
                    <!-- pagination -->
                    <nav aria-label="Page navigation" class="pagination-main">
                        {{ $blogs->appends($_GET)->links(currentFrontView('pagination')) }}
                    </nav>


                </div>
                <!-- category books main -->
            </div>

        </section>
        <!-- study modal -->
        <div class="modal fade study-modal" id="studyModal" tabindex="-1" role="dialog" aria-labelledby="studyModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="study-content-box">

                        <div class="study-top-toast">
                            <div class="toast-header-row">
                                         <span class="close-toast" data-dismiss="modal">
                                             <i class="fal fa-times"></i>
                                         </span>
                                <div class="book-title">

                                </div>
                            </div>
                            <div class="study-box-row">
                                <div class="study-box-title want-study"><a href="#">می خواهم بخوانم</a></div>
                                <div class="study-box-title study"><a href="#">خوانده ام</a></div>
                                <div class="study-box-title studing"><a href="#">در حال خواندن</a></div>
                                <div class="study-toast-line"></div>

                            </div>
                            <span class="shelf-button">قفسه های من</span>
                        </div>

                        <div class="study-bottom-toast scrollbar-inner">
                            <div class="toast-header-row">
                                         <span class="close-toast" data-dismiss="modal">
                                             <i class="fal fa-times"></i>
                                         </span>
                                <span class="back-toast">
                                            <i class="fal fa-arrow-right"></i>
                                         </span>
                            </div>

                            <div class="study-box-row">
                                <div class="study-box-title">
                                    <label class="filter-check-row">
                                        <input type="checkbox" class="filter-check-input">
                                        <span class="checkmark"></span>
                                        <span class="filter-check-text">کتاب های روسی</span>
                                    </label>

                                    <label class="filter-check-row">
                                        <input type="checkbox" class="filter-check-input">
                                        <span class="checkmark"></span>
                                        <span class="filter-check-text">کتاب های مورد علاقه من</span>
                                    </label>

                                </div>
                            </div>
                            <div class="study-box-row">
                                <input type="text" class="shelf-name-input" value="نام قفسه را وارد کنید">
                                <button class="btn btn-danger study-box-save">ثبت</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- study modal End -->

    </main>
    <script src="{{ frontendTheme('js/blog.js') }}"></script>

@endsection

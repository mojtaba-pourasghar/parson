@extends('layouts.frontend')
@section('title',$blog->title)
@section('keywords','')
@section('description','')
@section('open_graph')
    <meta property='og:site_name' content='{{ $blog->title }}'>
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
            <div class="kethab-category-container container">
                <h1 class="category-small-title">
                    <a href="{{ route("home") }}">کتهاب</a>/ {{ $blog->title }}
                </h1>
                <!-- filter panels -->
                <div class=" advertising-box">
                    <img src="{{ frontendTheme('images/filter-image.png') }}" alt="">
                </div>


                <div class="sidebar-blog col-md-3">
                    <div class="filter-panels-main">
                        <div class="filter-image-box">
                            <img src="{{ frontendTheme('images/filter-image.png') }}" alt="">
                        </div>
                    </div>
                    <!-- filter panels -->
                    <!-- sidebar-col -->
                    @if(!empty($blog->books ))
                        <div class="sidebar-col">
                            <div class="sidebar-col-header">
                                <h3 class="sidebar-title">کتاب های مرتبط با خبر</h3>
                            </div>
                            <div class="sidebar-similar-box similar-book-sidebar scrollbar-inner">
                                @foreach($blog->books as $book)
                                    <div class="sidebar-similar-items col-6">
                                        <a href="{{ getBookLink($book->id,$book->slug) }}">
                                            <img src="{{  getBookImagePath($book->thumbnail) }}"
                                                 alt="{{ $book->title }}">
                                        </a></div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                <!-- end sidebar-col -->
                    <!-- sidebar-col -->
                    @if(!empty($blog->organizations ))
                        <div class="sidebar-col">
                            <div class="sidebar-col-header">
                                <h3 class="sidebar-title">ناشران مرتبط با خبر</h3>
                            </div>
                            <div class="sidebar-similar-box scrollbar-inner sidebar-similar-round">
                                @foreach($blog->organizations as $organization)
                                    <div class="sidebar-similar-items col-6">
                                        <a href="{{ route('organization.view',[$organization->id,$organization->slug]) }}">
                                            <img src="{{  getOrganizationImagePath($organization->thumbnail) }}"
                                                 alt="{{ $organization->title }}">
                                        </a></div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                <!-- end sidebar-col -->
                    <!-- sidebar-col -->
                    @if(!empty($blog->persons ))
                        <div class="sidebar-col">
                            <div class="sidebar-col-header">
                                <h3 class="sidebar-title">افراد مرتبط با خبر</h3>
                            </div>
                            <div class="sidebar-similar-box sidebar-similar-round scrollbar-inner">
                                @foreach($blog->persons as $person)
                                    <div class="sidebar-similar-items col-6">

                                        <img src="{{  getPersonImagePath($person->thumbnail) }}"
                                             alt="{{ $person->title }}">
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                <!-- end sidebar-col -->
                    <!-- sidebar-col -->
                    @if(!empty($blog->blogtags ))
                        <div class="sidebar-col">
                            <div class="sidebar-col-header">
                                <h3 class="sidebar-title">تگ ها</h3>
                            </div>
                            <div class="sidebar-similar-box news-similar-tags scrollbar-inner">
                                @foreach($blog->blogtags as $blogtag)
                                    <a href="#" class="sidebar-tag">#{{ $blogtag->title }}</a>
                                @endforeach
                            </div>
                        </div>
                @endif
                <!-- end sidebar-col -->

                </div>


                <!-- category books main start -->
                <div class="category-books-main col-md-9 col-12">


                    <!-- end kethab search   -->


                    <!-- category-books-section -->
                    <div
                        class="category-books-section books-section-filter justify-content-lg-start justify-content-md-center justify-content-start">
                        <!-- single post main -->
                        <div class="single-post-main">
                            <div class="single-image-box">
                                <img src="{{ getBlogImagePath($blog->thumbnail) }}"
                                     alt="{{ $blog->title }}">
                            </div>
                            <div class="single-post-header">
                                <div class="post-header-author col-lg-9 col-md-7 col-12">
                                    <div class="header-author-box">
                                        <img src="{{ getUserImagePath($blog->user->image) }}"
                                             alt="{{ $blog->user->name }}">
                                        <a href="#" class="author-name">{{ $blog->user->name }}</a>
                                    </div>
                                </div>
                                <div class="post-header-detail col-lg-3 col-md-5 col-12">
                                    <div class="detail-top-row">
                        <span class="post-detail-icon"><img
                                src="{{ frontendTheme('images/icon/clock.png') }}"></span>
                                        <span
                                            class="post-detail-text">مدت زمان مطالعه {{ $blog->study_time }} دقیقه</span>
                                    </div>
                                    <div class="detail-bottom-row">
                        <span class="post-detail-icon"><img
                                src="{{ frontendTheme('images/icon/calendar.jpg') }}"></span>
                                        <span
                                            class="post-detail-text">تاریخ انتشار: {{ $blog->present()->publishedDate }} </span>
                                    </div>
                                </div>
                            </div>
                            <h2 class="single-header-title">{{ $blog->title }}</h2>
                            <div class="single-content-box">
                                <div class="single-content">
                                    {!! $blog->present()->excerptHtml  !!}
                                    {!! $blog->present()->bodyHtml  !!}
                                </div>
                                <div class="single-footer-col single-col-right col-sm-6 col-12">
                                    <span>منبع:</span>
                                    <a href="{{ $blog->uri }}" target="_blank">{{ $blog->uri }}</a>
                                </div>
                                <div class="single-footer-col single-col-left col-sm-6 col-12">
                                  <span class="content-icon-box share-box" data-toggle="modal"
                                        data-target="#shareModal">
                                   <i class="fal fa-share-alt"></i>
                                </span>
                                </div>
                                <div class="news-bar-section"></div>
                            </div>
                        </div>
                        <!-- single post main end -->

                        <div class="book-review-main author-review col-12">
                            <!-- book comment start -->

                            <div class="blog-comment-content" id="naghd_tab">

                                <!-- start naghd user box -->
                                @if (Auth::check())
                                    {!! Form::model(null, ['route' => ['blogcomment.add',$blog->id] ,'method' => 'post' ,'class' => 'col-12','id'=>'comment_form'] ) !!}
                                    <input type="hidden" name="_token" id="comment_token" value="{{ csrf_token() }}">

                                    <div class="naghd-review-text-box">
                                        <div class="form-group col-12">
                                        <textarea class="form-control review-comment" rows="8" id="comment"
                                                  placeholder="نظر یا نقد خود درباره کتاب را بنویسید ..." name="comment"></textarea>
                                        </div>
                                        <input type="hidden" name="reply_to" class="reply_to" value="0">
                                    </div>
                                    <div class="naghd-review-down-row col-12">
                                        <div class="col-8 naghd-review-down-column">
                                            <!--<label class="study-check-main comment-check">
                                                <input type="checkbox" class="study-check-input">
                                                <span class="checkmark"></span>
                                                امکان لو رفتن داستان
                                            </label>-->
                                        </div>
                                        <div
                                            class="col-4 justify-content-md-end justify-content-end naghd-review-down-column review-down-btn">
                                            <button class="btn btn-danger" type="submit">ارسال</button>
                                        </div>
                                    </div>
                                    {!! Form::close() !!}
                                @else
                                    <div class="alert-message warning-alert">
                                   <span class="alert-icon">
                                    <i class="fas fa-exclamation-triangle"></i>
                                   </span>
                                        <h3 class="alert-text col-10">
                                            برای ارسال نظر به حساب کاربری خود <a href="{{ route('login') }}">وارد</a>
                                            شوید یا یک حساب <a href="{{ route('register') }}">ایجاد</a> کنید
                                        </h3>
                                    </div>
                                @endif
                                <div id="comment_place"></div>
                            </div>
                            <!-- book comment end -->
                        </div>
                    </div>
                </div>
                <!-- category books main -->
        </section>
    </main>
    <script>
        function getComments(page) {
            openLoading();
            var blog_id = "{{ $blog->id }}";

            var is_question = 0;

            var url = '{{ route("blogcomment.get", ":blog_id") }}';
            url = url.replace(':blog_id', blog_id);

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
                    $('#comment_place').html(data.html);
                    location.hash =  '/&' + 'page=' + page;
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
    <script src="{{ frontendTheme('js/lib/blog.js') }}"></script>

@endsection

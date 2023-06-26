@extends('layouts.frontend')
@section('title',$userProfile->name)
@section('keywords','')
@section('description','')
@section('open_graph')
    <meta property='og:site_name' content='{{ $userProfile->name }}'>
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
    <main>
        <section>
            <div class="container profile-container">
                <div class="profile-cover-photo">
                    <img src="{{ getUserImagePath($userProfile->image) }}" alt="{{ $userProfile->name }}">
                </div>
                <h1 class="profile-title">{{ $userProfile->name }}</h1>
                <div class="profile-main-box">
                    <p class="profile-avatar-text">
                        {{ $userProfile->description }}
                    </p>
                    <div class="profile-history-box">
                        <div class="history-title-box">
                            <h3 class="history-title">تاریخ عضویت</h3>
                            <h3 class="history-sub-title">{{ $userProfile->present()->registrationDate  }}</h3>
                        </div>
                        <div class="history-title-box">
                            <h3 class="history-title">نقد ها</h3>
                            <h3 class="history-sub-title">{{ $userProfile->book_comment_count }}</h3>
                        </div>
                        <div class="history-title-box">
                            <h3 class="history-title">تعداد رای</h3>
                            <h3 class="history-sub-title">{{ $userProfile->rate_count }}</h3>
                        </div>
                        <div class="history-title-box">
                            <h3 class="history-title">میانگین رای</h3>
                            <h3 class="history-sub-title">3</h3>
                        </div>
                        <div class="history-title-box">
                            <h3 class="history-title">کتاب های خوانده شده</h3>
                            <h3 class="history-sub-title">{{ $userProfile->book_read_count}}</h3>
                        </div>
                        <div class="history-title-box">
                            <h3 class="history-title">در حال خواندن</h3>
                            <h3 class="history-sub-title">2</h3>
                        </div>
                    </div>
                </div>
            </div>
            @if(auth()->id() != $userProfile->id)
                @if(auth()->check())
                    <div class="category-follow-box">
                        @if(!empty($folow))
                            @if($folow->user_id>0)
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
                    @endif
                    </div>

                    <div class="profile-books-main profile-books-main container">
                        <div class="library-row-title col-12">
                            <h2 class="library-title">نقد ها و نظرات</h2>
                            <h2 class="library-more">
                                <a href="{{ route('user.bookcomments',[$userProfile->id,$userProfile->name]) }}">
                                    <span class="more-icon fas fa-plus"></span>
                                    بیشتر
                                </a>
                            </h2>
                        </div>
                        <!-- category-books-section -->
                        <div class="category-books-section">
                            @foreach($userProfile->bookComments as $bookcomment)
                                <div class="col-12">
                                    @include(currentFrontView('partials.bookcomments.user_profile_comments'),['bookcomment'])
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="category-books-main profile-books-main container">
                        <div class="library-row-title col-12">
                            <h2 class="library-title">قفسه های من</h2>
                            <h2 class="library-more">
                                <a href="{{ route('user.shelves',[$userProfile->id,$userProfile->name]) }}">
                                    <span class="more-icon fas fa-plus"></span>
                                    بیشتر
                                </a>
                            </h2>
                        </div>
                        <div class="category-books-section justify-content-center">
                            <!-- category books col start -->
                            @foreach($shelves as $shelf)
                                <div class="category-books-col col-lg-4 col-sm-6 col-10">

                                    <div class="library-carousel-item">
                                        <div class="shelves-item-title-box">
                                            <h3 class="shelves-item-title-text col-lg-8">{{ $shelf->title }}</h3>
                                            <div class="shelves-item-comment-box col-4">
                                                <div class="shelves-rate">
                                                    <div class="shelves-rate-icon">
                                                        <img src="{{ frontendTheme('images/icon/star-full.png')}}"
                                                             alt="star-full">
                                                        <span class="shelves-rate-text">4.5</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="shelves-item">
                                            <div class="shelves-item-book">
                                                <div class="shelves-book-big-column col-12">
                                                    @foreach($userProfile->bookShelves as $bookShelf)
                                                        @if($bookShelf->shelf->id == $shelf->id)
                                                            <div class="book-big-column-col col-3">
                                                                <img
                                                                    src="{{ getBookImagePath($bookShelf->book->thumbnail) }}"
                                                                    alt="{{ $bookShelf->book->title }}">
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                </div>

                                            </div>
                                        </div>

                                    </div>

                                </div>
                        @endforeach
                        <!-- category books end -->


                        </div>
                        <!-- category-books-section -->


                    </div>


                    <div class="category-books-main container profile-books-main profile-writer-container">
                        <div class="library-row-title col-12">
                            <h2 class="library-title">نویسندگان مورد علاقه</h2>
                            <h2 class="library-more">
                                <a href="{{ route('user.follow_writers',[$userProfile->id,$userProfile->name]) }}">
                                    <span class="more-icon fas fa-plus"></span>
                                    بیشتر
                                </a>
                            </h2>
                        </div>
                        <div class="category-books-section profile-writer-carousel owl-carousel">
                            @foreach($followWriters as $followWriter)
                                <div class="category-books-col">
                                    <div class="books-col-image">
                                        <img src="{{ getPersonImagePath($followWriter->person->thumbnail) }}"
                                             alt="{{ $followWriter->person->title }}">
                                    </div>
                                    <div class="book-info-box">
                                        <h2 class="book-title"><a href="{{ route('writer.view',[$followWriter->person->id,$followWriter->person->slug]) }}">{{ $followWriter->person->title }}</a></h2>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="category-books-main profile-books-main container profile-writer-container">
                        <div class="library-row-title col-12">
                            <h2 class="library-title">ناشران مورد علاقه</h2>
                            <h2 class="library-more">
                                <a href="{{ route('user.follow_publishers',[$userProfile->id,$userProfile->name]) }}">
                                    <span class="more-icon fas fa-plus"></span>
                                    بیشتر
                                </a>
                            </h2>
                        </div>
                        <div class="category-books-section profile-writer-carousel owl-carousel">
                            @foreach($followOrganizations as $followOrganization)
                                <div class="category-books-col">
                                    <div class="books-col-image">
                                        <img
                                            src="{{ getOrganizationImagePath($followOrganization->organization->thumbnail) }}"
                                            alt="{{ $followOrganization->organization->title }}">
                                    </div>
                                    <div class="book-info-box">
                                        <h2 class="book-title"><a
                                                href="{{ route('organization.view',[$followOrganization->organization->id,$followOrganization->organization->slug]) }}">
                                                {{ $followOrganization->organization->title }}</a></h2>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

        </section>

    </main>
    <script>
        $('.btn-follow').click(function () {
            follow('{{ route("follower.follow") }}', "{{ csrf_token() }}", 0, 0, 0, 0, '{{ $userProfile->id }}');
        });
    </script>
@endsection

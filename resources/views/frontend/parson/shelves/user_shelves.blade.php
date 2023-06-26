@extends('layouts.frontend')
@section('title','قفسه ها')
@section('keywords','')
@section('description','')
@section('open_graph')
    <meta property='og:site_name' content='قفسه ها'>
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
            <div class="kethab-category-container container">
                <h2 class="category-small-title">
                    کتهاب/ قفسه ها
                </h2>
                <!-- filter panels -->
                <div class=" advertising-box">
                    <img src="images/filter-image.png" alt="">
                </div>

                <div class="filter-panels col-md-3">
                    <div class="filter-panels-main">
                        <div class="filter-image-box">
                            <img src="images/filter-image.png" alt="">
                        </div>

                    </div>
                    <!-- filter panels -->
                </div>
                <!-- filter panels -->
                <!-- category books main start -->
                <div class="category-books-main col-md-9 col-12">

                    <!-- category-books-section -->
                    <div
                        class="category-books-section books-section-filter justify-content-md-start justify-content-center">
                        <div class="category-main-box">
                            <div class="library-row-title col-12">
                                <h2 class="library-title">قفسه ها</h2>

                            </div>
                            <div class="category-books-section">
                                @foreach($bookShelves as $bookShelf)
                                    <div class="category-books-col col-lg-6 col-sm-6 col-12">

                                        <div class="library-carousel-item">
                                            <div class="shelves-item-title-box">
                                                <h3 class="shelves-item-title-text col-lg-6">{{ $bookShelf->title }}</h3>
                                                <div class="shelves-item-comment-box col-6">
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
                                                        @foreach($books as $book)
                                                            @if($book->shelf->id == $bookShelf->id)
                                                                <div class="book-big-column-col col-3">
                                                                    <img
                                                                        src="{{ getBookImagePath($book->book->thumbnail) }}"
                                                                        alt="{{ $book->book->title }}">
                                                                </div>
                                                            @endif
                                                        @endforeach
                                                    </div>

                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                @endforeach
                            </div>

                        </div>
                        <!-- category-books-section -->
                    </div>
                    {{ $bookShelves->appends($_GET)->links(currentFrontView('pagination')) }}

                </div>
                <!-- category books main -->

        </section>

    </main>
@endsection

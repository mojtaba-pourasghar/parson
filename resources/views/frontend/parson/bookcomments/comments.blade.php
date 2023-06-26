@extends('layouts.frontend')
@section('title','')
@section('keywords','')
@section('description','')
@section('open_graph')
    <meta property='og:site_name' content=''>
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
                    کتهاب/ نقد و نظرات من
                </h2>
                <!-- filter panels -->
                <div class=" advertising-box">
                    <img src="{{ frontendTheme('images/filter-image.png')}}" alt="">
                </div>


                <div class="filter-panels col-md-3">
                    <div class="filter-panels-main">
                        <div class="filter-image-box">
                            <img src="{{ frontendTheme('images/filter-image.png')}}" alt="">
                        </div>

                    </div>
                    <!-- filter panels -->
                </div>

                <!-- filter panels -->

                <!-- category books main start -->
                <div class="category-books-main col-md-9 col-12">

                    <!-- end kethab search   -->
                    <!-- category books header -->
                    <div class="category-books-header filter-book-header">
                        <h3 class="category-books-title">نقد و نظرات من</h3>

                    </div>
                    <!-- category-books-header end -->
                    <!-- category-books-section -->
                    <div class="category-books-section">
                        @foreach($bookcomments as $bookcomment)
                            @include(currentFrontView('partials.bookcomments.user_comments'),['bookcomment'])
                        @endforeach
                    </div>

                    {{ $bookcomments->appends($_GET)->links(currentFrontView('pagination')) }}
                </div>
                <!-- category books main -->

        </section>

    </main>
@endsection

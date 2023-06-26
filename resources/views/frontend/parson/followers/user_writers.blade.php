@extends('layouts.frontend')
@section('title','نویسنده ها')
@section('keywords','')
@section('description','')
@section('open_graph')
    <meta property='og:site_name' content='نویسنده ها'>
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
                    کتهاب/ جستجو
                </h2>
                <!-- filter panels -->
                <div class=" advertising-box">
                    <img src="images/filter-image.png" alt="">
                </div>

                <div class="profile-panels col-md-3">

                    <div class="profile-panels-main">
                        <div class="filter-image-box">
                            <img src="images/filter-image.png" alt="">
                        </div>
                    </div>
                    <!-- filter panels -->
                </div>

                <!-- category books main start -->
                <div class="category-books-main profile-main col-md-9 col-12">


                    <!-- category-books-section -->
                    <div
                        class="category-books-section books-section-filter justify-content-md-start justify-content-center">
                        <div class="category-books-section">
                            @foreach($followPersons as $followPerson)
                                <div class="writer-books-col col-lg-2 col-4 ">
                                    <div class="books-col-image">
                                        <img src="{{ getPersonImagePath($followPerson->person->thumbnail) }}" alt="{{ $followPerson->person->title }}">
                                    </div>
                                    <div class="book-info-box">
                                        <h2 class="writer-title"><a href="{{ route('writer.view',[$followPerson->person->id,$followPerson->person->slug]) }}">{{ $followPerson->person->title }}</a></h2>

                                    </div>
                                </div>
                            @endforeach
                        </div>

                        {{ $followPersons->appends($_GET)->links(currentFrontView('pagination')) }}
                    </div>


                </div>
                <!-- category books main -->

        </section>

    </main>
@endsection

@extends('layouts.frontend')
@section('title',($person_role_id == getConstant('person_role.translator')) ? __('person.translators'):__('person.writers'))
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

            <!-- kethab category container start -->
            <div class="kethab-category-container container">
                <!-- category section -->
                <div class="kethab-category-content col-12">
                    <h2 class="category-small-title">
                        کتهاب/ {{($person_role_id == getConstant('person_role.translator')) ? __('person.translators'):__('person.writers')}}
                    </h2>
                    <h1 class="category-main-title">لیست کل {{ ($person_role_id == getConstant('person_role.translator')) ? __('person.translators'):__('person.writers') }}</h1>
                    <h3 class="category-short-explanation">
                        نمی دانم از کجا شروع کنم؟ انواع ژانر های کتاب را مرور کنید و خواندن
                        عالی بعدی خود را پیدا کنید
                    </h3>
                </div>
                <!-- category section -->
            </div>
            <!-- start kethab search -->
            <div class="kethab-search-container container">

                <div class="search-box col-12">
                    {!! Form::model('', [
                           'route' => ($person_role_id == getConstant('person_role.translator')) ? ['translators.search'] : ['writers.search'],
                           'method' => 'get'] ) !!}

                    <div class="search-box-control">
                        <input type="search" class="form-control search-control" name="title" value="{{ $title }}">
                        <button type="submit" class="btn btn-danger btn-search-box">جستجو</button>
                    </div>
                    <div class="search-alphabet-box">
                        @foreach(getConstant('persianAlphabet') as $element)
                            <label class="alphabet-name">
                                <a href="{{ ($person_role_id == getConstant('person_role.translator')) ? route('translators.search').'?alphabet='.$element :
                                route('writers.search').'?alphabet='.$element }}">
                                    {{ $element }}
                                </a>
                            </label>
                        @endforeach
                    </div>
                    {!! Form::close() !!}
                </div>

            </div>
            <!-- end kethab search   -->
            <!-- genre main box -->
            <div class="genre-main-box container">
                <h2 class="genre-title-box">حرف {{ $alphabet }}</h2>
                <div class="genre-content-box">
                    <div class="genre-content-col col-md-3 col-sm-4 col-8 align-items-md-start align-items-center">
                        @php
                            $counter = 1;
                        @endphp
                        @foreach($persons as $key=> $person)
                            <h3 class="genre-col-name"><a
                                    href="{{ ($person_role_id == getConstant('person_role.translator')) ? route('translator.view',[$person->id,$person->slug]) : route('writer.view',[$person->id,$person->slug]) }}">{{$person->title}}</a>
                            </h3>
                            @if ($counter==20)
                                @break
                            @endif
                        @endforeach
                    </div>
                    <div class="genre-content-col col-md-3 col-sm-4 col-8 align-items-center">
                        @foreach($persons as $person)
                            @if ($counter>=20 && $counter<40)
                                <h3 class="genre-col-name"><a
                                        href="{{ ($person_role_id == getConstant('person_role.translator')) ? route('translator.view',[$person->id,$person->slug]) : route('writer.view',[$person->id,$person->slug]) }}">{{$person->title}}</a>
                                </h3>
                            @endif
                            @if ($counter==40)
                                @break
                            @endif
                        @endforeach
                    </div>
                    <div class="genre-content-col col-md-3 col-sm-4 col-8 align-items-center">
                        @foreach($persons as $person)
                            @if ($counter>=40 && $counter<60)
                                <h3 class="genre-col-name"><a
                                        href="{{ ($person_role_id == getConstant('person_role.translator')) ? route('translator.view',[$person->id,$person->slug]) : route('writer.view',[$person->id,$person->slug]) }}">{{$person->title}}</a>
                                </h3>
                            @endif
                            @if ($counter==60)
                                @break
                            @endif
                        @endforeach
                    </div>
                    <div class="genre-content-col col-md-3 col-sm-4 col-8 align-items-md-end align-items-center">
                        @foreach($persons as $person)
                            @if ($counter>=60 && $counter<80)
                                <h3 class="genre-col-name"><a
                                        href="{{ ($person_role_id == getConstant('person_role.translator')) ? route('translator.view',[$person->id,$person->slug]) : route('writer.view',[$person->id,$person->slug]) }}">{{$person->title}}</a>
                                </h3>
                            @endif
                            @if ($counter==80)
                                @break
                            @endif
                        @endforeach
                    </div>

                    {{ $persons->appends($_GET)->links(currentFrontView('pagination')) }}
                </div>
            </div>
        </section>

    </main>
@endsection

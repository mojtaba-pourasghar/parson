@extends('layouts.activity')
@section('title','پرسون')
@section('keywords','')
@section('description','')
@section('open_graph')
    @include(currentFrontView('partials.open_graph'),['title'=>'پرسون','description'=>'','image'=>''])
@endsection
@section('header_title',__('faq.faqs'))
@section('back_url',route('user.setting'))
@php
    $has_basket = true;
@endphp
@section('content')

    <link rel="stylesheet" href="{{ frontendTheme('js/scroll-box/jquery.mCustomScrollbar.css') }}">
    <main>
        <div class="default-full-container">
            <div class="faq-box">
                @foreach($faqs as $faq)
                    <div class="question-box">
                        <div class="question-title-box">
                            <div class="question-title">
                                {{ $faq->question }}
                            </div>
                            <span href="#" class="faq-btn active">

                        <i class="icon icon-Roll-down"></i></span>
                        </div>
                        <div class="question-panel">
                            <div class="answer-text">
                                {!! $faq->present()->answerHtml  !!}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </main>

    <script src="{{ frontendTheme('js/scroll-box/jquery.mCustomScrollbar.concat.min.js') }}"></script>
    <script src="{{ frontendTheme('js/faq.js') }}"></script>
@endsection

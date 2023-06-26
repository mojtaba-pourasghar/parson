@extends('layouts.frontend')
@section('title','پرسون')
@section('keywords','')
@section('description','')
@section('open_graph')
    @include(currentFrontView('partials.open_graph'),['title'=>'پرسون','description'=>'','image'=>''])
@endsection
@section('content')

    <link rel="stylesheet" href="{{ frontendTheme('js/scroll-box/jquery.mCustomScrollbar.css') }}">
    <main>
        <section>
            <div class="main-content-box">
                <div class="default-title-box site-map">
                    <h2 class="default-title">
                        <a href="{{ route('home') }}">صفحه نخست
                            <span class="default-title-icon">
                        <i class="fal fa-angle-left"></i>
                       </span>
                        </a>
                        <a href="#">@lang('faq.faqs')</a>

                    </h2>
                </div>
            </div>
            <div class="main-full-container">
                <div class="faq-main-box">
                    <a href="#" class="faq-header-box">
                        <h2 class="faq-title">@lang('faq.faqs')</h2>
                    </a>
                    <div class="faq-main-section mCustomScrollbar">
                        @php
                            $a=array("purple-border","red-border","yellow-border");
                        @endphp
                        @foreach($faqs as $faq)
                            @php
                                $random_keys=array_rand($a,1);

                            @endphp
                            <div class="question-box {{ $a[$random_keys] }} ">
                                <div class="question-title-box">
                                    <div class="question-title">
                                        {{ $faq->question }}
                                    </div>
                                    <span href="#" class="faq-btn">
                                      <i class="icon icon-Roll-down"></i>
                                  </span>
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

            </div>

        </section>
    </main>

    <script src="{{ frontendTheme('js/scroll-box/jquery.mCustomScrollbar.concat.min.js') }}"></script>
    <script src="{{ frontendTheme('js/faq.js') }}"></script>
@endsection

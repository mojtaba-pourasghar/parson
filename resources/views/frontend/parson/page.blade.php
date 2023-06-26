@extends('layouts.frontend')
@section('title',$page->title)
@section('open_graph')
    @include(currentFrontView('partials.open_graph'),['title'=>$page->title,'description'=>$page->title,'image'=>''])
@endsection
@section('content')


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
                        <a href="#"> درباره ما</a>

                    </h2>
                </div>
            </div>
            <div class="main-full-container">
                <div class="about-main-box">
                    @if($page->view)
                        {!! $page->view->render() !!}
                    @else
                        {!! $page->present()->contentHtml !!}
                    @endif
                </div>

            </div>

        </section>
    </main>
@endsection

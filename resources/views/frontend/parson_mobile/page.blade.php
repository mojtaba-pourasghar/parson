@extends('layouts.activity')
@section('title',$page->title)
@section('open_graph')
    @include(currentFrontView('partials.open_graph'),['title'=>$page->title,'description'=>$page->title,'image'=>''])
@endsection
@section('header_title', $page->title )
@section('back_url',route('user.setting'))
@php
    $has_basket = true;
@endphp
@section('content')

    <div class="default-full-container">
        <h1 class="default-top-title">{{ $page->title  }}</h1>
        <div class="default-content-text">

            @if($page->view)
                {!! $page->view->render() !!}
            @else
                {!! $page->present()->contentHtml !!}
            @endif

        </div>
    </div>

@endsection

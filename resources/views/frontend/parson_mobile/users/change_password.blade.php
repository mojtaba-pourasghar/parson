@extends('layouts.activity')
@section('title','پرسون')
@section('keywords','')
@section('description','')
@section('open_graph')
    @include(currentFrontView('partials.open_graph'),['title'=>'پرسون','description'=>'','image'=>''])
@endsection
@section('header_title',__('user.change_password'))
@section('back_url',route('user.setting'))
@php
    $has_basket = false;
@endphp
@section('content')
    <main>
        <div class="default-full-container ">

            <div class="main-form-box">

                {!! Form::model(null, ['route' => ['user.change_password'] ,'method' => 'put' ,'class' => 'main-form'] ) !!}
                @include('partials.flash-message')
                <div class="form-group-box">
                    <label class="label-control">@lang('user.current_password')</label>
                    <input type="password" class="input-control" name="old_password">
                </div>
                <div class="form-group-box confrim-input-box">
                    <label class="label-control">@lang('user.new_password')</label>
                    <input type="password" class="input-control" name="password">
                </div>
                <div class="form-group-box confrim-input-box">
                    <label class="label-control">@lang('user.confirm_new_password')</label>
                    <input type="password" class="input-control" name="confirm_password">
                </div>
                <div class="form-group-box justify-content-center">
                    <button class="submit-btn" type="submit">@lang('message.save')</button>
                </div>

                {!! Form::close() !!}
            </div>
        </div>
    </main>

    <script src="{{ frontendTheme('js/chang-password.js') }}"></script>

@endsection

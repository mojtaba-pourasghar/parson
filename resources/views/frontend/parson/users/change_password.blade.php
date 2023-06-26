@extends('layouts.frontend')
@section('title','پرسون')
@section('keywords','')
@section('description','')
@section('open_graph')
    @include(currentFrontView('partials.open_graph'),['title'=>'پرسون','description'=>'','image'=>''])
@endsection
@section('content')
    <main>
        <section>
            <div class="main-content-box">
                <div class="default-title-box site-map">
                    <h2 class="default-title">
                        <a href="{{ route('home') }}">@lang('message.home')
                            <span class="default-title-icon">
                        <i class="fal fa-angle-left"></i>
                       </span>
                        </a>
                        <a href="#">@lang('user.change_password')</a>

                    </h2>
                </div>
            </div>
            <div class="main-full-container">
                <!-- start profile main  -->

                <div class="profile-main">
                    @include(currentFrontView('partials.users.edit_profile_right_menu'),['active'=>'change_password'])

                    <div class="profile-main-content column-7">
                        @include('partials.flash-message')
                        <div class="profile-content-box change-password-main">
                            <div class="content-title-box">
                                <h3 class="content-title">@lang('user.change_password')</h3>
                            </div>
                            {!! Form::model(null, ['route' => ['user.change_password'] ,'method' => 'put' ,'class' => 'change-password-form'] ) !!}
                            <div class="change-password-row">
                                <label for="" class="change-password-title">@lang('user.current_password')</label>
                                <div class="password-edit-box">
                                    <input type="password" class="password-change-input" name="old_password">
                                </div>
                            </div>
                            <div class="change-password-row">
                                <label for="" class="change-password-title">@lang('user.new_password')</label>
                                <div class="password-edit-box pwd-icon">
                                    <span class="icon icon-eye-crossed field-icon toggle-password"></span>
                                    <input type="password" class="password-change-input input-pwd" name="password">
                                </div>
                                <span class="input-check-true">
                                        <i class="icon icon-checkbox"></i>
                                    </span>
                            </div>
                            <div class="change-password-row">
                                <label for="" class="change-password-title">@lang('user.confirm_new_password')</label>
                                <div class="password-edit-box pwd-icon">
                                    <span class="icon icon-eye-crossed field-icon toggle-password"></span>
                                    <input type="password" class="password-change-input input-pwd"
                                           name="confirm_password">
                                </div>
                                <span class="input-check-true">
                                        <i class="icon icon-checkbox"></i>
                                    </span>
                            </div>

                            <div class="password-submit-row">
                                <input type="submit" value="@lang('message.save')" class="password-submit"/>
                            </div>

                            {!! Form::close() !!}

                        </div>

                    </div>

                </div>

                <!-- end profile main  -->
                <!-- start subscript  -->
            @include(currentFrontView('partials.subscription'))
            <!-- end subscript  -->
            </div>

        </section>
    </main>

    <script src="{{ frontendTheme('js/chang-password.js') }}"></script>

@endsection

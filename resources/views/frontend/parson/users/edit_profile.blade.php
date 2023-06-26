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
                        <a href="#">@lang('user.edit_profile')</a>

                    </h2>
                </div>
            </div>
            <div class="main-full-container">
                <!-- start profile main  -->
                {!! Form::model($user, ['route' => ['user.edit'] ,'method' => 'put' ,'class' => 'profile-form','files'=>'true'] ) !!}
                    <div class="profile-main">
                        @include(currentFrontView('partials.users.edit_profile_right_menu'),['active'=>'edit'])
                        <div class="profile-main-content column-7">
                            <div class="profile-content-box">
                                @include('partials.flash-message')
                                <div class="content-title-box">
                                    <h3 class="content-title">اطلاعات شخصی</h3>
                                </div>
                                <div class="profile-row-box row-two-column">
                                    <div class="profile-column-box column-6">
                                        <div class="column-box-title">
                                            <h3 class="title">نام و نام خانوادگی</h3>
                                        </div>
                                        <div class="column-box-info">
                                            <h4 class="info-text">
                                                <input type="text" class="info-input" name="name" value="{{ $user->name }}"
                                                       placeholder="">
                                            </h4>
                                        </div>
                                    </div>
                                    <!--<div class="profile-column-box column-6">
                                        <div class="column-box-title">
                                            <h3 class="title">نام کاربری</h3>
                                        </div>
                                        <div class="column-box-info">
                                            <h4 class="info-text">
                                                <input type="text" class="info-input" name="user_name"
                                                       value="{{ $user->user_name }}" placeholder="">
                                            </h4>

                                        </div>
                                    </div>-->
                                </div>
                                <div class="profile-row-box row-two-column">
                                    <div class="profile-column-box column-6">
                                        <div class="column-box-title">
                                            <h3 class="title">شماره تلفن همراه</h3>
                                        </div>
                                        <div class="column-box-info">
                                            <h4 class="info-text">
                                                <input type="text" class="info-input" name="mobile"
                                                       value="{{ $user->mobile }}" placeholder="">
                                            </h4>

                                        </div>
                                    </div>
                                    <div class="profile-column-box column-6">
                                        <div class="column-box-title">
                                            <h3 class="title">پست الکترونیکی</h3>
                                        </div>
                                        <div class="column-box-info">
                                            <h4 class="info-text">
                                                <input type="email" class="info-input" name="email"
                                                       value="{{ $user->email }}" style="width:300px" placeholder="">
                                            </h4>

                                        </div>
                                    </div>

                                </div>
                                <!--<div class="profile-row-box row-two-column">

                                    <div class="profile-column-box column-6">
                                        <div class="column-box-title">
                                            <h3 class="title">اعتبار کیف پول</h3>
                                        </div>
                                        <div class="column-box-info">
                                            <h4 class="info-text">0 سکه</h4>

                                        </div>
                                    </div>

                                </div>-->
                                <div class="save-info-box">
                                    <div class="important-description-box">
                                        <h3 class="important-description">
                                            <span class="info-box"><i class="icon icon-info"></i></span>
                                            برای ذخیره شدن تغییرات بر روی دکمه ذخیره اطلاعات کلیک کنید.
                                        </h3>
                                    </div>

                                    <input type="submit" class="profile-button" value="ذخیره اطلاعات">
                                </div>

                            </div>

                        </div>
                    </div>
                {!! Form::close() !!}
            <!-- end profile main  -->
            <!-- start subscript  -->
                @include(currentFrontView('partials.subscription'))
            <!-- end subscript  -->
            </div>

        </section>
    </main>
@endsection

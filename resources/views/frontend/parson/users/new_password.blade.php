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
                        <a href="#">درخواست گذرواژه جدید</a>

                    </h2>
                </div>
            </div>
            <div class="main-full-container">
                <div class="reg-nav-box">
                    <div class="reg-nav-item "><a href="{{ route('register') }}">@lang('user.register')</a></div>
                    <div class="reg-nav-item "><a href="{{ route('login') }}">@lang('user.login')</a></div>
                    <div class="reg-nav-item active"><a href="{{ route('user.new_password') }}">درخواست گذرواژه جدید</a>
                    </div>
                </div>
                <div class="main-form-box singup-form-box">

                    <div class="form-column-box column-6">
                        @include('partials.flash-message')
                        <h3 class="form-column-title">با استفاده از شماره موبایل</h3>
                        <h4 class="form-column-subtitle">رمز عبور جدید به شماره موبایل شما ارسال خواهد شد.</h4>

                        {!! Form::model(null, ['route' =>['user.send_password'] ,'method' => 'post' ,'class' => 'main-form'] ) !!}

                        <div class="form-group-box form-2-cols">
                            <label class="label-control column-5">شماره موبایل
                                <span class="form-star">*</span>
                            </label>
                            <input type="text" name="mobile" class="input-control column-7" placeholder="..........09">
                        </div>
                        <div class="singup-submit-box send-code">
                            <button type="submit" class="singup-submit" >ارسال کد</button>
                        </div>
                        {!! Form::close() !!}


                    </div>
                    <div class="form-column-box column-6">

                        {!! Form::model(null, ['route' =>['user.new_password'] ,'method' => 'post' ,'class' => 'main-form'] ) !!}
                        <div class="form-group-box form-2-cols">
                            <label class="label-control column-5">شماره موبایل
                                <span class="form-star">*</span>
                            </label>
                            <input type="text" name="mobile" class="input-control column-7" placeholder="">
                        </div>
                        <div class="form-group-box form-2-cols">
                            <label class="label-control column-5">کد ارسال شده را وارد نمایید
                                <span class="form-star">*</span>
                            </label>
                            <input type="text" name="confirm_code" class="input-control column-7" >
                        </div>

                        <div class="form-group-box form-2-cols">
                            <label class="label-control column-5">
                                رمز عبور جدید را وارد نمایید
                                <span class="form-star">*</span>
                            </label>
                            <input type="password" name="password" class="input-control column-7">
                        </div>
                        <div class="form-group-box form-2-cols">
                            <label class="label-control column-5">تکرار رمز عبور
                                <span class="form-star">*</span>
                            </label>
                            <input type="password" name="confirm_password" class="input-control column-7">
                        </div>

                        <div class="singup-submit-box">
                            <button type="submit" class="singup-submit"  >ثبت </button>
                        </div>
                        {!! Form::close() !!}

                    </div>

                </div>


            </div>

        </section>
    </main>
    <script src="{{ frontendTheme('js/singup.js') }}"></script>

@endsection

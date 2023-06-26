@extends('layouts.frontend')
@section('title','پرسون')
@section('keywords','')
@section('description','')
@section('content')

    <main>
        <section>
            <div class="main-content-box">
                <div class="default-title-box site-map">
                    <h2 class="default-title">
                        <a href="#">صفحه نخست
                            <span class="default-title-icon">
                        <i class="fal fa-angle-left"></i>
                       </span>
                        </a>
                        <a href="#">ورود</a>

                    </h2>
                </div>
            </div>
            <div class="main-full-container">
                <div class="reg-nav-box">
                    <div class="reg-nav-item"><a href="{{ route('register') }}">@lang('user.register')</a></div>
                    <div class="reg-nav-item active"><a href="{{ route('login') }}">@lang('user.login')</a></div>
                    <div class="reg-nav-item"><a href="{{ route('user.new_password') }}">درخواست گذرواژه جدید</a></div>
                </div>
                <div class="main-form-box singup-form-box">

                    <div class="form-column-box column-6">
                        @include('partials.flash-message')
                        <h3 class="form-column-title">با استفاده از نام کاربری و رمز عبور خود وارد شوید.</h3>


                        {!! Form::model(null, ['route' =>['login'] ,'method' => 'post' ,'class' => 'main-form'] ) !!}
                            <div class="form-group-box form-2-cols">
                                <label class="label-control column-5">نام کاربری
                                    <span class="form-star">*</span>
                                </label>
                                <input type="text" class="input-control column-7" name="mobile" placeholder="شماره موبایل">
                            </div>
                            <div class="form-group-box form-2-cols">
                                <label class="label-control column-5">رمز عبور
                                    <span class="form-star">*</span>
                                </label>
                                <input type="password" name="password" class="input-control column-7">
                            </div>
                            <div class="form-group-box forget-pass">
                                <a href="{{ route('user.new_password') }}" class="forget-pass-link">فراموشی رمز عبور</a>
                            </div>


                            <div class="singup-submit-box">
                                <button type="submit" class="singup-submit">ورود</button>
                            </div>
                        {!! Form::close() !!}


                    </div>
                    <div class="form-column-box column-6">
                        <div class="form-help-box">
                            <h3 class="form-column-title">برای تکمیل فرایند خرید خود ثبت نام کنید.</h3>
                            <div class="singup-link-box">
                                <a href="{{ route('register') }}" class="singup-link">ثبت نام در فروشگاه اینترنتی پرسون</a>
                            </div>
                            <p class="singup-help-text">
                                پس از ثبت نام می توانید به سادگی سفارش خود را ثبت کنید، سفارش را پیگیری کنید و تاریخچه
                                خرید خود را مشاهده
                                کنید.

                            </p>
                        </div>

                    </div>

                </div>


            </div>

        </section>
    </main>

@endsection

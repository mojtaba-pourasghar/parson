@extends('layouts.frontend')
@section('title','کتهاب')
@section('keywords','')
@section('description','')
@section('content')

    <main>
        <section>
            <div class="main-content-box">
                <div class="default-title-box site-map">
                    <h2 class="default-title">
                        <a href="{{route("home")}}">صفحه نخست
                            <span class="default-title-icon">
                        <i class="fal fa-angle-left"></i>
                       </span>
                        </a>
                        <a href="#">ثبت نام</a>

                    </h2>
                </div>
            </div>
            <div class="main-full-container">
                <div class="reg-nav-box">
                    <div class="reg-nav-item active"><a href="{{ route('register') }}">@lang('user.register')</a></div>
                    <div class="reg-nav-item "><a href="{{ route('login') }}">@lang('user.login')</a></div>
                    <div class="reg-nav-item"><a href="{{ route('user.new_password') }}">درخواست گذرواژه جدید</a></div>
                </div>
                <div class="main-form-box singup-form-box">

                    <div class="form-column-box column-6">
                        @include('partials.flash-message')
                        <h3 class="form-column-title">برای تکمیل فرایند خرید خود ثبت ‌نام کنید.</h3>


                            {!! Form::open() !!}
                            @csrf
                            <div class="form-group-box form-2-cols">
                                <label class="label-control column-5">@lang('user.mobile')
                                    <span class="form-star">*</span>
                                </label>
                                <input type="text" class="input-control column-7" name="mobile" placeholder="........۰۹۱۲">
                            </div>
                            <div class="form-group-box form-2-cols">
                                <label class="label-control column-5">@lang('user.password')
                                    <span class="form-star">*</span>
                                </label>
                                <input type="password" name="password" class="input-control column-7">
                            </div>
                            <div class="form-group-box form-2-cols">
                                <label class="label-control column-5">@lang('user.password_confirmation')
                                    <span class="form-star">*</span>
                                </label>
                                <input type="password" name="password_confirmation" class="input-control column-7">
                            </div>
                            <div class="singup-message-box">
                                <div class="singup-message-row">
                                    <h3 class="singup-message-text">یک گذرواژه در هر دو فیلد بنویسید.</h3>
                                </div>
                                <div class="singup-message-row singup-rules">
                                    <h3 class="singup-message-text">
                                        <label class="rules-check-box">
                                            <input type="checkbox" class="rules-check-input" placeholder="" value=""
                                                   id="check-rule">
                                            <span class="checkmark"></span>

                                        </label>
                                        من قوانین و شرایط خدمات سایت را خواندم و میپذیرم
                                    </h3>
                                </div>
                            </div>
                            <div class="singup-submit-box">
                                <button type="submit" class="singup-submit" disabled="disabled">ثبت نام</button>
                            </div>
                            {!! Form::close() !!}



                    </div>
                    <div class="form-column-box column-6">
                        <div class="form-help-box singup-help">
                            <p>
                                مزایا ثبت نام
                                <br/>
                                با تکمیل ثبت نام
                                <a href="#">شرایط</a>
                                و
                                <a href="#">قوانین</a>
                                را پذیرفته اید.
                                <br>
                                مشاهده تاریخچه خرید و پیگیری سفارش ها
                                <br>
                                ایجاد لیست محصولات مورد علاقه و آگاهی از موجودی و قیمت
                                <br>
                                نوشتن نقد و تحلیل در مورد محصول و تبادل نظر با سایر خریداران
                                <br>
                                آگاهی از برنامه های فروش و تخفیف ها


                            </p>
                        </div>

                    </div>

                </div>

                <!-- start subscript  -->
                <div class="subscription-box">
                    <h3 class="subscription-title">
                        برای اطلاع از آخرین تخفیف ها و جدید ترین کالا ها در خبرنامه ثبت نام کنید
                    </h3>
                    <form action="#" class="subscription-form">
                        <input type="text" name="input" class="subscript-input"
                               placeholder=" شماره موبایل خود را وارد نمایید">
                        <button type="submit" class="submit-btn">
                            ثبت نام
                        </button>
                    </form>
                </div>
                <!-- end subscript  -->

            </div>

        </section>
    </main>
    <script src="{{ frontendTheme('js/singup.js') }}"></script>

@endsection

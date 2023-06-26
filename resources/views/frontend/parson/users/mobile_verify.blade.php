@extends('layouts.frontend')
@section('title',__('user.mobile_verify'))
@section('keywords','')
@section('description','')
@section('open_graph')
    @include(currentFrontView('partials.open_graph'),['title'=>__('user.mobile_verify'),'description'=>'','image'=>''])
@endsection
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
                        <a href="#">کد فعال سازی</a>

                    </h2>
                </div>
            </div>
            <div class="main-full-container">
                <div class="main-form-box">

                    <div class="form-column-box column-6">
                        <h3 class="form-column-title">تایید شماره موبایل</h3>
                        <h4 class="form-column-subtitle">کد فعال سازی که در تلفن همراه خود دریافت کرده اید را وارد نمایید</h4>
                        {!! Form::model(null, ['route' =>['user.mobile_verify', $mobile] ,'method' => 'put' ,'class' => 'main-form','files'=>'true'] ) !!}
                            <div class="form-group-box form-3-cols">
                                <label class="label-control column-3">کد فعال سازی</label>
                                <input type="text" class="input-control column-6" name="mobile_confirmation" maxlength="5">
                                <input type="submit" class="form-submit" value="فعال سازی">
                            </div>
                        {!! Form::close() !!}


                    </div>
                    <div class="form-column-box column-6">
                        <div class="form-help-box">
                            <p>
                                کد فعالسازی را دریافت نکرده اید؟
                                <br/>
                                آیا شماره 09358440750 درست است؟ اگر نیست، برای ویرایش شماره
                                <a href="#">اینجا</a>
                                کلیک کنید.
                                <br>
                                اگر بعد از 5 دقیقه هنوز کد فعال سازی را دریافت نکرده‌اید، برای ارسال مجدد
                                <a href="#">اینجا</a>
                                کلیک کنید.


                            </p>
                        </div>

                    </div>

                </div>

                <!-- start subscript  -->
                <div class="subscription-box">
                    <h3 class="subscription-title">
                        برای اطلاع از آخرین تخفیف ها و جدید ترین کالا ها در خبرنامه ثبت نام کنید
                    </h3>
                    <form action="#" class= "subscription-form">
                        <input type="text" name="input" class="subscript-input" placeholder=" شماره موبایل خود را وارد نمایید">
                        <button type="submit" class="submit-btn">
                            ثبت نام
                        </button>
                    </form>
                </div>
                <!-- end subscript  -->

            </div>

        </section>
    </main>


@endsection

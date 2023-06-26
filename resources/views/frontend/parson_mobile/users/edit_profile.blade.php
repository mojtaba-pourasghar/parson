@extends('layouts.activity')
@section('title','پرسون')
@section('keywords','')
@section('description','')
@section('open_graph')
    @include(currentFrontView('partials.open_graph'),['title'=>'پرسون','description'=>'','image'=>''])
@endsection
@section('header_title','اطلاعات شخصی')
@section('back_url',route('home'))
@php
    $has_basket = true;
@endphp
@section('content')

    <main>
        <!-- start profile tab content  -->
        <div class="main-tab-content" id="profile-tab">

            <div class="profile-container">
                <div class="profile-main-box">
                    <div class="profile-user-row">
                        <div class="profile-thumbnail-box">
                            <div class="user-detail-main">
                                <!--<a href="#" class="profile-image-box">
                                    <img src="{{ $loginUser->image }}" alt="{{ $loginUser->name }}">
                                </a>-->

                            </div>
                        </div>
                    </div>
                    <div class="profile-form-box">

                        <div class="group-pr-form">
                            <div class="pr-box-top">
                                <h3 class="pr-box-title"><span class="pr-title">نام و نام خانوادگی</span> :</h3>
                                <span class="edit-btn" data-toggle="modal" data-target="#pruser">
                                <i class="icon icon-edit"></i>
                            </span>
                            </div>
                            <div class="pr-box-bottom">
                                <input type="text" id="name_place" maxlength="20" class="edit-input" value="{{ $loginUser->name }}" disabled>
                            </div>
                        </div>

                        <!--<div class="group-pr-form">
                            <div class="pr-box-top">
                                <h3 class="pr-box-title"><span class="pr-title">نام کاربری</span> :</h3>
                                <span class="edit-btn" data-toggle="modal" data-target="#pruser_name">
                                <i class="icon icon-edit"></i>
                            </span>
                            </div>
                            <div class="pr-box-bottom">
                                <input type="text" id="user_name_place" maxlength="15" class="edit-input" value="{{ $loginUser->user_name }}" disabled>
                            </div>
                        </div>-->

                        <div class="group-pr-form">
                            <div class="pr-box-top">
                                <h3 class="pr-box-title"><span class="pr-title">شماره موبایل</span> :</h3>
                                <span class="edit-btn" data-toggle="modal" data-target="#prmobile">
                                    <i class="icon icon-edit"></i>
                                </span>
                            </div>
                            <div class="pr-box-bottom">
                                <input type="text" id="mobile_place" maxlength="12" class="edit-input" value="{{ $loginUser->mobile }}" disabled>
                            </div>
                        </div>

                        <div class="group-pr-form">
                            <div class="pr-box-top">
                                <h3 class="pr-box-title"><span class="pr-title">پست الکترونیکی</span> :</h3>
                                <span class="edit-btn" data-toggle="modal" data-target="#premail">
                                <i class="icon icon-edit"></i>
                            </span>
                            </div>
                            <div class="pr-box-bottom">
                                <input type="email" id="email_place" maxlength="30" class="edit-input" value="{{ $loginUser->email }}" disabled>
                            </div>
                        </div>

                    </div>


                </div>
            </div>


        </div>
        <div class="modal fade modal-profile" id="pruser" role="dialog" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="title-edit-modal">
                        <h3 class="title-edit">
                            <span class="main-title"></span>نام خود را وارد کنید
                        </h3>
                    </div>
                    <input type="text" maxlength="20" class="input-edit" id="name_value">
                    <div class="modal-btn-row">
                        <button class="modal-btn" id="btn_save_name" data-dismiss="modal" aria-label="Close">ذخیره
                        </button>
                        <button class="modal-btn reset-btn" data-dismiss="modal" aria-label="Close">لغو</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade modal-profile" id="pruser_name" role="dialog" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="title-edit-modal">
                        <h3 class="title-edit">
                            <span class="main-title"></span>نام کاربری خود را وارد کنید
                        </h3>
                    </div>
                    <input type="text" maxlength="15" class="input-edit" id="user_name_value">
                    <div class="modal-btn-row">
                        <button class="modal-btn" id="btn_save_user_name" data-dismiss="modal" aria-label="Close">ذخیره
                        </button>
                        <button class="modal-btn reset-btn" data-dismiss="modal" aria-label="Close">لغو</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade modal-profile" id="prmobile" role="dialog" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="title-edit-modal">
                        <h3 class="title-edit">
                            <span class="main-title"></span>
                            شماره موبایل خود را وارد کنید
                        </h3>
                    </div>
                    <input type="number" maxlength="12" class="input-edit" id="mobile_value">
                    <div class="modal-btn-row">
                        <button class="modal-btn" id="btn_save_mobile" data-dismiss="modal" aria-label="Close">ذخیره
                        </button>
                        <button class="modal-btn reset-btn" data-dismiss="modal" aria-label="Close">لغو</button>
                    </div>

                </div>
            </div>
        </div>

        <div class="modal fade modal-profile" id="premail" role="dialog" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="title-edit-modal">
                        <h3 class="title-edit">
                            <span class="main-title"></span>
                            پست الکترونیک خود را وارد کنید
                        </h3>
                    </div>
                    <input type="email" maxlength="30" class="input-edit" id="email_value">
                    <div class="modal-btn-row">
                        <button class="modal-btn" id="btn_save_email" data-dismiss="modal" aria-label="Close">ذخیره
                        </button>
                        <button class="modal-btn reset-btn" data-dismiss="modal" aria-label="Close">لغو</button>
                    </div>

                </div>
            </div>
        </div>

    </main>
    <script src="{{ frontendTheme('js/profile.js') }}"></script>
    <script>

        $('#btn_save_name').click(function () {
            edit_field('name', $('#name_value').val(), 'name_place');
        });

        $('#btn_save_user_name').click(function () {
            edit_field('user_name', $('#user_name_value').val(), 'user_name_place');
        });

        $('#btn_save_mobile').click(function () {
            edit_field('mobile', $('#mobile_value').val(), 'mobile_place');
        });

        $('#btn_save_email').click(function () {
            edit_field('email', $('#email_value').val(), 'email_place');
        });

        function edit_field(field, value, place) {

            var url = '{{ route("user.edit_single") }}';
            openLoading();
            $.ajax({
                url: url,
                type: 'post',
                cache: false,
                data: {
                    "_token": '{{ csrf_token() }}',
                    'field': field,
                    'value': value,
                },
                datatype: 'json',
                beforeSend: function () {
                },
                success: function (data) {
                    if (data.success) {
                        toastr.success(data.message);
                        $('#' + place).val(data.text);
                    } else {
                        toastr.error(data.message);
                    }
                    closeloading();
                },
                error: function (xhr, textStatus, thrownError) {
                    toastr.error(__the_operation_failed);
                    closeloading();
                }
            });
        }

    </script>
@endsection

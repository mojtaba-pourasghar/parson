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
                        <a href="#">@lang('order.list')</a>

                    </h2>
                </div>
            </div>
            <div class="main-full-container">
                <!-- start profile main  -->

                <div class="profile-main">
                    @include(currentFrontView('partials.users.edit_profile_right_menu'),['active'=>'addresses'])
                    <div class="profile-main-content column-7">
                        <div class="profile-content-box">
                            <div class="content-title-box">
                                <h3 class="content-title">آدرس</h3>
                            </div>
                            @foreach($userdetails as $userdetail)
                                <div class="profile-row-box row-one-column">
                                    <div class="profile-column-box">
                                        <div class="column-box-address">
                                            <h3 class="address-text">
                                                <label class="radio-box">
                                                    <input type="radio" value="{{ $userdetail->id }}" name="address" {{ ($userdetail->selected==1) ? 'checked':'' }} >
                                                    <span class="checkmark"></span>
                                                </label>
                                                {{ $userdetail->address }}
                                            </h3>
                                        </div>
                                        <div class="column-box-info">
                                            <span class="info-icon-box"><i class="icon icon-mailbox"></i></span>
                                            <h4 class="info-add-text">{{ $userdetail->post_code }}</h4>

                                        </div>
                                        <div class="column-box-info">
                                            <span class="info-icon-box"><i class="icon icon-smart-phone"></i></span>
                                            <h4 class="info-add-text">{{ $userdetail->telephon }}</h4>

                                        </div>
                                        <div class="column-box-info">
                                            <span class="info-icon-box"><i class="icon icon-user"></i></span>
                                            <h4 class="info-add-text">{{ $userdetail->recipient_name }}</h4>
                                        </div>
                                        <div class="column-edit-address">
                                            <a href="{{ route('userdetail.edit',$userdetail->id) }}" class="address-edit">ویرایش نشانی</a>
                                            <a href="{{ route('userdetail.delete',$userdetail->id) }}" class="address-delete">
                                                حذف
                                            </a>
                                        </div>
                                    </div>

                                </div>
                            @endforeach

                            <div class="profile-row-box new-address-row">
                                <div class="content-title-box">
                                    <h3 class="content-title">
                                        <a href="{{ route('userdetail.add') }}">
                                            <span class="location-icon-box">
                                                <i class="icon icon-location"></i>
                                            </span>
                                            اضافه کردن ادرس جدید
                                        </a>
                                    </h3>
                                </div>
                                <a href="#" class="new-add-btn">
                                    <i class="fal fa-angle-left"></i>
                                </a>
                            </div>


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
    <script>
        $("input[name='address']").change(function(){
            openLoading();
            var url = '{{ route("userdetail.select_address") }}';
            $.ajax({
                headers: {headers: {'csrftoken': '{{ csrf_token() }}'}},
                url: url,
                type: 'post',
                cache: false,
                data: {
                    "_token": '{{ csrf_token() }}',
                    'id': $(this).val()
                },
                datatype: 'json',
                beforeSend: function () {
                },
                success: function (data) {
                    if (data.success) {
                        toastr.success(data.message);
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
        });
    </script>
@endsection

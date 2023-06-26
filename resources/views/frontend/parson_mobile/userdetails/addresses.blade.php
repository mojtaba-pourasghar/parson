@extends('layouts.activity')
@section('title','پرسون')
@section('keywords','')
@section('description','')
@section('open_graph')
    @include(currentFrontView('partials.open_graph'),['title'=>'پرسون','description'=>'','image'=>''])
@endsection
@section('header_title',__('user_detail.addresess'))
@section('back_url',route('home'))
@php
    $has_basket = true;
@endphp
@section('content')
    <main>
        <div class="default-full-container">
            <div class="profile-address-main">
                @foreach($userdetails as $userdetail)
                    <div class="address-panel-box">
                        <div class="address-select-box">
                            <label class="radio-box">
                                <input type="radio" value="{{ $userdetail->id }}" name="address" {{ ($userdetail->selected==1) ? 'checked':'' }}>
                                <span class="checkmark"></span>
                            </label>
                        </div>
                        <div class="address-content-box">
                            <div class="address-content-row">
                                <span class="content-title">آدرس:</span>
                                <span class="content-text">{{ $userdetail->address }}</span>
                            </div>
                            <div class="address-content-row">
                                <span class="content-title">کد پستی:</span>
                                <span class="content-text">{{ $userdetail->post_code }}</span>
                            </div>
                            <div class="address-content-row">
                                <span class="content-title">شماره تماس: </span>
                                <span class="content-text">{{ $userdetail->telephon }}</span>
                            </div>
                            <div class="address-content-row">
                                <span class="content-title">گیرنده:</span>
                                <span class="content-text">{{ $userdetail->recipient_name }}</span>
                            </div>
                            <div class="row-edit-address">
                                <a href="{{ route('userdetail.edit',$userdetail->id) }}" class="address-edit">ويرايش نشاني</a>
                                <a href="{{ route('userdetail.delete',$userdetail->id) }}" class="address-delete">
                                    حذف
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="new-address-box">
                    <a href="{{ route('userdetail.add') }}" class="new-address-link">
                        اضافه کردن آدرس جدید
                        <span class="arrow-left">

                      <i class="fal fa-angle-left"></i>
                   </span>
                    </a>
                </div>
            </div>
        </div>
    </main>
    <script>
        $("input[name='address']").change(function () {
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

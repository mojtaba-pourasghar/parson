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
                        @include('partials.flash-message')
                        <div class="profile-content-box">
                            <div class="content-title-box">
                                <h3 class="content-title">
                                    {{ $userDetail->exists ? __('user_detail.edit_address') : __('user_detail.add_address') }}
                                </h3>
                            </div>

                            {!! Form::model($userDetail, [
                        'route' => $userDetail->exists ? ['userdetail.edit', $userDetail->id] : ['userdetail.add'],
                        'method' => $userDetail->exists ? 'put' : 'post','class' => 'form-column-box'] ) !!}
                            <div class="form-group-box">
                                <label class="label-control column-4">نام گیرنده</label>
                                {!! Form::text('recipient_name', null, ['class' => 'input-control column-8']) !!}
                            </div>
                            <div class="form-group-box">
                                <label class="label-control column-4">تلفن همراه</label>
                                {!! Form::text('telephon', null, ['class' => 'input-control column-8']) !!}
                            </div>
                            <div class="form-group-box">
                                <label class="label-control column-4">استان</label>
                                <div class="select-box column-8">
                                    {!! Form::select('province_id',$provinces , $selected_province, ['class' => 'input-control','id'=>'province_id']) !!}
                                </div>

                            </div>
                            <div class="form-group-box">
                                <label class="label-control column-4">شهر</label>
                                <div class="select-box column-8">
                                    <select class="input-control" name="city_id" id="city_id">
                                    </select>
                                </div>
                            </div>
                            <div class="form-group-box">
                                <label class="label-control column-4">آدرس</label>
                                {!! Form::textarea('address', null, ['class' => 'address-control column-8','rows'=>3]) !!}
                            </div>
                            <div class="form-group-box">
                                <label class="label-control column-4">کدپستی</label>
                                {!! Form::text('post_code', null, ['class' => 'input-control column-8']) !!}
                            </div>

                            <div class="form-map-box">
                                <input type="hidden" name="latitude" id="latitude" value="{{ !empty($userDetail->latitude) ? $userDetail->latitude : 0 }}">
                                <input type="hidden" name="longitude" id="longitude" value="{{ !empty($userDetail->longitude) ? $userDetail->longitude : 0 }}">
                                <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
                                <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>

                                <div id="mapid" style="width: 100%; height: 100%;"></div>
                                <script>
                                    var latitude = {{ !empty($userDetail->latitude) ? $userDetail->latitude : 0 }};
                                    var century21icon = L.icon({
                                        iconUrl: "{{ frontendTheme('images/marker.png') }}",
                                        iconSize: [60, 60]
                                    });

                                    var mymap = L.map('mapid').setView([{{ !empty($userDetail->latitude) ? $userDetail->latitude : 35.70163 }},  {{ !empty($userDetail->longitude) ? $userDetail->longitude : 51.39211 }}], 12);
                                    L.tileLayer('https://developers.parsijoo.ir/web-service/v1/map/?type=tile&x={x}&y={y}&z={z}&apikey=02f6631ab9384172a5be082cd165f397', {
                                        maxZoom: 21,
                                    }).addTo(mymap);
                                    if (latitude > 0)
                                        var marker = new L.marker([{{ !empty($userDetail->latitude) ? $userDetail->latitude : 35.70163 }},  {{ !empty($userDetail->longitude) ? $userDetail->longitude : 51.39211 }}], {icon: century21icon}).addTo(mymap);
                                    var counter = 0;
                                    var mapMarkers = [];

                                    function onMapClick(e) {
                                        if (counter == 1) {
                                            for (var i = 0; i < mapMarkers.length; i++) {
                                                mymap.removeLayer(mapMarkers[i]);
                                            }
                                            counter = 0;
                                        }
                                        var marker = new L.Marker([e.latlng.lat, e.latlng.lng], {icon: century21icon}).addTo(mymap);
                                        $('#longitude').val(e.latlng.lng);
                                        $('#latitude').val(e.latlng.lat);
                                        mapMarkers.push(marker);
                                        counter++;
                                    }

                                    mymap.on('click', onMapClick);

                                </script>
                            </div>
                            <div class="submit-box">
                                <input type="submit" class="form-submit" value="ذخیره">
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
    <script>
        function getCities(url, token) {
            $.ajax({
                headers: {headers: {'csrftoken': token}},
                url: url,
                type: 'get',
                cache: false,
                data: ''/*{ 'userid': name}*/, //see the $_token
                datatype: 'html',
                beforeSend: function () {
                },
                success: function (data) {
                    $('#city_id').html(data.html);
                },
                error: function (xhr, textStatus, thrownError) {
                    $('#person_id').html('');
                }
            });
        }

        $('#province_id').on('change', function () {
            var province_id = this.value;
            var url = '{{ route("city.list", [":province_id",":city_id"]) }}';
            url = url.replace(':province_id', province_id);
            url = url.replace(':city_id', 0);
            getCities(url, '{{ csrf_token() }}');
        });
        var url = '{{ route("city.list", [":province_id",":city_id"]) }}';
        var province_id = $("#province_id").val();
        url = url.replace(':province_id', province_id);
        url = url.replace(':city_id', '{{ $userDetail->city_id }}');
        getCities(url, '{{ csrf_token() }}');

    </script>
@endsection

@extends('layouts.activity')
@section('title','پرسون')
@section('keywords','')
@section('description','')
@section('open_graph')
    @include(currentFrontView('partials.open_graph'),['title'=>'پرسون','description'=>'','image'=>''])
@endsection
@section('header_title',$userDetail->exists ? __('user_detail.edit_address') : __('user_detail.add_address'))
@section('back_url',route('userdetail.addresses'))
@php
    $has_basket = true;
@endphp
@section('content')

    <main>
        <div class="default-full-container ">

            <div class="main-form-box">

                {!! Form::model($userDetail, [
                    'route' => $userDetail->exists ? ['userdetail.edit', $userDetail->id] : ['userdetail.add'],
                    'method' => $userDetail->exists ? 'put' : 'post','class' => 'main-form'] ) !!}
                <div class="form-group-box">
                    @include('partials.flash-message')
                </div>
                <div class="form-group-box">
                    <label class="label-control"> نام گیرنده </label>
                    {!! Form::text('recipient_name', null, ['class' => 'input-control input-line']) !!}
                </div>
                <div class="form-group-box">
                    <label class="label-control">شماره تلفن همراه</label>
                    {!! Form::text('telephon', null, ['class' => 'input-control input-line']) !!}
                </div>
                <div class="form-group-box">
                    <label class="label-control"> کد پستی </label>
                    {!! Form::text('post_code', null, ['class' => 'input-control input-line']) !!}
                </div>
                <div class="form-group-box">
                    <label class="label-control"> استان </label>
                    <div class="select-box">
                        {!! Form::select('province_id',$provinces , $selected_province, ['class' => 'input-control input-line','id'=>'province_id']) !!}
                    </div>
                </div>
                <div class="form-group-box">
                    <label class="label-control"> شهر </label>
                    <div class="select-box">

                        <select class="input-control input-line" name="city_id" id="city_id">
                        </select>
                    </div>
                </div>
                <div class="form-group-box">
                    <label class="label-control"> آدرس </label>
                    {!! Form::text('address', null, ['class' => 'input-control input-line','rows'=>3]) !!}
                </div>
                <div class="form-group-box">
                    <label class="label-control"> موقعیت در نقشه </label>
                    <div class="form-location-box">

                        <input type="hidden" name="latitude" id="latitude"
                               value="{{ !empty($userDetail->latitude) ? $userDetail->latitude : 0 }}">
                        <input type="hidden" name="longitude" id="longitude"
                               value="{{ !empty($userDetail->longitude) ? $userDetail->longitude : 0 }}">
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
                </div>

                <div class="form-group-box justify-content-center">
                    <button class="submit-btn" type="submit">ثبت</button>
                </div>

                {!! Form::close() !!}
            </div>
        </div>
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

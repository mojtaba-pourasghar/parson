@extends('layouts.frontend')
@section('title','پرسون')
@section('keywords','')
@section('description','')
@section('open_graph')
    @include(currentFrontView('partials.open_graph'),['title'=>'پرسون','description'=>'','image'=>''])
@endsection
@section('content')
    <link rel="stylesheet" href="{{ frontendTheme('js/persianDatepicker-default.css') }}">

    <main>
        <section>

            <div class="kethab-category-container container">
            @include('partials.flash-message')
                <!-- filter panels -->
            @include(currentFrontView('partials.users.edit_profile_right_menu'))
            <!-- filter panels -->
                <div class="category-books-main profile-main col-md-9 col-12">
                    <div class="profile-form-section">
                        <div class="library-row-title col-12">
                            <h2 class="library-title">@lang('user.change_mobile')</h2>
                        </div>
                        {!! Form::model($user, ['route' => ['user.change_mobile'] ,'method' => 'put' ,'class' => 'profile-form','files'=>'true'] ) !!}

                        <div class="form-group col-lg-6 col-md-8 col-10">
                            {!! Form::label(__('user.mobile'),null,['class' => 'col-lg-8 col-12 col-form-label']) !!}
                            <div class="col-12 col-form-input">
                                {!! Form::text('mobile', null, ['class' => 'form-control']) !!}
                                <label class="col-form-label label-type">@lang('user.secret')</label>
                            </div>
                        </div>

                        <div class="form-group file-button-box col-12 justify-content-center ">
                            <button class="btn btn-danger btn-file-save">@lang('message.save')</button>
                        </div>
                        {!! Form::close() !!}

                    </div>
                </div>

        </section>

    </main>
    <script src="{{ frontendTheme('js/persianDatepicker.js') }}"></script>
    <script src="{{ frontendTheme('js/persianDatepicker.js') }}"></script>
    <script src="{{ frontendTheme('js/lib/profile-dropdown.js') }}"></script>
    <script type="text/javascript">
        $(function () {
            $("#simpleText, #simpleLabel").persianDatepicker({
                formatDate: "YYYY/MM/DD",
                persianNumbers: !0
            });
            $("#selectedBefore").persianDatepicker({selectedBefore: true});
            $("#alwaysShow").persianDatepicker({alwaysShow: true});

        });

        function getFile() {
            document.getElementById("upfile").click();
        }

        function sub(obj) {
            var file = obj.value;
            var fileName = file.split("\\");
            document.getElementById("yourBtn").innerHTML = fileName[fileName.length - 1];
            document.myForm.submit();
            event.preventDefault();
            alert('ff');
        }

        $('input').click(function () {
            $("input").attr("placeholder", "");
        });

        function getCities(province_id, url, token) {
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
            var url = '{{ route("city.list", ":province_id") }}';
            url = url.replace(':province_id', province_id);
            getCities(province_id, url, '{{ csrf_token() }}');
        });
    </script>
@endsection

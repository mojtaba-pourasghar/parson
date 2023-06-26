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
                        <a href="#">@lang('user.change_image')</a>

                    </h2>
                </div>
            </div>
            <div class="main-full-container">
                <!-- start profile main  -->

                <div class="profile-main">
                    @include(currentFrontView('partials.users.edit_profile_right_menu'),['active'=>'change_image'])
                    <div class="profile-main-content column-7">
                        @include('partials.flash-message')
                        <div class="profile-content-box">
                            <div class="content-title-box">
                                <h3 class="content-title">ویرایش تصویر</h3>
                            </div>
                            {!! Form::model(null, ['route' => ['user.change_image'] ,'method' => 'put' ,'files'=>'true','class' => 'content-title-box'] ) !!}
                            <div class="profile-row-box">
                                <div class="profile-column-box">
                                    <div class="profile-uploaud-img">
                                        <div class="custom-upload-box" id="custom_upload" onclick="getFile()">
                                            <div class="upload-custom-img">بارگذاری</div>
                                            <div class="upload-file-pic col-lg-5 col-md-6 align-items-md-start align-items-center">
                                                <img id="profile_image" style="height: 100px;width: 100px;margin-right: 30px;" src="{{ getUserImagePath($user->image) }}"/>
                                            </div>
                                            <div style="height: 0px;width: 0px; overflow:hidden;">
                                                <input id="upfile"
                                                                                                         type="file"
                                                                                                         name="image_file"
                                                                                                         onchange="document.getElementById('profile_image').src = window.URL.createObjectURL(this.files[0])">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="profile-column-box">
                                    <input type="submit" value="@lang('message.save')" class="save-btn"/>
                                </div>

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
        function getFile() {
            document.getElementById("upfile").click();

        }

        function sub(obj) {
            var file = obj.value;
            var fileName = file.split("\\");
            document.getElementById("yourBtn").innerHTML = fileName[fileName.length - 1];
            document.myForm.submit();
            event.preventDefault();
        }
    </script>

@endsection

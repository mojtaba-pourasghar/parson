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
                        <a href="#">ذخیره شده ها </a>

                    </h2>
                </div>
            </div>
            <div class="main-full-container">
                <!-- start profile main  -->
                <div class="profile-main">
                    @include(currentFrontView('partials.users.edit_profile_right_menu'),['active'=>'bookmarks'])
                    <div class="profile-main-content column-7">
                        <div class="profile-content-box">
                            <div class="content-title-box">
                                <h3 class="content-title">ذخیره شده ها</h3>
                            </div>
                            <div class="shop-save-box">
                                <div class="profile-row-box row-two-column">
                                    @foreach($bookmarks as   $bookmark)
                                        <div class="profile-column-box column-6">
                                            <div class="shop-save-col column-4">
                                                <a href="#" class="thumbnail-box">
                                                    <img src="{{ (count($bookmark->textile->images)>0) ? $bookmark->textile->images[0]->image : ''}}" alt="{{ $bookmark->textile->title }}">
                                                </a>
                                                <div class="delete-save-item">
                                                    <a href="{{ route('bookmark.delete',$bookmark->id) }}" class="delete-box">
                                                        <span class="delete-icon-box">
                                                            <i class="icon icon-bin"></i>
                                                        </span>
                                                        حذف کالا
                                                    </a>
                                                </div>
                                                <div class="save-view-box">
                                                    <a href="{{ getTextileLink($bookmark->textile->id,$bookmark->textile->slug) }}" class="save-view">مشاهده محصول</a>
                                                </div>
                                            </div>
                                            <div class="shop-save-col column-8">
                                                <div class="save-header-col">
                                                    <h2 class="save-title">{{ $bookmark->textile->title }}</h2>
                                                    <h3 class="save-type">
                                                        <!-- <span class="save-type-icon">
                                                             <i class="icon icon-sample"></i>
                                                         </span>
                                                           نمونه -->
                                                    </h3>
                                                </div>
                                                <!--<div class="save-price-col">
                                                    <div class="save-price-row">
                                                       <span class="primary-price-throw">
                                                           9900
                                                           <span class="price-text">تومان</span>
                                                       </span>
                                                    </div>
                                                    <div class="save-price-row">
                                                        <span class="discont-price">
                                                            <span class="discont-text">تخفیف:</span>
                                                            9900
                                                            <span class="price-text">تومان</span>
                                                        </span>
                                                    </div>
                                                    <div class="save-price-row">
                                                        <span class="main-price">
                                                            9900
                                                            <span class="price-text">تومان</span>
                                                        </span>
                                                    </div>
                                                </div>-->
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
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
@endsection

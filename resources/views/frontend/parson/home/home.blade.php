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
            <div class="main-full-container">
                <!-- main fabric slider  -->
                <div class="fabric-main-slider">
                    <div class="owl-carousel" id="main-slider">
                        @foreach($sliders as $slider)
                            @foreach($slider->images as $image)
                                <div class="main-slider-item">
                                    <img src="{{ getSliderImagePath($image->image) }}" alt="">
                                    <span class="main-slide-caption">{{ $image->title }}</span>
                                </div>
                            @endforeach
                        @endforeach
                    </div>
                </div>
                <!-- end fabric main slider  -->
            </div>
            <div class="main-full-container">


                <!-- product carousel offer -->
                <div class="product-carousel-section product-off-section">
                    <div class="product-title-box">
                        <h3 class="p-title-text">جدید ترینها</h3>
                    </div>
                    <div class="product-main-box">
                        <div class="product-carousel-box">
                            <div class="owl-carousel" id="carousel-off-product">
                                @foreach($newers as $textile)
                                    @include(currentFrontView('partials.textiles.last'),['type'=>'new','texttile'=>$textile])
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end product carousel offer-->
                <!-- featured box -->


                <!-- featured-box -->
                <div class="featured-box">
                    @foreach($discount_banners as $discount_banner)
                        <a href="{{ route('textile.search').'?discount_type_id='.$discount_banner->id }}"
                           class="featured-item featured-col-4">
                            <img src="{{ $discount_banner->thumbnail }}" alt="{{$discount_banner->title}}">
                        </a>
                    @endforeach
                </div>
                <!-- end featured box  -->
                <!-- end featured box -->
                <!-- product carousel new -->
                <div class="product-carousel-section product-new-section">
                    <div class="product-title-box">
                        <h3 class="p-title-text">تخفیف ها</h3>
                    </div>
                    <div class="product-main-box">
                        <div class="product-carousel-box">
                            <div class="owl-carousel" id="carousel-top-product">
                                @foreach($last_discounts as $textile)
                                    @include(currentFrontView('partials.textiles.last'),['type'=>'discount','texttile'=>$textile])
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end product carousel new -->
                <div class="featured-box">
                    <a href="{{ route('trend.last',[0,0]) }}" class="featured-item featured-col-6">
                        <span class="img-title">بانوان</span>
                        <img src="{{ frontendTheme('images/woman.jpg') }}" alt="">
                    </a>
                    <a href="{{ route('trend.last',[1,0]) }}" class="featured-item featured-col-6">
                        <span class="img-title">آقایان</span>
                        <img src="{{ frontendTheme('images/man.jpg') }}" alt="">
                    </a>

                </div>
                @include(currentFrontView('partials.subscription'))
            </div>
        </section>
    </main>



@endsection

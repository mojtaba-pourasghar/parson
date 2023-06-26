@extends('layouts.activity')
@section('title','')
@section('keywords','')
@section('description','')
@section('open_graph')
    @include(currentFrontView('partials.open_graph'),['title'=>'','description'=>'','image'=>''])
@endsection
@section('header_title',__('textile.search'))
@section('back_url',route('home'))
@php
    $has_basket = true;
@endphp
@section('content')
    <link rel="stylesheet" href="{{ frontendTheme('js/price-slider/nouislider.css') }}">
    <link rel="stylesheet" href="{{ frontendTheme('js/scroll-box/jquery.mCustomScrollbar.css') }}">
    <link rel="stylesheet" href="{{ frontendTheme('css/style.css') }}">
    <main>
        <div class="default-full-container">
            {!! Form::model(null, ['route' => ['textile.search'] ,'method' => 'get','id'=>'search_form'] ) !!}
            <div class="search-main-box">
                <div class="search-items-panel">
                    <input type="text" class="input-search" name="title" placeholder="جستجوی محصول">
                    <span class="search-icon">
                    <i class="icon icon-search"></i>
                </span>
                </div>
                <div class="search-items-panel">
                    <div class="search-title-box">
                        <a href="#"><h3 class="search-title">براساس قیمت</h3></a>
                    </div>
                    <div class="search-option-box shop-range-pr">
                        <span class="example-val" id="lower-value"> </span>
                        <span class="example-val" id="upper-value"> </span>
                        <div class="price-range">
                            <div id="nonlinear"></div>
                        </div>

                    </div>
                </div>
                <div class="filter-box-main">
                    <h2 class="filter-main-title">فیلتر ها</h2>
                    <?php
                    $categories = \App\Category::where('parent_id', NULL)->orderBy('order','asc')->get();
                    ?>
                    @foreach($categories as $category)
                        <div class="filter-panel-box">
                            <div class="filter-title-box">
                                <h3 class="filter-title">{{ $category->title }}</h3>
                            </div>
                            <div class="filter-option">
                                <?php
                                $childCategories = \App\Category::where('parent_id', $category->id)
                                    ->select(DB::raw('*,(select count(*) from category_textile where category_id = categories.id) as cat_count'))
                                    ->get();
                                ?>
                                @foreach($childCategories as $childCategory)
                                    <div class="filter-item column-3 category_id" data-id="{{ $childCategory->id }}">
                                        <a href="javascript:void(0)">
                                            <img src="{{getCategoryImagePath($childCategory->thumbnail)}}"
                                                 alt="{{ $childCategory->title }}">
                                        </a>
                                        <span>{{ $childCategory->title }}</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                    <div class="filter-panel-box justify-content-center">

                        <button class="submit-btn" type="submit">جستجو</button>

                    </div>

                </div>
            </div>
            <input type="hidden" name="category_id" id="category_id" value="">
            <input type="hidden" name="minPrice" id="minPrice" value="">
            <input type="hidden" name="maxPrice" id="maxPrice" value="">
            {!! Form::close() !!}
        </div>
    </main>
    <script>
        __max_price = {{ $max_price }};
    </script>
    <script src="{{ frontendTheme('js/custom-scroll/jquery-scrollbar.min.js') }}"></script>
    <script src="{{ frontendTheme('js/price-slider/wNumb.js') }}"></script>
    <script src="{{ frontendTheme('js/price-slider/nouislider.js') }}"></script>
    <script src="{{ frontendTheme('js/shop.js') }}"></script>


    <script>
        $('.option-text-label').click(function () {
            var category_id = getUrlParameter('category_id');
            if (category_id != '0') {
                if (category_id != $(this).attr("data-id"))
                    category_id += ',' + $(this).attr("data-id");
            } else category_id = $(this).attr("data-id");
            replaceUrlParam('category_id', category_id);
        });

        $('.sort-item').click(function () {
            replaceUrlParam('sortby', $(this).attr("data-value"));
        })
    </script>
    <script>
        var url = '{{ route("bookmark.add") }}';
        $('.textile_bookmark').click(function () {
            add_to_bookmark(url, '{{ csrf_token() }}', $(this).attr("data-id"));
        });


        slider.on('update', function (values, handle) {

            $('#minPrice').val(values[0].replace("ریال", "").replace(",", ""));
            $('#maxPrice').val(values[1].replace("ریال", "").replace(",", ""));
        });

        $('.category_id').click(function () {
            var cat_txt = $('#category_id').val()  + $(this).attr("data-id");

            if ($('#category_id').val().indexOf($(this).attr("data-id")) < 0) {
                if (cat_txt.substring(0, 1) == ",")
                    cat_txt = cat_txt.substring(1, cat_txt.length);
                $('#category_id').val(cat_txt + ',');

                $('a', this).first().removeClass('highlight_filter');
                $('a', this).addClass('highlight_filter');
            } else {
                var id = $(this).attr("data-id");
                $('#category_id').val($('#category_id').val().replace(id + ",", ""));
                $('a', this).first().removeClass('highlight_filter');
            }

        });

        $('.search-icon').click(function () {
            $('#search_form').submit();
        });

    </script>
@endsection

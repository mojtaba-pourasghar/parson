@extends('layouts.activity')
@section('title','')
@section('keywords','')
@section('description','')
@section('open_graph')
    @include(currentFrontView('partials.open_graph'),['title'=>'','description'=>'','image'=>''])
@endsection
@section('header_title',__('textile.search'))
@section('back_url',route('textile.search_filter'))
@php
    $has_basket = true;
@endphp
@section('content')
    <link rel="stylesheet" href="{{ frontendTheme('js/price-slider/nouislider.css') }}">
    <link rel="stylesheet" href="{{ frontendTheme('js/scroll-box/jquery.mCustomScrollbar.css') }}">
    <link rel="stylesheet" href="{{ frontendTheme('css/style.css') }}">
    <main>
        <div class="default-full-container">
            <div class="search-result-main">
                <div class="filter-select-box">
                    <a href="{{ route('textile.search_filter') }}" class="filter-btn">
                        <i class="icon icon-filter"></i>
                    </a>
                    <?php
                    $currentURL = urldecode(url()->full());
                    ?>
                    @if (!empty($_REQUEST['color']))
                        <?php
                        $url = str_replace("color=" . $_REQUEST['color'], "", $currentURL);
                        ?>
                        <span class="filter-box">
                            <span class="color-circle-box" style="background: #{{$_REQUEST['color']}};">&nbsp;</span>
                            <a href="{{ $url }}" class="item-close">
                                <i class="fal fa-times"></i>
                            </a>
                        </span>
                    @endif
                    @if(!empty($_REQUEST['category_id']))
                        <?php
                        $cat_arry = [];
                        $category_id = substr($_REQUEST['category_id'],0,strlen($_REQUEST['category_id'])-1);
                        $cat_arry = explode(',', $category_id);
                        rsort($cat_arry);
                        $category_id .=',';
                        ?>
                        @foreach($cat_arry as $cat_id)
                            <?php
                            $category = \App\Category::where('id', $cat_id)->first();
                            ?>
                            <span class="filter-box">
                                {{ $category->title }}
                                <?php
                                    $url = str_replace($cat_id.',', "", $currentURL);
                                   // $currentURL = str_replace($cat_id.',', "", $currentURL);
                                ?>
                                <a href="{{ $url }}" class="item-close">
                                     <i class="fal fa-times"></i>
                                 </a>
                            </span>
                        @endforeach
                    @endif
                    @if (!empty($_REQUEST['title']))
                        <?php
                        $url = str_replace("title=" . $_REQUEST['title'], "", $currentURL);
                        ?>
                        <span class="filter-box">{{ $_REQUEST['title'] }}
                        <a href="{{ $url }}" class="item-close">
                                     <i class="fal fa-times"></i>
                                 </a>
                        </span>
                    @endif
                </div>
                <div class="result-title-box">
                    <span class="result-title">نتایج جستجو</span>
                    <span class="result-num">{{ count($textiles) }} کالا</span>
                </div>
                <div class="separate-line"></div>
                <div class="shop-sort-box">

                    <a href="javascript:void(0)"
                       class="sort-item {{ (!empty($_REQUEST['sortby']) && $_REQUEST['sortby']==1) ? 'active': '' }}  "
                       data-value="1">پر فروش ترين</a>
                    <a href="javascript:void(0)"
                       class="sort-item {{ (empty($_REQUEST['sortby']) || $_REQUEST['sortby']==2) ? 'active': '' }}"
                       data-value="2">جديد ترين</a>
                    <a href="javascript:void(0)"
                       class="sort-item {{ (!empty($_REQUEST['sortby']) && $_REQUEST['sortby']==3) ? 'active': '' }}"
                       data-value="3">داغ ترين تخفيف ها</a>
                    <a href="javascript:void(0)"
                       class="sort-item {{ (!empty($_REQUEST['sortby']) && $_REQUEST['sortby']==4) ? 'active': '' }}"
                       data-value="4">گران ترين</a>
                    <a href="javascript:void(0)"
                       class="sort-item {{ (!empty($_REQUEST['sortby']) && $_REQUEST['sortby']==5) ? 'active': '' }}"
                       data-value="5">ارزان ترين</a>
                </div>
                @foreach($textiles as $textile)
                    <div class="search-result-box">
                        <div class="product-result-box">
                            <div class="product-result-col result-col-detail column-6">
                                <a class="shoping-thumb-box" href="{{ getTextileLink($textile->id,$textile->slug) }}">
                                    <img src="{{ (count($textile->images)>0) ? $textile->images[0]->image : ''}}"
                                         alt="{{ $textile->title }}">
                                </a>
                                <div class="shoping-detail-box">
                                    <div class="shoping-title-box">
                                        <h2 class="shoping-title">{{ $textile->title }}</h2>
                                    </div>
                                    <a href="#" class="pr-stock">
                                        @if($textile->available_amount < 5 && $textile->available_amount > 1)
                                            @if($textile->unit_measurement=='YARD')
                                                {{$textile->available_amount}} یارد موجود در انبار
                                            @else
                                                {{$textile->available_amount}} متر موجود در انبار
                                            @endif

                                        @elseif ($textile->available_amount > 5)

                                        @else
                                            در انبار موجود نیست
                                        @endif

                                    </a>

                                </div>
                            </div>
                            <div class="product-result-col result-col-price column-6">
                                <div class="shoping-price-box">
                                    <div class="shoping-price-row">
                                        @if ($textile->sum_off >0)
                                            <span class="discont-price">
                                                <span class="discont-text">{{ "٪ ".(int) $textile->sum_off }}</span>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="shoping-price-row">
                                        <span class="main-price">
                                            <span
                                                class="price-text {{ ($textile->price != $textile->sum_price_with_off) ? ' throw' : '' }}  ">    {{number_format($textile->price)}} ریال</span>
                                        </span>
                                    </div>
                                    @if($textile->price != $textile->sum_price_with_off)
                                        <div class="shoping-price-row">
                                            <span class="price-text "> {{number_format($textile->sum_price_with_off)}} ریال</span>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </main>

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
        //
    </script>
@endsection

@extends('layouts.frontend')
@section('title','جستجو')
@section('keywords','')
@section('description','')
@section('open_graph')
    @include(currentFrontView('partials.open_graph'),['title'=>'','description'=>'','image'=>''])
@endsection
@section('content')
    <link rel="stylesheet" href="{{ frontendTheme('js/price-slider/nouislider.css') }}">
    <link rel="stylesheet" href="{{ frontendTheme('js/scroll-box/jquery.mCustomScrollbar.css') }}">
    <link rel="stylesheet" href="{{ frontendTheme('css/style.css') }}">
    <main>
        <section>
            <div class="main-content-box">
                <div class="default-title-box site-map">
                    <h2 class="default-title ">
                        <a href="{{ route('home') }}">صفحه نخست
                            <span class="default-title-icon">
                        <i class="fal fa-angle-left"></i>
                       </span>
                        </a>
                        <a href="#">فروشگاه</a>

                    </h2>
                </div>

            </div>
            <div class="main-full-container">


            </div>
            <div class="main-content-box">
                <!-- news main content start  -->
                <div class="default-sidebar shop-sidebar column-3">
                    @if((!empty($_REQUEST['title']) && $_REQUEST['title']!='') ||  !empty($_REQUEST['color']) || !empty($_REQUEST['category_id']) )
                        <div class="sidebar-panel-box">
                            <div class="sidebar-title-box shop-title">
                                <h3 class="sidebar-title">فیلتر های اعمال شده</h3>
                                <a href="{{ route('textile.search').'?title=' }}" class="delete-filter">حذف</a>
                            </div>
                            <?php
                            $currentURL = urldecode(url()->full());
                            ?>
                            <div class="sidebarShop-filter-box ">
                                @if(!empty($_REQUEST['title']))
                                    <?php
                                    $url = str_replace("title=" . $_REQUEST['title'], "", $currentURL);
                                    ?>
                                    <span class="filter-item">{{ $_REQUEST['title'] }}
                                         <a href="{{ $url }}" class="item-close">
                                             <i class="fal fa-times"></i>
                                         </a>
                                     </span>
                                @endif

                                @if(!empty($_REQUEST['color']))
                                    <?php
                                    $url = str_replace("color=" . $_REQUEST['color'], "", $currentURL);
                                    ?>
                                    <span class="filter-item">
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

                                        <span class="filter-item">{{ $category->title }}
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

                            </div>
                        </div>
                    @endif
                    <?php
                    $categories = \App\Category::where('parent_id', NULL)->orderBy('order','asc')->get();
                    ?>
                    @foreach($categories as $category)
                        <div class="sidebar-panel-box">
                            <div class="sidebar-title-box shop-title">
                                <a href="#"><h3 class="sidebar-title">براساس {{ $category->title }}</h3></a>
                            </div>
                            <div class="sidebarShop-option-box mCustomScrollbar">
                                <?php
                                $childCategories = \App\Category::where('parent_id', $category->id)
                                    ->select(DB::raw('*,(select count(*) from category_textile where category_id = categories.id) as cat_count'))
                                    ->get();

                                ?>
                                @foreach($childCategories as $childCategory)
                                    <div class="option-item-box option-shop-box">
                                        <a href="javascript:void(0)" class="option-text-label"
                                           data-id="{{ $childCategory->id }}">{{ $childCategory->title }}</a>
                                        @if ($category->id == 400)
                                            <span class="color-circle-box">
                                                <img src="{{getCategoryImagePath($childCategory->thumbnail)}}">
                                            </span>
                                        @endif
                                        <span class="option-number-item">({{ $childCategory->cat_count }})</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach


                    <div class="sidebar-panel-box range-filter">
                        <div class="sidebar-title-box shop-title">
                            <a href="#"><h3 class="sidebar-title">براساس قیمت</h3></a>
                        </div>
                        <div class="sidebarShop-option-box shop-range-pr">

                            <span class="example-val" id="lower-value"> </span>

                            <span class="example-val" id="upper-value"> </span>
                            <div class="price-range">
                                <div id="nonlinear">
                                </div>
                            </div>

                        </div>
                        <input type="hidden" id="minPrice" value="0">
                        <input type="hidden" id="maxPrice" value="0">
                        <div class="pr-confirm-box">
                            <a href="javascript:void(0)" id="price_filter" class="confirm-button">اعمال فیلتر</a>
                        </div>
                    </div>

                </div>

                <div class="shop-content-section column-9">
                    <div class="shop-sort-box">
                        <h2 class="sort-main-title">مرتب سازی بر اساس:</h2>
                        <a href="javascript:void(0)"
                           class="sort-item {{ (empty($_REQUEST['sortby']) || $_REQUEST['sortby']==1) ? 'active': '' }} "
                           data-value="1">پر فروش ترین</a>
                        <a href="javascript:void(0)"
                           class="sort-item {{ (!empty($_REQUEST['sortby']) && $_REQUEST['sortby']==2) ? 'active': '' }}"
                           data-value="2">جدید ترین</a>
                        <a href="javascript:void(0)"
                           class="sort-item {{ (!empty($_REQUEST['sortby']) && $_REQUEST['sortby']==3) ? 'active': '' }}"
                           data-value="3">داغ ترین تخفیف ها</a>
                        <a href="javascript:void(0)"
                           class="sort-item {{ (!empty($_REQUEST['sortby']) && $_REQUEST['sortby']==4) ? 'active': '' }}"
                           data-value="4">گران ترین</a>
                        <a href="javascript:void(0)"
                           class="sort-item {{ (!empty($_REQUEST['sortby']) && $_REQUEST['sortby']==5) ? 'active': '' }}"
                           data-value="5">ارزان ترین</a>
                    </div>
                    <!-- start content post  -->
                    <div class="shop-content-box">
                        <div class="product-row-box">
                            @php
                                $counter = 0;
                            @endphp
                            @foreach($textiles as $textile)

                                @include(currentFrontView('partials.textiles.search'),['texttile'=>$textile])
                                @php
                                    $counter++;
                                @endphp
                                @if($counter == 4)
                        </div>
                        <div class="product-row-box">
                            @endif
                            @php
                                if($counter == 4) $counter = 0;
                            @endphp
                            @endforeach
                        </div>
                    </div>
                    <!-- end content post  -->
                    <!-- start pagination -->
                    <nav aria-label="Page navigation" class="pagination-main">
                        {{ $textiles->appends($_GET)->links(currentFrontView('pagination')) }}
                    </nav>
                    <!-- end pagination  -->
                    @if (!empty($search_category))
                        <div class="product-comment-box">
                            <div class="product-title">
                                <h3 class="pr-title-text">
                                    <a href="#">{{ $search_category->title }}</a>
                                </h3>
                            </div>
                            <div class="product-content">
                                <p>
                                    {!! $search_category->present()->descriptionHtml  !!}
                                </p>
                            </div>
                        </div>
                    @endif
                </div>

                <!-- news main content end -->
            </div>
        </section>
    </main>
    <script>
        __max_price = {{ $max_price }};
    </script>

    <script src="{{ frontendTheme('js/price-slider/wNumb.js') }}"></script>
    <script src="{{ frontendTheme('js/price-slider/nouislider.js') }}"></script>
    <script src="{{ frontendTheme('js/scroll-box/jquery.mCustomScrollbar.concat.min.js') }}"></script>
    <script src="{{ frontendTheme('js/shop.js') }}"></script>


    <script>
        $('.option-text-label').click(function () {
            var category_id = getUrlParameter('category_id');

            if (category_id != '0') {
                if (category_id != $(this).attr("data-id")+',')
                    category_id += $(this).attr("data-id")+',' ;
            } else category_id = $(this).attr("data-id")+',' ;
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

        slider.on('update', function (values, handle) {

            $('#minPrice').val(values[0].replace("ریال", "").replace(",", ""));
            $('#maxPrice').val(values[1].replace("ریال", "").replace(",", ""));
        });

        $('#price_filter').click(function () {
            window.location = $(location).attr('href') + '&minPrice=' + $('#minPrice').val() + '&maxPrice=' + $('#maxPrice').val();
        });

    </script>
@endsection

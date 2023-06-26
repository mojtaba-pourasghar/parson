<div class="product-column-box">
    <div class="product-heading-box">
        <span class="existing-pr">
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
        </span>
        @if ($textile->sum_off >0)
            <span class="descount-pr">{{ "٪ ".(int) $textile->sum_off }} </span>
        @endif
    </div>
    <a href="{{ getTextileLink($textile->id,$textile->slug) }}" class="product-box-image">
        <img src="{{ (count($textile->images)>0) ? $textile->images[0]->image : ''}}" alt="{{ $textile->title }}">
    </a>
    <h2 class="product-title">
        <a href="{{ getTextileLink($textile->id,$textile->slug) }}" class="product-title">{{ $textile->title }}</a>
    </h2>
    <h3 class="product-base-size">هر
        @if($textile->unit_measurement=='YARD')
            یارد
        @else
            متر
        @endif
    </h3>
    <div class="price-product-box">
        @if($textile->price != $textile->sum_price_with_off)
            <span class="price">{{number_format($textile->price)}} ریال</span>
        @endif
        <span class="descount">
              {{number_format($textile->sum_price_with_off)}} ریال
        </span>
    </div>
    <div class="product-important-icons">
        <!--<a href="#" class="shop-icon">
            <i class="icon icon-basket"></i>
            <span class="plus-box">
                <i class="fal fa-plus"></i>
            </span>
        </a>-->
        <a href="javascript:void(0)" class="shop-save-icon  textile_bookmark" data-id='{{ $textile->id }}'>
            <i class="icon icon-save"></i>
        </a>
    </div>

</div>


<div class="product-item-box">
    <a href="{{ getTextileLink($textile->id,$textile->slug) }}" class="image-box">
        <img src="{{ (count($textile->images)>0) ? $textile->images[0]->image : ''}}" alt="{{ $textile->title }}">
    </a>

    @if ($textile->sum_off >0)
        <div class="product-off-box">

            <span>{{ "٪ ".(int) $textile->sum_off }} </span>
        </div>
    @endif

    <div class="product-main-detail">
        <div class="detail-first-row">
            <a href="{{ getTextileLink($textile->id,$textile->slug) }}" class="product-title">{{ $textile->title }}</a>
        </div>
        <div class="detail-second-row">
            <a href="javascript:void(0)" class="add-to-shop" onclick=" add_to_basket('{{ csrf_token() }}','{{ $textile->id }}', 'METER', '{{ (count($textile->colors)>0) ? $textile->colors[0]->color_code : ''}}', 'MAIN','{{ (count($textile->images)>0) ? $textile->images[0]->image : ''}}','{{ $textile->title }}','{{ $textile->slug }}',0.5);" >
                <!-- <i class="icon-basket"></i>
                 <span class="plus-box">
                     <i class="fal fa-plus"></i>
                 </span>-->
            </a>
            <div class="product-detail-price">
                @if($textile->price != $textile->sum_price_with_off)
                    <div class="off-price">{{number_format($textile->price)}} ریال</div>
                @endif
                <div class="main-price">{{ number_format($textile->sum_price_with_off) }} ریال</div>
            </div>
        </div>
    </div>
</div>
<script>

</script>

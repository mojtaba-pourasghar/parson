@foreach($price_pattern_items as $price_pattern_item)
    <div class="col-sm-6">
        {!! Form::label($price_pattern_item->min.'-'.$price_pattern_item->max,null,['class' => 'col-sm-3 control-label']) !!}
        <div class="col-sm-9">
            {!! Form::number('prices[]',!empty($price_pattern_item->values[0]->pivot->price) ? $price_pattern_item->values[0]->pivot->price : $price - ($price * ($price_pattern_item->off/100)), ['class' => 'form-control col-sm-9']) !!}
            <input type="hidden" value=" {{ $price_pattern_item->id }} " name="price_pattern_item_ids[]">
        </div>

    </div>
@endforeach


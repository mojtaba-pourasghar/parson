@extends('layouts.default')
@section('title',$pricepattern->exists ? __('price_pattern.edit').' '.$pricepattern->name : __('price_pattern.add'))

@section('content')

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>{{$pricepattern->exists ? __('price_pattern.edit').' '.$pricepattern->name : __('price_pattern.add')}}
                            <small></small></h5>
                    </div>
                    <div class="ibox-content">
                        {!! Form::model($pricepattern, [
                            'route' => $pricepattern->exists ? ['backend.pricepatterns.update', $pricepattern->id] : ['backend.pricepatterns.store'],
                            'method' => $pricepattern->exists ? 'put' : 'post','class' => 'form-horizontal','files'=>'true'] ) !!}

                        <div class="form-group">
                            {!! Form::label(__('price_pattern.title'),null,['class' => 'col-sm-2 control-label']) !!}
                            <div class="col-sm-6">
                                {!! Form::text('title', null, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            {!! Form::label(__('price_pattern.unit_measurement'),null,['class' => 'col-sm-2 control-label']) !!}
                            <div class="col-sm-1">
                                {!! Form::select('unit_measurement',[
                                    'METER' =>__('price_pattern.meter'),
                                    'YARD' =>__('price_pattern.yard'),
                                ], $pricepattern->unit_measurement, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            {!! Form::label(__('price_pattern.patterns'),null,['class' => 'col-sm-2 control-label']) !!}
                            <div class="col-sm-4">
                                <div class="well clearfix">
                                    <a class="btn btn-primary pull-right add_pattern_row" data-added="0">
                                        <i class="glyphicon glyphicon-plus"></i>@lang('price_pattern.add_pattern_row')
                                    </a>
                                </div>
                                <table class="table table-bordered" id="tbl_patterns">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>@lang('price_pattern.min')</th>
                                        <th>@lang('price_pattern.max')</th>
                                        <th>@lang('price_pattern.off')</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody id="tbl_patterns_body">

                                    </tbody>
                                </table>
                            </div>

                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            {!! Form::label(__('price_pattern.state'),null,['class' => 'col-sm-2 control-label']) !!}
                            <div class="col-sm-2">
                                {!! Form::select('state',[
                                    '1'=>__('message.active'),
                                    '0' =>__('message.deactive'),
                                ], $pricepattern->state, ['class' => 'form-control']) !!}
                            </div>
                        </div>

                        <div class="hr-line-dashed"></div>

                        <div class="form-group">
                            <div class="col-sm-4 col-sm-offset-2">
                                {!! Form::submit(__('message.save'), ['class' => 'btn btn-primary']) !!}
                                {!! Form::reset( __('message.reset')  , ['class' => 'btn btn-white']) !!}
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div style="display:none;">
        <table id="sample_pattern_table">
            <tr id="">
                <td><span class="sn"></span>.</td>
                <td>{!! Form::number('mins[]', null, ['class' => 'form-control jspattern min','id'=>'min','data-id'=>'0']) !!}</td>
                <td>{!! Form::number('maxs[]', null, ['class' => 'form-control jspattern max','id'=>'max','data-id'=>'0']) !!}</td>
                <td>{!! Form::number('offs[]', null, ['class' => 'form-control jspattern off','id'=>'off','data-id'=>'0']) !!}</td>
                <td><a class="btn btn-xs delete_pattern_row" data-id="0"><i class="glyphicon glyphicon-trash"></i></a>
                </td>
            </tr>
        </table>
    </div>
    <script>

        function deletePatternRecord(obj, message) {
            var didConfirm = confirm(message);
            if (didConfirm == true) {
                var id = obj.attr('data-id');
                var targetDiv = obj.attr('targetDiv');
                jQuery('#recPattern-' + id).remove();

                //regnerate index number on table
                $('#tbl_patterns_body tr').each(function (index) {
                    //alert(index);
                    obj.find('span.sn').html(index + 1);
                });
                return true;
            } else {
                return false;
            }
        }

        function addPatternRecord(size) {
            var content = jQuery('#sample_pattern_table tr'),
                element = null,
                element = content.clone();
            element.attr('id', 'recPattern-' + size);
            element.find('.delete_pattern_row').attr('data-id', size);
            element.appendTo('#tbl_patterns_body');
            element.find('.sn').html(size);
        }

        function editPatternRecord(size, min,max,off) {
            var content = jQuery('#sample_pattern_table tr'),
                element = null,
                element = content.clone();
            element.attr('id', 'recPattern-' + size);
            element.find('.delete_pattern_row').attr('data-id', size);
            element.find('.min').val(min);
            element.find('.max').val(max);
            element.find('.off').val(off);
            element.appendTo('#tbl_patterns_body');
            element.find('.sn').html(size);
        }

        jQuery(document).delegate('a.add_pattern_row', 'click', function (e) {
            e.preventDefault();
            addPatternRecord(jQuery('#tbl_patterns >tbody >tr').length + 1);
        });
        jQuery(document).delegate('a.delete_pattern_row', 'click', function (e) {
            e.preventDefault();
            deletePatternRecord(jQuery(this), '{{ __('message.are_you_sure') }}')
        });

    </script>
    @foreach( $pricepattern->pattern_items as $pattern_item)
        <script>
            var id = jQuery('#tbl_patterns_body >tr').length + 1;
            editPatternRecord(id, '{{ $pattern_item->min }}', '{{ $pattern_item->max }}', '{{ $pattern_item->off }}');
        </script>
    @endforeach


@endsection




@extends('layouts.default')
@section('title',$discounttype->exists ? __('discount_type.edit').' '.$discounttype->name : __('discount_type.add'))

@section('content')

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>{{$discounttype->exists ? __('discount_type.edit').' '.$discounttype->name : __('discount_type.add')}}
                            <small></small></h5>
                    </div>
                    <div class="ibox-content">
                        {!! Form::model($discounttype, [
                            'route' => $discounttype->exists ? ['backend.discounttypes.update', $discounttype->id] : ['backend.discounttypes.store'],
                            'method' => $discounttype->exists ? 'put' : 'post','class' => 'form-horizontal','files'=>'true'] ) !!}

                        <div class="form-group">
                            {!! Form::label(__('discount_type.title'),null,['class' => 'col-sm-2 control-label']) !!}
                            <div class="col-sm-6">
                                {!! Form::text('title', null, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>

                        <div class="form-group">
                            {!! Form::label(__('discount_type.percent'),null,['class' => 'col-sm-2 control-label']) !!}
                            <div class="col-sm-1">
                                {!! Form::text('percent', null, ['class' => 'form-control']) !!}
                            </div>
                            {!! Form::label('%',null,['class' => 'col-sm-1 control-label']) !!}
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            {!! Form::label(__('discount_type.thumbnail'),null,['class' => 'col-sm-2 control-label']) !!}
                            <div class="col-sm-6">
                                <img id="thumbnail" src="{{ $discounttype['thumbnail'] }}"
                                     alt="{{ __('discount_type.selected_image') }}" width="100" height="100"/>
                                <input type="file" name="thumbnail_file"
                                       onchange="document.getElementById('thumbnail').src = window.URL.createObjectURL(this.files[0])">
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            {!! Form::label(__('discount_type.amount'),null,['class' => 'col-sm-2 control-label']) !!}
                            <div class="col-sm-3">
                                {!! Form::text('amount', null, ['class' => 'form-control']) !!}
                            </div>
                            {!! Form::label(__('message.rial'),null,['class' => 'col-sm-1 control-label']) !!}
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            {!! Form::label(__('discount_type.is_single'),null,['class' => 'col-sm-2 control-label']) !!}
                            <div class="col-sm-6">
                                <input name="is_single"
                                       type="checkbox" {{ (!empty($discounttype->is_single) && $discounttype->is_single==1) ? 'checked':'' }}>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>

                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            {!! Form::label(__('discount_type.state'),null,['class' => 'col-sm-2 control-label']) !!}
                            <div class="col-sm-2">
                                {!! Form::select('state',[
                                    '1'=>__('message.active'),
                                    '0' =>__('message.deactive'),
                                ], $discounttype->state, ['class' => 'form-control']) !!}
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



@endsection




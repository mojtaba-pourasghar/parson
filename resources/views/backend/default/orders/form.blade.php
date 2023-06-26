@extends('layouts.default')
@section('title',$order->exists ? __('order.edit').' '.$order->name : __('order.add'))

@section('content')

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>{{$order->exists ? __('order.edit').' '.$order->name : __('order.add')}}
                            <small></small></h5>
                    </div>
                    <div class="ibox-content">
                        {!! Form::model($order, [
                            'route' => $order->exists ? ['backend.orders.update', $order->id] : ['backend.orders.store'],
                            'method' => $order->exists ? 'put' : 'post','class' => 'form-horizontal'] ) !!}

                        <div class="form-group">
                            {!! Form::label(__('order.title'),null,['class' => 'col-sm-2 control-label']) !!}
                            <div class="col-sm-6">
                                {!! Form::text('title', null, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>

                        <div class="form-group">
                            {!! Form::label(__('order.percent'),null,['class' => 'col-sm-2 control-label']) !!}
                            <div class="col-sm-1">
                                {!! Form::text('percent', null, ['class' => 'form-control']) !!}
                            </div>
                            {!! Form::label('%',null,['class' => 'col-sm-1 control-label']) !!}
                        </div>
                        <div class="hr-line-dashed"></div>

                        <div class="form-group">
                            {!! Form::label(__('order.amount'),null,['class' => 'col-sm-2 control-label']) !!}
                            <div class="col-sm-3">
                                {!! Form::text('amount', null, ['class' => 'form-control']) !!}
                            </div>
                            {!! Form::label(__('message.rial'),null,['class' => 'col-sm-1 control-label']) !!}
                        </div>
                        <div class="hr-line-dashed"></div>

                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            {!! Form::label(__('order.state'),null,['class' => 'col-sm-2 control-label']) !!}
                            <div class="col-sm-2">
                                {!! Form::select('state',[
                                    '1'=>__('message.active'),
                                    '0' =>__('message.deactive'),
                                ], $order->state, ['class' => 'form-control']) !!}
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




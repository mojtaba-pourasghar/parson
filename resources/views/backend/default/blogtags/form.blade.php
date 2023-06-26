@extends('layouts.default')
@section('title',$blogtag->exists ? __('blogtag.edit').' '.$blogtag->name : __('blogtag.add'))

@section('content')

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>{{$blogtag->exists ? __('blogtag.edit').' '.$blogtag->name : __('blogtag.add')}}
                            <small></small></h5>
                    </div>
                    <div class="ibox-content">
                        {!! Form::model($blogtag, [
                            'route' => $blogtag->exists ? ['backend.blogtags.update', $blogtag->id] : ['backend.blogtags.store'],
                            'method' => $blogtag->exists ? 'put' : 'post','class' => 'form-horizontal'] ) !!}

                        <div class="form-group">
                            {!! Form::label(__('blogtag.title'),null,['class' => 'col-sm-2 control-label']) !!}
                            <div class="col-sm-6">
                                {!! Form::text('title', null, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>

                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            {!! Form::label(__('blogtag.state'),null,['class' => 'col-sm-2 control-label']) !!}
                            <div class="col-sm-2">
                                {!! Form::select('state',[
                                    '1'=>__('message.active'),
                                    '0' =>__('message.deactive'),
                                ], $blogtag->state, ['class' => 'form-control']) !!}
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




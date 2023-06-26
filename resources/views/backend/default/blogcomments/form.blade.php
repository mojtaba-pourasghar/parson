@extends('layouts.default')
@section('title',__('blogcomment.edit').' : '.(!empty($blogcomment->user->name) ? $blogcomment->user->name : $blogcomment->name) )

@section('content')

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>{{__('blogcomment.edit').' : '.(!empty($blogcomment->user->name) ? $blogcomment->user->name : $blogcomment->name) }}
                            <small></small></h5>
                    </div>
                    <div class="ibox-content">
                        {!! Form::model($blogcomment, [
                            'route' => $blogcomment->exists ? ['backend.blogcomments.update', $blog_id,$blogcomment->id ] : ['backend.blogcomments.store'],
                            'method' => $blogcomment->exists ? 'put' : 'post','class' => 'form-horizontal'] ) !!}

                        <div class="form-group">
                            {!! Form::label(__('blogcomment.comment'),null,['class' => 'col-sm-2 control-label']) !!}
                            <div class="col-sm-6">
                                {!! Form::textarea('comment', null, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>

                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            {!! Form::label(__('blogcomment.state'),null,['class' => 'col-sm-2 control-label']) !!}
                            <div class="col-sm-2">
                                {!! Form::select('state',[
                                    '1'=>__('message.active'),
                                    '0' =>__('message.deactive'),
                                ], $blogcomment->state, ['class' => 'form-control']) !!}
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




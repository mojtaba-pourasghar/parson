@extends('layouts.default')
@section('title',$faq->exists ? __('faq.edit').' '.$faq->name : __('faq.add'))

@section('content')
    <script type="text/javascript" src="{{ backendTheme('js/ckeditor415/ckeditor.js') }}"></script>
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>{{$faq->exists ? __('faq.edit').' '.$faq->name : __('faq.add')}}
                            <small></small></h5>
                    </div>
                    <div class="ibox-content">
                        {!! Form::model($faq, [
                            'route' => $faq->exists ? ['backend.faqs.update', $faq->id] : ['backend.faqs.store'],
                            'method' => $faq->exists ? 'put' : 'post','class' => 'form-horizontal'] ) !!}

                        <div class="form-group">
                            {!! Form::label(__('faq.question'),null,['class' => 'col-sm-2 control-label']) !!}
                            <div class="col-sm-6">
                                {!! Form::text('question', null, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            {!! Form::label(__('faq.answer'),null,['class' => 'col-sm-2 control-label']) !!}
                            <div class="col-sm-9">
                                {!! Form::textarea('answer', null, ['class' => 'form-control','id'=>'answer']) !!}
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            {!! Form::label(__('faq.state'),null,['class' => 'col-sm-2 control-label']) !!}
                            <div class="col-sm-2">
                                {!! Form::select('state',[
                                    '1'=>__('message.active'),
                                    '0' =>__('message.deactive'),
                                ], $faq->state, ['class' => 'form-control']) !!}
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

<script>
    CKEDITOR.replace('answer');
</script>

@endsection




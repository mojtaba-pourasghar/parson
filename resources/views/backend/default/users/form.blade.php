@extends('layouts.default')
@section('title',$userSite->exists ? __('user.edit').' '.$userSite->name : __('user.add'))

@section('content')

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>{{$userSite->exists ? __('user.edit').' '.$userSite->name : __('user.add')}}<small></small></h5>
                    </div>
                    <div class="ibox-content">
                        {!! Form::model($userSite, [
                            'route' => $userSite->exists ? ['backend.users.update', $userSite->id] : ['backend.users.store'],
                            'method' => $userSite->exists ? 'put' : 'post','class' => 'form-horizontal'] ) !!}

                        <div class="form-group">
                            {!! Form::label(__('role.list'),null,['class' => 'col-sm-2 control-label']) !!}
                            <div class="col-sm-6">
                                @php
                                    $checked = true
                                @endphp
                                @foreach($roles as $role)
                                    @php
                                        $checked = true
                                    @endphp
                                    @foreach($userSite->roles as $selectedRole)
                                        @if ($selectedRole->id == $role->id)
                                            <div class="checkbox checkbox-inline checkbox-primary">
                                                <input type="checkbox" name="roles[]" checked
                                                       id="inlineCheckbox{{ $role['id'] }}"
                                                       value="{{ $role['id'] }}">
                                                <label for="inlineCheckbox{{ $role['id'] }}">{{ $role['name'] }}</label>
                                            </div>
                                            @php
                                                $checked = false
                                            @endphp
                                            @continue

                                        @endif
                                    @endforeach
                                    @if ($checked)
                                        <div class="checkbox checkbox-inline checkbox-primary">
                                            <input type="checkbox" name="roles[]"
                                                   id="inlineCheckbox{{ $role['id'] }}"
                                                   value="{{ $role['id'] }}">
                                            <label for="inlineCheckbox{{ $role['id'] }}">{{ $role['name'] }}</label>
                                        </div>
                                    @endif

                                @endforeach
                            </div>
                        </div>

                        <div class="form-group">
                            {!! Form::label(__('user.name'),null,['class' => 'col-sm-2 control-label']) !!}
                            <div class="col-sm-6">
                                {!! Form::text('name', null, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            {!! Form::label(__('user.email'),null,['class' => 'col-sm-2 control-label']) !!}
                            <div class="col-sm-6">
                                {!! Form::email('email', null, ['class' => 'form-control','style'=>'direction:ltr']) !!}
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            {!! Form::label(__('user.password'),null,['class' => 'col-sm-2 control-label']) !!}
                            <div class="col-sm-6">
                                {!! Form::password('password',  ['class' => 'form-control']) !!}
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            {!! Form::label(__('user.password_confirmation'),null,['class' => 'col-sm-2 control-label']) !!}
                            <div class="col-sm-6">
                                {!! Form::password('password_confirmation',  ['class' => 'form-control']) !!}
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            {!! Form::label(__('organization.state'),null,['class' => 'col-sm-2 control-label']) !!}
                            <div class="col-sm-2">
                                {!! Form::select('state',[
                                    '1'=>__('message.active'),
                                    '0' =>__('message.deactive'),
                                ], $userSite->state, ['class' => 'form-control']) !!}
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




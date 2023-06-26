@extends('layouts.default')
@section('title',$role->exists ? __('role.edit').' '.$role->name : __('role.add'))

@section('content')

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>{{$role->exists ? __('role.edit').' '.$role->name : __('role.add')}}<small></small></h5>

                    </div>
                    <div class="ibox-content">
                        {!! Form::model($role, [
                            'route' => $role->exists ? ['backend.roles.update', $role->id] : ['backend.roles.store'],
                            'method' => $role->exists ? 'put' : 'post','class' => 'form-horizontal'] ) !!}
                        <div class="form-group">
                            {!! Form::label(__('role.name'),null,['class' => 'col-sm-2 control-label']) !!}
                            <div class="col-sm-6">
                                {!! Form::text('name', null, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            {!! Form::label(__('role.slug'),null,['class' => 'col-sm-2 control-label']) !!}
                            <div class="col-sm-6">
                                {!! Form::text('slug', null, ['class' => 'form-control','style'=>'direction:ltr']) !!}
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            {!! Form::label(__('role.permission_list'),null,['class' => 'col-sm-2 control-label']) !!}
                            <div class="col-sm-12">
                                @php
                                    $checked = false
                                @endphp
                                @foreach($permissions as $permission)
                                    @php
                                        $checked = true
                                    @endphp
                                    @foreach($role->permissions as $selectedPermission)
                                        @if ($selectedPermission->id == $permission->id)
                                            <div class="col-sm-2">
                                                <div class="checkbox checkbox-inline checkbox-primary">
                                                    <input type="checkbox" name="permissions[]" checked
                                                           id="inlineCheckbox{{ $permission['id'] }}"
                                                           value="{{ $permission['id'] }}">
                                                    <label
                                                        for="inlineCheckbox{{ $permission['id'] }}">{{ $permission['name'] }}</label>
                                                </div>
                                            </div>
                                            @php
                                                $checked = false
                                            @endphp
                                            @continue

                                        @endif
                                    @endforeach
                                    @if ($checked)
                                        <div class="col-sm-2">
                                            <div class="checkbox checkbox-inline checkbox-primary">
                                                <input type="checkbox" name="permissions[]"
                                                       id="inlineCheckbox{{ $permission['id'] }}"
                                                       value="{{ $permission['id'] }}">
                                                <label
                                                    for="inlineCheckbox{{ $permission['id'] }}">{{ $permission['name'] }}</label>
                                            </div>
                                        </div>
                                    @endif

                                @endforeach
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



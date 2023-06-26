@extends('layouts.default')
@section('title',__('role.list'))

@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-sm-4">
            <h2>@lang('role.list')</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{ route('backend.dashbord') }}">@lang('message.home')</a>
                </li>
                <li class="active">
                    <strong>@lang('role.list')</strong>
                </li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="wrapper wrapper-content animated fadeInUp">

                <div class="ibox">
                    <div class="ibox-title">

                        <div class="ibox-tools">
                            <a href="{{ route('backend.roles.create') }}" class="btn btn-primary btn-xs">@lang('role.add')</a>
                        </div>
                    </div>
                    <div class="ibox-content">


                        <div class="project-list">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>@lang('role.id')</th>
                                        <th>@lang('role.name')</th>
                                        <th>@lang('role.slug')</th>
                                        <th>@lang('message.action')</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($roles as $role)
                                        <tr>
                                            <td>{{ $role['id'] }}</td>
                                            <td><a href="{{ route('backend.roles.edit',$role->id) }}">{{ $role['name'] }}</a></td>
                                            <td>{{ $role['slug'] }}</td>

                                            <td>
                                                <a href="{{ route('backend.roles.delete',$role->id) }}"
                                                   onclick="return confirm('{!! __('message.are_you_sure') !!}')" class="btn btn-white red-bg btn-sm">
                                                    <i class="fa  fa-remove"></i> @lang('message.delete')
                                                </a>
                                                <a href="{{ route('backend.roles.edit',$role->id) }}" class="btn btn-white btn-sm"><i class="fa fa-pencil"></i> @lang('message.edit')
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

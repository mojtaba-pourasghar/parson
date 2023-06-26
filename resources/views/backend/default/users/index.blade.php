@extends('layouts.default')
@section('title',__('user.list'))

@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-sm-4">
            <h2>@lang('user.list')</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{ route('backend.dashbord') }}">@lang('message.home')</a>
                </li>
                <li class="active">
                    <strong>@lang('user.list')</strong>
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
                            <a href="{{ route('backend.users.create') }}"
                               class="btn btn-primary btn-xs">@lang('user.add')</a>
                        </div>
                    </div>

                    <div class="ibox-content">

                        <div class="row">
                            <div class="col-sm-6">
                                <form action="{{ route('backend.users.index') }}" method="post">
                                    {!! csrf_field() !!}
                                    <div id="DataTables_Table_0_filter" class="dataTables_filter"><label>@lang('message.search'):
                                            <input type="search" name="search" class="form-control input-sm" placeholder="{{ __('user.search_with_name') }}"
                                                aria-controls="DataTables_Table_0"></label>
                                        <button class="btn btn-primary btn-circle" type="submit"><i class="fa fa-search"></i></button>
                                    </div>
                                </form>
                            </div>
                            <div class="col-sm-6">
                                @include(currentBackView('partials.filter_list'),['url'=>url()->full(),'route_address'=>'backend.users.index','filter_value'=>request()->input('filter')])
                            </div>

                        </div>

                        <div class="project-list">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>@lang('user.id')</th>
                                        <th>@lang('user.name')</th>
                                        <th>@lang('role.name')</th>
                                        <th>@lang('user.email')</th>
                                        <th>@lang('user.image')</th>
                                        <th>@lang('message.action')</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($users as $user)
                                        <tr>
                                            <td>{{ $user['id'] }}</td>
                                            <td>
                                                <a href="{{ route('backend.users.edit',$user->id) }}">{{ $user['name'] }}</a>
                                            </td>


                                            <td>
                                                @foreach($user->roles as $role)
                                                    {{ $role->name }} <br>
                                                @endforeach
                                            </td>
                                            <td>{{ $user['email'] }}</td>
                                            <td><img src="{{ getUserImagePath($user->image) }}" width="50" height="50"></td>
                                            <td>
                                                <a href="{{ route('backend.users.delete',$user->id) }}"
                                                   onclick="return confirm('{!! __('message.are_you_sure') !!}')"
                                                   class="btn btn-white red-bg btn-sm">
                                                    <i class="fa  fa-remove"></i> @lang('message.delete')
                                                </a>
                                                <a href="{{ route('backend.users.edit',$user->id) }}"
                                                   class="btn btn-white btn-sm"><i
                                                        class="fa fa-pencil"></i> @lang('message.edit')
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="row">

                                <div class="col-sm-12">
                                    {{ $users->appends($_GET)->links(currentBackView('pagination')) }}
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

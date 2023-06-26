@extends('layouts.default')
@section('title',__('blogtag.list'))

@section('content')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-sm-4">
            <h2>@lang('blogtag.list')</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{ route('backend.dashbord') }}">@lang('message.home')</a>
                </li>
                <li class="active">
                    <strong>@lang('blogtag.list')</strong>
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
                            <a href="{{ route('backend.blogtags.create') }}"
                               class="btn btn-primary btn-xs">@lang('blogtag.add')</a>
                        </div>
                    </div>

                    <div class="ibox-content">

                        <div class="row">
                            <div class="col-sm-6">
                                <form action="{{ route('backend.blogtags.index') }}" method="get">

                                    <div id="DataTables_Table_0_filter" class="dataTables_filter">
                                        <div class="col-sm-4">
                                            <input type="search" name="search" class="form-control input-sm"
                                                   placeholder="{{ __('blogtag.search_with_title') }}"
                                                   aria-controls="DataTables_Table_0"
                                                   value="{{ !empty(request()->input('search')) ? request()->input('search') : '' }}">
                                        </div>
                                        <button class="btn btn-primary btn-circle" type="submit"><i
                                                class="fa fa-search"></i></button>
                                    </div>
                                </form>
                            </div>
                            <div class="col-sm-6">
                                @include(currentBackView('partials.filter_list'),['url'=>url()->full(),'filter_value'=>request()->input('filter'),'route_address'=>'backend.blogtags.index'])
                            </div>

                        </div>

                        <div class="project-list">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>@lang('blogtag.id')</th>
                                        <th>@lang('blogtag.title')</th>
                                        <th>@lang('blogtag.state')</th>
                                        <th>@lang('message.action')</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($blogtags as $blogtag)
                                        <tr>
                                            <td>{{ $blogtag->id  }} </td>
                                            <td>
                                                <a href="{{ route('backend.blogtags.edit',$blogtag->id) }}">{{ $blogtag['title'] }}</a>
                                            </td>
                                            <td>
                                                @if($blogtag['state'] ==1)
                                                    <span class="badge badge-primary">@lang('message.active')</span>
                                                @else
                                                    <span class="badge badge-danger">@lang('message.deactive')</span>
                                                @endif
                                            </td>

                                            <td>
                                                <a href="{{ route('backend.blogtags.delete',$blogtag->id) }}"
                                                   onclick="return confirm('{!! __('message.are_you_sure') !!}')"
                                                   class="btn btn-white red-bg btn-sm">
                                                    <i class="fa  fa-remove"></i> @lang('message.delete')
                                                </a>
                                                <a href="{{ route('backend.blogtags.edit',$blogtag->id) }}"
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
                                    {{ $blogtags->appends($_GET)->links(currentBackView('pagination')) }}
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@extends('layouts.default')
@section('title',__('page.list'))

@section('content')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-sm-4">
            <h2>@lang('page.list')</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{ route('backend.dashbord') }}">@lang('message.home')</a>
                </li>
                <li class="active">
                    <strong>@lang('page.list')</strong>
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
                            <a href="{{ route('backend.pages.create') }}"
                               class="btn btn-primary btn-xs">@lang('page.add')</a>
                        </div>
                    </div>

                    <div class="ibox-content">

                        <div class="row">
                            <div class="col-sm-6">
                                <form action="{{ route('backend.pages.index') }}" method="get">

                                    <div id="DataTables_Table_0_filter" class="dataTables_filter">
                                        <label>@lang('message.search'):
                                            <input type="search" name="search" class="form-control input-sm"
                                                   placeholder="{{ __('page.search_with_title') }}"
                                                   aria-controls="DataTables_Table_0" value="{{ !empty(request()->input('search')) ? request()->input('search') : '' }}"></label>
                                        <button class="btn btn-primary btn-circle" type="submit"><i
                                                class="fa fa-search"></i></button>
                                    </div>
                                </form>
                            </div>
                            <div class="col-sm-6">
                                @include(currentBackView('partials.filter_list'),['route_address'=>'backend.pages.index'])
                            </div>

                        </div>

                        <div class="project-list">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>@lang('page.id')</th>
                                        <th>@lang('page.title')</th>
                                        <th>@lang('page.uri')</th>
                                        <th>@lang('page.state')</th>
                                        <th>@lang('message.action')</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($pages as $page)
                                        <tr>
                                            <td>{{ $page->ancestors->count() ? implode(' > ', $page->ancestors->pluck('title')->toArray()).'>'.$page->title  : $page->title  }} </td>
                                            <td>
                                                <a href="{{ route('backend.pages.edit',$page->id) }}">{{ $page->title }}</a>
                                            </td>
                                            <td>{{ $page->uri }}</td>
                                            <td>
                                                @if($page->state ==1)
                                                    <span class="badge badge-primary">@lang('message.active')</span>
                                                @else
                                                    <span class="badge badge-danger">@lang('message.deactive')</span>
                                                @endif
                                            </td>

                                            <td>
                                                <a href="{{ route('backend.pages.delete',$page->id) }}"
                                                   onclick="return confirm('{!! __('message.are_you_sure') !!}')"
                                                   class="btn btn-white red-bg btn-sm">
                                                    <i class="fa  fa-remove"></i> @lang('message.delete')
                                                </a>
                                                <a href="{{ route('backend.pages.edit',$page->id) }}"
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
                                    {{ $pages->links(currentBackView('pagination')) }}
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

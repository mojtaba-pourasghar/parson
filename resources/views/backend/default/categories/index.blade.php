@extends('layouts.default')
@section('title',__('category.list'))

@section('content')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-sm-4">
            <h2>@lang('category.list')</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{ route('backend.dashbord') }}">@lang('message.home')</a>
                </li>
                <li class="active">
                    <strong>@lang('category.list')</strong>
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
                            <a href="{{ route('backend.categories.create') }}"
                               class="btn btn-primary btn-xs">@lang('category.add')</a>
                        </div>
                    </div>

                    <div class="ibox-content">

                        <div class="row">
                            <div class="col-sm-10">
                                <form action="{{ route('backend.categories.index') }}" method="get">

                                    <div id="DataTables_Table_0_filter" class="col-sm-12">
                                        <div class="col-sm-4">
                                                <input type="search" name="search" class="form-control input-sm"
                                                       placeholder="{{ __('category.search_with_title') }}"
                                                       aria-controls="DataTables_Table_0"
                                                       value="{{ !empty(request()->input('search')) ? request()->input('search') : '' }}">
                                        </div>
                                        <div class="col-sm-2">
                                            {!! Form::select('picture_status',[
                                                '-1' => '------------',
                                                '1' =>__('book.with_picture'),
                                                '0'=>__('book.with_out_picture'),
                                            ], request()->input('picture_status') , ['class' => 'form-control']) !!}
                                        </div>
                                        <div class="col-sm-2">
                                            {!! Form::select('status',[
                                                '-1' => '------------',
                                                'WITH_OUT_INFORMATION' =>__('message.with_out_information'),
                                                'WITH_OUT_TEXT' =>__('message.with_out_text'),
                                                'FIRST_INFORMATION' =>__('message.first_information'),
                                                'EDITED' =>__('message.edited'),
                                                'SEO' =>__('message.seo'),
                                                'FINAL' =>__('message.final'),
                                                'CONTENT_PRODUCTION' =>__('message.content_production'),
                                                 'OTHER' =>__('message.other'),
                                            ],request()->input('status'), ['class' => 'form-control']) !!}
                                        </div>
                                        <div class="col-sm-2">
                                            {!! Form::select('state',[
                                                '-1' => '------------',
                                                '0' =>__('message.deactive'),
                                                '1'=>__('message.active'),
                                                '2' =>__('message.has_problem'),
                                            ], request()->input('state') , ['class' => 'form-control']) !!}
                                        </div>
                                        <button class="btn btn-primary btn-circle" type="submit"><i
                                                class="fa fa-search"></i></button>
                                    </div>
                                </form>
                            </div>
                            <div class="col-sm-2">
                                @include(currentBackView('partials.filter_list'),['url'=>url()->full(),'route_address'=>'backend.categories.index','filter_value'=>request()->input('filter')])
                            </div>

                        </div>

                        <div class="project-list">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>@lang('category.id')</th>
                                        <th>@lang('category.title')</th>
                                        <th>@lang('category.slug')</th>
                                        <th>@lang('category.thumbnail')</th>
                                        <th>@lang('category.state')</th>
                                        <th>@lang('message.action')</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($categories as $category)
                                        <tr>
                                            <td>{{ $category->ancestors->count() ? implode(' > ', $category->ancestors->pluck('title')->toArray()).'>'.$category->title  : $category->title  }} </td>
                                            <td>
                                                <a href="{{ route('backend.categories.edit',$category->id) }}">{{ $category['title'] }}</a>
                                            </td>
                                            <td>{{ $category['slug'] }}</td>
                                            <td><img src="{{ '/'.$path.'/'.$category['thumbnail'] }}" width="50"
                                                     height="50"></td>
                                            <td>
                                                @if($category['state'] ==1)
                                                    <span class="badge badge-primary">@lang('message.active')</span>
                                                @else
                                                    <span class="badge badge-danger">@lang('message.deactive')</span>
                                                @endif
                                            </td>

                                            <td>
                                                <a href="{{ route('backend.categories.delete',$category->id) }}"
                                                   onclick="return confirm('{!! __('message.are_you_sure') !!}')"
                                                   class="btn btn-white red-bg btn-sm">
                                                    <i class="fa  fa-remove"></i> @lang('message.delete')
                                                </a>
                                                <a href="{{ route('backend.categories.edit',$category->id) }}"
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
                                    {{ $categories->appends($_GET)->links(currentBackView('pagination')) }}
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

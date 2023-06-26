@extends('layouts.default')
@section('title',__('blogcomment.list').' : '.$blog->title)

@section('content')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-sm-4">
            <h2>@lang('blogcomment.list')</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{ route('backend.dashbord') }}">@lang('message.home')</a>
                </li>
                <li class="active">
                    <strong>@lang('blogcomment.list'){{ ' : '.$blog->title }}</strong>
                </li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="wrapper wrapper-content animated fadeInUp">

                <div class="ibox">


                    <div class="ibox-content">

                        <div class="row">
                            <div class="col-sm-6">
                                <form action="{{ route('backend.blogcomments.index',$blog_id) }}" method="get">

                                    <div id="DataTables_Table_0_filter" class="dataTables_filter">
                                        <div class="col-sm-3">
                                            <input type="search" name="search" class="form-control input-sm"
                                                   placeholder="{{ __('book.search_with_title') }}"
                                                   aria-controls="DataTables_Table_0" value="{{ !empty(request()->input('search')) ? request()->input('search') : '' }}">
                                        </div>
                                        <div class="col-sm-2">
                                            {!! Form::select('state',[
                                                '0' =>__('message.deactive'),
                                                '1'=>__('message.active'),
                                            ], request()->input('state') , ['class' => 'form-control']) !!}
                                        </div>
                                        <button class="btn btn-primary btn-circle" type="submit"><i
                                                class="fa fa-search"></i></button>
                                    </div>
                                </form>
                            </div>
                            <div class="col-sm-6">
                                @include(currentBackView('partials.filter_list'),['route_address'=>'backend.blogcomments.index','parameters'=>$blog_id])
                            </div>

                        </div>

                        <div class="project-list">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>@lang('blogcomment.id')</th>
                                        <th>@lang('blogcomment.name')</th>
                                        <th>@lang('user.email')</th>
                                        <th>@lang('blogcomment.comment')</th>
                                        <th>@lang('blogcomment.state')</th>
                                        <th>@lang('message.action')</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($blogcomments as $blogcomment)
                                        <tr>
                                            <td>{{ $blogcomment->id  }} </td>
                                            <td>{{ (!empty($blogcomment->user->name)) ? $blogcomment->user->name : $blogcomment->name }}</td>
                                            <td>{{ (!empty($blogcomment->email)) ? $blogcomment->email : $blogcomment->user->email  }}</td>
                                            <td>{{ $blogcomment->comment }}</td>
                                            <td>
                                                @if($blogcomment['state'] ==1)
                                                    <span class="badge badge-primary">@lang('message.active')</span>
                                                @else
                                                    <span class="badge badge-danger">@lang('message.deactive')</span>
                                                @endif
                                            </td>

                                            <td>
                                                <a href="{{ route('backend.blogcomments.delete',[$blog_id,$blogcomment->id]) }}"
                                                   onclick="return confirm('{!! __('message.are_you_sure') !!}')"
                                                   class="btn btn-white red-bg btn-sm">
                                                    <i class="fa  fa-remove"></i> @lang('message.delete')
                                                </a>
                                                <a href="{{ route('backend.blogcomments.edit',[$blog_id,$blogcomment->id]) }}"
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
                                    {{ $blogcomments->links(currentBackView('pagination')) }}
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@extends('layouts.default')
@section('title',__('order.list'))

@section('content')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-sm-4">
            <h2>@lang('order.list')</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{ route('backend.dashbord') }}">@lang('message.home')</a>
                </li>
                <li class="active">
                    <strong>@lang('order.list')</strong>
                </li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="wrapper wrapper-content animated fadeInUp">

                <div class="ibox">
                    <div class="ibox-title">


                    </div>

                    <div class="ibox-content">

                        <div class="row">
                            <div class="col-sm-6">
                                <form action="{{ route('backend.orders.index') }}" method="get">

                                    <div id="DataTables_Table_0_filter" class="dataTables_filter">
                                        <div class="col-sm-4">
                                            <input type="search" name="search" class="form-control input-sm"
                                                   placeholder="{{ __('order.search_with_order_id') }}"
                                                   aria-controls="DataTables_Table_0"
                                                   value="{{ !empty(request()->input('search')) ? request()->input('search') : '' }}">
                                        </div>
                                        <button class="btn btn-primary btn-circle" type="submit"><i
                                                class="fa fa-search"></i></button>
                                    </div>
                                </form>
                            </div>
                            <div class="col-sm-6">
                                @include(currentBackView('partials.filter_list'),['url'=>url()->full(),'route_address'=>'backend.orders.index','filter_value'=>request()->input('filter')])
                            </div>

                        </div>

                        <div class="project-list">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th></th>
                                        <th>@lang('order.id')</th>
                                        <th>@lang('order.order_code')</th>
                                        <th>@lang('order.recipient_name')</th>
                                        <th>@lang('order.telephon')</th>
                                        <th>@lang('order.item_count')</th>
                                        <th>@lang('order.sum_price')</th>
                                        <th>@lang('order.order_date')</th>
                                        <th>@lang('order.status')</th>
                                        <th>@lang('order.transaction_state')</th>
                                        <th>@lang('message.action')</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    {!! Form::open(['route' => 'backend.orders.index', 'method' => 'post']) !!}


                                    @foreach($orders as $order)
                                        <tr>
                                            <td><input type='checkbox' name='orders[]' value="{{ $order->id }}"></td>
                                            <td>{{ $order->id  }} </td>
                                            <td>{{ $order->code  }} </td>
                                            <td>{{ $order->user_detail->recipient_name  }} </td>
                                            <td>{{ $order->user_detail->telephon  }} </td>
                                            <td>{{ $order->items_count  }} </td>
                                            <td>{{ number_format($order->sum_price)  }} </td>
                                            <td>{{ $order->created_at  }} </td>
                                            <td>{{ user_order_status($order->status)  }} </td>
                                            <td>
                                                @if($order->transaction_pay->state ==1)
                                                    <span class="badge badge-primary">@lang('message.payed')</span>
                                                @else
                                                    <span class="badge badge-danger">@lang('message.not_pay')</span>
                                                @endif
                                            </td>

                                            <td>
                                                <a href="{{ route('backend.orders.delete',$order->id) }}"
                                                   onclick="return confirm('{!! __('message.are_you_sure') !!}')"
                                                   class="btn btn-white red-bg btn-sm">
                                                    <i class="fa  fa-remove"></i> @lang('message.delete')
                                                </a>
                                                <a href="{{ route('backend.orderitems.list',$order->id) }}"
                                                   class="btn btn-white btn-sm"><i
                                                        class="fa fa-list"></i> @lang('order.order_items')
                                                </a>
                                                <a href="javascript:void(0)" onclick="show_order_product({{$order->id}})"
                                                   class="btn btn-white btn-sm"><i
                                                        class="fa fa-print"></i> @lang('order.print')
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td>
                                            <select class="form-control input-sm" name="status">
                                                <option value="0">@lang('order.ordered')</option>
                                                <option value="1">@lang('order.deposited')</option>
                                                <option value="2">@lang('order.posted')</option>
                                                <option value="3">@lang('order.accepted')</option>
                                                <option value="4">@lang('order.accepted')</option>
                                                <option value="5">@lang('order.accepted')</option>
                                                <option value="8">@lang('order.checking')</option>
                                                <option value="9">@lang('order.not_accepted')</option>
                                            </select>
                                        </td>
                                        <td>
                                            <input type="submit" value="تغییر وضعیت" class="btn btn-info">
                                        </td>
                                    </tr>
                                    {!! Form::close() !!}
                                    </tbody>
                                </table>
                            </div>
                            <div class="row">

                                <div class="col-sm-12">
                                    {{ $orders->appends($_GET)->links(currentBackView('pagination')) }}
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function show_order_product(id){
            var url = '{{ route("backend.orderitems.print", [":id"]) }}';
            url = url.replace(':id', id);
            window.open(url,'_blank', 'toolbar=0,location=0,menubar=0,resizable=1');
        }
    </script>

@endsection

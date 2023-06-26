@extends('layouts.default')
@section('title',__('order.order_code').': '.$order->code)

@section('content')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-sm-4">
            <h2>@lang('order.list')</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{ route('backend.dashbord') }}">@lang('message.home')</a>
                </li>
                <li>
                    <a href="{{ route('backend.orders.index') }}">@lang('order.list')</a>
                </li>
                <li class="active">
                    <strong>@lang('order.list'){{ ': '.$order->code }}</strong>
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

                            </div>
                            <div class="col-sm-6">

                            </div>

                        </div>

                        <div class="project-list">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th></th>
                                        <th>@lang('textile.title')</th>
                                        <th>@lang('textile.barcode')</th>
                                        <th>@lang('textile.price')</th>
                                        <th>@lang('order.item_count')</th>
                                        <th>@lang('textile.color')</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($orderItems as $orderItem)
                                        <tr>
                                            <td>
                                                <img height="100px" width="100px"
                                                     src="{{ (count($orderItem->textile->images)>0) ? $orderItem->textile->images[0]->image : ''}}"
                                                     alt="{{ $orderItem->textile->title }}">
                                            </td>
                                            <td>
                                                <a href="{{ route('backend.textiles.edit',$orderItem->textile->id) }}">{{ $orderItem->textile->title  }} </a>
                                            </td>
                                            <td>{{ $orderItem->textile->barcode  }} </td>
                                            <td>{{ number_format($orderItem->textile->price)  }} </td>
                                            <td>{{ $orderItem->item_count  }} </td>
                                            <td><span style="height: 20px;width: 20px;display: block;border-radius: 10px;background-color: {{ $orderItem->color  }}"> &nbsp;</span>  </td>
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

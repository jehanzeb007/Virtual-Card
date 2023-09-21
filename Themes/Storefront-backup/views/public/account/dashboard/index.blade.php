@extends('public.account.layout')

@section('title', trans('storefront::account.links.dashboard'))
<style>

    .circle-tile {
        margin-bottom: 15px;
        text-align: center;
    }
    .circle-tile-heading {
        border: 3px solid rgba(255, 255, 255, 0.3);
        border-radius: 100%;
        color: #FFFFFF;
        height: 80px;
        margin: 0 auto -40px;
        position: relative;
        transition: all 0.3s ease-in-out 0s;
        width: 80px;
    }
    .circle-tile-heading .fa {
        line-height: 80px;
    }
    .circle-tile-content {
        padding-top: 50px;
    }
    .circle-tile-number {
        font-size: 26px;
        font-weight: 700;
        line-height: 1;
        padding: 5px 0 15px;
    }
    .circle-tile-description {
        text-transform: uppercase;
    }
    .circle-tile-footer {
        background-color: rgba(0, 0, 0, 0.1);
        color: rgba(255, 255, 255, 0.5);
        display: block;
        padding: 5px;
        transition: all 0.3s ease-in-out 0s;
    }
    .circle-tile-footer:hover {
        background-color: rgba(0, 0, 0, 0.2);
        color: rgba(255, 255, 255, 0.5);
        text-decoration: none;
    }
    .circle-tile-heading.dark-blue:hover {
        background-color: #2E4154;
    }
    .circle-tile-heading.green:hover {
        background-color: #138F77;
    }
    .circle-tile-heading.orange:hover {
        background-color: #DA8C10;
    }
    .circle-tile-heading.blue:hover {
        background-color: #2473A6;
    }
    .circle-tile-heading.red:hover {
        background-color: #CF4435;
    }
    .circle-tile-heading.purple:hover {
        background-color: #7F3D9B;
    }
    .tile-img {
        text-shadow: 2px 2px 3px rgba(0, 0, 0, 0.9);
    }

    .dark-blue {
        background-color: #34495E;
    }
    .green {
        background-color: #16A085;
    }
    .blue {
        background-color: #2980B9;
    }
    .orange {
        background-color: #F39C12;
    }
    .red {
        background-color: #E74C3C;
    }
    .purple {
        background-color: #6744db;
    }
    .dark-gray {
        background-color: #7F8C8D;
    }
    .gray {
        background-color: #95A5A6;
    }
    .light-gray {
        background-color: #BDC3C7;
    }
    .yellow {
        background-color: #F1C40F;
    }
    .text-dark-blue {
        color: #34495E;
    }
    .text-green {
        color: #16A085;
    }
    .text-blue {
        color: #2980B9;
    }
    .text-orange {
        color: #F39C12;
    }
    .text-red {
        color: #E74C3C;
    }
    .text-purple {
        color: #6744db;
    }
    .text-faded {
        color: rgba(255, 255, 255, 0.7);
    }


</style>
@section('content_right')
    <div class="my-dashboard">
        <div class="recent-orders index-table">
            <div class="row">
                <div class="col-md-3">
                    <div class="circle-tile ">
                        <a href="#"><div class="circle-tile-heading purple"><i class="fa fa-shopping-cart fa-fw fa-3x"></i></div></a>
                        <div class="circle-tile-content blue">
                            <div class="circle-tile-description text-faded"> Total Orders</div>
                            <div class="circle-tile-number text-faded ">{{$total_orders}}</div>
                            <a class="circle-tile-footer" href="#"><i class="fa fa-chevron-circle-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="circle-tile ">
                        <a href="#"><div class="circle-tile-heading purple"><i class="fa fa-shopping-cart fa-fw fa-3x"></i></div></a>
                        <div class="circle-tile-content green">
                            <div class="circle-tile-description text-faded"> Completed Orders </div>
                            <div class="circle-tile-number text-faded ">{{$completed_orders}}</div>
                            <a class="circle-tile-footer" href="#"><i class="fa fa-chevron-circle-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="circle-tile ">
                        <a href="#"><div class="circle-tile-heading purple"><i class="fa fa-money fa-fw fa-3x"></i></div></a>
                        <div class="circle-tile-content red">
                            <div class="circle-tile-description text-faded"> Total Pay </div>
                            <div class="circle-tile-number text-faded ">{{number_format($total_pay,2)}}</div>
                            <a class="circle-tile-footer" href="#"><i class="fa fa-chevron-circle-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="circle-tile ">
                        <a href="#"><div class="circle-tile-heading purple"><i class="fa fa-money fa-fw fa-3x"></i></div></a>
                        <div class="circle-tile-content red">
                            <div class="circle-tile-description text-faded"> Total Discount </div>
                            <div class="circle-tile-number text-faded ">{{number_format($total_discount,2)}}</div>
                            <a class="circle-tile-footer" href="#"><i class="fa fa-chevron-circle-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="recent-orders index-table">
            <h4 class="section-header">
                {{ trans('storefront::account.dashboard.recent_orders') }}

                @if ($recentOrders->isNotEmpty())
                    <a href="{{ route('account.orders.index') }}" class="pull-right">
                        {{ trans('storefront::account.dashboard.view_all') }}
                    </a>
                @endif
            </h4>

            @if ($recentOrders->isEmpty())
                <span>{{ trans('storefront::account.orders.no_orders') }}</span>
            @else
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>{{ trans('storefront::account.orders.order_id') }}</th>
                            <th>{{ trans('storefront::account.orders.date') }}</th>
                            <th>{{ trans('storefront::account.orders.status') }}</th>
                            <th>{{ trans('storefront::account.orders.total') }}</th>
                            <th></th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach ($recentOrders as $order)
                            <tr>
                                <td>#{{ $order->id }}</td>
                                <td>{{ $order->created_at->toFormattedDateString() }}</td>
                                <td>{{ $order->status() }}</td>
                                <td>{{ $order->total->convert($order->currency, $order->currency_rate)->format($order->currency) }}</td>
                                <td>
                                    <a href="{{ route('account.orders.show', $order) }}" class="btn-view" data-toggle="tooltip" title="{{ trans('storefront::account.orders.view_order') }}" rel="tooltip">
                                        <i class="fa fa-eye" aria-hidden="true"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>

        <div class="clearfix"></div>

        <div class="account-information clearfix">
            <h4>{{ trans('storefront::account.dashboard.account_information') }}</h4>

            <div class="col-md-6">
                <div class="row">
                    <div class="contact-information">
                        <span>{{ $my->full_name }}</span>
                        <span>{{ $my->email }}</span>

                        <a href="{{ route('account.profile.edit') }}">
                            {{ trans('storefront::account.dashboard.edit') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

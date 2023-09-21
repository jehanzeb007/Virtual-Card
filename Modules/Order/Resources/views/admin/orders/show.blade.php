@extends('admin::layout')

@component('admin::components.page.header')
    @slot('title', trans('admin::resource.show', ['resource' => trans('order::orders.order')]))

    <li><a href="{{ route('admin.orders.index') }}">{{ trans('order::orders.orders') }}</a></li>
    <li class="active">{{ trans('admin::resource.show', ['resource' => trans('order::orders.order')]) }}</li>
@endcomponent

@section('content')
    <div class="order-wrapper">
        @include('order::admin.orders.partials.order_and_account_information')
        @include('order::admin.orders.partials.address_information')
        @include('order::admin.orders.partials.items_ordered')
        @include('order::admin.orders.partials.order_totals')
    </div>
@endsection
@push('scripts')
<script>
    function save_information(_text,order_id) {
        $.ajax({
            type: "PUT",
            url: '{{route('admin.orders.status.updatelog')}}',
            data: {
                _text: _text,
                order_id:order_id
            },
            success: function(t) {

            },
            error: function(t) {

            }
        });
    }
</script>
@endpush
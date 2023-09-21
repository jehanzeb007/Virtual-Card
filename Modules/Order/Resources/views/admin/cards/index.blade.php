@extends('admin::layout')

@component('admin::components.page.header')
    @slot('title', trans('Cards'))

    <li class="active">{{ trans('card::cards.card') }}</li>
@endcomponent

@section('content')
    <div class="box box-primary">
        <form action="{{route('admin.cards.generate')}}" method="post" autocomplete="off">
            @csrf
            <div class="row">
                <div class="col-md-12">
                    <h3 style="margin: 20px;">Generate New Cards URL</h3>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="name" class="col-md-3 control-label text-left">Quantity<span class="m-l-5 text-red">*</span></label>
                        <div class="col-md-9">
                            <input placeholder="eg 100" required name="quantity" class="form-control mb-5" id="quantity"
                                   type="text" value="">
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="name" class="col-md-3 control-label text-left">Batch Name<span class="m-l-5 text-red">*</span></label>
                        <div class="col-md-9">
                            <input placeholder="Ex. Roots Group Batch" required name="batch_name" class="form-control mb-5" id="batch_name"
                                   type="text" value="">
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-md-offset-3" style="margin-top: 20px;margin-bottom: 10px;">
                    <button type="submit" class="btn btn-primary">
                        Generate
                    </button>
                </div>
            </div>
        </form>
    </div>
    <div class="box box-primary">
        <form action="" method="get" autocomplete="off">
            <div class="row">
                <div class="col-md-12">
                    <h3 style="margin: 20px;">Search Cards Url</h3>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="name" class="col-md-3 control-label text-left">Id</label>
                        <div class="col-md-12">
                            <input placeholder="eg TkFnY2NfYWJnY2NfYWI-" name="id_search" class="form-control mb-5"
                                   type="text" value="{{$_GET['id_search']}}">
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="name" class="col-md-3 control-label text-left">Status</label>
                        <div class="col-md-12">
                            <select name="status" class="form-control">
                                <option value="">Select Status</option>
                                <option value="Available" {{$_GET['status'] == 'Available'?'selected':''}}>Available
                                </option>
                                {{--<option value="Purchased" {{$_GET['status'] == 'Purchased'?'selected':''}}>Purchased</option>--}}
                                <option
                                    value="Used" {{($_GET['status'] == 'Used' || $_GET['status'] == 'Purchased')?'selected':''}}>
                                    Used
                                </option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mt-5">&nbsp;</div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="name" class="col-md-3 control-label text-left">Batch Group</label>
                        <div class="col-md-12">
                            <input placeholder="Ex. Roots Group Batch" name="batch_name" class="form-control mb-5"
                                   type="text" value="{{$_GET['batch_name']}}">
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group" style="margin-top: 25px;">
                        <label for="name" class="col-md-2 control-label text-left">Id Start</label>
                        <div class="col-md-4">
                            <input placeholder="5" name="id_start" class="form-control"
                                   type="text" value="{{$_GET['id_start']}}">
                        </div>
                        <label for="name" class="col-md-2 control-label text-left">Id End</label>
                        <div class="col-md-4">
                            <input placeholder="50" name="id_end" class="form-control"
                                   type="text" value="{{$_GET['id_end']}}">
                        </div>
                    </div>
                </div>

                <div class="col-md-12 mt-5">&nbsp;</div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="name" class="col-md-3 control-label text-left">Date Start</label>
                        <div class="col-md-12">
                            <input placeholder="Select Start Date" readonly="" name="date_start" class="form-control datetime-picker"
                                   type="text" value="{{$_GET['date_start']}}">
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="name" class="col-md-3 control-label text-left">Date End</label>
                        <div class="col-md-12">
                            <input placeholder="Select End Date" readonly="" name="date_end" class="form-control datetime-picker"
                                   type="text" value="{{$_GET['date_end']}}">
                        </div>
                    </div>
                </div>

                <div class="col-md-12" style="margin: 20px;">
                    <button type="submit" class="btn btn-primary">
                        Search
                    </button>
                    <a href="{{route('admin.cards.index')}}" class="btn btn-danger">
                        Reset
                    </a>
                </div>
            </div>
        </form>
    </div>
    <div class="box box-primary">
        <div class="box-body index-table">
            <form target="_blank" action="{{route('admin.cards.export')}}" method="post" autocomplete="off">
                @csrf
                {{--<div class="pull-right" style="margin: 10px;">
                    Available <input type="checkbox" checked name="available">
                    Purchased <input type="checkbox" checked name="purchased">
                    Used <input type="checkbox" checked name="used">
                </div>--}}
                <button type="submit" class="pull-right btn btn-primary" style="margin-bottom: 10px;">
                    Export
                </button>
            </form>
            <table class="table">
                <tr>v
                    <th><input type="checkbox"></th>
                    <th>#</th>
                    <th>ID</th>
                    <th>{{ trans('admin::admin.table.url') }}</th>
                    {{--<th>URL assigned?</th>--}}
                    <th>{{ trans('admin::admin.table.status') }}</th>
                    <th>{{ trans('admin::admin.table.detail') }}</th>
                    <th>Batch Name</th>
                </tr>
                @foreach($cards_user_data as $key => $cards_user_row)
                    <tr>
                        <td><input type="checkbox"></td>
                        <td>{{ $cards_user_data->firstItem() + $key }}</td>
                        <td>{{ $cards_user_row->id }}</td>
                        <td>
                            {{route('cardLogin',\_encode($cards_user_row->id))}}
                            {{--<a target="_private" href="{{route('cardLogin',\_encode($cards_user_row->id))}}">{{route('cardLogin',\_encode($cards_user_row->id))}}</a>--}}</td>

                        @php
                            $check = 'No';
                            if($cards_user_row['url_assigned'] == '1') {
                                $check = 'Yes';
                            }
                        @endphp
                        {{--<td>{{$check}}</td>--}}
                        @php
                            if($cards_user_row['email'] == 'NULL'){
                                $status = '<span class="label label-success">Available</label>';
                            }  else{
                                $status = '<span class="label label-danger">Used</label>';
                            }
                        @endphp
                        <td>{!! $status !!}</td>
                        <td>
                            {!! !empty($cards_user_row->order_id)?'<a target="_blank" class="pull-right label label-success" href="'.url('admin/orders/'.$cards_user_row->order_id).'"><i class="fa fa-eye"></i></a>':'' !!}
                            <img style="width: 150px" src='{{getBarCodeImage($cards_user_row->id,'url')}}'/>
                        </td>
                        <td>{{ $cards_user_row->batch_name }}</td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="4">{{ $cards_user_data->links() }}</td>
                </tr>
            </table>
        </div>
    </div>
    <script type="text/javascript" src="{{ v(Theme::url('public/new/js/jquery.js'))}}"></script>
    <script>
        jQuery(document).ready(function ($) {
            jQuery('.urlAssigned').change(function () {
                if (confirm('Change status?')) {
                    let formData = new FormData();
                    formData.append('id', jQuery(this).data('id'));
                    formData.append('value', jQuery(this).val());
                    jQuery.ajax({
                        type: "POST",
                        url: '/admin/cards/',
                        data: formData,
                        success: function (t) {
                            console.log(t);
                        },
                        error: function (t) {

                        }
                    });
                }
            });
        });
    </script>
@endsection

{{--@push('scripts')
    <script>

    </script>
@endpush--}}



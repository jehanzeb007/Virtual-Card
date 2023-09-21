<div class="items-ordered-wrapper">
    <h3 class="section-title">{{ trans('order::orders.items_ordered') }}</h3>

    <div class="row">
        <div class="col-md-12">
            <div class="items-ordered">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>{{ trans('order::orders.product') }}</th>
                            <th>{{ trans('order::orders.unit_price') }}</th>
                            <th>{{ trans('order::orders.quantity') }}</th>
                            <th>{{ trans('order::orders.line_total') }}</th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach ($order->products as $product)
                            <tr>
                                <td>

                                    @if ($product->trashed())
                                        {{ $product->name }}
                                    @else
                                        <a href="{{ route('admin.products.edit', $product->product->id) }}">{{ $product->name }}</a>
                                    @endif
                                    @if(!empty($product->custom_image))
                                        <p><a style="color: red;" href="{{url('order_images/'.$product->custom_image)}}" target="_blank">View Design</a></p>
                                    @endif
                                    @if ($product->hasAnyOption())
                                        <br>
                                        @foreach ($product->options as $option)
                                            <span>
                                                    {{ $option->name }}:
                                                    <span>{{ $option->values->implode('label', ', ') }}</span>
                                                </span>
                                        @endforeach
                                    @endif
                                    @php
                                        $associate_users = json_decode($product->associate_users);
                                    @endphp
                                    @if(!empty($associate_users))
                                        <br>

                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                                                USERS URL
                                            </button>

                                            <!-- Modal -->
                                            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">USERS URL</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <table class="table">
                                                                <thead>
                                                                <tr>
                                                                    <th scope="col">#</th>
                                                                    <th scope="col">Login URL</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                @foreach($associate_users as $key=>$associate_user)
                                                                <tr>
                                                                    <th scope="row">{{($key+1)}}</th>
                                                                    <td>{{route('cardLogin',\_encode($associate_user))}}</td>
                                                                </tr>
                                                                @endforeach
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                    @endif
                                </td>

                                <td>
                                    {{ $product->unit_price->format($order->currency) }}
                                </td>

                                <td>{{ intl_number($product->qty) }}</td>

                                <td>
                                    {{ $product->line_total->format($order->currency) }}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

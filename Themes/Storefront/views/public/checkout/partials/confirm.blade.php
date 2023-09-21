<div id="confirm" class="tab-pane" role="tabpanel">
    <div class="box-wrapper confirm clearfix">
        <div class="box-header">
            <h4>{{ trans('storefront::checkout.tabs.confirm.item_list') }}</h4>
        </div>

        <div class="order-list cart-list">
            <div class="table-responsive">
                <table class="table">
                    <thead class="hidden-xs">
                    <tr>
                        <th>{{ trans('storefront::checkout.tabs.confirm.product') }}</th>
                        <th class="text-center">{{ trans('storefront::checkout.tabs.confirm.price') }}</th>
                        <th class="text-center">{{ trans('storefront::checkout.tabs.confirm.quantity') }}</th>
                        <th class="text-center">{{ trans('storefront::checkout.tabs.confirm.total') }}</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach ($cart->items() as $cartItem)
                        <tr>
                            <td>
                                @if (! $cartItem->product->base_image->exists)
                                    <div class="image-placeholder">
                                        <i class="fa fa-picture-o" aria-hidden="true"></i>
                                    </div>
                                @else
                                    <div class="image-holder">
                                        <img src="{{ $cartItem->product->base_image->path }}">
                                    </div>
                                @endif
                                <h5>
                                    {{ $cartItem->product->name }}
                                </h5>

                                <div class="option">
                                    @foreach ($cartItem->options as $option)
                                        <span>{{ $option->name }}: <span>{{ $option->values->implode('label', ', ') }}</span></span>
                                    @endforeach
                                </div>
                                @if(!empty($cartItem->custom_design_image))
                                    <a href="{{$cartItem->custom_design_image}}" target="_blank">View Design</a>
                                @endif
                            </td>

                            <td class="text-center priceCart">
                                <label class="visible-xs">{{ trans('storefront::checkout.tabs.confirm.price') }}
                                    :</label>
                                <span>{{ $cartItem->unitPrice()->convertToCurrentCurrency()->format() }}</span>
                            </td>

                            <td class="text-center">
                                <label class="visible-xs">{{ trans('storefront::checkout.tabs.confirm.quantity') }}
                                    :</label>
                                <span>{{ intl_number($cartItem->qty) }}</span>
                            </td>

                            <td class="text-center">
                                <label class="visible-xs">{{ trans('storefront::checkout.tabs.confirm.total') }}
                                    :</label>
                                <span>{{ $cartItem->total()->convertToCurrentCurrency()->format() }}</span>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <button type="button" class="btn btn-default prev-step pull-right">
            {{ trans('storefront::checkout.back') }}
        </button>
    </div>

    @include('public.checkout.partials.payment_instructions', ['paymentMethod' => 'bank_transfer'])
    @include('public.checkout.partials.payment_instructions', ['paymentMethod' => 'check_payment'])
</div>

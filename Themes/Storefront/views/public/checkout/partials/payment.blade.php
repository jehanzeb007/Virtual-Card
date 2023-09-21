<div id="payment" class="tab-pane" role="tabpanel">
    <div class="box-wrapper payment clearfix">
        <div class="box-header">
            <h4>{{ trans('storefront::checkout.tabs.payment.payment_method') }}</h4>
        </div>
        <ul class="list-inline payment-method clearfix">
            @forelse ($gateways as $name => $gateway)
                <li>
                    <div class="row">
                        <div class="col-md-9">
                            <div class="form-group radio">
                                <input type="radio" name="payment_method" value="{{ $name }}" id="{{ $name }}" {{ $loop->first ? 'checked' : '' }} {{ old('payment_method') === $name ? 'checked' : '' }}>
                                <label for="{{ $name }}">{{ $gateway->label }}</label>
                            </div>
                            <!--p>{{ $gateway->description }}</p-->
                            <p>Pay with your credit/debit card via PayPal.</p>
                        </div>
                        <div class="col-md-3">
                            <img class="img-responsive pull-right" src="{{url('payment_images/'.$name.'.png')}}">
                        </div>
                    </div>
                    <hr>
                </li>
            @empty
                <p class="error-message">{{ trans('storefront::checkout.tabs.payment.no_payment_method') }}</p>
            @endforelse

            {!! $errors->first('payment_method','<span class="error-message">:message</span>') !!}
        </ul>

        <button type="button" class="btn btn-primary next-step pull-right" {{ $gateways->isEmpty() ? 'disabled' : '' }}>
            {{ trans('storefront::checkout.continue') }}
        </button>

        <button type="button" class="btn btn-default prev-step pull-right">
            {{ trans('storefront::checkout.back') }}
        </button>
    </div>
</div>

<div class="col-md-4">
	<div class="product_main">
        <img src="{{ $product->base_image->path }}" alt="">
        <form id="add_to_cart_form" style="display: {!! $add_to_display !!};" method="POST" action="{{ route('cart.items.store') }}" class="clearfix">
            <input type="hidden" name="custom_uploaded_design" id="custom_uploaded_design">
            {{ csrf_field() }}
            <input type="hidden" name="product_id" value="{{ $product->id }}">
            <div class="custom_number" style="display: none;">
                <input type="hidden" name="qty" value="1" class="input-number input-quantity pull-left" id="qty" min="1" max="{{ $product->manage_stock ? $product->qty : '' }}">
            </div>
            <button type="submit" class="add_to_cart_link addProduct {{ $product->isOutOfStock() ? 'disabled' : '' }}" {{ $product->isOutOfStock() ? 'disabled' : '' }} data-loading>
                {{ $product->isOutOfStock() ? 'Out of Stock' : trans('storefront::product.add_to_cart') }}
            </button>
        </form>
        <h3>{{ $product->name }}</h3>
		<div class="price_cont">
            <!--span class="prod_price">{{ product_price($product) }}</span-->
            <button class="btn btn-primary">{{ product_price($product) }}</button>
		</div>
	</div>
</div>

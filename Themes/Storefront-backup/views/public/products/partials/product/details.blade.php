<div class="col-lg-8 col-md-7 col-sm-7 col-xs-12">
    <div class="product-details">
        <h1 class="product-name">{{ $product->name }}</h1>
        @if (setting('reviews_enabled'))
            @include('public.products.partials.product.rating', ['rating' => $product->avgRating()])
            <span class="product-review">
                ({{ intl_number($product->reviews->count()) }} {{ trans('storefront::product.customer_reviews') }})
            </span>
        @endif
        @unless (is_null($product->sku))
            <div class="sku">
                <label>{{ trans('storefront::product.sku') }}: </label>
                <span>{{ $product->sku }}</span>
            </div>
        @endunless
        <div class="clearfix"></div>
        <div class="availability pull-left" style="margin-left: 0;">
			<label>Category: </label>
			@php
			$i = 0;
			$len = count($categories);
			foreach($categories as $cat){
			$comma=(($len -1) > $i)?', ':'';
			$url=url('/products?category='.$cat['slug']);
			echo '<a href="'.$url.'">'.ucfirst(str_replace('-',' ',$cat['slug'])).'</a>'.$comma;
			$i++;
			}
			@endphp
		</div>
        <div class="clearfix"></div>
        <span class="product-price pull-left">{{ product_price($product) }}</span>
        <div class="availability pull-left">
            <label>{{ trans('storefront::product.availability') }}:</label>
            @if ($product->in_stock)
                <span class="in-stock">{{ trans('storefront::product.in_stock') }}</span>
            @else
                <span class="out-of-stock">{{ trans('storefront::product.out_of_stock') }}</span>
            @endif
        </div>
        <div class="clearfix"></div>
        @if (! is_null($product->short_description))
            <div class="product-brief">{{ $product->short_description }}</div>
        @endif
        @php
            if($product->allow_upload_file == '1'){
                $add_to_display = 'none';
            }else{
                $add_to_display = 'block';
            }

        @endphp
        <form id="add_to_cart_form" style="display: {!! $add_to_display !!};" method="POST" action="{{ route('cart.items.store') }}" class="clearfix">
            <input type="hidden" name="custom_uploaded_design" id="custom_uploaded_design">
            {{ csrf_field() }}
            <input type="hidden" name="product_id" value="{{ $product->id }}">
            <div class="product-variants clearfix">
                @foreach ($product->options as $option)
                    <div class="row">
                        <div class="col-md-7 col-sm-9 col-xs-10">
                            @includeIf("public.products.partials.product.options.{$option->type}")
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="quantity pull-left clearfix">
                <label class="pull-left" for="qty">{{ trans('storefront::product.qty') }}</label>

                <div class="input-group-quantity pull-left clearfix">
                    <input type="text" name="qty" value="1" class="input-number input-quantity pull-left" id="qty" min="1" max="{{ $product->manage_stock ? $product->qty : '' }}">

                    <span class="pull-left btn-wrapper">
                        <button type="button" class="btn btn-number btn-plus" data-type="plus"> + </button>
                        <button type="button" class="btn btn-number btn-minus" data-type="minus" disabled> &#8211; </button>
                    </span>
                </div>
            </div>
            <button type="submit" class="add-to-cart btn btn-primary pull-left" {{ $product->isOutOfStock() ? 'disabled' : '' }} data-loading>
                {{ trans('storefront::product.add_to_cart') }}
            </button>
        </form>
        <div class="clearfix"></div>
<!--
        <div class="add-to clearfix pull-right" style="margin-bottom: 10px;">
            <form method="POST" action="{{ route('wishlist.store') }}">
                {{ csrf_field() }}
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <button type="submit" class="btn" style="padding: 2px; margin-bottom: 2px;" data-toggle="tooltip" title="{{ trans('storefront::product.add_to_wishlist') }}"><i class="fa fa-heart"></i></button>
            </form>

            <form method="POST" action="{{ route('compare.store') }}">
                {{ csrf_field() }}
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <button type="submit" class="btn" style="padding: 2px; margin-bottom: 2px;" data-toggle="tooltip" title="{{ trans('storefront::product.add_to_compare') }}"><i class="fa fa-balance-scale" aria-hidden="true"></i></button>
            </form>
        </div>
        <div class="clearfix"></div>
-->
        <div class="row clearfix">
            <div class="col-md-8" id="uploaded_image_container"></div>
        </div>
        <div class="clearfix"></div>

        @if($product->allow_upload_file == '1')
            <div class="select_design_type clearfix">
                <div class="row">
                    <div class="link-box-with-icon_container">
                        <!-- <div class="link-box-with-icon">
                            <div class="link-box-icon-holder">
                                <img src="images/design-your-own.png">
                            </div>
                            <a href="" class="link-box-text-holder">DESIGN YOUR OWN IDEAL CARD</a>
                        </div> -->
                        <div class="link-box-with-icon">
                            <div class="link-box-icon-holder">
                                <img src="https://www.theidealcard.com/assets/themes/default/images/upload-your-own.png">
                            </div>
                            <a href="javascript:void(0)" onclick="show_design_type('upload_custom')" class="link-box-text-holder">UPLOAD YOUR OWN DESIGN</a>
                        </div>
                        <div class="link-box-with-icon">
                            <div class="link-box-icon-holder">
                                <img src="https://www.theidealcard.com/assets/themes/default/images/let-us-design-for-you.png">
                            </div>
                            <a href="javascript:void(0)"  onclick="show_design_type('use_anyone')" class="link-box-text-holder">LET US DESIGN ONE FOR YOU</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="uploader clearfix" id="upload_custom_design" style="display: none;">
                <div class="col-md-8 col-sm-12">
                    <div class="mb-3 dm-uploader p-5" id="drag-and-drop-zone">
                        <div class="form-row align-items-center">
                            <div class="from-group mb-2">
                                <label>Drop image here or click upload button:</label>
                                <br>
                                <div class="progress mb-2 d-none">
                                    <div class="progress-bar progress-bar-striped progress-bar-animated bg-primary" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="0"> 0% </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div role="button" class="btn btn-primary mr-2"> <i class="fa fa-folder-o fa-fw"></i>
                                    <input type="file" class="checkout-file" title="Click to add Files" accept="image/*;capture=camera" /> <span>Upload{{--__('msg.upload')--}}</span> </div>
                                <br><small class="status text-muted">{{__('msg.for-quick-processed-upload-file')}}</small> </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 d-md-block d-sm-none">
                    <span style="display: inline-block; padding-bottom: 10px;">Guide Lines:</span>
                    <img src="{{ v(Theme::url('public/images/file_upload_specs.png'))}}" alt="..." class="img-thumbnail">
                </div>
            </div>
        @endif
    </div>
</div>

@extends('public.layout')

@section('title', $product->name)

@push('meta')
    <meta name="title" content="{{ $product->meta->meta_title }}">
    <meta name="keywords" content="{{ implode(',', $product->meta->meta_keywords) }}">
    <meta name="description" content="{{ $product->meta->meta_description }}">
    <meta property="og:title" content="{{ $product->meta->meta_title }}">
    <meta property="og:description" content="{{ $product->meta->meta_description }}">
    <meta property="og:image" content="{{ $product->baseImage->path }}">
<style>
    /* Preview */
    .preview{
        width: 100px;
        height: 100px;
        border: 1px solid black;
        margin: 0 auto;
        background: white;
    }

    .preview img{
        display: none;
    }
    /* Button */
    .button{
        border: 0px;
        background-color: deepskyblue;
        color: white;
        padding: 5px 15px;
        margin-left: 10px;
    }
</style>
@endpush

@section('breadcrumb')
    <li><a href="{{ route('products.index') }}">{{ trans('storefront::products.shop') }}</a></li>
    <li class="active">{{ $product->name }}</li>
@endsection

@section('content')
    <div class="product-details-wrapper">
		<div class="container">
        <div class="row">
            @include('public.products.partials.product.images')
            @include('public.products.partials.product.details')
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="tab product-tab clearfix">
                    <ul class="nav nav-tabs">
                        <li class="{{ request()->has('reviews') || review_form_has_error($errors) ? '' : 'active' }}">
                            <a data-toggle="tab" href="#description">{{ trans('storefront::product.tabs.description') }}</a>
                        </li>

                        @if ($product->hasAnyAttribute())
                            <li>
                                <a data-toggle="tab" href="#additional-information">{{ trans('storefront::product.tabs.additional_information') }}</a>
                            </li>
                        @endif

                        @if (setting('reviews_enabled'))
                            <li class="{{ request()->has('reviews') || review_form_has_error($errors) ? 'active' : '' }} {{ review_form_has_error($errors) ? 'error' : '' }}">
                                <a data-toggle="tab" href="#reviews">{{ trans('storefront::product.tabs.reviews') }}</a>
                            </li>
                        @endif
                    </ul>

                    <div class="tab-content">
                        @include('public.products.partials.product.tab_contents.description')

                        @if ($product->hasAnyAttribute())
                            @include('public.products.partials.product.tab_contents.additional_information')
                        @endif

                        @includeWhen(setting('reviews_enabled'), 'public.products.partials.product.tab_contents.reviews')
                    </div>
                </div>
            </div>
        </div>

</div>
    </div>

    @include('public.products.partials.landscape_products', [
        'title' => trans('storefront::product.related_products'),
        'products' => $relatedProducts
    ])

    @include('public.products.partials.landscape_products', [
        'title' => trans('storefront::product.you_might_also_like'),
        'products' => $upSellProducts
    ])
@endsection
@push('custom_js')
<script>
    var upload_file_url = '{{route('product.upload-custom-design')}}';
    var maxFileSize = 3000000; // 3 Megs max
    var allowedTypes = 'image/*';
    var extFilter = ['jpg','jpeg','png','gif'];
    var dropContainer = '#drag-and-drop-zone';
    var responseContainer = '#custom_uploaded_design';

</script>
<script src="{{ v(Theme::url('public/js/uploader/checkout_file_uploader.js'))}}"></script>
<script>
    $(document).ready(function () {
        initUploader();
    });
    function show_design_type(_type) {
        $('.select_design_type').hide();

        if(_type == 'upload_custom'){
            $('#upload_custom_design').show();
        }
        if(_type == 'use_anyone'){
            $('#custom_uploaded_design').val('');
            $('#add_to_cart_form').show();
        }
    }
    function changeUploadedImage() {
        $('.select_design_type').hide();
        $('#upload_custom_design').show();
        $('#add_to_cart_form').hide();
        $('#uploaded_image_container').html('');
    }
</script>
@endpush
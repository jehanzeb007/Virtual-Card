@extends('public.layout')

@section('title')
    @if (request()->has('query'))
        {{ trans('storefront::products.search_results_for') }}: "{{ request('query') }}"
    @else
        {{ trans('storefront::products.shop') }}
    @endif
@endsection

@section('content')

<div class="banner_area prod_page_banner">
	<div class="container">
		<div class="row">
			<div class="col-md-7 offset-md-3 wow bounceInLeft" data-wow-duration="1.5s" data-wow-delay="0.2s">
				<h1>{{ trans('storefront::product.title') }}</h1>
				<p>{{ trans('storefront::product.subtitle') }}</p>
			</div>
		</div>
	</div>
</div>
<div class="content_area">
	<div class="container">
		<div class="row">
			@forelse ($products as $product)
              @include('public.products.partials.list_view_product_card')
              @empty
              <h3 class="notFound">{{ trans('storefront::products.no_products_were_found') }}</h3>
              @endforelse
		</div>
	</div>
</div>
@endsection

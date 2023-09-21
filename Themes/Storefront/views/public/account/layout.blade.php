@extends('public.layout')

@if(!request()->routeIs('account.profile.edit'))
@section('breadcrumb')
    @if (request()->routeIs('account.dashboard.index'))
    <li class="active">{{ trans('storefront::account.links.my_account') }}</li>
@else
<li><a href="{{ route('account.dashboard.index') }}">{{ trans('storefront::account.links.my_account') }}</a></li>
@endif
@yield('account_breadcrumb')
@endsection
@endif
 @unless (request()->routeIs('account.profile.edit'))
@include('public.partials.notification')
@endunless
@section('content')
<div class="container">
<div class="row">
	  @if(!request()->routeIs('account.profile.edit'))
  <div class="my-account clearfix">
    <div class="col-md-3">
      <div class="sidebar-menu">
        <ul class="list-inline">
          <li class="{{ request()->routeIs('account.dashboard.index') ? 'active' : '' }}"> <a href="{{ route('account.dashboard.index') }}"> <i class="fas fa-bars"></i> {{ trans('storefront::account.links.dashboard') }} </a> </li>
		  <li class="{{ request()->routeIs('account.profile.edit') ? 'active' : '' }}"> <a href="{{ route('account.profile.edit') }}"> <i class="far fa-user"></i> {{ trans('storefront::account.links.my_profile') }} </a> </li>
		  <li class="{{ request()->routeIs('account.orders.index') ? 'active' : '' }}"> <a href="{{ route('account.orders.index') }}"> <i class="fas fa-shopping-bag"></i> {{ trans('storefront::account.links.my_orders') }} </a> </li>
{{-- <li class="{{ request()->routeIs('account.wishlist.index') ? 'active' : '' }}"> <a href="{{ route('account.wishlist.index') }}"> <i class="fa fa-heart" aria-hidden="true"></i> {{ trans('storefront::account.links.my_wishlist') }} </a> </li>
 <li class="{{ request()->routeIs('account.reviews.index') ? 'active' : '' }}"> <a href="{{ route('account.reviews.index') }}"> <i class="fa fa-comment" aria-hidden="true"></i> {{ trans('storefront::account.links.my_reviews') }} </a> </li>--}}
          <li class="{{ request()->routeIs('account.profile.updatePassword') ? 'active' : '' }}"> <a href="{{ route('account.profile.updatePassword') }}"> <i class="fa fa-key" aria-hidden="true"></i> {{ trans('storefront::profile.profile.edit.change') }} </a> </li>
          <li> <a href="{{ route('logout') }}"> <i class="fa fa-sign-out" aria-hidden="true"></i> {{ trans('storefront::account.links.logout') }} </a> </li>
        </ul>
      </div>
    </div>
    <div class="col-md-9">
      <div class="clearfix"></div>
      <div class="content-right clearfix"> @yield('content_right') </div>
    </div>
  </div>
	 @else
	  <div class="col-md-12">
      <div class="content-right clearfix">
		  @if(request()->routeIs('account.profile.edit'))
		  <div class="row">
		  	<div class="col-md-12">
@include('public.partials.notification')
				</div>
		  </div>
		  <div class="clear-fix"></div>
		  @endif
		  @yield('content_right') </div>
	  </div>
	  @endif
</div>
										 </div>
	  @if(request()->routeIs('account.profile.edit'))
<div class="profile_footer">
	<div class="container">
		<ul class="profile_footer_links">
			<li>
				<a href="{{URL::to('/account/profile-password')}}">{{ trans('storefront::profile.profile.edit.change') }}</a>
			</li>
			<li>
				<a href="{{route('account.profile.view',$my->username)}}">{{ trans('storefront::profile.profile.edit.view') }}</a>
			</li>
			<li>
				<a href="{{URL::to('/logout')}}">{{ trans('storefront::profile.profile.edit.logout') }}</a>
			</li>
		</ul>
	</div>
</div>
@endif
@endsection

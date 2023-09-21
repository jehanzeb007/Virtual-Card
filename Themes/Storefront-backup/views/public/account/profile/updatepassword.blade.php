@extends('public.account.layout')

@section('title', trans('storefront::account.links.my_profile'))

@section('account_breadcrumb')
  <li class="active">{{ trans('storefront::account.links.my_profile') }}</li>
@endsection

@section('content_right')
  <form method="POST" action="{{ route('account.profile.update') }}" enctype="multipart/form-data">
    {{ csrf_field() }}
    {{ method_field('put') }}
    <a href="{{route('account.profile.view',$my->username)}}" class="btn btn-primary pull-right" data-loading=""> {{trans('storefront::account.profile.view-profile')}} </a>
    <div class="clearfix"></div><br>
    <div class="password">
      <h4>{{ trans('storefront::account.profile.password') }}</h4>
      <div class="row">
        <div class="col-sm-8">
          <div class="form-group {{ $errors->has('password') ? 'has-error': '' }}">
            <label for="new-password"> {{ trans('storefront::account.profile.new_password') }} </label>
            <input type="password" required name="password" id="new-password" class="form-control">
            {!! $errors->first('password', '<span class="error-message">:message</span>') !!} </div>
          <div class="form-group {{ $errors->has('password_confirmation') ? 'has-error': '' }}">
            <label for="confirm-password"> {{ trans('storefront::account.profile.confirm_password') }} </label>
            <input type="password" required name="password_confirmation" id="confirm-password" class="form-control">
            {!! $errors->first('password_confirmation', '<span class="error-message">:message</span>') !!} </div>
        </div>
      </div>
    </div>
    </div>
    <button type="submit" class="btn btn-primary"> {{ trans('storefront::account.profile.save_changes') }} </button>
  </form>
@endsection 
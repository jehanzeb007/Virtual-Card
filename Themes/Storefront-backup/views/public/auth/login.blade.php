@extends('public.layout')

@section('title', trans('user::auth.login'))

@section('content')
    <div class="container">
        @include('public.partials.notification')
		<div class="col-md-10 col-md-offset-1">
		<div class="formWrap">
			<div class="form-box-left">
                        <div class="icon-box">
                            <span class="icon-wrapper">
                                <img src="{{url('/images/lock.png')}}">
                            </span>
                        </div>
                    </div>
			<div class="form-box-right">
            <form method="POST" action="{{ route('login.post') }}" class="login-form clearfix">
                {{ csrf_field() }}
                <div class="login form-inner clearfix">
                    {{--<a href="{{ route('register') }}" class="register" data-toggle="tooltip" data-placement="top" title="{{ trans('user::auth.register') }}" rel="tooltip">
                        <i class="fa fa-user-plus" aria-hidden="true"></i>
                    </a>--}}
					<div class="form-box-title">
                    <h3>{{ trans('user::auth.login') }}</h3></div>
                    <div class="form-group {{ $errors->has('username') ? 'has-error': '' }}">
						<div class="input-group">
							<span class="input-group-addon">
                                <img src="{{url('/images/user.png')}}">
                            </span>
                        <input type="text" name="username" value="{{ old('email') }}" class="form-control" id="username" placeholder="Email or Username" autofocus>
                        {!! $errors->first('username','<span class="error-message">:message</span>') !!}
							</div>
                    </div>

                    <div class="form-group {{ $errors->has('password') ? 'has-error': '' }}">
						<div class="input-group">
<span class="input-group-addon">
                                <img src="{{url('/images/key.png')}}">
                            </span>
                        <input type="password" name="password" class="form-control" id="password" placeholder="{{ trans('user::attributes.users.password') }}">

                        {!! $errors->first('password','<span class="error-message">:message</span>') !!}
							</div>
                    </div>

                    <div class="clearfix"></div>

                    <button type="submit" class="btn btn-primary btn-center btn-login" data-loading>
                        {{ trans('user::auth.login') }}
                    </button>

                    <div class="checkbox pull-left">
                        <input type="hidden" value="0">
                        <input type="checkbox" value="1" id="remember">

                        <label for="remember">{{ trans('user::auth.remember_me') }}</label>
                    </div>

                    <a href="{{ route('reset') }}" class="forgot-password pull-right">
                        {{ trans('user::auth.forgot_password') }}
                    </a>
                </div>
            </form>
        </div>
</div>
			</div>
        <div class="social-login-buttons text-center">
            @if (count(app('enabled_social_login_providers')) !== 0)
                <span>{{ trans('user::auth.or') }}</span>
            @endif

            @if (setting('facebook_login_enabled'))
                <a href="{{ route('login.redirect', ['provider' => 'facebook']) }}" class="btn btn-facebook">
                    {{ Theme::image('public/images/facebook.png') }}
                    {{ trans('user::auth.log_in_with_facebook') }}
                </a>
            @endif

            @if (setting('google_login_enabled'))
                <a href="{{ route('login.redirect', ['provider' => 'google']) }}" class="btn btn-google">
                    {{ Theme::image('public/images/google.png') }}
                    {{ trans('user::auth.log_in_with_google') }}
                </a>
            @endif
        </div>
    </div>
@endsection

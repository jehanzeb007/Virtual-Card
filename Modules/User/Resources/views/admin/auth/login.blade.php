@extends('user::admin.auth.layout')

@section('title', trans('user::auth.login'))

@section('content')
    <div class="login-wrapper">
        <div class="bg-blue">
            <div class="reflection"></div>
        </div>

        <div class="form-inner clearfix">
            <h3 class="text-center">FleetCart</h3>

            <form method="POST" action="{{ route('admin.login.post') }}">
                {{ csrf_field() }}
                <div class="form-group {{ $errors->has('username') ? 'has-error': '' }}">
                    <label for="email">Email/Username<span>*</span></label>

                    <input type="text" name="username" value="{{ old('username') }}" class="form-control" id="username" placeholder="Email or Username" autofocus>

                    <div class="input-icon">
                        <i class="fa fa-envelope-o" aria-hidden="true"></i>
                    </div>

                    {!! $errors->first('email', '<span class="help-block error">:message</span>') !!}
                </div>

                <div class="form-group {{ $errors->has('password') ? 'has-error': '' }}">
                    <label for="password">{{ trans('user::auth.password') }}<span>*</span></label>

                    <input type="password" class="form-control" name="password" placeholder="{{ trans('user::attributes.users.password') }}">

                    <div class="input-icon">
                        <i class="fa fa-lock" aria-hidden="true"></i>
                    </div>

                    {!! $errors->first('password', '<span class="help-block error">:message</span>') !!}
                </div>

                <button type="submit" class="btn btn-primary" data-loading>
                    {{ trans('user::auth.login') }}
                </button>

                <div class="clearfix"></div>

                <div class="checkbox pull-left">
                    <input type="hidden" name="remember_me" value="0">
                    <input type="checkbox" name="remember_me" value="1" id="remember-me">

                    <label for="remember-me">{{ trans('user::attributes.auth.remember_me') }}</label>
                </div>

                <a href="{{ route('admin.reset') }}" class="text-center pull-right">
                    {{ trans('user::auth.forgot_password') }}
                </a>
            </form>
        </div>
    </div>
@endsection

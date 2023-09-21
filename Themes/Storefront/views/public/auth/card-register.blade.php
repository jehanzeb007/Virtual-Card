@extends('public.layout')

@section('title', trans('user::auth.register'))

@section('content')

    <div class="registerIntro">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="introTitle">WELCOME TO THE FUTURE</h2>
                    <a class="registerOpen">Join</a>
                    <a class="loginOpen">Login</a>

                    <img class="imgFuture"
                         src="{{ v(Theme::url('public/new/images/loginRegister/welcome-to-the-future.png'))}}"/>
                </div>
            </div>
        </div>

    </div>
    <div class="register-wrapper clearfix"
         style="display: none;background-image: url('{{ v(Theme::url('public/new/images/loginRegister/bg-register.jpg'))}}')">
        <div class="container">
            <div class="row">
                @include('public.partials.notification')

                <div class="backIntro">
                    <img src="{{ v(Theme::url('public/new/images/loginRegister/arrowBack.png'))}}"/> <span>Back</span>
                </div>
                <form class="registerForm" method="POST" action="{{ route('card.register.post',$user_id) }}">
                    {{ csrf_field() }}

                    <div class="box-header">
                        <h4>{{ trans('user::auth.register') }}</h4>
                    </div>

                    <div class="form-inner clearfix">
                        <div>
                            <div class="form-group {{ $errors->has('first_name') ? 'has-error': '' }}">
                                <label for="first-name">{{ trans('user::auth.first_name') }}<span>*</span></label>

                                <input type="text" name="first_name" value="{{ old('first_name') }}"
                                       class="form-control" id="first-name" autofocus placeholder="First Name">

                                {!! $errors->first('first_name','<span class="error-message">:message</span>') !!}
                            </div>

                            <div class="form-group {{ $errors->has('last_name') ? 'has-error': '' }}">
                                <label for="last-name">{{ trans('user::auth.last_name') }}<span>*</span></label>

                                <input type="text" name="last_name" value="{{ old('last_name') }}"
                                       class="form-control" id="last-name" placeholder="Last Name">

                                {!! $errors->first('last_name','<span class="error-message">:message</span>') !!}
                            </div>
                            <div class="form-group {{ $errors->has('email') ? 'has-error': '' }}">
                                <label for="email">{{ trans('user::auth.email') }}<span>*</span></label>
                                <input type="text" name="email" value="{{ old('email') }}" class="form-control"
                                       id="email" placeholder="Email">
                                {!! $errors->first('email','<span class="error-message">:message</span>') !!}
                            </div>

                            <div class="form-group {{ $errors->has('password') ? 'has-error': '' }}">
                                <label for="password">{{ trans('user::auth.password') }}<span>*</span></label>

                                <input type="password" name="password" class="form-control" id="password"
                                       placeholder="Password">

                                {!! $errors->first('password','<span class="error-message">:message</span>') !!}
                            </div>

                            <div class="form-group {{ $errors->has('password_confirmation') ? 'has-error': '' }}">
                                <label for="confirm-password">{{ trans('user::auth.password_confirmation') }}
                                    <span>*</span></label>

                                <input type="password" name="password_confirmation" class="form-control"
                                       id="confirm-password" placeholder="Confirm Password">

                                {!! $errors->first('password_confirmation', '<span class="error-message">:message</span>') !!}
                            </div>
                        </div>

                        <div class="clearfix"></div>

                        <div class="checkbox">
                            <input type="checkbox" name="privacy_policy" id="privacy">

                            <label for="privacy">
                                {{ trans('user::auth.i_agree_to_the') }} <a
                                    href="{{ v(Theme::url('public/new/images/privacy_policy.pdf'))}}" target="_blank">{{ trans('user::auth.privacy_policy') }}</a>
                            </label>

                            {!! $errors->first('privacy_policy','<span class="error-message">:message</span>') !!}
                        </div>

                        <button type="submit" class="btn btn-primary btn-register pull-right" data-loading>
                            {{ trans('user::auth.register') }}
                        </button>
                    </div>
                </form>
            </div>
            <div class="row">
                @include('public.partials.notification')

                <form method="POST" class="loginForm" action="{{ route('card.login.post',$user_id) }}">
                    {{ csrf_field() }}

                    <div class="box-header">
                        <h4>Login</h4>
                    </div>

                    <div class="form-inner clearfix">
                        <div>
                            <div class="form-group {{ $errors->has('first_name') ? 'has-error': '' }}">
                                <label for="user-name">{{ trans('user::auth.first_name') }}<span>*</span></label>

                                <input type="text" name="user_name" value="{{ old('user_name') }}"
                                       class="form-control" id="first-user_name" autofocus
                                       placeholder="Email or User Name">

                                {!! $errors->first('user_anme','<span class="error-message">:message</span>') !!}
                            </div>


                            <div class="form-group {{ $errors->has('password') ? 'has-error has-error-login': '' }}">
                                <label for="password">{{ trans('user::auth.password') }}<span>*</span></label>

                                <input type="password" name="password" class="form-control" id="password"
                                       placeholder="Password">

                                {!! $errors->first('password','<span class="error-message">:message</span>') !!}
                            </div>

                        </div>

                        <div class="clearfix"></div>

                        <div class="checkbox pull-left">
                            <input type="hidden" value="0">
                            <input type="checkbox" value="1" id="remember">

                            <label for="remember">{{ trans('user::auth.remember_me') }}</label>
                        </div>

                        <a href="{{ route('reset') }}" class="forgot-password pull-right">
                            {{ trans('user::auth.forgot_password') }}
                        </a>

                        <button type="submit" class="btn btn-primary btn-login " data-loading>
                            Login
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

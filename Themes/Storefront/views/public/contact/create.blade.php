@extends('public.layout')

@section('title', trans('storefront::contact.contact'))

@section('content')

    <section class="contact-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-4 wow bounceInLeft" data-wow-duration="1.5s" data-wow-delay="0.2s">
                            <div class="contact-right clearfix">

                                <div class="contact-info">
                                    <div class="contact-text">
                                        <h4>{{ trans('storefront::contact.title') }}</h4>
                                        <p>{{trans('storefront::contact.content')}}</p>

                                        <div class="follow row">
                                            <div class="col-xs-6"><p>{{trans('storefront::contact.follow')}}</p></div>
                                            <div class="col-xs-6">
                                                <ul>
                                                    <li><a href="https://www.instagram.com/slackcards/" target="_blank">IG</a>
                                                    </li>
{{--                                                    <li><a href="https://www.facebook.com/Slack-Cards-101472084829788/"--}}
{{--                                                           target="_blank">FB</a></li>--}}
{{--                                                    <li><a href="https://twitter.com/slackcards1" target="_blank">TW</a>--}}
{{--                                                    </li>--}}
{{--                                                    <li><a href="https://www.tiktok.com/@slackcards/"--}}
{{--                                                           target="_blank">TT</a></li>--}}
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8 wow slideInRight" data-wow-duration="1.5s" data-wow-delay="0.2s">
                            <div class="box-wrapper contact-left clearfix">

                                <div class="col-md-12">
                                    <form method="POST" action="{{ route('contact.store') }}" class="clearfix">
                                        @csrf

                                        <div class="form-group {{ $errors->has('name') ? 'has-error': '' }}">
                                            <input type="text" name="name"
                                                   placeholder="{{trans('storefront::contact.name')}}"
                                                   class="form-control"
                                                   id="name"
                                                   value="{{ old('name') }}">

                                            {!! $errors->first('name', '<span class="error-message">:message</span>') !!}
                                        </div>

                                        <div class="form-group {{ $errors->has('email') ? 'has-error': '' }}">
                                            <input type="text" name="email"
                                                   placeholder="{{trans('storefront::contact.email')}}"
                                                   class="form-control"
                                                   id="email"
                                                   value="{{ old('email') }}">

                                            {!! $errors->first('email', '<span class="error-message">:message</span>') !!}
                                        </div>

                                        <div class="form-group {{ $errors->has('message') ? 'has-error': '' }}">
                                            <label for="message">{{ trans('storefront::contact.message') }}</label>
                                            <textarea name="message" cols="30" rows="10"
                                                      id="message">{{ old('message') }}</textarea>

                                            {!! $errors->first('message', '<span class="error-message">:message</span>') !!}
                                        </div>

                                        <button type="submit" class="btn btn-primary btn-submit pull-left"
                                                data-loading>{{ trans('storefront::contact.submit') }}
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

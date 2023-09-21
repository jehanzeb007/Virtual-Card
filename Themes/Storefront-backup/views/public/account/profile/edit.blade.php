@extends('public.account.layout')

@section('title', trans('storefront::account.links.my_profile'))

@section('account_breadcrumb')
    <li class="active">{{ trans('storefront::account.links.my_profile') }}</li>
@endsection
@section('content_right')
    <form method="POST" action="{{ route('account.profile.update') }}" enctype="multipart/form-data" autocomplete="off">
        {{ csrf_field() }}
        {{ method_field('put') }}
        @if(!auth()->user()->hasRoleId(3))
            <a href="{{route('account.profile.view',$my->username)}}" class="btn btn-primary pull-right" target="_blank"> View Profile </a>
        @endif
        <div class="clearfix"></div><br>
        <div class="account-details">
            <div class="account clearfix">
                <h4>{{ trans('storefront::account.profile.account') }}</h4>
                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group {{ $errors->has('first_name') ? 'has-error': '' }}">
                            <label for="first-name"> {{ trans('storefront::account.profile.first_name') }}<span>*</span> </label>
                            <input type="text" name="first_name" id="first-name" class="form-control" value="{{ old('first_name', $my->first_name) }}">
                            {!! $errors->first('first_name', '<span class="error-message">:message</span>') !!} </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group {{ $errors->has('last_name') ? 'has-error': '' }}">
                            <label for="last-name">{{trans('storefront::account.profile.middle-name')}}<span>*</span> </label>
                            <input type="text" name="middle_name" id="middle-name" class="form-control" value="{{ old('middle_name', $my->middle_name) }}">
                            {!! $errors->first('middle_name', '<span class="error-message">:message</span>') !!} </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group {{ $errors->has('last_name') ? 'has-error': '' }}">
                            <label for="last-name"> {{ trans('storefront::account.profile.last_name') }}<span>*</span> </label>
                            <input type="text" name="last_name" id="last-name" class="form-control" value="{{ old('last_name', $my->last_name) }}">
                            {!! $errors->first('last_name', '<span class="error-message">:message</span>') !!} </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group {{ $errors->has('email') ? 'has-error': '' }}">
                            <label for=""> {{trans('storefront::account.profile.email')}}<span>*</span> </label>
                            <input type="text" name="email" class="form-control" value="{{ old('email', $my->email) }}">
                            {!! $errors->first('email', '<span class="error-message">:message</span>') !!} </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group {{ $errors->has('username') ? 'has-error': '' }}">
                            <label for=""> {{trans('storefront::account.profile.username')}}<span>*</span> </label>
                            <input type="text" readonly="" disabled class="form-control" value="{{ old('username', $my->username) }}">
                            {!! $errors->first('username', '<span class="error-message">:message</span>') !!} </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label>{{trans('storefront::account.profile.current-image')}}:</label>
                        <img src="{{($my->avatar!='')?url('/images/users/'.Auth::user()->id.'/'.$my->avatar):url('/images/users/default.jpg')}}" style="max-height: 150px; width: auto; display: block; clear: both;" id="profImg"> </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for=""> {{trans('storefront::account.profile.select-image')}}: </label>
                            <input type="file" name="profile" id="profile" class="form-control" onChange="readURL(this)" >
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if(!auth()->user()->hasRoleId(3))
            <div class="account-details">
                <div class="account clearfix">
                    <h4>About Me</h4>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for=""> {{trans('storefront::account.profile.profession')}} </label>
                                <input type="text" name="profession" id="profession" class="form-control" value="{{ old('profession', $my->user_info->profession) }}">
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for=""> {{trans('storefront::account.profile.about-me')}} <span style="font-size: 13px">(280 {{trans('storefront::account.profile.charactors-only')}})</span> </label>
                                <textarea type="text" name="about_me" id="about_me" class="form-control">{{ old('about_me', $my->user_info->about_me) }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="account-details">
                <div class="account clearfix">
                    <h4>Job Details</h4>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for=""> {{trans('storefront::account.profile.job-title')}} </label>
                                <input type="text" name="job_title" id="job_title" class="form-control" value="{{ old('job_title', $my->user_info->job_title) }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for=""> {{trans('storefront::account.profile.company')}} </label>
                                <input type="text" name="company" id="company" class="form-control" value="{{ old('company', $my->user_info->company) }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for=""> {{trans('storefront::account.profile.phone-number')}} </label>
                                <input type="text" name="job_phone" id="job_phone" class="form-control" value="{{ old('job_phone', $my->user_info->job_phone) }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="account-details">
                <div class="account clearfix">
                    <h4>{{trans('storefront::account.profile.contact-details')}}</h4>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for=""> {{trans('storefront::account.profile.website')}}<span style="font-size: 13px">(http://example.com)</span> </label>
                                <input type="text" name="website" id="website" class="form-control" value="{{ old('website', $my->user_info->website) }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for=""> {{trans('storefront::account.profile.phone-number')}} </label>
                                <input type="text" name="phone" id="phone" class="form-control" value="{{ old('phone', $my->user_info->phone) }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for=""> {{trans('storefront::account.profile.fax')}} </label>
                                <input type="text" name="fax" id="fax" class="form-control" value="{{ old('fax', $my->user_info->fax) }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        {{--<div class="col-md-4">
                            <div class="form-group {{ $errors->has('email') ? 'has-error': '' }}">
                                <label for=""> {{ trans('storefront::account.profile.email') }}<span>*</span> </label>
                                <input type="text" name="email" id="email" class="form-control" value="{{ old('email', $my->email) }}">
                                {!! $errors->first('email', '<span class="error-message">:message</span>') !!} </div>
                        </div>--}}
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for=""> {{trans('storefront::account.profile.facebook-messanger')}} </label>
                                <input type="text" name="fb_messenger" id="fb_messenger" class="form-control" value="{{ old('fb_messenger', $my->user_info->fb_messenger) }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for=""> {{trans('storefront::account.profile.wechat')}} </label>
                                <input type="text" name="wechat" id="wechat" class="form-control" value="{{ old('wechat', $my->user_info->wechat) }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for=""> {{trans('storefront::account.profile.whatsapp')}} </label>
                                <input type="text" name="whatsapp" id="whatsapp" class="form-control" value="{{ old('whatsapp', $my->user_info->whatsapp) }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for=""> {{trans('storefront::account.profile.skype')}} </label>
                                <input type="text" name="skype" id="skype" class="form-control" value="{{ old('skype', $my->user_info->skype) }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for=""> {{trans('storefront::account.profile.telegram')}} </label>
                                <input type="text" name="telegram" id="telegram" class="form-control" value="{{ old('telegram', $my->user_info->telegram) }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="account-details">
                <div class="account clearfix">
                    <h4>Location</h4>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for=""> {{trans('storefront::account.profile.street-address-1')}} </label>
                                <input type="text" name="street_address_1" id="street_address_1" class="form-control" value="{{ old('street_address_1', $my->user_info->street_address_1) }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for=""> {{trans('storefront::account.profile.street-address-2')}} </label>
                                <input type="text" name="street_address_2" id="street_address_2" class="form-control" value="{{ old('street_address_2', $my->user_info->street_address_2) }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for=""> {{trans('storefront::account.profile.city-town')}} </label>
                                <input type="text" name="city" id="city" class="form-control" value="{{ old('city', $my->user_info->city) }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for=""> {{trans('storefront::account.profile.state-province-county')}} </label>
                                <input type="text" name="state" id="state" class="form-control" value="{{ old('state', $my->user_info->state) }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for=""> {{trans('storefront::account.profile.zip-code-postal-code')}} </label>
                                <input type="text" name="zip" id="zip" class="form-control" value="{{ old('zip', $my->user_info->zip) }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for=""> {{trans('storefront::account.profile.country')}} </label>
                                <input type="text" name="country" id="country" class="form-control" value="{{ old('country', $my->user_info->country) }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="account-details">
                <div class="account clearfix">
                    <h4>{{trans('storefront::account.profile.connect-details')}}</h4>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for=""> {{trans('storefront::account.profile.Facebook')}} </label>
                                <input type="text" name="facebook" id="facebook" class="form-control" value="{{ old('facebook', $my->user_info->facebook) }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for=""> {{trans('storefront::account.profile.facebook-page')}} </label>
                                <input type="text" name="facebook_page" id="facebook_page" class="form-control" value="{{ old('facebook_page', $my->user_info->facebook_page) }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for=""> {{trans('storefront::account.profile.twitter')}} </label>
                                <input type="text" name="twitter" id="twitter" class="form-control" value="{{ old('twitter', $my->user_info->twitter) }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for=""> {{trans('storefront::account.profile.instagram')}} </label>
                                <input type="text" name="instagram" id="instagram" class="form-control" value="{{ old('instagram', $my->user_info->instagram) }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for=""> {{trans('storefront::account.profile.tumblr')}} </label>
                                <input type="text" name="tumblr" id="tumblr" class="form-control" value="{{ old('tumblr', $my->user_info->tumblr) }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for=""> {{trans('storefront::account.profile.pinterest')}} </label>
                                <input type="text" name="pinterest" id="pinterest" class="form-control" value="{{ old('pinterest', $my->user_info->pinterest) }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for=""> {{trans('storefront::account.profile.snapchat')}} </label>
                                <input type="text" name="snapchat" id="snapchat" class="form-control" value="{{ old('snapchat', $my->user_info->snapchat) }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for=""> {{trans('storefront::account.profile.linkedin')}} </label>
                                <input type="text" name="linkedin" id="linkedin" class="form-control" value="{{ old('linkedin', $my->user_info->linkedin) }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="account-details">
                <div class="account clearfix">
                    <h4>{{trans('storefront::account.profile.payment-details')}}</h4>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for=""> {{trans('storefront::account.profile.cash-app')}} </label>
                                <input type="text" name="cash_app" id="cash_app" class="form-control" value="{{ old('cash_app', $my->user_info->cash_app) }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for=""> {{trans('storefront::account.profile.paypal')}} </label>
                                <input type="text" name="paypal" id="paypal" class="form-control" value="{{ old('paypal', $my->user_info->paypal) }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for=""> {{trans('storefront::account.profile.venmo')}} </label>
                                <input type="text" name="venmo" id="venmo" class="form-control" value="{{ old('venmo', $my->user_info->venmo) }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for=""> {{trans('storefront::account.profile.bank-account')}}<span style="font-size: 12px">(IBN #)</span> </label>
                                <input type="text" name="bank" id="bank" class="form-control" value="{{ old('bank', $my->user_info->bank) }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="account-details">
                <div class="account clearfix">
                    <h4>{{trans('storefront::account.profile.my-videos')}}</h4>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for=""> {{trans('storefront::account.profile.youtube')}} </label>
                                <input type="text" name="youtube" id="youtube" class="form-control" value="{{ old('youtube', $my->user_info->youtube) }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for=""> {{trans('storefront::account.profile.vimeo')}} </label>
                                <input type="text" name="vimeo" id="vimeo" class="form-control" value="{{ old('vimeo', $my->user_info->vimeo) }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="account-details">
                <div class="account clearfix">
                    <h4>{{trans('storefront::account.profile.my-music')}}</h4>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for=""> {{trans('storefront::account.profile.soundcloud')}} </label>
                                <input type="text" name="soundcloud" id="soundcloud" class="form-control" value="{{ old('soundcloud', $my->user_info->soundcloud) }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for=""> {{trans('storefront::account.profile.reverbnation')}} </label>
                                <input type="text" name="revebnation" id="revebnation" class="form-control" value="{{ old('revebnation', $my->user_info->revebnation) }}">
                            </div>
                        </div>
                    </div>
                    <div class="addMain">
                        <div class="row">
                            @php
                                $other_music = json_decode($my->user_info->other_music,1);
                                $type = isset($other_music['type'])?$other_music['type']:[];
                                $title = isset($other_music['title'])?$other_music['title']:[];
                                $music_link = isset($other_music['music_link'])?$other_music['music_link']:[];
                            @endphp
                            @if(!empty($other_music))
                                @foreach($type as $key=>$type_value)
                                    <div class="col-md-4 removeMain">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for=""> Select </label><span onClick="closeBtn(this)" style="float:right; cursor: pointer;"><i class="fa fa-close"></i></span>
                                                    <select name="other_music[type][]">
                                                        <option value="Soptify" {{$type_value == 'Soptify' ? 'selected':''}}>Soptify</option>
                                                        <option value="Apple Music" {{$type_value == 'Apple Music' ? 'selected':''}}>Apple Music</option>
                                                        <option value="Amazon Music" {{$type_value == 'Amazon Music' ? 'selected':''}}>Amazon Music</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for=""> {{trans('storefront::account.profile.title')}} </label>
                                                    <input type="text" name="other_music[title][]" id="title_12" class="form-control" value="{{isset($title[$key])?$title[$key]:''}}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for=""> {{trans('storefront::account.profile.music-link')}} </label>
                                                    <input type="text" name="other_music[music_link][]" id="music_link" class="form-control" value="{{isset($music_link[$key])?$music_link[$key]:''}}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        <div class="clearfix"></div>
                        <button type="button" class="btn btn-primary" onClick="addMusic(this)"> {{trans('storefront::account.profile.add-more')}} </button>
                    </div>
                </div>
            </div>
            <div class="account-details">
                <div class="account clearfix">
                    <h4>My Favorite Links</h4>
                    <div class="addMain">
                        <div class="row">
                            @php
                                $favorite_links = json_decode($my->user_info->favorite_links,1);
                                $title = isset($favorite_links['title'])?$favorite_links['title']:[];
                                $link = isset($favorite_links['link'])?$favorite_links['link']:[];
                            @endphp
                            @if(!empty($favorite_links))
                                @foreach($title as $key=>$title_value)
                                    <div class="col-md-4 removeMain">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for=""> {{trans('storefront::account.profile.title')}} </label><span onClick="closeBtn(this)" style="float:right; cursor: pointer;"><i class="fa fa-close"></i></span>
                                                    <input type="text" name="favorite_links[title][]" id="favorite_title" class="form-control" value="{{$title_value}}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for=""> {{trans('storefront::account.profile.your-favorite-link')}} </label>
                                                    <input type="text" name="favorite_links[link][]" id="favorite_link" class="form-control" value="{{$link[$key]}}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif

                        </div>
                        <div class="clearfix"></div>
                        <button type="button" class="btn btn-primary" onClick="addFavLinks(this)"> {{trans('storefront::account.profile.add-more')}} </button>
                    </div>
                </div>
            </div>
        @endif
        <button type="submit" class="btn btn-primary" data-loading> {{ trans('storefront::account.profile.save_changes') }} </button>
    </form>
@endsection 
@extends('public.account.layout')

@section('title', trans('storefront::account.links.my_profile'))
@section('content_right')

    @php
        $showEmail = '';
        $showWhatsapp = '';
        $showJobWhatsapp = '';

        if($my->user_info->showEmail == 'on') {
            $showEmail = 'checked';
        }

        if($my->user_info->showWhatsapp == 'on') {
            $showWhatsapp = 'checked';
        }

        if($my->user_info->showJobWhatsapp == 'on') {
            $showJobWhatsapp = 'checked';
        }
    @endphp
    <form method="POST" action="{{ route('account.profile.update') }}" enctype="multipart/form-data" autocomplete="off">
        {{ csrf_field() }}
        {{ method_field('put') }}
        <div class="profile_main">
            <h1>{{ trans('storefront::profile.profile.edit.title') }}</h1>
            <div class="top_btns">
                <button type="submit" class="btn btn-primary" style="clear: both; margin-bottom: 40px;"
                        data-loading> {{ trans('storefront::account.profile.save_changes') }} </button>
                @if(!auth()->user()->hasRoleId(3))
                    <a href="{{route('account.profile.view',$my->username)}}"
                       target="_blank">{{ trans('storefront::profile.profile.edit.view') }}</a>
                @endif

            </div>
            <div class="mobile_btns">
                <button type="submit" class="btn btn-primary" style="clear: both;"
                        data-loading> {{ trans('storefront::account.profile.save_changes') }} </button>
            </div>
            <div class="card">
                <h4>{{ trans('storefront::profile.profile.edit.personal') }}</h4>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group {{ $errors->has('first_name') ? 'has-error': '' }}">
                            <label>{{ trans('storefront::account.profile.first_name') }} <sup>*</sup>
                            </label>
                            <input type="text" placeholder="" name="first_name" id="first-name" class="form-control clearable"
                                   value="{{ old('first_name', $my->first_name) }}">
                            {!! $errors->first('first_name', '<span class="error-message">:message</span>') !!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group {{ $errors->has('middle_name') ? 'has-error': '' }}">
                            <label>{{trans('storefront::account.profile.middle-name')}} </label>
                            <input type="text" placeholder="" name="middle_name" id="middle-name" class="form-control clearable"
                                   value="{{ old('middle_name', $my->middle_name) }}">
                            {!! $errors->first('middle_name', '<span class="error-message">:message</span>') !!} </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group {{ $errors->has('last_name') ? 'has-error': '' }}">
                            <label>{{trans('storefront::account.profile.last_name')}} <sup>*</sup></label>
                            <input type="text" placeholder="" name="last_name" id="last-name" class="form-control clearable"
                                   value="{{ old('last_name', $my->last_name) }}">
                            {!! $errors->first('last_name', '<span class="error-message">:message</span>') !!} </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group {{ $errors->has('email') ? 'has-error': '' }}">
                            <label>{{trans('storefront::account.profile.email')}} <sup>*</sup> <input name="showEmail"
                                                                                                      type="checkbox" {{$showEmail}}><span
                                        style="font-size: 12px;color: gray;">{{ trans('storefront::profile.profile.edit.hide') }}</span>
                            </label>
                            <input type="email" placeholder="" name="email" class="form-control clearable"
                                   value="{{ old('email', $my->email) }}">
                            {!! $errors->first('email', '<span class="error-message">:message</span>') !!} </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group {{ $errors->has('username') ? 'has-error': '' }}">
                            <label>{{trans('storefront::account.profile.username')}}
                                <div class="infoPop">
                                    <span class="porfile-info">i</span>
                                    <div class="info">
                                        <p class="title">{{trans('storefront::account.profile.info.username.title')}}</p>
                                        <p class="content">{{trans('storefront::account.profile.info.username.content')}}</p>
                                    </div>
                                </div>
                            </label>
                            <input type="text" placeholder="" name="username" class="form-control"
                                   value="{{ old('username', !empty($my->username2)?$my->username2:$my->username) }}" {{empty($my->username2)?'':'readonly'}}>
                            {!! $errors->first('username', '<span class="error-message">:message</span>') !!} </div>
                    </div>
                    <div class="col-md-4">
                        <label>My Profile Url</label>
                        <a href="{{route('account.profile.view',!empty($my->username2)?$my->username2:$my->username)}}"
                           target="_blank"
                           class="profile_share"><span>{{route('account.profile.view',!empty($my->username2)?$my->username2:$my->username)}}</span>
                            <i class="fa fa-share"></i> </a>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <label>Bio <span>(280 {{trans('storefront::account.profile.charactors-only')}})</span></label>
                        <textarea name="about_me" id="about_me"
                                  class="form-control">{{ old('about_me', $my->user_info->about_me) }}</textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 profilePicture">
                        <label class="curnt_img_label">{{ trans('storefront::profile.profile.edit.userImage') }}</label><br><br>
                        <div class="current_image">
                            <img
                                    src="{{($my->avatar!='')?url('/images/users/'.Auth::user()->id.'/'.'thumb-'.$my->avatar):url('/images/users/default.jpg')}}"
                                    alt="" id="user_avatar">
                            <label><input type="file" placeholder="" name="profile" id="profile">
                                <img src="{{url('/themes/storefront/public/images/edit-pencil-icon.png')}}"
                                     alt=""></label>
                        </div>

                        @if(!empty($my->avatar))
                            <div class="deleteImg">{{ trans('storefront::profile.profile.edit.deletePhoto') }}</div>
                        @endif
                        <hr class="mt-4 mb-4 hr-d-none">
                    </div>
                    <div class="col-md-4 companyPicture">
                        <label
                                class="curnt_img_label">{{ trans('storefront::profile.profile.edit.companyImage') }}</label><br><br>
                        <div class="current_image">
                            <img
                                    src="{{($my->company_avatar!='')?url('/images/users/'.Auth::user()->id.'/'.'thumb-'.$my->company_avatar):url('/images/users/default.jpg')}}"
                                    alt="" id="company_avatar_img">
                            <label><input type="file" placeholder="" name="company_avatar" id="company_avatar"><img
                                        src="{{url('/themes/storefront/public/images/edit-pencil-icon.png')}}"
                                        alt=""></label>
                        </div>
                        @if(!empty($my->company_avatar))
                            <div
                                    class="deleteCompanyImg">{{ trans('storefront::profile.profile.edit.deletePhoto') }}</div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="card">
                <h4>{{ trans('storefront::profile.profile.edit.job') }}</h4>
                <div class="row">
                    <div class="col-md-4">
                        <label>{{trans('storefront::account.profile.job-title')}}</label>
                        <input type="text" placeholder="" name="job_title" id="job_title" class="form-control clearable"
                               value="{{ old('job_title', $my->user_info->job_title) }}">
                    </div>
                    <div class="col-md-4">
                        <label>{{trans('storefront::account.profile.company')}}</label>
                        <input type="text" placeholder="" name="company" id="company" class="form-control clearable"
                               value="{{ old('company', $my->user_info->company) }}">
                    </div>
                    <div class="col-md-4">
                        <label>{{trans('storefront::account.profile.company')}} {{trans('storefront::account.profile.phone-number')}}
                            <input name="showJobWhatsapp" type="checkbox" {{$showJobWhatsapp}}><span style="font-size: 12px;color: gray;">¿Whatsapp?</span></label>
                        <input type="text" placeholder="+1-555-555-1122" name="job_phone" id="job_phone"
                               class="form-control clearable" value="{{ old('job_phone', $my->user_info->job_phone) }}">
                    </div>
                    <div class="col-md-4">
                        <label>{{ trans('storefront::profile.profile.edit.companyEmail') }}</label>
                        <input type="text" placeholder="user@domain.com" name="company_email" id="company_email"
                               class="form-control clearable" value="{{ old('job_phone', $my->user_info->company_email) }}">
                    </div>
                    <div class="col-md-4">
                        <label>{{trans('storefront::account.profile.website')}}
                            <span>(www.example.com)</span></label>
                        <div class="web_link">
                            <input type="text" placeholder="" name="website" id="website" class="form-control clearable"
                                   value="{{ old('website', $my->user_info->website) }}">
                            <a href="https://{{ old('website', $my->user_info->website) }}" target="_blank">Try</a>
                            <div class="url">
                                <p>https://<span></span></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card connect">
                <h4>{{trans('storefront::account.profile.connect-details')}}</h4>
                <div class="row">
                    <div class="col-md-4">
                        <label for=""><span class="brand_icon"><img
                                        src="{{ v(Theme::url('public/new/images/instagram_icon.png'))}}"
                                        alt=""></span> {{trans('storefront::account.profile.instagram')}}
                            <div class="infoPop">
                                <span class="porfile-info">i</span>
                                <div class="info">
                                    <p class="title">{{trans('storefront::account.profile.info.instagram.title')}}</p>
                                    <p class="content">{{trans('storefront::account.profile.info.instagram.content')}}</p>
                                </div>
                            </div>
                        </label>
                        <div class="web_link">
                            <input type="text" name="instagram" placeholder="Add Username" id="instagram"
                                   class="form-control clearable"  value="{{ old('instagram', $my->user_info->instagram) }}"
                                   data-link="https://instagram.com/">
                            <a href="https://www.instagram.com/{{ old('instagram', $my->user_info->instagram) }}"
                               target="_blank">Try</a>
                            <div class="url">
                                <p>https://instagram.com/<span></span></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for=""><span class="brand_icon"><img
                                        src="{{ v(Theme::url('public/new/images/fb_icon.png'))}}"
                                        alt=""></span> {{trans('storefront::account.profile.Facebook')}}
                            <div class="infoPop">
                                <span class="porfile-info">i</span>
                                <div class="info">
                                    <p class="title">{{trans('storefront::account.profile.info.facebook.title')}}</p>
                                    <p class="content">{{trans('storefront::account.profile.info.facebook.content')}}</p>
                                </div>
                            </div>
                        </label>
                        <div class="web_link">
                            <input type="text" placeholder="Add Username" name="facebook" id="facebook"
                                   class="form-control clearable" value="{{ old('facebook', $my->user_info->facebook) }}"
                                   data-link="https://facebook.com/">
                            <a href="https://facebook.com/{{ old('facebook', $my->user_info->facebook) }}"
                               target="_blank">Try</a>
                            <div class="url">
                                <p>https://facebook.com/<span></span></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for=""><span class="brand_icon"><img
                                        src="{{ v(Theme::url('public/new/images/twitter.png'))}}"
                                        alt=""></span> {{trans('storefront::account.profile.twitter')}}
                            <div class="infoPop">
                                <span class="porfile-info">i</span>
                                <div class="info">
                                    <p class="title">{{trans('storefront::account.profile.info.twitter.title')}}</p>
                                    <p class="content">{{trans('storefront::account.profile.info.twitter.content')}}</p>
                                </div>
                            </div>
                        </label>
                        <div class="web_link">
                            <input type="text" name="twitter" id="twitter" placeholder="Add Username"
                                   class="form-control clearable" value="{{ old('twitter', $my->user_info->twitter) }}"
                                   data-link="https://twitter.com/">
                            <a href="https://twitter.com/{{ old('twitter', $my->user_info->twitter) }}" target="_blank">Try</a>
                            <div class="url">
                                <p>https://twitter.com/<span></span></p>
                            </div>
                        </div>
                    </div>


                </div>
                <div class="row">
                    <div class="col-md-4">
                        <label for=""><span class="brand_icon"><img
                                        src="{{ v(Theme::url('public/new/images/tiktok.png'))}}"
                                        alt=""></span> Tiktok
                            <div class="infoPop">
                                <span class="porfile-info">i</span>
                                <div class="info">
                                    <p class="title">{{trans('storefront::account.profile.info.tiktok.title')}}</p>
                                    <p class="content">{{trans('storefront::account.profile.info.tiktok.content')}}</p>
                                </div>
                            </div>
                        </label>
                        <div class="web_link">
                            <input type="text" name="tiktok" placeholder="Add Username" id="tiktok"
                                   class="form-control clearable" value="{{ old('tiktok', $my->user_info->tiktok) }}"
                                   data-link="https://tiktok.com/{{ "@" }}" onkeyup="return forceLower(this);">
                            <a href="https://www.tiktok.com/{{ "@" }}{{ old('tiktok', $my->user_info->tiktok) }}"
                               target="_blank">Try</a>
                            <div class="url">
                                <p>https://www.tiktok.com/@/<span></span></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for=""><span class="brand_icon"><img
                                        src="{{ v(Theme::url('public/new/images/vsco.png'))}}"
                                        alt=""></span> {{trans('VSCO')}}
                            <div class="infoPop">
                                <span class="porfile-info">i</span>
                                <div class="info">
                                    <p class="title">{{trans('storefront::account.profile.info.vsco.title')}}</p>
                                    <p class="content">{{trans('storefront::account.profile.info.vsco.content')}}</p>
                                </div>
                            </div>
                        </label>
                        <div class="web_link">
                            <input type="text" name="vsco" placeholder="https://vsco.co" id="vsco" class="form-control clearable"
                                   value="{{ old('vsco', $my->user_info->vsco) }}" data-link="https://vsco.com/">
                            <a href="{{ old('vsco', $my->user_info->vsco) }}"
                               target="_blank">Try</a>
                            <div class="url">
                                <p>https://www.vsco.com/<span></span>/gallery/</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <label for=""><span class="brand_icon"><img
                                        src="{{ v(Theme::url('public/new/images/linkedin.png'))}}"
                                        alt=""></span> {{trans('storefront::account.profile.linkedin')}}
                            <div class="infoPop">
                                <span class="porfile-info">i</span>
                                <div class="info">
                                    <p class="title">{{trans('storefront::account.profile.info.linkedin.title')}}</p>
                                    <p class="content">{{trans('storefront::account.profile.info.linkedin.content')}}</p>
                                </div>
                            </div>
                        </label>
                        <div class="web_link">
                            <input type="text" name="linkedin" placeholder="Add Username" id="linkedin"
                                   class="form-control clearable" value="{{ old('linkedin', $my->user_info->linkedin) }}"
                                   data-link="https://www.linkedin.com/in/">
                            <a href="https://www.linkedin.com/in/{{ old('linkedin', $my->user_info->linkedin) }}"
                               target="_blank">Try</a>
                            <div class="url">
                                <p>https://www.linkedin.com/in/<span></span></p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for=""><span class="brand_icon"><img
                                            src="{{ v(Theme::url('public/new/images/pinterest.png'))}}"
                                            alt=""></span> {{trans('storefront::account.profile.pinterest')}}
                                <div class="infoPop">
                                    <span class="porfile-info">i</span>
                                    <div class="info">
                                        <p class="title">{{trans('storefront::account.profile.info.pinterest.title')}}</p>
                                        <p class="content">{{trans('storefront::account.profile.info.pinterest.content')}}</p>
                                    </div>
                                </div>
                            </label>
                            <div class="web_link">
                                <input type="text" name="pinterest" placeholder="Add Username" id="pinterest"
                                       class="form-control clearable" value="{{ old('pinterest', $my->user_info->pinterest) }}"
                                       data-link="https://pinterest.com/">
                                <a href="https://pinterest.com/{{ old('pinterest', $my->user_info->pinterest) }}"
                                   target="_blank">Try</a>
                                <div class="url">
                                    <p>https://pinterest.com/<span></span></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for=""><span class="brand_icon"><img
                                        src="{{ v(Theme::url('public/new/images/snapchat.png'))}}"
                                        alt=""></span> {{trans('storefront::account.profile.snapchat')}}
                            <div class="infoPop">
                                <span class="porfile-info">i</span>
                                <div class="info">
                                    <p class="title">{{trans('storefront::account.profile.info.snapchat.title')}}</p>
                                    <p class="content">{{trans('storefront::account.profile.info.snapchat.content')}}</p>
                                </div>
                            </div>
                        </label>
                        <div class="web_link">
                            <input type="text" name="snapchat" placeholder="Add Username" id="snapchat"
                                   class="form-control clearable" value="{{ old('snapchat', $my->user_info->snapchat) }}"
                                   data-link="https://snapchat.com/">
                            <a href="https://snapchat.com/{{ old('snapchat', $my->user_info->snapchat) }}"
                               target="_blank">Try</a>
                            <div class="url">
                                <p>https://snapchat.com/<span></span></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for=""><span class="brand_icon"><img
                                        src="{{ v(Theme::url('public/new/images/tumblr.png'))}}"
                                        alt=""></span> {{trans('storefront::account.profile.tumblr')}}
                            <div class="infoPop">
                                <span class="porfile-info">i</span>
                                <div class="info">
                                    <p class="title">{{trans('storefront::account.profile.info.tumblr.title')}}</p>
                                    <p class="content">{{trans('storefront::account.profile.info.tumblr.content')}}</p>
                                </div>
                            </div>
                        </label>
                        <div class="web_link">
                            <input type="text" name="tumblr" placeholder="Add Username" id="tumblr" class="form-control clearable"
                                   value="{{ old('tumblr', $my->user_info->tumblr) }}" data-link="https://tumblr.com/">
                            <a href="https://tumblr.com/{{ old('tumblr', $my->user_info->tumblr) }}"
                               target="_blank">Try</a>
                            <div class="url">
                                <p>https://tumblr.com/<span></span></p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <label for=""><span class="brand_icon"><img
                                        src="{{ v(Theme::url('public/new/images/twitch.png'))}}"
                                        alt=""></span> Twitch
                            <!--div class="infoPop">
                                <span class="porfile-info">i</span>
                                <div class="info">
                                    <p class="title">{{trans('storefront::account.profile.info.twitch.title')}}</p>
                                    <p class="content">{{trans('storefront::account.profile.info.twitch.content')}}</p>
                                </div>
                            </div-->
                        </label>
                        <div class="web_link">
                            <input type="text" name="twitch" placeholder="Add Username" id="twitch" class="form-control clearable"
                                   value="{{ old('twitch', $my->user_info->twitch) }}" data-link="https://twitch.com/">
                            <a href="https://twitch.tv/{{ old('twitch', $my->user_info->twitch) }}"
                               target="_blank">Try</a>
                            <div class="url">
                                <p>https://twitch.tv/<span></span></p>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
            <div class="card connect">
                <h4>{{trans('storefront::account.profile.contact-details')}}</h4>
                <div class="row">
                    <div class="col-md-4">
                        <label>{{trans('storefront::account.profile.phone-number')}}
                            <input name="showWhatsapp" type="checkbox" {{$showWhatsapp}}><span style="font-size: 12px;color: gray;">¿Whatsapp?</span></label>
                            <input type="text" placeholder="+1-555-555-1122" name="phone" id="phone" class="form-control clearable"
                            value="{{ old('phone', $my->user_info->phone) }}">
                    </div>
                    <div class="col-md-4">
                        <label><span class="brand_icon"><img src="{{ v(Theme::url('public/new/images/wechat.png'))}}"
                                                             alt=""></span>{{trans('storefront::account.profile.wechat')}}
                        </label>
                        <div class="web_link">
                            <input type="text" placeholder="https://www.wechat.com/en/" name="wechat" id="wechat"
                                   class="form-control clearable" value="{{ old('wechat', $my->user_info->wechat) }}"
                                   data-link="https://www.wechat.com/">
                            {{--                            <a href="https://www.wechat.com/{{ old('wechat', $my->user_info->wechat) }}"--}}
                            {{--                               target="_blank">Try</a>--}}
                        </div>
                    </div>
                    <div class="col-md-4 what">
                        <label><span class="brand_icon"><img src="{{ v(Theme::url('public/new/images/whatsapp.png'))}}"
                                                             alt=""></span>{{trans('storefront::account.profile.whatsapp')}}
                        </label>
                        <div class="web_link">
                            <input type="text" placeholder="+1-555-555-1122" name="whatsapp" id="whatsapp"
                                   class="form-control clearable" value="{{ old('whatsapp', $my->user_info->whatsapp) }}"
                                   data-link="https://wa.me/">
                            <a href="https://wa.me/{{ old('whatsapp', $my->user_info->whatsapp) }}"
                               target="_blank">Try</a>
                        </div>
                    </div>                    
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <label><span class="brand_icon"><img src="{{ v(Theme::url('public/new/images/skype.png'))}}"
                                                             alt=""></span>{{trans('storefront::account.profile.skype')}}
                            <div class="infoPop">
                                <span class="porfile-info">i</span>
                                <div class="info">
                                    <p class="title">{{trans('storefront::account.profile.info.skype.title')}}</p>
                                    <p class="content">{{trans('storefront::account.profile.info.skype.content')}}</p>
                                </div>
                            </div>
                        </label>
                        <div class="web_link">
                            <input type="text" placeholder="Add Username" name="skype" id="skype" class="form-control clearable"
                                   value="{{ old('skype', $my->user_info->skype) }}" data-link="https://www.skype.com">
                            {{--							<a href="https://www.skype.com/{{ old('skype', $my->user_info->skype) }}" target="_blank">Try</a>--}}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label>Telegram</label>
                        <div class="web_link">
                            <input type="text" placeholder="Add phone number" name="telegram" id="telegram"
                                   class="form-control clearable" value="{{ old('telegram', $my->user_info->telegram) }}"
                                   data-link="https://t.me/">
                            <a href="https://t.me/{{ old('telegram', $my->user_info->telegram) }}"
                               target="_blank">Try</a>
                        </div>
                    </div>
                </div>
            </div>


            <div class="card">
                <h4>{{ trans('storefront::profile.profile.edit.business') }}</h4>
                <div class="row">
                    <div class="col-md-4">
                        <label for=""> {{trans('storefront::account.profile.street-address-1')}} </label>
                        <input type="text" placeholder="" name="street_address_1" id="street_address_1"
                               class="form-control clearable"
                               value="{{ old('street_address_1', $my->user_info->street_address_1) }}">
                    </div>
                    <div class="col-md-4">
                        <label for=""> {{trans('storefront::account.profile.street-address-2')}} </label>
                        <input type="text" name="street_address_2" id="street_address_2" class="form-control clearable"
                               value="{{ old('street_address_2', $my->user_info->street_address_2) }}">
                    </div>
                    <div class="col-md-4">
                        <label for=""> {{trans('storefront::account.profile.city-town')}} </label>
                        <input type="text" name="city" id="city" class="form-control clearable"
                               value="{{ old('city', $my->user_info->city) }}">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <label for=""> {{trans('storefront::account.profile.state-province-county')}} </label>
                        <input type="text" name="state" id="state" class="form-control clearable"
                               value="{{ old('state', $my->user_info->state) }}">
                    </div>
                    <div class="col-md-4">
                        <label for=""> {{trans('storefront::account.profile.zip-code-postal-code')}} </label>
                        <input type="text" name="zip" id="zip" class="form-control clearable"
                               value="{{ old('zip', $my->user_info->zip) }}">
                    </div>
                    <div class="col-md-4">
                        <label for=""> {{trans('storefront::account.profile.country')}} </label>
                        <input type="text" name="country" id="country" class="form-control clearable"
                               value="{{ old('country', $my->user_info->country) }}">
                    </div>
                </div>
            </div>

            <div class="card">
                <h4>{{trans('storefront::account.profile.payment-details')}}</h4>
                <div class="row">
                    <div class="col-md-4">
                        <label for=""> {{trans('storefront::account.profile.cash-app')}} </label>
                        <input type="text" name="cash_app" id="cash_app" class="form-control clearable"
                               value="{{ old('cash_app', $my->user_info->cash_app) }}">
                    </div>
                    <div class="col-md-4">
                        <label for=""> {{trans('storefront::account.profile.paypal')}}
                            <!--div class="infoPop">
                                <span class="porfile-info">i</span>
                                <div class="info">
                                    <p class="title">{{trans('storefront::account.profile.info.paypal.title')}}</p>
                                    <p class="content">{{trans('storefront::account.profile.info.paypal.content')}}</p>
                                </div>
                            </div-->
                        </label>
                        <input type="text" name="paypal" id="paypal" class="form-control clearable"
                               value="{{ old('paypal', $my->user_info->paypal) }}" placeholder="Paypal.me/username">
                    </div>
                    <div class="col-md-4">
                        <label for=""> {{trans('storefront::account.profile.venmo')}} </label>
                        <input type="text" name="venmo" id="venmo" class="form-control clearable"
                               value="{{ old('venmo', $my->user_info->venmo) }}">
                    </div>
                </div>
                {{--@if(!empty($my->user_info->bank))--}}
                    <div class="row">
                        @php
                            $bankInfo = json_decode($my->user_info->bank);
                            $other_bank = json_decode($my->user_info->other_bank,1);
                            $bank_title = isset($other_bank['title'])?$other_bank['title']:[];
                            $bank = isset($other_bank['bank'])?$other_bank['bank']:[];
                        @endphp
                        <div class="col-md-12">
                            <label for=""> {{trans('storefront::account.profile.bank-account')}}<span style="font-size: 12px">(IBN #)</span> </label>
                            <div class="row">
                                <div class="col-md-6">
                                    <label style="font-size: 13px;"> Bank Title</label>
                                    <input type="text" name="bank_title" id="bank_title" class="form-control " value="{{$bankInfo->title}}" placeholder="Bank Title"></div>
                                <div class="col-md-6">
                                    <label style="font-size: 13px;">Account number</label><input type="text" name="bank" id="bank" class="form-control" value="{{$bankInfo->bank_ibn}}" placeholder="Account number">
                                </div>                              
                            </div>
                    </div>
                </div>
                <div class="addMain">
                    <div class="row">
                    @if(!empty($other_bank))
                        @foreach($bank_title as $key=>$bank_title_value)
                            <div class="col-md-4 removeMain">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for=""> Bank Title </label>
                                        <span onClick="closeBtn(this)" style="float:right; cursor: pointer;"><i class="fa fa-close"></i></span>
                                        <input type="text" name="other_bank[title][]"
                                            class="form-control clearable" value="{{isset($bank_title[$key])?$bank_title[$key]:''}}">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for=""> Account number </label>
                                        <input type="text" name="other_bank[bank][]"
                                            class="form-control clearable"
                                            value="{{isset($bank[$key])?$bank[$key]:''}}">
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif  
                    </div>
                    <div class="clearfix"></div>
                    <button type="button" class="btn btn-primary" 
                    onClick="addBank(this)"> {{trans('storefront::account.profile.add-more')}} </button>
                </div>
                {{--@endif--}}
            </div>
            <div class="card connect">
                <h4>{{ trans('storefront::profile.profile.edit.videos') }}</h4>
                <div class="row">
                    <div class="col-md-6">
                        <label for=""><span class="brand_icon"><img
                                        src="{{ v(Theme::url('public/new/images/youtube_icon.png'))}}"
                                        alt=""></span> {{trans('storefront::account.profile.youtube')}}
                            <div class="infoPop">
                                <span class="porfile-info">i</span>
                                <div class="info">
                                    <p class="title">{{trans('storefront::account.profile.info.youtube.title')}}</p>
                                    <p class="content">{{trans('storefront::account.profile.info.youtube.content')}}</p>
                                </div>
                            </div>
                        </label>
                        <div class="web_link">
                            <input type="text" name="youtube" id="youtube" placeholder="Youtube Channel"
                                   class="form-control clearable" value="{{ old('youtube', $my->user_info->youtube) }}"
                                   data-link="https://youtube.com/user/">
                            <a href="https://youtube.com/user/{{ old('youtube', $my->user_info->youtube) }}"
                               target="_blank">Try</a>
                            <div class="url">
                                <p>https://youtube.com/user/<span></span></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for=""><span class="brand_icon"><img
                                        src="{{ v(Theme::url('public/new/images/vemeo_icon.png'))}}"
                                        alt=""></span> {{trans('storefront::account.profile.vimeo')}}
                            <div class="infoPop">
                                <span class="porfile-info">i</span>
                                <div class="info">
                                    <p class="title">{{trans('storefront::account.profile.info.vimeo.title')}}</p>
                                    <p class="content">{{trans('storefront::account.profile.info.vimeo.content')}}</p>
                                </div>
                            </div>
                        </label>
                        <div class="web_link">
                            <input type="text" name="vimeo" placeholder="Add your username" id="vimeo"
                                   class="form-control clearable" value="{{ old('vimeo', $my->user_info->vimeo) }}"
                                   data-link="https://vimeo.com/">
                            <a href="https://vimeo.com/{{ old('vimeo', $my->user_info->vimeo) }}"
                               target="_blank">Try</a>
                            <div class="url">
                                <p>https://vimeo.com/<span></span></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card connect">
                <h4>{{trans('storefront::account.profile.my-music')}}</h4>
                <div class="row">
                    <div class="col-md-6">
                        <label for=""><span class="brand_icon"><img
                                        src="{{ v(Theme::url('public/new/images/sound_cloud_icon.png'))}}"
                                        alt=""></span> {{trans('storefront::account.profile.soundcloud')}}
                            <div class="infoPop">
                                <span class="porfile-info">i</span>
                                <div class="info">
                                    <p class="title">{{trans('storefront::account.profile.info.soundcloud.title')}}</p>
                                    <p class="content">{{trans('storefront::account.profile.info.soundcloud.content')}}</p>
                                </div>
                            </div>
                        </label>
                        <div class="web_link">
                            <input type="text" name="soundcloud" id="soundcloud" class="form-control clearable"
                                   value="{{ old('soundcloud', $my->user_info->soundcloud) }}"
                                   data-link="https://soundcloud.com/">
                            <a href="https://soundcloud.com/{{ old('soundcloud', $my->user_info->soundcloud) }}"
                               target="_blank">Try</a>
                            <div class="url">
                                <p>https://soundcloud.com/<span></span></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for=""><span class="brand_icon"><img
                                        src="{{ v(Theme::url('public/new/images/social_icon.png'))}}"
                                        alt=""></span> {{trans('Spotify')}}
                            <div class="infoPop">
                                <span class="porfile-info">i</span>
                                <div class="info">
                                    <p class="title">{{trans('storefront::account.profile.info.spotify.title')}}</p>
                                    <p class="content">{{trans('storefront::account.profile.info.spotify.content')}}</p>
                                </div>
                            </div>
                        </label>
                        <div class="web_link">
                            <input type="text" name="spotify" id="spotify" class="form-control clearable"
                                   value="{{ old('Spotify', $my->user_info->spotify) }}"
                                   data-link="">
                            <a href="{{ old('spotify', $my->user_info->spotify) }}"
                               target="_blank">Try</a>
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
                                                <label for=""> Select </label><span onClick="closeBtn(this)"
                                                                                    style="float:right; cursor: pointer;"><i
                                                            class="fa fa-close"></i></span>
                                                <select name="other_music[type][]">
                                                    <option
                                                            value="Apple Music" {{$type_value == 'Apple Music' ? 'selected':''}}>
                                                        Apple Music
                                                    </option>
                                                    <option
                                                            value="Amazon Music" {{$type_value == 'Amazon Music' ? 'selected':''}}>
                                                        Amazon Music
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label for=""> {{trans('storefront::account.profile.title')}} </label>
                                            <input type="text" name="other_music[title][]" id="title_12"
                                                   class="form-control clearable" value="{{isset($title[$key])?$title[$key]:''}}">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label for=""> {{trans('storefront::account.profile.music-link')}} </label>
                                            <input type="text" name="other_music[music_link][]" id="music_link"
                                                   class="form-control clearable"
                                                   value="{{isset($music_link[$key])?$music_link[$key]:''}}">
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                    <div class="clearfix"></div>
                    <button type="button" class="btn btn-primary"
                            onClick="addMusic(this)"> {{trans('storefront::account.profile.add-more')}} </button>
                </div>
            </div>
            <div class="card">
                <h4>{{ trans('storefront::profile.profile.edit.links') }}</h4>
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
                                                <label
                                                        for=""> {{trans('storefront::account.profile.title')}} </label><span
                                                        onClick="closeBtn(this)" style="float:right; cursor: pointer;"><i
                                                            class="fa fa-close"></i></span>
                                                <input type="text" name="favorite_links[title][]" id="favorite_title"
                                                       class="form-control clearable" value="{{$title_value}}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label
                                                    for=""> {{trans('storefront::account.profile.your-favorite-link')}} </label>
                                            <input type="text" name="favorite_links[link][]" id="favorite_link"
                                                   class="form-control clearable" value="{{$link[$key]}}">
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>

                    <div class="clearfix"></div>
                    <button type="button" class="btn btn-primary"
                            onClick="addFavLinks(this)"> {{trans('storefront::account.profile.add-more')}} </button>
                </div>
            </div>

            <div class="bottom_btns">
                <button type="submit" class="btn btn-primary" style="clear: both; margin-bottom: 40px;"
                        data-loading> {{ trans('storefront::account.profile.save_changes') }} </button>
            </div>
        </div>
    </form>

@endsection
@section('page_script')

    <link rel="stylesheet" href="{{url('/themes/storefront/public/css/doka.css')}}" type="text/css">
    <script src="{{url('/themes/storefront/public/js/doka.js')}}"></script>
    <script>


        $(document).ready(function () {
            dokifyEdit($('#profile'));
            dokifyCompEdit($('#company_avatar'));
            $('.web_link input').on('keyup', function () {
                $(this).next('a').attr('href', $(this).data('link') + $(this).val());
            });

            $('.deleteImg').click(function () {

                if (confirm("Are you sure you want to delete this?")) {
                    deleteImg();
                } else {
                    return false;
                }

            });

            $('.deleteCompanyImg').click(function () {

                if (confirm("Are you sure you want to delete this image?")) {
                    deleteCompanyImg();
                } else {
                    return false;
                }

            });
        });

        function deleteImg() {
            $.ajax({
                url: "{{route('removeUserImage')}}",
                type: "POST",
                processData: false,
                contentType: false,
                success: function (result, textStatus, jqXHR) {
                    try {
                        result = JSON.parse(result);
                    } catch (e) {
                    }
                    if ($.trim(result.success) == 'true') {
                        $('#user_avatar').attr('src', result.image_path);
                        $('.deleteImg').remove();
                    } else {
                        var errorsShow = '';
                        $.each(result.message, function (k, v) {
                            errorsShow += v + '<br>';
                        });
                        swal({
                            title: "Error!",
                            text: errorsShow,
                            html: true,
                            type: "error"
                        });
                    }
                },
                error: function (jqXHR, textStatus, errorThrown) {
                }
            });
        }

        function deleteCompanyImg() {
            $.ajax({
                url: "{{route('removeCompanyImage')}}",
                type: "POST",
                processData: false,
                contentType: false,
                success: function (result, textStatus, jqXHR) {
                    try {
                        result = JSON.parse(result);
                    } catch (e) {
                    }
                    if ($.trim(result.success) == 'true') {
                        $('#company_avatar_img').attr('src', result.image_path);
                        $('.deleteCompanyImg').remove();
                    } else {
                        var errorsShow = '';
                        $.each(result.message, function (k, v) {
                            errorsShow += v + '<br>';
                        });
                        swal({
                            title: "Error!",
                            text: errorsShow,
                            html: true,
                            type: "error"
                        });
                    }
                },
                error: function (jqXHR, textStatus, errorThrown) {
                }
            });
        }

        function dokifyCompEdit(dokaSelector) {

            $(dokaSelector).on('change', function (event) {
                var doka = Doka.create({
                    src: event.target.files[0],
                    cropShowSize: false,
                    outputQuality: 100,
                    cropMinImageWidth: 300,
                    cropMinImageHeight: 300,
                    labelStatusAwaitingImage: 'Loading Image, Please wait...',
                    labelStatusLoadImageError: 'Image not upload successfully. please try again',
                    labelStatusLoadingImage: 'Loading image ...',
                    labelStatusProcessingImage: 'Processing image ...',
                    labelButtonCancel: 'Cancel',
                    labelButtonConfirm: 'Upload Image',
                    labelButtonCropZoom: 'Zoom in',
                    labelButtonCropRotateLeft: 'Rotate left',
                    labelButtonCropRotateRight: 'Rotate right',
                    labelButtonCropRotateCenter: 'Center of rotation',
                    labelButtonCropFlipHorizontal: 'Horizontal Flip',
                    labelButtonCropFlipVertical: 'Vertical Flip',
                    labelButtonCropAspectRatio: 'Balanced dimensions',
                    labelButtonUtilCrop: 'Crop',
                    labelButtonUtilFilter: 'Filter',
                    labelButtonUtilResize: 'Resize the image',
                    cropAspectRatioOptions: [/*{
                     label: "Painting",
                     value: 1.5
                     }, */{
                        label: "Square",
                        value: '1:1'
                    }/*, {
                     label: "Natural images",
                     value: 0.75
                     }*/],
                    utils: ['crop', 'filter'/*, 'resize'*/],
                    onconfirm: async function (EditedFile) {
                        var formData = new FormData();
                        formData.append('company_avatar', EditedFile.file, EditedFile.file.name);
                        $.ajax({
                            url: "{{route('uploadCompImage')}}",
                            type: "POST",
                            data: formData,
                            processData: false,
                            contentType: false,
                            success: function (result, textStatus, jqXHR) {
                                try {
                                    result = JSON.parse(result);
                                } catch (e) {
                                }
                                if ($.trim(result.success) == 'true') {
                                    $('#company_avatar_img').attr('src', result.image_path);
                                    if ($('.deleteCompanyImg').length == 0) {
                                        $('.companyPicture').append('<div class="deleteCompanyImg" onclick="">Delete Photo</div>');
                                        $('.deleteCompanyImg').click(function () {

                                            if (confirm("Are you sure you want to delete this?")) {
                                                deleteCompanyImg();
                                            } else {
                                                return false;
                                            }

                                        });
                                    }
                                } else {
                                    var errorsShow = '';
                                    $.each(result.message, function (k, v) {
                                        errorsShow += v + '<br>';
                                    });
                                    swal({
                                        title: "Error!",
                                        text: errorsShow,
                                        html: true,
                                        type: "error"
                                    });
                                }
                            },
                            error: function (jqXHR, textStatus, errorThrown) {
                            }
                        });
                        dokaDie(doka, dokaSelector);
                    },
                    onloaderror: function (error) {
                        if (error.status === "IMAGE_UNKNOWN_ERROR") {
                            swal('Warning', 'Only images are allowed', 'error');
                        } else if (error.status === "IMAGE_MIN_SIZE_VALIDATION_ERROR") {
                            const {
                                data
                            } = error;
                            swal('Warning', 'Image size must be at least' + data.minImageSize.width + 'x' + data.minImageSize.height, 'error');
                        } else {
                            swal('Warning', 'An error occurred, please try again', 'error');
                        }
                        dokaDie(doka, dokaSelector);
                    },
                    oncancel: function () {
                        dokaDie(doka, dokaSelector);
                    }
                });
            });
        }

        function dokifyEdit(dokaSelector) {

            $(dokaSelector).on('change', function (event) {
                var doka = Doka.create({
                    src: event.target.files[0],
                    cropShowSize: false,
                    outputQuality: 100,
                    cropMinImageWidth: 300,
                    cropMinImageHeight: 300,
                    labelStatusAwaitingImage: 'Loading Image, Please wait...',
                    labelStatusLoadImageError: 'Image not upload successfully. please try again',
                    labelStatusLoadingImage: 'Loading image ...',
                    labelStatusProcessingImage: 'Processing image ...',
                    labelButtonCancel: 'Cancel',
                    labelButtonConfirm: 'Upload Image',
                    labelButtonCropZoom: 'Zoom in',
                    labelButtonCropRotateLeft: 'Rotate left',
                    labelButtonCropRotateRight: 'Rotate right',
                    labelButtonCropRotateCenter: 'Center of rotation',
                    labelButtonCropFlipHorizontal: 'Horizontal Flip',
                    labelButtonCropFlipVertical: 'Vertical Flip',
                    labelButtonCropAspectRatio: 'Balanced dimensions',
                    labelButtonUtilCrop: 'Crop',
                    labelButtonUtilFilter: 'Filter',
                    labelButtonUtilResize: 'Resize the image',
                    cropAspectRatioOptions: [/*{
                     label: "Painting",
                     value: 1.5
                     }, */{
                        label: "Square",
                        value: '1:1'
                    }/*, {
                     label: "Natural images",
                     value: 0.75
                     }*/],
                    utils: ['crop', 'filter'/*, 'resize'*/],
                    onconfirm: async function (EditedFile) {
                        var formData = new FormData();
                        formData.append('avatar', EditedFile.file, EditedFile.file.name);
                        $.ajax({
                            url: "{{route('uploadUserImage')}}",
                            type: "POST",
                            data: formData,
                            processData: false,
                            contentType: false,
                            success: function (result, textStatus, jqXHR) {
                                try {
                                    result = JSON.parse(result);
                                } catch (e) {
                                }
                                if ($.trim(result.success) == 'true') {
                                    $('#user_avatar').attr('src', result.image_path);
                                    if ($('.deleteImg').length == 0) {
                                        $('.profilePicture').append('<div class="deleteImg" onclick="">Delete Photo</div>');
                                        $('.deleteImg').click(function () {

                                            if (confirm("Are you sure you want to delete this?")) {
                                                deleteImg();
                                            } else {
                                                return false;
                                            }

                                        });
                                    }
                                } else {
                                    var errorsShow = '';
                                    $.each(result.message, function (k, v) {
                                        errorsShow += v + '<br>';
                                    });
                                    swal({
                                        title: "Error!",
                                        text: errorsShow,
                                        html: true,
                                        type: "error"
                                    });
                                }
                            },
                            error: function (jqXHR, textStatus, errorThrown) {
                            }
                        });
                        dokaDie(doka, dokaSelector);
                    },
                    onloaderror: function (error) {
                        if (error.status === "IMAGE_UNKNOWN_ERROR") {
                            swal('Warning', 'Only images are allowed', 'error');
                        } else if (error.status === "IMAGE_MIN_SIZE_VALIDATION_ERROR") {
                            const {
                                data
                            } = error;
                            swal('Warning', 'Image size must be at least' + data.minImageSize.width + 'x' + data.minImageSize.height, 'error');
                        } else {
                            swal('Warning', 'An error occurred, please try again', 'error');
                        }
                        dokaDie(doka, dokaSelector);
                    },
                    oncancel: function () {
                        dokaDie(doka, dokaSelector);
                    }
                });
            });
        }

        function forceLower(strInput) {
            strInput.value = strInput.value.toLowerCase();
        }

        function dokaDie(doka, dokaSelector) {
            // Reset The Input
            doka.destroy();
            $(dokaSelector).val('');
        }

    </script>
@endsection

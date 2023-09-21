@if(!empty($user->username))
    <div class="row">
        <div class="col-md-12">
            <a href="{{route('account.profile.view',$user->username)}}" class="btn btn-primary pull-right" style="position:absolute; top:-70px; right: 10px;">View Profile</a>
        </div>
    </div>
@endif
<div class="row">
    <div class="col-md-12">
        {{ Form::text('first_name', trans('user::attributes.users.first_name'), $errors, $user, ['required' => true]) }}
        {{ Form::text('middle_name', 'Middle Name', $errors, $user, ['required' => false]) }}
        {{ Form::text('last_name', trans('user::attributes.users.last_name'), $errors, $user, ['required' => true]) }}
        {{ Form::email('email', trans('user::attributes.users.email'), $errors, $user, ['required' => true]) }}
        @if (request()->routeIs('admin.users.edit'))
            <div class="form-group ">
                <label for="username" class="col-md-3 control-label text-left">
                    {{trans('storefront::account.profile.username')}}
                </label>
                <div class="col-md-9">
                    <input name="username" class="form-control " id="username" type="text" value="{{$user->username}}" disabled>
                </div>
            </div>
        @endif
        @php
            $has_partner = false;
            $users_roles = $user->roles->toArray();
            foreach ($users_roles as $users_role){
                if($users_role['id'] == '3'){
                    $has_partner = true;
                }
            }
        @endphp
        {{ Form::select('roles', trans('user::attributes.users.roles'), $errors, $roles, $user, ['multiple' => true, 'required' => true, 'class' => 'selectize prevent-creation']) }}
        @if (request()->routeIs('admin.users.create'))
            <div class="account-details">
                <div class="account clearfix">
                    <h4>{{ trans('storefront::account.profile.account') }}</h4>
                    <div class="row">
                        <div class="col-md-6">
                            <label>Current Image:</label>
                            <img src="{{url('/images/users/default.jpg')}}" style="max-height: 150px; width: auto; display: block; clear: both;" id="profImg"> </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for=""> Select Image: </label>
                                <input type="file" name="profile" id="profile" class="form-control" onChange="readURL(this)" >
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{--@if($has_partner == false)
                <div class="account-details">
                    <div class="account clearfix">
                        <h4>About Me</h4>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for=""> Profession </label>
                                    <input type="text" name="profession" id="profession" class="form-control" value="{{ old('profession') }}">
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for=""> About Me <span style="font-size: 13px">(280 Charactors Only)</span> </label>
                                    <textarea type="text" name="about_me" id="about_me" class="form-control">{{ old('about_me') }}</textarea>
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
                                    <label for=""> Job Title </label>
                                    <input type="text" name="job_title" id="job_title" class="form-control" value="{{ old('job_title') }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for=""> Company </label>
                                    <input type="text" name="company" id="company" class="form-control" value="{{ old('company') }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for=""> Phone Number </label>
                                    <input type="text" name="job_phone" id="job_phone" class="form-control" value="{{ old('job_phone') }}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="account-details">
                    <div class="account clearfix">
                        <h4>Contact Details</h4>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for=""> Website<span style="font-size: 13px">(http://example.com)</span> </label>
                                    <input type="text" name="website" id="website" class="form-control" value="{{ old('website') }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for=""> Phone Number </label>
                                    <input type="text" name="phone" id="phone" class="form-control" value="{{ old('phone') }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for=""> Fax </label>
                                    <input type="text" name="fax" id="fax" class="form-control" value="{{ old('fax') }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for=""> Facebook Messanger </label>
                                    <input type="text" name="fb_messenger" id="fb_messenger" class="form-control" value="{{ old('fb_messenger') }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for=""> WeChat </label>
                                    <input type="text" name="wechat" id="wechat" class="form-control" value="{{ old('wechat') }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for=""> Whatsapp </label>
                                    <input type="text" name="whatsapp" id="whatsapp" class="form-control" value="{{ old('whatsapp') }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for=""> Skype </label>
                                    <input type="text" name="skype" id="skype" class="form-control" value="{{ old('skype') }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for=""> Telegram </label>
                                    <input type="text" name="telegram" id="telegram" class="form-control" value="{{ old('telegram') }}">
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
                                    <label for=""> Street Address 1 </label>
                                    <input type="text" name="street_address_1" id="street_address_1" class="form-control" value="{{ old('street_address_1') }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for=""> Street Address 2 </label>
                                    <input type="text" name="street_address_2" id="street_address_2" class="form-control" value="{{ old('street_address_2') }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for=""> City/Town </label>
                                    <input type="text" name="city" id="city" class="form-control" value="{{ old('city') }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for=""> State/Province/County </label>
                                    <input type="text" name="state" id="state" class="form-control" value="{{ old('state') }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for=""> Zip Code / Postal Code </label>
                                    <input type="text" name="zip" id="zip" class="form-control" value="{{ old('zip') }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for=""> Country </label>
                                    <input type="text" name="country" id="country" class="form-control" value="{{ old('country') }}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="account-details">
                    <div class="account clearfix">
                        <h4>Connect Details</h4>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for=""> Facebook </label>
                                    <input type="text" name="facebook" id="facebook" class="form-control" value="{{ old('facebook') }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for=""> Facebook Page </label>
                                    <input type="text" name="facebook_page" id="facebook_page" class="form-control" value="{{ old('facebook_page') }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for=""> Twitter </label>
                                    <input type="text" name="twitter" id="twitter" class="form-control" value="{{ old('twitter') }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for=""> Instagram </label>
                                    <input type="text" name="instagram" id="instagram" class="form-control" value="{{ old('instagram') }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for=""> Tumblr </label>
                                    <input type="text" name="tumblr" id="tumblr" class="form-control" value="{{ old('tumblr') }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for=""> Pinterest </label>
                                    <input type="text" name="pinterest" id="pinterest" class="form-control" value="{{ old('pinterest') }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for=""> SnapChat </label>
                                    <input type="text" name="snapchat" id="snapchat" class="form-control" value="{{ old('snapchat') }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for=""> Linkedin </label>
                                    <input type="text" name="linkedin" id="linkedin" class="form-control" value="{{ old('linkedin') }}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="account-details">
                    <div class="account clearfix">
                        <h4>Payment Details</h4>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for=""> Cash App </label>
                                    <input type="text" name="cash_app" id="cash_app" class="form-control" value="{{ old('cash_app') }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for=""> Paypal </label>
                                    <input type="text" name="paypal" id="paypal" class="form-control" value="{{ old('paypal') }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for=""> Venmo </label>
                                    <input type="text" name="venmo" id="venmo" class="form-control" value="{{ old('venmo') }}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="account-details">
                    <div class="account clearfix">
                        <h4>My Videos</h4>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for=""> Youtube </label>
                                    <input type="text" name="youtube" id="youtube" class="form-control" value="{{ old('youtube') }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for=""> Vimeo </label>
                                    <input type="text" name="vimeo" id="vimeo" class="form-control" value="{{ old('vimeo') }}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="account-details">
                    <div class="account clearfix">
                        <h4>My Music</h4>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for=""> Soundcloud </label>
                                    <input type="text" name="soundcloud" id="soundcloud" class="form-control" value="{{ old('soundcloud') }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for=""> Reverbnation </label>
                                    <input type="text" name="revebnation" id="revebnation" class="form-control" value="{{ old('revebnation') }}">
                                </div>
                            </div>
                        </div>
                        <div class="addMain">
                            <div class="row">
                                <div class="col-md-4 removeMain">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for=""> Select </label><span onClick="closeBtn(this)" style="float:right; cursor: pointer;"><i class="fa fa-close"></i></span>
                                                <select name="other_music[type][]">
                                                    <option value="Soptify">Soptify</option>
                                                    <option value="Apple Music">Apple Music</option>
                                                    <option value="Amazon Music">Amazon Music</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for=""> Title </label>
                                                <input type="text" name="other_music[title][]" id="title_12" class="form-control" value="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for=""> Music Link </label>
                                                <input type="text" name="other_music[music_link][]" id="music_link" class="form-control" value="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <button type="button" class="btn btn-primary" onClick="addMusic(this)"> Add More </button>
                        </div>
                    </div>
                </div>
                <div class="account-details">
                    <div class="account clearfix">
                        <h4>My Favorite Links</h4>
                        <div class="addMain">
                            <div class="row">
                                <div class="col-md-4 removeMain">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for=""> Title </label><span onClick="closeBtn(this)" style="float:right; cursor: pointer;"><i class="fa fa-close"></i></span>
                                                <input type="text" name="favorite_links[title][]" id="favorite_title" class="form-control" value="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for=""> Your Favorite Link </label>
                                                <input type="text" name="favorite_links[link][]" id="favorite_link" class="form-control" value="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <button type="button" class="btn btn-primary" onClick="addFavLinks(this)"> Add More </button>
                        </div>
                    </div>
                </div>
                @endif--}}
            {{ Form::password('password', trans('user::attributes.users.password'), $errors, null, ['required' => true]) }}
            {{ Form::password('password_confirmation', trans('user::attributes.users.password_confirmation'), $errors, null, ['required' => true]) }}
        @endif
        @if (request()->routeIs('admin.users.edit'))
            @if($has_partner == false)
                <div class="account-details">
                    <div class="account clearfix">
                        <h4>About Me</h4>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for=""> Profession </label>
                                    <input type="text" name="profession" id="profession" class="form-control" value="{{ old('profession', $user->user_info->profession) }}">
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for=""> About Me <span style="font-size: 13px">(280 Charactors Only)</span> </label>
                                    <textarea type="text" name="about_me" id="about_me" class="form-control">{{ old('about_me', $user->user_info->about_me) }}</textarea>
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
                                    <label for=""> Job Title </label>
                                    <input type="text" name="job_title" id="job_title" class="form-control" value="{{ old('job_title', $user->user_info->job_title) }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for=""> Company </label>
                                    <input type="text" name="company" id="company" class="form-control" value="{{ old('company', $user->user_info->company) }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for=""> Phone Number </label>
                                    <input type="text" name="job_phone" id="job_phone" class="form-control" value="{{ old('job_phone', $user->user_info->job_phone) }}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="account-details">
                    <div class="account clearfix">
                        <h4>Contact Details</h4>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for=""> Website<span style="font-size: 13px">(http://example.com)</span> </label>
                                    <input type="text" name="website" id="website" class="form-control" value="{{ old('website', $user->user_info->website) }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for=""> Phone Number </label>
                                    <input type="text" name="phone" id="phone" class="form-control" value="{{ old('phone', $user->user_info->phone) }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for=""> Fax </label>
                                    <input type="text" name="fax" id="fax" class="form-control" value="{{ old('fax', $user->user_info->fax) }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group {{ $errors->has('email') ? 'has-error': '' }}">
                                    <label for=""> {{ trans('storefront::account.profile.email') }}<span>*</span> </label>
                                    <input type="text" name="email" id="email" class="form-control" value="{{ old('email', $user->email) }}">
                                    {!! $errors->first('email', '<span class="error-message">:message</span>') !!} </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for=""> Facebook Messanger </label>
                                    <input type="text" name="fb_messenger" id="fb_messenger" class="form-control" value="{{ old('fb_messenger', $user->user_info->fb_messenger) }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for=""> WeChat </label>
                                    <input type="text" name="wechat" id="wechat" class="form-control" value="{{ old('wechat', $user->user_info->wechat) }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for=""> Whatsapp </label>
                                    <input type="text" name="whatsapp" id="whatsapp" class="form-control" value="{{ old('whatsapp', $user->user_info->whatsapp) }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for=""> Skype </label>
                                    <input type="text" name="skype" id="skype" class="form-control" value="{{ old('skype', $user->user_info->skype) }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for=""> Telegram </label>
                                    <input type="text" name="telegram" id="telegram" class="form-control" value="{{ old('telegram', $user->user_info->telegram) }}">
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
                                    <label for=""> Street Address 1 </label>
                                    <input type="text" name="street_address_1" id="street_address_1" class="form-control" value="{{ old('street_address_1', $user->user_info->street_address_1) }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for=""> Street Address 2 </label>
                                    <input type="text" name="street_address_2" id="street_address_2" class="form-control" value="{{ old('street_address_2', $user->user_info->street_address_2) }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for=""> City/Town </label>
                                    <input type="text" name="city" id="city" class="form-control" value="{{ old('city', $user->user_info->city) }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for=""> State/Province/County </label>
                                    <input type="text" name="state" id="state" class="form-control" value="{{ old('state', $user->user_info->state) }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for=""> Zip Code / Postal Code </label>
                                    <input type="text" name="zip" id="zip" class="form-control" value="{{ old('zip', $user->user_info->zip) }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for=""> Country </label>
                                    <input type="text" name="country" id="country" class="form-control" value="{{ old('country', $user->user_info->country) }}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="account-details">
                    <div class="account clearfix">
                        <h4>Connect Details</h4>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for=""> Facebook </label>
                                    <input type="text" name="facebook" id="facebook" class="form-control" value="{{ old('facebook', $user->user_info->facebook) }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for=""> Facebook Page </label>
                                    <input type="text" name="facebook_page" id="facebook_page" class="form-control" value="{{ old('facebook_page', $user->user_info->facebook_page) }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for=""> Twitter </label>
                                    <input type="text" name="twitter" id="twitter" class="form-control" value="{{ old('twitter', $user->user_info->twitter) }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for=""> Instagram </label>
                                    <input type="text" name="instagram" id="instagram" class="form-control" value="{{ old('instagram', $user->user_info->instagram) }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for=""> Tumblr </label>
                                    <input type="text" name="tumblr" id="tumblr" class="form-control" value="{{ old('tumblr', $user->user_info->tumblr) }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for=""> Pinterest </label>
                                    <input type="text" name="pinterest" id="pinterest" class="form-control" value="{{ old('pinterest', $user->user_info->pinterest) }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for=""> SnapChat </label>
                                    <input type="text" name="snapchat" id="snapchat" class="form-control" value="{{ old('snapchat', $user->user_info->snapchat) }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for=""> Linkedin </label>
                                    <input type="text" name="linkedin" id="linkedin" class="form-control" value="{{ old('linkedin', $user->user_info->linkedin) }}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="account-details">
                    <div class="account clearfix">
                        <h4>Payment Details</h4>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for=""> Cash App </label>
                                    <input type="text" name="cash_app" id="cash_app" class="form-control" value="{{ old('cash_app', $user->user_info->cash_app) }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for=""> Paypal </label>
                                    <input type="text" name="paypal" id="paypal" class="form-control" value="{{ old('paypal', $user->user_info->paypal) }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for=""> Venmo </label>
                                    <input type="text" name="venmo" id="venmo" class="form-control" value="{{ old('venmo', $user->user_info->venmo) }}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="account-details">
                    <div class="account clearfix">
                        <h4>My Videos</h4>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for=""> Youtube </label>
                                    <input type="text" name="youtube" id="youtube" class="form-control" value="{{ old('youtube', $user->user_info->youtube) }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for=""> Vimeo </label>
                                    <input type="text" name="vimeo" id="vimeo" class="form-control" value="{{ old('vimeo', $user->user_info->vimeo) }}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="account-details">
                    <div class="account clearfix">
                        <h4>My Music</h4>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for=""> Soundcloud </label>
                                    <input type="text" name="soundcloud" id="soundcloud" class="form-control" value="{{ old('soundcloud', $user->user_info->soundcloud) }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for=""> Reverbnation </label>
                                    <input type="text" name="revebnation" id="revebnation" class="form-control" value="{{ old('revebnation', $user->user_info->revebnation) }}">
                                </div>
                            </div>
                        </div>
                        <div class="addMain">
                            <div class="row">
                                @php
                                    $other_music = json_decode($user->user_info->other_music,1);
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
                                                        <label for=""> Title </label>
                                                        <input type="text" name="other_music[title][]" id="title_12" class="form-control" value="{{isset($title[$key])?$title[$key]:''}}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for=""> Music Link </label>
                                                        <input type="text" name="other_music[music_link][]" id="music_link" class="form-control" value="{{isset($music_link[$key])?$music_link[$key]:''}}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                            <div class="clearfix"></div>
                            <button type="button" class="btn btn-primary" onClick="addMusic(this)"> Add More </button>
                        </div>
                    </div>
                </div>
                <div class="account-details">
                    <div class="account clearfix">
                        <h4>My Favorite Links</h4>
                        <div class="addMain">
                            <div class="row">
                                @php
                                    $favorite_links = json_decode($user->user_info->favorite_links,1);
                                    $title = isset($favorite_links['title'])?$favorite_links['title']:[];
                                    $link = isset($favorite_links['link'])?$favorite_links['link']:[];
                                @endphp
                                @if(!empty($favorite_links))
                                    @foreach($title as $key=>$title_value)
                                        <div class="col-md-4 removeMain">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for=""> Title </label><span onClick="closeBtn(this)" style="float:right; cursor: pointer;"><i class="fa fa-close"></i></span>
                                                        <input type="text" name="favorite_links[title][]" id="favorite_title" class="form-control" value="{{$title_value}}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for=""> Your Favorite Link </label>
                                                        <input type="text" name="favorite_links[link][]" id="favorite_link" class="form-control" value="{{$link[$key]}}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif

                            </div>
                            <div class="clearfix"></div>
                            <button type="button" class="btn btn-primary" onClick="addFavLinks(this)"> Add More </button>
                        </div>
                    </div>
                </div>
                <div class="account-details">
                    <div class="account clearfix">
                        <h4>Cards Links</h4>
                        <div class="row">
                            @php
                                $all_links = getThisUserLinks($user->id);
                            @endphp
                            <div class="col-md-12">
                                {{route('cardLogin',\_encode($user->id))}}
                            </div>
                            @foreach($all_links as $all_link)
                                <div class="col-md-12">
                                    {{route('cardLogin',\_encode($all_link['id']))}}
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
            {{ Form::checkbox('activated', trans('user::attributes.users.activated'), trans('user::users.form.activated'), $errors, $user, ['disabled' => $user->id === $currentUser->id, 'checked' => old('activated', $user->isActivated())]) }}
        @endif
    </div>
</div>

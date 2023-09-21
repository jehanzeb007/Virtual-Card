@extends('public.layout')

@section('public_profile_meta')
    <meta property="og:title"
          content="{{ucfirst($my->first_name)}} {{ucfirst($my->middle_name).' '.ucfirst($my->last_name)}}"/>
    <meta property="og:image:secure_url"
          content="{{ ($my->avatar!='')?url('/images/users/'.$my->id.'/'.'thumb-'.$my->avatar):v(Theme::url('public/new/images/logo.png'))}}"/>
    <meta property="og:image"
          content="{{ ($my->avatar!='')?url('/images/users/'.$my->id.'/'.'thumb-'.$my->avatar):v(Theme::url('public/new/images/logo.png'))}}"/>
@endsection

@section('title', ucfirst($my->first_name).' '.ucfirst($my->middle_name).' '.ucfirst($my->last_name))

@section('account_breadcrumbbanner_area')
    <li class="active">{{ trans('storefront::account.links.my_profile') }}</li>
@endsection

@section('content')
    <div class="banner_area profileBanner"
         style="background-image: url('{{ v(Theme::url('public/new/images/profileBg.png'))}}')">
        <div class="container">
            <div class="buttons">
                @php
                    $user = auth()->user();
                    $idCurrent = $user->id;
                     $hideEmail = true;
                    if($my->user_info->showEmail == 'on') {
                        $hideEmail = false;
                    }
                @endphp

                @if(Auth::check())
                    <a href="{{route('account.dashboard.index')}}"><i class="fas fa-home"></i></a>
                @else
                    <a href="{{route('login')}}"><i class="fas fa-sign-in-alt"></i></i></a>
                @endif

                @if($idCurrent == $my->id)
                    <a href="{{url('/account/profile')}}"><i class="fas fa-pencil-alt"></i></a>
                @endif
                <a href="javascript:getlink();" data-toggle="copytext" title="User copied"><i class="fas fa-copy"></i></a>
            </div>
            <div class="qrClick">
                <i class="fas fa-qrcode"></i>
            </div>
            <div class="banner_image_right">
                @if(!empty($my->avatar))
                    <img src="{{($my->avatar!='')?url('/images/users/'.$my->id.'/'.'thumb-'.$my->avatar):''}}" alt="">
                @else
                    <div class="borderWithInitial">
                        <div class="initial">
                            {{ str_limit($my->first_name, $limit = 1, $end = '').str_limit($my->last_name, $limit = 1, $end = '') }}
                        </div>
                    </div>
                @endif
                @if(!empty($my->company_avatar))
                    <a href="#"><img
                            src="{{url('/images/users/'.$my->id.'/'.'thumb-'.$my->company_avatar)}}"
                            alt="" id="company_avatar_img"></a>
                @endif
            </div>
            <h1>{{ucfirst($my->first_name)}} {{ucfirst($my->middle_name).' '.ucfirst($my->last_name)}}</h1>
        </div>

    </div>
    <div class="content_area profileContent">
        <div class="container">
            <div class="row">
                @if ($my->username2 != null)
                    <div class="download_section_inner">
                        <div class="row">
                            <div class="col-md-12">
                                <a href="{{route('account.profile.generateVcard',$my->username)}}"
                                class="download_link">
                                    <i class="fas fa-chevron-down"></i>
                                    {{ trans('storefront::profile.profile.view.download') }}
                                </a>
                            </div>
                        </div>
                    </div>                    
                @endif

                @if(!empty($my->user_info->job_title) || !empty($my->user_info->company) || !empty($my->user_info->profession) || !empty($my->user_info->city) || !empty($my->user_info->state) || !empty($my->user_info->country) || !empty($my->user_info->about_me))
                    <div class="col-md-8">
                        <div class="download_section">
                            <h2>
                                @if(!empty($my->user_info->job_title))
                                    {{$my->user_info->job_title }}
                                @endif
                                @if(!empty($my->user_info->job_title) && !empty($my->user_info->company))
                                    {{', '}}
                                @endif
                                @if(!empty($my->user_info->company))
                                    <br/>{{$my->user_info->company}}
                                @endif
                            </h2>
                            @if(!empty($my->user_info->city) || !empty($my->user_info->state) || !empty($my->user_info->country))
                                <span class="sub_heading">
										@if(!empty($my->user_info->city))
                                        {{$my->user_info->city}},
                                    @endif
                                    @if(!empty($my->user_info->state))
                                        {{$my->user_info->state}}
                                    @endif
										</span>
                                <span class="sub_heading">
                                        @if(!empty($my->user_info->country))
                                        {{$my->user_info->country}}
                                    @endif
										</span>
                            @endif
                            @if(!empty($my->user_info->about_me))
                                <span class="sub_heading bio">{{$my->user_info->about_me}}</span>
                            @endif
                        </div>
                    </div>
                @endif
                @php $lastLetter =''; @endphp
                <div class="col-md-12">
                    <br><br>
                    <div class="row">
                        <div class="col-sm-12 col-12 col-md-12">
                            <div class="d-flex text-center float-right">
            <span class="badge badge-pill badge-light">
                <i class="fa fa-eye"></i>&nbsp;{{isset($counters['View']) ? $counters['View'] : '0'}}
            </span>
                                <span class="badge badge-pill badge-light">
                <i class="fa fa-download">&nbsp;{{isset($counters['Download']) ? $counters['Download'] : '0'}}</i>
            </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @if(!empty($my->user_info->phone) || !empty($my->user_info->job_phone))
                @if(!empty($my->user_info->phone))
                    <div class="phone">
                        <a href="tel:{{$my->user_info->phone}}" target="_blank">
                            <i class="fas fa-phone-alt"></i>
                            <h5>{{$my->user_info->phone}}</h5>
                        </a>
                        @if ($my->user_info->showWhatsapp == 'on')
                            <a href="https://wa.me/{{$my->user_info->phone}}" target="_blank">
                                <i class="fab fa-whatsapp-square" style="font-size: 26px !important;"></i>
                            </a> 
                        @endif

                    </div>
                @endif
                @if(!empty($my->user_info->job_phone))
                    <div class="phone">
                        <a href="tel:{{$my->user_info->job_phone}}" target="_blank">
                            <i class="fas fa-briefcase"></i>
                            <h5>{{$my->user_info->job_phone}}</h5>
                        </a>
                        @if ($my->user_info->showJobWhatsapp == 'on')
                        <a href="https://wa.me/{{$my->user_info->phone}}" target="_blank">
                            <i class="fab fa-whatsapp-square" style="font-size: 26px !important;"></i>
                        </a> 
                    @endif
                    </div>
                @endif
                @if(!empty($my->email) && $lastLetter == '' && $hideEmail)
                    <div class="phone">
                        <a href="mailto:{{$my->email}}" target="_blank">
                            <i class="far fa-envelope"></i>
                            <h5>{{$my->email}}</h5>
                        </a>
                    </div>
                @endif
                @if(!empty($my->user_info->company_email))
                    <div class="phone">
                        <a href="mailto:{{$my->user_info->company_email}}" target="_blank">
                            <i class="far fa-envelope"></i>
                            <h5>{{$my->user_info->company_email}}</h5>
                        </a>
                    </div>
                @endif
                @if(!empty($my->user_info->website))
                    @php
                        $cutom_web = $my->user_info->website;
                        if (!preg_match("~^(?:f|ht)tps?://~i", $cutom_web)) {
                            $cutom_web = "http://" . $cutom_web;
                        }
                    @endphp
                    <div class="phone">
                        <a href="{{$cutom_web}}" target="_blank">
                            <i class="fas fa-globe"></i>
                            <h5>{{trim($my->user_info->website,'/')}}</h5>
                        </a>
                    </div>
                @endif
            @endif
            <div class="social_links">
                <div class="row">
                    @if(!empty($my->user_info->instagram))
                        <div class="col-md-6">
                            <a target="_blank" href="https://instagram.com/{{$my->user_info->instagram}}"
                               class="social_main">
                                <img src="{{ v(Theme::url('public/new/images/instagram_icon.png'))}}" alt="">
                                <span>{{'@'}}{{trim($my->user_info->instagram,'/')}}</span>
                            </a>
                        </div>
                    @endif
                    @if(!empty($my->user_info->tiktok))
                        <div class="col-md-6">
                            <a target="_blank"
                               href="https://tiktok.com/{{ "@" }}{{strtolower(old('tiktok', $my->user_info->tiktok))}}"
                               class="social_main">
                                <img src="{{ v(Theme::url('public/new/images/tiktok.png'))}}" alt="">
                                <span>{{'@'}}{{trim($my->user_info->tiktok,'/')}}</span>
                            </a>
                        </div>
                    @endif
                    @if(!empty($my->user_info->whatsapp))
                        <div class="col-md-6">
                            <a target="_blank" href="https://wa.me/{{$my->user_info->whatsapp}}"
                               class="social_main">
                                <img src="{{ v(Theme::url('public/new/images/whatsapp.png'))}}" alt="">
                                <span>{{trim($my->user_info->whatsapp,'/')}}</span>
                            </a>
                        </div>
                    @endif
                    @if(!empty($my->user_info->facebook))
                        <div class="col-md-6">
                            <a target="_blank" href="https://facebook.com/{{$my->user_info->facebook}}"
                               class="social_main">
                                <img src="{{ v(Theme::url('public/new/images/fb_icon.png'))}}" alt="">
                                <span>{{'@'}}{{trim($my->user_info->facebook,'/')}}</span>
                            </a>
                        </div>
                    @endif
                    @if(!empty($my->user_info->wechat))
                        <div class="col-md-6">
                            <a target="_blank" href="https://web.wechat.com/{{$my->user_info->wechat}}"
                               class="social_main">
                                <img src="{{ v(Theme::url('public/new/images/wechat.png'))}}" alt="">
                                <span>{{trim($my->user_info->wechat,'/')}}</span>
                            </a>
                        </div>
                    @endif
                    @if(!empty($my->user_info->skype))
                        <div class="col-md-6">
                            <a target="_blank" href="https://skype.com/{{$my->user_info->skype}}" class="social_main">
                                <img src="{{ v(Theme::url('public/new/images/skype.png'))}}" alt="">
                                <span>{{'@'}}{{trim($my->user_info->skype,'/')}}</span>
                            </a>
                        </div>
                    @endif
                    @if(!empty($my->user_info->twitter))
                        <div class="col-md-6">
                            <a target="_blank" href="https://twitter.com/{{$my->user_info->twitter}}"
                               class="social_main">
                                <img src="{{ v(Theme::url('public/new/images/twitter.png'))}}" alt="">
                                <span>{{'@'}}{{trim($my->user_info->twitter,'/')}}</span>
                            </a>
                        </div>
                    @endif
                    @if(!empty($my->user_info->tumblr))
                        <div class="col-md-6">
                            <a target="_blank" href="https://tumblr.com/{{$my->user_info->tumblr}}" class="social_main">
                                <img src="{{ v(Theme::url('public/new/images/tumblr.png'))}}" alt="">
                                <span>{{trim($my->user_info->tumblr,'/')}}</span>
                            </a>
                        </div>
                    @endif
                    @if(!empty($my->user_info->twitch))
                        <div class="col-md-6">
                            <a target="_blank" href="https://twitch.tv/{{$my->user_info->twitch}}" class="social_main">
                                <img src="{{ v(Theme::url('public/new/images/twitch.png'))}}" alt="">
                                <span>{{'@'}}{{trim($my->user_info->twitch,'/')}}</span>
                            </a>
                        </div>
                    @endif
                    @if(!empty($my->user_info->pinterest))
                        <div class="col-md-6">
                            <a target="_blank" href="https://pinterest.com/{{$my->user_info->pinterest}}"
                               class="social_main">
                                <img src="{{ v(Theme::url('public/new/images/pinterest.png'))}}" alt="">
                                <span>{{'@'}}{{trim($my->user_info->pinterest,'/')}}</span>
                            </a>
                        </div>
                    @endif
                    @if(!empty($my->user_info->snapchat))
                        <div class="col-md-6">
                            <a target="_blank" href="https://snapchat.com/{{$my->user_info->snapchat}}"
                               class="social_main">
                                <img src="{{ v(Theme::url('public/new/images/snapchat.png'))}}" alt="">
                                <span>{{'@'}}{{trim($my->user_info->snapchat,'/')}}</span>
                            </a>
                        </div>
                    @endif
                    @if(!empty($my->user_info->linkedin))
                        <div class="col-md-6">
                            <a target="_blank" href="https://linkedin.com/in/{{$my->user_info->linkedin}}"
                               class="social_main">
                                <img src="{{ v(Theme::url('public/new/images/linkedin.png'))}}" alt="">
                                <span>{{'@'}}{{trim($my->user_info->linkedin,'/')}}</span>
                            </a>
                        </div>
                    @endif
                    @if(!empty($my->user_info->spotify))
                        <div class="col-md-6">
                            <a target="_blank" href="{{$my->user_info->spotify}}"
                               class="social_main">
                                <img src="{{ v(Theme::url('public/new/images/social_icon.png'))}}" alt="">
                                <span>{{ trans('Spotify') }}</span>
                            </a>
                        </div>
                    @endif

                    @if(!empty($my->user_info->vsco))
                        <div class="col-md-6">
                            <a target="_blank" href="{{$my->user_info->vsco}}"
                               class="social_main">
                                <img src="{{ v(Theme::url('public/new/images/vsco.png'))}}" alt="">
                                <span>{{ trans('VSCO') }}</span>
                            </a>
                        </div>
                    @endif

                    @if(!empty($my->user_info->telegram))
                        <div class="col-md-6">
                            <a target="_blank" href="https://telegram.org/{{$my->user_info->telegram}}"
                               class="social_main">
                                <img src="{{ v(Theme::url('public/new/images/telegram.png'))}}" alt="">
                                <span>{{trim($my->user_info->telegram,'/')}}</span>
                            </a>
                        </div>
                    @endif
                </div>
            </div>
            @php
                $has_bank = 'false';
                $bankinfo = json_decode($my->user_info->bank, true);
            @endphp
            @if(!empty(trim($my->user_info->cash_app)) || !empty(trim($my->user_info->venmo)) || !empty(trim($my->user_info->paypal)) || !empty($bankinfo['title']))
                <div class="payme_links">
                    <h3>{{ trans('storefront::profile.profile.view.pay') }}</h3>
                    <div class="row">
                        @if(!empty($my->user_info->cash_app))
                            <div class="col-md-6">
                                <a href="https://cash.me/{{$my->user_info->cash_app}}" class="social_main">
                                    <i class="fas fa-dollar-sign"></i>
                                    <span><span>{{trans('storefront::account.profile.cash-app')}}</span>{{$my->user_info->cash_app}}</span>
                                </a>
                            </div>
                        @endif
                        @if(!empty($my->user_info->venmo))
                            <div class="col-md-6">
                                <a href="https://venmo.com/{{$my->user_info->venmo}}" class="social_main">
                                    <i class="fas fa-dollar-sign"></i>
                                    <span><span>{{trans('storefront::account.profile.venmo')}}</span>{{$my->user_info->venmo}}</span>
                                </a>
                            </div>
                        @endif
                        @if(!empty($my->user_info->paypal))
                            <div class="col-md-6">
                                <a href="https://paypal.me/{{$my->user_info->paypal}}" class="social_main">
                                    <i class="fas fa-dollar-sign"></i>
                                    <span><span>{{trans('storefront::account.profile.paypal')}}</span>{{$my->user_info->paypal}}</span>
                                </a>
                            </div>
                        @endif
                        @if(!empty($my->user_info->bank))
                            <div class="col-md-6">
                                <a href="javascript:;" data-toggle="copytext" id="title_{{$bankinfo['title']}}" title="{{$bankinfo['title']}} account copied." onclick="copyToClipboard('#copy_{{str_replace(' ', '_', $bankinfo['title'])}}')" class="social_main">
                                    <i class="fas fa-dollar-sign"></i>
                                    <span><span>{{$bankinfo['title']}}</span> <span class="no-font-weight" id="copy_{{str_replace(' ', '_', $bankinfo['title'])}}">{{$bankinfo['bank_ibn']}}</span></span>
                                </a>
                            </div>
                        @endif
                        @if($my->user_info->other_bank != 'null' && $my->user_info->other_bank != '')
                            @php
                                $otherBanks = json_decode($my->user_info->other_bank, false);
                                $bank_titles = $otherBanks->title;
                                $banks = $otherBanks->bank;
                                $countBanks = count($bank_titles);
                            @endphp
                            @for ($i = 0; $i < $countBanks; $i++)
                                <div class="col-md-6">
                                    <a href="javascript:;" data-toggle="copytext" id="title_{{$bank_titles[$i]}}" title="{{$bank_titles[$i]}} account copied." onclick="copyToClipboard('#copy_{{str_replace(' ', '_', $bank_titles[$i])}}')" class="social_main">
                                        <i class="fas fa-dollar-sign"></i>
                                        <span><span>{{$bank_titles[$i]}}</span> <span class="no-font-weight" id="copy_{{str_replace(' ', '_', $bank_titles[$i])}}">{{$banks[$i]}}</span></span>
                                    </a>
                                </div>
                            @endfor
                        @endif
                    </div>
                </div>
            @endif
            @if(!empty($my->user_info->youtube) || !empty($my->user_info->soundcloud) || !empty($my->user_info->vimeo))
                <div class="payme_links">
                    <h3>Media</h3>
                    <div class="row">
                        @if(!empty($my->user_info->youtube))
                            <div class="col-md-6">
                                <a href="https://youtube.com/user/{{$my->user_info->youtube}}" class="social_main">
                                    <img src="{{ v(Theme::url('public/new/images/youtube_icon.png'))}}" alt="">
                                    <span>{{trim($my->user_info->youtube,'/')}}</span>
                                </a>
                            </div>
                        @endif
                        @if(!empty($my->user_info->soundcloud))
                            <div class="col-md-6">
                                <a href="https://soundcloud.com/{{$my->user_info->soundcloud}}" class="social_main">
                                    <img src="{{ v(Theme::url('public/new/images/sound_cloud_icon.png'))}}" alt="">
                                    <span>{{trim($my->user_info->soundcloud,'/')}}</span>
                                </a>
                            </div>
                        @endif
                        @if(!empty($my->user_info->vimeo))
                            <div class="col-md-6">
                                <a href="https://vimeo.com/{{$my->user_info->vimeo}}" class="social_main">
                                    <img src="{{ v(Theme::url('public/new/images/vemeo_icon.png'))}}" alt="">
                                    <span>{{trim($my->user_info->vimeo,'/')}}</span>
                                </a>
                            </div>
                        @endif
                        @php
                            $media_array=[];
                            $media_all=json_decode($my->user_info->other_music);
                            if(!empty($media_all))
                            {
                            $i=0;
                             foreach($media_all->type as $type)
                            {

                                $media_array[$i]['type']=$type;
                                $i++;
                            }
                            $i=0;
                             foreach($media_all->title as $title)
                            {
                                $media_array[$i]['title']=$title;
                                $i++;
                            }
                            $i=0;
                             foreach($media_all->music_link as $music_link)
                            {
                                $media_array[$i]['music_link']=$music_link;
                                $i++;
                            }
                            foreach($media_array as $media){
                        @endphp
                        <div class="col-md-6">
                            <a href="#" class="social_main">
                                @php if($media['type'] == 'Amazon Music'){
                                @endphp
                                <img src="{{ v(Theme::url('public/new/images/amazon_music.png'))}}" alt="">
                                @php } elseif($media['type'] == 'Apple Music'){ @endphp
                                <img src="{{ v(Theme::url('public/new/images/apple_music.png'))}}" alt="">
                                @php } else  { @endphp
                                <img src="{{ v(Theme::url('public/new/images/social_icon.png'))}}" alt="">
                                @php } @endphp
                                <span>@php echo $media['music_link']; @endphp</span>
                            </a>
                        </div>
                        @php
                            }
                            }
                        @endphp
                    </div>
                </div>
            @endif

            @if($my->user_info->favorite_links != 'null' && $my->user_info->favorite_links != '')
                @php
                    $favoriteLinks = json_decode($my->user_info->favorite_links, false);
                    $titles = $favoriteLinks->title;
                    $links = $favoriteLinks->link;
                    $count = count($titles);
                @endphp
                <div class="payme_links">
                    <h3>{{ trans('storefront::profile.profile.view.link') }}</h3>
                    <div class="row">
                        @for ($i = 0; $i < $count; $i++)
                            <div class="col-md-6">
                                <a href="{{$links[$i]}}" class="social_main">
                                    <i class="fas fa-globe"></i>
                                    <span>{{$titles[$i]}}</span>
                                </a>
                            </div>
                        @endfor
                    </div>
                </div>
            @endif
            @if(!empty($my->user_info->street_address_1) || !empty($my->user_info->street_address_2) || !empty($my->user_info->city))

                @php
                    $direction = '';

                    if(!empty($my->user_info->street_address_1)) {
                        $direction .= $my->user_info->street_address_1;
                    } else {
                        $direction .= $my->user_info->street_address_2;
                    }

                    if(!empty($my->user_info->city)) {
                        $direction .=  ', ' . $my->user_info->city;
                    }

                    if(!empty($my->user_info->country)) {
                        $direction .=  ', ' . $my->user_info->country;
                    }

                    $cleanDirection = str_replace(array('#'), '', $direction);
                @endphp

                <section class="payme_links">
                    <h3>{{ trans('storefront::profile.profile.view.locate') }}</h3>
                    <div class="section_inner pt-4 pb-5">
                        <iframe
                            src="https://www.google.com/maps/embed/v1/place?q={{$cleanDirection}}&key=AIzaSyBRWO-J-h_JZpqYSTVt9Q8j96U0BKMNHkY"
                            width="100%" height="350" frameborder="0" style="border:0" allowfullscreen=""></iframe>
                        <br><br>
                        <a target="_blank"
                           href="http://maps.google.com/maps?q={{$direction}}"
                           class="download-btn btn btn-primary btn-lg mt-5 map_direction_btn">{{trans('storefront::account.profile.get-directions')}} </a>
                    </div>
                </section>
            @endif
        </div>
    </div>
    <div class="qrView">
        <i class="far fa-times-circle"></i>
        <div class="profilePic">
            @if(!empty($my->avatar))
                <img clas src="{{($my->avatar!='')?url('/images/users/'.$my->id.'/'.$my->avatar):''}}" alt="">
            @else
                <div class="borderWithInitial">
                    <div class="initial">
                        {{ str_limit($my->first_name, $limit = 1, $end = '').str_limit($my->last_name, $limit = 1, $end = '') }}
                    </div>
                </div>
            @endif
        </div>
        <h2>{{ucfirst($my->first_name)}} {{ucfirst($my->middle_name).' '.ucfirst($my->last_name)}}</h2>
        <h3>Scan this code with your camera.</h3>
        <img class="qr" src="{{ e(getBarCodeImage($my->id,'url')) }}" alt="">
        <a href="{{ e(getBarCodeImage($my->id,'url')) }}" download>Download Image</a>
    </div>
    <!--div class="buy_know_section">
        <div class="container">
            <p>Get Your Slack Card</p>
            <a href="{{URL::to('/products')}}">Buy Now</a>
        </div>
    </div-->
@endsection

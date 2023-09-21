@extends('public.layout')

@section('title', trans('storefront::account.links.my_profile'))

@section('account_breadcrumb')
    <li class="active">{{ trans('storefront::account.links.my_profile') }}</li>
@endsection

@section('content')
    <header class="header profile-header">
        <div class="container">
            <div class="row justify-content-center align-items-center">
                <div class="logo-wrapper">
                    <a class="navbar-brand" href="#">
                        <img src="{{url('/images/logo.png')}}"  alt="">
                    </a>
                </div>
            </div>
        </div>
    </header>
    <div class="container">
        <div class="main profile-body">
            <!-- profile picture -->
            <section class="profile-picture">
                <div class="image-wrapper" style="background: url({{($my->avatar!='')?url('/images/users/'.$my->id.'/'.$my->avatar):''}});">
                    {{($my->avatar=='')?strtoupper($my->first_name[0].$my->last_name[0]):''}}

                </div>
                <div class="separator-img"><img src="{{url('/themes/storefront/public/images/profile/avtar-separator.png')}}"></div>
                <div class="profile-basic-info ">
                    <div class="text-handler text-center">
                        <h2 class="user-title-name">{{ucfirst($my->first_name).' '.ucfirst($my->middle_name).' '.ucfirst($my->last_name)}}</h2>
                        <h3 class="user-position-title">
                            @if(!empty($my->user_info->job_title))
                                {{$my->user_info->job_title}},
                            @endif
                            @if(!empty($my->user_info->company))
                                {{$my->user_info->company}}
                            @endif
                        </h3>
                        <h6 class="text-center">{{$my->user_info->profession}}</h6>
                        <p class="text-center" style="color:#6744db">
                            @if(!empty($my->user_info->city))
                                {{$my->user_info->city}},
                            @endif
                            @if(!empty($my->user_info->state))
                                {{$my->user_info->state}}&nbsp;<span class="dot"></span>&nbsp;
                            @endif
                            {{$my->user_info->country}}
                        </p>
                        <p class="text-center"><strong>{{$my->user_info->about_me}}</strong></p>
                    </div>
                </div>
                <br>
                <div class="download_button d-block text-center mt-4">
                    <a href="{{route('account.profile.generateVcard',$my->username)}}" target="_blank" class="download-btn btn btn-primary btn-lg mr-auto ml-auto"> Add to Contacts&nbsp;&nbsp;<span class="oi oi-data-transfer-download"></span></a>
                </div>
            </section>
            <br>
            <!-- contact section -->
            @if(!empty($my->user_info->phone) ||
            !empty($my->user_info->job_phone) ||
             !empty($my->user_info->fax) ||
             !empty($my->user_info->email) ||
             !empty($my->user_info->website) ||
             !empty($my->user_info->username) ||
             !empty($my->user_info->fb_messenger) ||
             !empty($my->user_info->wechat) ||
             !empty($my->user_info->whatsapp) ||
             !empty($my->user_info->skype) ||
             !empty($my->user_info->telegram))
                <section class="contact_me pt-4 pb-0 text-center">
                    <h1 class="section-title">{{trans('storefront::account.profile.contact-me')}}</h1>
                    <div class="section_inner pt-4 pb-4">
                        <div class="row mb-5 justify-content-md-center">

                            @if(!empty($my->user_info->phone))
                                <div class="col-xs-12 col-sm-4">
                                    <div class="text-wrapper bg-light pt-3 pb-3">
                                        <a href="tel:{{$my->user_info->phone}}" class="anchor_wrapper">
                                            <h6 class="info-text">{{$my->user_info->phone}}</h6>
                                            <p class="info-text-for">
                                                <img src="{{url('/themes/storefront/public/images/profile/mobile.png')}}">Mobile
                                            </p>
                                        </a>
                                    </div>
                                </div>
                            @endif
                            @if(!empty($my->user_info->job_phone))
                                <div class="col-xs-12 col-sm-4">
                                    <div class="text-wrapper bg-light pt-3 pb-3">
                                        <a href="tel:{{$my->user_info->job_phone}}" class="anchor_wrapper">
                                            <h6 class="info-text">{{$my->user_info->job_phone}}</h6>
                                            <p class="info-text-for">
                                                <img src="{{url('/themes/storefront/public/images/profile/phone.png')}}">Work</p>
                                        </a>
                                    </div>
                                </div>
                            @endif
                            @if(!empty($my->user_info->fax))
                                <div class="col-xs-12 col-sm-4">
                                    <div class="text-wrapper bg-light pt-3 pb-3">
                                        <a href="fax:{{$my->user_info->fax}}" class="anchor_wrapper">
                                            <h6 class="info-text">{{$my->user_info->fax}}</h6>
                                            <p class="info-text-for">
                                                <img src="{{url('/themes/storefront/public/images/profile/fax.png')}}">Fax</p>
                                        </a>
                                    </div>
                                </div>
                            @endif
                        </div><!-- /close row -->
                        <div class="row mt-5 mobile-pad-top justify-content-md-center">
                            @if(!empty($my->email))
                                <div class="col-xs-12 col-sm-4">
                                    <div class="text-wrapper bg-light pt-3 pb-3">
                                        <a href="mailto:{{$my->email}}" class="anchor_wrapper">
                                            <h6 class="info-text">{{$my->email}}</h6>
                                            <p class="info-text-for">
                                                <img src="{{url('/themes/storefront/public/images/profile/email.png')}}">Email</p>
                                        </a>
                                    </div>
                                </div>
                            @endif
                            @if(!empty($my->user_info->website))
                                <div class="col-xs-12 col-sm-4">
                                    <div class="text-wrapper bg-light pt-3 pb-3">
                                        <a target="_blank" href="{{add_http($my->user_info->website)}}" class="anchor_wrapper">
                                            <h6 class="info-text">{{remove_http($my->user_info->website)}}</h6>
                                            <p class="info-text-for">
                                                <img src="{{url('/themes/storefront/public/images/profile/website.png')}}">Website</p>
                                        </a>
                                    </div>
                                </div>
                            @endif
                            <div class="col-xs-12 col-sm-4">
                                <div class="text-wrapper bg-light pt-3 pb-3">
                                    <a href="{{route('account.profile.view',$my->username)}}" target="_blank" class="anchor_wrapper">
                                        <h6 class="info-text">{{'@'.$my->username}}</h6>
                                        <p class="info-text-for">
                                            <img src="{{url('/themes/storefront/public/images/profile/ideal.bio.png')}}">IDEAL BIO</p>
                                    </a>
                                </div>
                            </div>
                        </div><!-- /close row -->
                        <div class="row mt-5 mobile-pad-top justify-content-md-center">

                            @if(!empty($my->user_info->fb_messenger))
                                <div class="col-xs-12 col-sm-4">
                                    <div class="text-wrapper bg-light pt-3 pb-3">
                                        <a target="_blank" href="https://www.m.me/{{$my->user_info->fb_messenger}}" class="anchor_wrapper">
                                            <h6 class="info-text">{{$my->user_info->fb_messenger}}</h6>
                                            <p class="info-text-for">
                                                <img src="{{url('/themes/storefront/public/images/profile/facebook_messenger.png')}}">Messenger</p>
                                        </a>
                                    </div>
                                </div>
                            @endif
                            @if(!empty($my->user_info->wechat))
                                <div class="col-xs-12 col-sm-4">
                                    <div class="text-wrapper bg-light pt-3 pb-3">
                                        <a href="javascript:void(0)" class="anchor_wrapper">
                                            <h6 class="info-text">{{$my->user_info->wechat}}</h6>
                                            <p class="info-text-for">
                                                <img src="{{url('/themes/storefront/public/images/profile/we_chat.png')}}">WeChat</p>
                                        </a>
                                    </div>
                                </div>
                            @endif
                            @if(!empty($my->user_info->whatsapp))
                                <div class="col-xs-12 col-sm-4">
                                    <div class="text-wrapper bg-light pt-3 pb-3">
                                        <a href="https://wa.me/{{$my->user_info->whatsapp}}" class="anchor_wrapper">
                                            <h6 class="info-text">{{$my->user_info->whatsapp}}</h6>
                                            <p class="info-text-for">
                                                <img src="{{url('/themes/storefront/public/images/profile/whatsapp.png')}}">WhatsApp</p>
                                        </a>
                                    </div>
                                </div>
                            @endif
                        </div><!-- /close row -->
                        <div class="row mt-5 mobile-pad-top justify-content-md-center">
                            @if(!empty($my->user_info->skype))
                                <div class="col-xs-12 col-sm-4">
                                    <div class="text-wrapper bg-light pt-3 pb-3">
                                        <a href="skype:{{$my->user_info->skype}}?call" class="anchor_wrapper">
                                            <h6 class="info-text">{{$my->user_info->skype}}</h6>
                                            <p class="info-text-for">
                                                <img src="{{url('/themes/storefront/public/images/profile/skype.png')}}">Skype</p>
                                        </a>
                                    </div>
                                </div>
                            @endif
                            @if(!empty($my->user_info->telegram))
                                <div class="col-xs-12 col-sm-4">
                                    <div class="text-wrapper bg-light pt-3 pb-3">
                                        <a href="https://t.me/{{$my->user_info->telegram}}" class="anchor_wrapper">
                                            <h6 class="info-text">{{$my->user_info->telegram}}</h6>
                                            <p class="info-text-for">
                                                <img src="{{url('/themes/storefront/public/images/profile/telegram.png')}}">Telegram</p>
                                        </a>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </section>
            @endif
        <!-- connect with me -->
            @if(!empty($my->user_info->facebook) ||
            !empty($my->user_info->instagram) ||
            !empty($my->user_info->pinterest) ||

            !empty($my->user_info->twitter) ||
            !empty($my->user_info->snapchat) ||
            !empty($my->user_info->linkedin) ||
            !empty($my->user_info->facebook_page) ||
            !empty($my->user_info->tumblr))
                <section class="connect_with_me pt-0 pb-4 text-center">
                    <h1 class="section-title">{{trans('storefront::account.profile.connect-with-me')}}</h1>

                    <div class="section_inner pt-4 pb-0">
                        <div class="row mb-5 justify-content-md-center">
                            @if(!empty($my->user_info->facebook))
                                <div class="col-xs-12 col-sm-4">
                                    <div class="text-wrapper bg-light pt-3 pb-3">
                                        <a href="{{$my->user_info->facebook}}" target="_blank" class="anchor_wrapper">
                                            <h6 class="info-text">{{'@'.$my->user_info->facebook}}</h6>
                                            <p class="info-text-for">
                                                <img src="{{url('/themes/storefront/public/images/profile/facebook.png')}}">{{trans('storefront::account.profile.Facebook')}}                    </p>
                                        </a>
                                    </div>
                                </div>
                            @endif
                            @if(!empty($my->user_info->instagram))
                                <div class="col-xs-12 col-sm-4">
                                    <div class="text-wrapper bg-light pt-3 pb-3">
                                        <a href="{{$my->user_info->instagram}}" target="_blank" class="anchor_wrapper">
                                            <h6 class="info-text">{{'@'.$my->user_info->instagram}}</h6>
                                            <p class="info-text-for">
                                                <img src="{{url('/themes/storefront/public/images/profile/instagram.png')}}">Instagram                    </p>
                                        </a>
                                    </div>
                                </div>
                            @endif
                            @if(!empty($my->user_info->pinterest))
                                <div class="col-xs-12 col-sm-4">
                                    <div class="text-wrapper bg-light pt-3 pb-3">
                                        <a href="{{$my->user_info->pinterest}}" target="_blank" class="anchor_wrapper">
                                            <h6 class="info-text">{{'@'.$my->user_info->pinterest}}</h6>
                                            <p class="info-text-for">
                                                <img src="{{url('/themes/storefront/public/images/profile/pinterest.png')}}">Pinterest                    </p>
                                        </a>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div><!-- /section_inner -->
                    <div class="row mt-5 mobile-pad-top justify-content-md-center">
                        @if(!empty($my->user_info->twitter))
                            <div class="col-xs-12 col-sm-4">
                                <div class="text-wrapper bg-light pt-3 pb-3">
                                    <a href="{{$my->user_info->twitter}}" class="anchor_wrapper">
                                        <h6 class="info-text">{{'@'.$my->user_info->twitter}}</h6>
                                        <p class="info-text-for">
                                            <img src="{{url('/themes/storefront/public/images/profile/twitter.png')}}">{{trans('storefront::account.profile.twitter')}}                    </p>
                                    </a>
                                </div>
                            </div>
                        @endif
                        @if(!empty($my->user_info->snapchat))
                            <div class="col-xs-12 col-sm-4">
                                <div class="text-wrapper bg-light pt-3 pb-3">
                                    <a href="https://snapchat.com/add/{{$my->user_info->snapchat}}" class="anchor_wrapper">
                                        <h6 class="info-text">{{'@'.$my->user_info->snapchat}}</h6>
                                        <p class="info-text-for">
                                            <img src="{{url('/themes/storefront/public/images/profile/snapchat.png')}}">{{trans('storefront::account.profile.snapchat')}}                    </p>
                                    </a>
                                </div>
                            </div>
                        @endif
                        @if(!empty($my->user_info->linkedin))
                            <div class="col-xs-12 col-sm-4">
                                <div class="text-wrapper bg-light pt-3 pb-3">
                                    <a href="https://linkedin.com/in/{{$my->user_info->linkedin}}" target="_blank" class="anchor_wrapper">
                                        <h6 class="info-text">{{'@'.$my->user_info->linkedin}}</h6>
                                        <p class="info-text-for">
                                            <img src="{{url('/themes/storefront/public/images/profile/linkedin.png')}}">{{trans('storefront::account.profile.linkedin')}}                    </p>
                                    </a>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="row mt-5 mobile-pad-top justify-content-md-center">
                        @if(!empty($my->user_info->facebook_page))
                            <div class="col-xs-12 col-sm-4">
                                <div class="text-wrapper bg-light pt-3 pb-3">
                                    <a href="{{$my->user_info->facebook_page}}" class="anchor_wrapper">
                                        <h6 class="info-text">{{'@'.$my->user_info->facebook_page}}</h6>
                                        <p class="info-text-for">
                                            <img src="{{url('/themes/storefront/public/images/profile/fb_page.png')}}">{{trans('storefront::account.profile.facebook-page')}}</p>
                                    </a>
                                </div>
                            </div>
                        @endif
                        @if(!empty($my->user_info->tumblr))
                            <div class="col-xs-12 col-sm-4">
                                <div class="text-wrapper bg-light pt-3 pb-3">
                                    <a href="{{$my->user_info->tumblr}}" class="anchor_wrapper">
                                        <h6 class="info-text">{{'@'.$my->user_info->tumblr}}</h6>
                                        <p class="info-text-for">
                                            <img src="{{url('/themes/storefront/public/images/profile/tumblr.png')}}">{{trans('storefront::account.profile.tumblr')}}                    </p>
                                    </a>
                                </div>
                            </div>
                        @endif
                    </div>
                </section>
            @endif
        <!-- map -->
            @if(!empty($my->user_info->street_address_1) || !empty($my->user_info->street_address_2) || !empty($my->user_info->city))
                <section class="map pb-4 pt-2 text-center">
                    <h1 class="section-title">{{trans('storefront::account.profile.locate-me')}}</h1>
                    <div class="section_inner pt-4">
                        <iframe src="https://www.google.com/maps/embed/v1/place?q={{$my->user_info->street_address_1}},{{$my->user_info->street_address_2}}, {{$my->user_info->city}}, {{$my->user_info->state}},{{$my->user_info->zip}}, {{$my->user_info->country}}&key=AIzaSyBRWO-J-h_JZpqYSTVt9Q8j96U0BKMNHkY" width="100%" height="350" frameborder="0" style="border:0" allowfullscreen=""></iframe>
                        <br><br>
                        <a target="_blank" href="http://maps.google.com/maps?q={{$my->user_info->street_address_1}},{{$my->user_info->street_address_2}}, {{$my->user_info->city}}, {{$my->user_info->state}},{{$my->user_info->zip}}, {{$my->user_info->country}}" class="download-btn btn btn-primary btn-lg mt-5">{{trans('storefront::account.profile.get-directions')}} <img src="{{url('/themes/storefront/public/images/profile/direction-icon.png')}}" width="30"></a>
                    </div>
                </section>
            @endif
        <!-- payme -->
            @if(!empty($my->user_info->cash_app) ||
                !empty($my->user_info->venmo) ||
                !empty($my->user_info->paypal) ||
                !empty($my->user_info->bank))
                <section class="pay_me  text-center">
                    <h1 class="section-title">PAY ME</h1>
                    <div class="section_inner pt-4 pb-0">
                        <!-- contact numbers -->
                        <div class="row mb-5 justify-content-md-center">
                            @if(!empty($my->user_info->cash_app))
                                <div class="col-xs-12 col-sm-4">
                                    <div class="text-wrapper bg-light pt-3 pb-3">
                                        <a href="https://cash.me/{{$my->user_info->cash_app}}" class="anchor_wrapper">
                                            <h6 class="info-text">${{$my->user_info->cash_app}}</h6>
                                            <p class="info-text-for">
                                                <img src="{{url('/themes/storefront/public/images/profile/cashapp.png')}}">{{trans('storefront::account.profile.cash-app')}}
                                            </p>
                                        </a>
                                    </div>
                                </div>
                            @endif
                            @if(!empty($my->user_info->venmo))
                                <div class="col-xs-12 col-sm-4">
                                    <div class="text-wrapper bg-light pt-3 pb-3">
                                        <a href="https://venmo.com/{{$my->user_info->venmo}}" class="anchor_wrapper">
                                            <h6 class="info-text ">{{'@'.$my->user_info->venmo}}</h6>
                                            <p class="info-text-for">
                                                <img src="{{url('/themes/storefront/public/images/profile/venmo.png')}}">{{trans('storefront::account.profile.venmo')}}
                                            </p>
                                        </a>
                                    </div>
                                </div>
                            @endif
                            @if(!empty($my->user_info->paypal))
                                <div class="col-xs-12 col-sm-4">
                                    <div class="text-wrapper bg-light pt-3 pb-3">
                                        <a href="https://paypal.me/{{$my->user_info->paypal}}" class="anchor_wrapper">
                                            <h6 class="info-text">{{'@'.$my->user_info->paypal}}</h6>
                                            <p class="info-text-for"><img src="{{url('/themes/storefront/public/images/profile/paypal.png')}}">{{trans('storefront::account.profile.paypal')}}</p>
                                        </a>
                                    </div>
                                </div>
                            @endif
                        </div>

                        <div class="row mb-5 justify-content-md-center">
                            @if(!empty($my->user_info->bank))
                                <div class="col-xs-12 col-sm-4">
                                    <div class="text-wrapper bg-light pt-3 pb-3">
                                        <a href="{{$my->user_info->bank}}" class="anchor_wrapper">
                                            <h6 class="info-text">{{'@'.$my->user_info->bank}}</h6>
                                            <p class="info-text-for">
                                            <!--											<img src="{{url('/themes/storefront/public/images/profile/bank.png')}}">-->
                                                {{trans('storefront::account.profile.bank-account')}}</p>
                                        </a>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </section>
            @endif
        <!-- my fav links -->
            @php
                $favorite_links = json_decode($my->user_info->favorite_links,1);
                $title = isset($favorite_links['title'])?$favorite_links['title']:[];
                $link = isset($favorite_links['link'])?$favorite_links['link']:[];
            @endphp
            @if(!empty($favorite_links))
                <section class="connect_with_me pt-0 pb-3 text-center ">
                    <h1 class="section-title">{{trans('storefront::account.profile.my-favorite-links')}}</h1>
                    <div class="section_inner pt-4 pb-3">
                        <!-- contact numbers -->
                        <div class="row mb-5 justify-content-md-center">
                            @if(!empty($favorite_links))
                                @foreach($title as $key=>$title_value)
                                    <div class="col-xs-12 col-sm-4">
                                        <div class="text-wrapper bg-light pt-3 pb-3">
                                            <a target="_blank" href="{{add_http($link[$key])}}" class="anchor_wrapper">
                                                <h5 class="favlink">Favroit link</h5>
                                                <p class="favlink-for"><img src="{{url('/themes/storefront/public/images/profile/website.png')}}">
                                                    {{$title_value}}</p>
                                            </a>
                                        </div><!-- /text-wrapper -->
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </section>
            @endif
        <!-- my videos -->
            @if(!empty($my->user_info->youtube) ||
             !empty($my->user_info->vimeo))
                <section class="connect_with_me pt-0 pb-3 text-center ">
                    <h1 class="section-title">{{trans('storefront::account.profile.my-videos')}}</h1>
                    <div class="section_inner pt-4 pb-3">
                        <!-- contact numbers -->
                        <div class="row mb-5 justify-content-md-center">
                            @if(!empty($my->user_info->youtube))
                                <div class="col-xs-12 col-sm-4">
                                    <div class="text-wrapper bg-light pt-3 pb-3">
                                        <a target="_blank" href="https://youtube.com/{{$my->user_info->youtube}}" class="anchor_wrapper">
                                            <h5 class="favlink">{{'@'.$my->user_info->youtube}}</h5>
                                            <p class="favlink-for"><img src="{{url('/themes/storefront/public/images/profile/youtube.png')}}">{{trans('storefront::account.profile.youtube')}}</p>
                                        </a>
                                    </div><!-- /text-wrapper -->
                                </div>
                            @endif
                            @if(!empty($my->user_info->vimeo))
                                <div class="col-xs-12 col-sm-4">
                                    <div class="text-wrapper bg-light pt-3 pb-3">
                                        <a target="_blank" href="https://vimeo.com/{{$my->user_info->vimeo}}" class="anchor_wrapper">
                                            <h5 class="favlink">{{'@'.$my->user_info->vimeo}}</h5>
                                            <p class="favlink-for"><img src="{{url('/themes/storefront/public/images/profile/vimeo.png')}}">{{trans('storefront::account.profile.vimeo')}}</p>
                                        </a>
                                    </div><!-- /text-wrapper -->
                                </div>
                            @endif
                        </div>
                    </div>
                </section>
            @endif
        <!-- my misucs -->
            @php
                $other_music = json_decode($my->user_info->other_music,1);
                $type = isset($other_music['type'])?$other_music['type']:[];
                $title = isset($other_music['title'])?$other_music['title']:[];
                $music_link = isset($other_music['music_link'])?$other_music['music_link']:[];
            @endphp
            @if(!empty($my->user_info->soundcloud) ||
                !empty($my->user_info->revebnation) ||
                !empty($other_music)
                )
                <section class="connect_with_me pt-0 pb-3 text-center ">
                    <h1 class="section-title">{{trans('storefront::account.profile.my-music')}}</h1>
                    <div class="section_inner pt-4 pb-3">
                        <!-- contact numbers -->
                        <div class="row mb-5 justify-content-md-center">
                            @if($my->user_info->soundcloud)
                                <div class="col-xs-12 col-sm-4 mt-5">
                                    <div class="text-wrapper bg-light pt-3 pb-3">
                                        <a target="_blank" href="https://soundcloud.com/{{$my->user_info->soundcloud}}" class="anchor_wrapper">
                                            <h5 class="favlink">{{'@'.$my->user_info->soundcloud}}</h5>
                                            <p class="favlink-for"><img src="{{url('/themes/storefront/public/images/profile/soundcloud.png')}}">{{trans('storefront::account.profile.soundcloud')}}</p>
                                        </a>
                                    </div><!-- /text-wrapper -->
                                </div>
                            @endif
                            @if($my->user_info->revebnation)
                                <div class="col-xs-12 col-sm-4 mt-5">
                                    <div class="text-wrapper bg-light pt-3 pb-3">
                                        <a target="_blank" href="https://reverbnation.com/{{$my->user_info->revebnation}}" class="anchor_wrapper">
                                            <h5 class="favlink">{{'@'.$my->user_info->revebnation}}</h5>
                                            <p class="favlink-for"><img src="{{url('/themes/storefront/public/images/profile/reverbnation.png')}}">{{trans('storefront::account.profile.reverbnation')}}</p>
                                        </a>
                                    </div><!-- /text-wrapper -->
                                </div>
                            @endif


                            @if(!empty($other_music))
                                @foreach($type as $key=>$type_value)
                                    <div class="col-xs-12 col-sm-4 mt-5">
                                        <div class="text-wrapper bg-light pt-3 pb-3">
                                            <a target="_blank" href="{{add_http($music_link[$key])}}" class="anchor_wrapper">
                                                <h5 class="favlink">{{$title[$key]}}</h5>
                                                <p class="favlink-for">{{$type_value}}</p>
                                            </a>
                                        </div><!-- /text-wrapper -->
                                    </div>
                                @endforeach
                            @endif
                        </div><!-- /close row  and open new -->
                        <div class="row mt-5 mobile-pad-top justify-content-md-center">
                        </div>
                    </div>
                </section>
            @endif
        </div><!-- /main -->
        <br>
        <div class="clearfix"></div>
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
        <!-- view counter -->
        <br>
        <br>
    </div>
@endsection 
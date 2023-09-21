@extends('public.layout')

@section('title', setting('store_tagline'))

@section('content')
    @unless (is_null($slider))
        @if (storefront_layout() === 'default')
            <div class="col-lg-12">
                <div class="row"> @include('public.home.sections.slider') </div>
            </div>
            <div class="clearfix"></div>
        @elseif (storefront_layout() === 'slider_with_banners')
            <div class="row">
                <div class="col-md-12"> @include('public.home.sections.slider') </div>
            </div>
        @endif
    @endunless
    <section class="section-callouts" id="scrol_to">
        <div class="container">
            <h2 class="section-callouts__heading">{{trans('storefront::storefront.home.the-smartest-business-card-in-the-world')}}</h2>
            <div class="section-callouts__callouts">
                <div class="section-callouts__callout">
                    <div class="section-callouts__callout-image"> <img data-no-retina="" src="{{url('/images/home_icons/instanty_transfer_icon.png')}}" alt=""></div>
                    <h4>{{trans('storefront::storefront.home.instantly-transfer-your-contact-details-to-compatible-smartphones')}}.<sup>1</sup></h4>
                    <!-- <h3 class="section-callouts__subheading"></h3> --></div>
                <div class="section-callouts__callout">
                    <div class="section-callouts__callout-image"> <img data-no-retina="" src="{{url('/images/home_icons/cards_icons.png')}}"></div>
                    <h4>{{trans('storefront::storefront.home.made-of-durable-plastic-or-metal')}}.</h4>
                    <!--  <h3 class="section-callouts__subheading">1.75% Annual Percentage Yield.^</h3> --></div>
                <div class="section-callouts__callout">
                    <div class="section-callouts__callout-image"> <img data-no-retina="" src="{{url('/images/home_icons/no_special_app.png')}}" alt=""></div>
                    <h4>{{trans('storefront::storefront.home.no-special-apps-required-on-compatible-smartphones')}}.<sup>2</sup></h4>
                    <!-- <h3 class="section-callouts__subheading">Apply in just a few taps.^^</h3> --></div>
                <div class="section-callouts__callout">
                    <div class="section-callouts__callout-image"> <img data-no-retina="" src="{{url('/images/home_icons/earth_globe.png')}}" alt=""></div>
                    <h4>{{trans('storefront::storefront.home.update-your-contact-details-in-real-time')}}.</h4>
                    <!-- <h3 class="section-callouts__subheading">No banking fees of any kind.</h3> --></div>
            </div>
        </div>
    </section>
    <section class="section-callouts secondary">
        <div class="container">
            <h2 class="section-callouts__heading">{{trans('storefront::storefront.home.a-great-networking-tool')}}</h2>
            <div class="section-callouts__callouts">
                <div class="section-callouts__callout">
                    <div class="section-callouts__callout-image"> <img data-no-retina="" src="{{url('/images/home_icons/contact.png')}}" alt=""></div>
                    <h4>{{trans('storefront::storefront.home.all-your-contact-details-in-one-place')}}.</h4>
                    <!-- <h3 class="section-callouts__subheading">All your accounts in one place.</h3> --></div>
                <div class="section-callouts__callout">
                    <div class="section-callouts__callout-image"> <img data-no-retina="" src="{{url('/images/home_icons/music_icon.png')}}" alt=""></div>
                    <h4>{{trans('storefront::storefront.home.share-promote-your-music-videos')}}.</h4>
                    <!-- <h3 class="section-callouts__subheading">Know your leftover money.</h3> --></div>
                <div class="section-callouts__callout">
                    <div class="section-callouts__callout-image"> <img data-no-retina="" src="{{url('/images/home_icons/promote_icon.png')}}" alt=""></div>
                    <h4>{{trans('storefront::storefront.home.promote-your-app')}}.</h4>
                    <!-- <h3 class="section-callouts__subheading">Set goals &amp; track your spending.</h3> --></div>
                <div class="section-callouts__callout">
                    <div class="section-callouts__callout-image"> <img data-no-retina="" src="{{url('/images/home_icons/connection.png')}}" alt=""></div>
                    <h4>{{trans('storefront::storefront.home.grow-your-network')}}.</h4>
                    <!-- <h3 class="section-callouts__subheading">Personalized recommendations.</h3> --></div>
            </div>
        </div>
    </section>
    <section class="section-image-text section-image-text--left">
        <h2 class="section-image-text__heading">{{trans('storefront::storefront.home.traditional-networking-for-the-digital-lifestyle')}}.</h2>
        <div class="container">
            <div class="innerMain">
                <div class="section-image-text__media-block section-image-text__media-block--image"> <img data-no-retina="" src="{{url('/images/home_image/share_everything.png')}}" alt=""></div>
                <div class="section-image-text__text-block">
                    <h2 style="text-align: center;">{{trans('storefront::storefront.home.share-everything')}}</h2>
                    <div class="checklist">
                        <ul>
                            <li class="p1">{{trans('storefront::storefront.home.profile-picture-or-company-logo')}}</li>
                            <li></li>
                            <li> {{trans('storefront::storefront.home.contact-details')}} </li>
                            <li></li>
                            <li> {{trans('storefront::storefront.home.social-media-connections')}} </li>
                            <li></li>
                            <li> {{trans('storefront::storefront.home.instant-messaging')}} </li>
                            <li> {{trans('storefront::storefront.home.payment-details')}} </li>
                            <li></li>
                            <li> {{trans('storefront::storefront.home.your-location')}} </li>
                            <li></li>
                            <li> {{trans('storefront::storefront.home.music-playlist')}} </li>
                            <li></li>
                            <li> {{trans('storefront::storefront.home.video-playlist')}} </li>
                            <li></li>
                            <li> {{trans('storefront::storefront.home.external-links-much-more')}} </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="section-image-text section-image-text--right">
        <div class="container">
            <div class="innerMain">
                <div class="section-image-text__media-block section-image-text__media-block--image"> <img data-no-retina="" src="{{url('/images/home_image/slackcards.png')}}" alt=""></div>
                <div class="section-image-text__text-block">
                    <h2 style="text-align: center;">SLACK.CARDS</h2>
                    <div class="checklist">
                        <ul>
                            <li class="p1">{{trans('storefront::storefront.home.update-your-bio-in-real-time')}}.</li>
                            <li></li>
                            <li> {{trans('storefront::storefront.home.share-everything-with-your-prospects')}}. </li>
                            <li></li>
                            <li> {{trans('storefront::storefront.home.unlimited-details-links')}}. </li>
                            <li> {{trans('storefront::storefront.home.keeps-your-friends-associates-updated-with-your-most-current-up-to-date-information')}}. </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="section-image-text section-image-text--left">
        <div class="container">
            <div class="innerMain">
                <div class="section-image-text__media-block section-image-text__media-block--image"> <img data-no-retina="" src="{{url('/images/home_image/instant_transfer.png')}}" alt=""></div>
                <div class="section-image-text__text-block">
                    <h2 style="text-align: center;">{{trans('storefront::storefront.home.instant-transfers')}}</h2>
                    <div class="checklist">
                        <ul>
                            <li class="p1">{{trans('storefront::storefront.home.instantly-transfer-your-contact-details-to-compatible-android-smartphones')}}.</li>
                            <li></li>
                            <li> {{trans('storefront::storefront.home.no-special-apps-required')}}.<sup>2</sup> </li>
                            <li></li>
                            <li> {{trans('storefront::storefront.home.no-network-or-data-connection-required')}}. </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="section-image-text section-image-text--right">
        <div class="container">
            <div class="innerMain">
                <div class="section-image-text__media-block section-image-text__media-block--image"> <img data-no-retina="" src="{{url('/images/home_image/real_time_update.png')}}" alt=""></div>
                <div class="section-image-text__text-block">
                    <h2 style="text-align: center;">{{trans('storefront::storefront.home.real-time-updates')}}</h2>
                    <div class="checklist">
                        <ul>
                            <li class="p1">{{trans('storefront::storefront.home.with-the-you-can-easily-change-any-of-your-contact-information')}}.</li>
                            <li> {{trans('storefront::storefront.home.your-friends-associates-can-easily-access-your-most-current-up-to-date-information-by-revisiting-your-saved-in-their-smartphones')}}. </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="section-image-text section-image-text--left">
        <div class="container">
            <div class="innerMain">
                <div class="section-image-text__media-block section-image-text__media-block--image"> <img data-no-retina="" src="{{url('/images/home_image/employee_id.png')}}" alt=""></div>
                <div class="section-image-text__text-block">
                    <h2 style="text-align: center;">{{trans('storefront::storefront.home.employee-id-networking-tool')}}</h2>
                    <div class="checklist">
                        <ul>
                            <li class="p1">{{trans('storefront::storefront.home.use-the-ideal-card-as-employee-id-cards-for-all-your-employees')}}.</li>
                            <li>{{trans('storefront::storefront.home.your-employees-can-use-their-employee-ideal-id-cards-to-swiftly-network-with-prospects')}}.</li>
                            <li>{{trans('storefront::storefront.home.manage-update-your-Employee-in-real-time')}}.</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="section-image-text section-image-text--right">
        <div class="container">
            <div class="innerMain">
                <div class="section-image-text__media-block section-image-text__media-block--image"> <img data-no-retina="" src="{{url('/images/home_image/emergency_bio.png')}}" alt=""></div>
                <div class="section-image-text__text-block">
                    <h2 style="text-align: center;">EMERGENCY.BIO</h2>
                    <div class="checklist">
                        <ul>
                            <li class="p1">{{trans('storefront::storefront.home.link-the-ideal-card-with-your-profile-in-case-of-emergencies')}}.</li>
                            <li> {{trans('storefront::storefront.home.keep-in-your-wallet-and-carry-it-with-you-everywhere-you-go')}}. </li>
                            <li> {{trans('storefront::storefront.home.manage-and-update-your-vital-emergency-information-medications-allergies-and-much-more-with-your')}} </li>
                            <li>{{trans('storefront::storefront.home.keep-all-your-information-private-with-optional-password-protection')}}.</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="section-image-text section-image-text--left">
        <div class="container">
            <div class="innerMain">
                <div class="section-image-text__media-block section-image-text__media-block--image"> <img data-no-retina="" src="{{url('/images/home_image/support.png')}}" alt=""></div>
                <div class="section-image-text__text-block">
                    <h2 style="text-align: center;">{{trans('storefront::storefront.home.support')}}</h2>
                    <h3 style="text-align: center;">{{trans('storefront::storefront.home.need-help-you-can-reach-us-in-several-ways!')}}</h3>
                    <div class="support-chat"> <a href="javascript:void(0);" class="lchat"><img src="{{url('/images/livechat.png')}}" class="mb-2"></a> </div>
                    <div class="checklist">
                        <ul>
                            <li class="p1">{{trans('storefront::storefront.home.visit-our-help-center-to-find-answers-to-frequently-asked-questions')}}.</li>
                            <li>{{trans('storefront::storefront.home.email-us-at')}} sales@slack.cards.com</li>
                            <li>{{trans('storefront::storefront.home.call-us-at')}} +1 (829) 305-5154</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section style="text-align: center; background: rgba(0,0,0,.04)" class="sectionLast">
        <section class="section-callouts">
            <div class="container">
                <h2 class="section-callouts__heading">{{trans('storefront::storefront.home.get-started')}}</h2>
                <div class="section-callouts__callouts">
                    <div class="section-callouts__callout col-6">
                        <div class="section-callouts__callout-image"> <img data-no-retina="" src="{{url('/images/home_icons/select_card.png')}}"> </div>
                        <h4>{{trans('storefront::storefront.home.select-your-card')}}</h4>
                        <p class="short-desc">{{trans('storefront::storefront.home.choose-from-one-of-our-standard-models')}}.</p>
                    </div>
                    <div class="section-callouts__callout col-6">
                        <div class="section-callouts__callout-image"> <img data-no-retina="" src="{{url('/images/home_icons/transfer_method.png')}}"> </div>
                        <h4>{{trans('storefront::storefront.home.choose-your-transfer-method')}}</h4>
                        <p class="short-desc">{{trans('storefront::storefront.home.the-instant-data-transfer-option-is-the-quickest-transfer-method')}}. </p>
                    </div>
                </div>
                <div class="section-callouts__callouts">
                    <div class="section-callouts__callout col-6 mr-auto">
                        <div class="section-callouts__callout-image"> <img data-no-retina="" src="{{url('/images/home_icons/provide_contact_details.png')}}" alt=""> </div>
                        <h4>{{trans('storefront::storefront.home.provide-your-contact-details')}}</h4>
                        <p class="short-desc">{{trans('storefront::storefront.home.create-an-profile-update-your-contact-details-anytime-you-want-or-provide-us-with-your-instant-data-transfer-contact-details')}}.</p>
                    </div>
                </div>
                <div class="section-callouts__callouts">
                    <div class="section-callouts__callout col-6">
                        <div class="section-callouts__callout-image"> <img data-no-retina="" src="{{url('/images/home_icons/tap_away.png')}}" alt=""> </div>
                        <h4>{{trans('storefront::storefront.home.tap-away-or-hand-them-out')}}</h4>
                        <p class="short-desc">{{trans('storefront::storefront.home.on-iphones-tap-the-front-or-back-of-the-phone-near-the-ear-piece-receiver-and-on-android-smartphones-tap-the-back of-the-phone-either-above-or-below-the-camera')}}.</p>
                    </div>
                    <div class="section-callouts__callout col-6">
                        <div class="section-callouts__callout-image"> <img data-no-retina="" src="{{url('/images/home_icons/manage_profile.png')}}" alt=""> </div>
                        <h4>{{trans('storefront::storefront.home.manage-your-profile')}}</h4>
                        <p class="short-desc">{{trans('storefront::storefront.home.sign-in-to-your-profile-to-manage-your-details-you-can-edit-and-update-all-your-details-in-real-time-with-your')}}.</p>
                    </div>
                </div>
            </div>
            <div class="desktop-join-iphone"> <a class="track-cta animated-cta-button" href="{{url('products')}}">{{trans('storefront::storefront.home.get-started')}}</a></div>
        </section>
    </section>
    <link rel="stylesheet" href="{{ v(Theme::url('public/css/owl.carousel.min.css'))}}">
    <link rel="stylesheet" href="{{ v(Theme::url('public/css/owl.theme.default.min.css'))}}">

    @if(isset($sliderTestimonial) && !empty($sliderTestimonial))
    <section class="section_testimonials hide-mobile">
        <div class="section_testimonials_container">

            <div class="section_testimonial_block">
                <div class="owl-carousel owl-theme owl-loaded owl-drag">



                    @foreach ($sliderTestimonial->slides as $slide)
                        <div>
                            <div class="testimonial_user" style="background: url({{ $slide->file->path }})"></div>
                        </div>
                    @endforeach




                    {{--<div>
                        <div class="testimonial_user" style="background: url(https://www.theidealcard.com/assets/themes/default/images/testimonial_2.png)"></div>

                    </div>
                    <div >
                        <div class="testimonial_user" style="background: url(https://www.theidealcard.com/assets/themes/default/images/testimonial_3.png)"></div>

                    </div>
                    <div >
                        <div class="testimonial_user" style="background: url(https://www.theidealcard.com/assets/themes/default/images/testimonial_4.png)"></div>

                    </div>
                    <div >
                        <div class="testimonial_user" style="background: url(https://www.theidealcard.com/assets/themes/default/images/testimonial_5.png)"></div>

                    </div>--}}
                </div>
            </div>
        </div>
    </section>
    @endif
@endsection 
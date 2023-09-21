@extends('public.layout')

@section('title', setting('store_tagline'))

@section('content')
    <div class="banner_area smart_busines_baner">
        <div class="container">
            <div class="row">
                <div class="col-md-6 wow bounceInLeft" data-wow-duration="1.5s" data-wow-delay="0.2s">
                    <h1>{{ trans('storefront::home.title') }}<br/>{{ trans('storefront::home.title_second') }}
                        <br/><span>{{ trans('storefront::home.title3') }} </span></h1>
                    <p class="subTitle">{{ trans('storefront::home.subtitle') }}</p>
                    <a class="cta" href="{{url('/products')}}">{{ trans('storefront::home.cta') }}</a>
                </div>
                <div class="col-md-6">
                    {{--                    <img src="{{ v(Theme::url('public/new/images/banner_business_icon.png'))}}" alt="">--}}
                    <div class="swiper-container">
                        <!-- Additional required wrapper -->
                        <div class="swiper-wrapper">
                            <!-- Slides -->
                            <div class="swiper-slide"><img
                                    src="{{ v(Theme::url('public/new/images/product/product1.png'))}}" alt=""></div>
                            <div class="swiper-slide"><img
                                    src="{{ v(Theme::url('public/new/images/product/product4.png'))}}" alt=""></div>
                            <div class="swiper-slide"><img
                                    src="{{ v(Theme::url('public/new/images/product/product2.png'))}}" alt=""></div>
                            {{--                            <div class="swiper-slide"><img src="{{ v(Theme::url('public/new/images/product/product3.png'))}}" alt=""></div>--}}
                        </div>
                        <!-- If we need pagination -->
                        <div class="swiper-pagination"></div>
                    </div>
                </div>
                <div class="followUs"><p>{{ trans('storefront::home.follow') }}</p>
                    <ul>
                        <li><a href="https://www.instagram.com/slackcards/" target="_blank">IG</a></li>
{{--                        <li><a href="https://www.facebook.com/Slack-Cards-101472084829788/" target="_blank">FB</a></li>--}}
{{--                        <li><a href="https://twitter.com/slackcards1" target="_blank">TW</a></li>--}}
{{--                        <li><a href="https://www.tiktok.com/@slackcards/" target="_blank">TT</a></li>--}}
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="content_area">
        <divs class="container about">
            <div class="container">

                <div class="col-lg-7 no_padding_left no_padding_right wow bounceInLeft" data-wow-duration="1s" data-wow-delay="0.2s">
                    <div class="video_main">
                        <span class="play_icon"><img src="{{ v(Theme::url('public/new/images/play_icon.png'))}}" alt=""></span>
                        <video controls id="videomain">
                            <source src="{{url('/video/homeVideo.mp4')}}" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                        {{--<iframe src="https://player.vimeo.com/video/40711675" style="position:absolute;top:0;left:0;width:100%;height:100%;" frameborder="0" allow="autoplay; fullscreen" allowfullscreen id="video_main"></iframe>--}}
                    </div>
                </div>

                <div class="col-lg-5 no_padding_left no_padding_right wow slideInRight" data-wow-duration="1.5s" data-wow-delay="0.2s">
                    <div class="customer_count">
                        <h2>{{ trans('storefront::home.about.title') }}</h2>
                        <p>{{ trans('storefront::home.about.content') }}</p>
                        <p>{{ trans('storefront::home.about.content2') }}</p>
                        <a href="{{url('/about-the-card')}}">{{ trans('storefront::home.about.cta') }}</a>

                    </div>
                </div>

            </div>
        </divs>
    </div>
    <div class="content_area services">
        <div class="container">
            <div class="row wow fadeInUp" data-wow-duration="1.5s" data-wow-delay="0.2s">
                <div class="col-md-3 no_padding_left no_padding_right">
                    <div class="detail">
                        <img src="{{ v(Theme::url('public/new/images/iconsHome/clock.svg'))}}" alt="">
                        <h4 class="title">{{ trans('storefront::home.attr.first.title') }}</h4>
                        <p>{{ trans('storefront::home.attr.first.content') }}</p>
                    </div>
                </div>
                <div class="col-md-3 no_padding_left no_padding_right">
                    <div class="detail">
                        <img src="{{ v(Theme::url('public/new/images/iconsHome/cloud.svg'))}}" alt="">
                        <h4 class="title">{{ trans('storefront::home.attr.second.title') }}</h4>
                        <p>{{ trans('storefront::home.attr.second.content') }}</p>
                    </div>
                </div>
                <div class="col-md-3 no_padding_left no_padding_right">
                    <div class="detail">
                        <img src="{{ v(Theme::url('public/new/images/iconsHome/people-02.svg'))}}" alt="">
                        <h4 class="title">{{ trans('storefront::home.attr.third.title') }}</h4>
                        <p>{{ trans('storefront::home.attr.third.content') }}</p>
                    </div>
                </div>
                <div class="col-md-3 no_padding_left no_padding_right">
                    <div class="detail">
                        <img src="{{ v(Theme::url('public/new/images/iconsHome/leaf-02.svg'))}}" alt="">
                        <h4 class="title">{{ trans('storefront::home.attr.fourth.title') }}</h4>
                        <p>{{ trans('storefront::home.attr.fourth.content') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="content_area homeSection product">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h3>{{ trans('storefront::home.our.title') }}</h3>
                    <p class="subTitle">{{ trans('storefront::home.our.subtitle') }}</p>
                </div>
            </div>
            <div class="row wow fadeInUp" data-wow-duration="1.4s" data-wow-delay="0.2s">
                @foreach($products as $product)
                    <div class="col-md-4">
                        <img src="{{ $product->base_image->path }}" alt="">
                        <h4 class="title">{{ $product->name }}</h4>
                        <p>{{ strip_tags(html_entity_decode($product->description)) }}</p>
                        <form id="add_to_cart_form" method="POST" action="{{route('cart.items.store')}}"
                              class="clearfix">
                            <input type="hidden" name="custom_uploaded_design" id="custom_uploaded_design">
                            {{ csrf_field() }}
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <div class="custom_number" style="display: none;">
                                <input type="hidden" name="qty" value="1" class="input-number input-quantity pull-left"
                                       id="qty" min="1" max="">
                            </div>
                            <button type="submit" class="add_to_cart_link addProduct " data-loading="">
                                <a class="btn">{{ trans('storefront::home.our.add') }}</a>
                            </button>
                        </form>
                    </div>
                @endforeach

            </div>
        </div>
    </div>
@endsection

@section('page_script')
    <script>
        {{--var iframe = document.querySelector('iframe');
        var player = new Vimeo.Player('video_main');--}}
        jQuery('.play_icon').click(function () {
            jQuery('#videomain').css('opacity', '1');
            jQuery('.play_icon').css({'opacity': '0', 'z-index': '-1'});
            jQuery('#videomain').get(0).play();
        });
        {{--player.on('ended', function(data) {
        // data is an object containing properties specific to that event
            jQuery('.play_icon').css({'opacity':'1','z-index':'1'});
            jQuery('#videomain').css('opacity','0');
                    });--}}
    </script>
@endsection


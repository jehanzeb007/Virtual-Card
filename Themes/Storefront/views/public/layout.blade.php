<!DOCTYPE html>
<html lang="{{ locale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>
        @hasSection('title')
            @yield('title') - {{ setting('store_name') }}
        @else
            {{ setting('store_name') }}
        @endif
    </title>
    @yield('public_profile_meta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @stack('meta')
    <script src="https://kit.fontawesome.com/0f9c3857c9.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600|Rubik:400,500" rel="stylesheet">

    @if (is_rtl())
        <link rel="stylesheet" href="{{ v(Theme::url('public/css/app.rtl.css')) }}">
    @else
        <link rel="stylesheet" href="{{ v(Theme::url('public/css/app.css')) }}">
    @endif

    <link rel="stylesheet" href="{{ v(Theme::url('public/css/custom.css')) }}">
    <link rel="shortcut icon" href="{{ $favicon }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ v(Theme::url('public/js/uploader/jquery.dm-uploader.min.css')) }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/5.4.5/css/swiper.css">
    {{--<link rel="stylesheet" href="https://unpkg.com/swiper/css/swiper.min.css">--}}

    <link rel="stylesheet" type="text/css" href="{{ v(Theme::url('public/new/css/style.css'))}}">
    <link rel="stylesheet" type="text/css" href="{{ v(Theme::url('public/new/css/intlTelInput.min.css'))}}">
    <link rel="stylesheet" type="text/css" href="{{ v(Theme::url('public/new/css/bootstrap.min.css'))}}">
    <link rel="stylesheet" type="text/css" href="{{ v(Theme::url('public/new/css/animate.css'))}}">
    <link rel="stylesheet" type="text/css"
          href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.css">
    @stack('styles')

    {!! setting('custom_header_assets') !!}

    <script>
        window.FleetCart = {
            csrfToken: '{{ csrf_token() }}',
            stripePublishableKey: '{{ setting("stripe_publishable_key") }}',
            langs: {
                'storefront::products.loading': '{{ trans("storefront::products.loading") }}',
            },
        };
    </script>
    @stack('globals')

    @routes
</head>

<body
    class="{{ $theme }} {{ storefront_layout() }} {{ is_rtl() ? 'rtl' : 'ltr' }}@if(str_contains(url()->current(), '/login')) {{' loginBody'}}@endif @if(str_contains(url()->current(), '/card-login')) {{' loginBody registerBody'}}@endif">
<div class="header-wrapper" style="display: none"></div>
<!--[if lt IE 8]>
<p>You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a>
    to improve your experience.</p>
<![endif]-->

<div class="main">
    <div class="wrapper {{ request()->routeIs('account.profile.edit') ? 'profileEditWrapper' : '' }}">
        @if(\Request::route()->getName() != 'account.profile.view')
            @include('public.partials.sidebar')
            @include('public.partials.top_nav')
            @include('public.partials.header')
            @include('public.partials.navbar')
        @endif
        <div
            class="content-wrapper clearfix {{ request()->routeIs('cart.index') ? 'cart-page' : '' }} {{(Request::path() == 'faq')?' faq':''}}">
            @include('public.partials.breadcrumb')
            @unless (request()->routeIs('home') || request()->routeIs('login') || request()->routeIs('register') || request()->routeIs('reset') || request()->routeIs('reset.complete') || request()->routeIs('account.profile.edit'))
                @include('public.partials.notification')
            @endunless
            @yield('content')
        </div>
        @if ($brands->isNotEmpty() && request()->routeIs('home'))
            <section class="brands-wrapper">
                <div class="container">
                    <div class="brands">
                        @foreach ($brands as $brand)
                            <div class="col-md-3">
                                <img src="{{ $brand->path }}">
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif

        @include('public.partials.footer')

        <a class="scroll-top" href="#">
            <i class="fa fa-angle-up" aria-hidden="true"></i>
        </a>
    </div>
</div>

@include('public.partials.quick_view_modal')

<!--        <script src="https://cdn.polyfill.io/v2/polyfill.min.js"></script>-->
<script type="text/javascript" src="{{ v(Theme::url('public/new/js/jquery.js'))}}"></script>
<script src="{{ v(Theme::url('public/js/app.js')) }}"></script>

@stack('scripts')
<script src="{{ v(Theme::url('public/js/owl.carousel.js'))}}"></script>
<link href="{{ v(Theme::url('public/css/jquery-ui.min.css'))}}" type="text/css" rel="stylesheet">
<script src="{{ v(Theme::url('public/js/jquery-ui.min.js'))}}"></script>
{{--Uploader--}}
<script src="{{ v(Theme::url('public/js/uploader/jquery.dm-uploader.min.js'))}}"></script>
<script src="{{ v(Theme::url('public/js/uploader/demo-ui.js'))}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/5.4.5/js/swiper.min.js"></script>

{{--<script src="https://unpkg.com/swiper/js/swiper.min.js"></script>--}}
<script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.js"></script>
<script type="text/javascript" src="{{ v(Theme::url('public/new/js/intlTelInput-jquery.min.js')) }}"></script>
<script type="text/javascript" src="{{ v(Theme::url('public/new/js/custom.js'))}}"></script>
<script type="text/javascript" src="{{ v(Theme::url('public/new/js/wow.min.js'))}}"></script>

@stack('custom_js')

<script type="text/javascript" src="{{ v(Theme::url('public/new/js/bootstrap.bundle.min.js'))}}"></script>
<script src="https://player.vimeo.com/api/player.js"></script>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-163034427-1"></script>
<script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
        dataLayer.push(arguments);
    }

    gtag('js', new Date());

    gtag('config', 'UA-163034427-1');
</script>
<!-- Facebook Pixel Code -->
<script>
    !function (f, b, e, v, n, t, s) {
        if (f.fbq) return;
        n = f.fbq = function () {
            n.callMethod ?
                n.callMethod.apply(n, arguments) : n.queue.push(arguments)
        };
        if (!f._fbq) f._fbq = n;
        n.push = n;
        n.loaded = !0;
        n.version = '2.0';
        n.queue = [];
        t = b.createElement(e);
        t.async = !0;
        t.src = v;
        s = b.getElementsByTagName(e)[0];
        s.parentNode.insertBefore(t, s)
    }(window, document, 'script',
        'https://connect.facebook.net/en_US/fbevents.js');
    fbq('init', '1427682814070234');
    fbq('track', 'PageView');
</script>
{{--<script type="text/javascript">
    //<![CDATA[
    var tlJsHost = ((window.location.protocol == "https:") ? "https://secure.trust-provider.com/" : "http://www.trustlogo.com/");
    document.write(unescape("%3Cscript src='" + tlJsHost + "trustlogo/javascript/trustlogo.js' type='text/javascript'%3E%3C/script%3E"));
    //]]>
</script>--}}
<noscript>
    <img height="1" width="1"
         src="https://www.facebook.com/tr?id=1427682814070234&ev=PageView
&noscript=1"/>
</noscript>
<!-- End Facebook Pixel Code -->

<script>
    jQuery(document).ready(function () {
        jQuery('.menu_icon').click(function (e) {
            e.preventDefault();
            jQuery(this).toggleClass('toggled');
            jQuery('.megamenu-wrapper').toggleClass('toggled');
        });
        jQuery('.close_menu').on('click', function (e) {
            jQuery('.menu_icon').removeClass('toggled');
            jQuery('.megamenu-wrapper').removeClass('toggled');
        });
        jQuery('.megamenu-wrapper.hidden-xs .navbar-default .navbar-nav li.dropdown > a').click(function (e) {
            e.preventDefault();
            jQuery(this).next('ul').slideToggle();
        });

    });

    function custom_numb(_this, _type) {
        var _val = $(_this).parent('.custom_number').find('input').val();
        if (_type == 'minus') {
            _val = parseInt(_val) - 1;
        } else {
            _val = parseInt(_val) + 1;
        }
        if (_val == 0) {
            _val = 1;
        }

        $(_this).parent('.custom_number').find('input').val(_val);
    }
</script>
<script>
    jQuery(document).ready(function ($) {
        var owl = $('.owl-carousel');
        owl.owlCarousel({
            items: 1,
            loop: true,
            margin: 10,
            autoplay: true,
            smartSpeed: 2000,
            autoplayTimeout: 5000,
            autoplayHoverPause: true
        });
        jQuery('.searchAction').click(function (e) {
            e.preventDefault();
            $('.search-area.pull-left').slideToggle();
        });
        var icons = {
            header: "ui-icon-caret-1-s",
            activeHeader: "ui-icon-caret-1-n"
        };
    });

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#profImg').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    function closeBtn(_this) {
        $(_this).parents('.removeMain').remove();
    }

    function addMusic(_this) {
        $(_this).parent('.addMain').children('.row').append('<div class="col-md-4 removeMain"><div class="row"><div class="col-md-12"><div class="form-group"><label for=""> Select </label><span onclick="closeBtn(this)" style="float:right;"><i class="fa fa-close"></i></span><select name="other_music[type][]"><option value="Apple Music">Apple Music</option><option value="Amazon Music">Amazon Music</option></select></div></div></div><div class="row"><div class="col-md-12"><div class="form-group"><label for=""> Title </label><input type="text" name="other_music[title][]" id="title_12" class="form-control" value=""></div></div></div><div class="row"><div class="col-md-12"><div class="form-group"><label for=""> Music Link </label><input type="text" name="other_music[music_link][]" id="music_link" class="form-control" value=""></div></div></div></div>')
    }

    function addBank(_this) {
        $(_this).parent('.addMain').children('.row').append('<div class="col-md-4 removeMain"><div class="row"><div class="col-md-12"><div class="form-group"><label for=""> Bank Title </label><span onClick="closeBtn(this)" style="float:right; cursor: pointer;"><i class="fa fa-close"></i></span><input type="text" name="other_bank[title][]" id="bank_title" class="form-control" value=""></div></div></div><div class="row"><div class="col-md-12"><div class="form-group"><label for=""> Account number </label><input type="text" name="other_bank[bank][]" id="other_bank" class="form-control" value=""></div></div></div></div>')
    }

    function addFavLinks(_this) {
        $(_this).parent('.addMain').children('.row').append('<div class="col-md-4 removeMain"><div class="row"><div class="col-md-12"><div class="form-group"><label for=""> Title </label><span onClick="closeBtn(this)" style="float:right; cursor: pointer;"><i class="fa fa-close"></i></span><input type="text" name="favorite_links[title][]" id="favorite_title" class="form-control" value=""></div></div></div><div class="row"><div class="col-md-12"><div class="form-group"><label for=""> Your Favorite Link </label><input type="text" name="favorite_links[link][]" id="favorite_link" class="form-control" value=""></div></div></div></div>');
    }

    jQuery(document).ready(function () {
        jQuery("#faq").accordion({
            //icons: icons
        });
        jQuery("#faq2").accordion({
            //icons: icons
        });
    });
    //Wow efect
    wow = new WOW(
      {
        animateClass: 'animated',
        offset:       100,
        callback:     function(box) {
          //console.log("WOW: animating <" + box.tagName.toLowerCase() + ">")
        }
      }
    );
    wow.init();
    /*document.getElementById('moar').onclick = function() {
      var section = document.createElement('section');
      section.className = 'section--purple wow fadeInDown';
      this.parentNode.insertBefore(section, this);
    };*/
</script>
@yield('page_script')
{!! setting('custom_footer_assets') !!}
</body>
</html>

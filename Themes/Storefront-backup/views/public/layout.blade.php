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

        <meta name="csrf-token" content="{{ csrf_token() }}">

        @stack('meta')

        <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600|Rubik:400,500" rel="stylesheet">

        @if (is_rtl())
            <link rel="stylesheet" href="{{ v(Theme::url('public/css/app.rtl.css')) }}">
        @else
            <link rel="stylesheet" href="{{ v(Theme::url('public/css/app.css')) }}">
        @endif

            <link rel="stylesheet" href="{{ v(Theme::url('public/css/custom.css')) }}">
        <link rel="shortcut icon" href="{{ $favicon }}" type="image/x-icon">
        <link rel="stylesheet" href="{{ v(Theme::url('public/js/uploader/jquery.dm-uploader.min.css')) }}">
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

    <body class="{{ $theme }} {{ storefront_layout() }} {{ is_rtl() ? 'rtl' : 'ltr' }}">
        <!--[if lt IE 8]>
            <p>You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

        <div class="main">
            <div class="wrapper">
                @include('public.partials.sidebar')
                @include('public.partials.top_nav')
                @include('public.partials.header')
                @include('public.partials.navbar')

                <div class="content-wrapper clearfix {{ request()->routeIs('cart.index') ? 'cart-page' : '' }}">
                    <div class="container">
                        @include('public.partials.breadcrumb')

                        @unless (request()->routeIs('home') || request()->routeIs('login') || request()->routeIs('register') || request()->routeIs('reset') || request()->routeIs('reset.complete'))
                            @include('public.partials.notification')
                        @endunless

                        
                    </div>
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

        <script src="https://cdn.polyfill.io/v2/polyfill.min.js"></script>
        <script src="{{ v(Theme::url('public/js/app.js')) }}"></script>

        @stack('scripts')
		<script src="{{ v(Theme::url('public/js/owl.carousel.js'))}}"></script>
		<link href="{{ v(Theme::url('public/css/jquery-ui.min.css'))}}" type="text/css" rel="stylesheet">
		<script src="{{ v(Theme::url('public/js/jquery-ui.min.js'))}}"></script>
        {{--Uploader--}}
        <script src="{{ v(Theme::url('public/js/uploader/jquery.dm-uploader.min.js'))}}"></script>
        <script src="{{ v(Theme::url('public/js/uploader/demo-ui.js'))}}"></script>
        @stack('custom_js')
<script>
jQuery(document).ready(function($) {
    var owl = $('.owl-carousel');
    owl.owlCarousel({
        items: 1,
        loop: true,
        margin: 10,
        autoplay: true,
        smartSpeed:2000,
        autoplayTimeout: 5000,
        autoplayHoverPause: true
    });
	jQuery('.searchAction').click(function(e){
		e.preventDefault();
		$('.search-area.pull-left').slideToggle();
	});
	var icons = {
            header: "ui-icon-caret-1-s",
            activeHeader: "ui-icon-caret-1-n"
        };
	jQuery( "#faq" ).accordion({
            icons: icons
        });
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
	function closeBtn(_this){
		$(_this).parents('.removeMain').remove();
	}
	function addMusic(_this){
		$(_this).parent('.addMain').children('.row').append('<div class="col-md-4 removeMain"><div class="row"><div class="col-md-12"><div class="form-group"><label for=""> Select </label><span onclick="closeBtn(this)" style="float:right;"><i class="fa fa-close"></i></span><select name="other_music[type][]"><option value="Soptify">Soptify</option><option value="Apple Music">Apple Music</option><option value="Amazon Music">Amazon Music</option></select></div></div></div><div class="row"><div class="col-md-12"><div class="form-group"><label for=""> Title </label><input type="text" name="other_music[title][]" id="title_12" class="form-control" value=""></div></div></div><div class="row"><div class="col-md-12"><div class="form-group"><label for=""> Music Link </label><input type="text" name="other_music[music_link][]" id="music_link" class="form-control" value=""></div></div></div></div>')
	}
	function addFavLinks(_this){
		$(_this).parent('.addMain').children('.row').append('<div class="col-md-4 removeMain"><div class="row"><div class="col-md-12"><div class="form-group"><label for=""> Title </label><span onClick="closeBtn(this)" style="float:right; cursor: pointer;"><i class="fa fa-close"></i></span><input type="text" name="favorite_links[title][]" id="favorite_title" class="form-control" value=""></div></div></div><div class="row"><div class="col-md-12"><div class="form-group"><label for=""> Your Favorite Link </label><input type="text" name="favorite_links[link][]" id="favorite_link" class="form-control" value=""></div></div></div></div>');
	}
</script>
        {!! setting('custom_footer_assets') !!}
    </body>
</html>

<!DOCTYPE html>
<html lang="{{ locale() }}">
<head>
    <base href="{{ url('/') }}">
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @yield('facebook_meta')

    <title>
        @yield('title') - Slack Admin
    </title>

    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:600|Roboto:400,500" rel="stylesheet">
    <link href="{{url('/modules/admin/css/admin-custom.css')}}" rel="stylesheet">

    @foreach ($assets->allCss() as $css)
        <link media="all" type="text/css" rel="stylesheet" href="{{ v($css) }}">
    @endforeach

    @stack('styles')

    @include('admin::partials.globals')
</head>

<body class="skin-blue sidebar-mini offcanvas clearfix {{ is_rtl() ? 'rtl' : 'ltr' }}">
<div class="left-side"></div>

@include('admin::partials.sidebar')

<div class="wrapper">
    <div class="content-wrapper">
        @include('admin::partials.top_nav')

        <section class="content-header clearfix">
            @yield('content_header')
        </section>

        <section class="content">
            @include('admin::partials.notification')

            @yield('content')
        </section>

        <div id="notification-toast"></div>
    </div>
</div>

@include('admin::partials.footer')

@include('admin::partials.confirmation_modal')

@foreach($assets->allJs() as $js)
    <script src="{{ v($js) }}"></script>
@endforeach

@stack('scripts')
<script>
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
</body>
</html>

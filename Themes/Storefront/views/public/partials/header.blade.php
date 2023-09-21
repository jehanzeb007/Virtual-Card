<header
    class="main_header{{(request()->routeIs('home'))?' smart_busines_header':' my_profile'}}{{(Request::path() == 'about-the-card')?' aboutPage':''}}{{(request()->routeIs('account.profile.edit'))?' my_profile':''}}">
    <div class="container">
        <a href="{{URL::to('/')}}{{"/" . Lang::locale()}}" class="main_logo">
            <img src="{{ v(Theme::url('public/new/images/logo.png'))}}" alt="{{ setting('store_name') }}">
        </a>
        <div class="menu_right float-right">
            @if ($categoryMenu->menus()->isNotEmpty() || $primaryMenu->menus()->isNotEmpty())
                @include('public.partials.primary_menu')
            @endif
            <div class="lang_left lang_right">
                <select onchange="location = this.value">
                    @foreach (supported_locales() as $locale => $language)
                        @if ($locale == 'es_DO')
                            <option
                                value="{{ localized_url($locale) }}" {{ locale() === $locale ? 'selected' : '' }}>{{ __('ES') }}</option>
                        @elseif ($locale == 'en')
                            <option
                                value="{{ localized_url($locale) }}" {{ locale() === $locale ? 'selected' : '' }}>{{ __('EN') }}</option>
                        @else
                            <option
                                value="{{ localized_url($locale) }}" {{ locale() === $locale ? 'selected' : '' }}>{{ $language['name'] }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            @include('public.partials.mini_cart')
            <a href="javascript:void(0)" class="menu_icon">
                <span></span>
                <span></span>
                <span></span>
            </a>
        </div>
    </div>
    <!-- Facebook Pixel Code -->
    <script>
        !function(f,b,e,v,n,t,s)
        {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
        n.callMethod.apply(n,arguments):n.queue.push(arguments)};
        if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
        n.queue=[];t=b.createElement(e);t.async=!0;
        t.src=v;s=b.getElementsByTagName(e)[0];
        s.parentNode.insertBefore(t,s)}(window, document,'script',
        'https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '337017827334147');
        fbq('track', 'PageView');
        </script>
        <noscript><img height="1" width="1" style="display:none"
        src="https://www.facebook.com/tr?id=337017827334147&ev=PageView&noscript=1"
        /></noscript>
    <!-- End Facebook Pixel Code -->
    
</header>

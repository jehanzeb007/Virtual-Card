<footer class="footer">
    <div class="footer-top p-tb-20 clearfix">
        <div class="container">
            <div>
                <div class="col-lg-3">
                    <a href="{{URL::to('/')}}{{"/" . Lang::locale()}}" class="main_logo"><img
                            src="{{ v(Theme::url('public/new/images/logo-blue.png'))}}"
                            alt="{{ setting('store_name') }}"></a>
                    <p>RETHINKING THE INDUSTRY</p>
                </div>
                <div class="col-lg-3 menu">
                    <div class="section">
                        <a href="/" class="first">{{ trans('storefront::footer.menu.home') }}</a>
                        <a href="/about-the-card" class="sec">{{ trans('storefront::footer.menu.about') }}</a>
                    </div>
                    <div class="section">
                        <a href="/products" class="first">{{ trans('storefront::footer.menu.product') }}</a>
                    </div>
                </div>
                <div class="col-lg-3 menu">
                    <div class="section">
                        <a href="/contact" class="first">{{ trans('storefront::footer.menu.contact') }}</a>
                    </div>
                    <div class="section">
                        <a href="/faq" class="first">{{ trans('storefront::footer.menu.faq') }}</a>
                    </div>
                    <div class="section">
                        <a href="/account" class="first">{{ trans('storefront::footer.menu.account') }}</a>
                    </div>
                </div>
                <div class="col-lg-3 menu">
                    <div class="section">
                        <p class="first">{{ trans('storefront::footer.follow') }}</p>
                        <div class="social">
                            <ul>
                                <li><a href="https://www.instagram.com/slackcards/" target="_blank">IG</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="section">
                        <img src="{{ v(Theme::url('public/new/images/product/checkout.png'))}}" class="trust-badge" alt="Trust badge">
                    </div>
                </div>
                <!--div class="col-lg-3 social">
                    <p class="title">{{ trans('storefront::footer.follow') }}</p>
                    <ul>
                        <li><a href="https://www.instagram.com/slackcards/" target="_blank">IG</a></li>
{{--                        <li><a href="https://www.facebook.com/Slack-Cards-101472084829788/" target="_blank">FB</a></li>--}}
{{--                        <li><a href="https://twitter.com/slackcards1" target="_blank">TW</a></li>--}}
{{--                        <li><a href="https://www.tiktok.com/@slackcards/" target="_blank">TT</a></li>--}}
                    </ul>

                    <div class="secure" style="display: flex;margin-top: 50px;">
                        <script language="JavaScript" type="text/javascript">
                            TrustLogo("https://slack.cards/themes/storefront/public/images/positivessl_trust_seal_sm_124x32.png", "CL1", "none");
                        </script>
                    </div>
                </div-->
            </div>
        </div>
    </div>
    <div class="footer-bottom p-tb-20 clearfix">
        <div class="container">
            <div class="copyright text-center">
                {!! $copyrightText !!}
            </div>
        </div>
    </div>
</footer>
<!--Start of Tawk.to Script-->
<!--script type="text/javascript">
    var Tawk_API = Tawk_API || {}, Tawk_LoadStart = new Date();
    (function () {
        var s1 = document.createElement("script"), s0 = document.getElementsByTagName("script")[0];
        s1.async = true;
        s1.src = 'https://embed.tawk.to/5e923b0269e9320caac2af4e/default';
        s1.charset = 'UTF-8';
        s1.setAttribute('crossorigin', '*');
        s0.parentNode.insertBefore(s1, s0);
    })();
</script-->
<!--End of Tawk.to Script-->

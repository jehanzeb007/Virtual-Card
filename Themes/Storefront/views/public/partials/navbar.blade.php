@if ($categoryMenu->menus()->isNotEmpty() || $primaryMenu->menus()->isNotEmpty())
    <div class="megamenu-wrapper hidden-xs">
        <span class="close_menu"><i class="fa fa-times"></i></span>
        <a href="{{URL::to('/')}}" class="nav_logo"> <img src="{{ v(Theme::url('public/new/images/logo.png'))}}"
                                                          alt="{{ setting('store_name') }}"></a>
        <div class="container">
            <nav class="navbar navbar-default">
            <!-- @include('public.partials.category_menu') -->
                @include('public.partials.primary_menu')
            </nav>
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
        </div>
    </div>
@endif

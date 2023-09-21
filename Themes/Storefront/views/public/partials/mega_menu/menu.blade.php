<li class="{{ $menu->hasSubMenus() ? 'dropdown' : '' }} {{ $menu->isFluid() ? 'fluid-menu' : '' }}">
    <a href="{{ $menu->url() == url('null') ? 'javascript:void(0)' : $menu->url() }}"
       class="{{ $menu->hasSubMenus() ? 'dropdown-toggle' : '' }}" target="{{ $menu->target() }}">
        @guest
            {{ $menu->name() }}
        @endguest
        @auth
            @if($menu->name() == 'My Account')
                <strong>{{"Hi " . Auth::user()->first_name . "!"}}</strong>
            @else
                {{ $menu->name() }}
            @endif
        @endauth
    </a>

    @if ($menu->isFluid())
        @include('public.partials.mega_menu.fluid')
    @else
        @include('public.partials.mega_menu.dropdown', ['subMenus' => $menu->subMenus(), 'class' => 'multi-level'])
    @endif
</li>

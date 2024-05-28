<aside id="aside" class="aside">
    <div class="aside__btn-block">
        <button id="aside-btn-close-menu" class="aside__btn-close-menu">
            Close
        </button>
    </div>

    <div class="aside-navigation">
        <h2 class="aside-navigation__title">{{ __("common.website") }}</h2>
        <nav class="aside-navigation__body nav-site">
            <a href="{{ route('home') }}">{{ __("common.home") }}</a>
            <a href="{{ route('blog') }}">{{ __("common.gallery") }}</a>
            @auth
                <a href="{{ route('dashboard') }}">{{ __("dashboard.dashboard") }}</a>
            @endauth
        </nav>
    </div>

</aside>
@php
    date_default_timezone_set('Europe/Ulyanovsk');
    $date = date('d.m.y H:i');
@endphp

<header class="top-panel">
    <a class="top-panel__home-link" href="/">{{ __("home.home") }}</a>  
    <a id="top-panel-menu-link" class="top-panel__menu-link">Menu</a>

    <div style="color:white;">
        {{ $date }}
    </div>

    
    <form class="top-panel__auth" method="POST" action="{{ route('logout') }}">
        @csrf
        <a 
            href="{{ route('logout') }}" 
            onclick="event.preventDefault();this.closest('form').submit();"
        >
            {{ __('Log Out') }}
        </a>
    </form>
</header>
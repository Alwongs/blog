<header class="top-panel">
    <div class="container top-panel__container">
        <a id="top-panel-menu-link" href="#" class="top-panel__menu-link"></a>

        <nav class="top-panel__navigation">
            <a class="top-panel__home-link" href="/">{{ __("home.home") }}</a>  

            @if (in_array(Illuminate\Support\Facades\Route::currentRouteName(), ['gallery', 'album', 'photo']))
                <a href="{{ route('blog') }}" class="active">{{ __("blog.blog") }}</a> 
            @else
                <a href="{{ route('blog') }}" >{{ __("blog.blog") }}</a> 
            @endif



            @Auth
                <a href="{{ route('dashboard') }}">Dashboard</a>
                <a href="{{ route('tasks.index') }}">ToDo</a>
                <a href="{{ route('product-lists.index') }}">Product-Lists</a>
                <a href="{{ route('manage-days.index') }}">Time-Management</a>
            @endauth
        </nav>
        
        <div class="top-panel__auth">       

            @auth
                <a id="top-panel-auth-opener" class="top-panel__profile-link"></a>
            @else
                <a href="{{ route('login') }}">Login</a> 
            @endauth
        </div>
    </div>
</header>

<div class="top-panel-false"></div>

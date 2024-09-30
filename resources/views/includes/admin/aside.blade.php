@php
    $currentRouteName = Illuminate\Support\Facades\Route::currentRouteName();
@endphp

<aside id="aside" class="website__aside aside">
    <div class="aside__btn-block">
        <button id="aside-btn-close-menu" class="aside__btn-close-menu">
            Close
        </button>
    </div>

    <div class="aside-navigation">
        <h2 class="aside-navigation__title">Navigation</h2>
        <nav class="aside-navigation__body nav-site">
            <a href="{{ route('home') }}">{{ __("home.home") }}</a>
            <a href="{{ route('blog') }}">{{ __("blog.blog") }}</a>
            @auth
                <a href="{{ route('tasks.index') }}">{{ __("tasks.todo") }}</a>
                {{-- <a href="{{ route('dashboard') }}">{{ __("dashboard.dashboard") }}</a> --}}
            @endauth
        </nav>
    </div>




    @auth
    <div class="aside-navigation">
        <h2 class="aside-navigation__title">Admin panel</h2>
        <nav class="aside-navigation__body nav-admin">

            <a 
                href="{{ route('dashboard') }}"
                @if (in_array($currentRouteName, ['dashboard'])) class="active" @endif
            >
                {{ __("dashboard.dashboard") }}
            </a>

            <a 
                href="{{ route('schedules.index') }}"
                @if (in_array($currentRouteName, ['schedule'])) class="active" @endif
            >
                {{ __("dashboard.work_schedule") }}
            </a>            
            
            <a 
                href="{{ route('events.index') }}"
                @if (in_array($currentRouteName, ['events.index', 'events.create', 'events.edit'])) class="active" @endif
            >
                {{ __("events.events") }}
            </a>

            <a 
                href="{{ route('categories.index') }}"
                @if (in_array($currentRouteName, ['categories.index', 'categories.create', 'categories.edit'])) class="active" @endif                
            >
                {{ __("blog.categories") }}
            </a>

            <a 
                href="{{ route('posts.index') }}"
                @if (in_array($currentRouteName, ['posts.index', 'posts.create', 'posts.edit'])) class="active" @endif  
            >
                {{ __("blog.posts") }}                    
            </a>          

            <a 
                href="{{ route('messages') }}"
                @if (in_array($currentRouteName, ['messages'])) class="active" @endif 
            >
                {{ __("message.messages") }}  
                @if(Session::get('messageCount'))
                    <span style="color:green;fomt-weight:600;">
                        {{ Session::get('messageCount')}}
                    </span>
                @endif
            </a>   

            <a 
                href="{{ route('settings.index') }}"
                @if (in_array($currentRouteName, ['settings.index'])) class="active" @endif 
            >
                Settings
            </a>
        </nav>
    </div>
    @endauth
</aside>
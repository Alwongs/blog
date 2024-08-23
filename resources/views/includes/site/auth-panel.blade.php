<div id="auth-panel" class="auth-panel">

    <div class="auth-panel__btn-block">
        <button id="auth-panel-closer" class="auth-panel__btn-close">
            Закрыть
        </button>
    </div>

    <nav class="auth-panel__navigation"> 
        <x-nav-link
            :class="'comp-nav-link-auth-panel'"
            :href="route('profile', 1)"
            :value="__('common.profile')"
        />      
        <x-nav-link
            :class="'comp-nav-link-auth-panel'"
            :href="route('dashboard')"
            :value="__('common.dashboard')"
        />  

        @auth
            <x-logout-link
                :class="'comp-nav-link-auth-panel'"
                :value="__('common.logout')"
            />
        @else
            <x-nav-link
                :class="'comp-nav-link-auth-panel'"
                :href="route('login')"
                :value="__('common.login')"
            />
            <x-nav-link
                :class="'comp-nav-link-auth-panel'"
                :href="route('register')"
                :value="__('common.register')"
            />             
        @endauth
    </nav>    

</div>
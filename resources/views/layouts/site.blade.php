<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ Illuminate\Support\Facades\Route::currentRouteName() }}</title>

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/site/app.css') }}">

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>

    </head>
    <body>
        @include('includes.site.auth-panel')
        @if( Session::get("settings.is_develop_mode.value" ) == 'Y')
            @include('includes.common.dev_label')
        @endif

        @include('includes.site.aside')

        <div class="wrapper">
            @include('includes.site.top-panel')

            {{ $slot }}

            @include('includes.site.footer')
        </div>

        <!-- Scripts -->
        @stack('jquery')  
        @stack('tinymce')      
    </body>
</html>

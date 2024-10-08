<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ Illuminate\Support\Facades\Route::currentRouteName() }}</title>

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/admin/app.css') }}">

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>

    </head>
    <body>
        <div class="website">
            @include('includes.admin.aside')

            <div class="website__page page">
                @include('includes.admin.top-panel')

                <!-- Page Content -->
                <main>
                    {{ $slot }}
                </main>
            </div>
        </div>

        <!-- Scripts -->
        @stack('tinymce')
    </body>
</html>

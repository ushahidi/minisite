<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Mahalla') }}</title>
    @if(env('APP_DEBUG'))
    <script src="{{ asset('js/debugmode.js') }}" defer></script>
    @endif

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">

    <!-- Icons -->
    <script src="https://kit.fontawesome.com/856c74694a.js" crossorigin="anonymous" defer></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" defer>
    @translations

</head>

<body class="mdc-typography">
    <aside class="mdc-drawer mdc-drawer--modal">
        @include('includes.menu-context')
    </aside>
    <div class="mdc-drawer-scrim"></div>
    <div id="app">
        <header class="mdc-top-app-bar drawer-top-app-bar">
            <div class="mdc-top-app-bar__row">
                <section class="mdc-top-app-bar__section">
                    @include('includes.top-bar')
                </section>
            </div>
        </header>

        <div class="container">
            <div class="mdc-layout-grid">
                <div class="mdc-layout-grid__inner">
                    <div class="mdc-layout-grid__cell--span-12">@yield('content')</div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>

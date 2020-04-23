<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @if (\App::environment() !== 'production')
    <meta name="robots" content="noindex" />
    @endif
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">

    <!-- Icons -->
    <script src="{{ mix('js/856c74694a.js') }}" crossorigin="anonymous" defer></script>

    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
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
                    <button class="js-menu-button material-icons mdc-top-app-bar__navigation-icon mdc-icon-button">menu</button>
                    <span class="mdc-top-app-bar__title">
                    <img src="{{asset('img/mahalla-logo@2x.png')}}" alt="{{ config('app.name', 'Mahalla') }}"/>
                    </span>
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
    @include('cookieConsent::index') 
    @include('includes.footer')
    @include('includes.simpleanalytics')
</body>

</html>
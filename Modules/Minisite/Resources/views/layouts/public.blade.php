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
    
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">

    <!-- Icons -->
    <script src="https://kit.fontawesome.com/856c74694a.js" crossorigin="anonymous"></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @translations
</head>

<body class="mdc-typography">
    <aside class="mdc-drawer mdc-drawer--modal">
        <div class="mdc-drawer__header">
            <div class="mdc-layout-grid">
                <div class="mdc-layout-grid__inner">
                    <div class="mdc-layout-grid__cell--span-12">
                        <h3 class="mdc-drawer__title">Mahalla Logo</h3>
                    </div>
                    <div class="mdc-layout-grid__cell--span-12">
                        <div class="mdc-layout-grid__inner">
                            <div
                                class="mdc-layout-grid__cell--span-2-phone mdc-layout-grid__cell--span-3-tablet mdc-layout-grid__cell--span-6-desktop">
                                <a href="{{ route('login') }}" class="mdc-button mdc-button--raised">
                                    <div class="mdc-button__ripple"></div>
                                    <span class="mdc-button__label">@lang('auth.login')</span>
                                </a>
                            </div>
                            <div
                                class="mdc-layout-grid__cell--span-2-phone mdc-layout-grid__cell--span-4-tablet mdc-layout-grid__cell--span-6-desktop">
                                <a href="{{ route('register') }}" class="mdc-button mdc-button--raised">
                                    <div class="mdc-button__ripple"></div>
                                    <span class="mdc-button__label">@lang('auth.register')</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="mdc-drawer__content">
            <nav class="mdc-list">
                @guest
                <a class="mdc-list-item" href="{{ route('login') }}" aria-current="page">
                    <i class="fas fa-heart mdc-list-item__graphic" aria-hidden="true"></i>
                    <span class="mdc-list-item__text">Create a Mahalla</span>
                </a>

                @if (Route::has('register'))
                <a class="mdc-list-item" href="{{ route('register') }}">
                    <i class="fas fa-heart mdc-list-item__graphic" aria-hidden="true"></i>
                    <span class="mdc-list-item__text">Search</span>
                </a>
                @endif
                <a class="mdc-list-item" href="{{ route('register') }}">
                    <i class="fas fa-heart mdc-list-item__graphic" aria-hidden="true"></i>
                    <span class="mdc-list-item__text">About Mahalla</span>
                </a>
                @else
                <span class="mdc-list-item">
                    {{ Auth::user()->name }}
                </span>
                <a class="mdc-list-item" href="{{ route('logout') }}"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt mdc-list-item__graphic" aria-hidden="true"></i>
                    <span class="mdc-list-item__text">{{ __('Logout') }}</span>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
                @endguest
            </nav>
        </div>
    </aside>
    <div class="mdc-drawer-scrim"></div>
    <div id="app">
        <div class="container">
            <div class="mdc-layout-grid">
                <div class="mdc-layout-grid__inner">
                    <!-- everything from here is content that is rendered based on user selection for their minisites --> 
                    <!-- the bit that matters is the yield statement with the block's name -->
                    <div class="mdc-layout-grid__cell--span-12">@yield('content')</div>
                    <!-- start of header block --> 
                    <div class="mdc-layout-grid__cell--span-12">
                        <h1>@yield('header')</h1>
                        <p>@yield('header-desc')</p>
                    </div>
                    <!-- end of header block --> 
                    <div class="mdc-layout-grid__cell--span-12">@yield('pinned')</div>
                    <div class="mdc-layout-grid__cell--span-12">@yield('featuredYoutubeVideo')</div>
                    <div class="mdc-layout-grid__cell--span-12">@yield('whatsappGroup')</div>
                    <div class="mdc-layout-grid__cell--span-12">@yield('rssFeed')</div>
                    <!-- start of free form content block --> 
                    <div class="mdc-layout-grid__cell--span-12">@yield('freeForm')</div>
                    <!-- end of free form content block --> 
                    <div class="mdc-layout-grid__cell--span-12">@yield('ushahidiPlatformMap')</div>
                    <div class="mdc-layout-grid__cell--span-12">@yield('emailForm')</div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>

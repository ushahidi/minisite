{{-- <nav class="mdc-list">
    @if (Request::is('welcome'))
    <a class="mdc-list-item" href="{{ route('login') }}" aria-current="page">
<i class="fas fa-heart mdc-list-item__graphic icon" aria-hidden="true"></i>
<span class="mdc-list-item__text">Create a Mahalla</span>
</a>

<a class="mdc-list-item" href="{{ route('register') }}">
    <i class="fas fa-heart mdc-list-item__graphic icon" aria-hidden="true"></i>
    <span class="mdc-list-item__text">Search</span>
</a>
@else
<div class="icon-element">
    <div class="icon">
        <i class="fas fa-user-circle icon"></i>
    </div>
    <div class="content">
        <h2 class="mdc-card__title mdc-typography mdc-typography--headline6">Page
            Header</h2>
        <h3 class="mdc-card__subtitle mdc-typography mdc-typography--subtitle2">
            Welcome to your
            Community</h3>
    </div>
</div>
@endif
<a class="mdc-list-item" href="{{ route('register') }}">
    <i class="fas fa-heart mdc-list-item__graphic icon" aria-hidden="true"></i>
    <span class="mdc-list-item__text">About Mahalla</span>
</a>

<a class="mdc-list-item" href="{{ route('logout') }}"
    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
    <i class="fas fa-sign-out-alt mdc-list-item__graphic" aria-hidden="true"></i>
    <span class="mdc-list-item__text">{{ __('Logout') }}</span>
</a>
<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>
@endguest
</nav> --}}

<div class="mdc-drawer__header">
    <div class="mdc-layout-grid">
        <div class="mdc-layout-grid__inner">
            @if (Request::is('/', 'login', 'register'))
            <div class="mdc-layout-grid__cell--span-12">
                <h3 class="mdc-drawer__title">Mahall Logo</h3>
            </div>
            <div class="mdc-layout-grid__cell--span-12">
                <div class="button-group">
                    <div class="mdc-layout-grid__inner">
                        <div class="grid-cell">
                            <a href="{{ route('login') }}" class="mdc-button mdc-button--raised">
                                <div class="mdc-button__ripple"></div>
                                <span class="mdc-button__label">@lang('auth.login')</span>
                            </a>
                        </div>
                        <div class="grid-cell">
                            <a href="{{ route('register') }}" class="mdc-button mdc-button--raised">
                                <div class="mdc-button__ripple"></div>
                                <span class="mdc-button__label">@lang('auth.register')</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @else
            <div class="mdc-layout-grid__cell--span-12">
                <div class="avatar">
                    <i class="fas fa-user-circle icon"></i>
                </div>
            </div>
            <div class="mdc-layout-grid__cell--span-12">
                <div class="content">
                    <h2 class="mdc-card__title mdc-typography mdc-typography--headline6 p-0">
                        Admin User Name
                    </h2>
                    <span class="mdc-card__subtitle mdc-typography mdc-typography--subtitle2">
                        {{-- {{ Auth::user()->email }} --}}
                        email@email.com
                        <i class="fas fa-caret-down icon"></i>
                    </span>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
</div>
<div class="mdc-drawer__content">
    <nav class="mdc-list">
        @if (Request::is('community'))
        <a class="mdc-list-item" href="/community" aria-current="page">
            <i class="fas fa-heart mdc-list-item__graphic icon" aria-hidden="true"></i>
            <span class="mdc-list-item__text">Home</span>
        </a>
        <a class="mdc-list-item" href="/manage-blocks" aria-current="page">
            <i class="fas fa-heart mdc-list-item__graphic icon" aria-hidden="true"></i>
            <span class="mdc-list-item__text">Manage Blocks</span>
        </a>
        <a class="mdc-list-item" href="/reorder-blocks">
            <i class="fas fa-heart mdc-list-item__graphic icon" aria-hidden="true"></i>
            <span class="mdc-list-item__text">Reorder Blocks</span>
        </a>
        <a class="mdc-list-item" href="/manage-members">
            <i class="fas fa-heart mdc-list-item__graphic icon" aria-hidden="true"></i>
            <span class="mdc-list-item__text">Manage Members</span>
        </a>
        <a class="mdc-list-item" href="/site-settings">
            <i class="fas fa-heart mdc-list-item__graphic icon" aria-hidden="true"></i>
            <span class="mdc-list-item__text">Site Settings</span>
        </a>
        <hr class="mdc-list-divder">
        @endif
        <a class="mdc-list-item" href="/my-communities" aria-current="page">
            <i class="fas fa-heart mdc-list-item__graphic icon" aria-hidden="true"></i>
            <span class="mdc-list-item__text">My Communities</span>
        </a>
        <a class="mdc-list-item" href="/create" aria-current="page">
            <i class="fas fa-heart mdc-list-item__graphic icon" aria-hidden="true"></i>
            <span class="mdc-list-item__text">Create a Community</span>
        </a>
        <a class="mdc-list-item" href="/searching">
            <i class="fas fa-heart mdc-list-item__graphic icon" aria-hidden="true"></i>
            <span class="mdc-list-item__text">Search</span>
        </a>
        <a class="mdc-list-item" href="/about">
            <i class="fas fa-heart mdc-list-item__graphic icon" aria-hidden="true"></i>
            <span class="mdc-list-item__text">About Mahalla</span>
        </a>
        <a class="mdc-list-item" href="{{ route('logout') }}"
            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="fas fa-sign-out-alt mdc-list-item__graphic icon" aria-hidden="true"></i>
            <span class="mdc-list-item__text">{{ __('Logout') }}</span>
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </nav>
</div>

<div class="mdc-drawer__header">
    <div class="mdc-layout-grid">
        <div class="mdc-layout-grid__inner">
            @if (Request::is('/', 'login', 'register'))
            <div class="mdc-layout-grid__cell--span-12">
                <h3 class="mdc-drawer__title">Mahall Logo</h3>
            </div>
            @if (!Auth::user())
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
            @endif
            @else
            <div class="mdc-layout-grid__cell--span-12">
                <div class="avatar">
                    <i class="fas fa-user-circle icon"></i>
                </div>
            </div>
            <div class="mdc-layout-grid__cell--span-12">
                <div class="content">
                    <h2 class="mdc-card__title mdc-typography mdc-typography--headline6 p-0">
                        {{ Auth::user() ? Auth::user()->name : '' }}
                    </h2>
                    <span class="mdc-card__subtitle mdc-typography mdc-typography--subtitle2">
                        {{ Auth::user() ? Auth::user()->email : '' }}
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
        @if (Auth::user())
        {{-- @review this with Seth. 
            We had an exception about focusable elements
            https://github.com/material-components/material-components-web/issues/5615
            and using the tabindex solution solved it 
        --}}
        <a tabindex="0" class="mdc-list-item" href="{{route('home')}}" aria-current="page">
            <i class="fas fa-heart mdc-list-item__graphic" aria-hidden="true"></i>
            <span class="mdc-list-item__text">My communities</span>
        </a>
        {{-- @change Pending integration --}}
        {{-- <a class="mdc-list-item" href="/add-blocks" aria-current="page">
            <i class="fas fa-heart mdc-list-item__graphic" aria-hidden="true"></i>
            <span class="mdc-list-item__text">Add Blocks</span>
        </a>
        <a class="mdc-list-item" href="/reorder-blocks">
            <i class="fas fa-heart mdc-list-item__graphic" aria-hidden="true"></i>
            <span class="mdc-list-item__text">Reorder Blocks</span>
        </a> --}}
        {{-- <a class="mdc-list-item" href="/manage-members">
            <i class="fas fa-heart mdc-list-item__graphic" aria-hidden="true"></i>
            <span class="mdc-list-item__text">Manage Members</span>
        </a> --}}
        <hr class="mdc-list-divder">
        @endif
        <a class="mdc-list-item" href="{{route('communityCreate')}}" aria-current="page">
            <i class="fas fa-heart mdc-list-item__graphic" aria-hidden="true"></i>
            <span class="mdc-list-item__text">Create a community</span>
        </a>
        <a class="mdc-list-item" href="{{route('search')}}">
            <i class="fas fa-heart mdc-list-item__graphic" aria-hidden="true"></i>
            <span class="mdc-list-item__text">Search</span>
        </a>
        <a class="mdc-list-item" href="/">
            <i class="fas fa-heart mdc-list-item__graphic" aria-hidden="true"></i>
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
    </nav>
</div>

<div class="mdc-drawer__header">
    <div class="mdc-layout-grid">
        <div class="mdc-layout-grid__inner">
            @if (Request::is('/', 'login', 'register'))
            <div class="mdc-layout-grid__cell--span-12">
                <h3 class="mdc-drawer__title">
                    <a  href="/">
                        <div>
                            <img src="{{asset('img/mahalla-logo@2x.png')}}" style="width: 140px;
                    margin-top: 6px;" alt="{{ config('app.name', 'Mahalla') }}"/>
                        </div>
                    </a>
                </h3>
            </div>
            @endif
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

                            <!-- @seth make this link pink??? -->
                            {{-- <a href="{{ route('login') }}" class="">
                                <div class="mdc-button__ripple"></div>
                                <span class="mdc-button__label">@lang('auth.login')</span>
                            </a> --}}
                        </span>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
</div>
<div class="mdc-drawer__content">
    <nav class="mdc-list">
        @if (Auth::user() && session('selectedCommunitySlug'))
            <a class="mdc-list-item" href="{{route('minisite.admin' , ['community' => session('selectedCommunitySlug') ])}}" aria-current="page">
                <span class="mdc-list-item__text"> < {{session('selectedCommunityName')}} > </span>
            </a>
            @if (session('selectedCommunityRole') === 'admin' || session('selectedCommunityRole') === 'owner' )
            <a class="mdc-list-item" href="{{ route('blockTypes', ['community' => session('selectedCommunitySlug')]) }}" aria-current="page">
                <i class="fas fa-heart mdc-list-item__graphic" aria-hidden="true"></i>
                <span class="mdc-list-item__text">Add Blocks</span>
            </a>
            <a class="mdc-list-item" href="{{ route('minisite.admin.reorder', ['community' => session('selectedCommunitySlug')]) }}">
                <i class="fas fa-heart mdc-list-item__graphic" aria-hidden="true"></i>
                <span class="mdc-list-item__text">Reorder Blocks</span>
            </a>
            @endif
            @if (session('selectedCommunityRole') === 'owner' )
            <a class="mdc-list-item" href="{{ route('community.members', ['community' => session('selectedCommunitySlug')]) }}">
                <i class="fas fa-heart mdc-list-item__graphic" aria-hidden="true"></i>
                <span class="mdc-list-item__text">Manage Members</span>
            </a>
            <a class="mdc-list-item" href="{{ route('communityEdit', ['community' => session('selectedCommunitySlug')]) }}">
                <i class="fas fa-heart mdc-list-item__graphic" aria-hidden="true"></i>
                <span class="mdc-list-item__text">Site Settings</span>
            </a>
            @endif
        @endif
        @if(Auth::user())
            <hr class="mdc-list-divider">
            <a tabindex="0" class="mdc-list-item" href="{{route('home')}}" aria-current="page">
                <i class="fas fa-heart mdc-list-item__graphic" aria-hidden="true"></i>
                <span class="mdc-list-item__text">My communities</span>
            </a>
            @endif
            <a class="mdc-list-item" href="{{route('community.create')}}" aria-current="page">
                <i class="fas fa-heart mdc-list-item__graphic" aria-hidden="true"></i>
                <span class="mdc-list-item__text">Create a community</span>
            </a>
            <a class="mdc-list-item" href="{{route('landing.search')}}">
                <i class="fas fa-heart mdc-list-item__graphic" aria-hidden="true"></i>
                <span class="mdc-list-item__text">Search</span>
            </a>
            <a class="mdc-list-item" href="/">
                <i class="fas fa-heart mdc-list-item__graphic" aria-hidden="true"></i>
                <span class="mdc-list-item__text">About Mahalla</span>
            </a>
            @if (Auth::user())
            <a class="mdc-list-item" href="{{ route('logout') }}"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="fas fa-sign-out-alt mdc-list-item__graphic" aria-hidden="true"></i>
                <span class="mdc-list-item__text">{{ __('Logout') }}</span>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        @endif
    </nav>
</div>

@if (Request::is('search'))
<a href="{{ url()->previous() }}" class="js-burger-back-button material-icons mdc-top-app-bar__navigation-icon mdc-icon-button">arrow_back</a>
<span class="mdc-top-app-bar__title">
    Search
</span>

{{-- Create Mahalla --}}
@elseif (Request::is('community/create'))
<a href="{{ url()->previous() }}" class="js-burger-back-button material-icons mdc-top-app-bar__navigation-icon mdc-icon-button">arrow_back</a>
<span class="mdc-top-app-bar__title">
    Create
</span>

{{-- Your Mahalla --}}
@elseif (Request::is('community'))
<button class="js-menu-button material-icons mdc-top-app-bar__navigation-icon mdc-icon-button">menu</button>
<span class="mdc-top-app-bar__title">
    Cooke Town
</span>

{{-- All Mahallas --}}
@elseif (Request::is('all-mahallas'))
<button class="js-menu-button material-icons mdc-top-app-bar__navigation-icon mdc-icon-button">menu</button>
<span class="mdc-top-app-bar__title">
    My Mahallas
</span>

{{-- Add Blocks --}}
@elseif (Route::is('blockTypes'))
<a href="{{ url()->previous() }}" class="js-burger-back-button back-button material-icons mdc-top-app-bar__navigation-icon mdc-icon-button">arrow_back</a>
<span class="mdc-top-app-bar__title">
    Add Blocks
</span>

{{-- Add Single Block --}}
@elseif (Route::is('blockCreate'))
<a href="{{ url()->previous() }}" class="js-burger-back-button material-icons mdc-top-app-bar__navigation-icon mdc-icon-button">arrow_back</a>
<span class="mdc-top-app-bar__title">
    Add Page Header
</span>

{{-- Edit Single Block --}}
@elseif (Route::is('blockEdit'))
<a href="{{ url()->previous() }}" class="js-burger-back-button material-icons mdc-top-app-bar__navigation-icon mdc-icon-button">arrow_back</a>
<span class="mdc-top-app-bar__title">
    Edit Page Header
</span>

@else

{{-- App Name --}}
<button class="js-menu-button material-icons mdc-top-app-bar__navigation-icon mdc-icon-button">menu</button>
<span class="mdc-top-app-bar__title">
    {{ config('app.name', 'Mahalla') }}
</span>
@endif

@if (Request::is('searching'))
<button class="material-icons mdc-top-app-bar__navigation-icon mdc-icon-button">arrow_back</button>
<span class="mdc-top-app-bar__title">
    Search
</span>
@elseif (Request::is('neighborhood/create'))
<button class="material-icons mdc-top-app-bar__navigation-icon mdc-icon-button">arrow_back</button>
<span class="mdc-top-app-bar__title">
    Create
</span>
@elseif (Request::is('community'))
<button class="material-icons mdc-top-app-bar__navigation-icon mdc-icon-button">menu</button>
<span class="mdc-top-app-bar__title">
    Cooke Town
</span>
@elseif (Request::is('all-mahallas'))
<button class="material-icons mdc-top-app-bar__navigation-icon mdc-icon-button">menu</button>
<span class="mdc-top-app-bar__title">
    My Mahallas
</span>
@else
<button class="material-icons mdc-top-app-bar__navigation-icon mdc-icon-button">menu</button>
<span class="mdc-top-app-bar__title">
    {{ config('app.name', 'Mahalla') }}
</span>
@endif

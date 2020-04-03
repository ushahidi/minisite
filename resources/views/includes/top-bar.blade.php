@if (Request::is('search'))
<button class="material-icons mdc-top-app-bar__navigation-icon mdc-icon-button">arrow_back</button>
<span class="mdc-top-app-bar__title">
    Search
</span>

{{-- Create Mahalla --}}
@elseif (Request::is('neighborhood/create'))
<button class="material-icons mdc-top-app-bar__navigation-icon mdc-icon-button">arrow_back</button>
<span class="mdc-top-app-bar__title">
    Create
</span>

{{-- Your Mahalla --}}
@elseif (Request::is('community'))
<button class="material-icons mdc-top-app-bar__navigation-icon mdc-icon-button">menu</button>
<span class="mdc-top-app-bar__title">
    Cooke Town
</span>

{{-- All Mahallas --}}
@elseif (Request::is('all-mahallas'))
<button class="material-icons mdc-top-app-bar__navigation-icon mdc-icon-button">menu</button>
<span class="mdc-top-app-bar__title">
    My Mahallas
</span>

{{-- Add Blocks --}}
@elseif (Request::is('add-blocks'))
<button class="material-icons mdc-top-app-bar__navigation-icon mdc-icon-button">arrow_back</button>
<span class="mdc-top-app-bar__title">
    Add Blocks
</span>

{{-- Add Single Block --}}
@elseif (Request::is('add-block'))
<button class="material-icons mdc-top-app-bar__navigation-icon mdc-icon-button">arrow_back</button>
<span class="mdc-top-app-bar__title">
    Add Page Header
</span>

{{-- Edit Single Block --}}
@elseif (Request::is('edit-block'))
<button class="material-icons mdc-top-app-bar__navigation-icon mdc-icon-button">arrow_back</button>
<span class="mdc-top-app-bar__title">
    Edit Page Header
</span>

@else

{{-- App Name --}}
<button class="material-icons mdc-top-app-bar__navigation-icon mdc-icon-button">menu</button>
<span class="mdc-top-app-bar__title">
    {{ config('app.name', 'Mahalla') }}
</span>
@endif

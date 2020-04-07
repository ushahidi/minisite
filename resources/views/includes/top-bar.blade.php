{{-- Log In --}}
@if (Request::is('login'))
<button class="material-icons mdc-top-app-bar__navigation-icon mdc-icon-button">menu</button>
<span class="mdc-top-app-bar__title">
    @lang('auth.login')
</span>

{{-- Register --}}
@elseif (Request::is('register'))
<button class="material-icons mdc-top-app-bar__navigation-icon mdc-icon-button">arrow_back</button>
<span class="mdc-top-app-bar__title">
    Register New Account
</span>

{{-- Forgot Password --}}
@elseif (Request::is('password/reset'))
<button class="material-icons mdc-top-app-bar__navigation-icon mdc-icon-button">menu</button>
<span class="mdc-top-app-bar__title">
    Forgot Password
</span>

{{-- Reset Password --}}
@elseif (Request::is('reset-password'))
<button class="material-icons mdc-top-app-bar__navigation-icon mdc-icon-button">menu</button>
<span class="mdc-top-app-bar__title">
    Reset Password
</span>

{{-- Change Password --}}
@elseif (Request::is('change-password'))
<button class="material-icons mdc-top-app-bar__navigation-icon mdc-icon-button">menu</button>
<span class="mdc-top-app-bar__title">
    Change Password
</span>

{{-- User Profile --}}
@elseif (Request::is('user-profile'))
<button class="material-icons mdc-top-app-bar__navigation-icon mdc-icon-button">menu</button>
<span class="mdc-top-app-bar__title">
    Profile
</span>

{{-- Search --}}
@elseif (Request::is('searching'))
<button class="material-icons mdc-top-app-bar__navigation-icon mdc-icon-button">arrow_back</button>
<span class="mdc-top-app-bar__title">
    Search
</span>

{{-- Create Mahalla --}}
@elseif (Request::is('neighborhood/create', 'neighborhood/create-address'))
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
@elseif (Request::is('my-communities'))
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

{{-- Manage Blocks --}}
@elseif (Request::is('manage-blocks'))
<button class="material-icons mdc-top-app-bar__navigation-icon mdc-icon-button">menu</button>
<span class="mdc-top-app-bar__title">
    Manage Blocks
</span>

{{-- Manage Members --}}
@elseif (Request::is('manage-members'))
<button class="material-icons mdc-top-app-bar__navigation-icon mdc-icon-button">menu</button>
<span class="mdc-top-app-bar__title">
    Manage Members
</span>

{{-- Manage Member --}}
@elseif (Request::is('manage-member'))
<button class="material-icons mdc-top-app-bar__navigation-icon mdc-icon-button">arrow_back</button>
<span class="mdc-top-app-bar__title">
    Manage Member
</span>

{{-- Invite Members --}}
@elseif (Request::is('invite-members'))
<button class="material-icons mdc-top-app-bar__navigation-icon mdc-icon-button">arrow_back</button>
<span class="mdc-top-app-bar__title">
    Invite Members
</span>

{{-- Reorder Blocks --}}
@elseif (Request::is('reorder-blocks'))
<button class="material-icons mdc-top-app-bar__navigation-icon mdc-icon-button">menu</button>
<span class="mdc-top-app-bar__title">
    Reorder Blocks
</span>

{{-- Add Pinned --}}
@elseif (Request::is('add-pinned'))
<button class="material-icons mdc-top-app-bar__navigation-icon mdc-icon-button">arrow_back</button>
<span class="mdc-top-app-bar__title">
    Add Pinned Content
</span>

{{-- Free Form Content --}}
@elseif (Request::is('free-form-content'))
<button class="material-icons mdc-top-app-bar__navigation-icon mdc-icon-button">arrow_back</button>
<span class="mdc-top-app-bar__title">
    Free Form Content
</span>

@else

{{-- App Name --}}
<button class="material-icons mdc-top-app-bar__navigation-icon mdc-icon-button">menu</button>
<span class="mdc-top-app-bar__title">
    {{ config('app.name', 'Mahalla') }}
</span>
@endif

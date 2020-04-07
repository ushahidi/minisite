@extends('layouts.app')

@section('content')
<div class="manage-members">
    <div class="mdc-layout-grid__inner">
        <div class="mdc-layout-grid__cell--span-12">
            <div class="mdc-card">
                <div class="mdc-layout-grid__inner">
                    <div class="mdc-layout-grid__cell--span-12">
                        <i class="fas fa-users icon-small"></i>
                    </div>

                    <div class="mdc-layout-grid__cell--span-12 theme-primary">
                        <p>Invite members to this community or select existing members to manage them.</p>
                    </div>

                    <div class="mdc-layout-grid__cell--span-12">
                        <div class="button-group">
                            <div class="mdc-layout-grid__inner">
                                <div class="grid-cell">
                                    <a href="/invite-members" class="mdc-button mdc-button--raised theme-secondary-bg">
                                        <div class="mdc-button__ripple"></div>
                                        <span class="mdc-button__label">Invite Members</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="mdc-layout-grid__cell--span-12">
            <p>Selecting any existing member to manage them.</p>
        </div>

        <div class="mdc-layout-grid__cell--span-12">
            <ul class="mdc-list member-list mdc-list--two-line">
                <a href="/manage-member">
                    <li class="mdc-list-item mdc-ripple-upgraded" tabindex="0">
                        <span class="mdc-list-item__text">
                            <span class="mdc-list-item__primary-text">Member Name</span>
                            <span class="mdc-list-item__secondary-text">email@email.com
                            </span>
                        </span>
                        <span class="member-role theme-primary">Admin</span>
                    </li>
                </a>
            </ul>
        </div>
    </div>
</div>
@endsection

@extends('layouts.app')

@section('content')
<div class="community">
    <div class="mdc-layout-grid__inner">
        <div class="mdc-layout-grid__cell--span-12">
            <div class="mdc-card">
                <div class="mdc-layout-grid__inner">
                    <div class="mdc-layout-grid__cell--span-12">
                        <i class="fas fa-thumbs-up icon"></i>
                    </div>

                    <div class="mdc-layout-grid__cell--span-12 theme-primary">
                        <p><strong>Welcome to your community home page!</strong> You also just added your first “block”
                            to
                            your home
                            page.
                            Blocks represent different types of content you can add to your home page. Let’s try adding
                            more?
                        </p>
                    </div>

                    <div class="mdc-layout-grid__cell--span-12">
                        <div class="button-group">
                            <div class="mdc-layout-grid__inner">
                                <div class="grid-cell">
                                    <a href="/add-blocks" class="mdc-button mdc-button--raised theme-secondary-bg">
                                        <div class="mdc-button__ripple"></div>
                                        <span class="mdc-button__label">Add Blocks</span>
                                    </a>
                                </div>
                                <div class="grid-cell">
                                    <a href="/neighborhood/create"
                                        class="mdc-button mdc-button--raised theme-neutral-bg">
                                        <div class="mdc-button__ripple"></div>
                                        <span class="mdc-button__label">Later</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="mdc-layout-grid__cell--span-12">
            <div class="mdc-card heading-card">
                <p class="theme-primary">Namaste</p>
                <div class="more-options">
                    <button id="menu-button" class="mdc-icon-button mdc-card__action mdc-card__action--icon
                        mdc-ripple-upgraded--unbounded
                        mdc-ripple-upgraded" title="More options" data-mdc-ripple-is-unbounded="true" style="--mdc-ripple-fg-size:28px;
                        --mdc-ripple-fg-scale:1.71429; --mdc-ripple-left:10px; --mdc-ripple-top:10px;">
                        <i class="fas fa-ellipsis-v"></i>
                    </button>

                    <div class="mdc-menu-surface--anchor">
                        <div class="mdc-menu mdc-menu-surface" tabindex="-1">
                            <ul class="mdc-list" role="menu" aria-hidden="true">
                                <a href="/edit-block">
                                    <li class="mdc-list-item mdc-ripple-upgraded" role="menuitem" tabindex="-1">Edit
                                    </li>
                                </a>
                                <a href="/delete-block">
                                    <li class="mdc-list-item mdc-ripple-upgraded" role="menuitem" tabindex="-1">Remove
                                    </li>
                                </a>
                            </ul>
                        </div>
                    </div>
                </div>
                <h5>Welcome to your community run neighborhood homepage. Use this page to find local information, help,
                    alerts and more</h5>
            </div>
        </div>
    </div>
    <div class="mdc-layout-grid__cell--span-12">
        <div class="mdc-card">
            <div class="mdc-layout-grid__inner">
                <div class="mdc-layout-grid__cell--span-12">
                    <i class="fas fa-user-circle icon"></i>
                </div>

                <div class="mdc-layout-grid__cell--span-12 theme-primary">
                    <p><strong>Let’s start adding members to this community?</strong>
                    </p>
                </div>

                <div class="mdc-layout-grid__cell--span-12">
                    <div class="button-group">
                        <div class="mdc-layout-grid__inner">
                            <div class="grid-cell">
                                <a href="/searching" class="mdc-button mdc-button--raised theme-secondary-bg">
                                    <div class="mdc-button__ripple"></div>
                                    <span class="mdc-button__label">Add Members</span>
                                </a>
                            </div>
                            <div class="grid-cell">
                                <a href="/neighborhood/create" class="mdc-button mdc-button--raised theme-neutral-bg">
                                    <div class="mdc-button__ripple"></div>
                                    <span class="mdc-button__label">Later</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection

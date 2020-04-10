@extends('layouts.app')

@section('content')
<div class="add-block">
    <div class="mdc-layout-grid__inner">
        <div class="mdc-layout-grid__cell--span-12">
            <div class="mdc-card">
                <div class="mdc-layout-grid__inner">
                    <div class="mdc-layout-grid__cell--span-12">
                        <i class="fas fa-th-large icon-small"></i>
                    </div>

                    <div class="mdc-layout-grid__cell--span-12 theme-primary">
                        <p>Blocks represent different types of content that you can add to your home page.</p>
                    </div>

                    <div class="mdc-layout-grid__cell--span-12">
                        <div class="button-group">
                            <div class="mdc-layout-grid__inner">
                                <div class="grid-cell">
                                    <a href="/add-blocks" class="mdc-button mdc-button--raised theme-neutral-bg">
                                        <div class="mdc-button__ripple"></div>
                                        <span class="mdc-button__label">Add Blocks</span>
                                    </a>
                                </div>
                                <div class="grid-cell">
                                    <a href="/reorder-blocks" class="mdc-button mdc-button--raised theme-neutral-bg">
                                        <div class="mdc-button__ripple"></div>
                                        <span class="mdc-button__label">Reorder Blocks</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="mdc-layout-grid__cell--span-12">
            <div class="mdc-card">
                <div class="mdc-layout-grid__inner">
                    <div class="mdc-layout-grid__cell--span-12">
                        <i class="fas fa-cog icon-small"></i>
                    </div>

                    <div class="mdc-layout-grid__cell--span-12 theme-primary">
                        <p>Your Site’s title and description are always shown on top of your home page. Your site is
                            currently visible to <strong>Community Members</strong>.</p>
                    </div>

                    <div class="mdc-layout-grid__cell--span-12">
                        <div class="button-group">
                            <div class="mdc-layout-grid__inner">
                                <div class="grid-cell">
                                    <a href="/add-blocks" class="mdc-button mdc-button--raised theme-neutral-bg">
                                        <div class="mdc-button__ripple"></div>
                                        <span class="mdc-button__label">Change Site Settings</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="mdc-layout-grid__cell--span-12">
            <p>Your site is using the following Content Blocks. Edit or remove blocks by clicking on <i
                    class="fas fa-ellipsis-v"></i> icon.</p>
        </div>

        <div class="mdc-layout-grid__cell--span-12">
            <div class="mdc-card mini-card">
                <div class="more-options">
                    {{-- todo: bring style into sass --}}
                    <button id="menu-button"
                        class="mdc-icon-button mdc-card__action mdc-card__action--icon-small mdc-ripple-upgraded--unbounded mdc-ripple-upgraded"
                        title="More options" data-mdc-ripple-is-unbounded="true">
                        <i class="fas fa-ellipsis-v"></i>
                    </button>

                    <div class="mdc-menu-surface--anchor">
                        <div class="mdc-menu mdc-menu-surface" tabindex="-1">
                            <ul class="mdc-list" role="menu" aria-hidden="true">
                                <a href="/edit-block">
                                    <li class="mdc-list-item mdc-ripple-upgraded" role="menuitem" tabindex="-1">
                                        Edit
                                    </li>
                                </a>
                                <a href="/delete-block">
                                    <li class="mdc-list-item mdc-ripple-upgraded" role="menuitem" tabindex="-1">
                                        Remove
                                    </li>
                                </a>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="mdc-layout-grid__inner">
                    <div class="mdc-layout-grid__cell--span-12">
                        <p class="theme-primary">Pinned Content</p>
                        <p>Visible to Community</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

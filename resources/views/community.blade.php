@extends('layouts.app')

@section('content')
<div class="community">
    <div class="mdc-layout-grid__inner">
        <div class="mdc-layout-grid__cell--span-12">
            <div class="mdc-card">
                <div class="mdc-layout-grid__inner">
                    <div class="mdc-layout-grid__cell--span-12">
                        <i class="fas fa-thumbs-up icon-small"></i>
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
                                        <span class="mdc-button__label">Add Block</span>
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
                        <p class="theme-primary">Namaste</p>
                        <h5>Welcome to your community run neighborhood homepage. Use this page to find local
                            information, help,
                            alerts and more</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="mdc-layout-grid__cell--span-12">
        <div class="mdc-card">
            <div class="mdc-layout-grid__inner">
                <div class="mdc-layout-grid__cell--span-12">
                    <i class="fas fa-question-circle icon-small"></i>
                </div>

                <div class="mdc-layout-grid__cell--span-12 theme-primary">
                    <p>As a next step, <a href="">invite your community members</a> to this page, or <a href="/manage-blocks">manage
                            content blocks</a>, or <a href="">change settings</a> of this page. You can also find these
                        options and more by clicking on the <i class="fas fa-bars theme-gray"></i>
                        icon-small on top
                        left corner.</p>
                </div>

                <div class="grid-cell">
                    <a href="#" class="mdc-button mdc-button--raised theme-neutral-bg">
                        <div class="mdc-button__ripple"></div>
                        <span class="mdc-button__label">Got it!</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection

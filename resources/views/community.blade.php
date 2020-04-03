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

                    <div class="mdc-layout-grid__cell--span-12 theme--primary">
                        <p><strong>Welcome to your community home page!</strong> You also just added your first “block” to
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
                                    <a href="/search" class="mdc-button mdc-button--raised theme--secondary-bg">
                                        <div class="mdc-button__ripple"></div>
                                        <span class="mdc-button__label">Add Blocks</span>
                                    </a>
                                </div>
                                <div class="grid-cell">
                                    <a href="/neighborhood/create"
                                        class="mdc-button mdc-button--raised theme--neutral-bg">
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
              <p class="theme--primary">Namaste</p>
              <h5>Welcome to your community run neighborhood homepage. Use this page to find local information, help,
                  alerts and more</h5>
            </div>
        </div>
        <div class="mdc-layout-grid__cell--span-12">
            <div class="mdc-card">
                <div class="mdc-layout-grid__inner">
                    <div class="mdc-layout-grid__cell--span-12">
                        <i class="fas fa-user-circle icon"></i>
                    </div>

                    <div class="mdc-layout-grid__cell--span-12 theme--primary">
                        <p><strong>Let’s start adding members to this community?</strong>
                        </p>
                    </div>

                    <div class="mdc-layout-grid__cell--span-12">
                        <div class="button-group">
                            <div class="mdc-layout-grid__inner">
                                <div class="grid-cell">
                                    <a href="/search" class="mdc-button mdc-button--raised theme--secondary-bg">
                                        <div class="mdc-button__ripple"></div>
                                        <span class="mdc-button__label">Add Members</span>
                                    </a>
                                </div>
                                <div class="grid-cell">
                                    <a href="/neighborhood/create"
                                        class="mdc-button mdc-button--raised theme--neutral-bg">
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

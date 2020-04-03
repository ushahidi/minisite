@extends('layouts.app')

@section('content')
<div class="add-blocks">
    <div class="mdc-layout-grid__inner">
        <div class="mdc-layout-grid__cell--span-12">
            <p>Blocks represent different types of content that can be added to your home page. You can add, edit or
                remove
                them at a later point too.</p>
        </div>

        <div class="mdc-layout-grid__cell--span-12">
            <div class="mdc-card">
                <div class="mdc-card__primary-action" tabindex="0">
                    <div class="mdc-card__media mdc-card__media--16-9"
                        style="background-image: url(&quot;https://material-components.github.io/material-components-web-catalog/static/media/photos/3x2/2.jpg&quot;);">
                    </div>

                    <div class="mdc-card__primary">
                        <div class="inner-wrapper">
                            <div class="icon">
                                <i class="fas fa-user-circle icon"></i>
                            </div>
                            <div class="content">
                                <h2 class="mdc-card__title mdc-typography mdc-typography--headline6">Page
                                    Header</h2>
                                <h3 class="mdc-card__subtitle mdc-typography mdc-typography--subtitle2">
                                    Welcome to your
                                    Community</h3>
                            </div>
                        </div>
                    </div>

                    <div class="mdc-card__secondary mdc-typography mdc-typography--body2">
                        Appears on top of your community page. Use it to introduce your community to the goals
                        and
                        objectives of your page.
                    </div>

                </div>
                <div class="mdc-card__actions">
                    <div class="mdc-card__action-buttons">
                        <button class="mdc-button mdc-card__action mdc-card__action--button theme--secondary">
                            <span class="mdc-button__ripple"></span>
                            Add
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@extends('layouts.app')

@section('content')
<div class="create">
    <div class="mdc-layout-grid__inner">
        <div class="mdc-layout-grid__cell--span-12">
            <div class="mdc-text-field">
                <input id="community-name" class="mdc-text-field__input" required>
                <div class="mdc-line-ripple"></div>
                <label for="community-name" class="mdc-floating-label">Name of your community</label>
            </div>
        </div>
        <div class="mdc-layout-grid__cell--span-12">
            <div class="mdc-text-field">
                <input id="welcome-message" class="mdc-text-field__input" maxlength="50" required>
                <div class="mdc-line-ripple"></div>
                <label for="welcome-message" class="mdc-floating-label">Welcome message</label>
            </div>
            <div class="mdc-text-field-helper-line">
                <div class="mdc-text-field-character-counter">0 / 50</div>
            </div>
        </div>
        <div class="mdc-layout-grid__cell--span-12">
            <div
                class="mdc-text-field text-field mdc-text-field--fullwidth mdc-text-field--no-label mdc-text-field--textarea">
                <div class="mdc-text-field-character-counter">0 / 200</div>
                <textarea id="description" class="mdc-text-field__input" aria-labelledby="description" rows="6"
                    cols="40" maxlength="200" required></textarea>
                <div class="mdc-notched-outline">
                    <div class="mdc-notched-outline__leading"></div>
                    <div class="mdc-notched-outline__notch" style="">
                        <span class="mdc-floating-label" id="description">Describe your page</span>
                    </div>
                    <div class="mdc-notched-outline__trailing"></div>
                </div>
            </div>
        </div>
        <div class="mdc-layout-grid__cell--span-2">
            <button class="mdc-button theme-secondary-bg">
                <div class="mdc-button__ripple"></div>
                <span class="mdc-button__label theme-black">Next</span>
            </button>
        </div>
    </div>
</div>
@endsection

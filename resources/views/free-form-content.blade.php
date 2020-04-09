@extends('layouts.app')

@section('content')
<div class="add-pinned">
    <div class="mdc-layout-grid__inner">
        <div class="mdc-layout-grid__cell--span-12">
            <div
                class="mdc-text-field text-field mdc-text-field--fullwidth mdc-text-field--no-label mdc-text-field--textarea">
                <div class="mdc-text-field-character-counter">0 / 200</div>
                <textarea id="description" class="mdc-text-field__input" aria-labelledby="description" rows="6"
                    cols="40" maxlength="200" required></textarea>
                <div class="mdc-notched-outline">
                    <div class="mdc-notched-outline__leading"></div>
                    <div class="mdc-notched-outline__notch" style="">
                        <span class="mdc-floating-label" id="description">Your Text</span>
                    </div>
                    <div class="mdc-notched-outline__trailing"></div>
                </div>
            </div>
        </div>

        <div class="mdc-layout-grid__cell--span-12">
            <p>This content is visible to</p>
            <div class="mdc-form-field">
                <div class="mdc-radio mdc-ripple-upgraded mdc-ripple-upgraded--unbounded"
                    style="--mdc-ripple-fg-size:24px; --mdc-ripple-fg-scale:1.66667; --mdc-ripple-left:8px; --mdc-ripple-top:8px;">
                    <input class="mdc-radio__native-control" type="radio" id="0.8640194281924412" name="visibility"
                        checked="">
                    <div class="mdc-radio__background">
                        <div class="mdc-radio__outer-circle"></div>
                        <div class="mdc-radio__inner-circle"></div>
                    </div>
                    <div class="mdc-radio__ripple"></div>
                </div><label for="0.8640194281924412">Community Members</label>
            </div>
            <div class="mdc-form-field">
                <div class="mdc-radio mdc-ripple-upgraded mdc-ripple-upgraded--unbounded"
                    style="--mdc-ripple-fg-size:24px; --mdc-ripple-fg-scale:1.66667; --mdc-ripple-left:8px; --mdc-ripple-top:8px;">
                    <input class="mdc-radio__native-control" type="radio" id="0.44790638967359664" name="visibility">
                    <div class="mdc-radio__background">
                        <div class="mdc-radio__outer-circle"></div>
                        <div class="mdc-radio__inner-circle"></div>
                    </div>
                    <div class="mdc-radio__ripple"></div>
                </div><label for="0.44790638967359664">Anyone</label>
            </div>
        </div>

        <div class="mdc-layout-grid__cell--span-12">
            <div class="button-group small">
                <div class="mdc-layout-grid__inner">
                    <div class="grid-cell">
                        <a href="#" class="mdc-button mdc-button--raised theme-secondary-bg">
                            <div class="mdc-button__ripple"></div>
                            <span class="mdc-button__label">Update</span>
                        </a>
                    </div>

                    <div class="grid-cell">
                        <a href="#" class="mdc-button mdc-button--raised theme-neutral-bg">
                            <div class="mdc-button__ripple"></div>
                            <span class="mdc-button__label">Remove</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

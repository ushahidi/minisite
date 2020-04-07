@extends('layouts.app')

@section('content')
<div class="invite-members">
    <div class="mdc-layout-grid__inner">
        <div class="mdc-layout-grid__cell--span-12">
            <div class="mdc-text-field text-field mdc-text-field--textarea">
                <textarea id="member-emails" class="mdc-text-field__input"></textarea>
                <div class="mdc-notched-outline mdc-notched-outline--upgraded">
                    <div class="mdc-notched-outline__leading"></div>
                    <div class="mdc-notched-outline__notch" style="">
                        <label class="mdc-floating-label" for="member-emails" style="">
                            Enter one or more email addresses
                        </label>
                    </div>
                    <div class="mdc-notched-outline__trailing"></div>
                </div>
            </div>
            <div class="mdc-text-field-helper-line">
                <p
                    class="mdc-text-field-helper-text mdc-text-field-helper-text--persistent mdc-text-field-helper-text--validation-msg">
                    Enter multiple email addresses separated by comma
                </p>
            </div>
        </div>

        <div class="mdc-layout-grid__cell--span-12">
            <div class="mdc-text-field text-field mdc-text-field--textarea">
                <div class="mdc-text-field-character-counter">0 / 200</div>
                <textarea id="invite-message" class="mdc-text-field__input" maxlength="200"></textarea>
                <div class="mdc-notched-outline mdc-notched-outline--upgraded">
                    <div class="mdc-notched-outline__leading"></div>
                    <div class="mdc-notched-outline__notch" style="">
                        <label class="mdc-floating-label" for="invite-message" style="">
                            Invite message.
                        </label>
                    </div>
                    <div class="mdc-notched-outline__trailing"></div>
                </div>
            </div>
        </div>

        <div class="mdc-layout-grid__cell--span-12">
            <div class="mdc-layout-grid__cell--span-12">
                <div class="button-group medium">
                    <div class="mdc-layout-grid__inner">
                        <div class="grid-cell">
                            <button class="mdc-button theme-secondary-bg">
                                <div class="mdc-button__ripple"></div>
                                <span class="mdc-button__label theme-black">Send Invite</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

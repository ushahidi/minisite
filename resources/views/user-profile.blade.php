@extends('layouts.app')

@section('content')
<div class="user-profile">
    <div class="mdc-layout-grid__inner">
        <div class="mdc-layout-grid__cell--span-12">
            <div class="user-info">
                <div class="user-avatar flex-column">
                  <img src="https://via.placeholder.com/90" alt="member-avatar">
                  <a href="#" class="mdc-typography--body2 theme-secondary">Add Photo</a>
                </div>
                <div class="user-name flex-column">
                    <h5>Zaphod Beeblebrox</h5>
                    <span class="mdc-typography--body2">zaph@galaxy.com</span>
                    <a href="#" class="mdc-typography--body2 theme-secondary">Change Password</a>
                </div>
            </div>
        </div>
        <div class="mdc-layout-grid__cell--span-12">
            <div class="mdc-layout-grid__cell--span-12">
                <div class="mdc-text-field">
                    <input id="name" type="text" class="mdc-text-field__input @error('name') is-invalid @enderror"
                        name="name" aria-labelledby="name" autocomplete="name" autofocus required>
                    <div class="mdc-line-ripple"></div>
                    <label for="name" class="mdc-floating-label">Name</label>
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
        </div>

        <div class="mdc-layout-grid__cell--span-12">
          <div
              class="mdc-text-field text-field mdc-text-field--fullwidth mdc-text-field--no-label mdc-text-field--textarea">
              <div class="mdc-text-field-character-counter">0 / 200</div>
              <textarea id="description" class="mdc-text-field__input" aria-labelledby="description" rows="6" cols="40"
                  maxlength="200" required></textarea>
              <div class="mdc-notched-outline">
                  <div class="mdc-notched-outline__leading"></div>
                  <div class="mdc-notched-outline__notch" style="">
                      <span class="mdc-floating-label" id="description">Introduce Yourself</span>
                  </div>
                  <div class="mdc-notched-outline__trailing"></div>
              </div>
          </div>
        </div>

        <div class="mdc-layout-grid__cell--span-12">
            <div class="mdc-layout-grid__cell--span-12">
                <div class="button-group small">
                    <div class="mdc-layout-grid__inner">
                        <div class="grid-cell">
                            <a href="#" class="mdc-button mdc-button--raised theme-secondary-bg">
                                <div class="mdc-button__ripple"></div>
                                <span class="mdc-button__label">Save</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

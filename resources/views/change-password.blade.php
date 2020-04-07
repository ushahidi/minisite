@extends('layouts.app')

@section('content')
<div class="change-password mdc-card">
    <div class="mdc-layout-grid__inner">
        <div class="mdc-layout-grid__cell--span-12">
            @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
            @endif
            <form method="POST" action="{{ route('password.update') }}">
                @csrf

                <div class="mdc-layout-grid__inner">
                  <div class="mdc-layout-grid__cell--span-12">
                      <div class="mdc-text-field">
                          <input id="old-password" type="password"
                              class="mdc-text-field__input @error('password') is-invalid @enderror" name="old-password"
                              aria-labelledby="old-password" autocomplete="old-password" autofocus required>
                          <div class="mdc-line-ripple"></div>
                          <label for="old-password" class="mdc-floating-label">Old Password</label>
                          @error('password')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                      </div>
                  </div>
                    <div class="mdc-layout-grid__cell--span-12">
                        <div class="mdc-text-field">
                            <input id="new-password" type="password"
                                class="mdc-text-field__input @error('password') is-invalid @enderror"
                                name="new-password" aria-labelledby="new-password" autocomplete="new-password" autofocus
                                required>
                            <div class="mdc-line-ripple"></div>
                            <label for="new-password" class="mdc-floating-label">New Password</label>
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="mdc-layout-grid__cell--span-12">
                        <div class="mdc-text-field">
                            <input id="password-confirm" type="password"
                                class="mdc-text-field__input @error('password') is-invalid @enderror"
                                name="password-confirm" aria-labelledby="password-confirm"
                                autocomplete="password-confirm" autofocus required>
                            <div class="mdc-line-ripple"></div>
                            <label for="password-confirm" class="mdc-floating-label">Confirm
                                Password</label>
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="grid-cell">
                        <button class="mdc-button mdc-button--unelevated theme-secondary-bg" type="submit">
                            <div class="mdc-button__ripple"></div>
                            <span class="mdc-button__label">Change Password</span>
                        </button>
                    </div>

                    <div class="mdc-layout-grid__cell--span-12">
                        <a href="#" class="theme-secondary">Forgot your password?</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

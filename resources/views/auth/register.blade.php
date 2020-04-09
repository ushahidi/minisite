@extends('layouts.app')

@section('content')
<div class="register mdc-card">
    <div class="mdc-layout-grid__inner">
        <div class="mdc-layout-grid__cell--span-12">
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <input id="invitation_token" type="text" name="invitation_token" value="{{ Session::get('token') }}"
                    hidden>

                <div class="mdc-layout-grid__inner">
                    <div class="mdc-layout-grid__cell--span-12">
                        <div class="mdc-text-field">
                            <input id="name" type="text"
                                class="mdc-text-field__input @error('name') is-invalid @enderror" name="name"
                                aria-labelledby="name" autocomplete="name" autofocus required>
                            <div class="mdc-line-ripple"></div>
                            <label for="name" class="mdc-floating-label">Name</label>
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="mdc-layout-grid__cell--span-12">
                        <div class="mdc-text-field">
                            <input id="email" type="email"
                                class="mdc-text-field__input @error('email') is-invalid @enderror" name="email"
                                value="{{ old('email') }}" aria-labelledby="email" autocomplete="email" autofocus
                                required>
                            <div class="mdc-line-ripple"></div>
                            <label for="email" class="mdc-floating-label">@lang('auth.emailAddress')</label>
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="mdc-layout-grid__cell--span-12">
                        <div class="mdc-text-field">
                            <input id="password" type="password"
                                class="mdc-text-field__input @error('password') is-invalid @enderror" name="password"
                                aria-labelledby="password" autocomplete="current-password" required>
                            <div class="mdc-line-ripple"></div>
                            <label for="password" class="mdc-floating-label">@lang('auth.password')</label>
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="mdc-layout-grid__cell--span-12">
                        <div class="mdc-text-field">
                            <input id="password" type="password"
                                class="mdc-text-field__input @error('password') is-invalid @enderror" name="password_confirmation"
                                aria-labelledby="password" autocomplete="current-password" required>
                            <div class="mdc-line-ripple"></div>
                            <label for="password_confirmation " class="mdc-floating-label">Confirm @lang('auth.password')</label>
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
                            <span class="mdc-button__label">@lang('auth.register')</span>
                        </button>
                    </div>

                    <div class="mdc-layout-grid__cell--span-12">
                        <a href="/login" class="theme-secondary">Sign In</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@extends('layouts.app')

@section('content')
<div class="login mdc-card">
    <div class="mdc-layout-grid__inner">
        <div class="mdc-layout-grid__cell--span-12">
            <div class="card__primary">
                <h2 class="card__title mdc-typography mdc-typography--headline6">@lang('auth.login')</h2>
            </div>
        </div>
        <div class="mdc-layout-grid__cell--span-12">
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="mdc-layout-grid__inner">
                    <div class="mdc-layout-grid__cell--span-12">
                        <div class="mdc-text-field">
                            <input id="email" type="email"
                                class="mdc-text-field__input @error('email') is-invalid @enderror" name="email"
                                value="{{ old('email') }}" aria-labelledby="email" autocomplete="email" autofocus
                                required>
                            <div class="mdc-line-ripple"></div>
                            <label for="email" class="mdc-floating-label">Email Address</label>
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
                            <label for="password" class="mdc-floating-label">Password</label>
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="mdc-layout-grid__cell--span-12">
                        <div class="mdc-layout-grid__inner">
                            <div class="mdc-layout-grid__cell--span-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                        {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        @lang('auth.rememberMe')
                                    </label>
                                </div>
                            </div>
                            <div class="mdc-layout-grid__cell--span-6">
                                @if (Route::has('password.request'))
                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    @lang('auth.forgotPasswordQuestion')
                                </a>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="mdc-layout-grid__cell--span-12">
                        <div class="mdc-card__actions">
                            <button class="mdc-button mdc-button--unelevated" type="submit">
                                <div class="mdc-button__ripple"></div>
                                <span class="mdc-button__label">@lang('auth.login')</span>
                            </button>
                        </div>
                        <div class="button-group">
                            <div class="mdc-layout-grid__inner">
                                <div class="grid-cell">
                                    <a href="{{ route('register') }}" class="mdc-button mdc-button--raised theme-secondary-bg">
                                        <div class="mdc-button__ripple"></div>
                                        <span class="mdc-button__label">Register</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

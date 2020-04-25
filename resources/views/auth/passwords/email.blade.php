@extends('layouts.app')

@section('content')
<div class="forgot-password mdc-card">
    <div class="mdc-layout-grid__inner">
        <div class="mdc-layout-grid__cell--span-12">
            @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
            @endif
            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <div class="mdc-layout-grid__inner">
                    <div class="mdc-layout-grid__cell--span-12">
                        <div class="mdc-text-field">
                            <input id="email" type="email"
                                class="mdc-text-field__input @error('email') is-invalid @enderror" name="email"
                                value="{{ old('email') }}" aria-labelledby="email" autocomplete="email" autofocus
                                required>
                            <div class="mdc-line-ripple"></div>
                            <label for="email" class="mdc-floating-label">@lang('auth.emailAddress')</label>
                        </div>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="grid-cell">
                        <button class="mdc-button mdc-button--unelevated theme-secondary-bg" type="submit">
                            <div class="mdc-button__ripple"></div>
                            <span class="mdc-button__label">Send Password Reset Link</span>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@extends('layouts.app')

@section('content')
<div class="create">
    <form method="POST" action="{{ route('communityStore') }}">
        @csrf
        <div class="mdc-layout-grid__inner">
            <div class="mdc-layout-grid__cell--span-12">
                <div class="mdc-text-field">
                    <input id="name" name="name" class="mdc-text-field__input @error('name') is-invalid @enderror" required>
                    <div class="mdc-line-ripple"></div>
                    <label for="name" class="mdc-floating-label">@lang('minisite.minisiteName')</label>
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="mdc-layout-grid__cell--span-12">
                <div class="mdc-text-field">
                    <input id="welcome" name="welcome" class="mdc-text-field__input @error('welcome') is-invalid @enderror" required>
                    <div class="mdc-line-ripple"></div>
                    <label for="welcome" class="mdc-floating-label">@lang('minisite.welcomeMessage')</label>
                    @error('message')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="mdc-layout-grid__cell--span-12">
                <div
                    class="mdc-text-field text-field mdc-text-field--fullwidth mdc-text-field--no-label mdc-text-field--textarea">
                    <div class="mdc-text-field-character-counter">0 / 255</div>
                    <textarea id="description" name="description" class="mdc-text-field__input" aria-labelledby="description" rows="6"
                        cols="40" maxlength="255" required></textarea>
                    <div class="mdc-notched-outline">
                        <div class="mdc-notched-outline__leading"></div>
                        <div class="mdc-notched-outline__notch" style="">
                            <span class="mdc-floating-label" id="description">@lang('minisite.describeYourSite')</span>
                        </div>
                        <div class="mdc-notched-outline__trailing"></div>
                    </div>
                    @error('description')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="mdc-layout-grid__cell--span-12">
                <div class="mdc-text-field">
                    <input id="location_string" name="location_string" class="mdc-text-field__input @error('location_string') is-invalid @enderror" required>
                    <div class="mdc-line-ripple"></div>
                    <label for="location_string" class="mdc-floating-label">@lang('minisite.yourNeighborhoodLocation')</label>
                    @error('location_string')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="mdc-layout-grid__cell--span-12">
                <div class="">
                    <div class="mdc-form-field">
                        <div class="mdc-radio">
                            <input class="mdc-radio__native-control" type="radio" name="visibility" value="community" class="form-control @error('visibility') is-invalid @enderror" checked>
                            <div class="mdc-radio__background">
                            <div class="mdc-radio__outer-circle"></div>
                            <div class="mdc-radio__inner-circle"></div>
                            </div>
                            <div class="mdc-radio__ripple"></div>
                        </div>
                        <label for="visibility">@lang('minisite.visibleTo.community')</label>
                    </div>
                    <div class="mdc-form-field">
                        <div class="mdc-radio">
                            <input class="mdc-radio__native-control" type="radio" name="visibility" value="public" class="form-control @error('visibility') is-invalid @enderror">
                            <div class="mdc-radio__background">
                            <div class="mdc-radio__outer-circle"></div>
                            <div class="mdc-radio__inner-circle"></div>
                            </div>
                            <div class="mdc-radio__ripple"></div>
                        </div>
                        <label for="visibility">@lang('minisite.visibleTo.public')</label>
                    </div>
                    @error('visibility')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="mdc-layout-grid__cell--span-2">
                <button type="submit" class="mdc-button theme-secondary-bg">
                    <div class="mdc-button__ripple"></div>
                    <span class="mdc-button__label theme-black">Next</span>
                </button>
            </div>
        </div>
    </form>
</div>
@endsection

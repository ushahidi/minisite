@extends('layouts.app')

@section('content')
<div class="create">
    <form method="POST" action="{{ route('communitySetLocation', ['community' => $community]) }}">
        @csrf
        <div class="mdc-layout-grid__inner">
            <div class="mdc-layout-grid__cell--span-12">
                <div class="">
                    @foreach ($locations as $location)
                        <div class="mdc-form-field">
                            <div class="mdc-radio">
                                <input class="mdc-radio__native-control" type="radio" name="location" value="{{json_encode($location)}}" class="form-control @error('visibility') is-invalid @enderror">
                                <div class="mdc-radio__background">
                                <div class="mdc-radio__outer-circle"></div>
                                <div class="mdc-radio__inner-circle"></div>
                                </div>
                                <div class="mdc-radio__ripple"></div>
                            </div>
                            <label for="location">{{$location["displayName"]}}</label>
                        </div>
                    @endforeach
                    @error('location')
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

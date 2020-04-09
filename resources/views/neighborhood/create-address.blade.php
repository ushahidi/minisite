@extends('layouts.app')

@section('content')
<div class="create">
    <div class="mdc-layout-grid__inner">
        <div class="mdc-layout-grid__cell--span-12">
            <p>Select any one location that best matches your neighbourhood location. Modify your address by going back
                to previous
                page.</p>
        </div>

        <div class="mdc-layout-grid__cell--span-12">
            <ul class="mdc-list mdc-list--avatar-list location-list">
                <li class="mdc-list-item mdc-ripple-upgraded" tabindex="0" id="radioLabel1">
                    <div class="mdc-radio mdc-ripple-upgraded mdc-ripple-upgraded--unbounded">
                        <input class="mdc-radio__native-control" type="radio" name="listRadioGroup"
                            aria-labelledby="radioLabel1" checked="" tabindex="-1">
                        <div class="mdc-radio__background">
                            <div class="mdc-radio__outer-circle"></div>
                            <div class="mdc-radio__inner-circle"></div>
                        </div>
                        <div class="mdc-radio__ripple  "></div>
                    </div>
                    Cooke Town, Bangalore
                </li>
                <li class="mdc-list-item mdc-ripple-upgraded" id="radioLabel2" tabindex="-1">
                    <div class="mdc-radio mdc-ripple-upgraded mdc-ripple-upgraded--unbounded">
                        <input class="mdc-radio__native-control" type="radio" name="listRadioGroup"
                            aria-labelledby="radioLabel2" checked="" tabindex="-1">
                        <div class="mdc-radio__background">
                            <div class="mdc-radio__outer-circle"></div>
                            <div class="mdc-radio__inner-circle"></div>
                        </div>
                        <div class="mdc-radio__ripple  "></div>
                    </div>
                    Cooke Town 2, Bangalore
                </li>
                <li class="mdc-list-item mdc-ripple-upgraded" id="radioLabel3" tabindex="-1">
                    <div class="mdc-radio mdc-ripple-upgraded mdc-ripple-upgraded--unbounded">
                        <input class="mdc-radio__native-control" type="radio" name="listRadioGroup"
                            aria-labelledby="radioLabel3" checked="" tabindex="-1">
                        <div class="mdc-radio__background">
                            <div class="mdc-radio__outer-circle"></div>
                            <div class="mdc-radio__inner-circle"></div>
                        </div>
                        <div class="mdc-radio__ripple  "></div>
                    </div>
                    Cooke Town 3, Bangalore
                </li>
                <li class="mdc-list-item mdc-ripple-upgraded" id="radioLabel4" tabindex="-1">
                    <div class="mdc-radio mdc-ripple-upgraded mdc-ripple-upgraded--unbounded">
                        <input class="mdc-radio__native-control" type="radio" name="listRadioGroup"
                            aria-labelledby="radioLabel4" checked="" tabindex="-1">
                        <div class="mdc-radio__background">
                            <div class="mdc-radio__outer-circle"></div>
                            <div class="mdc-radio__inner-circle"></div>
                        </div>
                        <div class="mdc-radio__ripple  "></div>
                    </div>
                    Cooke Town 4, Bangalore
                </li>
                <li class="mdc-list-item mdc-ripple-upgraded" tabindex="0" id="radioLabel1">
                    <div class="mdc-radio mdc-ripple-upgraded mdc-ripple-upgraded--unbounded">
                        <input class="mdc-radio__native-control" type="radio" name="listRadioGroup"
                            aria-labelledby="radioLabel1" checked="" tabindex="-1">
                        <div class="mdc-radio__background">
                            <div class="mdc-radio__outer-circle"></div>
                            <div class="mdc-radio__inner-circle"></div>
                        </div>
                        <div class="mdc-radio__ripple  "></div>
                    </div>
                    Cooke Town, Bangalore
                </li>
                <li class="mdc-list-item mdc-ripple-upgraded" id="radioLabel2" tabindex="-1">
                    <div class="mdc-radio mdc-ripple-upgraded mdc-ripple-upgraded--unbounded">
                        <input class="mdc-radio__native-control" type="radio" name="listRadioGroup"
                            aria-labelledby="radioLabel2" checked="" tabindex="-1">
                        <div class="mdc-radio__background">
                            <div class="mdc-radio__outer-circle"></div>
                            <div class="mdc-radio__inner-circle"></div>
                        </div>
                        <div class="mdc-radio__ripple  "></div>
                    </div>
                    Cooke Town 2, Bangalore
                </li>
                <li class="mdc-list-item mdc-ripple-upgraded" id="radioLabel3" tabindex="-1">
                    <div class="mdc-radio mdc-ripple-upgraded mdc-ripple-upgraded--unbounded">
                        <input class="mdc-radio__native-control" type="radio" name="listRadioGroup"
                            aria-labelledby="radioLabel3" checked="" tabindex="-1">
                        <div class="mdc-radio__background">
                            <div class="mdc-radio__outer-circle"></div>
                            <div class="mdc-radio__inner-circle"></div>
                        </div>
                        <div class="mdc-radio__ripple  "></div>
                    </div>
                    Cooke Town 3, Bangalore
                </li>
                <li class="mdc-list-item mdc-ripple-upgraded" id="radioLabel4" tabindex="-1">
                    <div class="mdc-radio mdc-ripple-upgraded mdc-ripple-upgraded--unbounded">
                        <input class="mdc-radio__native-control" type="radio" name="listRadioGroup"
                            aria-labelledby="radioLabel4" checked="" tabindex="-1">
                        <div class="mdc-radio__background">
                            <div class="mdc-radio__outer-circle"></div>
                            <div class="mdc-radio__inner-circle"></div>
                        </div>
                        <div class="mdc-radio__ripple  "></div>
                    </div>
                    Cooke Town 4, Bangalore
                </li>
            </ul>
        </div>
        <div class="mdc-layout-grid__cell--span-12">
            <img src="/img/map.png" alt="location-map" class="location-map">
        </div>

        <div class="mdc-layout-grid__cell--span-12">
            <div class="button-group small">
                <div class="mdc-layout-grid__inner">
                    <div class="grid-cell">
                        <button class="mdc-button theme-secondary-bg">
                            <div class="mdc-button__ripple"></div>
                            <span class="mdc-button__label theme-black">Create</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

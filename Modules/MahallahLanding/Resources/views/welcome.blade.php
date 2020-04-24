@extends('layouts.public')

@section('content')
<div class="welcome tac">
    <div class="mdc-layout-grid__inner">
        <div class="mdc-layout-grid__cell--span-12">
            <h1 class="mdc-typography--headline4">Start a COVID-19 community page for your Neighbourhood</h1>
        </div>
        <div class="mdc-layout-grid__cell--span-12">
            <p>Mahalla is an open community tool for neighbourhoods – a bulletin board that enables your community
                to create, share and maintain locally relevant information.
            </p>
        </div>
        <div class="mdc-layout-grid__cell--span-12">
            <p class="callout">Search for existing communities or create one and invite your neighbours.</p>
            <div class="button-group">
                <div class="mdc-layout-grid__inner">
                    <div class="grid-cell">
                        <a href="{{route('landing.search')}}" class="mdc-button mdc-button--raised">
                            <div class="mdc-button__ripple"></div>
                            <span class="mdc-button__label">@lang('general.search')</span>
                        </a>
                    </div>
                    <div class="grid-cell">
                        <a href="{{route('community.create')}}" class="mdc-button mdc-button--raised theme-secondary-bg">
                            <div class="mdc-button__ripple"></div>
                            <span class="mdc-button__label">@lang('general.create')</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="mdc-layout-grid__cell--span-12">
            <h4>Things you can do</h4>
            <div class="mdc-card">
                <i class="fas fa-bullhorn icon" style="color:#47B7AD"></i>
                <h6>TACKLE MISINFORMATION</h6>
                <p>Crowdsource and publish validated info with help from your community. Information like local
                    news,
                    emergency contacts, local resources, best practices and more.
                </p>
            </div>

            <div class="mdc-card">
                <i class="fas fa-bell icon" style="color:#EF6292"></i>
                <h6>POST LOCAL ALERTS</h6>
                <p>Post alerts that are locally relevant</p>
            </div>

            <div class="mdc-card">
                <i class="fas fa-map-marker icon" style="color:#47B7AD"></i>
                <h6>SHARE LOCAL RESOURCES</h6>
                <p>Share & maintain information on shops and establishments open during COVID-19 lockdown</p>
            </div>

            <div class="mdc-card">
                <i class="fas fa-heartbeat icon" style="color:#EF6292"></i>
                <h6>HELP EACH OTHER</h6>
                <p>Find someone to help you with a task</p>
            </div>
        </div>

        <div class="mdc-layout-grid__cell--span-12">
            <h4>Active Communities</h4>
            @foreach ($activeCommunities as $community)
                @include('mahallahlanding::includes.community-card', ['community' => $community])
            @endforeach
            <div class="mdc-card">
                <h6 class="theme-primary tal">MAHALLA</h6>
                <p class="theme-secondary tal">Mahalla means Community in a number of countries: Arabic: محلة‎
                    maḥalla; Bengali: মহল্লা
                    môhollā; Hindustani: मोहल्ला; محلہ mōhallā; Persian: محله‎ mahalleh; Azerbaijani: Məhəllə;
                    Albanian: mahallë or mahalla, or mëhallë or mëhalla, Bulgarian: махала</p>
            </div>
        </div>
    </div>
</div>
@endsection

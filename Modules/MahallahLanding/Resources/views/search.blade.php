@extends('layouts.app')

@section('content')
<div class="search">
    <div class="mdc-layout-grid__inner">
        <div class="mdc-layout-grid__cell--span-12">
            <p>@lang('search.explainer')</p>
        </div>
        <div class="mdc-layout-grid__cell--span-12">
            <form action="{{ route('landing.search.submit') }}" method="POST">
                @csrf
                <div class="mdc-text-field mdc-text-field--with-trailing-icon">
                    <i class="material-icons mdc-text-field__icon">search</i>
                    <input id="community-name" class="mdc-text-field__input" name="query" required>
                    <div class="mdc-line-ripple"></div>
                    <label for="community-name" class="mdc-floating-label">@lang('search.communityOrCity')</label>
                </div>
            </form>
        </div>
        @isset($communities)
            <div class="mdc-layout-grid__cell--span-12">
                <div class="mdc-layout-grid__inner">                    
                    {{-- Render each result in its group --}}
                    @foreach($communities as $community)
                        <div class="grid-cell">
                            @include('mahallahlanding::includes.community-search-result', ['searchResult' => $community])
                        </div>
                    @endforeach
                </div>
            </div>
        @endisset
        @include('includes.create-community')
    </div>
</div>
@endsection

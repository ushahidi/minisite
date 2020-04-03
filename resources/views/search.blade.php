@extends('layouts.app')

@section('content')
<div class="search">
    <div class="mdc-layout-grid__inner">
        <div class="mdc-layout-grid__cell--span-12">
            <p>Enter the name of neighborhood or city that you are interested in. We will show you communities that
                exist in your location of interest.</p>
        </div>
        <div class="mdc-layout-grid__cell--span-12">
            <form action="{{ route('search') }}" method="POST">
                @csrf
                <div class="mdc-text-field mdc-text-field--with-trailing-icon">
                    <i class="material-icons mdc-text-field__icon">search</i>
                    <input id="neighborhood-name" class="mdc-text-field__input" name="query" required>
                    <div class="mdc-line-ripple"></div>
                    <label for="neighborhood-name" class="mdc-floating-label">Name of neighborhood or city</label>
                </div>
            </form>
        </div>
        @isset($searchResults)
            <div class="mdc-layout-grid__cell--span-12">
                <div class="mdc-layout-grid__inner">
                    {{-- Bring the location grouped search results --}}
                    @foreach($searchResults->groupByType() as $type => $modelSearchResults)
                        {{-- Render each result in its group --}}
                        @foreach($modelSearchResults as $searchResult)
                            <div class="grid-cell">
                                @include('includes.neighborhood-search-result', ['searchResult' => $searchResult])
                            </div>
                        @endforeach
                    @endforeach
                </div>
            </div>
        @endisset
        @include('includes.create-community')
    </div>
</div>
@endsection

@extends('layouts.app')

@section('content')
<div class="mahallas">
    <div class="mdc-layout-grid__inner">
        <div class="mdc-layout-grid__cell--span-12">
            <p>All the Mahallas you are part of.</p>
        </div>

        <div class="mdc-layout-grid__cell--span-12">
            <div class="mdc-layout-grid__inner">
                <div class="grid-cell">
                    @include('includes.neighborhood-card')
                </div>
                <div class="grid-cell">
                    @include('includes.neighborhood-card')
                </div>
            </div>
        </div>

        @include('mahallahlanding::includes.create-community')
    </div>
</div>
@endsection

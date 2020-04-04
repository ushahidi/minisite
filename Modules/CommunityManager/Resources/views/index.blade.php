@extends('layouts.app')

@section('content')
<div class="mahallas">
    <div class="mdc-layout-grid__inner">
        <div class="mdc-layout-grid__cell--span-12">
            <p>All the Mahallas you are part of.</p>
        </div>
        <div class="mdc-layout-grid__cell--span-12">
            <div class="mdc-layout-grid__inner">
                @foreach ($communities as $community)
                    <div class="grid-cell">                     
                        @include('communitymanager::includes.community-card-admin', ['community' => $community])
                    </div>
                @endforeach
            </div>
        </div>
        @include('includes.create-community')
    </div>
</div>
@endsection

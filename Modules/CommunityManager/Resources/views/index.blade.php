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
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">@lang('general.dashboard')</div>
            <div class="card-body">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                @if(Session::get('token') !== null)
                <div class="card">
                    <div class="card-header">You have a pending invite. Join now</div>
                    <div class="card-body">
                        <a href="{{URL::to(route('joinFromInvite', ['token' => Session::get('token')]))}}">
                            {{ Session::get('token') }}
                        </a>
                    </div>
                </div>
                @endisset
                @if($isLoggedIn)
                   
                    <div class="alert alert-success" role="alert">
                        @if(!empty($community))
                            <a href="{{ url('/community') }}">@lang('nav.goToYourCommunity')</a>
                        @endif

                        @if(empty($community))
                            <a href="{{ url('/community/create') }}">@lang('nav.createYourCommunity')</a>
                        @endif
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

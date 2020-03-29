@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
        <form action="{{ route('search') }}" method="POST">
            @csrf
            <input type="text" name="query" />
            <input type="submit" class="btn btn-sm btn-primary" value="@lang('search.search')" />
        </form>
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
                    @if ($neighborhood)
                        You are logged in!
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
                        @if(!empty($neighborhood))
                            <a href="{{ url('/neighborhood') }}">@lang('nav.goToYourNeighborhood')</a>
                        @endif

                        @if(empty($neighborhood))

                            <a href="{{ url('/neighborhood/create') }}">@lang('nav.createYourNeighborhood')</a>
                        @endif
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

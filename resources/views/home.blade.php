@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
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
                    @empty($neighborhood->id)
                    <div class="alert alert-success" role="alert">
                        <a href="{{ url('/neighborhood/create') }}">Create your neighborhood</a>
                    </div>
                    @endempty
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

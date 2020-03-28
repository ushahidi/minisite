@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>
                <form action="{{ route('search') }}" method="POST">
                    @csrf
                    <input type="text" name="query" />
                    <input type="submit" class="btn btn-sm btn-primary" value="Search" />
                </form>

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
                    <div class="alert alert-success" role="alert">
                    @isset($neighborhood)
                        <a href="{{ url('/neighborhood') }}">Go to your neighborhood</a>
                    @endisset

                    @empty($neighborhood)
                        <a href="{{ url('/neighborhood/create') }}">Create your neighborhood</a>
                    @endempty
                    @empty($neighborhood->id)
                    </div>
                    @endempty
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

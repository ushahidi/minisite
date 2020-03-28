@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="card">
            <div class="card-header">Your neighborhood</div>
            <div class="card-body">
                <div class="form-group row">
                    {{ $neighborhood->name }}
                </div>
                <div class="form-group row">
                    {{ $neighborhood->city }}
                </div>
                <div class="form-group row">
                    {{ $neighborhood->state }}
                </div>
                <div class="form-group row">
                    {{ $neighborhood->country }}
                </div>
            </div>
            <div class="title m-b-md">
                <form method="POST" action="{{ route('inviteMember', ['neighborhoodId' => $neighborhood->id])  }}">
                    @csrf
                    <input type="text" name="inviteFaker" value="{{$neighborhood->id}}" hidden/>
                    <button type="submit" class="btn btn-primary">
                        {{ __('Invite someone to your neighborhood') }}
                    </button>
                </form>
            </div>


            </div>
            @if(Session::get('token') !== null)
                <div class="card">
                    <div class="card-header">Invite a neighbor with this link (single use)</div>
                    <div class="card-body">
                        <a href="{{URL::to(route('joinFromInvite', ['token' => Session::get('token')]))}}">
                            {{ Session::get('token') }}
                        </a>
                    </div>
                </div>
            @endisset
        </div>
        <div class="row justify-content-center">
            @foreach ($neighborhood->neighbors as $neighbor )
                <div class="card">
                    <div class="card-header">Your neighbors</div>
                    <div class="card-body">
                        <div class="form-group row">
                            {{ $neighbor->name }}
                        </div>
                    </div>
                </div>
            @endforeach
            @if ($neighborhood->minisite)
                <div class="card">
                    <div class="card-header">Your neighborhood site</div>
                    <div class="card-body">
                        <div class="form-group row">
                            <span>Title: </span> {{ $neighborhood->minisite->title }}
                        </div>
                        <div class="form-group row">
                            <span>Visibility: </span> {{ $neighborhood->minisite->visibility }}
                        </div>
                        <div class="form-group row">
                            <span>The minisite is visible to: &nbsp;</span> {{ $neighborhood->minisite->visibility }}
                        </div>                    
                        <div class="card-footer"><a href="{{ route('minisiteEdit', ['minisite'=>$neighborhood->minisite]) }}">Edit your neighborhood site.</a></div>

                    </div>
                </div>
            @endif
        </div>
        
    </div>
</div>
@endsection

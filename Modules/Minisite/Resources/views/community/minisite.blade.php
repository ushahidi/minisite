@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="card">
            <div class="card-header">@lang('community.yourCommunity')</div>
            <div class="card-body">
                <div class="form-group row">
                    {{ $community->name }}
                </div>
                <div class="form-group row">
                    {{ $community->city }}
                </div>
                <div class="form-group row">
                    {{ $community->state }}
                </div>
                <div class="form-group row">
                    {{ $community->country }}
                </div>
            </div>
            <div class="title m-b-md">
                <form method="POST" action="{{ route('inviteMember', ['communityId' => $community->id])  }}">
                    @csrf
                    <input type="text" name="inviteFaker" value="{{$community->id}}" hidden/>
                    <button type="submit" class="btn btn-primary">
                        @lang('community.inviteSomeone')
                    </button>
                </form>
            </div>


            </div>
            @if(Session::get('token') !== null)
                <div class="card">
                    <div class="card-header">@lang('community.inviteSomeoneWithLink')</div>
                    <div class="card-body">
                        <a href="{{URL::to(route('community.members.invite.join', ['token' => Session::get('token')]))}}">
                            {{ Session::get('token') }}
                        </a>
                    </div>
                </div>
            @endisset
        </div>
        <div class="row justify-content-center">
            @foreach ($community->members as $member )
                <div class="card">
                    <div class="card-header">@lang('community.yourCommunity')</div>
                    <div class="card-body">
                        <div class="form-group row">
                            {{ $member->name }}
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection

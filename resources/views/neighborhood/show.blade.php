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
                        <a href="{{URL::to(route('joinFromInvite', ['token' => Session::get('token')]))}}">
                            {{ Session::get('token') }}
                        </a>
                    </div>
                </div>
            @endisset
        </div>
        <div class="row justify-content-center">
            @foreach ($community->community members as $neighbor )
                <div class="card">
                    <div class="card-header">@lang('community.yourCommunityMembers')</div>
                    <div class="card-body">
                        <div class="form-group row">
                            {{ $neighbor->name }}
                        </div>
                    </div>
                </div>
            @endforeach
            @if ($community->minisite)
                <div class="card">
                    <div class="card-header">@lang('minisite.yourSite')</div>
                    <div class="card-body">
                        <div class="form-group row">
                            <span>@lang('minisite.minisiteName'): </span> {{ $community->minisite->title }}
                        </div>
                        <div class="form-group row">
                            <span>@lang('minisite.visibleTo'): &nbsp;</span> @lang("minisite.visibleTo.{$community->minisite->visibility}")
                        </div>
                        <div class="card-footer"><a href="{{ route('minisiteEdit', ['minisite'=>$community->minisite]) }}">@lang('community.editSite')</a></div>
                        <div class="card-footer"><a href="{{ route('minisitePublic', ['minisite'=>$community->minisite]) }}">@lang('community.viewSite')</a></div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

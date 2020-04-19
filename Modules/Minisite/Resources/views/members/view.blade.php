@extends('layouts.app')
@section('content')
<div class="manage-members">
    <div class="mdc-layout-grid__inner">
        <div class="mdc-layout-grid__cell--span-12">
            <div class="mdc-card">
                <div class="mdc-layout-grid__inner">
                    <div class="mdc-layout-grid__cell--span-12">
                        <i class="fas fa-users icon-small"></i>
                    </div>

                    <div class="mdc-layout-grid__cell--span-12 theme-primary">
                        <p>@lang('minisite.inviteMembersExplainer')</p>
                    </div>

                    <div class="mdc-layout-grid__cell--span-12">
                        <div class="button-group">
                            <div class="mdc-layout-grid__inner">
                                <div class="grid-cell">
                                    <a href="{{route('community.members.invite', ['community' => $community])}}" class="mdc-button mdc-button--raised theme-secondary-bg">
                                        <div class="mdc-button__ripple"></div>
                                        <span class="mdc-button__label">@lang('minisite.inviteMembers')</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="mdc-layout-grid__cell--span-12">
            <p>@lang('minisite.selectMember')</p>
        </div>

        <div class="mdc-layout-grid__cell--span-12">
            <ul class="mdc-list member-list mdc-list--two-line">
                @foreach ($members as $member)
                @if ($member->getRole($community) === 'owner')
                    <a href="#">
                    <li class="mdc-list-item mdc-list-item--disabled " tabindex="0">
                @else
                    <a href="{{route('community.member', ['community' => $community, 'user' => $member])}}">
                    <li class="mdc-list-item mdc-ripple-upgraded" tabindex="0">
                @endif
                        <span class="mdc-list-item__text">
                            <span class="mdc-list-item__primary-text">{{$member->name}}</span>
                            <span class="mdc-list-item__secondary-text">{{$member->email}}
                            </span>
                        </span>
                        <span class="member-role theme-primary">{{$member->getRole($community)}}</span>
                    </li>
                </a>
                @endforeach
            </ul>
        </div>
    </div>
</div>
@endsection

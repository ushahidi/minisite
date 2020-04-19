@extends('layouts.app')
@section('content')
<div class="manage-member">
    <form method="POST" action="{{ route('community.member.update', ['community' => $community, 'user' => $member]) }}">
        @method('PUT')
        @csrf
        <div class="mdc-layout-grid__inner">
            <div class="mdc-layout-grid__cell--span-12">
                <div class="user-info">
                    <div class="user-avatar flex-column">
                        <img src="https://via.placeholder.com/90" alt="member-avatar">
                    </div>
                    <div class="user-name flex-column">
                        <h5>{{$member->name}}</h5>
                        <span class="mdc-typography--body2">{{$member->email}}</span>
                    </div>
                </div>
            </div>
            <div class="mdc-layout-grid__cell--span-12">
                <div class="checkbox-with-label">
                    <div class="mdc-touch-target-wrapper">
                        <div class="mdc-checkbox mdc-checkbox--touch">
                            <input {{$member->getRole($community) === 'admin' ? 'checked': ''}} type="checkbox" class="mdc-checkbox__native-control" id="admin-checkbox" name="admin" />
                            <div class="mdc-checkbox__background">
                                <svg class="mdc-checkbox__checkmark" viewBox="0 0 24 24">
                                    <path class="mdc-checkbox__checkmark-path" fill="none"
                                        d="M1.73,12.91 8.1,19.28 22.79,4.59" />
                                </svg>
                                <div class="mdc-checkbox__mixedmark"></div>
                            </div>
                            <div class="mdc-checkbox__ripple"></div>
                        </div>
                    </div>
                    <label for="admin-checkbox">Make Admin</label>
                </div>
            </div>

            <div class="mdc-layout-grid__cell--span-12">
                <div class="mdc-layout-grid__cell--span-12">
                    <div class="button-group">
                        <div class="mdc-layout-grid__inner">
                            <div class="grid-cell">
                                <button type="submit" class="mdc-button mdc-button--raised theme-secondary-bg">
                                    <div class="mdc-button__ripple"></div>
                                    <span class="mdc-button__label">Save</span>
                                </button>
                            </div>

                            <div class="grid-cell">
                                <a href="#" class="mdc-button mdc-button--raised theme-primary-bg">
                                    <div class="mdc-button__ripple"></div>
                                    <span class="mdc-button__label">Delete Member</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

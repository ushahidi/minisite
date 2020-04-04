@extends('layouts.app')

@section('content')
<div class="community">
    <div class="mdc-layout-grid__inner">
        <div class="mdc-layout-grid__cell--span-12">
            <div class="mdc-card">
                <div class="mdc-layout-grid__inner">
                    <div class="mdc-layout-grid__cell--span-12">
                        <i class="fas fa-thumbs-up icon"></i>
                    </div>
                    <div class="mdc-layout-grid__cell--span-12 theme-primary">
                        <p><strong>Welcome to your community home page!</strong>
                            Yopr home page is made of blocks. Each block represents a different type of content you can add to your home page. 
                            Let’s try adding one?
                        </p>
                    </div>

                    <div class="mdc-layout-grid__cell--span-12">
                        <div class="button-group">
                            <div class="mdc-layout-grid__inner">
                                <div class="grid-cell">
                                    <a href="{{ route('blockCreate', ['community'=>$community]) }}"
                                       class="mdc-button mdc-button--raised theme-secondary-bg">
                                        <div class="mdc-button__ripple"></div>
                                        <span class="mdc-button__label">@lang('minisite.addBlock')</span>
                                    </a>
                                </div>
                                <div class="grid-cell">
                                    <a href="#"
                                        class="mdc-button mdc-button--raised theme-neutral-bg">
                                        <div class="mdc-button__ripple"></div>
                                        <span class="mdc-button__label">Later</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @foreach ($community->blocks as $index => $block)
            <div class="mdc-layout-grid__cell--span-12">
                <div class="mdc-card heading-card blocks-js">
                    <p class="theme-primary">{{$block->name}}</p>
                    <div class="more-options">
                        <button data-menu-index="{{$index}}" class="menu-button mdc-icon-button mdc-card__action mdc-card__action--icon
                            mdc-ripple-upgraded--unbounded
                            mdc-ripple-upgraded" title="More options" data-mdc-ripple-is-unbounded="true" style="--mdc-ripple-fg-size:28px;
                            --mdc-ripple-fg-scale:1.71429; --mdc-ripple-left:10px; --mdc-ripple-top:10px;">
                            <i class="fas fa-ellipsis-v"></i>
                        </button>
                        <div class="mdc-menu-surface--anchor">
                            <div data-menu-index="{{$index}}" class="mdc-menu mdc-menu-surface" tabindex="-1">
                                <ul class="mdc-list" role="menu" aria-hidden="true">
                                    <a href="{{ route('blockEdit', ['community'=>  $community, 'block' => $block]) }}">
                                        <li class="mdc-list-item mdc-ripple-upgraded" role="menuitem" tabindex="-1">@lang('minisite.editBlock')
                                        </li>
                                    </a>
                                    <a 
                                        class="alert-danger alert"
                                        href="{{ route('blockDestroy', ['community'=>  $community, 'block' => $block]) }}"
                                        onclick="return confirm('@lang('minisite.deleteBlockConfirmation')')">
                                        <li class="mdc-list-item mdc-ripple-upgraded" role="menuitem" tabindex="-1"> @lang('minisite.deleteBlock')
                                        </li>
                                    </a>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <h5>{{$block->description}}</h5>
                </div>
            </div>
        @endforeach

    </div>
    <div class="mdc-layout-grid__cell--span-12">
        <div class="mdc-card">
            <div class="mdc-layout-grid__inner">
                <div class="mdc-layout-grid__cell--span-12">
                    <i class="fas fa-user-circle icon"></i>
                </div>

                <div class="mdc-layout-grid__cell--span-12 theme-primary">
                    <p><strong>Let’s start adding members to this community?</strong>
                    </p>
                </div>

                <div class="mdc-layout-grid__cell--span-12">
                    <div class="button-group">
                        <div class="mdc-layout-grid__inner">
                            <div class="grid-cell">
                                <a href="/searching" class="mdc-button mdc-button--raised theme-secondary-bg">
                                    <div class="mdc-button__ripple"></div>
                                    <span class="mdc-button__label">Add Members</span>
                                </a>
                            </div>
                            <div class="grid-cell">
                                <a href="/community/create" class="mdc-button mdc-button--raised theme-neutral-bg">
                                    <div class="mdc-button__ripple"></div>
                                    <span class="mdc-button__label">Later</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
<!-- -->

{{-- 

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">@lang('minisite.editSite')</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('communityUpdate', ['community' => $community]) }}">
                        @csrf
                        @method('PUT')
                        <div class="form-group row">
                            <label for="title" class="col-md-4 col-form-label text-md-right">@lang('minisite.minisiteName')</label>

                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ $community->name }}" required autofocus>

                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="visibility" class="col-md-4 col-form-label text-md-right">@lang('minisite.selectVisibility')</label>
                            
                            <div class="col-md-6">
                                <select name="visibility" id="visibility" class="form-control @error('visibility') is-invalid @enderror" required autofocus>
                                    <option value="">--@lang('minisite.selectVisibility')--</option>
                                    @if ($community->visibility === 'community members')
                                        <option value="community members" selected='selected'>@lang('minisite.visibleTo.communityMembers')</option>
                                    @else
                                        <option value="community members">@lang('minisite.visibleTo.communityMembers')</option>
                                    @endif
                                    @if ($community->visibility === 'public')
                                        <option value="public" selected='selected'>@lang('minisite.visibleTo.public')</option>
                                    @else
                                        <option value="public">@lang('minisite.visibleTo.public')</option>
                                    @endif
                                </select>
                                @error('visibility')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    @lang('minisite.save')
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        @foreach ($community->blocks as $block )
            <div class="card">
                <div class="card-header">{{$block->name}}</div>
                <div class="card-body">
                    <div class="form-group row">
                        {{ $block->description }}
                    </div>
                </div>
                <div class="card-footer">
                    <a class="alert-info alert" href="{{ route('blockEdit', ['community'=>  $community, 'block' => $block]) }}">@lang('minisite.editBlock')</a>
                    <a 
                        class="alert-danger alert"
                        href="{{ route('blockDestroy', ['community'=>  $community, 'block' => $block]) }}"
                        onclick="return confirm('@lang('minisite.deleteBlockConfirmation')')">
                            @lang('minisite.deleteBlock')
                    </a>
                </div>
            </div>
        @endforeach
    </div>
    <div class="row justify-content-center">
        <div class="card-footer"><a href="{{ route('blockCreate', ['community'=>$community]) }}">@lang('minisite.addBlock')</a></div>
    </div>
 --}}

@extends('layouts.app')

@section('content')
<div class="community">
    <div class="mdc-layout-grid__inner">
        <div class="mdc-layout-grid__cell--span-12">
            <div class="mdc-card">
                <div class="mdc-layout-grid__inner">
                    <div class="mdc-layout-grid__cell--span-12">
                        <i class="fas fa-info icon"></i>
                    </div>
                    @if ($community->visibility === 'public')
                    <div class="mdc-layout-grid__cell--span-12 theme-primary">
                        <p> You can share <strong><a href="{{route('minisitePublic', ['minisite'=>$community])}}" target="_blank">this site's public content</a></strong> with others who aren't part of your community.</p>
                        <p>Based on your community's visibility preferences, your community can be seen by: @lang("minisite.visibleTo.$community->visibility")
                    </div>
                    @endif
                    <div class="mdc-layout-grid__cell--span-12">
                        <div class="button-group">
                            <div class="mdc-layout-grid__inner">
                                <div class="grid-cell">
                                    <a onclick="return alert('Just an idea, but this would serve to edit public/non-public site settings and inform people on what the options mean')" class="mdc-button mdc-button--raised theme-secondary-bg">
                                        <div class="mdc-button__ripple"></div>
                                        <span class="mdc-button__label">Edit your site preferences</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="mdc-layout-grid__cell--span-12">
            <div class="mdc-card">
                <div class="mdc-layout-grid__inner">
                    <div class="mdc-layout-grid__cell--span-12">
                        <i class="fas fa-thumbs-up icon"></i>
                    </div>
                    <div class="mdc-layout-grid__cell--span-12 theme-primary">
                        <p><strong>Welcome to your community management page!</strong>
                            Your home page is made of blocks. Each block represents a different type of content you can add to your home page. 
                            Let’s try adding one?
                        </p>
                    </div>

                    <div class="mdc-layout-grid__cell--span-12">
                        <div class="button-group">
                            <div class="mdc-layout-grid__inner">
                                <div class="grid-cell">
                                    <a href="{{ route('blockTypes', ['community'=>$community]) }}"
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
                                <a onclick="return alert('Not implemented')"  class="mdc-button mdc-button--raised theme-secondary-bg">
                                    <div class="mdc-button__ripple"></div>
                                    <span class="mdc-button__label">Add Members</span>
                                </a>
                            </div>
                            <div class="grid-cell">
                                <a href="#" class="mdc-button mdc-button--raised theme-neutral-bg">
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
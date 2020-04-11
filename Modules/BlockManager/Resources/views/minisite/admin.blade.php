@extends('layouts.app')

@section('content')
<div class="community">
    <div class="mdc-layout-grid__inner">   
        <div class="mdc-layout-grid__cell--span-12">
            <div class="mdc-card">
                <div class="mdc-layout-grid__inner">
                    <div class="mdc-layout-grid__cell--span-12">
                        <i class="fas fa-th-large icon-small"></i>
                    </div>

                    <div class="mdc-layout-grid__cell--span-12 theme-primary">
                        <p>Blocks represent different types of content that you can add to your home page.</p>
                    </div>

                    <div class="mdc-layout-grid__cell--span-12">
                        <div class="button-group">
                            <div class="mdc-layout-grid__inner">
                                <div class="grid-cell">
                                    <a href="{{ route('blockTypes', ['community'=>$community]) }}" class="mdc-button mdc-button--raised theme-neutral-bg">
                                        <div class="mdc-button__ripple"></div>
                                        <span class="mdc-button__label">@lang('minisite.addBlock')</span>
                                    </a>
                                </div>
                                <div class="grid-cell">
                                    <a href="{{ route('minisite.admin.reorder', ['community'=>$community]) }}" class="mdc-button mdc-button--raised theme-neutral-bg">
                                        <div class="mdc-button__ripple"></div>
                                        <span class="mdc-button__label">@lang('minisite.reorderBlocks')</span>
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
                        <i class="fas fa-info icon"></i>
                    </div>
                    <div class="mdc-layout-grid__cell--span-12 theme-primary">
                        <p> You can share <strong><a href="{{route('minisitePublic', ['minisite'=>$community])}}" target="_blank">this site's public content</a></strong> with others who aren't part of your community.</p>
                        <p>Based on your community's visibility preferences, your community can be seen by: @lang("minisite.visibleTo.$community->visibility")
                    </div>
                    <div class="mdc-layout-grid__cell--span-12">
                        <div class="button-group">
                            <div class="mdc-layout-grid__inner">
                                <div class="grid-cell">
                                    <a href="{{route('communityEdit', ['community' => $community])}}" class="mdc-button mdc-button--raised theme-secondary-bg">
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
        <!-- this section seems to be gone from the designs now? I don't get it. Hidden while I discover why :| --->
        <div class="mdc-layout-grid__cell--span-12" style="display:none">
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
                
        {{-- retrieve only enabled blocks and pre-filter by authorization --}}
        @foreach ($community->blocks as $block)

           
        @endforeach

        @foreach ($community->blocks as $index => $block)
        
            <div class="mdc-layout-grid__cell--span-12">
                <div class="mdc-card heading-card blocks-js">
                    <p class="theme-primary">
                     @if (isset($block) && $block->type === 'Page header' && isset($block->content->Title))
                <x-page-header :block='$block'></x-page-header>
            @endif
            @if (isset($block) && $block->type === 'Pinned item')
                <x-pinned-information :block='$block'></x-pinned-information>
            @endif
            @if (isset($block) && $block->type === 'WhatsApp Group Link')
                <x-whats-app-group :block='$block'></x-whats-app-group>
            @endif
            @if (isset($block) && $block->type === 'RSS Feed')
                <x-rss-feed :block='$block'></x-rss-feed>
            @endif
            @if(isset($block) && $block->type === 'Featured Youtube Video')      
                <x-featured-youtube-video :block='$block'></x-featured-youtube-video>
            @endif
            @if(isset($block) && $block->type === 'Free form')  
                <x-free-form :block='$block'></x-free-form>
            @endif   
            @if(isset($block) && $block->type === 'Ushahidi Platform Map')
                <x-ushahidi-platform-map :block='$block'></x-ushahidi-platform-map>
            @endif
            @if(isset($block) && $block->type === 'Email Form')
                <x-email-form :minisite='$community' :block='$block'></x-email-form>
            @endif
                    
                    </p>
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
    <div class="mdc-layout-grid__cell--span-12">
        <div class="mdc-card">
            <div class="mdc-layout-grid__inner">
                <div class="mdc-layout-grid__cell--span-12">
                    <i class="fas fa-question-circle icon-small"></i>
                </div>

                <div class="mdc-layout-grid__cell--span-12 theme-primary">
                    <p>As a next step, <a href="">invite your community members</a> to this page, or <a href="/manage-blocks">manage
                            content blocks</a>, or <a href="">change settings</a> of this page. You can also find these
                        options and more by clicking on the <i class="fas fa-bars theme-gray"></i>
                        icon-small on top
                        left corner.</p>
                </div>

                <div class="grid-cell">
                    <a href="#" class="mdc-button mdc-button--raised theme-neutral-bg">
                        <div class="mdc-button__ripple"></div>
                        <span class="mdc-button__label">Got it!</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
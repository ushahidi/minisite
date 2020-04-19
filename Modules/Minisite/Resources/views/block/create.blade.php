@extends('layouts.app')

@section('content')
<div class="add-blocks">
    <div class="mdc-layout-grid__inner">
        <div class="mdc-layout-grid__cell--span-12">
            <p>Blocks represent different types of content that can be added to your home page. You can add, edit or
                remove
                them at a later point too.</p>
        </div>

        <div class="mdc-layout-grid__cell--span-12">
            @foreach ($blockTypes as $blockType)
            <a href="{{route('createByType', ['community' => $community, 'blockType' => $blockType])}}">
                <div class="mdc-card">
                    <div class="mdc-card__primary-action" tabindex="0">
                        <div class="mdc-card__media mdc-card__media--16-9"
                            style="background-image: url({!! $blockType->image_url !!});">
                        </div>

                        <div class="mdc-card__primary">
                            <div class="icon-element">
                                <div class="icon">
                                    <i class="fas fa-user-circle icon"></i>
                                </div>
                                <div class="content">
                                    <h2 class="mdc-card__title mdc-typography mdc-typography--headline6">@lang("block.$blockType->id")</h2>
                                    <h3 class="mdc-card__subtitle mdc-typography mdc-typography--subtitle2">
                                        {{$blockType->description}}</h3>
                                </div>
                            </div>
                        </div>

                        <div class="mdc-card__secondary mdc-typography mdc-typography--body2">
                            {{$blockType->where_is_placed}}
                        </div>
                    </div>
                    <div class="mdc-card__actions">
                        <div class="mdc-card__action-buttons">
                            <div class="mdc-button mdc-card__action mdc-card__action--button theme-secondary">
                            {{-- <a href="{{route('createByType', ['community' => $community, 'blockType' => $blockType])}}" class="mdc-button mdc-card__action mdc-card__action--button theme-secondary"> --}}
                                <span class="mdc-button__ripple"></span>
                                @lang('minisite.addBlock')
                            </div>
                            {{-- </a> --}}
                        </div>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</div>
@endsection

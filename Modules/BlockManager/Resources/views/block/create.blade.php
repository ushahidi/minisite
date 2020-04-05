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
                        <a href="{{route('createByType', ['community' => $community, 'blockType' => $blockType])}}" class="mdc-button mdc-card__action mdc-card__action--button theme-secondary">
                            <span class="mdc-button__ripple"></span>
                            @lang('minisite.addBlock')
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection

{{-- 
@extends('layouts.app')
@section('content')
<div class="create">
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    <form method="POST" action="{{ route('createByType') }}">
        @csrf
        <div class="mdc-layout-grid__inner">
            <div class="mdc-layout-grid__cell--span-12">
                <div class="mdc-text-field">
                    <input id="name" name="name" class="mdc-text-field__input @error('name') is-invalid @enderror" required>
                    <div class="mdc-line-ripple"></div>
                    <label for="name" class="mdc-floating-label">@lang('minisite.minisiteName')</label>
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="mdc-layout-grid__cell--span-12">
                <div class="mdc-text-field">
                    <input id="welcome" name="welcome" class="mdc-text-field__input @error('welcome') is-invalid @enderror" required>
                    <div class="mdc-line-ripple"></div>
                    <label for="welcome" class="mdc-floating-label">Welcome message</label>
                    @error('message')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="mdc-layout-grid__cell--span-12">
                <div
                    class="mdc-text-field text-field mdc-text-field--fullwidth mdc-text-field--no-label mdc-text-field--textarea">
                    <div class="mdc-text-field-character-counter">0 / 255</div>
                    <textarea id="description" name="description" class="mdc-text-field__input" aria-labelledby="description" rows="6"
                        cols="40" maxlength="255" required></textarea>
                    <div class="mdc-notched-outline">
                        <div class="mdc-notched-outline__leading"></div>
                        <div class="mdc-notched-outline__notch" style="">
                            <span class="mdc-floating-label" id="description">Describe your page</span>
                        </div>
                        <div class="mdc-notched-outline__trailing"></div>
                    </div>
                    @error('description')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="mdc-layout-grid__cell--span-12">
                <div class="">
                    <select name="visibility" id="visibility" class="form-control @error('visibility') is-invalid @enderror" required>
                        <option value="">--@lang('minisite.selectVisibility')--</option>
                        <option selected value="community">@lang('minisite.visibleTo.communityMembers')</option>
                        <option value="public">@lang('minisite.visibleTo.public')</option>
                    </select>
                    @error('description')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="mdc-layout-grid__cell--span-2">
                <button type="submit" class="mdc-button theme-secondary-bg">
                    <div class="mdc-button__ripple"></div>
                    <span class="mdc-button__label theme-black">Next</span>
                </button>
            </div>
        </div>
    </form>
</div>
@endsection --}}

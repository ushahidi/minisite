@extends('layouts.app')

@section('content')
<div class="add-block">
    <form method="POST" action="{{ route('blockUpdate', ['community' => $community, 'block' => $block]) }}">
    @method('PUT')
    @csrf
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="mdc-layout-grid__inner">
        @include('blockmanager::block.block-form')
        <div class="mdc-layout-grid__cell--span-4">
        <div class="button-group">
            <div class="mdc-layout-grid__inner">
                <div class="grid-cell">
                    <button type="submit" class="mdc-button theme-secondary-bg">
                        <div class="mdc-button__ripple"></div>
                        <span class="mdc-button__label theme-black">@lang('minisite.addBlock')</span>
                    </button>
                </div>
                <div class="grid-cell">
                    <a 
                        class="mdc-button mdc-button--raised theme-neutral-bg"
                        href="{{ route('blockDestroy', ['community'=>  $community, 'block' => $block]) }}"
                        onclick="return confirm('@lang('minisite.deleteBlockConfirmation')')">
                        <li class="mdc-list-item mdc-ripple-upgraded" role="menuitem" tabindex="-1"> @lang('minisite.deleteBlock')
                        </li>
                    </a>
                </div>
            </div>
        </div>
        </div>
    </div>
    </form>
</div>
@endsection

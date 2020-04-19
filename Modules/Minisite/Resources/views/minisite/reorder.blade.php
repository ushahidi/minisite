@extends('layouts.withvue')

@section('content')
<div class="reorder-blocks">
    <form method="POST" action="{{ route('minisite.admin.reorder.submit', ['community' => $community]) }}">
    @csrf
        <div class="mdc-layout-grid__inner">
            <div class="mdc-layout-grid__cell--span-12">
                <p>@lang('minisite.changeOrderBlocksExplainer')</p>
            </div>

            <div class="mdc-layout-grid__cell--span-12">
                <reorder :blocks='{{$sorted}}'/>
            </div>

            <div class="mdc-layout-grid__cell--span-12">
                <div class="mdc-layout-grid__cell--span-12">
                    <div class="button-group">
                        <div class="mdc-layout-grid__inner">
                            <div class="grid-cell">
                                <button type="submit" class="mdc-button mdc-button--raised theme-secondary-bg">
                                    <div class="mdc-button__ripple"></div>
                                    <span class="mdc-button__label">@lang('minisite.saveBlockOrder')</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

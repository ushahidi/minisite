@if(isset($block->content->Url))
<div class="mdc-layout-grid__cell--span-12">
    <p class="theme-primary">@lang('minisite.ushahidiMap')</p>
    <a href="{{$block->content->Url}}" target="_blank" class="theme-secondary">@lang('minisite.viewFullscreen')</a>
</div>
<div class="mdc-layout-grid__cell--span-12">
    <iframe src="{{$block->content->Url}}/map/noui" class="embed-responsive-item"></iframe>
</div>
@endif

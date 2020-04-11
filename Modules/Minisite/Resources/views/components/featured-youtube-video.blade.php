<div class="mdc-layout-grid__cell--span-12">
    @if(isset($block->content->Url))
        <div class="mdc-card">
            <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/{{$block->content->Url}}"></iframe>
        </div>
    @endif
</div>
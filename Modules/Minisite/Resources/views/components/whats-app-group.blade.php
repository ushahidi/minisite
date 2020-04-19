
<div class="mdc-layout-grid__inner">

    @if(isset($block->content->Info))
    <div class="mdc-layout-grid__cell--span-12 theme-primary">
            {{$block->content->Info}}
        </div>
    @endif
    
    @if (isset($block->content->Url))
        <div class="mdc-layout-grid__inner">
            <img src="/img/whatsappGroup.png" height="32px"/>
        </div>
        <div class="mdc-layout-grid__cell--span-12 theme-secondary">
            <a href="{{$block->content->Url}}" target="_blank">Click here to join the group.</a>
        </div>
    @endif
</div>


<div class="mdc-layout-grid__inner">
    <div class="mdc-layout-grid__cell--span-12">
        <i class="fas fa-info icon"></i>
    </div>
    <div class="mdc-layout-grid__cell--span-12 theme-primary">
        @if(isset($block->content->Text))
            {{$block->content->Text}}
        @endif
    </div>
    <div class="mdc-layout-grid__cell--span-12 theme-secondary">
            @if (isset($block->content->Info))
                {{$block->content->Info}}
            @endif
    </div>    
</div>

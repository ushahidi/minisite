@if(isset($block) && $block->type === 'Free form')   
<div class="mdc-layout-grid__cell--span-12">
    {{-- this is rendered with the prosemirror to html plugin in the FreeForm View in laravel --}}
    {!! $renderedHTML !!}
</div>
@endif
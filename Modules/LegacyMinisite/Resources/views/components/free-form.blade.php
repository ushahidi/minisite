@if(isset($block) && $block->type === 'Free form')   
    {{-- this is rendered with the prosemirror to html plugin in the FreeForm View in laravel --}}
    {!! $renderedHTML !!}
@endif
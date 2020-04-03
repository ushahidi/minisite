@if(isset($block) && $block->type === 'Free form')   

    @section('freeForm')
            {{-- this is rendered with the prosemirror to html plugin in the FreeForm View in laravel --}}
            {!! $renderedHTML !!}
    @endsection

@endif
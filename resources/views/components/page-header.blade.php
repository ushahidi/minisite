@if ($block && $block->type === 'Page header' && isset($block->content->Title))
    @section('header')
        {{$block->content->Title}}
    @endsection
    @section('header-desc')
        {{$block->content->Description}}
    @endsection
@endif
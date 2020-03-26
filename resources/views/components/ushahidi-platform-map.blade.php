@section('ushahidiPlatformMap')
    @if(isset($block) && $block->type === 'Ushahidi Platform Map')
        @if(isset($block->content->Url))
        <div class="embed-responsive embed-responsive-21by9">
            <iframe class="embed-responsive-item" src="{{$block->content->Url}}/map/noui"></iframe>
        </div>
        @endif
    @endif
@endsection
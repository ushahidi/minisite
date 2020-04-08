@section('ushahidiPlatformMap')
    @if(isset($block->content->Url))
    <div class="mdc-card">
        <iframe class="embed-responsive-item" src="{{$block->content->Url}}/map/noui"></iframe>
    </div>
    @endif
@endsection
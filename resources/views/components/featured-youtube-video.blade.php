@if(isset($block) && $block->type === 'Featured Youtube Video')      
@section('featuredYoutubeVideo')
    @if(isset($block->content->Url))
        <div class="embed-responsive embed-responsive-21by9">
            <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/{{$block->content->Url}}"></iframe>
        </div>
    @endif
@endsection
@endif

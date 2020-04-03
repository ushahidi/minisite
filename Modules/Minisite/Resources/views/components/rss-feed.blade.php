@section('rssFeed')
    @if ($block->content->Url)
        <h3>@lang('block.rssFeed')</h3>
        <div class="row justify-content-center">
            
            <ul class="col-12">
                @foreach ($block->content->Url->item as $item)
                    <li>
                        <a href="{{$item->link}}"target="_blank">{{$item->title}}</a>
                    </li>
                @endforeach
            </ul>
        </div>
    @endif
@endsection
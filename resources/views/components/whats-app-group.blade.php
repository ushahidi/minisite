@if (isset($block) && $block->type === 'WhatsApp Group Link')
    @section('whatsappGroup')
    <div class="card">
        @if(isset($block->content->Info))
        <div class="card-header">
            {{$block->content->Info}}
        </div>
        @endif
        <div class="card-body">
            <img src="/img/whatsappGroup.png" height="32px"/>
            @if (isset($block->content->Url))
                <a href="{{$block->content->Url}}">Click here to join the group.</a>
            @endif
        </div>
    </div>
    @endsection
@endif
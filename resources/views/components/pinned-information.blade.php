@if (isset($block) && $block->type === 'Pinned item')
    @section('pinned')
    <div class="card">
        @if(isset($block->content->Text))
        <div class="card-header">
            {{$block->content->Text}}
        </div>
        @endif
        <div class="card-body">
            @if (isset($block->content->Info))
                {{$block->content->Info}}
            @endif
        </div>
    </div>
    @endsection
@endif
@extends('layouts.public')
@section('title')
{{$minisite->title}}
@endsection
{{-- retrieve only enabled blocks and pre-filter by authorization --}}
@foreach ($minisite->blocks as $block)
    @if ($block->type === 'Page header' && isset($block->content->Title))
        @section('header')
            {{$block->content->Title}}
        @endsection
        @section('header-desc')
            {{$block->content->Description}}
        @endsection
    @endif
    @if ($block->type === 'Pinned item')
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
    
    @if($block->type === 'Ushahidi Platform Map')
        @section('map')
            @if(isset($block->content->Url))
            <div class="embed-responsive embed-responsive-21by9">
                <iframe class="embed-responsive-item" src="{{$block->content->Url}}/map/noui"></iframe>
            </div>
            @endif
        @endsection
    @endif

    @if($block->type === 'Youtube video')
        @section('video')
            @if(isset($block->content->Url))
            <div class="embed-responsive embed-responsive-21by9">
                <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/{{$block->content->Url}}"></iframe>
            </div>
            @endif
        @endsection
    @endif
@endforeach
@section('content')
<div class="container">
  <div class="row">
    <div class="col-sm">
        <div class="card">
            <div class="card-body">
                This is some text within a card body.
            </div>
        </div>
    </div>
    <div class="col-sm">
        <div class="card">
            <div class="card-body">
                This is some text within a card body.
            </div>
        </div>
    </div>
    <div class="col-sm">
        <h3>Important information</h3>
    </div>
  </div>
</div>
@endsection


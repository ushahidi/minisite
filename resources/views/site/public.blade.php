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


@extends('layouts.public')
@section('title')
{{$minisite->title}}
@endsection
{{-- retrieve only enabled blocks and pre-filter by authorization --}}
@foreach ($minisite->blocks as $block)
    @if ($block->type === 'header' && isset($block->content->text))
        @section('header')
            {{$block->content->text}}
        @endsection
    @endif
    @if ($block->type === 'pinned')
        @section('pinned')
            <div class="card">
                @if(isset($block->content->text))
                <div class="card-header">
                    {{$block->content->text}}
                </div>
                @endif
                <div class="card-body">
                    @if (isset($block->content->info))
                        <img src="{{$block->content->info}}"/>
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


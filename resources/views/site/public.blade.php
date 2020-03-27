@extends('layouts.public')
@section('title')
{{$minisite->title}}
@endsection
{{-- retrieve only enabled blocks and pre-filter by authorization --}}
@foreach ($minisite->blocks as $block)
    <x-page-header :block='$block'></x-page-header>
    <x-pinned-information :block='$block'></x-pinned-information>
    <x-featured-youtube-video :block='$block'></x-featured-youtube-video>    
    <x-ushahidi-platform-map :block='$block'></x-ushahidi-platform-map>
    <x-whatsapp-group :block='$block'></x-whatsapp-group>
    <x-email-form :minisite='$minisite' :block='$block'></x-email-form>
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


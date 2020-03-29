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
    <x-whats-app-group :block='$block'></x-whats-app-group>

@endforeach

@foreach ($minisite->blocks as $block)
    @if(isset($block) && $block->type === 'Free form')      
        <x-free-form :block='$block'></x-free-form>
    @endif   
    <x-email-form :minisite='$minisite' :block='$block'></x-email-form>
@endforeach


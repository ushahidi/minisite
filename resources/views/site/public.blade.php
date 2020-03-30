@extends('layouts.public')
@section('title')
{{$minisite->title}}
@endsection
{{-- retrieve only enabled blocks and pre-filter by authorization --}}
@foreach ($minisite->blocks as $block)
    @if ($block && $block->type === 'Page header' && isset($block->content->Title))
        <x-page-header :block='$block'></x-page-header>
    @endif
    @if (isset($block) && $block->type === 'Pinned item')
        <x-pinned-information :block='$block'></x-pinned-information>
    @endif
    @if (isset($block) && $block->type === 'WhatsApp Group Link')
        <x-whats-app-group :block='$block'></x-whats-app-group>
    @endif
    @if(isset($block) && $block->type === 'Featured Youtube Video')      
        <x-featured-youtube-video :block='$block'></x-featured-youtube-video>
    @endif
@endforeach

@foreach ($minisite->blocks as $block)
    @if(isset($block) && $block->type === 'Free form')      
        <x-free-form :block='$block'></x-free-form>
    @endif   
    @if(isset($block) && $block->type === 'Ushahidi Platform Map')
        <x-ushahidi-platform-map :block='$block'></x-ushahidi-platform-map>
    @endif
    @if(isset($block) && $block->type === 'Email Form')      
        <x-email-form :minisite='$minisite' :block='$block'></x-email-form>
    @endif
@endforeach


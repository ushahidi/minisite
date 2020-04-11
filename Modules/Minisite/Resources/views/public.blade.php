@extends('minisite::layouts.public')

@section('title')
{{$minisite->title}}
@endsection
@section('content')
{{-- retrieve only enabled blocks and pre-filter by authorization --}}
@foreach ($returnBlocks as $block)

    @if (isset($block) && $block->type === 'Page header' && isset($block->content->Title))
        <x-page-header :block='$block'></x-page-header>
    @endif
    @if (isset($block) && $block->type === 'Pinned item')
        <x-pinned-information :block='$block'></x-pinned-information>
    @endif
    @if (isset($block) && $block->type === 'WhatsApp Group Link')
        <x-whats-app-group :block='$block'></x-whats-app-group>
    @endif
     @if (isset($block) && $block->type === 'RSS Feed')
        <x-rss-feed :block='$block'></x-rss-feed>
    @endif
    @if(isset($block) && $block->type === 'Featured Youtube Video')      
        <x-featured-youtube-video :block='$block'></x-featured-youtube-video>
    @endif
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

@endsection
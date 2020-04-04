@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">@lang('minisite.editSite')</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('communityUpdate', ['community' => $community]) }}">
                        @csrf
                        @method('PUT')
                        <div class="form-group row">
                            <label for="title" class="col-md-4 col-form-label text-md-right">@lang('minisite.minisiteName')</label>

                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ $community->name }}" required autofocus>

                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="visibility" class="col-md-4 col-form-label text-md-right">@lang('minisite.selectVisibility')</label>
                            
                            <div class="col-md-6">
                                <select name="visibility" id="visibility" class="form-control @error('visibility') is-invalid @enderror" required autofocus>
                                    <option value="">--@lang('minisite.selectVisibility')--</option>
                                    @if ($community->visibility === 'community members')
                                        <option value="community members" selected='selected'>@lang('minisite.visibleTo.communityMembers')</option>
                                    @else
                                        <option value="community members">@lang('minisite.visibleTo.communityMembers')</option>
                                    @endif
                                    @if ($community->visibility === 'public')
                                        <option value="public" selected='selected'>@lang('minisite.visibleTo.public')</option>
                                    @else
                                        <option value="public">@lang('minisite.visibleTo.public')</option>
                                    @endif
                                </select>
                                @error('visibility')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    @lang('minisite.save')
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        @foreach ($community->blocks as $block )
            <div class="card">
                <div class="card-header">{{$block->name}}</div>
                <div class="card-body">
                    <div class="form-group row">
                        {{ $block->description }}
                    </div>
                </div>
                <div class="card-footer">
                    <a class="alert-info alert" href="{{ route('blockEdit', ['community'=>  $community, 'block' => $block]) }}">@lang('minisite.editBlock')</a>
                    <a 
                        class="alert-danger alert"
                        href="{{ route('blockDestroy', ['community'=>  $community, 'block' => $block]) }}"
                        onclick="return confirm('@lang('minisite.deleteBlockConfirmation')')">
                            @lang('minisite.deleteBlock')
                    </a>
                </div>
            </div>
        @endforeach
    </div>
    <div class="row justify-content-center">
        <div class="card-footer"><a href="{{ route('blockCreate', ['community'=>$community]) }}">@lang('minisite.addBlock')</a></div>
    </div>
</div>
@endsection

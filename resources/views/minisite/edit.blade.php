@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit your neighborhood site') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('minisiteUpdate', ['minisite' => $minisite]) }}">
                        @csrf
                        @method('PUT')
                        <div class="form-group row">
                            <label for="title" class="col-md-4 col-form-label text-md-right">{{ __('Title') }}</label>

                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ $minisite->title }}" required autofocus>

                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="visibility" class="col-md-4 col-form-label text-md-right">{{ __('Visibility') }}</label>
                            
                            <div class="col-md-6">
                                <select name="visibility" id="visibility" class="form-control @error('visibility') is-invalid @enderror" required autofocus>
                                    <option value="">--Please choose a visibility level--</option>
                                    @if ($minisite->visibility === 'neighbors')
                                        <option value="neighbors" selected='selected'>neighbors</option>
                                    @else
                                        <option value="neighbors">neighbors</option>
                                    @endif
                                    @if ($minisite->visibility === 'public')
                                        <option value="public" selected='selected'>public</option>
                                    @else
                                        <option value="public">public</option>
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
                                    {{ __('Save') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        @foreach ($minisite->blocks as $block )
            <div class="card">
                <div class="card-header">{{$block->name}}</div>
                <div class="card-body">
                    <div class="form-group row">
                        {{ $block->description }}
                    </div>
                </div>
                <div class="card-footer">
                    <a href="{{ route('blockEdit', ['minisite'=>  $minisite, 'block' => $block]) }}">Edit this block.</a>
                </div>
            </div>
        @endforeach
    </div>
    <div class="row justify-content-center">
        <div class="card-footer"><a href="{{ route('blockCreate', ['minisite'=>$minisite]) }}">Add a block to your site.</a></div>
    </div>
</div>
@endsection

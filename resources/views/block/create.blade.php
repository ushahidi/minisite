@extends('layouts.app')

@section('content')
<div class="container">

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Add a block to your site') }}</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('blockStore', ['minisite' => $minisite]) }}">
                        @csrf
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" required autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>

                            <div class="col-md-6">
                                <input id="description" type="text" class="form-control @error('description') is-invalid @enderror" name="description" required autofocus>

                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <block-types :types='@json($types)' :fields='@json($fields)'></block-types>

                        <div class="form-group row">
                            <label for="visibility" class="col-md-4 col-form-label text-md-right">{{ __('Visibility') }}</label>
                            
                            <div class="col-md-6">
                                <select name="visibility" id="visibility" class="form-control @error('visibility') is-invalid @enderror" required autofocus>
                                    <option value="">--Please choose a visibility level--</option>
                                    <option value="neighbors">neighbors</option>
                                    <option value="public">public</option>
                                </select>
                                @error('visibility')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="position" class="col-md-4 col-form-label text-md-right">{{ __('Position') }}</label>

                            <div class="col-md-6">
                                <input id="position" type="number" class="form-control @error('position') is-invalid @enderror" name="position" required autofocus>

                                @error('position')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="enabled[]" class="col-md-4 col-form-label text-md-right">{{ __('Enabled') }}</label>

                            <div class="col-md-6">
                                <input id="enabled" type="checkbox" class="form-control @error('enabled') is-invalid @enderror" name="enabled[]" required autofocus>

                                @error('enabled')
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
</div>                


@endsection 
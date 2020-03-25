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
                    <block-types :method='"PUT"' :block='@json($block)' :block-types='@json($types)' :block-fields='@json($fields)' :minisite-slug='@json($minisite->slug)'></block-types>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 
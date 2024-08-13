@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Show Post') }}</div>

                <div class="card-body">
                    <div class="row mb-3">
                        <label class="col-md-4 col-form-label text-md-end">{{ __('Title') }} : </label>

                        <div class="col-md-6">
                                {{$post->title}}
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-md-4 col-form-label text-md-end">{{ __('Content') }} : </label>

                        <div class="col-md-6">
                                {{$post->content}}
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-md-4 col-form-label text-md-end">{{ __('Author') }} : </label>

                        <div class="col-md-6">
                            {{$post->user->name}}
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
</div>
@endsection

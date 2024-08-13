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
                                {{ $post->title }}
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-md-4 col-form-label text-md-end">{{ __('Content') }} : </label>

                            <div class="col-md-6">
                                {{ $post->content }}
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-md-4 col-form-label text-md-end">{{ __('Author') }} : </label>

                            <div class="col-md-6">
                                {{ $post->user->name }}
                            </div>
                        </div>


                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="row my-3">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif
                </div>
                <div class="row my-3">
                    <h4>Diplsay comments</h4>
                    @foreach ($post->comments as $comment)
                        <article class="card bg-light my-1">
                            <header class="card-header border-0 bg-transparent d-flex align-items-center">
                                <div>
                                    <a class="fw-semibold text-decoration-none">{{ $comment->user->name }}</a>
                                    <span class="ms-3 small text-muted"> {{ $comment->created_at }}</span>
                                </div>

                            </header>
                            <div class="card-body py-2 px-3">
                                {{ $comment->content }}
                            </div>
                            <footer class="card-footer bg-white border-0 py-1 px-3">

                                <button type="button" class="btn btn-danger btn-sm text-decoration-none">
                                    Remove
                                </button>

                            </footer>
                        </article>
                    @endforeach
                </div>
                <div class="row my-3">
                    <h4>Add comment</h4>
                    <form method="post" action="{{ route('comments.store') }}">
                        @csrf
                        <div class="form-group">
                            <textarea class="form-control" name="content"></textarea>
                            <input type="hidden" name="post_id" value="{{ $post->id }}" />
                            <input type="hidden" name="user_id" value="{{ auth()->user()->id }}" />
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-success my-1" value="Add Comment" />
                        </div>
                    </form>

                </div>
            </div>
        </div>


    </div>
    </div>
@endsection

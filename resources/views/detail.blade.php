@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1>{{ $post->title }}</h1>
            <br>
            @can('edit_post')
                <a href="{{ route('edit', ['pk' => $post->id]) }}" class="btn btn-warning" role="button">{{ __('messages.edit') }}</a>
            @endcan
            @can('delete_post')
                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete-post">{{ __('messages.delete') }}</button>
                <div class="modal fade" id="delete-post">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">{{ __('messages.deletePost') }}</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                            {{ __('messages.warningDeletePost') }}
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('messages.cancel') }}</button>
                            <a href='{{ url("post/{$post->id}/delete") }}' class="btn btn-danger">{{ __('messages.deletePost') }}</a>
                        </div>
                      </div>
                    </div>
                </div>
            @endcan
            <div class="card">
                <div class="card-header"> {{ __('messages.by') }} <b><a href="{{ route('users.detail', ['pk' => $post->user->id]) }}">{{ $post->user->name }}</a></b> {{ __('messages.at') }} {{ $post->created_at }}</div>
                <div class="card-body">
                    {{ $post->body }}
                    @if ($post->image_url)
                        <img src="{{ asset('/storage/' . $post->image_url) }}" class="rounded aspectRatio" alt="Avatar" width="300" height="300">
                    @endif
                    <h5>{{ __('messages.topic') }}: <span class="badge badge-secondary">{{ $post->topic->name }}</span></h5>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <br>
            <div class="card">
                <div class="card-header">{{ __('messages.postComment') }}</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('commentate', ['pk' => $post->id]) }}">
                        {!! csrf_field() !!}
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('messages.comment') }}</label>

                            <div class="col-md-6">
                                <textarea id="body" class="form-control" name="body" rows="5" required></textarea>
                            </div>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('messages.send') }}
                                </button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <br>
            <h3>{{ __('messages.comments') }}({{ count($post->comments) }}):</h3>
            @if (count($post->comments) > 0)
                @foreach ($post->comments as $comment)

                    @can('delete_comment')
                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete-comment">{{ __('messages.delete') }}</button>
                        <div class="modal fade" id="delete-comment">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">{{ __('messages.deleteComment') }}</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
                                <div class="modal-body">
                                    {{ __('messages.warningDeleteComment') }}
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('messages.cancel') }}</button>
                                    <a href='{{ url("comment/{$comment->id}/delete") }}' class="btn btn-danger">{{ __('messages.deleteComment') }}</a>
                                </div>
                              </div>
                            </div>
                        </div>
                    @endcan

                    <div class="alert alert-secondary">
                        <b><a href="{{ route('users.detail', ['pk' => $comment->user->id]) }}">{{ $comment->user->name }}</a></b><br>
                        {{ $comment->body }}<br>
                        {{ $comment->created_at }}<br>
                    </div>
                @endforeach
            @else
                <div class="alert alert-info">
                    <h6>{{ __('messages.noComments') }}</h6>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

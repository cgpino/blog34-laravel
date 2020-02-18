@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">

        <div class="col-md-8">
            <h1>{{ $title }}</h1>
            <br>
            @if (count($posts) > 0)
                @foreach ($posts as $post)
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
                        <div class="card-header"><a href="{{ route('detail', ['pk' => $post->id]) }}"><b>{{ $post->title }}</b></a> {{ __('messages.by') }} <b><a href="{{ route('users.detail', ['pk' => $post->user->id]) }}">{{ $post->user->name }}</a></b> {{ __('messages.at') }} {{ $post->created_at }} | {{ __('messages.comments') }}: {{ count($post->comments) }}</div>
                        <div class="card-body">
                            {{ $post->body }}
                            @if ($post->image_url)
                                <img src="{{ asset('/storage/' . $post->image_url) }}" class="rounded aspectRatio" alt="Avatar" width="300" height="300">
                            @endif
                            <h5>{{ __('messages.topic') }}: <a href="{{ route('topic.detail', ['pk' => $post->topic->id]) }}" class="btn btn-secondary" role="button">{{ $post->topic->name }}</a></h5>
                        </div>
                    </div>
                    <br>
                @endforeach
                {{ $posts->links() }}
            @else
                <div class="alert alert-info">
                    <h6>{{ __('messages.noPosts') }}</h6>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ $title }}</div>
            
                <div class="card-body">
                    <form method="POST" enctype="multipart/form-data" action="{{ route('detail', ['pk' => $post->id]) }}">
                        {!! csrf_field() !!}

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('messages.title') }}</label>

                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control @error('name') is-invalid @enderror" name="title" value="{{ $post->title }}" required autocomplete="title" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="topic" class="col-md-4 col-form-label text-md-right">{{ __('messages.topic') }}</label>
                            <div class="col-md-6">
                                <select class="form-control" id="topic" name="topic" required>
                                    @foreach ($topics as $topic)
                                        @if ($post->topic_id == $topic->id)
                                            <option value="{{ $topic->id }}" selected>{{ $topic->name }}</option>
                                        @else
                                            <option value="{{ $topic->id }}">{{ $topic->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="image" class="col-md-4 col-form-label text-md-right">{{ __('messages.image') }}</label>
                            <div class="col-md-6">
                                <input type="file" class="form-control-file" name="image" id="image">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('messages.body') }}</label>

                            <div class="col-md-6">
                                <textarea id="body" class="form-control" name="body" rows="5" required>{{ $post->body }}</textarea>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-warning">
                                    {{ __('messages.edit') }}
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

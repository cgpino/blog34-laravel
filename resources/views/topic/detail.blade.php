@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1>{{ $title }}</h1>
            <br>
            @can('edit_topic')
                <a href="{{ route('topic.edit', ['pk' => $topic->id]) }}" class="btn btn-warning" role="button">{{ __('messages.edit') }}</a>
            @endcan
            @can('delete_topic')
                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete-topic">{{ __('messages.delete') }}</button>
                <div class="modal fade" id="delete-topic">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">{{ __('messages.deleteTopic') }}</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                            {{ __('messages.warningDeleteTopic') }}
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('messages.cancel') }}</button>
                            <a href='{{ url("topic/{$topic->id}/delete") }}' class="btn btn-danger">{{ __('messages.deleteTopic') }}</a>
                        </div>
                      </div>
                    </div>
                </div>
            @endcan
            <div class="card">
                <div class="card-header"><b>{{ $topic->name }}</b></div>
                <div class="card-body">
                    <div class="row">
                        <ul>
                            <li>{{ __('messages.name') }}: {{ $topic->name }}</li>
                            <li>
                                {{ __('messages.posts') }}:
                                @if (count($topic->posts) > 0)
                                    @foreach ($topic->posts as $post)
                                        <a href="{{ route('detail', ['pk' => $post->id]) }}">{{ $post->title }}</a>
                                    @endforeach
                                @else
                                    {{ __('messages.none') }}
                                @endif
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

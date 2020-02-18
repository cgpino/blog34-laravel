@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">

        <div class="col-md-8">
            <h1>{{ $title }}</h1>
            @if (count($topics) > 0)
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>{{ __('messages.topic') }}</th>
                            <th>{{ __('messages.actions') }}</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($topics as $topic)
                            <tr>
                                <td><a href="{{ route('topic.detail', ['pk' => $topic->id]) }}">{{ $topic->name }}</a></td>
                                @can('edit_topic')
                                    <td><a href="{{ route('topic.edit', ['pk' => $topic->id]) }}" class="btn btn-warning" role="button">{{ __('messages.edit') }}</a>
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
                                @endcan</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="alert alert-info">
                    <h6>{{ __('messages.noTopics') }}</h6>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

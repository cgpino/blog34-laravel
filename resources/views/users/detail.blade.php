@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1>{{ $title }}</h1>
            <br>
            <div class="card">
                <div class="card-header"><b>{{ $user->name }}</b></div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-2">
                            <img src="{{ $user->getGravatarAttribute() }}" class="rounded" alt="Avatar" width="100" height="100">
                        </div>
                        <div class="col-md-6">
                            <ul>
                                <li>{{ __('messages.name') }}: {{ $user->name }}</li>
                                <li>{{ __('messages.email') }}: {{ $user->email }}</li>
                                <li>{{ __('messages.registrationDate') }}: {{ $user->created_at }}</li>
                                <li>
                                    {{ __('messages.posts') }}:
                                    @if (count($user->posts) > 0)
                                        @foreach ($user->posts as $post)
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
</div>
@endsection

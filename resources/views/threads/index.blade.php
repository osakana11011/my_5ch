@extends('layouts.app')

@section('content')
    <a href="{{ route('threads.create') }}"><button class="btn btn-primary">スレッドを作成する</button></a>

    @foreach ($threads as $thread)
        <a href="{{ route('threads.show', $thread->id->value) }}" class="thread-panel__link">
            <div class="thread-panel">
                <div class="thread-panel__title">{{ $thread->title->value }}</div>
                <hr>
                <div class="thread-panel__content">{{ $thread->resList[0]->content->value }}</div>
                <div class="thread-panel__meta">
                    <span class="thread-panel__meta--item">{{ $thread->resList[0]->submitterName->value }}</span>
                    <span class="thread-panel__meta--item">{{ $thread->resList[0]->getFormattedPostedAt() }}</span>
                </div>
                <div class="thread-panel__meta">
                    <span class="thread-panel__meta--item"><i class="fa fa-comment" aria-hidden="true"></i> {{ count($thread->resList) }}</span>
                </div>
            </div>
        </a>
    @endforeach
@endsection

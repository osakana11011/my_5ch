@extends('layouts.app')

@section('content')
    @if (!empty(Auth::user()))
        <a href="{{ route('threads.create') }}"><button class="btn btn-primary">スレッドを作成する</button></a>
    @endif

    @foreach ($threads as $thread)
        <a href="{{ route('threads.show', $thread->id->value) }}" class="thread-panel__link">
            <div class="thread-panel">
                <div class="thread-panel__title">{{ $thread->title->value }}</div>
                <div class="category">
                    @foreach ($thread->categoryList as $category)
                        <span class="category__item">{{ $category->name->value }}</span>
                    @endforeach
                </div>
                <hr>
                <div class="thread-panel__content">{{ $thread->resList[0]->content->value }}</div>
                <div class="thread-panel__meta">
                    <span class="thread-panel__meta--item"><i class="fa fa-comment" aria-hidden="true"></i> {{ count($thread->resList) }}</span>
                </div>
                <div class="thread-panel__meta">
                    <span class="thread-panel__meta--item">{{ $thread->resList[0]->submitterName->getName() }}</span>
                    <span class="thread-panel__meta--item">{{ $thread->resList[0]->getFormattedPostedAt() }}</span>
                </div>
            </div>
        </a>
    @endforeach
@endsection

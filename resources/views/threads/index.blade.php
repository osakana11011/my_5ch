@extends('layouts.app')

@section('content')
    @auth
        <div class="create-thread">
            <a href="{{ route('threads.create') }}"><button class="btn btn-primary">スレッドを作成する</button></a>
        </div>
    @endauth

    <div class="search-box">
        <form action="{{ route('threads') }}" style="width: 100%;">
            <div class="search-box__form">
                <input name="q" type="text" class="form-control search-box__input" placeholder="検索未実装">
                <i class="fa fa-search search-box__icon" aria-hidden="true"></i>
            </div>
        </form>
    </div>

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

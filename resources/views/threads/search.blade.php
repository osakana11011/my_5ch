@extends('layouts.app')

@section('content')
    @auth
        <div class="create-thread">
            <a href="{{ route('threads.create') }}"><button class="btn btn-primary">スレッドを作成する</button></a>
        </div>
    @endauth

    <div class="search-box">
        <form action="{{ route('threads.search') }}" style="width: 100%;" method="GET">
            <div class="search-box__form">
                <input name="q" type="text" class="form-control search-box__input" placeholder="検索キーワード" value="{{ $q }}">
                <i class="fa fa-search search-box__icon" aria-hidden="true"></i>
            </div>
        </form>
    </div>

    @if (!empty($threads))
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
                    @foreach ($thread->resList as $res)
                        <div class="res">
                            <div class="res__header">
                                <span>{{ $res->submitterName->getName() }}</span>
                            <span>{{ $res->getFormattedPostedAt() }}</span>
                            </div>
                            <div class="res__content">
                                {{ $res->content->value }}
                            </div>
                        </div>
                    @endforeach
                </div>
            </a>
        @endforeach
    @else
        検索結果が見つかりませんでした。
    @endif
@endsection

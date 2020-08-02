@extends('layouts.app')

@section('content')
    <a href="/threads">スレッド一覧へ戻る</a>
    <div class="thread-title">{{ $thread->title->value }}</div>

    @if (!$thread->isEnablePostRes())
        <div class="caution">レスが{{ $thread->getMaxResNumber() }}件を超えています。これ以上書き込みはできません。</div>
    @endif

    <div class="category">
        @foreach ($thread->categoryList as $category)
            <span class="category__item">{{ $category->name->value }}</span>
        @endforeach
    </div>

    @foreach ($thread->resList as $i => $res)
        <div class="res">
            <div class="res__header">
            <span>{{ $i+1 }}</span>
                <span>{{ $res->submitterName->getName() }}</span>
            <span>{{ $res->getFormattedPostedAt() }}</span>
            </div>
            <div class="res__content">
                {{ $res->content->value }}
            </div>
        </div>
    @endforeach

    @if (!empty(Auth::user()) && $thread->isEnablePostRes())
        <div class="create-form">
            <div class="create-form__title">【スレッドに書き込む】</div>
            <form action="{{ route('threads.res.store', $thread->id->value) }}" method="POST">
                @csrf
                <div class="form-group create-form__item">
                    <label class="create-form__title">名前</label>
                    <input name="submitter_name" type="text" placeholder="名前(30文字以内)" class="form-control @error('submitter_name') is-invalid @enderror" maxlength="30">
                    @error('submitter_name')
                        <div class="invalid-feedback">{{ $errors->first('submitter_name') }}</div>
                    @enderror
                </div>

                <div class="form-group create-form__item">
                    <label class="create-form__title required">投稿内容</label>
                    <textarea name="content" type="text" placeholder="内容(3000文字以内)" rows="3" cols="30" class="form-control @error('content') is-invalid @enderror" maxlength="200"></textarea>
                    @error('content')
                        <div class="invalid-feedback">{{ $errors->first('content') }}</div>
                    @enderror
                </div>
                <input type="submit" class="btn btn-primary" value="書き込む">
            </form>
        </div>
    @endif
    @if (empty(Auth::user()))
        <div class="caution">スレッドにレスを投稿するには、ログインを行ってください。</div>
    @endif
@endsection

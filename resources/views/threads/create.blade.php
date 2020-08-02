@extends('layouts.app')

@section('content')
<a href="/threads">スレッド一覧へ戻る</a>

<div class="create-form">
    <form action="{{ route('threads.store') }}" method="POST">
        @csrf

        <div class="form-group create-form__item">
            <label class="create-form__title required">タイトル</label>
            <input name="title" class="form-control @error('title') is-invalid @enderror" type="text" placeholder="スレッドのタイトル(100文字以内)" maxlength="100">
            @error('title')
                <div class="invalid-feedback">{{ $errors->first('title') }}</div>
            @enderror
        </div>

        <div class="form-group create-form__item">
            <label class="create-form__title">カテゴリ</label>
            <textarea id="categories" name="categories" class="form-control"></textarea>
        </div>

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
        <input type="submit" class="btn btn-primary" value="作成">
    </form>
</div>
@endsection

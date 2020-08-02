@extends('layouts.app')

@section('content')
<div class="wrapper">
    <a href="/threads">スレッド一覧へ戻る</a>

    <div class="create-form">
        <form action="{{ route('threads.store') }}" method="POST">
            @csrf

            <div class="form-group create-form__item">
                <label class="create-form__title required">タイトル</label>
                <input name="title" class="form-control @error('title') is-invalid @enderror" type="text" placeholder="スレッドのタイトル" maxlength="30">
                @error('title')
                <div class="invalid-feedback">{{ $errors->first('title') }}</div>
                @enderror
            </div>
            <div class="form-group create-form__item">
                <div class="create-form__title">カテゴリ</div>
                <textarea id="categories" name="categories" class="form-control"></textarea>
            </div>
            <input type="submit" class="btn btn-primary" value="作成">
        </form>
    </div>
</div>
@endsection

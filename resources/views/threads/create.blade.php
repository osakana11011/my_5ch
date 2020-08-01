@extends('layouts.app')

@section('content')
<a href="/threads">一覧へ</a>
<form action="{{ route('threads.store') }}" method="POST">
    @csrf
    <input name="title" type="text" placeholder="スレッドのタイトル"><br>
    <textarea id="categories" name="categories"></textarea>
    <input type="submit" value="作成">
</form>
@endsection

@extends('layouts.app')

@section('content')
    <a href="/threads">一覧へ</a>
    <h1>{{ $thread->title->value }}</h1>

    @foreach ($thread->resList as $i => $res)
        <div class="res">
            <div class="res__header">
            <span>{{ $i+1 }}</span>
                <span>{{ $res->submitterName->value }}</span>
            <span>{{ $res->getFormattedPostedAt() }}</span>
            </div>
            <div class="res__content">
                {{ $res->content->value }}
            </div>
        </div>
    @endforeach

    <form action="{{ route('threads.res.store', $thread->id->value) }}" method="POST">
        @csrf
        <input name="submitter_name" type="text" placeholder="名前(省略可)"><br>
        <textarea name="content" type="text" placeholder="内容" rows="3" cols="30"></textarea><br>
        <input type="submit" value="書き込む">
    </form>
@endsection

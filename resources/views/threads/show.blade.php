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
@endsection

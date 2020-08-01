@extends('layouts.app')

@section('content')
    <a href="/threads">一覧へ</a>
    <h1>{{ $thread->title->value }}</h1>
@endsection

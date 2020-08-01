@extends('layouts.app')

@section('content')
<form action="{{ route('threads.store') }}" method="POST">
    @csrf
    <input name="title" type="text" placeholder="スレッドのタイトル">
    <input type="submit" value="作成">
</form>
@endsection

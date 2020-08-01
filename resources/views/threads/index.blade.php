@extends('layouts.app')

@section('content')
    <a href="{{ route('threads.create') }}">スレッドを作成する</a>
    <table>
        <tr><th>スレッド名</th></tr>
        @foreach ($threads as $thread)
            <tr><td>{{ $thread->title->value }}</td></tr>
        @endforeach
    </table>
@endsection

@extends('layout')

{{-- メインコンテンツ --}}
@section('contents')
        <h1>ユーザ登録</h1>
        @if ($errors->any())
            <div>
            @foreach ($errors->all() as $error)
                {{ $error }}<br>
            @endforeach
            </div>
        @endif
        <form action="/user/register" method="post">
            @csrf
            名前：<input type="text" name="name" value="{{ old('name') }}"><br>
            email：<input type="text" name="email" value="{{ old('email') }}"><br>
            パスワード：<input type="password" name="password"><br>
            <button class="btn btn-primary mb-3">登録する</button>
        </form>
    </body>
@endsection
@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
<div class="tabs">
    <a href="{{ route('home') }}">おすすめ</a>
    <a href="{{ route('home', ['tab' => 'mylist']) }}">マイリスト</a>
</div>

<div class="item-list">
@foreach($items as $item)
    <div class="item">
        <a href="{{ route('items.show', $item->id) }}">
            <img src="{{ asset($item->image_path) }}">
            <p>{{ $item->name }}</p>
        </a>
    </div>
@endforeach
</div>

<form class="form" action="/login" method="post">
    @csrf
    <div class="register__link">
        <a class="register__button-submit" href="/register">会員登録はこちら</a>
    </div>
</form>
@endsection

@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
    <p>商品一覧画面</p>

<form class="form" action="/login" method="post">
    @csrf
    <div class="register__link">
        <a class="register__button-submit" href="/register">会員登録はこちら</a>
    </div>

@endsection

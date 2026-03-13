@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/items.css') }}">
@endsection

@section('content')
<div class="item-detail">
    {{-- 商品メイン画像 --}}
    <div class="item-detail__image-wrapper">
        @if($item->image_path)
            <img src="{{ asset('storage/' . $item->image_path) }}" alt="{{ $item->name }}" class="item-detail__image">
        @else
            <img src="{{ asset('images/default-item.png') }}" alt="画像なし" class="item-detail__image">
        @endif
    </div>

    <div class="item-detail__content">
        {{-- 商品情報ヘッダー --}}
        <div class="item-detail__header">
            <h1 class="item-detail__name">{{ $item->name }}</h1>
            <p class="item-detail__brand">{{ $item->brand_name ?? 'ブランド名' }}</p>
            <p class="item-detail__price">¥{{ number_format($item->price) }}</p>
        </div>

        {{-- 購入ボタン --}}
        <div class="item-detail__action">
            <a href="{{ route('purchases.create', $item->id) }}" class="btn btn--danger btn--large">購入手続きへ</a>
        </div>

        {{-- 商品説明 --}}
        <div class="item-detail__description">
            <h3 class="item-detail__section-title">商品説明</h3>
            <div class="item-detail__text">{{ $item->description }}</div>
        </div>

        {{-- 商品メタ情報 --}}
        <div class="item-detail__meta">
            <dl class="item-detail__meta-list">
                <div class="item-detail__meta-item">
                    <dt>カテゴリー</dt>
                    <dd>{{ $item->categories->pluck('name')->join(', ') ?? '未分類' }}</dd>
                </div>
                <div class="item-detail__meta-item">
                    <dt>商品の状態</dt>
                    <dd>
                        @php $conditions = ['良好', '目立った傷や汚れなし', 'やや傷や汚れあり', '状態が悪い'] @endphp
                        {{ $conditions[$item->condition - 1] ?? '不明' }}
                    </dd>
                </div>
            </dl>
        </di

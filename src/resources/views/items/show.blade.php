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
            <p class="item-detail__brand">{{ $item->brand_name ?? 'ブランド名なし' }}</p>
            <p class="item-detail__price">¥{{ number_format($item->price) }}(税込)</p>
        </div>
        <div class="item-detail__meta-icons">
            <div class="item-detail__like">
                @if($item->user_id !== auth()->id())
                    @if(auth()->check() && $item->isLikedByAuthUser())
                        <form action="{{ route('items.unlike', $item->id) }}" method="POST" style="display: inline;">
                            @csrf @method('DELETE')
                            <button type="submit" class="like-btn">
                                <img src="{{ asset('images/' . rawurlencode('ハートロゴ_ピンク.png')) }}" width="30" height="30">
                            </button>
                        </form>
                    @else
                        <form action="{{ route('items.like', $item->id) }}" method="POST" style="display: inline;">
                            @csrf
                            <button type="submit" class="like-btn">
                                <img src="{{ asset('images/' . rawurlencode('ハートロゴ_デフォルト.png')) }}" width="30" height="30">
                            </button>
                        </form>
                    @endif
                    <span class="like-count">{{ $item->likes->count() }}</span>
                @else
                    <div class="like-owner">
                        <img src="{{ asset('images/' . rawurlencode('ハートロゴ_デフォルト.png')) }}" 
                            class="like-icon--disabled" width="30" height="30">
                        <span class="owner-message">あなたの出品商品です</span>
                        <span class="like-count">{{ $item->likes->count() }}</span>
                    </div>
                @endif
            </div>
            <div class="item-detail__comment">
                <img src="{{ asset('images/' . rawurlencode('ふきだしロゴ.png')) }}" width="30" height="30">
                <span class="comment-count">{{ $item->comments->count() }}</span>
            </div>
        </div>
        {{-- 購入ボタン --}}
        <div class="item-detail__action">
            @if($item->sold_flg)
                <span class="btn btn--disabled btn--large">売り切れました</span>
            @elseif($item->user_id === auth()->id())
                <span class="btn btn--disabled btn--large">あなたの出品商品です</span>
            @else
                <a href="{{ route('purchases.create', $item->id) }}" class="btn btn--danger btn--large">
                    購入手続きへ
                </a>
            @endif
        </div>

        {{-- 商品説明 --}}
        <div class="item-detail__description">
            <h3 class="item-detail__section-title">商品説明</h3>
            <div class="item-detail__text">{{ $item->description }}</div>
        </div>

        {{-- 商品情報 --}}
        <div class="item-detail__meta">
            <h3 class="item-detail__section-title">商品の情報</h3>
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
            <div class="comments-section">
                <h3 class="item-detail__section-title">
                    コメント（{{ $item->comments_count }}）
                </h3>
                @if($item->comments->isNotEmpty())
                    <div class="comments-list">
                        @foreach($item->comments->take(10)->reverse() as $comment)
                            <div class="comment-item">
                                <div class="comment-avatar">
                                    @if($comment->user->profile?->avatar_path)
                                        <img src="{{ asset('storage/' . $comment->user->profile->avatar_path) }}" 
                                            alt="{{ $comment->user->name ?? 'ユーザー' }}" 
                                            class="avatar">
                                    @else
                                        <div class="avatar-default">
                                            {{ mb_substr($comment->user->name ?? '名無し', 0, 1) }}
                                        </div>
                                    @endif
                                </div>
                                <div class="comment-content">
                                    <div class="comment-header">
                                        <span class="comment-author">{{ $comment->user->name ?? '名無し' }}</span>
                                        <span class="comment-date">
                                            {{ $comment->created_at->format('Y/m/d H:i') }}
                                        </span>
                                    </div>
                                    <p class="comment-text">{{ $comment->content }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p>まだコメントはありません。</p>
                @endif
                <form action="{{ route('items.comment', $item->id) }}" method="POST" class="item-comment-form">
                    @csrf
                    <div class="form__group">
                        <label for="content">商品へのコメント</label>
                        <textarea name="content" id="content" rows="3">{{ old('content') }}</textarea>
                        @error('content')
                            <div class="form__error">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form__button">
                        <button class="form__button-submit" type="submit">コメントを送信する</button>
                    </div>
                </form>
            </div>    
        </div>
    </div>
</div>
@endsection
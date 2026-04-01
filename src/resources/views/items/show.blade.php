@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/form.css') }}">
<link rel="stylesheet" href="{{ asset('css/show.css') }}">
@endsection

@section('content')
<div class="item-detail">

    <div class="item-detail__image-wrapper">
        @if($item->image_path)
            @if(Str::startsWith($item->image_path, ['http://', 'https://']))
                <img src="{{ $item->image_path }}" alt="{{ $item->name }}" class="item-detail__image">
            @else
                <img src="{{ asset('storage/' . $item->image_path) }}" alt="{{ $item->name }}" class="item-detail__image">
            @endif
        @else
            <img src="{{ asset('images/default-item.png') }}" alt="画像なし" class="item-detail__image">
        @endif
    </div>

    <div class="item-detail__content">

        <div class="item-detail__header">
            <h1 class="item-detail__name">{{ $item->name }}</h1>
            <p class="item-detail__brand">{{ $item->brand_name ?? 'ブランド名なし' }}</p>
            <p class="item-detail__price">{{ number_format($item->price) }}(税込)</p>
        </div>
        
        <div class="item-detail__meta-icons">
            <div class="item-detail__like">

                <div class="like-icon">
                    @if($item->user_id !== auth()->id())
                        @if(auth()->check() && $item->isLikedByAuthUser())
                            <form action="{{ route('items.unlike', $item->id) }}" method="POST">
                                @csrf @method('DELETE')
                                <button type="submit" class="like-button">
                                    <img src="{{ asset('images/' . rawurlencode('ハートロゴ_ピンク.png')) }}">
                                </button>
                            </form>
                        @else
                            <form action="{{ route('items.like', $item->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="like-button">
                                    <img src="{{ asset('images/' . rawurlencode('ハートロゴ_デフォルト.png')) }}">
                                </button>
                            </form>
                        @endif
                    @else
                        <img src="{{ asset('images/' . rawurlencode('ハートロゴ_デフォルト.png')) }}" class="like-icon--disabled">
                    @endif
                </div>

                <span class="like-count">{{ $item->likes->count() }}</span>

                <span class="like-message">
                    @if($item->user_id === auth()->id())
                        あなたの出品商品です
                    @endif
                </span>
            </div>

            <div class="item-detail__comment">
                <img src="{{ asset('images/' . rawurlencode('ふきだしロゴ.png')) }}" alt="コメント">
                <span class="comment-count">{{ $item->comments->count() }}</span>
            </div>
        </div>
        {{-- 購入ボタン --}}
        <div class="item-detail__action">
            @if($item->sold_flg)
                <span class="button button--disabled button--large">売り切れました</span>
            @elseif($item->user_id === auth()->id())
                <span class="button button--disabled button--large">あなたの出品商品です</span>
            @else
                <a href="{{ route('purchases.create', $item->id) }}" class="button button--danger button--large">
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
                    <dd class="item-detail__categories">
                        @forelse($item->categories as $category)
                            <span class="category-tag">{{ $category->name }}</span>
                        @empty
                            <span>未分類</span>
                        @endforelse
                    </dd>
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
                                <div class="comment-header">
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

                                    <span class="comment-author">{{ $comment->user->name ?? '名無し' }}</span>
                                </div>
                                <p class="comment-text">{{ $comment->content }}</p>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p>まだコメントはありません。</p>
                @endif
                <form action="{{ route('items.comment', $item->id) }}" method="POST" class="form item-comment-form">
                    @csrf

                    <div class="form__group">
                        <div class="form__group-title">
                            <span class="form__label--item">商品へのコメント</span>
                        </div>

                        <div class="form__group-content">
                            <div class="form__input--textarea">
                                <textarea name="content" id="content" rows="4">{{ old('content') }}</textarea>
                            </div>

                            @error('content')
                                <div class="form__error">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form__button">
                        <button class="form__button-submit" type="submit">
                            コメントを送信する
                        </button>
                    </div>
                </form>
            </div>    
        </div>
    </div>
</div>
@endsection
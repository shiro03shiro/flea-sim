@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
<link rel="stylesheet" href="{{ asset('css/profile.css') }}">
@endsection

@section('content')
<div class="profile-show">
    <div class="profile-header">
        @if(isset($profile) && !empty($profile->avatar_path))
            <img src="{{ asset('storage/' . $profile->avatar_path) }}" alt="プロフィール画像" class="profile-avatar" />
        @else
            <img src="{{ asset('images/default-avatar.png') }}" alt="プロフィール画像" class="profile-avatar" />
        @endif
        <h2>{{ $user->name }}</h2>
        <a href="{{ route('profile.edit') }}" class="edit__button">プロフィール編集</a>
    </div>
    <div class="tabs">
        <a href="{{ route('profile.show', ['page' => 'sell']) }}" class="tab {{ $page !== 'buy' ? 'tab--active' : '' }}">出品した商品</a>
        <a href="{{ route('profile.show', ['page' => 'buy']) }}" class="tab {{ $page === 'buy' ? 'tab--active' : '' }}">購入した商品</a>
    </div>
    @if($page === 'buy' && isset($purchasedItems))
        <div class="items-grid">
            @forelse($purchasedItems as $purchase)
                <div class="item-card">
                    <a href="{{ route('items.show', $purchase->item->id) }}" class="item-card__link">
                        <div class="item-card__image-wrapper">
                            @if($purchase->item->image_path)
                                @if(Str::startsWith($purchase->item->image_path, ['http://', 'https://']))
                                    <img src="{{ $purchase->item->image_path }}" alt="{{ $purchase->item->name }}" class="item-card__image">
                                @else
                                    <img src="{{ asset('storage/' . $purchase->item->image_path) }}" alt="{{ $purchase->item->name }}" class="item-card__image">
                                @endif
                            @else
                                <img src="{{ asset('images/default-item.png') }}" alt="画像なし" class="item-card__image">
                            @endif
                            @if($purchase->item->sold_flg)
                                <span class="sold-badge">SOLD</span>
                            @endif
                        </div>
                        <div class="item-card__body">
                            <p class="item-card__name">{{ $purchase->item->name }}</p>
                        </div>
                    </a>
                </div>
            @empty
                <p class="empty-state">購入履歴がありません</p>
            @endforelse
        </div>
        
    @else
        <div class="items-grid">
            @forelse($soldItems as $item)
                <div class="item-card">
                    <a href="{{ route('items.show', $item->id) }}" class="item-card__link">
                        <div class="item-card__image-wrapper">
                            @if($item->image_path)
                                @if(Str::startsWith($item->image_path, ['http://', 'https://']))
                                    <img src="{{ $item->image_path }}" alt="{{ $item->name }}" class="item-card__image">
                                @else
                                    <img src="{{ asset('storage/' . $item->image_path) }}" alt="{{ $item->name }}" class="item-card__image">
                                @endif
                            @else
                                <img src="{{ asset('images/default-item.png') }}" alt="画像なし" class="item-card__image">
                            @endif
                            @if($item->sold_flg)
                                <span class="sold-badge">SOLD</span>
                            @endif
                        </div>
                        <div class="item-card__body">
                            <p class="item-card__name">{{ $item->name }}</p>
                        </div>
                    </a>
                </div>
            @empty
                <p class="empty-state">出品商品がありません</p>
            @endforelse
        </div>
    @endif
</div>
@endsection
@extends('layouts.app')

@section('content')
<div class="profile-show">
    <div class="profile-header">
        <img src="{{ $user->avatar_path
            ? asset('storage/' . $user->avatar_path)
            : asset('images/default-avatar.png') }}"
            alt="プロフィール画像" class="profile-avatar" />
        <h2>{{ $user->name }}</h2>
        <a href="{{ route('profile.edit') }}" class="edit-btn">プロフィール編集</a>
    </div>
    <div class="items-section">
        <h3>出品した商品</h3>
        <div class="items-grid">
            @forelse($soldItems as $item)
                <div class="item-card">
                    @if($item->image_path)
                        <img src="{{ asset('storage/' . $item->image_path) }}" alt="{{ $item->name }}" />
                    @else
                        <img src="{{ asset('images/default-item.png') }}" alt="画像なし" />
                    @endif
                    <p>{{ $item->name }}</p>
                    <span class="category">{{ $item->category->name ?? '' }}</span>
                    <span class="price">{{ number_format($item->sold_price) }}円</span>
                </div>
            @empty
                <p>出品商品がありません</p>
            @endforelse
        </div>
    </div>
    <div class="items-section">
        <h3>購入した商品</h3>
        <div class="items-grid">
            @forelse($purchasedItems as $purchase)
                <div class="item-card">
                    @if($purchase->item->image_path)
                        <img src="{{ asset('storage/' . $purchase->item->image_path) }}" alt="{{ $purchase->item->name }}" />
                    @else
                        <img src="{{ asset('images/default-item.png') }}" alt="画像なし" />
                    @endif
                    <p>{{ $purchase->item->name }}</p>
                    <span class="category">{{ $purchase->item->category->name ?? '' }}</span>
                </div>
            @empty
                <p>購入履歴がありません</p>
            @endforelse
        </div>
    </div>
</div>
@endsection

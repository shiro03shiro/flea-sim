@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
<div class="items-index">

    {{-- タブメニュー --}}
    <div class="items-index__tabs">
        <a 
            href="{{ route('home') }}"
            class="items-index__tab-link {{ $tab !== 'mylist' ? 'items-index__tab-link--active' : '' }}"
        >
            おすすめ
        </a>

        <a 
            href="{{ route('home', ['tab' => 'mylist']) }}"
            class="items-index__tab-link {{ $tab === 'mylist' ? 'items-index__tab-link--active' : '' }}"
        >
            マイリスト
        </a>
    </div>

    {{-- 商品一覧 --}}
    <div class="items-index__list">
        @forelse ($items as $item)
            <div class="item-card">
                <a href="{{ route('items.show', $item->id) }}" class="item-card__link">

                    @if($item->image_path)
                        <img 
                            src="{{ asset('storage/' . $item->image_path) }}" 
                            alt="{{ $item->name }}" 
                            class="item-card__image"
                        >
                    @else
                        <img 
                            src="{{ asset('images/default-item.png') }}" 
                            alt="画像なし" 
                            class="item-card__image--default"
                        >
                    @endif

                    <div class="item-card__body">
                        <p class="item-card__name">{{ $item->name }}</p>
                        @if($item->brand_name)
                            <p class="item-card__brand">{{ $item->brand_name }}</p>
                        @endif
                        @if($item->price)
                            <p class="item-card__price">¥{{ number_format($item->price) }}</p>
                        @endif
                    </div>

                </a>
            </div>
        @empty
            <p class="items-index__empty">
                {{ $tab === 'mylist' ? 'マイリストに商品がありません。' : '現在おすすめ商品はありません。' }}
            </p>
        @endforelse
    </div>
</div>
@endsection

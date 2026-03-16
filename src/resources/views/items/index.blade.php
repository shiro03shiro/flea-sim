@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
<div class="items-index">

    {{-- タブメニュー --}}
    <div class="items-index__tabs">
        <a href="{{ route('home') }}" class="@class(['tab-link','tab-link--active' => $tab !== 'mylist'])">おすすめ</a>
        <a href="{{ route('home', ['tab' => 'mylist']) }}" class="@class(['tab-link', 'tab-link--active' => $tab === 'mylist'])">マイリスト</a>
    </div>

    {{-- 商品一覧 --}}
    <div class="items-index__list">
        @forelse ($items as $item)
            <div class="item-card">
                <a href="{{ route('items.show', $item->id) }}" class="item-card__link">
                    <div class="item-card__image-wrapper">
                        @if($item->image_path)
                            <img src="{{ asset('storage/' . $item->image_path) }}" alt="{{ $item->name }}" class="item-card__image">
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
            <p class="items-index__empty">
                {{ $tab === 'mylist' ? 'マイリストに商品がありません。' : '現在おすすめ商品はありません。' }}
            </p>
        @endforelse
    </div>
    @if($items->lastPage() > 1)
    <div class="pagination">
        @if(!$items->onFirstPage())
            <a href="{{ $items->previousPageUrl() }}" class="pagination-link">« 前</a>
        @endif

        @foreach($items->getUrlRange(1, $items->lastPage()) as $page => $url)
            @if($page == $items->currentPage())
                <span class="pagination-current">{{ $page }}</span>
            @else
                <a href="{{ $url }}" class="pagination-link">{{ $page }}</a>
            @endif
        @endforeach

        @if($items->hasMorePages())
            <a href="{{ $items->nextPageUrl() }}" class="pagination-link">次 »</a>
        @endif
    </div>
    <div class="pagination-info">
        {{ $items->currentPage() }} / {{ $items->lastPage() }}ページ
    </div>
    @endif
</div>
@endsection

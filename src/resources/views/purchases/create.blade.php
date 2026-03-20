@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/purchases.css') }}">
@endsection

@section('content')
<div class="purchase-container">

    {{-- 左側 --}}
    <div class="purchase-left">
        {{-- 商品概要 --}}
        <div class="purchase__item-summary">
            <div class="purchase__item-image-wrapper">
                <img src="{{ asset('storage/' . $item->image_path) }}" alt="{{ $item->name }}" class="purchase__item-image">
            </div>
            <div class="purchase__item-info">
                <h2 class="purchase__item-name">{{ $item->name }}</h2>
                <p class="purchase__item-price">¥{{ number_format($item->price) }}</p>
            </div>
        </div>

        {{-- 購入フォーム開始 --}}
        <form id="purchase_form" class="purchase__form" action="{{ route('purchases.store', $item->id) }}" method="POST">
            @csrf
            <input type="hidden" name="item_id" value="{{ $item->id }}">

            {{-- 支払い方法 --}}
            <div class="form__group">
                <h3 class="form__group-title">支払い方法</h3>
                <div class="form__group-content">
                    <div class="form__input--select">
                        <select name="payment_method" id="payment_method" required>
                            <option value="" disabled selected>選択してください</option>
                            <option value="1">カード支払い</option>
                            <option value="2">コンビニ払い</option>
                        </select>
                    </div>
                    <div class="form__error">
                        @error('payment_method') {{ $message }} @enderror
                    </div>
                </div>
            </div>

            {{-- 配送先 --}}
            <div class="form__group">
                <h3 class="form__group-title">配送先</h3>
                <div class="form__group-content">
                    <div class="purchase__shipping-address">
                        @php $profile = auth()->user()->profile; @endphp
                        <p>〒{{ $profile->postal_code ?? '' }}</p>
                        <p>{{ $profile->address ?? '' }} {{ $profile->building ?? '' }}</p>
                    </div>
                    <a href="{{ route('purchases.edit', $item->id) }}?redirect_to={{ urlencode(route('purchases.create', $item->id)) }}" class="btn btn--link">配送先を変更する</a>
                </div>
            </div>
        </form>
    </div>

    {{-- 右側：購入サマリー --}}
    <div class="purchase-right">
        <div class="purchase__summary">
            <div class="purchase__summary-row">
                <span>商品代金</span>
                <span>¥{{ number_format($item->price) }}</span>
            </div>
            <div class="purchase__summary-row">
                <span>支払い方法</span>
                <span id="selected-payment">—</span>
            </div>
        </div>

        {{-- 購入ボタン --}}
        <div class="form__button">
            <button class="btn btn--danger btn--large" type="submit" form="purchase_form">購入する</button>
        </div>
    </div>

</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const select = document.getElementById('payment_method');
        const display = document.getElementById('selected-payment');

        if (!select || !display) return;

        const updateDisplay = () => {
            const value = select.value;
            const displayText = value === '1' ? 'カード支払い' : 
                            value === '2' ? 'コンビニ払い' : '—';
            display.textContent = displayText;
        };

        updateDisplay();

        select.addEventListener('change', updateDisplay);
    });
</script>
@endsection


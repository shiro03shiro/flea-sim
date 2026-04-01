@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/form.css') }}">
<link rel="stylesheet" href="{{ asset('css/address.css') }}">
@endsection

@section('content')
<div class="form-container address-form__content">
    <div class="address-form__heading">
        <h2>住所の変更</h2>
    </div>

    <form class="form" action="{{ route('purchases.update', $item->id) }}" method="post">
        @method('PATCH')
        @csrf

        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">郵便番号</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--text">
                <input type="text" name="postal_code" value="{{ old('postal_code', $profile->postal_code ?? '') }}" />
                </div>
                <div class="form__error">
                @error('postal_code')
                {{ $message }}
                @enderror
                </div>
            </div>
        </div>

        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">住所</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--text">
                <input type="text" name="address" value="{{ old('address', $profile->address ?? '') }}" />
                </div>
                <div class="form__error">
                @error('address')
                {{ $message }}
                @enderror
                </div>
            </div>
        </div>

        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">建物名</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--text">
                <input type="text" name="building" value="{{ old('building', $profile->building ?? '') }}" />
                </div>
                <div class="form__error">
                @error('building')
                {{ $message }}
                @enderror
                </div>
            </div>
        </div>
        <input type="hidden" name="redirect_to" value="{{ request()->get('redirect_to', '') }}">

        <div class="form__button">
            <button class="form__button-submit" type="submit">更新する</button>
        </div>
    </form>
</div>
@endsection

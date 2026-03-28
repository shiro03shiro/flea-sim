@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/items.css') }}">
@endsection

@section('content')
<div class="item-form__content">
    <div class="item-form__heading">
        <h2>商品の出品</h2>
    </div>
    <form class="form" action="{{ route('items.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">商品画像</span>
            </div>
            <div class="form__group-content item__image-area">
                <div class="item__image-preview">
                    <img id="preview" src="{{ asset('images/no-image.png') }}" alt="商品画像">
                </div>
                <div class="form__input--file">
                    <input type="file" id="image_path" name="image_path" accept="image/*" onchange="previewImage(event)">
                    <label for="image_path" class="file__button">画像を選択する</label>
                </div>
                <div class="form__error">
                    @error('image_path')
                    {{ $message }}
                    @enderror
                </div>
            </div>
        </div>
        <div class="form__section">
            <h3 class="form__section-title">商品の詳細</h3>
        </div>
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">カテゴリー</span>
            </div>
            <div class="form__group-content">
                <div class="category__button-list">
                    @foreach($categories as $category)
                    <label class="category__button">
                        <input type="checkbox" name="category_id[]" value="{{ $category->id }}" {{ in_array($category->id, old('category_id', [])) ? 'checked' : '' }}>
                        <span>{{ $category->name }}</span>
                    </label>
                    @endforeach
                </div>
                <div class="form__error">
                    @error('category_id')
                    {{ $message }}
                    @enderror
                </div>
            </div>
        </div>
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">商品の状態</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--select">
                    <select name="condition">
                        <option value="">選択してください</option>
                        <option value="1" {{ old('condition') == 1 ? 'selected' : '' }}>良好</option>
                        <option value="2" {{ old('condition') == 2 ? 'selected' : '' }}>目立った傷や汚れなし</option>
                        <option value="3" {{ old('condition') == 3 ? 'selected' : '' }}>やや傷や汚れあり</option>
                        <option value="4" {{ old('condition') == 4 ? 'selected' : '' }}>状態が悪い</option>
                    </select>
                </div>
                <div class="form__error">
                    @error('condition')
                    {{ $message }}
                    @enderror
                </div>
            </div>
        </div>
        <div class="form__section">
            <h3 class="form__section-title">商品名と説明</h3>
        </div>
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">商品名</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--text">
                    <input type="text" name="name" value="{{ old('name') }}">
                </div>
                <div class="form__error">
                    @error('name')
                    {{ $message }}
                    @enderror
                </div>
            </div>
        </div>
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">ブランド名</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--text">
                    <input type="text" name="brand_name" value="{{ old('brand_name') }}">
                </div>
            </div>
        </div>
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">商品の説明</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--textarea">
                    <textarea name="description" rows="5">{{ old('description') }}</textarea>
                </div>
                <div class="form__error">
                    @error('description')
                    {{ $message }}
                    @enderror
                </div>
            </div>
        </div>
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">販売価格</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--price">
                    <span class="price__mark">¥</span>
                    <input type="text" name="price" value="{{ old('price') }}">
                </div>
                <div class="form__error">
                    @error('price')
                    {{ $message }}
                    @enderror
                </div>
            </div>
        </div>
        <div class="form__button">
            <button class="form__button-submit" type="submit">
                出品する
            </button>
        </div>
    </form>
</div>
@endsection
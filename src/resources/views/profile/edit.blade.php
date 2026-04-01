@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/form.css') }}">
<link rel="stylesheet" href="{{ asset('css/profile.css') }}">
@endsection

@section('content')
<div class="form-container profile-form__content">
    <div class="profile-form__heading">
        <h2>プロフィール設定</h2>
    </div>

    <form class="form" action="{{ route('profile.update') }}" method="post" enctype="multipart/form-data">
        @method('PATCH')
        @csrf

        <div class="form__group">
            <div class="form__group-image">
                <div class="profile__image-area">
                    <div class="form__group-content">
                        <div class="profile__image-preview">
                            @if(@isset($profile) && !empty($profile->avatar_path))
                                <img src="{{ asset('storage/' . $profile->avatar_path) }}" alt="プロフィール画像" class="profile-avatar"/>
                            @else
                                <img src="{{ asset('images/default-avatar.png') }}" alt="プロフィール画像" class="profile-avatar"/>
                            @endif
                        </div>
                        <div class="form__input--file js-file-input">
                            <input type="file" id="avatar_path" name="avatar_path" accept="image/*" onchange="previewImage(event)">
                            <label for="avatar_path" class="file__button">画像を選択する</label>
                            <span class="file__status"></span>
                        </div>
                        <div class="form__error">
                            @error('avatar_path')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">ユーザー名</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--text">
                <input type="text" name="name" value="{{ old('name', $user->name) }}" />
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
            </div>
            <div class="form__error">
                @error('building')
                {{ $message }}
                @enderror
                </div>
        </div>

        <div class="form__button">
            <button class="form__button-submit" type="submit">更新する</button>
        </div>
    </form>
</div>

<script>
    document.querySelectorAll('.js-file-input input').forEach(input => {
        input.addEventListener('change', function () {
            const wrapper = this.closest('.js-file-input');
            wrapper.classList.add('is-selected');

            const status = wrapper.querySelector('.file__status');
            status.textContent = "✔ 画像が選択されました";
        });
    });
</script>
@endsection

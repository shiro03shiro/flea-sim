<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>COACHTECH</title>
  <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
  <link rel="stylesheet" href="{{ asset('css/common.css') }}">
  @yield('css')
</head>

<body>
  <header class="header">
    <div class="header__inner">
      <div class="header__content">
        <a class="header__logo" href="/">
          <img src="{{ asset('images/COACHTECHヘッダーロゴ.png') }}" alt="COACHTECH">
        </a>
        @if (! in_array(Route::currentRouteName(), ['login', 'register']))
          <form class="header__search" action="{{ route('home') }}" method="GET">
            <input class="header__search-input" type="text" name="keyword" value="{{ request('keyword') }}" placeholder="なにをお探しですか？">
            <button class="header__search-button" type="submit">検索</button>
          </form>

          <nav class="header__nav">
            <ul class="header__list">
              @if (Auth::check())
                <li class="header__item">
                  <form class="form" action="/logout" method="post">
                    @csrf
                    <button class="header__button">ログアウト</button>
                  </form>
                </li>
                <li class="header__item">
                  <a class="header__link" href="/mypage">マイページ</a>
                </li>
                <li class="header__item">
                  <a class="header__link" href="/sell">出品</a>
                </li>
              @else
                <li class="header__item">
                    <a class="header__link" href="/login">ログイン</a>
                </li>
                <li class="header__item">
                  <a class="header__link" href="/mypage">マイページ</a>
                </li>
                <li class="header__item">
                  <a class="header__link" href="/sell">出品</a>
                </li>
              @endif
            </ul>
          </nav>
        @endif
      </div>
    </div>
  </header>

  <main>
    @yield('content')
  </main>
</body>

</html>

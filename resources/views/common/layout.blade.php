<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>@yield('title', 'Home')</title>
  <link rel="stylesheet" href="/css/styles.css">        
</head>
<body>
<!-- Header -->
<header>
  <nav class="my-navbar">
    <a class="my-navbar-brand" href="/">ToDo App</a>
    <div class="my-navbar-control">
      @if(Auth::check())
        <span class="my-navbar-item">ようこそ, {{ Auth::user()->name }}さん</span>
        ｜
        <a class="dropdown-item" href="{{ route('logout') }}"
            onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
            {{ __('Logout') }}
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
      @else
        <a class="my-navbar-item" href="{{ route('login') }}">ログイン</a>
        ｜
        <a class="my-navbar-item" href="{{ route('register') }}">会員登録</a>
      @endif
    </div>
  </nav>
</header>

<main>
    <div class="container">
        @yield('content')
    </div>
</main>
<footer>
    <!-- @if(Auth::check())
        <script>
            document.getElementById('logout').addEventListener('click', function(event) {
            event.preventDefault();
            document.getElementById('logout-form').submit();
            });
        </script>
     @endif -->
    @section('footer')
        <!-- 共通のscript -->
    @show
</footer>
</body>
</html>
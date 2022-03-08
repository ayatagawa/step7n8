<!DOCTYPE HTML>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="/css/app.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="/js/app.js" defer></script>
    <script src="/js/alart.js"></script>
    
</head>
<body>
    <header>
      @include('header')
    </header>
    <br>
    <div class="container">
      @yield('content') 
    </div>
    <footer class="footer bg-dark  fixed-bottom">
      @include('footer')
    </footer>
</body>
</html>
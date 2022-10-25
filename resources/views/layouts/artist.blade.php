<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- CSS -->
    <style>

    </style>


</head>
<body>
    <!-- ヘッダー -->
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/home') }}">
                    Penet
                    <!-- {{ config('app.name', 'Laravel') }} -->
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>



                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>
                    <div class="d-flex justify-content-end">
                    </div>
                        <form action="{{route('search.musics')}}" method="post" class="row mb-3">
                            @csrf
                            <select class="form-select" aria-label="Default select example" name="jenre">
                                <option value="default"></option>
                                <option value="R&B">R&B</option>
                                <option value="clubmusic">クラブミュージック</option>
                                <option value="jazz">ジャズ</option>
                                <option value="classic">クラシック</option>
                                <option value="hiphop">ヒップホップ</option>
                                <option value="rock">ロック</option>
                                <option value="pops">ポップス</option>
                                <option value="edm">EDM</option>
                                <option value="electro">エレクトロ</option>
                                <option value="reggae">レゲエ</option>
                                <option value="country">カントリー</option>
                                <option value="inst">インストゥルメンタル</option>
                                <option value="hevey">ヘヴィ・メタル</option>
                            </select>
                            <button type="submit" class="btn btn-primary">検索</button>
                        </form>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                       <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                メニュー <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                                <!-- マイページへ -->
                                <div class='d-flex justify-content-center mt-3'>
                                    <a href="{{ route('artist.mypage',['id' => Auth::user()->id]) }}">
                                        <button class='btn btn-secondary mx-5'>マイページ</button>
                                                                    <!-- ↑マージン左右5pxずらしている -->
                                    </a>
                                </div>

                                <!-- 曲の投稿画面へ -->
                                <div class='d-flex justify-content-center mt-3'>
                                    <a href="{{ route('post.music',['id' => Auth::user()->id]) }}">
                                
                                        <button class='btn btn-secondary mx-5'>曲を投稿する</button>
                                                                    <!-- ↑マージン左右5pxずらしている -->
                                    </a>
                                </div>

                                <!-- 曲の一覧画面へ -->
                                <div class='d-flex justify-content-center mt-3'>
                                    <a href="{{ route('music.list',['id' => Auth::user()->id]) }}">
                                        <button class='btn btn-secondary mx-5'>MySong一覧</button>
                                                                    <!-- ↑マージン左右5pxずらしている -->
                                    </a>
                                </div>

                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                    {{ __('ログアウト') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                            
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
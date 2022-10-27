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
    <script src="{{ asset('js/like.js') }}" defer></script>
    <script src="{{ asset('js/follow.js') }}" defer></script>
    <script src="{{ asset('js/image.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- CSS -->
    <style>
        .topimage-music {
            text-align:  center;    /* 文字中央寄せ */
            /* padding:  150px;        余白指定 */
            padding:  10%;
            border: solid 2px;      /* 枠線指定 */
            position: relative;
            background-image: url(image/musichome.jpeg);
        }
        .myimage-music {
            text-align:  center;    /* 文字中央寄せ */
            /* padding:  150px;        余白指定 */
            padding:  0%;
            border: solid 2px;      /* 枠線指定 */
            position: relative;
            background-image: url(image/musichome.jpeg);
        }

        .top-font{
            position: absolute;
            top: 4%;
            left:45%;
            font-size:5vw;
            color: white;
            padding:0;
            margin:0;
            -webkit-text-stroke: 1px black; /* webkitのベンダープレフィックス */
            text-stroke: 1px black;    
        }
       
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
                </div>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                       <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                メニュー<span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                                <!-- マイページへ -->
                                <div class='d-flex justify-content-center mt-3'>
                                    <a href="{{ route('id.show',['id' => Auth::user()->id]) }}">
                                
                                        <button class='btn btn-secondary mx-5'>マイページ</button>
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
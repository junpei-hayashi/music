<!-- 画像の変更を行ったらここにフラッシュメッセージが出る -->
@if (Session::has('message'))
    <p>{{ session('message') }}</p>
@endif
<!-- 画像の変更を行ったらここにフラッシュメッセージが出る -->

@extends('layouts.auth')

@section('content')
    <p>マイページ</p>
    <p>名前:{{ $my_user->name }}</p>
    <p>メールアドレス:{{ $my_user->email }}</p>
    <p>プロフィール画像:{{ $my_user->user_image }}</p>

    @if (Session::has('top_image_pass'))
        <img src="{{ asset('/storage/top_file') }}/{{ session('top_image_pass') }}" alt=""> 

    @elseif ($my_user->user_image == "/def_img/noimage.png")
        <p><img src="{{ $my_user->user_image }}" alt=""> </p>

    @else
        <p><img src="{{ asset('/storage/top_file') }}/{{ $my_user->user_image }}" alt=""> </p>

    @endif

    <!-- ここから各種変更 -->
    <div class='d-flex justify-content-center seting'>

        <!-- ここからアーティスト登録 -->
        <div class='d-flex justify-content-center artist'>
            <a href="{{ route('id.edit',['id' => Auth::user()->id]) }}">
                <button class='btn btn-secondary mx-5'>アーティスト登録</button>
                                            <!-- ↑マージン左右5pxずらしている -->
            </a>
        </div>
        <!-- ここまでアーティスト登録 -->

        <!-- ここから編集 -->
        <div class='d-flex justify-content-center edit'>
            <a href="{{ route('id.edit',['id' => Auth::user()->id]) }}">
                <button class='btn btn-secondary mx-5'>編集</button>
                                            <!-- ↑マージン左右5pxずらしている -->
            </a>
        </div>
        <!-- ここまで編集 -->
    </div>

@endsection

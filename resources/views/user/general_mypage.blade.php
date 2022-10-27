
@extends('layouts.general')

@section('content')

<!-- 画像の変更を行ったらここにフラッシュメッセージが出る -->
@if (Session::has('message'))
    <p>{{ session('message') }}</p>
@endif
<!-- 画像の変更を行ったらここにフラッシュメッセージが出る -->
<!-- <div class="top-page"> -->

        

<div class="top-mypagedetail">
    <div class='d-flex justify-content-center mypage'>
        <div class='profile'>
            <div class='container-fluid mt-50'>
                <h1>マイページ</h1>
            </div>
            <p>名前:{{$my_user->name}}</p>
            <p>メールアドレス:{{ $my_user->email }}</p>
            <p>プロフィール画像:{{ $my_user->user_image }}</p>

            @if (Session::has('top_image_pass'))
                <img src="{{ asset('/storage/top_file') }}/{{ session('top_image_pass') }}" alt=""> 

            @elseif ($my_user->user_image == "/def_img/noimage.png")
                <p><img src="{{ $my_user->user_image }}" alt=""> </p>

            @else
                <p><img src="{{ asset('/storage/top_file') }}/{{ $my_user->user_image }}" alt=""> </p>

            @endif
        </div>

        <div class='like'>
            
        </div>
    </div>


    <!-- ここから各種変更 -->
    <div class='d-flex justify-content-center seting'>

        <!-- ここからtopに戻る -->
        <form action="{{route('home')}}">
            <div class='d-flex justify-content-center artist'>
                <a href="">
                    <button class='btn btn-secondary mx-5'>TOPに戻る</button>
                                                <!-- ↑マージン左右5pxずらしている -->
                </a>
            </div>
        </form>
        <!-- ここまでtopに戻る -->

        <!-- ここから編集 -->
        <div class='d-flex justify-content-center edit'>
            <a href="{{ route('id.edit',['id' => Auth::user()->id]) }}">
                <button class='btn btn-secondary mx-5'>編集</button>
                                            <!-- ↑マージン左右5pxずらしている -->
            </a>
        </div>
        <!-- ここまで編集 -->

        <!-- ここからアーティスト登録 -->
        <div class='d-flex justify-content-center artist'>
            <a href="{{ route('artist.up',['id' => Auth::user()->id]) }}">
                <button class='btn btn-secondary mx-5'>アーティスト登録</button>
                                            <!-- ↑マージン左右5pxずらしている -->
            </a>
        </div>
        <!-- ここまでアーティスト登録 -->

    </div>  

<!-- </div> -->
@endsection

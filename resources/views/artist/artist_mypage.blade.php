@extends('layouts.artist')

@section('content')
<!-- 画像の変更を行ったらここにフラッシュメッセージが出る -->
@if (Session::has('message'))
    <p>{{ session('message') }}</p>
@endif
<!-- 画像の変更を行ったらここにフラッシュメッセージが出る -->

<div class="top-mypagedetail">
        <div class='d-flex justify-content-center mypage'>
            <div class='profile'>
                <div class='container-fluid mt-50'>
                    <h1>マイページ</h1>
                </div>
                <p>アーティスト名:{{$artist->artist_name}}</p>
                <p>詳細:{{ $artist->artist_detail }}</p>
                <p>アーティスト画像:<img src="{{ asset('/storage/top_file') }}/{{ $artist->artist_image }}" alt=""></p>
            </div>
        </div>

        <!-- ここから各種変更 -->
        <div class='d-flex justify-content-center seting'>

            <!-- ここからtopに戻る -->
            <div class='d-flex justify-content-center artist'>
                <button type="button" onClick="history.back()">戻る</button>
            </div>
            <!-- ここまでtopに戻る -->

            <!-- ここから編集 -->
            <div class='d-flex justify-content-center edit'>
                <a href="{{ route('artist.edit',['id' => Auth::user()->id]) }}">
                    <button class='btn btn-secondary mx-5'>編集</button>
                                                <!-- ↑マージン左右5pxずらしている -->
                </a>
            </div>
            <!-- ここまで編集 -->
        </div>
<div>
@endsection
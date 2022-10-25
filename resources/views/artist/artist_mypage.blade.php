@extends('layouts.artist')

@section('content')
<!-- 画像の変更を行ったらここにフラッシュメッセージが出る -->
@if (Session::has('message'))
    <p>{{ session('message') }}</p>
@endif
<!-- 画像の変更を行ったらここにフラッシュメッセージが出る -->
<p>マイページ</p>
    <p>アーティスト名:{{$artist->artist_name}}</p>
    <p>詳細:{{ $artist->artist_detail }}</p>
    <p>アーティスト画像:<img src="{{ asset('/storage/top_file') }}/{{ $artist->artist_image }}" alt=""></p>

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
@endsection
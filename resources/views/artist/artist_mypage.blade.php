@extends('layouts.artist')

@section('content')
<main class="py-4">
        <div class="col-md-5 mx-auto">
            <div class="card">
                <div class="card-header">
                    <h4 class='text-center'>アーティスト名</h1>
                </div>
                <!-- <div class="panel-body">
                    @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $msg)
                            <li>{{ $msg }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                </div>     -->
                <div class="card-body">
                    <div class="card-body">
                        <form action="{{ route('create.artist')}}" method="post">
                            @csrf
                            <label for='artist_name'>
                                アーティスト名
                            </label>
                                <input type='text' class='form-control' name='artist_name' value="{{ old('artist_name')}}"/>
                 
                            <label for='artist_detail' class='mt-2'>アーティストの詳細</label>
                                <textarea class='form-control' name='artist_detail'>{{ old('artist_detail')}}</textarea>
                           


@extends('layouts.general')

@section('content')

<!-- 画像の変更を行ったらここにフラッシュメッセージが出る -->
@if (Session::has('message'))
    <p>{{ session('message') }}</p>
@endif
<!-- 画像の変更を行ったらここにフラッシュメッセージが出る -->
<p>マイページ</p>
    <p>名前:{{ $my_user->artist_name }}</p>
    <p>詳細:{{ $my_user->artist_detail }}</p>
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

        <!-- ここからtopに戻る -->
        <div class='d-flex justify-content-center artist'>
            <a href="">
                <button class='btn btn-secondary mx-5'>TOPに戻る</button>
                                            <!-- ↑マージン左右5pxずらしている -->
            </a>
        </div>
        <!-- ここまでtopに戻る -->

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
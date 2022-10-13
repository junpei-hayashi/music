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

    <!DOCTYPE html>
    <html lang="ja">
    <body>
    <!-- マイページ変更画面 -->
    <form action="/my_page2" method="post" enctype='multipart/form-data'> 
        {{ csrf_field() }}
        <!-- 画像内容 -->
        <div>
            <input type="file" name="user_image">
        </div>
        <input type="submit" value="変更する">
    </form>

    </body>
    </html>
@endsection
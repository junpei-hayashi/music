@extends('layouts.artist')

@section('content')
<div class='container-fluid mt-50'>
    <h1>マイページ編集</h1>
</div>
<div class='d-flex justify-content-center mypage'>
        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                    @endforeach

                    @if(empty($errors->first('user_image')))
                    <li>画像ファイルがあれば、再度、選択してください。</li>
                    @endif
                </ul>
            </div>
        @endif

        <!-- /my_page2 -->
        <form action="{{route('edit.artist',['id'=> $user->id])}}" method="post" enctype='multipart/form-data'> 
        <!-- <form method="POST" action="{{route('post.complite')}}" enctype="multipart/form-data"> web.phpにポストで送る -->
        @csrf
            <div>
                <label for="artist_name">アーティスト名</label>
                <input type="text" name="artist_name" value="{{$user->artist_name}}">
            </div>

            <div>
                <label for="artist_detail">アーティストの詳細</label>
                <input type="text" name="artist_detail" value="{{$user->artist_detail}}">
            </div>

            <div>
                <p>プロフィール写真</p>

                <label for="artist_image">画像選択<label>
                <input type="file" class="from-control-file" name="artist_image" id="image">

            </div>

        
            <button type="submit">変更を保存</button>
        </form>
</div>
<div class='container-fluid mt-50'>
    <button type="button" onClick="history.back()">戻る</button>
</div>
@endsection
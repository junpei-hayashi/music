@extends('layouts.general')

@section('content')
<h1>新規投稿</h1>
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

    @if(session('message'))
        <div class="alert alert-success">{{session('message')}}</div>
    @endif

    <form method="POST" action="{{route('post.complite')}}" enctype="multipart/form-data"> <!-- web.phpにポストで送る -->
        @csrf
        <div>
            <label for="music_title">曲名</label>
            <input type="text" name="music_title" value="{{old('music_title')}}">
        </div>

        <div>
            <p>ジャケット写真</p>
            <label for="music_image" accept="image/png,image/jpeg,image/jpg">ファイルを選択</label>
            <input type="file" name="music_image" id="image" value="{{old('music_image')}}">
        </div>

        <div>
            <p>曲の音源ファイル</p>
            <label for="sound_source" accept="mp3,wave">ファイルを選択</label>
            <input type="file" name="sound_source" id="movie" value="{{old('sound_source')}}">
        </div>


        <div>
            <label for="music_detail">曲の概要</label>
            <textarea name="music_detail" cols="30" rows="10">{{old('music_detail')}}</textarea>
        </div>

        <button type="submit">投稿を保存</button>
    </form>
@endsection
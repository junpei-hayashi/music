@extends('layouts.general')

@section('content')
<h1>楽曲の編集</h1>
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                <li>{{$error}}</li>
                @endforeach

                @if(empty($errors->first('music_image')))
                <li>画像ファイルがあれば、再度、選択してください。</li>
                @endif
            </ul>
        </div>
    @endif

    <form method="post" action="{{route('edit.compmusic')}}" enctype="multipart/form-data"> <!-- web.phpにポストで送る -->
        @csrf
        <div>
            <label for="music_title">曲名</label>
            <input type="text" name="music_title" value="{{$music->music_title}}">
        </div>

        <div>
            <p>ジャケット写真</p>
            <label for="music_image" accept="image/png,image/jpeg,image/jpg">ファイルを選択</label>
            <input type="file" name="music_image" id="image" value="{{$music->music_image}}">
        </div>

        <div>
            <p>曲の音源ファイル</p>
            <label for="sound_source" accept="mp3,wave">ファイルを選択</label>
            <input type="file" name="sound_source" id="movie" value="{{$music->sound_source}}">
        </div>

        <div>
            <label for="jenre">ジャンル</label>
            <input type="text" name="jenre" value="{{$music->jenre}}">
        </div>

        <div>
            <label for="music_detail">曲の概要</label>
            <textarea name="music_detail" cols="30" rows="10">"{{$music->music_detail}}"</textarea>
        </div>

        <button type="submit">変更する</button>
    </form>
@endsection
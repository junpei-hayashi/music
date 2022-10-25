@extends('layouts.artist')

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

    @if(session('editmessage'))
        <div class="alert alert-success">{{session('editmessage')}}</div>
    @endif

    <form method="post" action="{{route('edit.compmusic')}}" enctype="multipart/form-data"> <!-- web.phpにポストで送る -->
        @csrf
        <input type="hidden" name="id" value="{{$musics->id}}">
        <div>
            <label for="music_title">曲名</label>
            <input type="text" name="music_title" value="{{$musics->music_title}}">
        </div>

        <div>
            <p>ジャケット写真</p>
            <label for="music_image" accept="image/png,image/jpeg,image/jpg">ファイルを選択</label>
            <input type="file" name="music_image" id="image" value="{{ $musics->music_image }}">
        </div>

        <div>
            <p>曲の音源ファイル</p>
            <label for="sound_source" accept="mp3,wave">ファイルを選択</label>
            <input type="file" name="sound_source" id="movie" value="{{$musics->sound_source}}" type="audio/mp3">
        </div>

        <div>
            <label for="jenre">ジャンル</label>
            <select class="form-select" aria-label="Default select example" name="jenre" value="{{$musics->jenre}}">
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

        </div>

        <div>
            <label for="music_detail">曲の概要</label>
            <textarea name="music_detail" cols="30" rows="10">{{$musics->music_detail}}</textarea>
        </div>

        <button type="submit">変更する</button>
    </form>
    <a href="{{ route('music.list',['id' => Auth::user()->id]) }}">
        <button class='btn btn-secondary mx-5'>戻る</button>
    </a>
@endsection
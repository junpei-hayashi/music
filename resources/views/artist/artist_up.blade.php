@extends('layouts.general')

@section('content')


<div class="card-body">
    <div class="card-body">
        <form action="{{ route('create.artist')}}" method="post">
            @csrf
            <!-- アーティスト画像 -->
            <label for='artist_image'>
                アーティスト画像
            </label>
            <input type="file" name="imagefile" value=""/><br /><br />

            <!-- アーティスト名 -->
            <label for='artist_name'>
                アーティスト名
            </label>
            <input type='text' class='form-control' name='artist_name' value="{{ old('artist_name')}}"/>

            <!-- アーティスト詳細 -->
            <label for='artist_detail' class='mt-2'>
                アーティストの詳細
            </label>
            <textarea class='form-control' name='artist_detail'>{{ old('artist_detail')}}</textarea>

            <div class='row justify-content-center'>
                <button type='submit' class='btn btn-primary w-25 mt-3'>登録</button>
            </div> 
        </form>
        <button type="button" onClick="history.back()">戻る</button>
    </div>
</div>


@endsection
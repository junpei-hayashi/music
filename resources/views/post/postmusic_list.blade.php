@extends('layouts.artist')

@section('content')
<!-- ここから全体 -->

@if(session('deletemessage'))
    <div class="alert alert-success">{{session('deletemessage')}}</div>
@endif
<div class="post-music">
    <h1>投稿曲一覧</h1>
</div>
    <button type="button" onClick="history.back()">戻る</button>
        <!-- ↓共通topページ -->
        @foreach($musics as $music)  
        <div class="container-fluid mt-20" Style="margin-left:-10px;">
            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-4">
                        <div class="card-header">
                            <div class="media flex-wrap w-100 align-items-center">
                                <div class="text-muted small ml-3">
                                    <div>
                                        <a href="{{ route('music.detail', ['id' => $music->artist_id])}}">
                                            <img src="{{ asset('/storage/top_file') }}/{{ $music->music_image }}" alt="">
                                        </a>
                                    </div>
                                </div>
                                <div class="media-body ml-3">
                                    <a href="{{ route('music.detail', ['id' => $music->artist_id])}}"> 
                                        {{$music->music_title}}
                                    </a>
                                </div>
                                <div class="text-muted small ml-3">
                                    <div>投稿日</div>
                                    <div><strong> {{$music->created_at}} </strong></div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <p>{{$music->music_detail}}</p>
                        </div>
                        <div>
                            <a href="{{ route('edit.music', ['id' => $music->id])}}">
                                <button>編集</button>
                            </a>
                            <form onClick="return confirm('本当に削除しますか？')" action="{{ route('delete.music',['id' => $music->id])}}" >
                                <button>削除</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach

@endsection
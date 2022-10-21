@extends('layouts.artist')

@section('content')
<!-- ここから全体 -->
<div class="top-page">
    <!-- 全体の画像 -->
    <div class="topimage-music">
        <img src="{{ asset('image/musichome.jpeg') }}" alt="トップイメージ"> 
    </div>
    <!-- 全体の画像 -->

    <!-- ダッシュボード -->
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Dashboard</div>

                    <div class="card-body">
                        Hi there, regular user
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ダッシュボード -->


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
                                    <a href="{{ route('music.detail', ['id' => $music->id])}}">
                                        <img src="{{ asset('/storage/top_file') }}/{{ $music->music_image }}" alt="">
                                    </a>
                                </div>
                                <audio controls controlslist="nodownload" >
                                    <source src="{{ asset('/storage/music_file') }}/{{ $music->sound_source }}" type="audio/mp3">
                                    <source src="{{ asset('/storage/music_file') }}/{{ $music->sound_source }}" type="audio/wav">
                                </audio>
                            </div>
                            <div class="media-body ml-3">
                                <a href="{{ route('music.detail', ['id' => $music->id])}}"> 
                                    {{$music->music_title}}
                                </a>
                                <a href="{{ route('artist.detail',['id' => Auth::user()->id])}}">
                                    <div class="text-muted small"> {{$music->artist_name}} </div>
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
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection
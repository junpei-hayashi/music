@extends('layouts.general')

@section('content')
<div>
    artist_image
    <img src="{{ asset('/storage/top_file') }}/{{ $user->user_image }}" alt="">
</div>

<div>
    artist_name
    <a href="{{ route('artist.detail', ['id' => Auth::user()->id])}}">
        {{$musics->artist_name}}
    </a>
</div>

<div>
    music_title
    {{$musics->music_title}}
</div>

<div>
    jenre
    {{$musics->jenre}}
</div>

<div>
    good button
    <!-- body内 -->
    <!-- 参考：$itemにはReviewControllerから渡した投稿のレコード$itemsをforeachで展開してます -->
    @auth
    <!-- Review.phpに作ったisLikedByメソッドをここで使用 -->
    @if (!$bool)
        <span class="likes">
            <i class="fas fa-light fa-heart like-toggle " data-review-id="{{ $item->id }}"></i>
        <span class="like-counter">{{$item->likes_count}}</span>
        </span><!-- /.likes -->
    @else
        <span class="likes">
            <i class="fas fa-light fa-heart like-toggle liked" data-review-id="{{ $item->id }}" style="color:red;"></i>
        <span class="like-counter">{{$item->likes_count}}</span>
        </span><!-- /.likes -->
    @endif
    @endauth
    @guest
    <span class="likes">
        <i class="fas fa-music heart"></i>
        <span class="like-counter">{{$item->likes_count}}</span>
    </span><!-- /.likes -->
    @endguest
</div>

<div>
    music_image
    <img src="{{ asset('/storage/top_file') }}/{{ $musics->music_image }}" alt="">
</div>

<div>
    music_detail
    {{$musics->music_detail}}
</div>

<div>
    Follow

</div>

<div>
    comment
</div>

<div>
    post_comment
</div>

<div>
    post_comment_button
</div>
@endsection


<style>
    .liked {
        color: red;
    }
</style>
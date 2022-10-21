@extends('layouts.general')

@section('content')
<div>
    artist_image
    <img src="{{ asset('/storage/top_file') }}/{{ $user->user_image }}" alt="">
</div>

<div>
    フォロー
    <!-- body内 -->
    <!-- 参考：$itemにはReviewControllerから渡した投稿のレコード$itemsをforeachで展開してます -->
    @auth
    <!-- Review.phpに作ったisLikedByメソッドをここで使用 -->
    @if (!$bool)
        <span class="follows">
            <i class="fas fa-duotone fa-user-plus follow-toggle " data-review-id="{{ $item->id }}"></i>
            <!-- <i class="fas fa-light fa-heart follow-toggle " data-review-id="{{ $item->id }}"></i> -->
        <span class="follow-counter">{{$item->follows_count}}</span>
        </span><!-- /.follows -->
    @else
        <span class="follows">
            <i class="fas fa-duotone fa-user-check follow-toggle followed" data-review-id="{{ $item->id }}" style="color:red;"></i>
            <!-- <i class="fas fa-light fa-heart follow-toggle followed" data-review-id="{{ $item->id }}" style="color:red;"></i> -->
        <span class="follow-counter">{{$item->follows_count}}</span>
        </span><!-- /.follows -->
    @endif
    @endauth
    @guest
    <span class="follows">
        <i class="fas fa-music heart"></i>
        <span class="follow-counter">{{$item->follows_count}}</span>
    </span><!-- /.follows -->
    @endguest
</div>

<div>
    artist_name
    {{$musics->artist_name}}
</div>

@endsection

<style>
    .followed {
        color: red;
    }
</style>
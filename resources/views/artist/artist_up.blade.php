@extends('layouts.general')

@section('content')
<!-- 一般ユーザーがアーティストになるページ -->

<!-- 画像の変更を行ったらここにフラッシュメッセージが出る -->
@if (Session::has('message'))
    <p>{{ session('message') }}</p>
@endif
<!-- 画像の変更を行ったらここにフラッシュメッセージが出る -->

<main class="py-4">
        <div class="col-md-5 mx-auto">
            <div class="card">
                <div class="card-header">
                    <h4 class='text-center'>アーティスト登録</h1>
                </div>
                <!-- <div class="panel-body">
                    @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $msg)
                            <li>{{ $msg }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                </div>     -->

                <!-- アーティスト画像画面 -->
                @if (Session::has('top_image_pass'))
                    <img src="{{ asset('/storage/top_file') }}/{{ session('top_image_pass') }}" alt=""> 

                @elseif ($my_user->user_image == "/def_img/noimage.png")
                    <p><img src="{{ $my_user->user_image }}" alt=""> </p>

                @else
                    <p><img src="{{ asset('/storage/top_file') }}/{{ $my_user->user_image }}" alt=""> </p>

                @endif
                <form action="/my_page2" method="post" enctype='multipart/form-data'> 
                    {{ csrf_field() }}
                    <!-- 画像内容 -->
                    <div>
                        <input type="file" name="artist_image">
                    </div>
                    <input type="submit" value="アーティスト画像登録">
                </form>

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
                    </div>
                </div>
            </div>
        </div>
    </main>

@endsection
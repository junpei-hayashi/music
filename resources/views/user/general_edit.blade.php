@extends('layouts.general')

@section('content')
<h1>マイページ<</h1>
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

    <!-- /my_page2 -->
    <form action="{{route('edit.general')}}" method="post" enctype='multipart/form-data'> 
    <!-- <form method="POST" action="{{route('post.complite')}}" enctype="multipart/form-data"> web.phpにポストで送る -->
    @csrf
        <div>
            <label for="name">名前</label>
            <input type="text" name="name" value="{{old('name')}}">
        </div>

        <div>
            <label for="email">メールアドレス</label>
            <input type="text" name="email" value="{{old('email')}}">
        </div>

        <div>
            <label for="tel">電話番号</label>
            <input type="text" name="tel" value="{{old('tel')}}">
        </div>

        <div>
            <p>プロフィール写真</p>

            <label for="music_image">画像選択<label>
            <input type="file" class="from-control-file" name="user_image" id="image">

            @if (Session::has('top_image_pass'))
            <img src="{{ asset('/storage/top_file') }}/{{ session('top_image_pass') }}" alt=""> 

            @elseif ($my_user->user_image == "/def_img/noimage.png")
                <p><img src="{{ $my_user->user_image }}" alt=""> </p>

            @else
                <p><img src="{{ asset('/storage/top_file') }}/{{ $my_user->user_image }}" alt=""> </p>

            @endif
        </div>

    
        <button type="submit">変更を保存</button>
    </form>
@endsection
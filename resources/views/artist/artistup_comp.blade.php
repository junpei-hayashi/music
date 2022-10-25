@extends('layouts.artist')

@section('content')
<h1>
アーティスト登録は完了いたしました。
</h1>
<a class="navbar-brand" href="{{ url('/home') }}">
    トップページへ戻る
    <!-- {{ config('app.name', 'Laravel') }} -->
</a>

@endsection
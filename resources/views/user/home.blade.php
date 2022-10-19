@extends('layouts.general')

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
    

        
        <!-- ↑共通topページ -->
      
</div>
@endsection
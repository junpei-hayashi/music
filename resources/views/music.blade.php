<!-- 詳細ページ -->

@extends('layouts.layout')
@section('content')
    <main class="py-4">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <div class='text-center'>収入</div>
                </div>
                <div class="card-body">
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope='col'>日付</th>
                                    <th scope='col'>金額</th>
                                    <th scope='col'>カテゴリ</th>
                                    <th scope='col'>コメント</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- ここに収入を表示する -->
                                    <tr>
                                        <th scope='col'>{{ $income['date']}}</th>
                                        <th scope='col'>{{ $income['amount']}}</th>
                                        <th scope='col'>{{ $income->type['name']}}</th>
                                        <th scope='col'>{{ $income['comment']}}</th>
                                    </th>

                            </tbody>
                        </table>
                    </div>
                </div> 
                <!-- ここから編集すべて -->
                <div class='d-flex justify-content-center editmaster'>

                    <!-- ここから物理削除 -->
                    <div class='d-flex justify-content-left mt-3'>
                        <a href="{{ route('delete.income',['income' => $income['id']]) }}" class='btn btn-secondary bg-danger'>削除</a>
                                                                                                           <!-- ↑背景赤bootstrap -->
                    </div>
                    <!-- ここまで物理削除 -->

                    <!-- ここから編集 -->
                    <div class='d-flex justify-content-center mt-3'>
                        <a href="{{ route('edit.income',['income' => $income['id']]) }}">
                            <button class='btn btn-secondary mx-5'>編集</button>
                                                        <!-- ↑マージン左右5pxずらしている -->
                        </a>
                    </div>
                    <!-- ここまで編集 -->

                    <!-- ここから論理削除 -->
                    <div class='d-flex justify-content-center mt-3'>
                        <a href="{{ route('deleteflag.income',['income' => $income['id']]) }}">
                            <button class='btn btn-secondary bg-warning text-secondary'>理論削除</button>
                                                        <!-- ↑背景黄色    ↑テキスト黒bootstrap-->
                        </a>
                    </div>
                    <!-- ここまで論理削除-->
                </div>
                <!-- ここまで編集すべて -->
            </div>
        </div>
    </main>
@endsection
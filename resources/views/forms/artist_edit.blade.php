<!-- 編集ページ -->


@extends('layouts.layout')
@section('content')
    <main class="py-4">
        <div class="col-md-5 mx-auto">
            <div class="card">
                <div class="card-header">
                    <h4 class='text-center'>収入</h1>
                </div>
                <div class="card-body">
                    <div class="card-body">
                        <form action="{{ route('edit.income', ['income' => $income->id])}}" method="post">
                            @csrf
                            <label for='amount'>金額</label>
                                <input type='text' class='form-control' name='amount' value="{{ $income['amount']}}"/>
                            <label for='date' class='mt-2'>日付</label>
                                <input type='date' class='form-control' name='date' id='date' value="{{ $income['date']}}"/>
                            <label for='type' class='mt-2'>カテゴリ</label>
                            <select name='type_id' class='form-control'>
                                @foreach($types as $type)
                                    @if($income['type_id'] == $type['id'])
                                    <option value="{{$type['id']}}" select>{{ $type['name'] }}</option>
                                    @else
                                    <option value="{{ $type['id']}}">{{ $type['name'] }}</option>
                                    @endif
                                @endforeach
                            </select>
                            <div class ="mt-4 mb-4">
                                <span class="btn">  
                                    <a href ="{{ route('create.spendType')}}">
                                        カテゴリ追加
                                    </a>
                                </span>
                            </div>
                            <label for='comment' class='mt-2'>メモ</label>
                                <textarea class='form-control' name='comment'>{{ $income['comment'] }}</textarea>
                            <div class='row justify-content-center'>
                                <button type='submit' class='btn btn-primary w-25 mt-3'>編集</button>
                            </div> 
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
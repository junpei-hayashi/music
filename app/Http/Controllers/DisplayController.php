<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Spending;
use App\Income;
use App\Type;
use Carbon\Carbon;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DisplayController extends Controller
{
    public function index() {

        // $spends =Auth::user()->spending()->get();

        // //Eloquent
        // // モデルのインスタンスを生成し、変数spendingに代入
        // $spending = new Spending;
        // spendingsモデルから全レコードを取得
        // $spends = $spending->all()->toArray();
        // $spends = Spending::whereDelFlg(0)->get()->toArray();
                         // ↑del_flg先頭と＿の後大文字     
                         
        // $incomes =Auth::user()->income()->get();

         //Eloquent
        // モデルのインスタンスを生成し、変数incomeに代入
        // $income = new Income;
        // incomesモデルから全レコードを取得
        // $incomes = $income->all()->toArray();
        // $incomes = Income::whereDelFlg(0)->get()->toArray();
                         // ↑del_flg先頭と＿の後大文字   

        // ----------日付----------
        $carbon = Carbon::now();
        $today     = $carbon->format('Y-m');
        $nextMonth = $carbon->addMonthsNoOverflow(1)->format('Y-m');
        $preMonth  = $carbon->subMonthsNoOverflow(2)->format('Y-m');
        // ----------日付---------

        // -----ユーザーに関連するデータ取得-----
        $spends  = Auth::user()
                        ->spending()
                        ->where('date', 'like', "$today%")
                        ->where('del_flg',0)
                        ->get()
                        ->toArray();
        $incomes = Auth::user()
                        ->income()
                        ->where('date', 'like', "$today%")
                        ->where('del_flg',0)
                        ->get()
                        ->toArray();
        // ----- END -----

        // ----------金額---------
        $spendSum = Spending::selectRaw('SUM(amount) as amount')
                            ->where('user_id', Auth::user()->id)
                            ->where('date', 'like', "$today%")
                            ->where('del_flg',0)
                            ->first();
        $incomeSum = Income::selectRaw('SUM(amount) as amount')
                            ->where('user_id', Auth::user()->id)
                            ->where('date', 'like', "$today%")
                            ->where('del_flg',0)
                            ->first();
        // ----------金額---------

        return view('home', [
            'spends' => $spends,
            'incomes' => $incomes,
            'today' => $today,
            'pre' => $preMonth,
            'next' => $nextMonth,
            'spendSum' => $spendSum,
            'incomeSum' => $incomeSum,
        ]);
    }

    public function alterYearMonth(String $yearMonth)
    {
        // 数値4桁-数値2桁
        if(!preg_match('/^([1-9][0-9]{3})\-(0[1-9]{1}|1[0-2]{1})$/', $yearMonth)){
            abort(404);
        }

        // ----------日付----------
        $carbon = new Carbon($yearMonth);
        $today     = $carbon->format('Y-m');
        $nextMonth = $carbon->addMonthsNoOverflow(1)->format('Y-m');
        $preMonth  = $carbon->subMonthsNoOverflow(2)->format('Y-m');
        // ----------日付---------
        
        // -----ユーザーに関連するデータ取得-----
        $spends  = Auth::user()
                        ->spending()
                        ->where('date', 'like', "$today%")
                        ->where('del_flg',0)
                        ->get()
                        ->toArray();
        $incomes = Auth::user()
                        ->income()
                        ->where('date', 'like', "$today%")
                        ->where('del_flg',0)
                        ->get()
                        ->toArray();
        // ----- END -----

        // ----------金額---------
        $spendSum = Spending::selectRaw('SUM(amount) as amount')
                        ->where('user_id', Auth::user()->id)
                        ->where('date', 'like', "$today%")
                        ->where('del_flg',0)
                        ->first();
        $incomeSum = Income::selectRaw('SUM(amount) as amount')
                        ->where('user_id', Auth::user()->id)
                        ->where('date', 'like', "$today%")
                        ->where('del_flg',0)
                        ->first();
        // ----------金額---------
        
        return view('home', [
            'spends' => $spends,
            'incomes' => $incomes,
            'today' => $today,
            'pre' => $preMonth,
            'next' => $nextMonth,
            'spendSum' => $spendSum,
            'incomeSum' => $incomeSum,
        ]);
    }

   
 // ↓ルートモデルバインディング
    public function spendDetail(Spending $spending) {
                              //↑ルートモデルバインディングにするとインスタンス化したものを持ってくるのでインスタンス化が必要なくなる

        return view('spend', [
            'spend' => $spending,
        ]);
    }


    // public function spendDetail(int $spendId) {
    //     $spending = new Spending;

    //     $spend_with_type = $spending->with('type')->find($spendId);

    //     if(is_null($spend_with_type)) {
    //         abort(404);
    //     }

    //     return view('spend', [
    //         'spend' => $spend_with_type,
    //     ]);
    // }



 // ↓ルートモデルバインディング
    public function incomeDetail(Income $income) {


        return view('income', [
            'income' => $income,
        ]);
    }

    
    // public function incomeDetail(int $incomeId) {
    //     $income = new Income;

    //     $income_with_type = $income->with('type')->find($incomeId);

    //     if(is_null($income_with_type)) {
    //         abort(404);
    //     }

    //     return view('income', [
    //         'income' => $income_with_type,
    //     ]);
    // }

}
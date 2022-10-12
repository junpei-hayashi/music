<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateData;
use App\Http\Requests\CreateType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Artist;
use App\Music;
use App\Like;
use App\Comment;
use App\Follow;
use App\Type;



class RegistrationController extends Controller
{

// ここから登録

    // ここから支出
    public function createSpendForm(Request $request)
    {
        $types = Type::where('category', 0)
        ->where('user_id', Auth::id())->get();
        // $types = Type::where('category', 0)->get();

        if($types-> isEmpty()){

            // return view('forms/spend_type_form');
            return redirect()->route('create.spendType');

        }

        return view('forms/spend_form',[
            'types'=>$types
        ]);
    }
    
    public function createSpend(CreateData $request)
    {

        $spending = new Spending;

        $spending->amount = $request->amount;
        $spending->date = $request->date;
        $spending->type_id = $request->type_id;
        $spending->comment = $request->comment;

        Auth::user()->spending()->save($spending);

        return redirect('/');

    }
    // ここまで支出

    // ここから収入
    public function createIncomeForm()
    {
        $types = Type::where('category', 1)
        ->where('user_id', Auth::id())->get();

        if($types-> isEmpty()){
            return view('forms/income_type_form');
            // return redirect()->route('create.incomeType');
        }

        return view('forms/income_form',[
            'types'=>$types
        ]);
    }
    
    public function createIncome(CreateData $request)
    {
        $income = new Income;

        $income->amount = $request->amount;
        $income->date = $request->date;
        $income->type_id = $request->type_id;
        $income->comment = $request->comment;

        Auth::user()->income()->save($income);

        return redirect('/');
    }
    // ここまで収入

// ここまで登録

    public function createSpendTypeForm(Request $request)
    {
       echo 'テスト';
       echo Auth::id();
        return view('forms/spend_type_form');
        // return redirect()->route('category.spend');
    }

    public function createSpendType(CreateType $request)
    {
        $type = new Type;

        $type->name = $request->name;
        $type->category = 0;

        $type->user_id = Auth::id();

        $type->save();

        return redirect('/create_spend');
        // ここで登録
    }

    public function createIncomeTypeForm()
    {
        return view('forms/income_type_form');
    }

    public function createIncomeType(CreateType $request)
    {
        $type = new Type;

        $type->name = $request->name;
        $type->category = 1;

        $type->user_id = Auth::id();

        $type->save();

        return redirect('/create_income');
        // ここで登録
    }

// ↓ここから編集

    // ↓ここから支出
    public function editSpendForm(Spending $spending){

        $type = 0;
        $subject = '支出';

        // $result = $spending->find($spending);

        $types = Type::where('category', $type)->get();

        return view('forms/spend_edit_form',[
            'spending' => $spending,
            'subject' => $subject,
            // 'result' => $result,
            'types' => $types,
        ]);
    }
    // public function editSpendForm(int $id){

    //     $spending = new Spending;
    //     $type = 0;
    //     $subject = '支出';

    //     $result = $spending->find($id);

    //     $types = Type::where('category', $type)->get();

    //     return view('forms/spend_edit_form',[
    //         'id' => $id,
    //         'subject' => $subject,
    //         'result' => $result,
    //         'types' => $types,
    //     ]);
    // }

    public function editSpend(Spending $spending, Request $request)
    {
        // $record = $spending->find($spending);
        // $record->amount = $request->amount;
        // $record->date = $request->date;
        // $record->type_id = $request->type_id;
        // $record->comment = $request->comment;
        $co = ['amount', 'date', 'comment','type_id'];

        foreach($co as $c){
            $spending->$c = $request->$c;
        }
        // $spending->type_id = Auth::id();

        Auth::user()->spending()->save($spending);

        // $record->save();

        return redirect('/');
    }
    // public function editSpend(int $id, Request $request)
    // {
    //     $spending = new Spending;
    //     $record = $spending->find($id);
    //     // $record->amount = $request->amount;
    //     // $record->date = $request->date;
    //     // $record->type_id = $request->type_id;
    //     // $record->comment = $request->comment;
    //     $co = ['amount', 'date', 'comment','type_id'];

    //     foreach($co as $c){
    //         $record->$c = $request->$c;
    //     }

    //     $record->save();

    //     return redirect('/');
    // }
    // ここまで支出


    // ↓ここから収入
    public function editIncomeForm(Income $income){

        $type = 1;
        $subject = '収入';


        $types = Type::where('category', $type)->get();

        return view('forms/income_edit_form',[
            'income' => $income,
            'subject' => $subject,
            'types' => $types,
        ]);
    }
    // public function editIncomeForm(int $id){

    //     $income = new Income;
    //     $type = 1;
    //     $subject = '収入';

    //     $result = $income->find($id);

    //     $types = Type::where('category', $type)->get();

    //     return view('forms/income_edit_form',[
    //         'id' => $id,
    //         'subject' => $subject,
    //         'result' => $result,
    //         'types' => $types,
    //     ]);
    // }

    public function editIncome(Income $income, Request $request)
    {
 
        $co = ['amount', 'date', 'comment','type_id'];
        
        foreach($co as $c){
            $income->$c = $request->$c;
        }

        Auth::user()->income()->save($income);

        return redirect('/');
    }

    // public function editIncome(int $id, Request $request)
    // {
    //     $income = new Income;
    //     $record = $income->find($id);
    //     // $record->amount = $request->amount;
    //     // $record->date = $request->date;
    //     // $record->type_id = $request->type_id;
    //     // $record->comment = $request->comment;
    //     $co = ['amount', 'date', 'comment','type_id'];
        
    //     foreach($co as $c){
    //         $record->$c = $request->$c;
    //     }
      
    //     $record->save();

    //     return redirect('/');
    // }
    // ここまで支出

// ここまで編集


// ここから物理削除
    // ↓ここから支出
    public function deleteSpendForm(Spending $spending, Request $request)
    {

        $spending->delete();

        return redirect('/');
    }
    // public function deleteSpendForm(int $id, Request $request)
    // {
    //     $spending = new Spending;

    //     $record = $spending->find($id);

    //     $record->delete();

    //     return redirect('/');
    // }
    // ここまで支出

    // ↓ここから収入

    public function deleteIncomeForm(Income $income, Request $request)
    {

        $income->delete();

        return redirect('/');
    }
    // ここまで収入

// ここまで物理削除

// ここから論理削除

    // ここから支出
    public function SoftDeletesSpend(Spending $spending, Request $request)
        {
            
            $spending->del_flg = 1;
            
            Auth::user()->spending()->save($spending);

            return redirect('/');
        }
    // public function SoftDeletesSpend(int $id, Request $request)
    //     {
    //         $spending = new Spending;
            
    //         $record = $spending->find($id);
            
    //         $record->del_flg = 1;
            
    //         $record->save();

    //         return redirect('/');
    //     }
    // ここまで支出

    // ここから収入

    public function SoftDeletesIncome(Income $income, Request $request)
    {
        
        $income->del_flg = 1;
        
        Auth::user()->income()->save($income);

        return redirect('/');
    }
    // public function SoftDeletesIncome(int $id, Request $request)
    // {
    //     $income = new Income;
        
    //     $record = $income->find($id);
        
    //     $record->del_flg = 1;
        
    //     $record->save();

    //     return redirect('/');
    // }

    // ここまで収入

// ここまで論理削除
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class My_pageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $id = Auth::id();
        $user = DB::table('users')->find($id);
        return view('user.general_mypage', ['my_user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $id = Auth::id();
        $user = DB::table('users')->find($id);
        return view('user.general_mypage_edit', ['my_user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function my_page_update(Request $request)
    {
        if($request->hasFile('user_image')) {
            $id = Auth::id();
            $photo_path = $request->file('user_image')->store('public/top_file');
            $top_image_pass2 = basename($photo_path);
            // DBの対象カラムを更新する
            $affected = DB::table('users')
            ->where('id', $id)
            ->update(['user_image' => $top_image_pass2]);
            // 画像に表示させる
            return redirect()->route('id.show',['id' => Auth::user()->id])->with([
                "message" => "マイページ画像を変更しました。",
                "top_image_pass" => $top_image_pass2 
            ]);
        }
    }
}

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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function createArtistForm(Request $request)
    {
        $artists = new Artist;

        $types = User::where('type_id', 0)
        ->where('user_id', Auth::id())->get();
        // $types = Type::where('category', 0)->get();

        return view('artist/artist_up',[
            'types'=>$types
        ]);
    }
    
    public function createArtist(Request $request)
    {
        // 一般ユーザーのtype_idを更新
        $user = User::find(Auth::id());//該当ユーザーのデータ取得、Auth::id()が既にログインユーザーのIDを取得している
        
        $user->type_id = 1;//ユーザーのtype_idを0から1へ

        $user -> save();
        
        // アーティスト情報を追加
        $artist = new Artist;

        $artist->user_id = Auth::id();//artistテーブルのカラムuser_idに、ログイン(Auth)しているユーザーのIDを出力

        $columns = ['artist_name', 'artist_detail', 'artist_image',];
        foreach($columns as $column) {
            $artist->$column = $request->$column;
        }

        $artist -> save();

        return redirect('/');


        // $types = new User;
        
        // $types -> type_id = 1;
        
        // $artist = new Artist;

        // $columns = ['artist_name', 'artist_detail','artist_image'];
        // foreach($columns as $column) {
        //     $artist->$column = $request->$column;
        // }

        // Auth::user()->artist()->save($artist);

        // return redirect('/');


    }
    
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
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
}

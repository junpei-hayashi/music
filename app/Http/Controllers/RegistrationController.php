<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateData;
use App\Http\Requests\CreateType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
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

        return view('artist.artistup_comp');     

        // return redirect('/');
    }

    // only()の引数内のメソッドはログイン時のみ有効
    public function __construct()
    {
        $this->middleware(['auth', 'verified'])->only(['like', 'unlike']);
    }

    public function like(Request $request)
    {
        $user_id = Auth::user()->id; //1.ログインユーザーのid取得
        $music_id = $request->music_id; //2.投稿idの取得
        $already_liked = Like::where('user_id', $user_id)->where('music_id', $music_id)->first(); //3.

        if (!$already_liked) { //もしこのユーザーがこの投稿にまだいいねしてなかったら
            $like = new Like; //4.Likeクラスのインスタンスを作成
            $like->music_id = $music_id; //Likeインスタンスにmusic_id,user_idをセット
            $like->user_id = $user_id;
            $like->save();
        } else { //もしこのユーザーがこの投稿に既にいいねしてたらdelete
            Like::where('music_id', $music_id)->where('user_id', $user_id)->delete();
        }
        //5.この投稿の最新の総いいね数を取得
        $music_likes_count = Music::withCount('likes')->findOrFail($music_id)->likes_count;
        $param = [
            'music_likes_count' => $music_likes_count,
        ];
        return response()->json($param); //6.JSONデータをjQueryに返す
    }

    public function follow(Request $request)
    {
        $user_id = Auth::user()->id; //1.ログインユーザーのid取得
        $artist_id = $request->artist_id; //2.投稿idの取得
        $already_followd = Follow::where('user_id', $user_id)->where('artist_id', $artist_id)->first(); //3.

        if (!$already_followd) { //もしこのユーザーがこの投稿にまだフォローしてなかったら
            $follow = new Follow; //4.followクラスのインスタンスを作成
            $follow->artist_id = $artist_id; //followインスタンスにartist_id,user_idをセット
            $follow->user_id = $user_id;
            $follow->save();
        } else { //もしこのユーザーがこの投稿に既にフォローしてたらdelete
            Follow::where('artist_id', $artist_id)->where('user_id', $user_id)->delete();
        }
        //5.この投稿の最新の総いいね数を取得
        $artist_follows_count = Artist::withCount('follows')->findOrFail($artist_id)->follows_count;
        $param = [
            'artist_follows_count' => $artist_follows_count,
        ];
        return response()->json($param); //6.JSONデータをjQueryに返す
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

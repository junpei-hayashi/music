<?php

namespace App\Http\Controllers;


use App\Http\Requests\CreateData;
use App\Http\Requests\CreateType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Log;
use App\User;
use App\Artist;
use App\Music;
use App\Like;
use App\Comment;
use App\Follow;
use App\Type;

class MusicController extends Controller
{
    // 曲の投稿
    public function postMusic()
    {
        return view('post.post_music');
    }

    public function postComplite(Request $request)
    {        
        // try {
        //     DB::beginTransaction();
            $inputs=$request->validate([
                'music_title'=>'required|string|max:255',
                'jenre'=>'required', 'string', 'max:255', 'unique:users',
                'music_detail'=>'nullable',
                // 'sound_source'=>'required|max:1024',
            ]);
            
            $music = new Music;
            $music->artist_id = Auth::id();//musicテーブルのカラムartist_idに、ログイン(Auth)しているユーザーのIDを出力
            $music->music_title=$inputs['music_title'];
            $music->jenre=$inputs['jenre'];
            $music->music_detail=$inputs['music_detail'];
            $music->music_image=$request->music_image;
            $music->sound_source=$request->sound_source;
            
            if($request->hasFile('music_image')) {
                $photo_path = $request->file('music_image')->store('public/top_file');
                $music->music_image = basename($photo_path);
            }
            // $path=Storage::putFile('public/music_file',$request->file('sound_source'));
                $path = $request->file('sound_source')->store('public/music_file');
                // $music->sound_source = basename($music_path);
            $music->sound_source = $path;
            $music->save();

            // DB::commit();
            // return view('user.general_mypage')->with('message','投稿をしました');
            return back()->with('message','投稿をしました');

        // } catch (\Exception $e) {
        //     Log::info($e->getMessage());//エラーメッセージを出力してくれる
        //     DB::rollback();//コミットしなかった処理を無かったことにする。
        //     session()->flash('message', '投稿が失敗しました');
        //     return view('post.post_music')->with('message','投稿をしました');
        // }

    }

    // 曲の編集
    public function editMusic(Request $request)
    {
        $musics=DB::table('musics')->leftjoin('artists','musics.artist_id','=','artists.user_id')->orderBy('musics.id','desc')->get();
        $artists=Artist::all();
        $user=Auth::user();       
        return view('post.music_edit',[
            'musics' => $musics,
            'user' => $user,
            'artist' => $artists
        ]);     
    }
    public function editMusicComplite(Request $request)
    {
        // try {
        //     DB::beginTransaction();
        $inputs=$request->validate([
            'music_title'=>'required|string|max:255',
            'jenre'=>'required', 'string', 'max:255', 'unique:users',
            'music_detail'=>'nullable',
            // 'sound_source'=>'required|max:1024',
        ]);
        
        $music = new Music;
        $music->artist_id = Auth::id();//musicテーブルのカラムartist_idに、ログイン(Auth)しているユーザーのIDを出力
        $music->music_title=$inputs['music_title'];
        $music->jenre=$inputs['jenre'];
        $music->music_detail=$inputs['music_detail'];
        $music->music_image=$request->music_image;
        $music->sound_source=$request->sound_source;
        
        if($request->hasFile('music_image')) {
            $photo_path = $request->file('music_image')->store('public/top_file');
            $music->music_image = basename($photo_path);
        }
        // $path=Storage::putFile('public/music_file',$request->file('sound_source'));
            $path = $request->file('sound_source')->store('public/music_file');
            // $music->sound_source = basename($music_path);
        $music->sound_source = $path;
        $music->save();

        // DB::commit();
        // return view('user.general_mypage')->with('message','投稿をしました');
        return back()->with('message','投稿をしました');
    }

    // 曲の視聴
    public function __construct()
    {
        $this->middleware(['auth', 'verified'])->only(['likeMusic', 'unlikeMusic']);
    }
    // 曲の視聴ページへ
    public function musicDetail($id)
    {
        $musics=DB::table('musics')->leftjoin('artists','musics.artist_id','=','artists.user_id')->orderBy('musics.id','desc')->first();
        $artists=Artist::all();
        $user=Auth::user();    
        $item = Music::withCount('likes')->where('id',$id)->first();
        $review = new Music;
        $bool = $review->isLikedBy($user->id);
        return view('post.music_detail',[
            'musics' => $musics,
            'user' => $user,
            'artist' => $artists,
            'item' => $item,
            'bool' => $bool
        ]);   
    }
    
}

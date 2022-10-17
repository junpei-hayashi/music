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

class MusicController extends Controller
{
    // 曲の投稿
    public function postMusic()
    {
        return view('post.post_music');
    }

    public function postComplite(Request $request)
    {        
        $inputs=$request->validate([
            'music_image'=>'required|max:255',
            'sound_source'=>'required|max:1600|mimes:mp3,wave,aif,aac,mp4',
            'music_title'=>'required|max:255',
            'music_detail'=>'required|max:255'
        ]);

        $music=new Music();
        $music->music_title=$inputs['music_title'];
        $music->music_detail=$inputs['music_detail'];
        $music->artist_id=auth()->user()->id;

        if(request('music_image')) {
            $name=request()->file('music_image')->getClientOriginalName();
            $file=request()->file('music_image')->move('storage/images,$name');
            $music->music_image=$name;
        }

        $music->save();
        return back()->with('message','投稿しました');
        
    }

    public function postComplit(Request $request) //リクエストでブラウザから投稿する曲の情報が送られ、その結果を変数のrequestとし使用している
    {
        $music = new Music();//モデルMusicのインスタンス化を行い$musicという変数に格納

        // ポストでmusic_imageが送られてきた場合と、送られてこなかった場合を想定するif分
        if ($file = $request->music_image){

            //$fileNameにはtime関数を使用している.unicstimestampを取得できる。
            // その後、投稿したファイル名と文字列結合している
            $fileName = time() . $file->getClientOriginalName();

            // 変数$target_pathには関数public_pathのuploadsと記載している。
            // 関数public_pathを使用するとexplorerのpublicのパスを取得できる。
            // その配下にuploadsというファイルを作るパスになっている
            $target_path = public_path('uploads/');

            // $file->moveの引数に、$target_pathの先ほど指定した画像のディレクトリ、
            // $fileNameのunicstimestampとファイル名を移動する
            $file->move($target_path, $fileName);
        }else {
            $fileName =null;
        }

         // ポストでmp3が送られてきた場合と、送られてこなかった場合を想定するif分
        if ($file = $request->mp3){
            $fileName = time() . $file->getClientOriginalName();
            $target_path = public_path('upload/');
            $file->move($target_path, $fileName);
        }else {
            $fileName =null;
        }

        $music->music_title = $request->input('music_title');
        $music->music_image = $fileName;
        $music->mp3 = $fileName;
        $music->music_detail = $request->input('music_detail');
        $music->artist_id = Auth::id();//artistテーブルのカラムuser_idに、ログイン(Auth)しているユーザーのIDを出力

        $post->save();
        
        // return view('post.index_music');
    }
}

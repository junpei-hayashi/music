<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreateData;
use App\Http\Requests\CreateType;
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

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {     
        if($request->isMethod('post')){
            $musics=DB::table('musics')
            ->leftjoin('artists','musics.artist_id','=','artists.id')
            ->where('jenre',$request->jenre)
            ->orderBy('musics.id','desc')
            ->get();
        }else{
            $musics=DB::table('musics')
            ->join('artists','musics.artist_id','=','artists.id')
            ->orderBy('musics.id','desc')
            ->get();
        }
        $artists=Artist::all();
        $user=Auth::user();

        // ここから書き足し
        $type_id = \Auth::user()->type_id;  
        if($type_id === 1) {
            return view('artist.home2',[
                'musics' => $musics,
                'user' => $user,
                'artist' => $artists
            ]);
        }else{
            return view('user.home',[
                'musics' => $musics,
                'user' => $user,
                'artist' => $artists
            ]);
        }
            // return view('user.home',[
            //     'musics' => $musics,
            //     'user' => $user,
            //     'artist' => $artists
            // ]);
        

        // $musics = Music::orderBy('id','desc');
        // $artists = Artist::all();
        // $user = Auth::user();       
        // return view('home',compact('musics', 'user', 'artists'));
       
        // return view('home');
    }

}

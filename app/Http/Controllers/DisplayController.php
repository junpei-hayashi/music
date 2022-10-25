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

class DisplayController extends Controller
{

    public function artistDetail($id)
    {
        $musics=DB::table('musics')->leftjoin('artists','musics.artist_id','=','artists.user_id')->orderBy('musics.id','desc')->first();
        $artists=Artist::all();
        $user=Auth::user();
        $item = Artist::withCount('follows')->where('id',$id)->first();
        $review = new Artist;
        $bool = $review->isFollowedBy($user->id);   
        
        $type = User::find(Auth::id());
        if($type->type_id === 1){
            return view('artist.artist_detail2',[
                'musics' => $musics,
                'user' => $user,
                'artist' => $artists,
                'item' => $item,
                'bool' => $bool
            ]);   
        }else{
            return view('artist.artist_detail',[
                'musics' => $musics,
                'user' => $user,
                'artist' => $artists,
                'item' => $item,
                'bool' => $bool
            ]);   
        }
    }
    public function artistMypage($id)
    {
        $artists=Artist::find($id);   
        return view('artist.artist_mypage',[
            'artist' => $artists,
        ]);   
    }

    public function musicList($id)
    {
        
        // foreach($musics as $m){
            //     $str=str_replace('public/','',$m->sound_source);
            //     $m->sound_source = Storage::disk('public')->url($str);
            // }

            $user = Auth::user()->id;
            $musics = Music::where('artist_id',$user)
            ->orderBy('musics.id','desc')
            ->get();
            
            return view('post.postmusic_list',[
                'musics' => $musics,
            ]);

    }

    public function artistEdit($id)
    {
        // $musics=DB::table('musics')->leftjoin('artists','musics.artist_id','=','artists.user_id')->orderBy('musics.id','desc')->first();
        // $artists=Artist::all();
        // $user=Auth::user(); 
        // return view('artist.artist_edit',[
        //     'musics' => $musics,
        //     'user' => $user,
        //     'artist' => $artists,
        // ]);   
        $musics=DB::table('musics')
            ->leftjoin('artists','musics.artist_id','=','artists.user_id')
            ->orderBy('musics.id','desc')
            ->first();
        $artists=Artist::all();
        $user=Auth::user();
             
        return view('artist.artist_edit',[
            'musics' => $musics,
            'user' => $user,
            'artist' => $artists,
        
        ]);   
    }
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
}

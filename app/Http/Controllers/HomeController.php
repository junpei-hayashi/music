<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\User;
use App\Artist;
use App\Music;

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
            $musics = Music::orderby('created_at','desc')
            ->where('jenre',$request->jenre)
            ->get();
        }else{
            $musics = Music::orderby('created_at','desc')->get();
        }
        foreach($musics as $m){
            $str=str_replace('public/','',$m->sound_source);
            $m->sound_source = Storage::disk('public')->url($str);
        }

        $type = User::find(Auth::id());
        if($type->type_id === 0){
            return view('user/home',[
                'musics' => $musics
            ]);
        }else{
            return view('artist/home2',[
                'musics' => $musics
            ]);
        }
        
    }
}

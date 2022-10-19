<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Artist;

class Music extends Model
{
    protected $table = 'musics';
    protected $fillable = [
        'music_image', 'sound_source', 'music_title', 'music_detail', 'artist_id','jenre',
    ];

    public function user() {
        return $this->belongsTo('User::class');//多から見てユーザーは１になる
    }
    public function artists() {
        return $this->hasOne('App\Artist');// artistテーブルにuser_idがあることが前提
    }
}

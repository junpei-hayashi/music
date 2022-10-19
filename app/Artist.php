<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Music;

class Artist extends Model
{
    protected $fillable = [
        'artist_name', 'artist_detail', 'artist_image', 'user_id',
    ];

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function musics() {
        return $this->hasMany('Music::class');//ユーザーから見て曲のテーブルは1対多になる
    }

}
<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Models\User;
use App\Models\Artist;
use App\Models\Music;

class Like extends Model
{
    protected $fillable = [
        'music_id', 'user_id',
    ];

    public function musics()
    {
        return $this->belongsTo(Music::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

// ↓いいねした曲を表示させる
// Music::join('likes','musics.id','likes.music_id')->where('likes.user_id',Auth($id))->get;
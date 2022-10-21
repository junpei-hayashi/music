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

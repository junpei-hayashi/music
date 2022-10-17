<?php

namespace App;


use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Music extends Model
{

    protected $fillable = [
        'music_image', 'sound_source', 'music_title', 'music_detail', 
    ];

    public function user() {
        return $this->belongsTo('User::class');//多から見てユーザーは１になる
    }
}

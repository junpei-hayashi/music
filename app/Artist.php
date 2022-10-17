<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Artist extends Model
{
    protected $fillable = [
        'artist_name', 'artist_detail', 'artist_image', 'user_id',
    ];

    public function user() {
        return $this->belongsTo('App\User');
    }

}
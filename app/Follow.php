<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Artist;

class Follow extends Model
{
    protected $fillable = [
        'artist_id', 'user_id',
    ];

    public function artists()
    {
        return $this->belongsTo(Artist::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
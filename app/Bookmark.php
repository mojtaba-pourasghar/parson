<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bookmark extends Model
{
    protected $fillable = [
        'id', 'user_id','textile_id'
    ];

    public function textile()
    {
        return $this->belongsTo(Textile::class,'textile_id');
    }
}

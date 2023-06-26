<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SiteInformation extends Model
{

    protected $fillable = [
        'title', 'description', 'keywords', 'instagram', 'facebook', 'twitter', 'telegram', 'worldwide'
    ];

    protected $primaryKey = null;
    public $incrementing = false;
}

<?php

namespace App\Traits;

trait Model
{
    public function setSlugAttribute($value)
    {
        $this->attributes['slug'] = str_replace(' ','-',$value) ?: null;
    }
}

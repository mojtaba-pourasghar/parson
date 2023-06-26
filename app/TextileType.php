<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TextileType extends Model
{
    protected $fillable = [
        'title', 'state'
    ];

    public function getData($id = 0)
    {
        if ($id == 0) {
            $value = $this->orderBy('id', 'asc')->get();
        } else {
            $value = $this->where('id', $id)->first();
        }
        return $value;
    }

    public static function getList()
    {
        $instance = new static;
        $value = $instance->pluck('title', 'id');
        return $value;
    }
}

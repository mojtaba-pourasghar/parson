<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laracasts\Presenter\PresentableTrait;

class Faq extends Model
{
    use PresentableTrait;
    protected $presenter = 'App\Presenters\FaqPresenter';
    protected $fillable = [
        'question', 'answer', 'state'
    ];
}

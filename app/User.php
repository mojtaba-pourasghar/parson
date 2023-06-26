<?php

namespace App;

use App\Traits\HasPermissionsTrait;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Traits;
use Laracasts\Presenter\PresentableTrait;

/**
 * App\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereUpdatedAt($value)
 * @mixin \Eloquent
 */
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable;
    use HasPermissionsTrait;
    use Traits\Model;
    use PresentableTrait;
    use HasApiTokens;

    protected $presenter = 'App\Presenters\UserPresenter';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','roles','mobile_confirmation','provider', 'provider_id','date_of_birth','telegram','province_id','city_id',
        'instagram','twitter','mobile','facebook','about','google_id','state','is_admin'
    ];

    protected $dates =  ['last_login_at'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }
    public function images()
    {
        return $this->hasMany(UserImage::class,'user_id','id');
    }

    public function bookComments()
    {
        return $this->hasMany(BookComment::class,'user_id','id');
    }
    public function bookShelves()
    {
        return $this->hasMany(BookShelf::class,'user_id','id');
    }

    public function getImageAttribute($value)
    {
        return getConstant('site_url').getUserImagePath($value) ;
    }

    public function getCoverImageAttribute($value)
    {
        return getConstant('site_url').getUserImagePath($value) ;
    }
    public function getNameAttribute($value)
    {
        if($value==null) $value = '';
        return $value;
    }

    /*public function shelf()
    {
        return $this->hasMany(BookShelf::class,'user_id','id');
    }*/
}

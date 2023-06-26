<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    protected $fillable = ['user_id','amount'];
    public static function getAccountBalance($user_id)
    {
        $instance = new static;
        $wallet = $instance->select('amount')->where('user_id',$user_id)->first();
        if ($wallet == null) return   0;
        return $wallet->amount;
    }

    public static function Insert($user_id,$amount)
    {
        $instance = new static;
        $wallet = $instance->create([
            'user_id' => $user_id,
            'amount' => $amount
        ] );
        return $wallet;
    }
}

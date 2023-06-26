<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class TransactionPay extends Model
{
    protected $fillable = [
        'transaction_id', 'user_id','bank_id','bank_message_id','refid','status'
    ];

    public static function Insert($items)
    {
        $instance = new static;
        $transaction_pay = $instance->create([
            'transaction_id' => $items['transaction_id'],
            'user_id' => $items['user_id'],
            'bank_id' => $items['bank_id'],
            //'bank_message_id'=> $items['bank_message_id'],
            //'refid'=> $items['refid'],
           // 'status'=> $items['status'],
        ] );
        return $transaction_pay;
    }

    public function bank()
    {
        return $this->belongsTo(Bank::class,'bank_id');
    }
    public function bank_message()
    {
        return $this->belongsTo(BankMessage::class,'bank_message_id');
    }

    public function transaction()
    {
        return $this->hasOne(Transaction::class,'id');
    }
}

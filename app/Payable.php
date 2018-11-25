<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payable extends Model
{
    protected $fillable = [
        'id', 'user_id','payment_id','fee_id','fee_name','fee_sum','fee_scale', 'fee_state', 'is_hidden'
    ];
    public function user(){
        return $this->belongsTo('App\User','user_id');
    }

    public function payment(){
        return $this->belongsTo(Payment::class);
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment_fee_item extends Model
{
    protected $fillable = [
        'id', 'user_id','payment_id','fee_id','fee_name','fee_sum','fee_scale', 'fee_category', 'is_hidden'
    ];
    public function user(){
        return $this->belongsTo('App\User','user_id');
    }

    public function fee(){
        return $this->belongsTo(Fee::class);
    }
}

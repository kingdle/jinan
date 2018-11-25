<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fee extends Model
{
    protected $fillable = [
        'id', 'user_id','fee_category','fee_name','fee_scale', 'fee_remark', 'is_hidden'
    ];
    public function user(){
        return $this->belongsTo('App\User','user_id');
    }
    public function receivable(){
        return $this->hasOne('App\Receivable','user_id','id');
    }
}

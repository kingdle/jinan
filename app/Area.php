<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    protected $fillable = [
        'province', 'city','district','pic', 'content','street','village','address','latitude','longitude',
        'items_num', 'fee','start_num','end_num'
    ];

    public function product(){
        return $this->belongsTo('App\Product','product_id');
    }
}

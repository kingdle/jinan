<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Parkdata extends Model
{
    protected $fillable = [
        'id',
        'park_id',
        'title',
        'class_id',
        'item_id',
        'item_unit',
        'now_num',
        'before_num',
        'add_speed'
    ];
    public function park(){
        return $this->belongsTo('App\Park','park_id');
    }
}

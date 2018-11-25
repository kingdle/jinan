<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id', 'to_user_id', 'product_id','price',
        'address', 'content', 'times_at','times_end',
        'is_native', 'age_at', 'age_end','day_at',
        'rest_mode', 'other_requirements', 'emergency','offer_count',
        'comments_count','likes_count','close_comment','is_hidden'
    ];

}

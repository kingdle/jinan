<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dynamic extends Model
{
    protected $fillable = [
        'id',
        'user_id',
        'area_id',
        'title',
        'content',
        'pic',
        'published_at',
        'created_at',
        'updated_at',
    ];
}

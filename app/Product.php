<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'parent_id', 'title', 'icon','hot','is_hidden','services_count','comments_count','followers_count','answers_count'
    ];

    public function girls(){
        return $this->hasMany(Girl::class);
    }
}

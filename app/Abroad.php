<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Abroad extends Model
{
    protected $fillable = [
        'user_id', 'gift_id','number_id','department', 'name','gender','age','duties','place_to','times_at','times_end',
        'linkman','linkman_duties',
        'level','system_part','by_group','visits_category','days','batch_number','funds','remarks',
        'linkman_phone','reasons_visit',
        'suggestion_foreign_affairs','times_foreign_affairs', 'suggestion_inspection','times_inspection',
        'suggestion_management_leader','times_management_leader','suggestion_foreign_affairs_leader','times_foreign_affairs_leader',
        'suggestion_manage_committee','times_manage_committee','suggestion_work_committee','times_work_committee','pic','close_comment','is_hidden'
    ];
    public function user(){
        return $this->belongsTo('App\User','user_id');
    }
}

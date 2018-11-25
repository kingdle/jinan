<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reception extends Model
{
    protected $fillable = [
        'user_id', 'gift_id','hotel_id','number_id','nation', 'activity','organizer','delegation','office_works','objective','times_at','times_end',
        'property','gift','number_peoples','banquet','banquet_hotel','banquet_address','harvest','assign','reception_department','reasons_plan',
        'reasons_content','reasons_keynote','enclosure',
        'suggestion_management_leader', 'suggestion_manage_committee','suggestion_work_committee','close_comment','is_hidden'
    ];
    public function user(){
        return $this->belongsTo('App\User','user_id');
    }
}

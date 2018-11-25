<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Reception extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'user_id'=>$this->user_id,
            'gift_id'=>$this->gift_id,
            'hotel_id'=>$this->hotel_id,
            'number_id'=>$this->number_id,
            'number_hidden'=>substr_replace($this->number_id,'***',2,9),
            'nation'=>$this->nation,
            'activity'=>$this->activity,
            'organizer'=>$this->organizer,
            'delegation'=>$this->delegation,
            'office_works'=>$this->office_works,
            'objective'=>$this->objective,
            'number_peoples'=>$this->number_peoples,
            'times_at'=>substr($this->times_at,0,10),
            'times_at_md'=>substr($this->times_at,5,5),
            'times_end'=>substr($this->times_end,0,10),
            'times_end_md'=>substr($this->times_end,5,5),
            'property'=>$this->property,
            'gift'=>$this->gift,
            'banquet'=>$this->banquet,
            'banquet_hotel'=>$this->banquet_hotel,
            'banquet_address'=>$this->banquet_address,
            'harvest'=>$this->harvest,
            'assign'=>$this->assign,
            'reception_department'=>$this->reception_department,
            'reasons_plan'=>$this->reasons_plan,
            'reasons_content'=>$this->reasons_content,
            'reasons_keynote'=>$this->reasons_keynote,
            'enclosure'=>json_decode($this->enclosure),
            'suggestion_management_leader'=>$this->suggestion_management_leader,
            'suggestion_manage_committee'=>$this->suggestion_manage_committee,
            'suggestion_work_committee'=>$this->suggestion_work_committee,
            'close_comment'=>$this->close_comment,
            'is_hidden'=>$this->is_hidden,
            'created_at'=>$this->created_at,
            'updated_at'=>$this->updated_at,
        ];
    }
}

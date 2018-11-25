<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Abroad extends JsonResource
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
            'number_id'=>$this->number_id,
            'number_hidden'=>substr_replace($this->number_id,'***',2,9),
            'department'=>$this->department,
            'name'=>$this->name,
            'gender'=>$this->gender=='1'?'男':'女',
            'age'=>$this->age,
            'duties'=>$this->duties,
            'level'=>$this->level,
            'system_part'=>$this->system_part,
            'place_to'=>$this->place_to,
            'days'=>$this->days,
            'batch_number'=>$this->batch_number,
            'funds'=>$this->funds,
            'remarks'=>$this->remarks,
            'times_at'=>substr($this->times_at,0,10),
            'times_at_md'=>substr($this->times_at,5,5),
            'times_end'=>substr($this->times_end,0,10),
            'times_end_md'=>substr($this->times_end,5,5),
            'linkman'=>$this->linkman,
            'linkman_duties'=>$this->linkman_duties,
            'linkman_phone'=>$this->linkman_phone,
            'by_group'=>$this->by_group,
            'visits_category'=>$this->visits_category,
            'reasons_visit'=>$this->reasons_visit,
            'suggestion_foreign_affairs'=>$this->suggestion_foreign_affairs,
            'times_foreign_affairs'=>$this->times_foreign_affairs,
            'suggestion_inspection'=>$this->suggestion_inspection,
            'times_inspection'=>$this->times_inspection,
            'suggestion_management_leader'=>$this->suggestion_management_leader,
            'times_foreign_affairs_leader'=>$this->times_foreign_affairs_leader,
            'suggestion_manage_committee'=>$this->suggestion_manage_committee,
            'times_manage_committee'=>$this->times_manage_committee,
            'suggestion_work_committee'=>$this->suggestion_work_committee,
            'times_work_committee'=>$this->times_work_committee,
            'pic'=>json_decode($this->pic),
            'close_comment'=>$this->close_comment,
            'is_hidden'=>$this->is_hidden,
            'created_at'=>$this->created_at,
            'updated_at'=>$this->updated_at,
        ];
    }
}

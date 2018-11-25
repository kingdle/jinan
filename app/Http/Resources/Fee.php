<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Fee extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $fee_scale=$this->fee_scale!==NULL?'-'.$this->fee_scale:'';
        return [
            'id'=>$this->id,
            'user_id'=>$this->user_id,
            'fee_category'=>$this->fee_category,
            'fee_name'=>$this->fee_name,
            'fee_scale'=>$this->fee_scale,
            'fee_name_scale'=>$this->fee_name.$fee_scale,
            'fee_remark'=>$this->fee_remark,
            'is_hidden'=>$this->is_hidden,
            'created_at'=>$this->created_at,
            'updated_at'=>$this->updated_at,
            ];
    }
}

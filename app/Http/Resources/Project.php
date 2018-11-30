<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Project extends JsonResource
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
            'area_id'=>$this->area_id,
            'user'=>$this->user(),
            'name'=>$this->name,
            'id_code'=>$this->id_code,
            'id_license'=>$this->id_license,
            'item_code'=>$this->item_code,
            'item_name'=>$this->item_name,
            'register_type'=>$this->register_type,
            'province'=>$this->province,
            'city'=>$this->city,
            'district'=>$this->district,
            'street'=>$this->street,
            'village'=>$this->village,
            'address'=>$this->address,
            'district_code'=>$this->district_code,
            'latitude'=>$this->latitude,
            'longitude'=>$this->longitude,
            'phone'=>$this->phone,
            'industry_code'=>$this->industry_code,
            'holding'=>$this->holding,
            'subjection'=>$this->subjection,
            'item_nature'=>$this->item_nature,
            'item_type'=>$this->item_type,
            'start_at'=>substr($this->start_at,0,10),
            'end_at'=>substr($this->end_at,0,10),
            'produce_at'=>substr($this->produce_at,0,10),
            'item_state'=>$this->item_state,
            'imagesArray'=>json_decode($this->images),
            'filesArray'=>json_decode($this->files),
            'fee_id'=>$this->fee_id,
            'fee'=>$this->fee,
            'fee_count'=>$this->fee_count,
            'is_statistics'=>$this->is_statistics,
            'no_statistics'=>$this->no_statistics,
            'created_at'=>$this->created_at,
            'updated_at'=>$this->updated_at,
        ];
    }
}

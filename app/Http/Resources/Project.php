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

            'item_subhead'=>$this->item_subhead,
            'register_at'=>substr($this->register_at,0,10),
            'industry_name'=>$this->industry_name,
            'industry_type'=>$this->industry_type,
            'industry_description'=>$this->industry_description,
            'investor_name'=>$this->investor_name,
            'investor_address'=>$this->investor_address,
            'is_industry'=>$this->is_industry,
            'statistics_code'=>$this->statistics_code,
            'is_additional'=>$this->is_additional,
            'fee_public_plan'=>$this->fee_public_plan,
            'fee_private_plan'=>$this->fee_private_plan,
            'fee_foreign_plan'=>$this->fee_foreign_plan,
            'fee_public_actual'=>$this->fee_public_actual,
            'fee_private_actual'=>$this->fee_private_actual,
            'fee_foreign_actual'=>$this->fee_foreign_actual,
            'bank_name'=>$this->bank_name,
            'bank_bill'=>$this->bank_bill,
            'bank_at'=>$this->bank_at,
            'builder_licence'=>$this->builder_licence,
            'ratio_input_output'=>$this->ratio_input_output,
            'files_id'=>$this->files_id,
            'linkman'=>$this->linkman,
            'job'=>$this->job,
            'status'=>$this->status,
            'remarks'=>$this->remarks,
            'year_at'=>$this->year_at,
        ];
    }
}

<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Payment extends JsonResource
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
            'to_user_id'=>$this->to_user_id,
            'receivable_id'=>$this->receivable_id,
            'payable_id'=>$this->payable_id,
            'customer'=>$this->customer,
            'goods_name'=>$this->goods_name,
            'packing'=>$this->packing,
            'number_id'=>$this->number_id,
            'extract_id'=>$this->extract_id,
            'weight_box'=>$this->weight_box,
            'quantity'=>$this->quantity,
            'price_income_package'=>$this->price_income_package,
            'price_cost_package'=>$this->price_cost_package,
            'fee_receivable'=>$this->fee_receivable,
            'fee_bale_receivable'=>$this->fee_bale_receivable,
            'fee_before_receivable'=>$this->fee_before_receivable,
            'fee_exchange_receivable'=>$this->fee_exchange_receivable,
            'fee_harbor_receivable'=>$this->fee_harbor_receivable,
            'fee_customs_receivable'=>$this->fee_customs_receivable,
            'fee_inspection_agent_receivable'=>$this->fee_inspection_agent_receivable,
            'fee_inspection_goods_receivable'=>$this->fee_inspection_goods_receivable,
            'fee_inspection_receivable'=>$this->fee_inspection_receivable,
            'fee_inspection_quarantine_receivable'=>$this->fee_inspection_quarantine_receivable,
            'fee_dig_box_receivable'=>$this->fee_dig_box_receivable,
            'fee_transport_short_receivable'=>$this->fee_transport_short_receivable,
            'fee_emergency_receivable'=>$this->fee_emergency_receivable,
            'fee_storage_receivable'=>$this->fee_storage_receivable,
            'fee_cleaning_box_receivable'=>$this->fee_cleaning_box_receivable,
            'fee_adjusting_box_receivable'=>$this->fee_adjusting_box_receivable,
            'fee_repair_box_receivable'=>$this->fee_repair_box_receivable,
            'fee_payable'=>$this->fee_payable,
            'fee_bale_payable'=>$this->fee_bale_payable,
            'fee_before_payable'=>$this->fee_before_payable,
            'fee_exchange_payable'=>$this->fee_exchange_payable,
            'fee_harbor_payable'=>$this->fee_harbor_payable,
            'fee_customs_payable'=>$this->fee_customs_payable,
            'fee_inspection_agent_payable'=>$this->fee_inspection_agent_payable,
            'fee_inspection_goods_payable'=>$this->fee_inspection_goods_payable,
            'fee_inspection_payable'=>$this->fee_inspection_payable,
            'fee_inspection_quarantine_payable'=>$this->fee_inspection_quarantine_payable,
            'fee_dig_box_payable'=>$this->fee_dig_box_payable,
            'fee_transport_short_payable'=>$this->fee_transport_short_payable,
            'fee_emergency_payable'=>$this->fee_emergency_payable,
            'fee_storage_payable'=>$this->fee_storage_payable,
            'fee_cleaning_box_payable'=>$this->fee_cleaning_box_payable,
            'fee_adjusting_box_payable'=>$this->fee_adjusting_box_payable,
            'fee_repair_box_payable'=>$this->fee_repair_box_payable,
            'remark'=>$this->remark,
            'times_at'=>substr($this->times_at,0,10),
            'times_at_md'=>substr($this->times_at,5,5),
            'times_end'=>substr($this->times_end,0,10),
            'times_end_md'=>substr($this->times_end,5,5),
            'close_comment'=>$this->close_comment,
            'is_hidden'=>$this->is_hidden,
            'created_at'=>$this->created_at,
            'updated_at'=>$this->updated_at,
        ];
    }
}

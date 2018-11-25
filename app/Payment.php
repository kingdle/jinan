<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'id', 'user_id','to_user_id','receivable_id','payable_id', 'customer','goods_name','packing','number_id','extract_id','weight_box','quantity',
        'price_income_package','price_cost_package','fee_receivable','fee_bale_receivable','fee_before_receivable','fee_exchange_receivable','fee_harbor_receivable',
        'fee_customs_receivable','fee_inspection_agent_receivable','fee_inspection_goods_receivable',
        'fee_inspection_receivable','fee_inspection_quarantine_receivable','fee_dig_box_receivable',
        'fee_transport_short_receivable', 'fee_emergency_receivable','fee_storage_receivable','fee_cleaning_box_receivable','fee_adjusting_box_receivable',
        'fee_repair_box_receivable', 'fee_payable','fee_bale_payable','fee_before_payable','fee_exchange_payable', 'fee_harbor_payable','fee_customs_payable',
        'fee_inspection_agent_payable','fee_inspection_goods_payable','fee_inspection_payable','fee_inspection_quarantine_payable','fee_dig_box_payable',
        'fee_transport_short_payable', 'fee_emergency_payable','fee_storage_payable','fee_cleaning_box_payable','fee_adjusting_box_payable', 'fee_repair_box_payable',
        'remark','times_at','times_end','close_comment','is_hidden',
    ];
    public function user(){
        return $this->belongsTo('App\User','user_id');
    }
    public function receivable(){
        return $this->hasMany(Receivable::class,'receivable_id');
    }
    public function payable(){
        return $this->hasMany(Receivable::class,'payable_id');
    }
}

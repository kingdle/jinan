<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Park extends Model
{
    protected $fillable = [
        'id',
        'name',
        'info',
        'pic',
        'acreage_plan',
        'acreage_open',
        'acreage_industry', 'sum_development_research',
        'sum_development_innovate', 'sum_development_finance',
        'sum_item_foreign_plan', 'sum_item_foreign_actual',
        'sum_item_outside_city_plan', 'fee_outside_city_actual',
        'fee_export', 'sum_enterprise_four',
        'sum_enterprise_new', 'sum_enterprise_in_exports',
        'sum_industry', 'sum_build',
        'sum_mix', 'sum_service',
        'sum_house', 'fee_profit',
        'fee_tax', 'fee_enterprise_four',
        'fee_enterprise_new', 'fee_enterprise_in_exports',
        'fee_industry', 'fee_build',
        'fee_mix', 'fee_service',
        'fee_house', 'address',
        'is_hidden', 'created_at',
        'updated_at',
    ];
    public function parkdata(){
        return $this->hasOne('App\Parkdata','park_id','id');
    }
}

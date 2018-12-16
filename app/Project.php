<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'id',
        'user_id',
        'area_id',
        'user',
        'name',
        'id_code',
        'id_license',
        'item_code',
        'item_name',
        'register_type',
        'province',
        'city',
        'district',
        'street',
        'village',
        'address',
        'district_code',
        'latitude',
        'longitude',
        'phone',
        'industry_code',
        'holding',
        'subjection',
        'item_nature',
        'item_type',
        'start_at',
        'end_at',
        'produce_at',
        'item_state',
        'images',
        'files',
        'fee_id',
        'fee',
        'fee_count',
        'is_statistics',
        'no_statistics',
        'is_hidden',
        'item_subhead',
        'register_at',
        'industry_name',
        'industry_type',
        'industry_description',
        'investor_name',
        'investor_address',
        'is_industry',
        'statistics_code',
        'is_additional',
        'fee_public_plan',
        'fee_private_plan',
        'fee_foreign_plan',
        'fee_public_actual',
        'fee_private_actual',
        'fee_foreign_actual',
        'bank_name',
        'bank_bill',
        'bank_at',
        'builder_licence',
        'ratio_input_output',
        'files_id',
        'linkman',
        'job',
        'status',
        'remarks',
        'year_at',
    ];
    public function user(){
        return $this->belongsTo('App\User','user_id');
    }
    public function area(){
        return $this->belongsTo('App\Area','area_id');
    }
//    public function product(){
//        return $this->belongsTo('App\Product','product_id');
//    }
}

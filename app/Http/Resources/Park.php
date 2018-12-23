<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Park extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return array
     */

    public function toArray($request)
    {
        $acreage_plan = \App\Park::where("is_hidden", 'F')->sum('acreage_plan');
        $sum_development_research = \App\Park::where("is_hidden", 'F')->sum('sum_development_research');
        $sum_development_innovate = \App\Park::where("is_hidden", 'F')->sum('sum_development_innovate');
        $sum_development_finance = \App\Park::where("is_hidden", 'F')->sum('sum_development_finance');
        $sum_enterprise_in_exports = \App\Park::where("is_hidden", 'F')->sum('sum_enterprise_in_exports');
        $sum_development_all = $sum_development_research + $sum_development_innovate + $sum_development_finance + $sum_enterprise_in_exports;
        $fee_export = \App\Park::where("is_hidden", 'F')->sum('fee_export');
        $parkdata = \App\Parkdata::where("park_id", $this->id)->get();
        return [
            'id' => $this->id,
            'name' => $this->name,
            'info' => $this->info,
            'pic' => $this->pic,
            'acreage_plan' => $this->acreage_plan,
            'acreage_open' => $this->acreage_open,
            'acreage_industry' => $this->acreage_industry,
            'sum_development_research' => $this->sum_development_research,
            'sum_development_innovate' => $this->sum_development_innovate,
            'sum_development_finance' => $this->sum_development_finance,
            'sum_item_foreign_plan' => $this->sum_item_foreign_plan,
            'sum_item_foreign_actual' => round($this->sum_item_foreign_actual/1000,2),
            'sum_item_outside_city_plan' => $this->sum_item_outside_city_plan,
            'fee_outside_city_actual' => round($this->fee_outside_city_actual/10000,2),
            'fee_export' => $this->fee_export,
            'sum_enterprise_four' => $this->sum_enterprise_four,
            'sum_enterprise_new' => $this->sum_enterprise_new,
            'sum_enterprise_in_exports' => $this->sum_enterprise_in_exports,
            'sum_industry' => $this->sum_industry,
            'sum_build' => $this->sum_build,
            'sum_mix' => $this->sum_mix,
            'sum_service' => $this->sum_service,
            'sum_house' => $this->sum_house,
            'fee_profit' => $this->fee_profit,
            'fee_tax' => $this->fee_tax,
            'fee_enterprise_four' => $this->fee_enterprise_four,
            'fee_enterprise_new' => $this->fee_enterprise_new,
            'fee_enterprise_in_exports' => $this->fee_enterprise_in_exports,
            'fee_industry' => $this->fee_industry,
            'fee_build' => $this->fee_build,
            'fee_mix' => $this->fee_mix,
            'fee_service' => $this->fee_service,
            'fee_house' => $this->fee_house,
            'address' => $this->address,
            'is_hidden' => $this->is_hidden,
            'tabledata'=>$parkdata,

            'count_sum_all' => ceil($this->sum_development_research + $this->sum_development_innovate + $this->sum_development_finance + $this->sum_enterprise_in_exports),
            'count_acreage_plan' => ceil($this->acreage_plan / $acreage_plan * 100),
            'count_development' => ceil(($this->sum_development_research + $this->sum_development_innovate + $this->sum_development_finance + $this->sum_enterprise_in_exports) / $sum_development_all * 100),
            'count_fee' => ceil($this->fee_export / $fee_export * 100),
        ];
    }
}

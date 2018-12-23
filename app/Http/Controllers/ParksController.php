<?php

namespace App\Http\Controllers;

use App\Http\Resources\ParkCollection;
use App\Park;
use Illuminate\Http\Request;

class ParksController extends Controller
{
    public function index(){
        $park= Park::with('parkdata')->where("is_hidden",'F')->orderBy('fee_export', 'desc')->get();
        return new ParkCollection($park);
    }
    public function show($id)
    {
        $park= Park::with('parkdata')->find($id);
        if ($park->count() == 0) {
            return response()->json(['status' => false, 'status_code' => '401']);
        }
        return new \App\Http\Resources\Park($park);
    }
    public function top(){
        $acreage_plan = Park::where("is_hidden",'F')->sum('acreage_plan');
        $sum_development_research = Park::where("is_hidden",'F')->sum('sum_development_research');
        $sum_development_innovate = Park::where("is_hidden",'F')->sum('sum_development_innovate');
        $sum_development_finance = Park::where("is_hidden",'F')->sum('sum_development_finance');
        $sum_enterprise_in_exports = Park::where("is_hidden",'F')->sum('sum_enterprise_in_exports');
        $fee_export = Park::where("is_hidden",'F')->sum('fee_export');
        $sum_all = $sum_development_research+$sum_development_innovate+$sum_development_finance+$sum_enterprise_in_exports;

        $data['acreage_plan'] = round($acreage_plan,2);
        $data['sum_development_research'] = $sum_development_research;
        $data['sum_development_innovate'] =$sum_development_innovate;
        $data['sum_development_finance'] = $sum_development_finance;
        $data['sum_enterprise_in_exports'] = $sum_enterprise_in_exports;
        $data['sum_all'] = $sum_all;

        $data['fee_export'] = round($fee_export/10000,2);
        return json_encode($data);
    }
}

<?php

namespace App\Http\Controllers;

use App\Area;
use App\Project;
use Illuminate\Http\Request;

class AreasController extends Controller
{
    public function index(){
        return Area::orderby("fee","desc")->where('is_hidden','F')->get();
    }
    public function ranking($id){
        return Area::orderby($id,"desc")->where('is_hidden','F')->get();
    }
    public function show($id){
        return Area::find($id);
    }
    public function areaStatistics(Request $request){
        if($request->year_at){
            $year_at=$request->year_at;
        }else{
            $year_at=date("Y");
        }
        $areas=[];
        $areaArray=Area::where('is_hidden','F')->get();
        foreach ($areaArray as $item) {
            $fee = Project::where('year_at',$year_at)->sum('fee');
            $fee_public_actual = Project::where('year_at',$year_at)->where('area_id',$item->id)->where('status','0')->sum('fee_public_actual');
            $fee_private_actual = Project::where('year_at',$year_at)->where('area_id',$item->id)->where('status','0')->sum('fee_private_actual');
            $fee_foreign_actual = Project::where('year_at',$year_at)->where('area_id',$item->id)->where('status','0')->sum('fee_foreign_actual');
            $item_sum = Project::where('year_at',$year_at)->where('area_id',$item->id)->where('status','0')->count();
            $item_sum_all = Project::where('year_at',$year_at)->where('area_id',$item->id)->count();
            $item_start = Project::where('year_at',$year_at)->where('area_id',$item->id)->where('status','1')->count();
            $item_finish = Project::where('year_at',$year_at)->where('area_id',$item->id)->where('status','3')->count();
            $ten_fee=$fee_public_actual+$fee_private_actual+$fee_foreign_actual;

//            $item_sum_make=Project::where('industry_type','like','%高端制造产业%')->where('year_at',$year_at)->where('area_id',$item->id)->count();
//            $item_sum_chemical=Project::where('industry_type','like','%高端化工产业%')->where('year_at',$year_at)->where('area_id',$item->id)->count();
//            $item_sum_information=Project::where('industry_type','like','%新一代信息技术%')->where('year_at',$year_at)->where('area_id',$item->id)->count();
//            $item_sum_material=Project::where('industry_type','like','%新材料%')->where('year_at',$year_at)->where('area_id',$item->id)->count();
//            $item_sum_energy=Project::where('industry_type','like','%新能源%')->where('year_at',$year_at)->where('area_id',$item->id)->count();
//            $item_sum_medicine=Project::where('industry_type','like','%医药产业%')->where('year_at',$year_at)->where('area_id',$item->id)->count();
//            $item_sum_ocean=Project::where('industry_type','like','%现代海洋%')->where('year_at',$year_at)->where('area_id',$item->id)->count();
//            $item_sum_agriculture=Project::where('industry_type','like','%现代高效农业%')->where('year_at',$year_at)->where('area_id',$item->id)->count();
//            $item_sum_culture=Project::where('industry_type','like','%文化创意产业%')->where('year_at',$year_at)->where('area_id',$item->id)->count();
//            $item_sum_travel=Project::where('industry_type','like','%精品旅游产业%')->where('year_at',$year_at)->where('area_id',$item->id)->count();
//            $item_sum_combination=Project::where('industry_type','like','%医药结合产业%')->where('year_at',$year_at)->where('area_id',$item->id)->count();
//            $item_sum_finance=Project::where('industry_type','like','%现代金融服务业%')->where('year_at',$year_at)->where('area_id',$item->id)->count();


            $data['ten_fee'] = round($ten_fee/10000,2);
            $data['fee'] = round($fee/10000,2);
            $data['item_sum'] = $item_sum;
            $data['item_sum_all'] =$item_sum_all;
            $data['item_start'] = $item_start;
            $data['item_finish'] = $item_finish;
            $data['district']=$item->district;
            $data['pic']=$item->pic;
            $data['id']=$item->id;

//            $data['item_sum_make']=$item_sum_make;
//            $data['item_sum_chemical']=$item_sum_chemical;
//            $data['item_sum_information']=$item_sum_information;
//            $data['item_sum_material']=$item_sum_material;
//            $data['item_sum_energy']=$item_sum_energy;
//            $data['item_sum_medicine']=$item_sum_medicine;
//            $data['item_sum_ocean']=$item_sum_ocean;
//            $data['item_sum_agriculture']=$item_sum_agriculture;
//            $data['item_sum_culture']=$item_sum_culture;
//            $data['item_sum_travel']=$item_sum_travel;
//            $data['item_sum_combination']=$item_sum_combination;
//            $data['item_sum_finance']=$item_sum_finance;


            $areas[]=$data;
        }
        if($request->querySort){
            $querySort=$request->querySort;
        }else{
            $querySort='ten_fee';
        }
        $areasAll = collect($areas)->sortByDesc($querySort);

        return $areasAll->values()->all();

    }
    public function queryArea()
    {
        $areas = Area::distinct()->where('is_hidden','F')->orderby("fee","desc")->get(['id','district','fee']);
        $multiplied = $areas->map(function ($item, $key) {
            return [
                'value'=>$item->district,
                'id'=>$item->id,
            ];
        })->all();
        return $multiplied;
    }

}

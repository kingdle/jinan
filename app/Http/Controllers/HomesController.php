<?php

namespace App\Http\Controllers;

use App\Project;
use Illuminate\Http\Request;

class HomesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
//    public function __construct()
//    {
//        $this->middleware('auth');
//    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }
    public function show($year_at)
    {
        if($year_at ==''){
            $year_at=date("Y");
        }
        $fee = Project::where('year_at',$year_at)->sum('fee');
        $fee_public_actual = Project::where('year_at',$year_at)->where('status','0')->sum('fee_public_actual');
        $fee_private_actual = Project::where('year_at',$year_at)->where('status','0')->sum('fee_private_actual');
        $fee_foreign_actual = Project::where('year_at',$year_at)->where('status','0')->sum('fee_foreign_actual');
        $item_sum = Project::where('year_at',$year_at)->where('status','0')->count();
        $item_sum_all = Project::where('year_at',$year_at)->count();
        $item_start = Project::where('year_at',$year_at)->where('status','1')->count();
        $item_finish = Project::where('year_at',$year_at)->where('status','3')->count();
        $ten_fee=$fee_public_actual+$fee_private_actual+$fee_foreign_actual;

        $data['ten_fee'] = round($ten_fee/10000,2);
        $data['fee'] = round($fee/10000,2);
        $data['ten_fee_radio'] = round($ten_fee/$fee*100,0);
        $data['item_sum'] = $item_sum;
        $data['item_sum_all'] =$item_sum_all;
        $data['item_sum_ratio'] = round($item_sum/$item_sum_all*100,0);
        $data['item_start'] = $item_start;
        $data['item_start_ratio'] = round($item_start/$item_sum_all*100,0);
        $data['item_finish'] = $item_finish;
        $data['item_finish_ratio'] = round($item_finish/$item_sum_all*100,0);

        return json_encode($data);
    }
    public function industryChart($year_at){
        if($year_at ==''){
            $year_at=date("Y");
        }
        $industryArray=['高端制造产业','高端化工产业','新一代信息技术','新材料','新能源','医药产业','现代海洋','现代高效农业','文化创意产业','精品旅游产业','医药结合产业','现代金融服务业'];
        $item_industry=[];
        foreach ($industryArray as $industry_type){
            $array = [
                'industryName' => $industry_type,'industryNum' => Project::where('industry_type','like','%'.$industry_type.'%')->where('year_at',$year_at)->count()
            ];
            $item_industry[]=$array;
        }
        $areasAll = collect($item_industry)->sortByDesc('industryNum');
        return $areasAll->values()->all();
    }
    public function cityChart($year_at){
        if($year_at ==''){
            $year_at=date("Y");
        }
        $industryArray=['北京','安徽','福建','广东','河南','湖北','江苏','江西','山东','陕西','上海','天津','西藏','浙江'];
        $item_industry=[];
        foreach ($industryArray as $industry_type){
            $array = [
                'cityName' => $industry_type,'cityNum' => Project::where('investor_address','like','%'.$industry_type.'%')->where('year_at',$year_at)->count()
            ];
            $item_industry[]=$array;
        }
        $areasAll = collect($item_industry)->sortByDesc('cityNum');
        return $areasAll->values()->all();
    }
}

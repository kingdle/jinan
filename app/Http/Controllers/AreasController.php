<?php

namespace App\Http\Controllers;

use App\Area;
use Illuminate\Http\Request;

class AreasController extends Controller
{
    public function index(){
        return Area::orderby("fee","desc")->get();
    }
    public function ranking($id){
        return Area::orderby($id,"desc")->get();
    }
    public function show($id){
        return Girl::with('user')->where("user_id",$id)->first();
    }
    public function queryArea()
    {
        $areas = Area::distinct()->orderby("fee","desc")->get(['id','district','fee']);
        $multiplied = $areas->map(function ($item, $key) {
            return [
                'value'=>$item->district,
                'id'=>$item->id,
            ];
        })->all();
        return $multiplied;
    }
}

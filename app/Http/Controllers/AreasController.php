<?php

namespace App\Http\Controllers;

use App\Area;
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

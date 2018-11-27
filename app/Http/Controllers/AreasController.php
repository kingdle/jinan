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
}

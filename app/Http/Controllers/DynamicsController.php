<?php

namespace App\Http\Controllers;

use App\Dynamic;
use App\Http\Resources\DynamicCollection;
use Illuminate\Http\Request;

class DynamicsController extends Controller
{
    public function index(){
        $dynamics = Dynamic::where("is_hidden",'F')->paginate(10);
        return new DynamicCollection($dynamics);
    }
    public function show($id){
        $dynamic= Dynamic::find($id);
        if ($dynamic->count() == 0) {
            return response()->json(['status' => false, 'status_code' => '401']);
        }
        return new \App\Http\Resources\Dynamic($dynamic);
    }
}

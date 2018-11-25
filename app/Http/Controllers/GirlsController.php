<?php

namespace App\Http\Controllers;

use App\Girl;
use App\User;
use Auth;
use Illuminate\Http\Request;

class GirlsController extends Controller
{
    public function index(){
        return Girl::with('user')->where("is_hidden",'F')->paginate(9);
    }

    public function show($id){
        return Girl::with('user')->where("user_id",$id)->first();
    }
    public function admission(Request $request){
        $userId = Auth::guard('api')->user()->id;
            $no = request('id_card', '');
            $year = substr($no, 6, 4);
            $monthDay = substr($no, 10, 4);
            $age = date('Y') - $year;
            if ($monthDay > date('md')) {
                $age--;
            }
        $girl=Girl::create([
            'user_id' => $userId,
            'product_id' => request('product_id', ''),
            'number_id' => uniqid(),
            'username' => request('username', ''),
            'id_card' => request('id_card', ''),
            'id_card_front' => request('id_card_front', ''),
            'id_card_back' => request('id_card_back', ''),
            'real_head' => request('real_head', ''),
            'age' => $age,
            'native_place' => request('native_place', ''),
            'education' => request('education', ''),
            'health_card' => request('health_card', ''),
            'level' => request('level', ''),
            'price' => request('price', '0'),
            'service_times' => request('service_times', ''),
            'experience' => request('experience', ''),
        ]);
        $user = User::find($userId);
        $attributes['is_active'] = '1';
        $user->update($attributes);
        return response()->json([
            'data'=>$girl,
            'user'=>$user
        ], 200);
    }
    public function distance(Request $request)
    {
        if($request->latitude){
            $lat = $request->latitude;
        }else{
            $lat ='36.826762';
        }
        if($request->longitude){
            $lng = $request->longitude;
        }else{
            $lng = '118.913778';
        }
        $girls = Girl::where("is_hidden",'!=','T')->where("is_service",'!=','T')
            ->selectRaw('id,summary,title,avatar,province,cityInfo,address,villageInfo,code,longitude,latitude,dynamic_count,pic_count,acos(cos(' . $lat . '*pi()/180 )*cos(latitude*pi()/180)*cos(' . $lng . '*pi()/180 -longitude*pi()/180)+sin(' . $lat . '*pi()/180 )*sin(latitude*pi()/180))*6370996.81  as distance')  //使用原生sql
            ->orderby("distance","asc")->paginate(20);
        return $girls;
    }
}

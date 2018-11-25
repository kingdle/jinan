<?php

namespace App\Http\Controllers;

use App\Reception;
use App\Http\Resources\ReceptionCollection;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ReceptionsController extends Controller
{
    public function index()
    {
        $receptions = Reception::with('user')->orderBy('id', 'desc')->where('is_hidden','F')->paginate(9);
        return new ReceptionCollection($receptions);
    }
    public function listSize(Request $request)
    {
        $abroads = Reception::with('user')->orderBy('id', 'desc')->paginate($request->pagination);
        return new ReceptionCollection($abroads);
    }
    public function show($id)
    {
        $dynamics = Reception::find($id);
        if ($dynamics->count() == 0) {
            return response()->json(['status' => false, 'status_code' => '401']);
        }
        return new Reception($dynamics);
    }
    public function store(Request $request)
    {
        $user_id=Auth::guard('api')->user()->id;
//        if($request->pic){
//            $picfile = file_get_contents($request->pic);
//            $filename = 'externalaffairs/'.$user_id.'EA'.uniqid().'.jpg';
//            Storage::disk('upyun')->write($filename, $picfile);
//            $pic=config('filesystems.disks.upyun.protocol').'://'.config('filesystems.disks.upyun.domain').'/'.$filename;
//        }else{
//            $pic='';
//        }
        if($request->enclosure){
            $enclosure=json_encode($request->enclosure);
        }else{
            $enclosure="[]";
        }

        if($request->sendDate){
            $times_at=$request->sendDate['0'];
            $times_end=$request->sendDate['1'];
        }else{
            $times_at=now();
            $times_end=now();
        }
        if($request->sendDate){
            $times_at=$request->sendDate['0'];
            $times_end=$request->sendDate['1'];
            function count_days($a,$b){
                $a_dt=getdate($a);
                $b_dt=getdate($b);
                $a_new=mktime(12,0,0,$a_dt['mon'],$a_dt['mday'],$a_dt['year']);
                $b_new=mktime(12,0,0,$b_dt['mon'],$b_dt['mday'],$b_dt['year']);
                return round(abs($a_new-$b_new)/86400);
            }
            $date1=strtotime($times_at);
            $date2=strtotime($times_end);
            $days=count_days($date1,$date2);
        }else{
            $days='';
        }
        $reception=Reception::create([
            'user_id' => $user_id,
            'gift_id' => request('gift_id', ''),
            'hotel_id' => request('hotel_id', ''),
            'number_id' => request('number_id', uniqid()),
            'nation' => request('nation', ''),
            'activity' => request('activity', ''),
            'organizer' => request('organizer', ''),
            'delegation' => request('delegation', ''),
            'office_works' => request('office_works', ''),
            'objective' => request('objective', ''),
            'times_at' => $times_at,
            'times_end' => $times_end,
            'property' => request('property', ''),
            'gift' => request('gift', ''),
            'number_peoples' => request('number_peoples', ''),
            'banquet' => request('banquet', ''),
            'banquet_hotel' => request('banquet_hotel', ''),
            'banquet_address' => request('banquet_address', ''),
            'harvest' => request('harvest', ''),
            'assign' => request('assign', ''),
            'reception_department' => request('reception_department', ''),
            'reasons_plan' => request('reasons_plan', ''),
            'reasons_content' => request('reasons_content', ''),
            'reasons_keynote' => request('reasons_keynote', ''),
            'enclosure' => $enclosure,
            'suggestion_management_leader' => request('suggestion_management_leader', ''),
            'suggestion_manage_committee' => request('suggestion_manage_committee', ''),
            'suggestion_work_committee' => request('suggestion_work_committee', ''),
            'close_comment' => request('close_comment', ''),
            'is_hidden' => request('is_hidden', 'F'),
        ]);
        if ($reception) {
            $data['status'] = true;
            $data['status_code'] = '200';
            $data['message'] = '发布成功';
            $data['receptions'] = $this->index();
            return json_encode($data);
        } else {
            $data['status'] = false;
            $data['status_code'] = '501';
            $data['msg'] = '系统繁忙，请售后再试';
            return json_encode($data);
        }
    }
    public function update(Request $request)
    {
        $user_id=Auth::guard('api')->user()->id;
        $abroad = Reception::where('id', $request->id)->first();
        if($request->sendDate){
            $times_at=$request->sendDate['0'];
            $times_end=$request->sendDate['1'];
        }else{
            $times_at=now();
            $times_end=now();
        }
        if($request->enclosure){
            $enclosure=json_encode($request->enclosure);
        }else{
            $enclosure="[]";
        }
        if($request->sendDate){
            $times_at=$request->sendDate['0'];
            $times_end=$request->sendDate['1'];
            function count_days($a,$b){
                $a_dt=getdate($a);
                $b_dt=getdate($b);
                $a_new=mktime(12,0,0,$a_dt['mon'],$a_dt['mday'],$a_dt['year']);
                $b_new=mktime(12,0,0,$b_dt['mon'],$b_dt['mday'],$b_dt['year']);
                return round(abs($a_new-$b_new)/86400);
            }
            $date1=strtotime($times_at);
            $date2=strtotime($times_end);
            $days=count_days($date1,$date2);
        }else{
            $days='';
        }
        $attributes['gift_id'] = $request->gift_id;
        $attributes['hotel_id'] = $request->hotel_id;
        $attributes['nation'] = $request->nation;
        $attributes['activity'] = $request->activity;
        $attributes['organizer'] = $request->organizer;
        $attributes['delegation'] = $request->delegation;
        $attributes['office_works'] = $request->office_works;
        $attributes['objective'] = $request->objective;
        $attributes['times_at'] = $times_at;
        $attributes['times_end'] = $times_end;
        $attributes['property'] = $request->property;
        $attributes['gift'] = $request->gift;
        $attributes['number_peoples'] = $request->number_peoples;
        $attributes['banquet'] = $request->banquet;
        $attributes['banquet_hotel'] = $request->banquet_hotel;
        $attributes['banquet_address'] = $request->banquet_address;
        $attributes['harvest'] = $request->harvest;
        $attributes['assign'] = $request->assign;
        $attributes['reception_department'] = $request->reception_department;
        $attributes['reasons_plan'] = $request->reasons_plan;
        $attributes['reasons_content'] = $request->reasons_content;
        $attributes['reasons_keynote'] = $request->reasons_keynote;
        $attributes['enclosure'] = $enclosure;
        $attributes['suggestion_management_leader'] = $request->suggestion_management_leader;
        $attributes['suggestion_manage_committee'] = $request->suggestion_manage_committee;
        $attributes['suggestion_work_committee'] = $request->suggestion_work_committee;
        $abroad->update($attributes);
        $abroads = Reception::with('user')->orderBy('id', 'desc')->paginate(9);
        if ($abroad) {
            $data['status'] = true;
            $data['status_code'] = '200';
            $data['message'] = '发布成功';
            $data['abroads'] = $abroads;
            return json_encode($data);
        } else {
            $data['status'] = false;
            $data['status_code'] = '501';
            $data['msg'] = '系统繁忙，请售后再试';
            return json_encode($data);
        }
    }
    public function upFile(Request $request)
    {
        if (!$request->hasFile('file')) {
            return response()->json([], 500, '无法获取上传文件');
        }
        $file = $request->file('file');
        $userId = Auth::guard('api')->user()->id;
        if ($file->isValid()) {
            // 获取文件相关信息
            $originalName = $file->getClientOriginalName(); // 文件原名
            $ext = $file->getClientOriginalExtension();     // 扩展名
            $realPath = $file->getRealPath();   //临时文件的绝对路径
            $type = $file->getClientMimeType();     // image/jpeg

            // 上传文件
            $filename = 'externalaffairs/files/' .$userId. 'EA' . uniqid() . '.' . $ext;
            Storage::disk('upyun')->writeStream($filename, fopen($realPath, 'r'));
            $filePath = config('filesystems.disks.upyun.protocol') . '://' . config('filesystems.disks.upyun.domain') . '/' . $filename;
            return response()->json([
                'status_code' => 200,
                'message' => 'success',
                'photo' => $filePath,
                'name' => $originalName,
                'files'=>[$originalName=>$filePath]
            ]);

        } else {
            return response()->json([], 500, '文件未通过验证');
        }
    }
    public function destroy($id)
    {
        $abroad = Reception::where('id', $id)->first();
        $attributes['is_hidden'] = 'T';
        $attributes['updated_at'] = now();
        $abroad->update($attributes);
    }
    public function destroyImage(Request $request)
    {
        $pic=$request->pic;
        $abroad = Reception::where('id', $request->id)->first();
        $picArray =json_decode($abroad['pic']);
        $pArray = array_diff($picArray, array($pic));
        if($pArray != []){
            $saveArray=array_values($pArray);
            $attributes['pic'] = json_encode($saveArray);
            $abroad->update($attributes);
        }else{
            $attributes['pic'] = '[]';
            $abroad->update($attributes);
        }
        return json_decode($abroad['pic']);
    }
    public function queryNationList()
    {
        $users = Reception::where('nation', '!=', '')->where('is_hidden', '=', 'F')->distinct()->get(['nation']);
        $multiplied = $users->map(function ($item, $key) {
            return [
                'value'=>$item->nation,
            ];
        })->all();
        return $multiplied;
    }
    public function queryDepartmentList()
    {
        $departments = Reception::where('department', '!=', '')->where('is_hidden', '=', 'F')->distinct()->get(['department']);
        $multiplied = $departments->map(function ($item, $key) {
            return [
                'value'=>$item->department,
            ];
        })->all();
        return $multiplied;
    }
    public function queryResult(Request $request)
    {
        if($request->nation){
            $receptions = Reception::where('nation','like','%'.$request->nation.'%')->where('is_hidden', '=', 'F')->orderBy('id', 'desc')->paginate(9);
        }
        if($request->department){
            $receptions = Reception::where('department','=',$request->department)->where('is_hidden', '=', 'F')->orderBy('id', 'desc')->paginate(9);
        }
        if($request->villageInfo){
            $receptions = Reception::where('villageInfo','like','%'.$request->villageInfo.'%')->orwhere('address','like','%'.$request->villageInfo.'%')->where('is_hidden', '=', 'F')->orderBy('id', 'desc')->paginate(9);
        }
        if($request->start_at){
            $receptions = Reception::where('start_at','like','%'.$request->start_at.'%')->where('is_hidden', '=', 'F')->orderBy('id', 'desc')->paginate(9);
        }
        if($request->end_at){
            $receptions = Reception::where('end_at','like','%'.$request->end_at.'%')->where('is_hidden', '=', 'F')->orderBy('id', 'desc')->paginate(9);
        }
        if($request->tag_id){
            $receptions = Reception::where('tag_id','=',$request->tag_id)->where('is_hidden', '=', 'F')->orderBy('id', 'desc')->paginate(9);
        }
        if ($receptions->count() == 0) {
            $data['status'] = false;
            $data['status_code'] = '401';
            $data['msg'] = '订单为空';
            $data['data'] = [];
            $data['links'] = '';
            $data['meta'] = [
                'current_page' => 0,
                'from' => 0,
                'last_page' => 0,
                'path' => '',
                'per_page' => 9,
                'to' => 0,
                'total' => 0
            ];
            return json_encode($data);
        }
        return new ReceptionCollection($receptions);

    }
}

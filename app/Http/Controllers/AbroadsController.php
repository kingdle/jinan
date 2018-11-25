<?php

namespace App\Http\Controllers;

use App\Abroad;
use App\Http\Resources\AbroadCollection;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AbroadsController extends Controller
{
    public function index()
    {
        $abroads = Abroad::with('user')->orderBy('id', 'desc')->where('is_hidden','F')->paginate(9);
        return new AbroadCollection($abroads);
    }
    public function listSize(Request $request)
    {
        $abroads = Abroad::with('user')->orderBy('id', 'desc')->paginate($request->pagination);
        return new AbroadCollection($abroads);
    }
    public function show($id)
    {
        $dynamics = Abroad::find($id);
        if ($dynamics->count() == 0) {
            return response()->json(['status' => false, 'status_code' => '401']);
        }
        return new Abroad($dynamics);
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
        if($request->pic){
            $pic=json_encode($request->pic);
        }else{
            $pic="[]";
        }
        if($request->sendDate){
            $times_at=$request->sendDate['0'];
            $times_end=$request->sendDate['1'];
        }else{
            $times_at=now();
            $times_end=now();
        }
        if($request->gender=='男'){
            $gender='1';
        }else{
            $gender='2';
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

        $abroad=Abroad::create([
            'user_id' => $user_id,
            'gift_id' => request('gift_id', ''),
            'number_id' => request('number_id', uniqid()),
            'department' => request('department', ''),
            'name' => request('names', ''),
            'gender' => $gender,
            'age' => request('age', ''),
            'duties' => request('duties', ''),
            'level' => request('level', ''),
            'system_part' => request('system_part', ''),
            'place_to' => request('place_to', ''),
            'days' => request('days', ''),
            'batch_number' => request('batch_number', ''),
            'funds' => request('funds', ''),
            'remarks' => request('remarks', ''),
            'times_at' => $times_at,
            'times_end' => $times_end,
            'days'=>$days,
            'linkman' => request('linkman', ''),
            'linkman_duties' => request('linkman_duties', ''),
            'linkman_phone' => request('linkman_phone', ''),
            'by_group' => request('by_group', ''),
            'visits_category' => request('visits_category', ''),
            'reasons_visit' => request('reasons_visit', ''),
            'suggestion_foreign_affairs' => request('suggestion_foreign_affairs', ''),
            'suggestion_inspection' => request('suggestion_inspection', ''),
            'suggestion_management_leader' => request('suggestion_management_leader', ''),
            'suggestion_foreign_affairs_leader' => request('suggestion_foreign_affairs_leader', ''),
            'suggestion_manage_committee' => request('suggestion_manage_committee', ''),
            'suggestion_work_committee' => request('suggestion_work_committee', ''),
            'close_comment' => request('close_comment', ''),
            'is_hidden' => request('is_hidden', 'F'),
            'times_foreign_affairs'=>request('times_foreign_affairs',now()),
            'times_inspection'=>request('times_inspection',now()),
            'times_management_leader'=>request('times_management_leader',now()),
            'times_foreign_affairs_leader'=>request('times_foreign_affairs_leader',now()),
            'times_manage_committee'=>request('times_manage_committee',now()),
            'times_work_committee'=>request('times_work_committee',now()),
            'pic'=>$pic
        ]);
        $abroads = $this->index();
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
    public function update(Request $request)
    {
        $user_id=Auth::guard('api')->user()->id;
        $abroad = Abroad::where('id', $request->id)->first();
        if($request->sendDate){
            $times_at=$request->sendDate['0'];
            $times_end=$request->sendDate['1'];
        }else{
            $times_at=now();
            $times_end=now();
        }
        if($request->pic){
            $pic=json_encode($request->pic);
        }else{
            $pic=$abroad->pic;
        }
        if($request->gender=='男'){
            $gender='1';
        }else{
            $gender='2';
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
        $attributes['name'] = $request->names;
        $attributes['gift_id'] = $request->gift_id;
        $attributes['number_id'] = $request->number_id;
        $attributes['department'] = $request->department;
        $attributes['gender'] = $gender;
        $attributes['age'] = $request->age;
        $attributes['duties'] = $request->duties;
        $attributes['level'] = $request->level;
        $attributes['system_part'] = $request->system_part;
        $attributes['place_to'] = $request->place_to;
        $attributes['days'] = $days;
        $attributes['batch_number'] = $request->batch_number;
        $attributes['pic'] = $pic;
        $attributes['funds'] = $request->funds;
        $attributes['remarks'] = $request->remarks;
        $attributes['times_at'] = $times_at;
        $attributes['times_end'] = $times_end;
        $attributes['linkman'] = $request->linkman;
        $attributes['linkman_duties'] = $request->linkman_duties;
        $attributes['linkman_phone'] = $request->linkman_phone;
        $attributes['by_group'] = $request->by_group;
        $attributes['visits_category'] = $request->visits_category;
        $attributes['reasons_visit'] = $request->reasons_visit;
        $attributes['suggestion_foreign_affairs'] = $request->suggestion_foreign_affairs;
        $attributes['suggestion_inspection'] = $request->suggestion_inspection;
        $attributes['suggestion_management_leader'] = $request->suggestion_management_leader;
        $attributes['suggestion_foreign_affairs_leader'] = $request->suggestion_foreign_affairs_leader;
        $attributes['suggestion_manage_committee'] = $request->suggestion_manage_committee;
        $attributes['suggestion_work_committee'] = $request->suggestion_work_committee;
        $attributes['times_foreign_affairs'] = $request->times_foreign_affairs;
        $attributes['times_inspection'] = $request->times_inspection;
        $attributes['times_management_leader'] = $request->times_management_leader;
        $attributes['times_foreign_affairs_leader'] = $request->times_foreign_affairs_leader;
        $attributes['times_manage_committee'] = $request->times_manage_committee;
        $attributes['times_work_committee'] = $request->times_work_committee;
        $abroad->update($attributes);
        $abroads = Abroad::with('user')->orderBy('id', 'desc')->paginate(9);
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
            $filename = 'externalaffairs/' .$userId. 'EA' . uniqid() . '.' . $ext;
            Storage::disk('upyun')->writeStream($filename, fopen($realPath, 'r'));
            $filePath = config('filesystems.disks.upyun.protocol') . '://' . config('filesystems.disks.upyun.domain') . '/' . $filename;
            return response()->json([
                'status_code' => 200,
                'message' => 'success',
                'photo' => $filePath,
                'name' => $originalName,
            ]);

        } else {
            return response()->json([], 500, '文件未通过验证');
        }
    }
    public function destroy($id)
    {
        $abroad = Abroad::where('id', $id)->first();
        $attributes['is_hidden'] = 'T';
        $attributes['updated_at'] = now();
        $abroad->update($attributes);
    }
    public function destroyImage(Request $request)
    {
        $pic=$request->pic;
        $abroad = Abroad::where('id', $request->id)->first();
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
    public function queryNameList()
    {
        $users = Abroad::where('name', '!=', '')->where('is_hidden', '=', 'F')->distinct()->get(['name']);
        $multiplied = $users->map(function ($item, $key) {
            return [
                'value'=>$item->name,
            ];
        })->all();
        return $multiplied;
    }
    public function queryDepartmentList()
    {
        $departments = Abroad::where('department', '!=', '')->where('is_hidden', '=', 'F')->distinct()->get(['department']);
        $multiplied = $departments->map(function ($item, $key) {
            return [
                'value'=>$item->department,
            ];
        })->all();
        return $multiplied;
    }
    public function queryResult(Request $request)
    {
        if($request->name){
            $abroads = Abroad::where('name','like','%'.$request->name.'%')->where('is_hidden', '=', 'F')->orderBy('id', 'desc')->paginate(9);
        }
        if($request->department){
            $abroads = Abroad::where('department','=',$request->department)->where('is_hidden', '=', 'F')->orderBy('id', 'desc')->paginate(9);
        }
        if($request->villageInfo){
            $abroads = Abroad::where('villageInfo','like','%'.$request->villageInfo.'%')->orwhere('address','like','%'.$request->villageInfo.'%')->where('is_hidden', '=', 'F')->orderBy('id', 'desc')->paginate(9);
        }
        if($request->start_at){
            $abroads = Abroad::where('start_at','like','%'.$request->start_at.'%')->where('is_hidden', '=', 'F')->orderBy('id', 'desc')->paginate(9);
        }
        if($request->end_at){
            $abroads = Abroad::where('end_at','like','%'.$request->end_at.'%')->where('is_hidden', '=', 'F')->orderBy('id', 'desc')->paginate(9);
        }
        if($request->tag_id){
            $abroads = Abroad::where('tag_id','=',$request->tag_id)->where('is_hidden', '=', 'F')->orderBy('id', 'desc')->paginate(9);
        }
        if ($abroads->count() == 0) {
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
        return new AbroadCollection($abroads);

    }
}

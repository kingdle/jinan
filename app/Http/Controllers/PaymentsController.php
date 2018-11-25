<?php

namespace App\Http\Controllers;

use App\Payment;
use App\Http\Resources\PaymentCollection;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PaymentsController extends Controller
{
    public function index()
    {
        $receptions = Payment::with('user')->orderBy('id', 'desc')->where('is_hidden','F')->paginate(8);
        return new PaymentCollection($receptions);
    }
    public function listSize(Request $request)
    {
        $abroads = Payment::with('user')->orderBy('id', 'desc')->where('is_hidden','F')->paginate($request->pagination);
        return new PaymentCollection($abroads);
    }
    public function show($id)
    {
        $dynamics = Payment::find($id);
        if ($dynamics->count() == 0) {
            return response()->json(['status' => false, 'status_code' => '401']);
        }
        return new Payment($dynamics);
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
        $reception=Payment::create([
            'user_id' => $user_id,
            'customer' => request('customer', ''),
            'goods_name' => request('goods_name', ''),
            'packing' => request('packing',''),
            'number_id' => request('number_id', uniqid()),
            'extract_id' => request('extract_id', ''),
            'weight_box' => request('weight_box', ''),
            'quantity' => request('quantity', ''),
            'price_income_package' => request('price_income_package', '0'),
            'price_cost_package' => request('price_cost_package', '0'),
            'fee_receivable' => request('fee_receivable', '0'),
            'fee_bale_receivable' => request('fee_bale_receivable', '0'),
            'fee_before_receivable' => request('fee_before_receivable', '0'),
            'fee_emergency_receivable' => request('fee_emergency_receivable', '0'),
            'fee_storage_receivable' => request('fee_storage_receivable', '0'),
            'fee_cleaning_box_receivable' => request('fee_cleaning_box_receivable', '0'),
            'fee_adjusting_box_receivable' => request('fee_adjusting_box_receivable', '0'),
            'fee_repair_box_receivable' => request('fee_repair_box_receivable', '0'),

            'fee_payable' => request('fee_payable', '0'),
            'fee_bale_payable' => request('fee_bale_payable', '0'),
            'fee_before_payable' => request('fee_before_payable', '0'),
            'fee_exchange_payable' => request('fee_exchange_payable', '0'),
            'fee_harbor_payable' => request('fee_harbor_payable', '0'),
            'fee_customs_payable' => request('fee_customs_payable', '0'),
            'fee_inspection_agent_payable' => request('fee_inspection_agent_payable', '0'),
            'fee_inspection_goods_payable' => request('fee_inspection_goods_payable', '0'),
            'fee_inspection_payable' => request('fee_inspection_payable', '0'),
            'fee_inspection_quarantine_payable' => request('fee_inspection_quarantine_payable', '0'),
            'fee_dig_box_payable' => request('fee_dig_box_payable', '0'),
            'fee_transport_short_payable' => request('fee_transport_short_payable', '0'),
            'fee_emergency_payable' => request('fee_emergency_payable', '0'),
            'fee_storage_payable' => request('fee_storage_payable', '0'),
            'fee_cleaning_box_payable' => request('fee_cleaning_box_payable','0'),
            'fee_adjusting_box_payable' => request('fee_adjusting_box_payable', '0'),
            'fee_repair_box_payable' => request('fee_repair_box_payable', '0'),
            'remark' => request('remark', ''),
        ]);
        if ($reception) {
            $data['status'] = true;
            $data['status_code'] = '200';
            $data['message'] = '发布成功';
            $data['payments'] = $this->index();
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
        $abroad = Payment::where('id', $request->id)->first();
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
        $abroads = Payment::with('user')->orderBy('id', 'desc')->paginate(9);
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
        $abroad = Payment::where('id', $id)->first();
        $attributes['is_hidden'] = 'T';
        $attributes['updated_at'] = now();
        $abroad->update($attributes);
    }
    public function destroyImage(Request $request)
    {
        $pic=$request->pic;
        $abroad = Payment::where('id', $request->id)->first();
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
        $users = Payment::where('nation', '!=', '')->where('is_hidden', '=', 'F')->distinct()->get(['nation']);
        $multiplied = $users->map(function ($item, $key) {
            return [
                'value'=>$item->nation,
            ];
        })->all();
        return $multiplied;
    }
    public function queryDepartmentList()
    {
        $departments = Payment::where('department', '!=', '')->where('is_hidden', '=', 'F')->distinct()->get(['department']);
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
            $receptions = Payment::where('customer','like','%'.$request->nation.'%')->where('is_hidden', '=', 'F')->orderBy('id', 'desc')->paginate(9);
        }
        if($request->department){
            $receptions = Payment::where('department','=',$request->department)->where('is_hidden', '=', 'F')->orderBy('id', 'desc')->paginate(9);
        }
        if($request->villageInfo){
            $receptions = Payment::where('villageInfo','like','%'.$request->villageInfo.'%')->orwhere('address','like','%'.$request->villageInfo.'%')->where('is_hidden', '=', 'F')->orderBy('id', 'desc')->paginate(9);
        }
        if($request->start_at){
            $receptions = Payment::where('start_at','like','%'.$request->start_at.'%')->where('is_hidden', '=', 'F')->orderBy('id', 'desc')->paginate(9);
        }
        if($request->end_at){
            $receptions = Payment::where('end_at','like','%'.$request->end_at.'%')->where('is_hidden', '=', 'F')->orderBy('id', 'desc')->paginate(9);
        }
        if($request->tag_id){
            $receptions = Payment::where('tag_id','=',$request->tag_id)->where('is_hidden', '=', 'F')->orderBy('id', 'desc')->paginate(9);
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
        return new PaymentCollection($receptions);

    }
}

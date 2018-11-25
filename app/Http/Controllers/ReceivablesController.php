<?php

namespace App\Http\Controllers;

use App\Fee;
use App\Http\Resources\ReceivableCollection;
use App\Receivable;
use Auth;
use Illuminate\Http\Request;

class ReceivablesController extends Controller
{
    public function index()
    {
        $receivables = Receivable::with('fee')->orderBy('id', 'desc')->where('is_hidden','F')->get();
        return new ReceivableCollection($receivables);
    }
    public function byPaymentId(Request $request)
    {
        $receivables = Receivable::where('payment_id',$request->payment_id)->with('fee')->orderBy('id', 'desc')->where('is_hidden','F')->get();
        return new ReceivableCollection($receivables);
    }

    public function store(Request $request)
    {
        $user_id=Auth::guard('api')->user()->id;
        if($request->fee_id){
            $fee=Fee::where('id',$request->fee_id)->first();
            $fee_name=$fee['fee_name'];
            $fee_scale=$fee['fee_scale'];
        }
        $reception=Receivable::create([
            'user_id' => $user_id,
            'payment_id' => request('payment_id', ''),
            'fee_id' => request('fee_id', ''),
            'fee_name' => $fee_name,
            'fee_sum' => request('fee_sum',''),
            'fee_scale' => $fee_scale,
            'fee_state' => request('fee_state','0'),
        ]);
        if ($reception) {
            $data['status'] = true;
            $data['status_code'] = '200';
            $data['message'] = '发布成功';
            $data['receivable'] = $reception;
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
        $fee = Receivable::where('id', $request->id)->first();
        $attributes['user_id'] = $user_id;
        $attributes['fee_name'] = request('fee_name', '');
        $attributes['fee_scale'] = request('fee_scale', '');
        $attributes['fee_remark'] = request('fee_remark', '');
        $fee->update($attributes);
        if ($fee) {
            $data['status'] = true;
            $data['status_code'] = '200';
            $data['message'] = '更新成功';
            $data['abroads'] = $this->index();
            return json_encode($data);
        } else {
            $data['status'] = false;
            $data['status_code'] = '501';
            $data['msg'] = '系统繁忙，请售后再试';
            return json_encode($data);
        }
    }
    public function destroy($id)
    {
        $fee = Receivable::where('id', $id)->first();
        $attributes['is_hidden'] = 'T';
        $attributes['updated_at'] = now();
        $fee->update($attributes);
    }
}

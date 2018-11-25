<?php

namespace App\Http\Controllers;

use App\Payment_fee_item;
use Illuminate\Http\Request;

class PaymentFeeItemsController extends Controller
{
    public function index($id)
    {
        $fee_items = Payment_fee_item::where('payment_id',$id)->with('fee')->orderBy('id', 'desc')->where('is_hidden','F')->get();
        return $fee_items;
    }
    public function feeList()
    {
        $receptions = Payment_fee_item::where('is_hidden','F')->orderBy('id', 'desc')->get();
        return new FeeCollection($receptions);
    }
    public function listSize(Request $request)
    {
        $abroads = Payment_fee_item::with('user')->orderBy('id', 'desc')->where('is_hidden','F')->paginate($request->pagination);
        return new FeeCollection($abroads);
    }
    public function store(Request $request)
    {
        $user_id=Auth::guard('api')->user()->id;
        $reception=Payment_fee_item::create([
            'user_id' => $user_id,
            'payment_id' => request('payment_id', ''),
            'fee_id' => request('fee_id', ''),
            'fee_sum' => request('fee_sum',''),
            'fee_category' => request('fee_category',''),
        ]);
        if ($reception) {
            $data['status'] = true;
            $data['status_code'] = '200';
            $data['message'] = '发布成功';
            $data['fee_items'] = $this->index();
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
        $fee = Payment_fee_item::where('id', $request->id)->first();
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
        $fee = Payment_fee_item::where('id', $id)->first();
        $attributes['is_hidden'] = 'T';
        $attributes['updated_at'] = now();
        $fee->update($attributes);
    }
}

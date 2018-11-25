<?php

namespace App\Http\Controllers;

use App\Fee;
use App\Http\Resources\FeeCollection;
use Auth;
use Illuminate\Http\Request;

class FeesController extends Controller
{
    public function index()
    {
        $receptions = Fee::with('user')->orderBy('id', 'desc')->where('is_hidden','F')->paginate(9);
        return new FeeCollection($receptions);
    }
    public function feeList()
    {
        $receptions = Fee::where('is_hidden','F')->orderBy('id', 'desc')->get();
        return new FeeCollection($receptions);
    }
    public function listSize(Request $request)
    {
        $abroads = Fee::with('user')->orderBy('id', 'desc')->where('is_hidden','F')->paginate($request->pagination);
        return new FeeCollection($abroads);
    }
    public function store(Request $request)
    {
        $user_id=Auth::guard('api')->user()->id;
        $reception=Fee::create([
            'user_id' => $user_id,
            'fee_category' => request('0', ''),
            'fee_name' => request('fee_name', ''),
            'fee_scale' => request('fee_scale',''),
            'fee_remark' => request('fee_remark',''),
        ]);
        if ($reception) {
            $data['status'] = true;
            $data['status_code'] = '200';
            $data['message'] = '发布成功';
            $data['fees'] = $this->index();
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
        $fee = Fee::where('id', $request->id)->first();
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
        $fee = Fee::where('id', $id)->first();
        $attributes['is_hidden'] = 'T';
        $attributes['updated_at'] = now();
        $fee->update($attributes);
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProjectCollection;
use App\Project;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProjectsController extends Controller
{
    public function index()
    {
        $projects = Project::with('user')->orderBy('id', 'desc')->where('is_hidden','F')->paginate(9);
        return new ProjectCollection($projects);
    }
    public function show($id)
    {
        $project = Project::find($id);
        if ($project->count() == 0) {
            return response()->json(['status' => false, 'status_code' => '401']);
        }
        return new \App\Http\Resources\Project($project);
    }
    public function addProject(Request $request)
    {
        $user_id=Auth::guard('api')->user()->id;
        if($request->filesArray){
            $filesArray=json_encode($request->filesArray);
        }else{
            $filesArray="[]";
        }
        if($request->imagesArray){
            $imagesArray=json_encode($request->imagesArray);
        }else{
            $imagesArray="[]";
        }
        if($request->location){
            $province=$request->location['province'];
            $city=$request->location['city'];
            $street=$request->location['street'];
            $village=$request->location['village'];
            $address=$request->location['address'];
            $district_code=$request->location['district_code'];
            $latitude=$request->location['latitude'];
            $longitude=$request->location['longitude'];
        }else{
            $province='山东省';
            $city='济宁市';
            $street='';
            $village='';
            $address='';
            $district_code='';
            $latitude='';
            $longitude='';
        }
        $reception=Project::create([
            'user_id'=>$user_id,
            'area_id'=>request('area_id', '0'),
            'name'=>request('name', ''),
            'id_code'=>request('id_code', ''),
            'id_license'=>request('id_license', ''),
            'item_code'=>request('item_code', ''),
            'item_name'=>request('item_name', ''),
            'register_type'=>request('register_type', ''),
            'province'=>$province,
            'city'=>$city,
            'district'=>request('district', ''),
            'street'=>$street,
            'village'=>$village,
            'address'=>$address,
            'district_code'=>$district_code,
            'latitude'=>$latitude,
            'longitude'=>$longitude,
            'phone'=>request('phone', ''),
            'industry_code'=>request('industry_code', ''),
            'holding'=>request('holding', ''),
            'subjection'=>request('subjection', ''),
            'item_nature'=>request('item_nature', ''),
            'item_type'=>request('item_type', ''),
            'start_at'=>substr(request('start_at', now()),0,10),
            'end_at'=>substr(request('end_at', now()),0,10),
            'produce_at'=>substr(request('produce_at', now()),0,10),
            'item_state'=>request('is_hidden', ''),
            'images'=>$imagesArray,
            'files'=>$filesArray,
            'fee_id'=>request('fee_id', ''),
            'fee'=>request('fee', '0'),
            'fee_count'=>request('fee_count', '0'),
            'is_hidden'=>request('is_hidden', 'F'),
        ]);
        if ($reception) {
            $data['status'] = true;
            $data['status_code'] = '200';
            $data['message'] = '发布成功';
            $data['projects'] = $this->index();
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
            $filename = 'jining/project/' .$userId. 'EA' . uniqid() . '.' . $ext;
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
        $project = Project::where('id', $id)->first();
        $attributes['is_hidden'] = 'T';
        $attributes['updated_at'] = now();
        $project->update($attributes);
    }
}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Redirect;

class SubCategoryInfoController extends Controller
{
    public function AuthCheck(){
        $name = Session::get('user_name');
        if ($name) {
            return;
        } else {
            return Redirect::to('admin-login')->send();;
        }
    }

    public function index(){
        $this->AuthCheck();


        $user_type = Session::get('user_type_name');
        $user_id = Session::get('user_info_id');

        if ($user_type=="Root User") {
            $SubCategoryData = DB::select('SELECT sub_category_id, user_id,category_id,sub_category_name,sub_category_status, create_info, update_info
                     FROM sub_category_info WHERE sub_category_status != "D";');
        }else{
            $SubCategoryData = DB::select('SELECT sub_category_id, user_id,category_id,sub_category_name,sub_category_status, create_info, update_info
                     FROM sub_category_info WHERE sub_category_status != "D" AND user_id="'.$user_id.'";');

        }
        return view('admin.productsetup.section_sub_category_info', ['SubCategoryData' => $SubCategoryData]);
    }

    public function store(Request $request){
        if ($request['inSubCategoryId']==""){
            $data = array();
            $data['category_id'] = $request['slCategory'];
            $data['sub_category_name'] = $request['inSubCategoryName'];
            $data['sub_category_status'] = $request['slSubCategoryStatus'];
            $data['user_id'] = Session::get('user_info_id');
            $data['create_info'] = $this->getDates();
            $data['update_info'] = "";

            $result = DB::table('sub_category_info')->insert($data);
            return json_encode(array(
                "statusCode" => 200,
                "statusMsg" => "Sub-Category Added Successfully"
            ));

        }

        else{
            $data = array();
            $data['category_id'] = $request['slCategory'];
            $data['sub_category_name'] = $request['inSubCategoryName'];
            $data['sub_category_status'] = $request['slSubCategoryStatus'];
            $data['user_id'] = Session::get('user_info_id');
            $data['update_info'] = $this->getDates();;

            $result = DB::table('sub_category_info')
                ->where('sub_category_id', $request['inSubCategoryId'])
                ->update($data);

            return json_encode(array(
                "statusCode" => 200,
                "statusMsg" => "Sub-Category Updated Successfully"
            ));
        }
    }

    public function show($id)
    {
        $singleDataShow = DB::table('sub_category_info')
            ->where('sub_category_id', $id)
            ->get();
        return $singleDataShow;
    }

    public function showCategoryList(){

        try {
            $user_type = Session::get('user_type_name');
            $user_id = Session::get('user_info_id');
            if ($user_type=="Root User") {
                $categoryList = DB::select('SELECT category_id, user_id,category_name,category_status, create_info, update_info
                     FROM category_info WHERE category_status != "D";');
            }else {
                $categoryList = DB::select('SELECT category_id, user_id,category_name,category_status, create_info, update_info
                     FROM category_info WHERE category_status != "D" AND user_id="'.$user_id.'";');
            }
            return json_encode($categoryList);
        } catch (\Exception $e) {
            DB::rollBack();
            return ["o_status_message" => $e->getMessage()];
        }

    }

    public function destroy($id){
        $data['sub_category_status'] = "D";
        DB::table('sub_category_info')
            ->where('sub_category_id', $id)
            ->update($data);
        return json_encode(array(
            "statusCode" => 200
        ));
    }

    public function getDates(){
        $Date = "";
        date_default_timezone_set("Asia/Dhaka");
        return $Date = date("d/m/Y");
    }
}

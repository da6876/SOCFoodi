<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Redirect;

class CategoryInfoController extends Controller
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
            $categoryData = DB::select('SELECT category_id, user_id,category_name,category_status, create_info, update_info
                     FROM category_info WHERE category_status != "D";');
        }else{
            $categoryData = DB::select('SELECT category_id, user_id,category_name,category_status, create_info, update_info
                     FROM category_info WHERE category_status != "D" AND user_id="'.$user_id.'";');
        }
        return view('admin.productsetup.section_category_info', ['categoryData' => $categoryData]);
    }

    public function store(Request $request){
        if ($request['inUserTypeId']==""){
            $data = array();
            $data['category_name'] = $request['inCategoryName'];
            $data['category_status'] = $request['slCategoryStatus'];
            $data['user_id'] = Session::get('user_info_id');
            $data['create_info'] = $this->getDates();
            $data['update_info'] = "";

            $result = DB::table('category_info')->insert($data);
            return json_encode(array(
                "statusCode" => 200,
                "statusMsg" => "Category Added Successfully"
            ));

        }

        else{
            $data = array();
            $data['category_name'] = $request['inCategoryName'];
            $data['category_status'] = $request['slCategoryStatus'];
            $data['user_id'] = Session::get('user_info_id');
            $data['update_info'] = $this->getDates();;

            $result = DB::table('category_info')
                ->where('category_id', $request['inUserTypeId'])
                ->update($data);

            return json_encode(array(
                "statusCode" => 200,
                "statusMsg" => "Category Updated Successfully"
            ));
        }
    }

    public function show($id)
    {
        $singleDataShow = DB::table('category_info')
            ->where('category_id', $id)
            ->get();
        return $singleDataShow;
    }

    public function destroy($id){
        $data['category_status'] = "D";
        DB::table('category_info')
            ->where('category_id', $id)
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

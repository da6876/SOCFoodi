<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Redirect;

class ProductTypeController extends Controller
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
            $ProductTypeData = DB::select('SELECT product_type_id, user_id,product_type_name,product_type_status, create_info, update_info
                     FROM product_type WHERE product_type_status != "D";');
        }else{
            $ProductTypeData = DB::select('SELECT product_type_id, user_id,product_type_name,product_type_status, create_info, update_info
                     FROM product_type WHERE product_type_status != "D" AND user_id="'.$user_id.'";');

        }
        return view('admin.productsetup.section_product_type', ['ProductTypeData' => $ProductTypeData]);
    }

    public function store(Request $request){
        if ($request['inProductTypeId']==""){
            $data = array();
            $data['product_type_name'] = $request['inProductTypeName'];
            $data['product_type_status'] = $request['slProductTypeStatus'];
            $data['user_id'] = Session::get('user_info_id');
            $data['create_info'] = $this->getDates();
            $data['update_info'] = "";

            $result = DB::table('product_type')->insert($data);
            return json_encode(array(
                "statusCode" => 200,
                "statusMsg" => "Product Type Added Successfully"
            ));

        }

        else{
            $data = array();
            $data['product_type_name'] = $request['inProductTypeName'];
            $data['product_type_status'] = $request['slProductTypeStatus'];
            $data['user_id'] = Session::get('user_info_id');
            $data['update_info'] = $this->getDates();;

            $result = DB::table('product_type')
                ->where('product_type_id', $request['inProductTypeId'])
                ->update($data);

            return json_encode(array(
                "statusCode" => 200,
                "statusMsg" => "Product Type Updated Successfully"
            ));
        }
    }

    public function show($id)
    {
        $singleDataShow = DB::table('product_type')
            ->where('product_type_id', $id)
            ->get();
        return $singleDataShow;
    }

    public function destroy($id){
        $data['product_type_status'] = "D";
        DB::table('product_type')
            ->where('product_type_id', $id)
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

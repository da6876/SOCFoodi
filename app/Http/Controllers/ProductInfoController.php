<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Redirect;

class ProductInfoController extends Controller
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

        if ($user_type=="Root User"){
            $ProductInfoData = DB::select ('SELECT product_id, product_type_id,category_id,sub_category_id, user_id,
                        product_name,product_short_desc,product_desc,product_other_info,product_image,
                        product_color_id,current_price,previous_price,product_status,create_info,update_info
                     FROM product_info WHERE product_status != "D";');
        }else{
            $ProductInfoData = DB::select ('SELECT product_id, product_type_id,category_id,sub_category_id, user_id,
                        product_name,product_short_desc,product_desc,product_other_info,product_image,
                        product_color_id,current_price,previous_price,product_status,create_info,update_info
                     FROM product_info WHERE product_status != "D" AND user_id="'.$user_id.'";');

        }
        return view('admin.productsetup.section_product_info', ['ProductInfoData' => $ProductInfoData]);
    }

    public function store(Request $request){

        if ($request['inProductId']==""){
            $data = array();
            $data['product_type_id'] = $request['slProductType'];
            $data['category_id'] = $request['slProductCategory'];
            $data['sub_category_id'] = $request['slProductSubCategory'];
            $data['user_id'] = Session::get('user_info_id');
            $data['product_name'] = $request['inProductName'];
            $data['product_short_desc'] = $request['inProductShortDesc'];
            $data['product_desc'] = $request['inProductDesc'];
            $data['current_price'] = $request['inProductCurrentPrice'];
            $data['previous_price'] = $request['inProductPreviousPrice'];
            $data['product_status'] = $request['slProductStatus'];
            $data['create_info'] = $this->getDates();
            $data['update_info'] = "";

            $imageOne = $request['inProductImageOne'];
            //$imageTwo = $request['inProductImageTwo'];
            if ($imageOne) {
                $one_full_name = str_random(15) . '.' . strtolower($imageOne->getClientOriginalExtension());
                $upload_path_one = "ALLImages/ProductImages/";
                $image_url_one = $upload_path_one . $one_full_name;
                $success_one = $imageOne->move($upload_path_one, $one_full_name);
                $data['product_image'] = $image_url_one;
            }else{
                $data['product_image'] = "NO IMAGE";
            }

            $result = DB::table('product_info')->insert($data);
            return json_encode(array(
                "statusCode" => 200,
                "statusMsg" => "Product Added Successfully"
            ));

        }

        else{
            $data = array();
            $data['product_type_id'] = $request['slProductType'];
            $data['category_id'] = $request['slProductCategory'];
            $data['sub_category_id'] = $request['slProductSubCategory'];
            $data['user_id'] = Session::get('user_info_id');
            $data['product_name'] = $request['inProductName'];
            $data['product_short_desc'] = $request['inProductShortDesc'];
            $data['product_desc'] = $request['inProductDesc'];
            $data['current_price'] = $request['inProductCurrentPrice'];
            $data['previous_price'] = $request['inProductPreviousPrice'];
            $data['product_status'] = $request['slProductStatus'];
            $data['update_info'] = $this->getDates();

            $imageOne = $request['inProductImageOne'];
            //$imageTwo = $request['inProductImageTwo'];
            if ($imageOne) {
                $one_full_name = str_random(15) . '.' . strtolower($imageOne->getClientOriginalExtension());
                $upload_path_one = "ALLImages/ProductImages/";
                $image_url_one = $upload_path_one . $one_full_name;
                $success_one = $imageOne->move($upload_path_one, $one_full_name);
                $data['product_image'] = $image_url_one;
            }else{
                $data['product_image'] = "NO IMAGE";
            }

            $result = DB::table('product_info')
                ->where('product_id', $request['inProductId'])
                ->update($data);

            return json_encode(array(
                "statusCode" => 200,
                "statusMsg" => "Product Updated Successfully"
            ));
        }
    }

    public function show($id)
    {
        $singleDataShow = DB::table('product_info')
            ->where('product_id', $id)
            ->get();
        return $singleDataShow;
    }


    public function showProductType(){
        $user_id = Session::get('user_info_id');
        try {
            $List = DB::select ('SELECT product_type_id, product_type_name ,user_id FROM product_type WHERE product_type_status != "D" AND user_id ="'.$user_id.'";');
            return json_encode($List);
        } catch (\Exception $e) {
            DB::rollBack();
            return ["o_status_message" => $e->getMessage()];
        }

    }

    public function showCategory(){
        $user_id = Session::get('user_info_id');
        try {
            $List = DB::select ('SELECT category_id, category_name ,user_id FROM category_info WHERE category_status != "D" AND user_id ="'.$user_id.'";');
            return json_encode($List);
        } catch (\Exception $e) {
            DB::rollBack();
            return ["o_status_message" => $e->getMessage()];
        }

    }

    public function showSubCategory(){
        $catId = request()->input('Cat_id');
        $user_id = Session::get('user_info_id');
        try {
            $List = DB::select ('SELECT sub_category_id, sub_category_name ,user_id FROM sub_category_info WHERE sub_category_status != "D" AND category_id ="'.$catId.'" AND user_id ="'.$user_id.'";');
            return json_encode($List);
        } catch (\Exception $e) {
            DB::rollBack();
            return ["o_status_message" => $e->getMessage()];
        }

    }

    public function destroy($id){
        $data['product_status'] = "D";
        DB::table('product_info')
            ->where('product_id', $id)
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

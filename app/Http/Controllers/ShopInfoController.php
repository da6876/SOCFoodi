<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Redirect;

class ShopInfoController extends Controller
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

        $ShopInfoData = DB::select ('SELECT shop_id, shop_name,shop_address,shop_trade_licence,
 ower_name, ower_number, shop_email, shop_phone, shop_status,create_by, create_date, update_date, update_by
                     FROM shopinfo WHERE shop_status != "D";');
        return view('admin.section_admin_shop_info', ['ShopInfoData' => $ShopInfoData]);
    }

    public function store(Request $request){
        if ($request['inshopid']==""){
            $data = array();
            $data['shop_name'] = $request['inshopname'];
            $data['shop_address'] = $request['inshopaddress'];
            $data['shop_trade_licence'] = $request['inshoptradelicence'];
            $data['ower_name'] = $request['inOwnerName'];
            $data['ower_number'] = $request['inOwnerPhone'];
            $data['shop_email'] = $request['inShopEmail'];
            $data['shop_phone'] = $request['inShopPhone'];
            $data['shop_status'] = $request['slShopStatus'];
            $data['create_by'] = Session::get('user_info_id');
            $data['create_date'] = $this->getDates();
            $data['update_date'] = "";

            $result = DB::table('shopinfo')->insert($data);
            return json_encode(array(
                "statusCode" => 200,
                "statusMsg" => "New Shop Added Successfully"
            ));

        }

        else{
            $data = array();
            $data['shop_name'] = $request['inshopname'];
            $data['shop_address'] = $request['inshopaddress'];
            $data['shop_trade_licence'] = $request['inshoptradelicence'];
            $data['ower_name'] = $request['inOwnerName'];
            $data['ower_number'] = $request['inOwnerPhone'];
            $data['shop_email'] = $request['inShopEmail'];
            $data['shop_phone'] = $request['inShopPhone'];
            $data['shop_status'] = $request['slShopStatus'];
            $data['update_date'] = $this->getDates();
            $data['update_by'] = Session::get('user_info_id');

            $result = DB::table('shopinfo')
                ->where('shop_id', $request['inshopid'])
                ->update($data);

            return json_encode(array(
                "statusCode" => 200,
                "statusMsg" => "Shop Info Updated Successfully"
            ));
        }
    }

    public function show($id)
    {
        $singleDataShow = DB::table('shopinfo')
            ->where('shop_id', $id)
            ->get();
        return $singleDataShow;
    }

    public function destroy($id){
        $data['shop_status'] = "D";
        DB::table('shopinfo')
            ->where('shop_id', $id)
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

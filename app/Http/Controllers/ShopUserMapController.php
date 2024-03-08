<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Redirect;

class ShopUserMapController extends Controller
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

        $ShopUserMap = DB::select ('SELECT tsum.shopusermap_id, tsum.shop_id,tsi.shop_name,tsum.user_id,tui.user_name,tsum.map_status,tsum.create_info, tsum.update_info
                                    FROM shop_user_map tsum,shopinfo tsi,user_info tui
                                    WHERE map_status != "D"
                                    AND tsi.shop_id= tsum.shop_id
                                    AND tui.user_info_id= tsum.user_id;');
        return view('admin.section_admin_shop_user_map', ['ShopUserMap' => $ShopUserMap]);
    }

    public function store(Request $request){
        if ($request['inShopUserMapId']==""){
            $data = array();
            $data['shop_id'] = $request['slShop'];
            $data['user_id'] = $request['slUser'];
            $data['map_status'] = $request['slStatus'];
            $data['create_info'] = $this->getDates().', '.Session::get('user_info_id');
            $data['update_info'] = "";

            $result = DB::table('shop_user_map')->insert($data);
            return json_encode(array(
                "statusCode" => 200,
                "statusMsg" => "User Mapped Successfully"
            ));

        }

        else{
            $data = array();
            $data['shop_id'] = $request['slShop'];
            $data['user_id'] = $request['slUser'];
            $data['map_status'] = $request['slStatus'];
            $data['update_info'] = $this->getDates().', '.Session::get('user_info_id');

            $result = DB::table('shop_user_map')
                ->where('shopusermap_id', $request['inShopUserMapId'])
                ->update($data);

            return json_encode(array(
                "statusCode" => 200,
                "statusMsg" => "User Mapped Updated Successfully"
            ));
        }
    }

    public function showUserList(){

        try {
            $userList = DB::select ('SELECT user_info_id, user_name ,phone_no FROM user_info WHERE status != "D" AND status ="A";');
            return json_encode($userList);
        } catch (\Exception $e) {
            DB::rollBack();
            return ["o_status_message" => $e->getMessage()];
        }

    }

    public function showShop(){

        try {
            $shopList = DB::select ('SELECT shop_id, shop_name,ower_name,ower_number, shop_phone
                     FROM shopinfo WHERE shop_status != "D" and shop_status ="A";');
            return json_encode($shopList);
        } catch (\Exception $e) {
            DB::rollBack();
            return ["o_status_message" => $e->getMessage()];
        }

    }

    public function show($id)
    {
        $singleDataShow = DB::table('shop_user_map')
            ->where('shopusermap_id', $id)
            ->get();
        return $singleDataShow;
    }

    public function destroy($id){
        $data['map_status'] = "D";
        DB::table('shop_user_map')
            ->where('shopusermap_id', $id)
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

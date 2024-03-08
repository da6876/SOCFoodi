<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Redirect;

class UserTypeController extends Controller
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

        $UserTypeData = DB::select ('SELECT user_type_id, user_type_name,user_type_status,create_date, update_date
                     FROM user_type WHERE user_type_status != "D";');
        return view('admin.section_admin_user_type', ['UserTypeData' => $UserTypeData]);
    }

    public function store(Request $request){
        if ($request['inUserTypeId']==""){
            $data = array();
            $data['user_type_name'] = $request['inUserTypeName'];
            $data['user_type_status'] = $request['inUserTypeStatus'];
            $data['create_date'] = $this->getDates();
            $data['update_date'] = "";

            $result = DB::table('user_type')->insert($data);
            return json_encode(array(
                "statusCode" => 200,
                "statusMsg" => "User Type Added Successfully"
            ));

        }

        else{
            $data = array();
            $data['user_type_name'] = $request['inUserTypeName'];
            $data['user_type_status'] = $request['inUserTypeStatus'];
            $data['update_date'] = $this->getDates();

            $result = DB::table('user_type')
                ->where('user_type_id', $request['inUserTypeId'])
                ->update($data);

            return json_encode(array(
                "statusCode" => 200,
                "statusMsg" => "User Type Updated Successfully"
            ));
        }
    }

    public function show($id)
    {
        $singleDataShow = DB::table('user_type')
            ->where('user_type_id', $id)
            ->get();
        return $singleDataShow;
    }

    public function destroy($id){
        $data['user_type_status'] = "D";
        DB::table('user_type')
            ->where('user_type_id', $id)
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

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Redirect;

class UserInfoController extends Controller
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

        $UserInfoData = DB::select ('SELECT user_info_id,user_type_id, user_name,phone_no,email,
                            address, status, password, create_date, update_date
                     FROM user_info WHERE status != "D";');
        return view('admin.section_admin_user_info', ['UserInfoData' => $UserInfoData]);
    }

    public function store(Request $request){
        if ($request['inUserInfoId']==""){
            $data = array();
            $data['user_type_id'] = $request['slUserType'];
            $data['shop_id'] = $request['sshop_id'];
            $data['user_name'] = $request['inUserName'];
            $data['phone_no'] = $request['inPhone'];
            $data['email'] = $request['inEmail'];
            $data['address'] = $request['inAddress'];
            try {
                $data['password'] = $this->encrypData('UserPasswordEncrypt', $request['inPassword']);
            } catch (\Exception $e) {
                DB::rollBack();
                return json_encode(array(
                    "statusCode" => 201,
                    "statusMsg" => "Password Encryp Failed !!"
                ));
            }
            $data['status'] = "A";
            $data['create_date'] = $this->getDates();
            $data['update_date'] = "";

            $result = DB::table('user_info')->insert($data);
            return json_encode(array(
                "statusCode" => 200,
                "statusMsg" => "New User Added Successfully"
            ));

        }

        else{

            $data = array();
            $data['user_type_id'] = $request['slUserType'];
            $data['user_name'] = $request['inUserName'];
            $data['phone_no'] = $request['inPhone'];
            $data['email'] = $request['inEmail'];
            $data['address'] = $request['inAddress'];
            $data['update_date'] = $this->getDates();

            $result = DB::table('user_info')
                ->where('user_info_id', $request['inUserInfoId'])
                ->update($data);

            return json_encode(array(
                "statusCode" => 200,
                "statusMsg" => "User Updated Successfully"
            ));
        }
    }

    public function show($id)
    {
        $singleDataShow = DB::select("SELECT user_info_id, user_type_id,user_name,
                        phone_no, email, address, status, password FROM user_info where user_info_id= '$id'");
        $data = array();
        $data['user_info_id'] = $singleDataShow[0]->user_info_id;
        $data['user_type_id'] =$singleDataShow[0]->user_type_id;
        $data['user_name'] =$singleDataShow[0]->user_name;
        $data['phone_no'] =$singleDataShow[0]->phone_no;
        $data['email'] =$singleDataShow[0]->email;
        $data['address'] =$singleDataShow[0]->address;
        $data['status'] =$singleDataShow[0]->status;
        try {
            $data['password'] = $this->encrypData('UserPasswordDeEncrypt', $singleDataShow[0]->password);
        } catch (\Exception $e) {
            DB::rollBack();
            return json_encode(array(
                "statusCode" => 201,
                "statusMsg" => "Password Encryp Failed !!"
            ));
        }

        return $data;
    }

    public function destroy($id){
        $data['status'] = "D";
        DB::table('user_info')
            ->where('user_info_id', $id)
            ->update($data);
        return json_encode(array(
            "statusCode" => 200
        ));
    }

    public function showUserTypes(){

        try {
            $usertype = DB::select ('SELECT user_type_id, user_type_name,user_type_status,create_date, update_date
                     FROM user_type WHERE user_type_status != "D" and user_type_status ="A";');
            return json_encode($usertype);
        } catch (\Exception $e) {
            DB::rollBack();
            return ["o_status_message" => $e->getMessage()];
        }

    }

    public function showShopLists(){

        try {
            $usertype = DB::select ('SELECT shop_id, shop_name,shop_address,shop_phone FROM shopinfo WHERE shop_status != "D" and shop_status ="A";');
            return json_encode($usertype);
        } catch (\Exception $e) {
            DB::rollBack();
            return ["o_status_message" => $e->getMessage()];
        }

    }


    public function userLogin(Request $request)
    {
        try {
            $userName = $request['inEmail'];

            try {
                $userPassword = $this->encrypData('UserPasswordEncrypt', $request['inPassword']);
            } catch (\Exception $e) {
                DB::rollBack();
                return json_encode(array(
                    "statusCode" => 201,
                    "statusMsg" => "Password Encryp Failed !!"
                ));
            }

            $userPassword = $userPassword;

            $UserType = DB::select("SELECT ui.user_info_id, ui.user_type_id,ut.user_type_name, user_name, phone_no, email, address,
                                    status, password
                                    FROM user_info ui,user_type ut
                                    WHERE email = '$userName'
                                    AND password = '$userPassword'
                                    AND ui.user_type_id = ut.user_type_id;");


            if ($UserType) {
                Session::put('user_info_id', $UserType[0]->user_info_id);
                Session::put('user_type_id', $UserType[0]->user_type_id);
                Session::put('user_type_name', $UserType[0]->user_type_name);
                Session::put('user_name', $UserType[0]->user_name);
                Session::put('phone_no', $UserType[0]->phone_no);
                Session::put('email', $UserType[0]->email);
                Session::put('address', $UserType[0]->address);
                Session::put('status', $UserType[0]->status);

                return json_encode(array(
                    "statusCode" => 200
                ));

            } else {
                return json_encode(array(
                    "statusCode" => 201,
                    "RealPass" => $request['user_password'],
                    "EncPass" => $userPassword,
                    "sss" => json_encode($UserType)
                ));
            }

        } catch (\Exception $e) {
            DB::rollBack();
            return json_encode(array(
                "statusCode" => 201,
                "statusMsg" => $e->getMessage()
            ));
        }
    }



    public function usersLogOut()
    {
        Session::flush();
        return Redirect::to('admin-login');
    }

    public function userPasswordCheck()
    {
        $ViewType = request()->input('ViewType');

        $data = request()->input('data');

        $ciphering = "AES-128-CTR";

        $iv_length = openssl_cipher_iv_length($ciphering);
        $options = 0;
        $encryption_iv = '6876199612231998';
        $encryption_key = "EncryptDhaliAbir";

        if ($ViewType == "Encrypt") {
            try {
                $encryption = openssl_encrypt($data, $ciphering,
                    $encryption_key, $options, $encryption_iv);
                return $encryption;
            } catch (\Exception $e) {
                DB::rollBack();
                ["o_status_message" => $e->getMessage()];
                return json_encode(array(
                    "statusCode" => $e->getMessage()
                ));
            }
        } elseif ($ViewType == "DeEncrypt") {
            try {
                $decryption = openssl_decrypt($data, $ciphering,
                    $encryption_key, $options, $encryption_iv);
                return $decryption;
            } catch (\Exception $e) {
                DB::rollBack();
                ["o_status_message" => $e->getMessage()];
                return json_encode(array(
                    "statusCode" => $e->getMessage()
                ));
            }
        }

    }

    public function encrypData($ViewType, $data)
    {

        $ciphering = "AES-128-CTR";

        $iv_length = openssl_cipher_iv_length($ciphering);
        $options = 0;
        $encryption_iv = '6876199612231998';
        $encryption_key = "EncryptDhaliAbir";

        if ($ViewType == "UserPasswordEncrypt") {
            try {
                $encryption = openssl_encrypt($data, $ciphering,
                    $encryption_key, $options, $encryption_iv);
                return $encryption;
            } catch (\Exception $e) {
                DB::rollBack();
                ["o_status_message" => $e->getMessage()];
                return json_encode(array(
                    "statusCode" => $e->getMessage()
                ));
            }
        } elseif ($ViewType == "UserPasswordDeEncrypt") {
            try {
                $decryption = openssl_decrypt($data, $ciphering,
                    $encryption_key, $options, $encryption_iv);
                return $decryption;
            } catch (\Exception $e) {
                DB::rollBack();
                ["o_status_message" => $e->getMessage()];
                return json_encode(array(
                    "statusCode" => $e->getMessage()
                ));
            }
        }

    }

    public function getDates(){
        $Date = "";
        date_default_timezone_set("Asia/Dhaka");
        return $Date = date("d/m/Y");
    }
}

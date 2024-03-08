<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('admin-home', function () {
    return view('admin_dashbord');
});

Route::get('admin-login', function () {
    return view('admin.section_admin_login');
});

Route::resource('UserType','UserTypeController');
Route::resource('UserInfo','UserInfoController');
Route::resource('ShopInfo','ShopInfoController');
Route::resource('ShopUserMap','ShopUserMapController');
Route::resource('ProductType','ProductTypeController');
Route::resource('CategoryInfo','CategoryInfoController');
Route::resource('SubCategoryInfo','SubCategoryInfoController');
Route::resource('ProductInfo','ProductInfoController');

/*Route For Select Option Data */
Route::post('ShowShopList','ShopUserMapController@showShop');
Route::post('ShowUserList','ShopUserMapController@showUserList');
Route::post('ShowUserType','UserInfoController@showUserTypes');
Route::post('ShowShopList','UserInfoController@showShopLists');
Route::post('ShowCategory','SubCategoryInfoController@showCategoryList');
Route::post('ShowCatForProduct','ProductInfoController@showCategory');
Route::post('ShowSubCatForProduct','ProductInfoController@showSubCategory');
Route::post('ShowProTypeForProduct','ProductInfoController@showProductType');
/*Route For Select Option Data */


Route::post('UserLogin','UserInfoController@userLogin');
Route::get('Logout','UserInfoController@usersLogOut');


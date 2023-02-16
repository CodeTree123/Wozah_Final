<?php

use App\Http\Controllers\Api\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//all user registration in one function


Route::post('register/new', [ApiController::class, 'new_register']);
Route::post('sendotp', [ApiController::class, 'sendOtp']);
Route::post('loginWithOtp', [ApiController::class, 'loginWithOtp']);

//customer all routes

Route::post('customer/login', [ApiController::class, 'customer_login']);
Route::get('customer/profile/information/{id}', [ApiController::class, 'customer_Profile']);
Route::post('customer/profile/update/{id}', [ApiController::class, 'customer_profile_update']);
Route::post('customer/cart/addtocart/{rowId}', [ApiController::class, 'addtocart']);
Route::get('customer/cart/delete/{rowId}', [ApiController::class, 'cartdelete']);
Route::get('customer/cart/content/{rowId}', [ApiController::class, 'cartcontent']);
Route::post('customer/place_order/{id}', [ApiController::class, 'place_order']);
Route::get('customer/order/list/{id}', [ApiController::class, 'order_list']);
Route::get('customer/myorder/{id}', [ApiController::class, 'myorder']);
//customer route ends

Route::get('User/list', [ApiController::class, 'User_list']);
//shop all routes
Route::post('shop/login', [ApiController::class, 'shop_login']);
Route::get('shop/profile/{id}', [ApiController::class, 'single_shop_details']);
Route::get('shop_documents/{id}', [ApiController::class, 'shop_documents']);

Route::get('shop/all_catagory/{text}', [ApiController::class, 'shop_all_catagory']);
Route::get('shop/all_sub_catagory/{category_id}', [ApiController::class, 'shop_all_sub_catagory']);
Route::get('shop/catagory/{user_id}', [ApiController::class, 'shop_catagory']);
Route::get('shop/single_catagory/all_subcategory/{user_id}/{category_id}', [ApiController::class, 'shop_single_catagory']);
Route::get('shop/single_sub_category/all_services/{user_id}/{sub_category_id}', [ApiController::class, 'shop_sub_catagory']);

//shop routes end

//Individual all routes

Route::get('individual_profile/{id}', [ApiController::class, 'individual_profile']);
Route::put('individual_profile/update/{id}', [ApiController::class, 'individual_profile_update']);
Route::get('individual_documents/{id}', [ApiController::class, 'individual_documents']);
Route::put('individual_documents/add/{id}', [ApiController::class, 'individul_add_documents']);
Route::put('individual_documents/update/{id}', [ApiController::class, 'individual_update_documents']);

// Individual routes end

//employee all routes

Route::get('employee', [ApiController::class, 'sp_employee']);
Route::get('autocomplete', [ApiController::class, 'autocomplete_emp']);
Route::post('employee/add/{email}', [ApiController::class, 'sp_employee_add']);
Route::post('employee/invite/{id}', [ApiController::class, 'sp_employee_invite']);

//employee route ends

//order all routes

Route::get('order', [ShopController::class, 'sp_order']);
Route::get('order_view/{id}', [ShopController::class, 'sp_order_view']);
Route::post('cancel_order/{id}', [ShopController::class, 'sp_cancel_order']);
Route::post('confirm_order/{id}', [ShopController::class, 'sp_confirm_order']);
Route::get('assigned_info/{id}', [ShopController::class, 'sp_assigned_info']);
Route::get('employee/assigned_work/{id}', [ShopController::class, 'sp_employee_assigned_work']);

//order routes end

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

//customer all routes

Route::post('customer/login', [ApiController::class, 'customer_login']);
Route::post('customer/profile/update/{id}', [ApiController::class, 'customer_profile_update']);
Route::get('customer/cart/addtocart/{id}', [ApiController::class, 'addtocart']);
Route::get('customer/cart/delete/{rowId}', [ApiController::class, 'cartdelete']);

Route::post('customer/place_order/{id}', [ApiController::class, 'place_order']);
Route::get('customer/myorder/{id}', [ApiController::class, 'myorder']);
//customer route ends

//shop all routes
Route::post('shop/login', [ApiController::class, 'shop_login']);
Route::get('shop_profile/{id}', [ApiController::class, 'shop_profile']);
Route::post('shop/profile/update/{id}', [ApiController::class, 'shop_profile_update']);
Route::get('shop_documents/{id}', [ApiController::class, 'shop_documents']);

Route::post('shop_documents/add/{id}', [ApiController::class, 'shop_add_documents']);
Route::post('shop_documents/update/{id}', [ApiController::class, 'shop_update_documents']);
Route::get('shop/catagory/{id}', [ApiController::class, 'shop_catagory']);
Route::post('shop/catagory/add', [ApiController::class, 'shop_catagory_add']);
Route::get('shop/catagory/update/{id}', [ApiController::class, 'shop_catagory_update']);

Route::delete('shop/catagory/delete/{id}', [ApiController::class, 'shop_catagory_delete']);
Route::get('shop/sub_catagory/{id}/{cat_id}', [ApiController::class, 'shop_sub_catagory']);
Route::post('shop/sub_catagory/add', [ApiController::class, 'shop_sub_catagory_add']);
Route::get('shop/sub_catagory/update/{id}', [ApiController::class, 'shop_sub_catagory_update']);

Route::delete('shop/sub_catagory/delete/{id}', [ApiController::class, 'shop_sub_catagory_delete']);
Route::get('/shop/service/{user_id}', [ApiController::class, 'shop_service']);
Route::post('/shop/service/add', [ApiController::class, 'shop_service_add']);
Route::get('/shop/service/update/{id}', [ApiController::class, 'shop_service_update']);
Route::delete('/shop/service/delete', [ApiController::class, 'shop_service_delete']);

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
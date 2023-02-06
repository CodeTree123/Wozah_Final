<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\PlaidController;
use App\Http\Controllers\ShopController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use App\Mail\OrderMailInfo;
use App\Mail\OrderCancelMail;

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

// Route::get('/', function () {
//     return view('welcome');
// });

// index file route(master)
// Route::get('/',[App\Http\Controllers\FrontendController::class,'index'])->name('index');

//  main content route
Route::get('/',[FrontendController::class,'content'])->name('content');

// Route::get('/home',[FrontendController::class,'content'])->name('home');
Route::get('/admin',[FrontendController::class,'admin_login'])->name('admin_login_view')->middleware('guest');
Route::post('/admin/login',[AuthController::class,'admin_login'])->name('admin_login');
Route::get('/admin/deshboard',[AdminController::class,'admin_deshboard'])->name('admin_deshboard')->middleware('auth');
Route::get('/shop/revenue',[AdminController::class,'revenue_shop'])->name('revenue_shop')->middleware('auth');
Route::get('/individual/revenue',[AdminController::class,'revenue_individual'])->name('revenue_individual')->middleware('auth');
Route::get('/order_view/{id}',[AdminController::class,'order_view'])->name('order_view');

Route::get('/admin/verified_shop_list',[AdminController::class,'admin_verified_shop_list'])->name('admin_verified_shop_list')->middleware('auth');

Route::get('/admin/unverified_shop_list',[AdminController::class,'admin_unverified_shop_list'])->name('admin_unverified_shop_list')->middleware('auth');
Route::get('/admin/shop_doc_status/{doc_type}/{id}',[AdminController::class,'admin_sp_doc_status'])->name('admin_sp_doc_status')->middleware('auth');
Route::get('admin/sp_verification_status/{id}',[AdminController::class,'admin_sp_verification_status'])->name('admin_sp_verification_status')->middleware('auth');

Route::get('/admin/shop_details/{id}',[AdminController::class,'admin_shop_details'])->name('admin_shop_details')->middleware('auth');

Route::get('/admin/verified_individual_list',[AdminController::class,'admin_verified_individual_list'])->name('admin_verified_individual_list')->middleware('auth');
Route::get('/admin/unverified_individual_list',[AdminController::class,'admin_unverified_individual_list'])->name('admin_unverified_individual_list')->middleware('auth');
Route::get('/admin/individual_details/{id}',[AdminController::class,'admin_individual_details'])->name('admin_individual_details')->middleware('auth');
Route::get('/admin/individual_doc_status/{doc_type}/{id}',[AdminController::class,'admin_i_doc_status'])->name('admin_i_doc_status')->middleware('auth');






// Customer Registration Form Page
Route::get('/customer_registration', [FrontendController::class, 'customer_registration'])->name('customer_registration')->middleware('guest');
// Customer Login Form Page
Route::get('/customer_login', [FrontendController::class, 'customer_login'])->name('customer_login_view')->middleware('guest');
// Customer Edit Profile Page
Route::get('/edit_user_profile', [FrontendController::class, 'edit_user_profile'])->name('edit_user_profile');

// Shop Registration Form Page
Route::get('/shop_registration', [FrontendController::class, 'shop_registration'])->name('shop_registration')->middleware('guest');
// Shop Registration Form Page
Route::get('/individual_registration', [FrontendController::class, 'individual_registration'])->name('individual_registration')->middleware('guest');
// Shop Login Form Page
Route::get('/shop_login', [FrontendController::class, 'shop_login'])->name('shop_login_view')->middleware('guest');

// Shop Edit Profile Page
Route::get('/edit_shop_profile', [FrontendController::class, 'edit_shop_profile'])->name('edit_shop_profile');

// faq page
Route::get('/faq', [FrontendController::class, 'faq'])->name('faq');

// about_us page
Route::get('/about_us', [FrontendController::class, 'about_us'])->name('about_us');

// contact_us page
Route::get('/contact_us', [FrontendController::class, 'contact_us'])->name('contact_us');


Route::get('/service_list/{u_id}', [FrontendController::class, 'service_list'])->name('service_list');

Route::get('/service_detail/{u_id}/{sub_id}', [FrontendController::class, 'service_detail'])->name('service_detail');


// Auth::routes(['verify'=>true]);
Route::post('/register/new', [AuthController::class, 'new_register'])->name('new_register')->middleware('Otpverify_login');


// routes for customer
Route::post('/customer/login',  [AuthController::class,'customer_login'])->name('customer_login');
Route::post('/profile/update', [CustomerController::class, 'profile_update'])->name('profile_update')->middleware('Otpverify_edit');
Route::post('/payment/update', [CustomerController::class, 'payment_update'])->name('payment_update');

Route::get('/cart/addtocart/{id}',[CustomerController::class,'addtocart'])->name('addtocart');
Route::put('/cart/updatecart_inc',[CustomerController::class,'updatecart_inc'])->name('updatecart_inc');
Route::put('/cart/updatecart_dec',[CustomerController::class,'updatecart_dec'])->name('updatecart_dec');
Route::get('/cart/delete/{id}',[CustomerController::class,'cartdelete'])->name('cartdelete');

Route::get('/checkout',[CustomerController::class,'checkout'])->name('checkout')->middleware(['auth','verified']);
Route::get('/createLinkToken',[PlaidController::class,'createLinkToken']);
Route::post('/storePlaidAccount', [PlaidController::class,'storePlaidAccount']);
Route::post('/getInvestmentHoldings', [PlaidController::class,'getInvestmentHoldings']);
Route::post('/place_order',[CustomerController::class,'place_order'])->name('place_order');
Route::get('/myorder',[CustomerController::class,'myorder'])->name('myorder');





// routes for shop
Route::post('/shop/login',  [AuthController::class,'shop_login'])->name('shop_login');
Route::get('/service_provider', [ShopController::class, 'service_provider_index'])->name('service_provider_index')->middleware(['auth','verified']);

Route::get('/service_provider/shop_profile',[ShopController::class,'shop_profile'])->name('shop_profile');
Route::post('/shop/edit_profile',[ShopController::class,'shop_edit_profile'])->name('shop_edit_profile');
Route::get('/service_provider/shop_documents',[ShopController::class,'shop_documents'])->name('shop_documents');
Route::put('/service_provider/shop_documents/add',[ShopController::class,'shop_add_documents'])->name('shop_add_documents');
Route::put('/service_provider/shop_documents/update',[ShopController::class,'shop_update_documents'])->name('shop_update_documents');

//shop work houre
Route::get('/shop/work/houre', [ShopController::class, 'shop_work_hour'])->name('shop_work_hour');
Route::post('/shop/work/houre/add', [ShopController::class, 'shop_work_hour_add'])->name('shop_work_hour_add');
Route::get('/shop/work/houre/edit/{id}', [ShopController::class, 'shop_work_hour_edit']);
Route::put('/shop/work/houre/update', [ShopController::class, 'shop_work_hour_update'])->name('shop_work_hour_update');
Route::delete('/shop/work/houre/delete', [ShopController::class, 'shop_work_hour_delete'])->name('shop_work_hour_delete');

Route::get('/shop/catagory', [ShopController::class, 'shop_catagory'])->name('shop_catagory');
Route::post('/shop/catagory/add', [ShopController::class, 'shop_catagory_add'])->name('shop_catagory_add');
Route::get('/shop/catagory/edit/{id}', [ShopController::class, 'shop_catagory_edit']);
Route::put('/shop/catagory/update', [ShopController::class, 'shop_catagory_update'])->name('shop_catagory_update');
Route::delete('/shop/catagory/delete', [ShopController::class, 'shop_catagory_delete'])->name('shop_catagory_delete');


Route::get('/shop/sub_catagory', [ShopController::class, 'shop_sub_catagory'])->name('shop_sub_catagory');
Route::post('/shop/sub_catagory/add', [ShopController::class, 'shop_sub_catagory_add'])->name('shop_sub_catagory_add');
Route::get('/shop/sub_catagory/edit/{id}', [ShopController::class, 'shop_sub_catagory_edit']);
Route::put('/shop/sub_catagory/update', [ShopController::class, 'shop_sub_catagory_update'])->name('shop_sub_catagory_update');
Route::delete('/shop/sub_catagory/delete', [ShopController::class, 'shop_sub_catagory_delete'])->name('shop_sub_catagory_delete');


Route::get('/shop/service', [ShopController::class, 'shop_service'])->name('shop_service');
Route::post('/shop/service/add', [ShopController::class, 'shop_service_add'])->name('shop_service_add');
Route::get('/shop/service/edit/{id}', [ShopController::class, 'shop_service_edit']);
Route::put('/shop/service/update', [ShopController::class, 'shop_service_update'])->name('shop_service_update');
Route::delete('/shop/service/delete', [ShopController::class, 'shop_service_delete'])->name('shop_service_delete');


Route::get('/service_provider/individual_profile',[ShopController::class,'individual_profile'])->name('individual_profile');
Route::put('/service_provider/individual_profile/update',[ShopController::class,'individual_profile_update'])->name('individual_profile_update');
Route::get('/service_provider/individual_documents',[ShopController::class,'individual_documents'])->name('individual_documents');
Route::put('/service_provider/individual_documents/add',[ShopController::class,'individul_add_documents'])->name('individul_add_documents');
Route::put('/service_provider/individual_documents/update',[ShopController::class,'individual_update_documents'])->name('individual_update_documents');

Route::get('/service_provider/employee',[ShopController::class, 'sp_employee'])->name('sp_employee');
Route::get('/autocomplete', [ShopController::class, 'autocomplete_emp'])->name('autocomplete_emp');
Route::post('/service_provider/employee/add',[ShopController::class,'sp_employee_add'])->name('sp_employee_add');
Route::post('/service_provider/employee/invite',[ShopController::class,'sp_employee_invite'])->name('sp_employee_invite');

Route::get('/service_provider/order',[ShopController::class,'sp_order'])->name('sp_order');
Route::get('/service_provider/order_view/{id}',[ShopController::class,'sp_order_view'])->name('sp_order_view');
Route::post('/service_provider/cancel_order',[ShopController::class,'sp_cancel_order'])->name('cancel_order');
Route::post('/service_provider/confirm_order',[ShopController::class,'sp_confirm_order'])->name('confirm_order');
Route::get('/service_provider/individual_confirm_order/{order_id}',[ShopController::class,'sp_individual_confirm_order'])->name('individual_confirm_order');
Route::get('/service_provider/assigned_info/{id}',[ShopController::class,'sp_assigned_info'])->name('sp_assigned_info');
Route::get('/service_provider/employee/assigned_work',[ShopController::class,'sp_employee_assigned_work'])->name('sp_employee_assigned_work');
Route::get('/service_provider/employee/assigned_work/status/{order_id}',[ShopController::class,'sp_employee_assigned_work_done'])->name('sp_employee_assigned_work_status');




Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// $2y$10$M4AduO5h82AyuwcoRuODWOfNUdVVu419PazHnOuQsoqwIJp.6.XjK

Route::get('/email/verify', function () {
    return view('emails.verify-email');
})->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return view('emails.success_verify');
})->middleware(['auth','signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth','throttle:6,1'])->name('verification.send');

Route::get('/email',function(){
    return new OrderCancelMail();
});




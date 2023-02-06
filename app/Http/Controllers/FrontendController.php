<?php

namespace App\Http\Controllers;

use App\Models\individual_info;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
use Carbon\Carbon;
use App\Models\User;
use App\Models\customer_info;
use App\Models\shop_info;
use App\Models\catagory_info;
use App\Models\subcatagory_info;
use App\Models\service;
use App\Models\service_provider_doc;
use Gloudemans\Shoppingcart\Facades\Cart;



class FrontendController extends Controller
{
    //
    public function index()
    {
        return view('frontend.master');
    }
     public function content()
    {
      // $services1=category::where('cat_name','Salon Service')->get();
      // $services2=category::where('cat_name','Skin Care Service')->get();
        // $shop=Service::all();
        // return view('frontend.layout.content',compact('shop'));
//        $shops = shop_info::Join('Users','shop_infos.u_id','=','users.id')->get(['shop_infos.*','users.shop_name','users.phone','users.email','users.image']);
//        $individuals = individual_info::Join('Users','individual_infos.u_id','=','users.id')->get(['individual_infos.*','users.first_name','users.last_name','users.phone','users.email','users.image']);
        $shops = User::where('role_id','2')->where('user_status','1')->get();
        $individuals = User::where('role_id','3')->where('emp_status','0')->where('user_status','1')->where('sp_work_status','0')->get();
//         dd($shops,$individuals);
        return view('frontend.layout.content',compact('shops','individuals'));
    }
     public function customer_registration()
    {
        return view('frontend.layout.customer_registration');
    }
    public function customer_login()
    {
        return view('frontend.layout.customer_login');
    }
    public function edit_user_profile()
    {
        $customer=User::leftJoin('customer_infos','Users.id','=','customer_infos.u_id')->where('users.id', auth()->id())
                    ->first(['Users.first_name','Users.last_name','Users.phone','Users.email','Users.image','customer_infos.*']);
        // $list=customer_info::where('u_id', auth()->id())->first();
        // dd($customer);
        return view('frontend.layout.edit_user_profile',compact('customer'));
        // return view('frontend.layout.edit_user_profile');
    }
    public function edit_shop_profile()
    {
    //   $lists=category::where('auth_id', auth()->id())->get();
    //   $list=User::where('id', auth()->id())->get();

    //     //dd($list);
    //      $shop=Shop_Information::where('user_id', auth()->id())->where('verified_at', 1)->first();
    //      //dd($shop);

    //     if($shop){

    //       return view('admin.category.category_form',compact('lists'));
    //       //$status="Verified";
    //     }else{

    //       return view('frontend.layout.edit_shop_profile',compact('list'));
    //     }

        //dd($shop);
       //return view('frontend.layout.edit_shop_profile',compact('list'));
       $shop = shop_info::where('u_id','=',auth()->id())->first();
       $sp_doc = service_provider_doc::where('u_id',auth()->id())->first();
    //    dd($shop);
       return view('frontend.layout.edit_shop_profile',compact('shop','sp_doc'));
    }

     public function shop_registration()
    {
        return view('frontend.layout.shop_registration');
    }
     public function individual_registration()
    {
        return view('frontend.layout.shop_registration');
    }
     public function shop_login()
    {
        return view('frontend.layout.shop_login');
    }
     public function about_us()
    {
        return view('frontend.layout.about_us');
    }
     public function faq()
    {
        return view('frontend.layout.faq');
    }

     public function contact_us()
    {
        return view('frontend.layout.contact_us');
    }

     public function service_list($u_id)
    {
        $user = User::where('id',$u_id)->first()->role_id;
//        dd($user);
        if($user == '2'){
            $shop_info = shop_info::Join('users','shop_infos.u_id','=','users.id')->where('shop_infos.u_id','=',$u_id)->first(['shop_infos.*','users.shop_name','users.phone','users.email','users.image']);
//            dd($shop_info);
        }
        if($user == '3'){
            $shop_info = individual_info::Join('users','individual_infos.u_id','=','users.id')->where('individual_infos.u_id','=',$u_id)->first(['individual_infos.*','users.first_name','users.last_name','users.phone','users.email','users.image']);
//            dd($shop_info);
        }

        $catagories = catagory_info::where('u_id','=',$u_id)->get();
        $subcatagories = subcatagory_info::where('u_id','=',$u_id)->get();
        // dd($catagories);
        // dd($shop_info);
        return view('frontend.layout.service_list',compact('shop_info','catagories','subcatagories'));
    }
     public function service_detail($u_id,$sub_id)
    {
        $user = User::where('id',$u_id)->first()->role_id;
//        dd($user);
         if($user == '2'){
             $shop_info = shop_info::Join('users','shop_infos.u_id','=','users.id')->where('shop_infos.u_id','=',$u_id)->first(['shop_infos.*','users.shop_name','users.phone','users.email','users.image']);
        //    dd($shop_info);
         }
         if($user == '3'){
             $shop_info = individual_info::Join('users','individual_infos.u_id','=','users.id')->where('individual_infos.u_id','=',$u_id)->first(['individual_infos.*','users.first_name','users.last_name','users.phone','users.email','users.image']);
//            dd($shop_info);
         }
//        $shop_info = shop_info::Join('Users','shop_infos.u_id','=','Users.id')->where('shop_infos.id','=',$u_id)->first(['shop_infos.*','Users.shop_name','Users.phone','Users.email','Users.image']);
        $subcat = subcatagory_info::where('id','=',$sub_id)->first()->subcatagory_name;
        $services = service::where('u_id','=',$u_id)->where('subcatagory_id','=',$sub_id)->get();
        // dd($shop_info,$services);
        return view('frontend.layout.service_detail',compact('shop_info','subcat','services'));
    }
    function login(){
        return view('auth.login');
    }

    public function admin_login()
    {
        return view('frontend.layout.admin_login');
    }
}
